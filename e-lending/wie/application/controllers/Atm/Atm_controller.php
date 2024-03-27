<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atm_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Atm/Atm_model','atm');
    }

   public function index()
   {
        // check if logged in and admin
        if($this->session->userdata('user_id') == '' || $this->session->userdata('administrator') == '0')
        {
          redirect('error500');
        }
      
        $this->load->helper('url');							
        											
        $data['title'] = '<i class="fas fa-university"></i> &nbsp; ATM Banks';					
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('atm/atm_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list()
    {
        $list = $this->atm->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $atm) {
            $no++;
            $row = array();
            $row[] = 'A' . $atm->atm_id;
            $row[] = $atm->name;
            $row[] = $atm->branch;
            $row[] = $atm->remarks;

            $row[] = $atm->encoded;

            //add html for action
            $row[] = '<a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_atm('."'".$atm->atm_id."'".')"><i class="fas fa-pencil-alt"></i></a>
                      
                      <a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_atm('."'".$atm->atm_id."'".', '."'".$atm->name."'".')"><i class="far fa-trash-alt"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        'draw' => $_POST['draw'],
                        'recordsTotal' => $this->atm->count_all(),
                        'recordsFiltered' => $this->atm->count_filtered(),
                        'data' => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($atm_id)
    {
        $data = $this->atm->get_by_id($atm_id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'name' => $this->input->post('name'),
                'branch' => $this->input->post('branch'),
                'remarks' => $this->input->post('remarks'),
                'removed' => 0
            );
        $insert = $this->atm->save($data);
        echo json_encode(array('status' => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'name' => $this->input->post('name'),
                'branch' => $this->input->post('branch'),
                'remarks' => $this->input->post('remarks')
            );
        $this->atm->update(array('atm_id' => $this->input->post('atm_id')), $data);
        echo json_encode(array('status' => TRUE));
    }

    // delete a atm
    public function ajax_delete($atm_id)
    {
        $data = array(
                'removed' => 1
            );
        $this->atm->update(array('atm_id' => $atm_id), $data);
        echo json_encode(array('status' => TRUE));
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
            $data['error_string'][] = 'ATM bank name is required';
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
                $duplicates = $this->atm->get_duplicates($this->input->post('name'));

                if ($duplicates->num_rows() != 0)
                {
                    $data['inputerror'][] = 'name';
                    $data['error_string'][] = 'ATM bank name is already registered';
                    $data['status'] = FALSE;
                }
            }
        }

        if($this->input->post('branch') == '')
        {
            $data['inputerror'][] = 'branch';
            $data['error_string'][] = 'ATM bank branch is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }