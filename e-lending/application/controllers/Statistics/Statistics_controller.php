<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics_controller extends CI_Controller {
 

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Clients/Clients_model','clients');
    $this->load->model('Loans/Loans_model','loans');
    $this->load->model('Transactions/Transactions_model','transactions');
  }

  public function index()
  {						
    // check if logged in and admin
    if($this->session->userdata('user_id') == '' || $this->session->userdata('administrator') == "0")
    {
      redirect('error500');
    }

    


    // ========================= FOR MONTHLY INTERESTS CHART ==================================================


    $current_year = date('Y');

    $jan = $this->transactions->get_monthly_loan_interests('01', $current_year)['interest'];
    $feb = $this->transactions->get_monthly_loan_interests('02', $current_year)['interest'];
    $mar = $this->transactions->get_monthly_loan_interests('03', $current_year)['interest'];
    $apr = $this->transactions->get_monthly_loan_interests('04', $current_year)['interest'];

    $may = $this->transactions->get_monthly_loan_interests('05', $current_year)['interest'];
    $jun = $this->transactions->get_monthly_loan_interests('06', $current_year)['interest'];
    $jul = $this->transactions->get_monthly_loan_interests('07', $current_year)['interest'];
    $aug = $this->transactions->get_monthly_loan_interests('08', $current_year)['interest'];

    $sep = $this->transactions->get_monthly_loan_interests('09', $current_year)['interest'];
    $oct = $this->transactions->get_monthly_loan_interests('10', $current_year)['interest'];
    $nov = $this->transactions->get_monthly_loan_interests('11', $current_year)['interest'];
    $dec = $this->transactions->get_monthly_loan_interests('12', $current_year)['interest'];

    $year_total = ($jan + $feb + $mar + $apr + $may + $jun + $jul + $aug + $sep + $oct + $nov + $dec);

    $has_prev_year_income = true;
    $counter = 1;
    $prev_year = [];

    $prev_jan = [];
    $prev_feb = [];
    $prev_mar = [];
    $prev_apr = [];

    $prev_may = [];
    $prev_jun = [];
    $prev_jul = [];
    $prev_aug = [];

    $prev_sep = [];
    $prev_oct = [];
    $prev_nov = [];
    $prev_dec = [];

    $prev_year_total = [];

    while ($has_prev_year_income == true)
    {
      $temp_prev_year = ($current_year - $counter);
      array_push($prev_year, $temp_prev_year);

      array_push($prev_jan, $this->transactions->get_monthly_loan_interests('01', $temp_prev_year)['interest']);
      array_push($prev_feb, $this->transactions->get_monthly_loan_interests('02', $temp_prev_year)['interest']);
      array_push($prev_mar, $this->transactions->get_monthly_loan_interests('03', $temp_prev_year)['interest']);
      array_push($prev_apr, $this->transactions->get_monthly_loan_interests('04', $temp_prev_year)['interest']);

      array_push($prev_may, $this->transactions->get_monthly_loan_interests('05', $temp_prev_year)['interest']);
      array_push($prev_jun, $this->transactions->get_monthly_loan_interests('06', $temp_prev_year)['interest']);
      array_push($prev_jul, $this->transactions->get_monthly_loan_interests('07', $temp_prev_year)['interest']);
      array_push($prev_aug, $this->transactions->get_monthly_loan_interests('08', $temp_prev_year)['interest']);

      array_push($prev_sep, $this->transactions->get_monthly_loan_interests('09', $temp_prev_year)['interest']);
      array_push($prev_oct, $this->transactions->get_monthly_loan_interests('10', $temp_prev_year)['interest']);
      array_push($prev_nov, $this->transactions->get_monthly_loan_interests('11', $temp_prev_year)['interest']);
      array_push($prev_dec, $this->transactions->get_monthly_loan_interests('12', $temp_prev_year)['interest']);

      $prev_year_temp_total = ($prev_jan[$counter - 1] + $prev_feb[$counter - 1] + $prev_mar[$counter - 1] + $prev_apr[$counter - 1] + $prev_may[$counter - 1] + $prev_jun[$counter - 1] + $prev_jul[$counter - 1] + $prev_aug[$counter - 1] + $prev_sep[$counter - 1] + $prev_oct[$counter - 1] + $prev_nov[$counter - 1] + $prev_dec[$counter - 1]);
      array_push($prev_year_total, $prev_year_temp_total);

      if ($prev_year_temp_total == 0) {
        $has_prev_year_income = false;
      }
      $counter++;
    }
    array_pop($prev_year);

    $data['current_year'] = $current_year;
    
    $data['jan'] = $jan;
    $data['feb'] = $feb;
    $data['mar'] = $mar;
    $data['apr'] = $apr;

    $data['may'] = $may;
    $data['jun'] = $jun;
    $data['jul'] = $jul;
    $data['aug'] = $aug;

    $data['sep'] = $sep;
    $data['oct'] = $oct;
    $data['nov'] = $nov;
    $data['dec'] = $dec;

    $data['year_total'] = number_format($year_total, 2, '.', ',');

    $data['prev_year'] = $prev_year;
    
    $data['prev_jan'] = $prev_jan;
    $data['prev_feb'] = $prev_feb;
    $data['prev_mar'] = $prev_mar;
    $data['prev_apr'] = $prev_apr;

    $data['prev_may'] = $prev_may;
    $data['prev_jun'] = $prev_jun;
    $data['prev_jul'] = $prev_jul;
    $data['prev_aug'] = $prev_aug;

    $data['prev_sep'] = $prev_sep;
    $data['prev_oct'] = $prev_oct;
    $data['prev_nov'] = $prev_nov;
    $data['prev_dec'] = $prev_dec;

    $data['prev_year_total'] = $prev_year_total;
    
    $data['title'] = 'Statistics / Charts';	
    $this->load->view('template/dashboard_header',$data);
    $this->load->view('statistics/statistics_view',$data);
    $this->load->view('template/dashboard_navigation');
    $this->load->view('template/dashboard_footer');
  }

  public function ajax_list()
    {
        $list = $this->loans->get_datatables_top_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $loans) {
            $no++;
            $row = array();
            $row[] = 'C' . $loans->client_id;
            $row[] = $this->clients->get_client_name($loans->client_id);

            $row[] = number_format($loans->total_loans, 2, '.', ',');
            $row[] = number_format($loans->paid, 2, '.', ',');
            $row[] = number_format($loans->balance, 2, '.', ',');

            $row[] = number_format($this->transactions->get_client_total_loan_interests($loans->client_id), 2, '.', ',');

            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view_profile('."'".$loans->client_id."'".')"><i class="fa fa-eye"></i> </a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->loans->count_all_top_list(),
                        "recordsFiltered" => $this->loans->count_filtered_top_list(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}
