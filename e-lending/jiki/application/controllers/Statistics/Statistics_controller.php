<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Clients_model $clients
 * @property Loans_model $loans
 * @property Transactions_model $transactions
 * @property Users_model $users
 * @property \CI_Session $session
 * @property \CI_Input $input
 * @property \CI_Loader $load
 */
class Statistics_controller extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Clients/Clients_model', 'clients');
    $this->load->model('Loans/Loans_model', 'loans');
    $this->load->model('Transactions/Transactions_model', 'transactions');
    $this->load->model('Users/Users_model', 'users');
  }

  public function index()
  {
    if (!$this->session->userdata('user_id') || $this->session->userdata('administrator') === '0') {
      redirect('error500');
    }

    $username_duplicates = $this->users->get_username_duplicates($this->session->userdata('username'));
    if ($username_duplicates->num_rows() === 0) {
      redirect('error500');
    }

    $current_year = date('Y');
    $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
    $month_names = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];

    $monthly_interests = [];
    foreach ($months as $index => $month) {
      $monthly_interests[$month_names[$index]] = $this->transactions->get_monthly_loan_interests($month, $current_year)['interest'];
    }

    $year_total = array_sum($monthly_interests);

    $prev_data = [
      'years' => [],
      'monthly' => array_fill_keys($month_names, []),
      'totals' => []
    ];

    $has_prev_year_income = true;
    $counter = 1;

    while ($has_prev_year_income) {
      $temp_prev_year = $current_year - $counter;
      $prev_year_total = 0;

      foreach ($months as $index => $month) {
        $interest = $this->transactions->get_monthly_loan_interests($month, $temp_prev_year)['interest'];
        $prev_data['monthly'][$month_names[$index]][] = $interest;
        $prev_year_total += $interest;
      }

      if ($prev_year_total == 0) {
        $has_prev_year_income = false;
      } else {
        $prev_data['years'][] = $temp_prev_year;
        $prev_data['totals'][] = $prev_year_total;
      }

      $counter++;
    }

    $data = array_merge($monthly_interests, [
      'current_year' => $current_year,
      'year_total' => number_format($year_total, 2, '.', ','),
      'prev_year' => $prev_data['years'],
      'prev_year_total' => $prev_data['totals'],
      'title' => 'Statistics'
    ]);

    foreach ($month_names as $month) {
      $data['prev_' . $month] = $prev_data['monthly'][$month];
    }

    $this->load->view('template/dashboard_header', $data);
    $this->load->view('statistics/statistics_view', $data);
    $this->load->view('template/dashboard_navigation');
    $this->load->view('template/dashboard_footer');
  }

  public function ajax_list()
  {
    $list = $this->loans->get_datatables_top_list();
    $data = [];
    $no = $_POST['start'];

    foreach ($list as $loan) {
      $no++;
      $data[] = [
        'C' . $loan->client_id,
        $this->clients->get_client_name($loan->client_id),
        number_format($loan->total_loans, 2, '.', ','),
        number_format($loan->paid, 2, '.', ','),
        number_format($loan->balance, 2, '.', ','),
        number_format($this->transactions->get_client_total_loan_interests($loan->client_id), 2, '.', ','),
        '<a class="btn btn-sm btn-default" href="javascript:void(0)" title="View" onclick="view_profile(\'' . $loan->client_id . '\')"><i class="fa fa-eye"></i></a>'
      ];
    }

    echo json_encode([
      'draw' => $_POST['draw'],
      'recordsTotal' => $this->loans->count_all_top_list(),
      'recordsFiltered' => $this->loans->count_filtered_top_list(),
      'data' => $data
    ]);
  }
}
