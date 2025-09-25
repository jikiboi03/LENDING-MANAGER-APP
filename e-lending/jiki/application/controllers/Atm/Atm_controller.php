<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property Atm_model $atm
 * @property Users_model $users
 */
class Atm_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Atm/Atm_model', 'atm');
        $this->load->model('Users/Users_model', 'users');
    }

    public function index()
    {
        // Check if logged in and is admin
        if (
            $this->session->userdata('user_id') === '' ||
            $this->session->userdata('administrator') === '0'
        ) {
            redirect('error500');
        }

        // Validate if username exists in DB
        $username_duplicates = $this->users->get_username_duplicates(
            $this->session->userdata('username')
        );

        if ($username_duplicates->num_rows() === 0) {
            redirect('error500');
        }

        $this->load->helper('url');

        $data['title'] = '<i class="fas fa-university"></i> &nbsp; ATM Banks';

        $this->load->view('template/dashboard_header', $data);
        $this->load->view('atm/atm_view', $data);
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');
    }

    public function ajax_list()
    {
        $list = $this->atm->get_datatables();
        $data = [];
        $no = $_POST['start'];

        foreach ($list as $atm) {
            $no++;
            $data[] = [
                'A' . $atm->atm_id,
                $atm->name,
                $atm->remarks,
                $atm->encoded,
                '<a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_atm(' . "'" . $atm->atm_id . "'" . ')"><i class="fas fa-pencil-alt"></i></a>
                 <a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_atm(' . "'" . $atm->atm_id . "'" . ', ' . "'" . $atm->name . "'" . ')"><i class="far fa-trash-alt"></i></a>'
            ];
        }

        echo json_encode([
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->atm->count_all(),
            'recordsFiltered' => $this->atm->count_filtered(),
            'data' => $data,
        ]);
    }

    public function ajax_edit($atm_id)
    {
        echo json_encode($this->atm->get_by_id($atm_id));
    }

    public function ajax_add()
    {
        $this->_validate();

        $data = [
            'name' => $this->input->post('name'),
            'branch' => '',
            'remarks' => $this->input->post('remarks'),
            'removed' => 0,
        ];

        $this->atm->save($data);

        echo json_encode(['status' => TRUE]);
    }

    public function ajax_update()
    {
        $this->_validate();

        $data = [
            'name' => $this->input->post('name'),
            'remarks' => $this->input->post('remarks'),
        ];

        $this->atm->update(['atm_id' => $this->input->post('atm_id')], $data);

        echo json_encode(['status' => TRUE]);
    }

    public function ajax_delete($atm_id)
    {
        $this->atm->update(['atm_id' => $atm_id], ['removed' => 1]);
        echo json_encode(['status' => TRUE]);
    }

    private function _validate()
    {
        $errors = [
            'error_string' => [],
            'inputerror' => [],
            'status' => TRUE,
        ];

        $name = $this->input->post('name');
        $current_name = $this->input->post('current_name');

        if (empty($name)) {
            $errors['inputerror'][] = 'name';
            $errors['error_string'][] = 'Bank name is required';
            $errors['status'] = FALSE;
        } elseif ($name !== $current_name) {
            $duplicates = $this->atm->get_duplicates($name);
            if ($duplicates->num_rows() > 0) {
                $errors['inputerror'][] = 'name';
                $errors['error_string'][] = 'Bank name is already registered';
                $errors['status'] = FALSE;
            }
        }

        if ($errors['status'] === FALSE) {
            echo json_encode($errors);
            exit();
        }
    }
}
