<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logs/Logs_model','logs');
    }

    public function index($type)
    {
        // check if logged in and admin
        if($this->session->userdata('user_id') == '' || $this->session->userdata('administrator') == '0')
        {
          redirect('error500');
        }

        $this->load->helper('url');

        $data['type'] = $type;
        
        if ($type == 'access')
        {
            $data['title'] = '<i class="fas fa-laptop"></i> &nbsp; System Logs - Access';
        }
        else if ($type == 'ops')
        {
            $data['title'] = '<i class="fas fa-laptop"></i> &nbsp; System Logs - Operations';
        }
        
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('logs/logs_view',$data);
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

    }
   
    public function ajax_list($type)
    {
        if ($type == 'access')
        {
            $list = $this->logs->get_access_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $logs) {
                $no++;
                $row = array();
                $row[] = 'L' . $logs->log_id;
                
                $row[] = $logs->log_type;
                $row[] = str_replace('%20', ' ', $logs->details);

                $row[] = $logs->user_fullname;

                $row[] = $logs->date_time;            
            
                $data[] = $row;
            }
            
            $output = array(
                            'draw' => $_POST['draw'],
                            'recordsTotal' => $this->logs->count_all_access(),
                            'recordsFiltered' => $this->logs->count_filtered_access(),
                            'data' => $data,
                    );
            //output to json format
            echo json_encode($output);
        }
        else if ($type == 'ops')
        {
            $list = $this->logs->get_ops_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $logs) {
                $no++;
                $row = array();
                $row[] = 'L' . $logs->log_id;
                
                $row[] = $logs->log_type;
                $row[] = str_replace('%20', ' ', $logs->details);

                $row[] = $logs->user_fullname;

                $row[] = $logs->date_time;            
            
                $data[] = $row;
            }
            
            $output = array(
                            'draw' => $_POST['draw'],
                            'recordsTotal' => $this->logs->count_all_ops(),
                            'recordsFiltered' => $this->logs->count_filtered_ops(),
                            'data' => $data,
                    );
            //output to json format
            echo json_encode($output);
        }
    }
 
    public function ajax_add($log_type, $details)
    {
        $user_fullname = $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname');

        $data = array(

                'user_fullname' => $user_fullname,
                'log_type' => $log_type,
                'details' => $details
            );
        $insert = $this->logs->save($data);
        echo json_encode(array('status' => TRUE));
    }
 

 }