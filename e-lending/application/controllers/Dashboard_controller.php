<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Clients/Clients_model','clients');
    $this->load->model('Atm/Atm_model','atm');
    $this->load->model('Companies/Companies_model','companies');
    $this->load->model('Loans/Loans_model','loans');
    $this->load->model('Schedules/Schedules_model','schedules');
    $this->load->model('Transactions/Transactions_model','transactions');
    $this->load->model('Capital/Capital_model','capital');
    
  }

  public function index()
  {						
    // check if logged in and admin
    if($this->session->userdata('user_id') == '' || $this->session->userdata('administrator') == '0')
    {
      redirect('error500');
    }

    // get today's date and yesterday
    $today = date('Y-m-d');

    $clients_list = $this->clients->get_clients();

    // get total clients registered
    $clients_count = 0;
    // get has active trans
    $has_active_trans = 0;

    // for each clients
    foreach ($clients_list as $clients) 
    {
        // validate if client has an ongoing loan transaction in loans_table
        $active_loan = $this->loans->has_active_loan($clients->client_id);

        if ($active_loan->num_rows() != 0)
        {
            $has_active_trans++; // has active loan
        }
        
        $clients_count++;
    }

    // total loan balance and total loan paid
    $total_balance = $this->loans->get_total_loan_balance()['balance'];
    $total_paid = $this->loans->get_total_loan_balance()['paid'];

    $total_interests = $this->transactions->get_total_loan_interests()['interest'];
    $total_loans = $total_balance + $total_paid;

    $loans_cleared = $this->loans->count_loans_cleared();
    $loans_count = $this->loans->count_all_loans();






    $total_capital = $this->capital->get_total_capital();

    if ($total_capital == null)
    {
      $total_capital = 0;
    }
    else
    {
      $total_capital = $total_capital['total_capital'];
    }

    // getting cash on hand. total capital + total interests - cash receivable
    $cash_on_hand = $total_capital + $total_interests - $total_balance;

    $gross_capital = $total_balance + $cash_on_hand; // gross capital = total receivable + cash on hand

    $data['cash_on_hand'] = $cash_on_hand;

    $data['gross_capital'] = $gross_capital;
    
    // for schedules today notification
    $schedules_today = $this->schedules->get_schedules_today($today);

    if ($schedules_today == null)
    {
        $schedules_today_str = 'None';
    }
    else
    {
        $schedules_today_str = ''; 

        foreach ($schedules_today as $schedules) 
        {    
            $sched_id = 'S' . $schedules->sched_id;
            $title = $schedules->title;
            $time = $schedules->time;

            $schedules_today_str = $schedules_today_str . ' | ' . $sched_id . ': ' . $title . ' @ ' . $time . '.';
        }
    }
    
    $data['schedules_today_str'] = $schedules_today_str;

    $data['clients_count'] = $clients_count;
    $data['has_active_trans'] = $has_active_trans;

    $data['total_balance'] = $total_balance;
    $data['total_paid'] = $total_paid;

    $data['total_interests'] = $total_interests;
    $data['total_loans'] = $total_loans;

    $data['loans_cleared'] = $loans_cleared;
    $data['loans_count'] = $loans_count;    



    // ========================================== NOTIFICATIONS SECTION ================================================


    // for near due date notification
    $active_loans_list = $this->loans->get_active_loans();

    if ($active_loans_list == null)
    {
        $near_due_date_str = 'None';
    }
    else
    {
        $near_due_date_str = ''; 

        foreach ($active_loans_list as $active_loans) 
        {   
            // algo in checking if the due date falls under 5 days after the current date

            // get end day of the current month
            $mo_name = date('M', strtotime($today));

            // get end day of the current month
            $mo_end_day = date('t', strtotime($today));

            // get current day of the current month
            $curr_day = date('d', strtotime($today));

            // get every loans start date
            $due_day = date('d', strtotime($active_loans->date_start));
            
            $mo_5day_less = ($mo_end_day - 5);

            if ($curr_day > $mo_5day_less)
            {
                if ($curr_day > $due_day)
                {
                    $ceil_day = ($curr_day + 5) - $mo_end_day;
                    if ($due_day <= $ceil_day)
                        $near_due_date_str .= '<b>' . $this->clients->get_client_name($active_loans->client_id) . ' ' . $mo_name . ' ' . $due_day . '</b> - ' . (($mo_end_day + $due_day) - $curr_day) . ' day(s) left. ';
                    // else
                    //     echo 'false ' . $due_day . ' is ' . (($mo_end_day + $due_day) - $curr_day) . ' day(s) from of current day ' . $curr_day;
                }
                else
                {
                    $near_due_date_str .= '<b>' . $this->clients->get_client_name($active_loans->client_id) . ' ' . $mo_name . ' ' . $due_day . '</b> - ' . ($due_day - $curr_day) . ' day(s) left. '; 
                }
            }
            else
            {   
                $date_diff = ($due_day - $curr_day);
                if ($date_diff <= 5)
                {
                    if ($date_diff >= 0)
                        $near_due_date_str .= '<b>' . $this->clients->get_client_name($active_loans->client_id) . ' ' . $mo_name . ' ' . $due_day . '</b> - ' . $date_diff . ' day(s) left. ';
                    // else
                    //     echo 'false ' . $due_day . ' is ' . ($mo_end_day - $date_diff) . ' day(s) from of current day ' . $curr_day;
                }
                // else
                //     echo 'false ' . $due_day . ' is ' . $date_diff . ' day(s) from of current day ' . $curr_day;
            }
        }

        if ($near_due_date_str == '')
            $near_due_date_str = 'None';
    }

    $data['near_due_date_str'] = $near_due_date_str;


    $data['title'] = 'Dashboard';	
    $this->load->view('template/dashboard_header',$data);
    $this->load->view('template/dashboard_body',$data);
    $this->load->view('template/dashboard_navigation');
    $this->load->view('template/dashboard_footer');

  }
}
