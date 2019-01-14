<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_cp_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Clients/Clients_model','clients');

        $this->load->model('Loans/Loans_model','loans');
        $this->load->model('Transactions/Transactions_model','transactions');
        
    }

   public function index($client_id, $loan_id)
   {
        // check if logged in and not admin
        if($this->session->userdata('user_id') == '' || $this->session->userdata('administrator') != "0" || $this->session->userdata('client_id') != $client_id)
        {
          redirect('error500');
        }

        $client_data = $this->clients->get_by_id($client_id);
        $loan_data = $this->loans->get_by_id($loan_id);

        $data['client'] = $client_data;
        $data['loan'] = $loan_data;

        $this->load->helper('url');							
        											
        $data['title'] = "<i class='fa fa-credit-card'></i>&nbsp; Loan Details";
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('trans_cp/trans_cp_view',$data);
        $this->load->view('template/dashboard_navigation_client');
        $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list($loan_id)
    {
        $list = $this->transactions->get_datatables($loan_id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $transactions) {
            $no++;
            $row = array();
            $row[] = 'T' . $transactions->trans_id;

            $row[] = $transactions->date;

            if ($transactions->type == 1)
            {
              $type = 'Trans. Start';
            }
            else if ($transactions->type == 2)
            {
              $type = 'Paid Partial'; 
            }
            else if ($transactions->type == 3)
            {
              $type = 'Paid Full'; 
            }
            else if ($transactions->type == 4)
            {
              $type = 'Add Interest'; 
            }
            else if ($transactions->type == 5)
            {
              $type = 'Add Amount'; 
            }
            else if ($transactions->type == 6)
            {
              $type = 'Discount Amount'; 
            }

            $row[] = $type;          
      
            $row[] = number_format($transactions->amount, 2, '.', ',');
            $row[] = number_format($transactions->interest, 2, '.', ',');
            $row[] = number_format($transactions->total, 2, '.', ',');

            $row[] = $transactions->remarks;

            $row[] = $transactions->encoded;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->transactions->count_all($loan_id),
                        "recordsFiltered" => $this->transactions->count_filtered($loan_id),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 }