<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Companies_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Companies/Companies_model','companies');
    }

   public function index()
   {
        // check if logged in and admin
        if($this->session->userdata('user_id') == '' || $this->session->userdata('administrator') == "0")
        {
          redirect('error500');
        }

          $this->load->helper('url');							
        												
          $data['title'] = '<i class="fa fa-building"></i> &nbsp; Companies';					
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('companies/companies_view',$data);
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list()
    {
        $list = $this->companies->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $companies) {
            $no++;
            $row = array();
            $row[] = 'J' . $companies->comp_id;
            $row[] = $companies->name;
            $row[] = $companies->address;
            $row[] = $companies->remarks;

            $row[] = $companies->encoded;

            //add html for action
            $row[] = '<a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_company('."'".$companies->comp_id."'".')"><i class="fa fa-pencil-square-o"></i></a>
                      
                      <a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_company('."'".$companies->comp_id."'".', '."'".$companies->name."'".')"><i class="fa fa-trash"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->companies->count_all(),
                        "recordsFiltered" => $this->companies->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($comp_id)
    {
        $data = $this->companies->get_by_id($comp_id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'remarks' => $this->input->post('remarks'),
                'removed' => 0
            );
        $insert = $this->companies->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'remarks' => $this->input->post('remarks')
            );
        $this->companies->update(array('comp_id' => $this->input->post('comp_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    // delete a company
    public function ajax_delete($comp_id)
    {
        $data = array(
                'removed' => 1
            );
        $this->companies->update(array('comp_id' => $comp_id), $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('name') == '')
        {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Company name is required';
            $data['status'] = FALSE;
        }
        // validation for duplicates
        else
        {
            $new_name = $this->input->post('name');
            // check if name has a new value or not
            if ($this->input->post('current_name') != $new_name)
            {
                // validate if name already exist in the databaase table
                $duplicates = $this->companies->get_duplicates($this->input->post('name'));

                if ($duplicates->num_rows() != 0)
                {
                    $data['inputerror'][] = 'name';
                    $data['error_string'][] = 'Company name is already registered';
                    $data['status'] = FALSE;
                }
            }
        }

        if($this->input->post('address') == '')
        {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Company address is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }