<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property \Schedules_model $schedules
 * @property \Users_model $users
 * @property \CI_Session $session
 * @property \CI_Input $input
 * @property \CI_Loader $load
 * @property \CI_URI $uri
 */
class Schedules_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Schedules/Schedules_model', 'schedules');
        $this->load->model('Users/Users_model', 'users');
    }

    public function index()
    {
        // Check if logged in and is an admin
        if (
            $this->session->userdata('user_id') === ''
            || $this->session->userdata('administrator') === '0'
        ) {
            redirect('error500');
        }

        // Validate if username exists in the database
        $username_duplicates = $this->users->get_username_duplicates(
            $this->session->userdata('username')
        );

        if ($username_duplicates->num_rows() === 0) {
            redirect('error500');
        }

        $this->load->helper('url');

        $data['title'] = '<i class="fas fa-clipboard-list"></i> &nbsp; Schedules';
        $this->load->view('template/dashboard_header', $data);
        $this->load->view('schedules/schedules_view', $data);
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');
    }

    public function ajax_list()
    {
        $list = $this->schedules->get_datatables();
        $data = [];
        $no = $_POST['start'];

        foreach ($list as $schedules) {
            $no++;
            $row = [
                'S' . $schedules->sched_id,
                $schedules->title,
                $schedules->date,
                $schedules->time,
                $schedules->remarks,
                $schedules->username,
            ];

            $today = date('Y-m-d');

            if ($schedules->date == $today) {
                $row[] = 'Today';
            } elseif ($schedules->date < $today) {
                $row[] = 'Ended';
            } else {
                $row[] = 'Incoming';
            }

            $row[] = $schedules->encoded;

            // Action buttons
            $row[] =
                '<a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_schedule(' . "'" . $schedules->sched_id . "'" . ')">
                    <i class="fas fa-pencil-alt"></i>
                 </a>
                 <a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_schedule(' . "'" . $schedules->sched_id . "'" . ')">
                    <i class="far fa-trash-alt"></i>
                 </a>';

            $data[] = $row;
        }

        echo json_encode([
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->schedules->count_all(),
            'recordsFiltered' => $this->schedules->count_filtered(),
            'data' => $data,
        ]);
    }

    public function ajax_edit($sched_id)
    {
        $data = $this->schedules->get_by_id($sched_id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();

        $data = [
            'title' => $this->input->post('title'),
            'date' => $this->input->post('date'),
            'time' => $this->input->post('time'),
            'remarks' => $this->input->post('remarks'),
            'username' => $this->session->userdata('username'),
        ];

        $this->schedules->save($data);

        echo json_encode(['status' => true]);
    }

    public function ajax_update()
    {
        $this->_validate();

        $data = [
            'title' => $this->input->post('title'),
            'date' => $this->input->post('date'),
            'time' => $this->input->post('time'),
            'remarks' => $this->input->post('remarks'),
        ];

        $this->schedules->update(
            ['sched_id' => $this->input->post('sched_id')],
            $data
        );

        echo json_encode(['status' => true]);
    }

    public function ajax_delete($sched_id)
    {
        $this->schedules->delete_by_id($sched_id);
        echo json_encode(['status' => true]);
    }

    private function _validate()
    {
        $data = [
            'error_string' => [],
            'inputerror' => [],
            'status' => true,
        ];

        if ($this->input->post('title') === '') {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Schedule title is required';
            $data['status'] = false;
        }

        if ($this->input->post('date') === '') {
            $data['inputerror'][] = 'date';
            $data['error_string'][] = 'Schedule date is required';
            $data['status'] = false;
        }

        if ($data['status'] === false) {
            echo json_encode($data);
            exit;
        }
    }
}
