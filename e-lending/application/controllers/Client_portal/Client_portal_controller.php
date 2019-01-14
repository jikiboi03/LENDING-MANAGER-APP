<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_portal_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Clients/Clients_model','clients');
        $this->load->model('Atm/Atm_model','atm');
        $this->load->model('Companies/Companies_model','companies');
        $this->load->model('Loans/Loans_model','loans');
        $this->load->model('Transactions/Transactions_model','transactions');
        
    }

   public function index($client_id)
   {
        // check if logged in and not admin
        if($this->session->userdata('user_id') == '' || $this->session->userdata('administrator') != "0" || $this->session->userdata('client_id') != $client_id)
        {
          redirect('error500');
        }

        $client_data = $this->clients->get_by_id($client_id);

        $data['client'] = $client_data;

        $data['loan_balance'] = $this->loans->get_client_total_balance($client_id);

        $this->load->helper('url');                         
                                                    
        $data['title'] = "<i class='fa fa-id-card'></i>&nbsp; Client Portal";                  
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('client_portal/client_portal_view',$data);
        $this->load->view('template/dashboard_navigation_client');
        $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list($client_id)
    {
        $list = $this->loans->get_active_loans_datatables($client_id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $loans) {
            $no++;
            $row = array();
            // $row[] = 'L' . $loans->loan_id;

            // $row[] = number_format($loans->amount, 2, '.', ',');
            // $row[] = number_format($loans->interest, 2, '.', ',');   
            // $row[] = number_format($loans->total, 2, '.', ',');

            // $row[] = $loans->date_start;
            // $row[] = $loans->date_end;

            $loan_id = 'L' . $loans->loan_id;
            $i_amount = number_format($loans->amount, 2, '.', ',');
            $i_interest = number_format($loans->interest, 2, '.', ',');
            $i_total = number_format($loans->total, 2, '.', ',');

            $date_start = $loans->date_start;
            $date_end = $loans->date_end;

            $paid = number_format($loans->paid, 2, '.', ',');
            $balance = number_format($loans->balance, 2, '.', ',');
            $total_loan = number_format(($loans->paid + $loans->balance), 2, '.', ',');

            $remarks = $loans->remarks;
            $encoded = $loans->encoded;
                        
            $loan_str_1 = $date_start . '<br>' .
                        '<span style="float:left;">I.Amount</span><span style="float:right;">' . $i_amount . '</span>' . '<br>' .
                        '<span style="float:left;">I.Interest</span><span style="float:right;">+ <u>' . $i_interest . '</u></span>' . 
                        '<br>' .
                        '<span style="float:left;">I.Total</span><span style="float:right;">' . $i_total . '</span>' . '<br>' .
                        '<span style="float:left;">Current</span><span style="float:right;">' . $total_loan . '</span>' . '<br>' .
                        '<br>' .
                        '<span style="float:left;">Total Paid</span><span style="float:right;">- <u>' . $paid . '</u></span>' . '<br>' .
                        '<span style="float:left;">Balance</span><span style="float:right;">' . $balance . '</span>' . '<br>' .
                        '<br>' .
                        '<a style="width: 100%;" class="btn btn-dark" width="100%" href="javascript:void(0)" title="View Detail" onclick="view_cp_loan('."'".$client_id."'".', '."'".$loans->loan_id."'".')"><i class="fa fa-eye"></i>&nbsp; View Loan Details</a></span>';

            $row[] = $loan_str_1;
            $row[] = $remarks;


            // genereate loan status based on int. Loan can only be edited or deleted if it is new
            if ($loans->status == 1)
            {
                $row[] = 'New';
            }
            else if ($loans->status == 2) // buttons are disabled (date and remarks can only be edited)
            {
                $row[] = 'Ongoing';
            }
            else // buttons are disabled (date and remarks can only be edited)
            {
                $row[] = 'Cleared';
            }
            // $row[] = number_format($loans->paid, 2, '.', ',');
            // $row[] = '<b>' . number_format($loans->balance, 2, '.', ',') . '</b>';
            // $row[] = number_format(($loans->paid + $loans->balance), 2, '.', ',');

            // $row[] = $loans->remarks;
            // $row[] = $loans->encoded;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->loans->count_active_loans_all($client_id),
                        "recordsFiltered" => $this->loans->count_active_loans_filtered($client_id),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 }