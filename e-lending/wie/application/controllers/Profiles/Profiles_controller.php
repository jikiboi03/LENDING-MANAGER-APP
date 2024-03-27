<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles_controller extends CI_Controller {

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
        // check if logged in and admin
        if($this->session->userdata('user_id') == '' || $this->session->userdata('administrator') == '0')
        {
          redirect('error500');
        }

        $client_data = $this->clients->get_by_id($client_id);

        $data['client'] = $client_data;

        $data['loan_balance'] = $this->loans->get_client_total_balance($client_id);

        $this->load->helper('url');							
        											
        $data['title'] = '<i class="far fa-id-card"></i>';					
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('profiles/profiles_view',$data);
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list($client_id)
    {
        $list = $this->loans->get_datatables($client_id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $loans) {
            $no++;
            $row = array();
            $row[] = 'L' . $loans->loan_id;

            $row[] = number_format($loans->amount, 2, '.', ',');
            $row[] = number_format($loans->interest, 2, '.', ',');   
            $row[] = number_format($loans->total, 2, '.', ',');

            $row[] = $loans->date_start;
            $row[] = $loans->date_end;

            // genereate loan status based on int. Loan can only be edited or deleted if it is new
            if ($loans->status == 1)
            {
                $row[] = 'New';

                $row[] = '<a class="btn btn-primary" href="javascript:void(0)" title="View" onclick="view_loan('."'".$client_id."'".', '."'".$loans->loan_id."'".')"><i class="far fa-eye"></i> </a>

                    <a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_loan_date_remarks('."'".$loans->loan_id."'".')"><i class="fas fa-pencil-alt"></i> </a>
                      
                    <a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_loan('."'".$loans->loan_id."'".')"><i class="far fa-trash-alt"></i></a>';
            }
            else if ($loans->status == 2) // buttons are disabled (date and remarks can only be edited)
            {
                $row[] = 'Ongoing';

                $row[] = '<a class="btn btn-primary" href="javascript:void(0)" title="View" onclick="view_loan('."'".$client_id."'".', '."'".$loans->loan_id."'".')"><i class="far fa-eye"></i> </a>

                    <a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_loan_date_remarks('."'".$loans->loan_id."'".')"><i class="fas fa-pencil-alt"></i> </a>
                      
                    <a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_loan('."'".$loans->loan_id."'".')" disabled><i class="far fa-trash-alt"></i></a>';
            }
            else // buttons are disabled (date and remarks can only be edited)
            {
                $row[] = 'Cleared';

                $row[] = '<a class="btn btn-primary" href="javascript:void(0)" title="View" onclick="view_loan('."'".$client_id."'".', '."'".$loans->loan_id."'".')"><i class="far fa-eye"></i> </a>

                    <a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_loan_date_remarks('."'".$loans->loan_id."'".')"><i class="fas fa-pencil-alt"></i> </a>
                      
                    <a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_loan('."'".$loans->loan_id."'".')" disabled><i class="far fa-trash-alt"></i></a>';
            }
            $row[] = number_format($loans->paid, 2, '.', ',');
            $row[] = number_format($loans->balance, 2, '.', ',');
            $row[] = number_format(($loans->paid + $loans->balance), 2, '.', ',');

            $row[] = $loans->remarks;
            $row[] = $loans->encoded;
 
            $data[] = $row;
        }
 
        $output = array(
                        'draw' => $_POST['draw'],
                        'recordsTotal' => $this->loans->count_all($client_id),
                        'recordsFiltered' => $this->loans->count_filtered($client_id),
                        'data' => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    //========================================= client SECTION ==========================================================
 
    // add client loan
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'client_id' => $this->input->post('client_id'),
                'amount' => $this->input->post('amount'),
                'interest' => $this->input->post('interest'),
                'total' => $this->input->post('total'),
                'status' => 1,
                'date_start' => $this->input->post('date_start'),
                'date_end' => 'n/a',
                'paid' => 0,
                'balance' => $this->input->post('total'),
                'remarks' => $this->input->post('remarks')
            );
        $insert = $this->loans->save($data);

        // for transactions table record
        $datatrans = array(
                'loan_id' => $insert,
                'date' => $this->input->post('date_start'),
                'type' => 1,
                'amount' => $this->input->post('amount'),
                'interest' => $this->input->post('interest'),
                'total' => $this->input->post('total'),
                'remarks' => $this->input->post('remarks')
            );
        $inserttrans = $this->transactions->save($datatrans);

        echo json_encode(array('status' => TRUE));
    }

    public function ajax_edit($loan_id)
    {
        $data = $this->loans->get_by_id($loan_id);
        echo json_encode($data);
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'amount' => $this->input->post('amount'),
                'interest' => $this->input->post('interest'),
                'total' => $this->input->post('total'),
                // 'status' => $this->input->post('status'),
                'date_start' => $this->input->post('date_start'),
                // 'date_end' => $this->input->post('date_end'),
                'balance' => $this->input->post('total'),
                'remarks' => $this->input->post('remarks')
            );
        $this->loans->update(array('loan_id' => $this->input->post('loan_id')), $data);

         // for transactions table record
        $datatrans = array(
                'date' => $this->input->post('date_start'),
                'amount' => $this->input->post('amount'),
                'interest' => $this->input->post('interest'),
                'total' => $this->input->post('total'),
                'remarks' => $this->input->post('remarks')
            );
        $this->transactions->update(array('loan_id' => $this->input->post('loan_id')), $datatrans);

        echo json_encode(array('status' => TRUE));
    }

    public function ajax_update_date_remarks() // editing loan date/remarks only
    {
        $this->_validate_date();
        $data = array(
                
                'date_start' => $this->input->post('date_start'),
                'remarks' => $this->input->post('remarks')
            );
        $this->loans->update(array('loan_id' => $this->input->post('loan_id')), $data);

         // for transactions table record
        $datatrans = array(
                'date' => $this->input->post('date_start'),
                'remarks' => $this->input->post('remarks')
            );
        $this->transactions->update(array('loan_id' => $this->input->post('loan_id'), 'type' => 1), $datatrans);

        echo json_encode(array('status' => TRUE));
    }

    // delete a loan
    public function ajax_delete($loan_id)
    {
        $this->loans->delete_by_id($loan_id);

        // delete transaction record using loan_id
        $this->transactions->delete_by_id($loan_id);

        echo json_encode(array('status' => TRUE));
    }

    //========================================= CLIENT SECTION =======================================================
 

    public function do_upload() 
    {
         $config['upload_path']   = './uploads/pic1'; 
         $config['allowed_types'] = 'jpg|jpeg'; 
         $config['max_size']      = 2000; 
         $config['max_width']     = 5000; 
         $config['max_height']    = 5000;
         $new_name = $this->input->post('client_id') . '.jpg';
         $config['file_name'] = $new_name;
         $config['overwrite'] = TRUE;

         $this->load->library('upload', $config);
            
         if ( ! $this->upload->do_upload('userfile1')) // upload fail
         {
            $error = array('error' => $this->upload->display_errors()); 
            $this->load->view('upload_form', $error);
         }
         else // upload success
         { 
            $data = array('upload_data' => $this->upload->data()); 
            
            $data = array(
                'pic1' => $new_name
            );
            $this->clients->update(array('client_id' => $this->input->post('client_id')), $data);
            redirect('/profiles-page/' . $this->input->post('client_id'));
         } 
    } 

    public function do_upload_2() 
    {
         $config['upload_path']   = './uploads/pic2'; 
         $config['allowed_types'] = 'jpg|jpeg'; 
         $config['max_size']      = 2000; 
         $config['max_width']     = 5000; 
         $config['max_height']    = 5000;
         $new_name = $this->input->post('client_id') . '.jpg';
         $config['file_name'] = $new_name;
         $config['overwrite'] = TRUE;

         $this->load->library('upload', $config);
            
         if ( ! $this->upload->do_upload('userfile2')) // upload fail
         {
            $error = array('error' => $this->upload->display_errors()); 
            $this->load->view('upload_form', $error);
         }
         else // upload success
         { 
            $data = array('upload_data' => $this->upload->data()); 
            
            $data = array(
                'pic2' => $new_name
            );
            $this->clients->update(array('client_id' => $this->input->post('client_id')), $data);
            redirect('/profiles-page/' . $this->input->post('client_id'));
         } 
    }

    public function do_upload_3() 
    {
         $config['upload_path']   = './uploads/pic3'; 
         $config['allowed_types'] = 'jpg|jpeg'; 
         $config['max_size']      = 2000; 
         $config['max_width']     = 5000; 
         $config['max_height']    = 5000;
         $new_name = $this->input->post('client_id') . '.jpg';
         $config['file_name'] = $new_name;
         $config['overwrite'] = TRUE;

         $this->load->library('upload', $config);
            
         if ( ! $this->upload->do_upload('userfile3')) // upload fail
         {
            $error = array('error' => $this->upload->display_errors()); 
            $this->load->view('upload_form', $error);
         }
         else // upload success
         { 
            $data = array('upload_data' => $this->upload->data()); 
            
            $data = array(
                'pic3' => $new_name
            );
            $this->clients->update(array('client_id' => $this->input->post('client_id')), $data);
            redirect('/profiles-page/' . $this->input->post('client_id'));
         } 
    }   
    
    // update total paid and current balance
    public function ajax_update_bal_paid($loan_id)
    {
        $last_total = $this->transactions->get_last_trans_total($loan_id);

        $total_paid = $this->transactions->get_total_paid($loan_id);

        $this->loans->update_loan_balance($loan_id, $last_total);

        $this->loans->update_loan_paid($loan_id, $total_paid);

        echo json_encode(array('status' => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('amount') == '')
        {
            $data['inputerror'][] = 'amount';
            $data['error_string'][] = 'Amount is required';
            $data['status'] = FALSE;
        }
        else if($this->input->post('amount') == 0)
        {
            $data['inputerror'][] = 'amount';
            $data['error_string'][] = 'Amount is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('interest') == '')
        {
            $data['inputerror'][] = 'interest';
            $data['error_string'][] = 'Interest to the loan is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('date_start') == '')
        {
            $data['inputerror'][] = 'date_start';
            $data['error_string'][] = 'Date of loan is required';
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

        if($this->input->post('date_start') == '')
        {
            $data['inputerror'][] = 'date_start';
            $data['error_string'][] = 'Date of loan is required';
            $data['status'] = FALSE;
        }   

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }