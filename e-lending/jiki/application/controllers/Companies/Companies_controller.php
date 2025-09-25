<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Companies_model $companies
 * @property Users_model $users
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_URI $uri
 * @property CI_Output $output
 * @property CI_Config $config
 * @property CI_Language $lang
 */
class Companies_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Companies/Companies_model', 'companies');
        $this->load->model('Users/Users_model', 'users');
        $this->load->helper('url');
    }

    public function index()
    {
        // Check if user is logged in and is an administrator
        if (
            $this->session->userdata('user_id') === '' ||
            $this->session->userdata('administrator') === '0'
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

        $data['title'] = '<i class="far fa-building"></i> &nbsp; Companies';
        $this->load->view('template/dashboard_header', $data);
        $this->load->view('companies/companies_view', $data);
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');
    }

    public function ajax_list()
    {
        $list = $this->companies->get_datatables();
        $data = [];
        $no = $_POST['start'];

        foreach ($list as $company) {
            $no++;
            $row = [];
            $row[] = 'J' . $company->comp_id;
            $row[] = $company->name;
            $row[] = $company->address;
            $row[] = $company->remarks;
            $row[] = $company->encoded;
            $row[] = '
                <a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_company(\'' . $company->comp_id . '\')">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_company(\'' . $company->comp_id . '\', \'' . $company->name . '\')">
                    <i class="far fa-trash-alt"></i>
                </a>
            ';
            $data[] = $row;
        }

        echo json_encode([
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->companies->count_all(),
            'recordsFiltered' => $this->companies->count_filtered(),
            'data' => $data
        ]);
    }

    public function ajax_edit($comp_id)
    {
        $data = $this->companies->get_by_id($comp_id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();

        $data = [
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'remarks' => $this->input->post('remarks'),
            'removed' => 0
        ];

        $this->companies->save($data);
        echo json_encode(['status' => TRUE]);
    }

    public function ajax_update()
    {
        $this->_validate();

        $data = [
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'remarks' => $this->input->post('remarks')
        ];

        $this->companies->update(['comp_id' => $this->input->post('comp_id')], $data);
        echo json_encode(['status' => TRUE]);
    }

    public function ajax_delete($comp_id)
    {
        $this->companies->update(['comp_id' => $comp_id], ['removed' => 1]);
        echo json_encode(['status' => TRUE]);
    }

    private function _validate()
    {
        $data = [
            'error_string' => [],
            'inputerror' => [],
            'status' => TRUE
        ];

        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $current_name = $this->input->post('current_name');

        if ($name === '') {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Company name is required';
            $data['status'] = FALSE;
        } else {
            if ($current_name !== $name) {
                $duplicates = $this->companies->get_duplicates($name);
                if ($duplicates->num_rows() !== 0) {
                    $data['inputerror'][] = 'name';
                    $data['error_string'][] = 'Company name is already registered';
                    $data['status'] = FALSE;
                }
            }
        }

        if ($address === '') {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Company address is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit;
        }
    }
}
