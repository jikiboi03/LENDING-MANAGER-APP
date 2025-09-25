<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_DB_query_builder $db
 * @property Clients_model $clients
 * @property Atm_model $atm
 * @property Companies_model $companies
 * @property Loans_model $loans
 * @property Users_model $users
 */
class Clients_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Clients/Clients_model', 'clients');
        $this->load->model('Atm/Atm_model', 'atm');
        $this->load->model('Companies/Companies_model', 'companies');
        $this->load->model('Loans/Loans_model', 'loans');
        $this->load->model('Users/Users_model', 'users');
    }

    public function index()
    {
        // Check if logged in and admin
        if (
            $this->session->userdata('user_id') == '' ||
            $this->session->userdata('administrator') == '0'
        ) {
            redirect('error500');
        }

        // Validate if username already exists
        $username_duplicates = $this->users->get_username_duplicates($this->session->userdata('username'));
        if ($username_duplicates->num_rows() == 0) {
            redirect('error500');
        }

        // Load companies and ATM banks for dropdown
        $data['companies'] = $this->companies->get_companies();
        $data['atm'] = $this->atm->get_atm();
        $data['title'] = '<i class="fas fa-users"></i> &nbsp; Clients';

        $this->load->helper('url');
        $this->load->view('template/dashboard_header', $data);
        $this->load->view('clients/clients_view', $data);
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');
    }

    public function ajax_list()
    {
        $list = $this->clients->get_datatables();
        $data = [];
        $no = $_POST['start'];

        foreach ($list as $client) {
            $no++;
            $row = [];

            $row[] = 'C' . $client->client_id;
            $row[] = $client->lname . ', ' . $client->fname;

            $loan_balance = $this->loans->get_client_total_balance($client->client_id);
            $row[] = $loan_balance == 0 ? '-' : '<i>₱ ' . number_format($loan_balance, 2, '.', ',') . '</i>';

            $row[] = '<u><b>' . $client->pin . '</b></u>';
            $row[] = $client->contact;
            $row[] = $this->atm->get_atm_name($client->atm_id);
            $row[] = $this->companies->get_company_name($client->comp_id);

            $row[] = '
                <a class="btn btn-default" href="' . base_url("profiles-page/" . $client->client_id) . '" title="View"><i class="far fa-eye"></i></a>
                <a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_client(\'' . $client->client_id . '\')"><i class="fas fa-pencil-alt"></i></a>
                <a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_client(\'' . $client->client_id . '\')"><i class="far fa-trash-alt"></i></a>
            ';

            $row[] = $client->sex;

            // Determine if client has active loan
            $active_loan = $this->loans->has_active_loan($client->client_id);
            $row[] = $active_loan->num_rows() != 0 ? 'active' : 'inactive';

            $data[] = $row;
        }

        $output = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->clients->count_all(),
            'recordsFiltered' => $this->clients->count_filtered(),
            'data' => $data,
        ];

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

        $client_data = [
            'lname'     => $this->input->post('lname'),
            'fname'     => $this->input->post('fname'),
            'contact'   => $this->input->post('contact'),
            'comp_id'   => $this->input->post('comp_id'),
            'atm_id'    => $this->input->post('atm_id'),
            'atm_type'  => $this->input->post('atm_type'),
            'pin'       => $this->input->post('pin'),
            'sex'       => $this->input->post('sex'),
            'job'       => $this->input->post('job'),
            'salary'    => $this->input->post('salary'),
            'address'   => $this->input->post('address'),
            'remarks'   => $this->input->post('remarks'),
            'removed'   => 0,
        ];

        $client_id = $this->clients->save($client_data);

        $user_data = [
            'username'      => $this->input->post('lname'),
            'password'      => $this->input->post('pin'),
            'lastname'      => $this->input->post('lname'),
            'firstname'     => $this->input->post('fname'),
            'client_id'     => $client_id,
            'administrator' => '0',
            'removed'       => '0',
        ];

        $this->users->save($user_data);

        echo json_encode(['status' => true]);
    }

    public function ajax_update()
    {
        $this->_validate();

        $data = [
            'lname'     => $this->input->post('lname'),
            'fname'     => $this->input->post('fname'),
            'contact'   => $this->input->post('contact'),
            'comp_id'   => $this->input->post('comp_id'),
            'atm_id'    => $this->input->post('atm_id'),
            'atm_type'  => $this->input->post('atm_type'),
            'pin'       => $this->input->post('pin'),
            'sex'       => $this->input->post('sex'),
            'job'       => $this->input->post('job'),
            'salary'    => $this->input->post('salary'),
            'address'   => $this->input->post('address'),
            'remarks'   => $this->input->post('remarks'),
        ];

        $this->clients->update(['client_id' => $this->input->post('client_id')], $data);

        echo json_encode(['status' => true]);
    }

    public function ajax_delete($client_id)
    {
        $this->clients->update(['client_id' => $client_id], ['removed' => '1']);
        echo json_encode(['status' => true]);
    }

    private function _validate()
    {
        $data = [
            'error_string' => [],
            'inputerror'   => [],
            'status'       => true,
        ];

        $required_fields = [
            'lname'     => 'Last name',
            'fname'     => 'First name',
            'contact'   => 'Contact',
            'comp_id'   => 'Company',
            'atm_id'    => 'ATM bank',
            'atm_type'  => 'ATM type',
            'pin'       => 'ATM PIN',
            'sex'       => 'Gender',
            'job'       => 'Job',
            'salary'    => 'Salary',
            'address'   => 'Address',
        ];

        foreach ($required_fields as $field => $label) {
            if ($this->input->post($field) === '') {
                $data['inputerror'][] = $field;
                $data['error_string'][] = "$label is required";
                $data['status'] = false;
            }
        }

        // Duplicate name check (lname+fname)
        if ($data['status']) {
            $new_name = $this->input->post('lname') . $this->input->post('fname');
            if ($this->input->post('current_name') !== $new_name) {
                $duplicates = $this->clients->get_duplicates(
                    $this->input->post('lname'),
                    $this->input->post('fname')
                );

                if ($duplicates->num_rows() > 0) {
                    $data['inputerror'][] = 'lname';
                    $data['error_string'][] = 'Client name (full name) is already registered';
                    $data['status'] = false;
                }
            }
        }

        if (!$data['status']) {
            echo json_encode($data);
            exit();
        }
    }
}
