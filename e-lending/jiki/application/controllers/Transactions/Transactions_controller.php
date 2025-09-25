<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property CI_Input $input 
 * @property Clients_model $clients
 * @property Companies_model $companies
 * @property Loans_model $loans
 * @property Transactions_model $transactions
 * @property Users_model $users
 */
class Transactions_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Clients/Clients_model', 'clients');
        $this->load->model('Companies/Companies_model', 'companies');
        $this->load->model('Loans/Loans_model', 'loans');
        $this->load->model('Transactions/Transactions_model', 'transactions');
        $this->load->model('Users/Users_model', 'users');
    }

    public function index($client_id, $loan_id)
    {
        if (!$this->session->userdata('user_id') || $this->session->userdata('administrator') === '0') {
            redirect('error500');
        }

        $duplicates = $this->users->get_username_duplicates($this->session->userdata('username'));
        if ($duplicates->num_rows() === 0) {
            redirect('error500');
        }

        $data['client'] = $this->clients->get_by_id($client_id);
        $data['loan'] = $this->loans->get_by_id($loan_id);
        $data['loan_balance'] = $this->loans->get_client_total_balance($client_id);

        $last_payment = $this->transactions->get_last_trans_payment($loan_id);
        $data['last_payment_amount'] = $last_payment->amount ?? 0;
        $data['last_payment_date'] = $last_payment->date ?? null;

        $last_interest = $this->transactions->get_last_trans_interest($loan_id);
        $data['last_interest_amount'] = $last_interest->interest ?? 0;
        $data['last_interest_date'] = $last_interest->date ?? null;

        $data['title'] = '<i class="far fa-id-card"></i>';
        $this->load->helper('url');
        $this->load->view('template/dashboard_header', $data);
        $this->load->view('transactions/transactions_view', $data);
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');
    }

    public function ajax_list($loan_id)
    {
        $list = $this->transactions->get_datatables($loan_id);
        $data = [];
        $no = $_POST['start'];
        $count = 1;

        foreach ($list as $t) {
            $no++;
            $row = [];

            $row[] = 'T' . $t->trans_id;
            $row[] = $t->date;

            switch ($t->type) {
                case 1:
                    $type = 'Trans. Start';
                    break;
                case 2:
                    $type = 'Paid Partial';
                    break;
                case 3:
                    $type = 'Paid Full';
                    break;
                case 4:
                    $type = 'Add Interest';
                    break;
                case 5:
                    $type = 'Add Amount';
                    break;
                case 6:
                    $type = 'Discount Amount';
                    break;
                default:
                    $type = 'Unknown';
                    break;
            }

            $row[] = $type;

            $row[] = $t->amount == 0 ? '-' : number_format($t->amount, 2, '.', ',');
            $row[] = $t->interest == 0 ? '-' : number_format($t->interest, 2, '.', ',');
            $row[] = number_format($t->total, 2, '.', ',');

            $row[] = $t->remarks;

            if ($t->type == 1) {
                $row[] = '<a class="btn btn-info" href="javascript:void(0)" title="Edit" disabled><i class="fas fa-pencil-alt"></i></a>';
            } elseif ($t->type == 4 && $count === sizeof($list)) {
                $row[] = '<a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_interest(\'' . $t->trans_id . '\', \'' . $t->interest . '\')"><i class="far fa-trash-alt"></i></a>';
            } elseif (in_array($t->type, [2, 3]) && $count === sizeof($list)) {
                $row[] = '<a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_payment(\'' . $t->trans_id . '\', \'' . $t->amount . '\')"><i class="far fa-trash-alt"></i></a>';
            } else {
                $row[] = '<a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_trans_date_remarks(\'' . $t->trans_id . '\')"><i class="fas fa-pencil-alt"></i></a>';
            }

            $row[] = $t->encoded;
            $data[] = $row;
            $count++;
        }

        echo json_encode([
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->transactions->count_all($loan_id),
            'recordsFiltered' => $this->transactions->count_filtered($loan_id),
            'data' => $data
        ]);
    }

    public function ajax_paid()
    {
        $this->_validate_paid();

        $loan_id = $this->input->post('loan_id');
        $amount = $this->input->post('amount');
        $total = $this->input->post('total');

        $type = ($total == 0) ? 3 : 2;
        $status = ($total == 0) ? 3 : 2;
        $date_end = ($total == 0) ? $this->input->post('date') : 'n/a';

        $this->transactions->save([
            'loan_id' => $loan_id,
            'date' => $this->input->post('date'),
            'type' => $type,
            'amount' => -1 * $amount,
            'interest' => 0,
            'total' => $total,
            'remarks' => $this->input->post('remarks')
        ]);

        $this->loans->update(['loan_id' => $loan_id], [
            'status' => $status,
            'date_end' => $date_end,
            'paid' => $this->loans->get_paid_value($loan_id) + $amount,
            'balance' => $total
        ]);

        echo json_encode(['status' => true]);
    }

    public function ajax_add_interest()
    {
        $this->_validate_add_int();

        $loan_id = $this->input->post('loan_id');
        $total = $this->input->post('total');

        $this->transactions->save([
            'loan_id' => $loan_id,
            'date' => $this->input->post('date'),
            'type' => 4,
            'amount' => 0,
            'interest' => $this->input->post('interest'),
            'total' => $total,
            'remarks' => $this->input->post('remarks')
        ]);

        $this->loans->update(['loan_id' => $loan_id], [
            'status' => 2,
            'balance' => $total
        ]);

        echo json_encode(['status' => true]);
    }

    public function ajax_adjustment()
    {
        $this->_validate_adjustment();

        $loan_id = $this->input->post('loan_id');
        $adjustment = $this->input->post('adjustment_amount');
        $total = $this->input->post('total');

        $type = ($adjustment > 0) ? 5 : 6;
        $status = ($total == 0) ? 3 : 2;
        $date_end = ($total == 0) ? $this->input->post('date') : 'n/a';

        $this->transactions->save([
            'loan_id' => $loan_id,
            'date' => $this->input->post('date'),
            'type' => $type,
            'amount' => $adjustment,
            'interest' => 0,
            'total' => $total,
            'remarks' => $this->input->post('remarks')
        ]);

        $this->loans->update(['loan_id' => $loan_id], [
            'status' => $status,
            'date_end' => $date_end,
            'balance' => $total
        ]);

        echo json_encode(['status' => true]);
    }

    public function ajax_edit($trans_id)
    {
        echo json_encode($this->transactions->get_by_id($trans_id));
    }

    public function ajax_update()
    {
        $this->_validate_date();

        $loan_id = $this->input->post('loan_id');
        $total = $this->input->post('total');
        $date_end = ($total == 0) ? $this->input->post('date') : 'n/a';

        $this->transactions->update(['trans_id' => $this->input->post('trans_id')], [
            'date' => $this->input->post('date'),
            'remarks' => $this->input->post('remarks')
        ]);

        $this->loans->update(['loan_id' => $loan_id], ['date_end' => $date_end]);

        echo json_encode(['status' => true]);
    }

    public function ajax_delete($trans_id, $interest_amt, $loan_id)
    {
        $this->transactions->delete_by_trans_id($trans_id);
        $this->loans->adjust_balance($loan_id, $interest_amt, 'deduct');
        echo json_encode(['status' => true]);
    }

    public function ajax_delete_pay($trans_id, $pay_amt, $loan_id)
    {
        $this->transactions->delete_by_trans_id($trans_id);
        $this->loans->adjust_balance($loan_id, $pay_amt, 'add');
        $this->loans->adjust_paid($loan_id, $pay_amt, 'deduct');
        $this->loans->change_status($loan_id, 2);
        echo json_encode(['status' => true]);
    }

    // ================================
    // === Validation Helpers Below ===
    // ================================

    private function _validate_paid()
    {
        $this->_run_validation([
            ['amount', 'Payment value is required', fn ($v) => $v !== '' && $v > 0],
            ['total', 'Total balance should be a positive value', fn ($v) => $v >= 0],
            ['date', 'Date of transaction is required', fn ($v) => $v !== '']
        ]);
    }

    private function _validate_add_int()
    {
        $this->_run_validation([
            ['interest', 'Interest value is required and must be greater than zero', fn ($v) => $v !== '' && $v > 0],
            ['date', 'Date of transaction is required', fn ($v) => $v !== '']
        ]);
    }

    private function _validate_adjustment()
    {
        $this->_run_validation([
            ['adjustment_amount', 'Adjustment value is required and must not be zero', fn ($v) => $v !== '' && $v != 0],
            ['total', 'Total balance should have a positive value', fn ($v) => $v >= 0],
            ['date', 'Date of transaction is required', fn ($v) => $v !== '']
        ]);
    }

    private function _validate_date()
    {
        $this->_run_validation([
            ['date', 'Date of transaction is required', fn ($v) => $v !== '']
        ]);
    }

    private function _run_validation(array $rules)
    {
        $errors = ['error_string' => [], 'inputerror' => [], 'status' => true];
        foreach ($rules as [$field, $msg, $check]) {
            $value = $this->input->post($field);
            if (!$check($value)) {
                $errors['inputerror'][] = $field;
                $errors['error_string'][] = $msg;
                $errors['status'] = false;
            }
        }

        if (!$errors['status']) {
            echo json_encode($errors);
            exit();
        }
    }
}
