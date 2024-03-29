<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Clients/Clients_model','clients');
        $this->load->model('Atm/Atm_model','atm');
        $this->load->model('Companies/Companies_model','companies');
        $this->load->model('Loans/Loans_model','loans');
        $this->load->model('Users/Users_model','users');
    }

   public function index()
   {
        // check if logged in and admin
        if($this->session->userdata('user_id') == '' || $this->session->userdata('administrator') == '0')
        {
          redirect('error500');
        }

        // validate if username already exist in the database table
        $username_duplicates = $this->users->get_username_duplicates($this->session->userdata('username'));

        if ($username_duplicates->num_rows() == 0)
        {
            redirect('error500');
        }
        
        // get companies and atm list for dropdown
        $data['companies'] = $this->companies->get_companies();
        $data['atm'] = $this->atm->get_atm();

        $this->load->helper('url');							
        											
        $data['title'] = '<i class="fas fa-users"></i> &nbsp; Clients';					
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('clients/clients_view',$data);
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list()
    {
        $list = $this->clients->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $clients) {
            $no++;
            $row = array();
            $row[] = 'C' . $clients->client_id;
            $row[] = $clients->lname;
            $row[] = $clients->fname;
            $row[] = $clients->contact;

            $row[] = $this->atm->get_atm_name($clients->atm_id); // atm bank name
            $row[] = $this->companies->get_company_name($clients->comp_id); // company name

            $loan_balance = $this->loans->get_client_total_balance($clients->client_id);

            $row[] = '<i>₱ ' . number_format($loan_balance, 2, '.', ',') . '</i>';      
            $row[] = '<u><b>' . $clients->pin . '</b></u>';

            $row[] = '<a class="btn btn-primary" href="' . base_url("profiles-page/" . $clients->client_id) . '" title="View"><i class="far fa-eye"></i></a>

                    <a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_client('."'".$clients->client_id."'".')"><i class="fas fa-pencil-alt"></i></a>
                      
                      <a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_client('."'".$clients->client_id."'".')"><i class="far fa-trash-alt"></i></a>';
            $row[] = $clients->sex;

            // validate if client has an ongoing loan transaction in loans_table
            $active_loan = $this->loans->has_active_loan($clients->client_id);

            if ($active_loan->num_rows() != 0)
            {
                $row[] = 'active'; // has active loan
            }
            else
            {
                $row[] = 'inactive'; // has active loan
            }
 
            $data[] = $row;
        }
 
        $output = array(
                        'draw' => $_POST['draw'],
                        'recordsTotal' => $this->clients->count_all(),
                        'recordsFiltered' => $this->clients->count_filtered(),
                        'data' => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($client_id)
    {
        $data = $this->clients->get_by_id($client_id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'lname' => $this->input->post('lname'),
                'fname' => $this->input->post('fname'),
                'contact' => $this->input->post('contact'),

                'comp_id' => $this->input->post('comp_id'),
                'atm_id' => $this->input->post('atm_id'),
                'atm_type' => $this->input->post('atm_type'),
                'pin' => $this->input->post('pin'),

                'sex' => $this->input->post('sex'),

                'job' => $this->input->post('job'),
                'salary' => $this->input->post('salary'),
            
                'address' => $this->input->post('address'),
                'remarks' => $this->input->post('remarks'),

                // 'encoded' => $this->input->post('encoded'),
                
                'removed' => 0
            );
        $insert = $this->clients->save($data);

        $data = array(
                'username' => $this->input->post('lname'),
                'password' => $this->input->post('pin'),
                'lastname' => $this->input->post('lname'),
                'firstname' => $this->input->post('fname'),
                'client_id' => $insert,
                'administrator' => '0',
                'removed' => '0'
            );
        $insert = $this->users->save($data);

        echo json_encode(array('status' => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'lname' => $this->input->post('lname'),
                'fname' => $this->input->post('fname'),
                'contact' => $this->input->post('contact'),

                'comp_id' => $this->input->post('comp_id'),
                'atm_id' => $this->input->post('atm_id'),
                'atm_type' => $this->input->post('atm_type'),
                'pin' => $this->input->post('pin'),

                'sex' => $this->input->post('sex'),

                'job' => $this->input->post('job'),
                'salary' => $this->input->post('salary'),
            
                'address' => $this->input->post('address'),
                'remarks' => $this->input->post('remarks')
            );
        $this->clients->update(array('client_id' => $this->input->post('client_id')), $data);
        echo json_encode(array('status' => TRUE));
    }

    // delete a child
    public function ajax_delete($client_id)
    {
        $data = array(
                'removed' => '1'
            );
        $this->clients->update(array('client_id' => $client_id), $data);
        echo json_encode(array('status' => TRUE));
    }

    private function _validate() // not required: salary, remarks
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('lname') == '')
        {
            $data['inputerror'][] = 'lname';
            $data['error_string'][] = 'Last name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('fname') == '')
        {
            $data['inputerror'][] = 'fname';
            $data['error_string'][] = 'First name is required';
            $data['status'] = FALSE;
        }
        // validation for duplicates
        else
        {
            $new_name = $this->input->post('lname') . $this->input->post('fname');
            // check if name has a new value or not
            if ($this->input->post('current_name') != $new_name)
            {
                // validate if name already exist in the databaase table
                $duplicates = $this->clients->get_duplicates($this->input->post('lname'), $this->input->post('fname'));

                if ($duplicates->num_rows() != 0)
                {
                    $data['inputerror'][] = 'lname';
                    $data['error_string'][] = 'Client name (full name) is already registered';
                    $data['status'] = FALSE;
                }
            }
        }

        if($this->input->post('contact') == '')
        {
            $data['inputerror'][] = 'contact';
            $data['error_string'][] = 'Contact is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('comp_id') == '')
        {
            $data['inputerror'][] = 'comp_id';
            $data['error_string'][] = 'Company is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('atm_id') == '')
        {
            $data['inputerror'][] = 'atm_id';
            $data['error_string'][] = 'ATM bank is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('atm_type') == '')
        {
            $data['inputerror'][] = 'atm_type';
            $data['error_string'][] = 'ATM type is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('pin') == '')
        {
            $data['inputerror'][] = 'pin';
            $data['error_string'][] = 'ATM pin number is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('sex') == '')
        {
            $data['inputerror'][] = 'sex';
            $data['error_string'][] = 'Gender is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('job') == '')
        {
            $data['inputerror'][] = 'job';
            $data['error_string'][] = 'Job information is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('address') == '')
        {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Address is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }