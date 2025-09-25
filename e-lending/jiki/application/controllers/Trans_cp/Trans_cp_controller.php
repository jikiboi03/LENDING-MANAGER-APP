<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property CI_Session $session
 * @property CI_Input $input
 * @property Clients_model $clients
 * @property Loans_model $loans
 * @property Transactions_model $transactions
 * @property Users_model $users
 */
class Trans_cp_controller extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Clients/Clients_model', 'clients');
    $this->load->model('Loans/Loans_model', 'loans');
    $this->load->model('Transactions/Transactions_model', 'transactions');
    $this->load->model('Users/Users_model', 'users');
  }

  public function index($client_id, $loan_id)
  {
    if (
      $this->session->userdata('user_id') == '' ||
      $this->session->userdata('administrator') != '0' ||
      $this->session->userdata('client_id') != $client_id
    ) {
      redirect('error500');
    }

    $username_duplicates = $this->users->get_username_duplicates($this->session->userdata('username'));

    if ($username_duplicates->num_rows() == 0) {
      redirect('error500');
    }

    $data = [
      'client' => $this->clients->get_by_id($client_id),
      'loan' => $this->loans->get_by_id($loan_id),
      'title' => '<i class="far fa-id-card"></i>'
    ];

    $this->load->helper('url');
    $this->load->view('template/dashboard_header', $data);
    $this->load->view('trans_cp/trans_cp_view', $data);
    $this->load->view('template/dashboard_navigation_client');
    $this->load->view('template/dashboard_footer');
  }

  public function ajax_list($loan_id)
  {
    $list = $this->transactions->get_datatables($loan_id);
    $data = [];
    $no = $_POST['start'];

    foreach ($list as $transactions) {
      $no++;

      $type = match ((int) $transactions->type) {
        1 => 'Trans. Start',
        2 => 'Paid Partial',
        3 => 'Paid Full',
        4 => 'Add Interest',
        5 => 'Add Amount',
        6 => 'Discount Amount',
        default => 'Unknown'
      };

      $data[] = [
        'T' . $transactions->trans_id,
        $transactions->date,
        $type,
        number_format($transactions->amount, 2, '.', ','),
        number_format($transactions->interest, 2, '.', ','),
        number_format($transactions->total, 2, '.', ','),
        $transactions->remarks,
        $transactions->encoded
      ];
    }

    echo json_encode([
      'draw' => $_POST['draw'],
      'recordsTotal' => $this->transactions->count_all($loan_id),
      'recordsFiltered' => $this->transactions->count_filtered($loan_id),
      'data' => $data
    ]);
  }
}
