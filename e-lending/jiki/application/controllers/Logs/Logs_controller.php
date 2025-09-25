<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Logs_model $logs
 * @property Users_model $users
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_URI $uri
 * @property CI_Output $output
 * @property CI_Config $config
 * @property CI_Language $lang
 */
class Logs_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logs/Logs_model', 'logs');
        $this->load->model('Users/Users_model', 'users');
    }

    public function index($type)
    {
        if (
            $this->session->userdata('user_id') == '' ||
            $this->session->userdata('administrator') == '0'
        ) {
            redirect('error500');
        }

        $username = $this->session->userdata('username');
        $username_duplicates = $this->users->get_username_duplicates($username);

        if ($username_duplicates->num_rows() === 0) {
            redirect('error500');
        }

        $this->load->helper('url');

        $data['type'] = $type;

        if ($type === 'access') {
            $data['title'] = '<i class="fas fa-laptop"></i> &nbsp; Access';
        } elseif ($type === 'ops') {
            $data['title'] = '<i class="fas fa-laptop"></i> &nbsp; Operations';
        }

        $this->load->view('template/dashboard_header', $data);
        $this->load->view('logs/logs_view', $data);
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');
    }

    public function ajax_list($type)
    {
        $data = [];
        $no = $_POST['start'];

        if ($type === 'access') {
            $list = $this->logs->get_access_datatables();
        } elseif ($type === 'ops') {
            $list = $this->logs->get_ops_datatables();
        } else {
            echo json_encode([]);
            return;
        }

        foreach ($list as $logs) {
            $no++;
            $data[] = [
                'L' . $logs->log_id,
                $logs->log_type,
                str_replace('%20', ' ', $logs->details),
                $logs->user_fullname,
                $logs->date_time,
            ];
        }

        $output = [
            'draw' => $_POST['draw'],
            'recordsTotal' => ($type === 'access')
                ? $this->logs->count_all_access()
                : $this->logs->count_all_ops(),
            'recordsFiltered' => ($type === 'access')
                ? $this->logs->count_filtered_access()
                : $this->logs->count_filtered_ops(),
            'data' => $data,
        ];

        echo json_encode($output);
    }

    public function ajax_add($log_type, $details)
    {
        $user_fullname = $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname');

        $data = [
            'user_fullname' => $user_fullname,
            'log_type' => $log_type,
            'details' => $details,
        ];

        $this->logs->save($data);
        echo json_encode(['status' => true]);
    }
}
