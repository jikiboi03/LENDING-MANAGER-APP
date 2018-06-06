<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Clients/Clients_model','clients');
        // $this->load->model('atm/atm_model','atm');
        // $this->load->model('companies/companies_model','companies');
        $this->load->model('Loans/Loans_model','loans');
        $this->load->model('Transactions/Transactions_model','transactions');
        
    }

   public function index($client_id, $loan_id)						/** Note: ayaw ilisi ang sequence sa page load sa page **/
   {
        if($this->session->userdata('user_id') == '')
        {
          redirect('error500');
        }

        $client_data = $this->clients->get_by_id($client_id);
        $loan_data = $this->loans->get_by_id($loan_id);

        $data['client'] = $client_data;
        $data['loan'] = $loan_data;

        $this->load->helper('url');							
        											
        $data['title'] = 'Loan Transactions History';					
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('transactions/transactions_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
        $this->load->view('template/dashboard_navigation');
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

            if ($transactions->type == 1)
            {
                $row[] = '<a class="btn btn-sm btn-info" href="javascript:void(0)" title="Edit" onclick="edit_trans_date_remarks('."'".$transactions->trans_id."'".')" disabled><i class="fa fa-pencil-square-o"></i></a>';
            }
            else
            {
                $row[] = '<a class="btn btn-sm btn-info" href="javascript:void(0)" title="Edit" onclick="edit_trans_date_remarks('."'".$transactions->trans_id."'".')"><i class="fa fa-pencil-square-o"></i></a>';
            }

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
 
    // insert transaactions methods ===================================================================================

    public function ajax_paid() // for paid partial / full
    {
        $this->_validate_paid();

        $loan_id = $this->input->post('loan_id');
        $amount = $this->input->post('amount'); // paid amount
        $total = $this->input->post('total'); // total due / remaining balance after payment

        if ($total == 0)
        {
          $type = 3; // Paid Full
          $date_end = $this->input->post('date'); // if fully paid, set date_end / cleared
          $status = 3; // update loan status
        }
        else
        {
          $type = 2; // Paid Partial
          $date_end = 'n/a'; // if partial only, set n/a
          $status = 2; // update loan status
        }

        $data = array(
                'loan_id' => $loan_id,
                'date' => $this->input->post('date'),
                'type' => $type,
                'amount' => (-1 * $amount),
                'interest' => 0,
                'total' => $total,
                'remarks' => $this->input->post('remarks')
            );
        $insert = $this->transactions->save($data);

        // get current paid to add new paid for total paid
        $current_paid = $this->loans->get_paid_value($loan_id);
        $total_paid = ($current_paid + $amount);

        // for loans table record
        $dataloans = array(
                'status' => $status,
                'date_end' => $date_end,
                'paid' => $total_paid,
                'balance' => $total
            );
        $this->loans->update(array('loan_id' => $loan_id), $dataloans);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_add_interest() // for loan interest
    {
        $this->_validate_add_int();

        $loan_id = $this->input->post('loan_id');
        $total = $this->input->post('total'); // total due / total balance after added interest

        $type = 4;
        $status = 2; // update loan status

        $data = array(
                'loan_id' => $loan_id,
                'date' => $this->input->post('date'),
                'type' => $type,
                'amount' => 0,
                'interest' => $this->input->post('interest'),
                'total' => $total,
                'remarks' => $this->input->post('remarks')
            );
        $insert = $this->transactions->save($data);

        // for loans table record
        $dataloans = array(
                'status' => $status,
                'balance' => $total
            );
        $this->loans->update(array('loan_id' => $loan_id), $dataloans);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_adjustment() // for paid add amount / discount amount
    {
        $this->_validate_adjustment();

        $loan_id = $this->input->post('loan_id');
        $adjustment = $this->input->post('adjustment_amount'); // add amount / discount amount value
        $total = $this->input->post('total'); // total due / remaining balance after adjustment

        if ($total == 0)
        {
          $date_end = $this->input->post('date'); // if fully paid, set date_end / cleared
          $status = 3; // update loan status
        }
        else
        {
          $date_end = 'n/a'; // if partial only, set n/a
          $status = 2; // update loan status
        }

        if ($adjustment > 0)
        {
          $type = 5; // Add Amount - positive value
        }
        else
        {
          $type = 6; // Discount - negative value
        }

        $data = array(
                'loan_id' => $loan_id,
                'date' => $this->input->post('date'),
                'type' => $type,
                'amount' => $adjustment,
                'interest' => 0,
                'total' => $total,
                'remarks' => $this->input->post('remarks')
            );
        $insert = $this->transactions->save($data);

        // for loans table record
        $dataloans = array(
                'status' => $status,
                'date_end' => $date_end,
                'balance' => $total
            );
        $this->loans->update(array('loan_id' => $loan_id), $dataloans);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($trans_id)
    {
        $data = $this->transactions->get_by_id($trans_id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $this->_validate_date();

        $loan_id = $this->input->post('loan_id');
        $total = $this->input->post('total'); // total due / remaining balance after payment

        if ($total == 0)
        {
          $date_end = $this->input->post('date'); // if fully paid, set date_end / cleared
        }
        else
        {
          $date_end = 'n/a'; // if partial only, set n/a
        }

        $data = array(
                'date' => $this->input->post('date'),
                'remarks' => $this->input->post('remarks')
            );
        $this->transactions->update(array('trans_id' => $this->input->post('trans_id')), $data);

        // for loans table record
        $dataloans = array(
                'date_end' => $date_end,
            );
        $this->loans->update(array('loan_id' => $loan_id), $dataloans);

        echo json_encode(array("status" => TRUE));
    }

    private function _validate_paid()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('amount') == '')
        {
            $data['inputerror'][] = 'amount';
            $data['error_string'][] = 'Amount value is required';
            $data['status'] = FALSE;
        }
        else if($this->input->post('amount') <= 0)
        {
            $data['inputerror'][] = 'amount';
            $data['error_string'][] = 'Amount value should be greater than zero';
            $data['status'] = FALSE;
        }

        if($this->input->post('total') < 0)
        {
            $data['inputerror'][] = 'total';
            $data['error_string'][] = 'Total balance should be a positive value';
            $data['status'] = FALSE;
        }

        // if($this->input->post('interest') == '')
        // {
        //     $data['inputerror'][] = 'interest';
        //     $data['error_string'][] = 'Interest to the loan is required';
        //     $data['status'] = FALSE;
        // }

        if($this->input->post('date') == '')
        {
            $data['inputerror'][] = 'date';
            $data['error_string'][] = 'Date of transaction is required';
            $data['status'] = FALSE;
        }   

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate_add_int()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('interest') == '')
        {
            $data['inputerror'][] = 'interest';
            $data['error_string'][] = 'Interest value is required';
            $data['status'] = FALSE;
        }
        else if($this->input->post('interest') <= 0)
        {
            $data['inputerror'][] = 'interest';
            $data['error_string'][] = 'Interest value should be greater than zero';
            $data['status'] = FALSE;
        }

        if($this->input->post('date') == '')
        {
            $data['inputerror'][] = 'date';
            $data['error_string'][] = 'Date of transaction is required';
            $data['status'] = FALSE;
        }   

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate_adjustment()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('adjustment_amount') == '')
        {
            $data['inputerror'][] = 'adjustment_amount';
            $data['error_string'][] = 'Adjustment value is required';
            $data['status'] = FALSE;
        }
        else if($this->input->post('adjustment_amount') == 0)
        {
            $data['inputerror'][] = 'adjustment_amount';
            $data['error_string'][] = 'Adjustment value is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('total') < 0)
        {
            $data['inputerror'][] = 'total';
            $data['error_string'][] = 'Total balance should have a positive value';
            $data['status'] = FALSE;
        }

        if($this->input->post('date') == '')
        {
            $data['inputerror'][] = 'date';
            $data['error_string'][] = 'Date of transaction is required';
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
            $data['error_string'][] = 'Date of transaction is required';
            $data['status'] = FALSE;
        }   

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }