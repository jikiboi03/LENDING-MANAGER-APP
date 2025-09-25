<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_DB_query_builder $db
 * @property Clients_model $clients
 * @property Atm_model $atm
 * @property Companies_model $companies
 * @property Loans_model $loans
 * @property Transactions_model $transactions
 * @property Users_model $users
 */
class Client_portal_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Clients/Clients_model', 'clients');
        $this->load->model('Atm/Atm_model', 'atm');
        $this->load->model('Companies/Companies_model', 'companies');
        $this->load->model('Loans/Loans_model', 'loans');
        $this->load->model('Transactions/Transactions_model', 'transactions');
        $this->load->model('Users/Users_model', 'users');
    }

    public function index($client_id)
    {
        // Check if logged in and NOT admin, and client_id matches
        if (
            $this->session->userdata('user_id') == '' ||
            $this->session->userdata('administrator') != '0' ||
            $this->session->userdata('client_id') != $client_id
        ) {
            redirect('error500');
        }

        // Validate if username exists
        $username_duplicates = $this->users->get_username_duplicates($this->session->userdata('username'));
        if ($username_duplicates->num_rows() == 0) {
            redirect('error500');
        }

        $this->load->helper('url');

        $data['client'] = $this->clients->get_by_id($client_id);
        $data['loan_balance'] = $this->loans->get_client_total_balance($client_id);
        $data['title'] = '<i class="far fa-id-card"></i>';

        $this->load->view('template/dashboard_header', $data);
        $this->load->view('client_portal/client_portal_view', $data);
        $this->load->view('template/dashboard_navigation_client');
        $this->load->view('template/dashboard_footer');
    }

    public function ajax_list($client_id)
    {
        $list = $this->loans->get_active_loans_datatables($client_id);
        $data = [];
        $no = $_POST['start'];

        foreach ($list as $loan) {
            $no++;
            $row = [];

            $loan_id = 'L' . $loan->loan_id;
            $amount = number_format($loan->amount, 2, '.', ',');
            $interest = number_format($loan->interest, 2, '.', ',');
            $total = number_format($loan->total, 2, '.', ',');
            $paid = number_format($loan->paid, 2, '.', ',');
            $balance = number_format($loan->balance, 2, '.', ',');
            $total_loan = number_format($loan->paid + $loan->balance, 2, '.', ',');

            $loan_summary = $loan->date_start . '<br>' .
                '<span style="float:left;">I.Amount</span><span style="float:right;">' . $amount . '</span><br>' .
                '<span style="float:left;">I.Interest</span><span style="float:right;">+ <u>' . $interest . '</u></span><br>' .
                '<span style="float:left;">I.Total</span><span style="float:right;">' . $total . '</span><br>' .
                '<span style="float:left;">Current</span><span style="float:right;">' . $total_loan . '</span><br><br>' .
                '<span style="float:left;">Total Paid</span><span style="float:right;">- <u>' . $paid . '</u></span><br>' .
                '<span style="float:left;">Balance</span><span style="float:right;">' . $balance . '</span><br><br>' .
                '<a style="width: 100%;" class="btn btn-primary" href="javascript:void(0)" title="View Detail" onclick="view_cp_loan(\'' . $client_id . '\', \'' . $loan->loan_id . '\')">' .
                '<i class="far fa-eye"></i>&nbsp; View Loan Details</a>';

            $row[] = $loan_summary;
            $row[] = $loan->remarks;

            // Loan status
            switch ($loan->status) {
                case 1:
                    $row[] = 'New';
                    break;
                case 2:
                    $row[] = 'Ongoing';
                    break;
                default:
                    $row[] = 'Cleared';
                    break;
            }

            $data[] = $row;
        }

        $output = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->loans->count_active_loans_all($client_id),
            'recordsFiltered' => $this->loans->count_active_loans_filtered($client_id),
            'data' => $data,
        ];

        echo json_encode($output);
    }
}
