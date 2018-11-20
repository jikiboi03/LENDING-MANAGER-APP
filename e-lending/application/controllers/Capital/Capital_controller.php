<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capital_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Capital/Capital_model','capital');
        $this->load->model('Loans/Loans_model','loans');
        $this->load->model('Transactions/Transactions_model','transactions');
    }

   public function index()
   {
      if($this->session->userdata('user_id') == '')
      {
        redirect('error500');
      }
      
      $this->load->helper('url');    

      $total_capital = $this->capital->get_total_capital();

      if ($total_capital == null)
      {
        $total_capital = 0;
      }
      else
      {
        $total_capital = $total_capital['total_capital'];
      }

      $total_interests = $this->transactions->get_total_loan_interests()['interest'];
      $total_balance = $this->loans->get_total_loan_balance()['balance'];

      $data['total_capital'] = $total_capital;
      $data['total_interests'] = $total_interests;
      $data['cash_receivable'] = $total_balance;


      // getting cash on hand. total capital + total interests - cash receivable
      $cash_on_hand = $total_capital + $total_interests - $total_balance;

      $gross_capital = $total_balance + $cash_on_hand; // gross capital = total receivable + cash on hand

      $data['cash_on_hand'] = $cash_on_hand;

      $data['gross_capital'] = $gross_capital;   

      // total capital addition/deduction values
      $total_additions = $this->capital->get_total_capital_additions()['amount'];
      $total_deductions = $this->capital->get_total_capital_deductions()['amount'];

      $data['total_additions'] = $total_additions;
      $data['total_deductions'] = $total_deductions;

                                                    
      $data['title'] = '<i class="fa fa-money"></i> &nbsp; Lending Capital Information';                    
      $this->load->view('template/dashboard_header',$data);
      $this->load->view('capital/capital_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
      $this->load->view('template/dashboard_navigation');
      $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list()
    {
        $list = $this->capital->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $capital) {
            $no++;
            $row = array();
            $row[] = 'P' . $capital->capital_id;
            $row[] = $capital->date;

            $row[] = number_format($capital->amount, 2, '.', ',');
            $row[] = number_format($capital->total, 2, '.', ',');

            $row[] = $capital->remarks;

            $row[] = '<a class="btn btn-sm btn-info" href="javascript:void(0)" title="Edit" onclick="edit_capital_date_remarks('."'".$capital->capital_id."'".')"><i class="fa fa-pencil-square-o"></i></a>';

            $row[] = $capital->encoded;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->capital->count_all(),
                        "recordsFiltered" => $this->capital->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'date' => $this->input->post('date'),
                'amount' => $this->input->post('amount'),
                'total' => $this->input->post('total'),
                'remarks' => $this->input->post('remarks')
            );
        $insert = $this->capital->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($capital_id)
    {
        $data = $this->capital->get_by_id($capital_id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $this->_validate_date();
        $data = array(
                'date' => $this->input->post('date'),
                'remarks' => $this->input->post('remarks')
            );
        $this->capital->update(array('capital_id' => $this->input->post('capital_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('date') == '')
        {
            $data['inputerror'][] = 'date';
            $data['error_string'][] = 'Date is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('amount') == '')
        {
            $data['inputerror'][] = 'amount';
            $data['error_string'][] = 'Capital adjustment amount is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('total') < 0)
        {
            $data['inputerror'][] = 'total';
            $data['error_string'][] = 'Total capital should have a positive value';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate_date()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('date') == '')
        {
            $data['inputerror'][] = 'date';
            $data['error_string'][] = 'Date is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }