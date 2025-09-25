<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property Capital_model $capital
 * @property Loans_model $loans
 * @property Transactions_model $transactions
 * @property Users_model $users
 */
class Capital_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Capital/Capital_model', 'capital');
        $this->load->model('Loans/Loans_model', 'loans');
        $this->load->model('Transactions/Transactions_model', 'transactions');
        $this->load->model('Users/Users_model', 'users');
    }

    public function index()
    {
        // Check if logged in and admin
        if (
            $this->session->userdata('user_id') === '' ||
            $this->session->userdata('administrator') === '0'
        ) {
            redirect('error500');
        }

        // Validate if username exists
        $username_duplicates = $this->users->get_username_duplicates(
            $this->session->userdata('username')
        );

        if ($username_duplicates->num_rows() === 0) {
            redirect('error500');
        }

        $this->load->helper('url');

        // Get total capital
        $capital = $this->capital->get_total_capital();
        $total_capital = $capital ? $capital['total_capital'] : 0;

        $total_interests = $this->transactions->get_total_loan_interests()['interest'];
        $total_balance = $this->loans->get_total_loan_balance()['balance'];

        $cash_on_hand = $total_capital + $total_interests - $total_balance;
        $gross_capital = $total_balance + $cash_on_hand;

        $data = [
            'total_capital' => $total_capital,
            'total_interests' => $total_interests,
            'cash_receivable' => $total_balance,
            'cash_on_hand' => $cash_on_hand,
            'gross_capital' => $gross_capital,
            'total_additions' => $this->capital->get_total_capital_additions()['amount'],
            'total_deductions' => $this->capital->get_total_capital_deductions()['amount'],
            'title' => '<i class="far fa-gem"></i> &nbsp; Capital'
        ];

        $this->load->view('template/dashboard_header', $data);
        $this->load->view('capital/capital_view', $data); // Change this if adding a new page
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');
    }

    public function ajax_list()
    {
        $list = $this->capital->get_datatables();
        $data = [];
        $no = $_POST['start'];

        foreach ($list as $capital) {
            $no++;
            $data[] = [
                'P' . $capital->capital_id,
                $capital->date,
                number_format($capital->amount, 2, '.', ','),
                number_format($capital->total, 2, '.', ','),
                $capital->remarks,
                $capital->encoded,
                '<a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_capital_date_remarks(' . "'" . $capital->capital_id . "'" . ')"><i class="fas fa-pencil-alt"></i></a>'
            ];
        }

        echo json_encode([
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->capital->count_all(),
            'recordsFiltered' => $this->capital->count_filtered(),
            'data' => $data,
        ]);
    }

    public function ajax_add()
    {
        $this->_validate();

        $data = [
            'date' => $this->input->post('date'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'remarks' => $this->input->post('remarks'),
        ];

        $this->capital->save($data);

        echo json_encode(['status' => TRUE]);
    }

    public function ajax_edit($capital_id)
    {
        echo json_encode($this->capital->get_by_id($capital_id));
    }

    public function ajax_update()
    {
        $this->_validate_date();

        $data = [
            'date' => $this->input->post('date'),
            'remarks' => $this->input->post('remarks'),
        ];

        $this->capital->update(
            ['capital_id' => $this->input->post('capital_id')],
            $data
        );

        echo json_encode(['status' => TRUE]);
    }

    private function _validate()
    {
        $errors = [
            'error_string' => [],
            'inputerror' => [],
            'status' => TRUE
        ];

        if ($this->input->post('date') === '') {
            $errors['inputerror'][] = 'date';
            $errors['error_string'][] = 'Date is required';
            $errors['status'] = FALSE;
        }

        if ($this->input->post('amount') === '') {
            $errors['inputerror'][] = 'amount';
            $errors['error_string'][] = 'Capital adjustment amount is required';
            $errors['status'] = FALSE;
        }

        if ((float) $this->input->post('total') < 0) {
            $errors['inputerror'][] = 'total';
            $errors['error_string'][] = 'Total capital should have a positive value';
            $errors['status'] = FALSE;
        }

        if ($errors['status'] === FALSE) {
            echo json_encode($errors);
            exit();
        }
    }

    private function _validate_date()
    {
        $errors = [
            'error_string' => [],
            'inputerror' => [],
            'status' => TRUE
        ];

        if ($this->input->post('date') === '') {
            $errors['inputerror'][] = 'date';
            $errors['error_string'][] = 'Date is required';
            $errors['status'] = FALSE;
        }

        if ($errors['status'] === FALSE) {
            echo json_encode($errors);
            exit();
        }
    }
}
