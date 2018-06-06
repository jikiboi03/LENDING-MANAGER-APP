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
    if($this->session->userdata('user_id') == '')
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



    $prev_year = $current_year - 1;

    $prev_jan = $this->transactions->get_monthly_loan_interests('01', $prev_year)['interest'];
    $prev_feb = $this->transactions->get_monthly_loan_interests('02', $prev_year)['interest'];
    $prev_mar = $this->transactions->get_monthly_loan_interests('03', $prev_year)['interest'];
    $prev_apr = $this->transactions->get_monthly_loan_interests('04', $prev_year)['interest'];

    $prev_may = $this->transactions->get_monthly_loan_interests('05', $prev_year)['interest'];
    $prev_jun = $this->transactions->get_monthly_loan_interests('06', $prev_year)['interest'];
    $prev_jul = $this->transactions->get_monthly_loan_interests('07', $prev_year)['interest'];
    $prev_aug = $this->transactions->get_monthly_loan_interests('08', $prev_year)['interest'];

    $prev_sep = $this->transactions->get_monthly_loan_interests('09', $prev_year)['interest'];
    $prev_oct = $this->transactions->get_monthly_loan_interests('10', $prev_year)['interest'];
    $prev_nov = $this->transactions->get_monthly_loan_interests('11', $prev_year)['interest'];
    $prev_dec = $this->transactions->get_monthly_loan_interests('12', $prev_year)['interest'];

    $prev_year_total = ($prev_jan + $prev_feb + $prev_mar + $prev_apr + $prev_may + $prev_jun + $prev_jul + $prev_aug + $prev_sep + $prev_oct + $prev_nov + $prev_dec);


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

    $data['prev_year_total'] = number_format($prev_year_total, 2, '.', ',');
    

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
