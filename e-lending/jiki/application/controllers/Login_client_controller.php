<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * @property CI_Session $session
 * @property CI_Input $input
 * @property CI_Form_validation $form_validation
 * @property CI_Loader $load
 * @property Login_user_model $login_model
 * @property Logs_model $logs
 */
class Login_client_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login/Login_user_model', 'login_model');
		$this->load->model('Logs/Logs_model', 'logs');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('login_client_view');
	}

	public function login_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$result = $this->login_model->can_login($username, $password);

			if ($result != false) {
				$user_data = [
					'user_id'       => $result->user_id,
					'username'      => $result->username,
					'lastname'      => $result->lastname,
					'firstname'     => $result->firstname,
					'administrator' => $result->administrator
				];

				$log_type = 'Login';

				if ($result->administrator == 0) {
					$this->session->set_userdata($user_data);
					$details = 'System user login as Client';
					$this->ajax_add_log($log_type, $details);
					redirect(base_url() . 'client-portal-page/' . $result->client_id);
				} else {
					$log_type = 'Report';
					$details = 'Client Access Login as Admin Attempt';
					$this->ajax_add_log($log_type, $details);
					$this->session->set_flashdata('error', '<strong>Login Error!</strong><br />Invalid username and password');
					redirect('/');
				}
			} else {
				$log_type = 'Report';
				$details = 'Failed Client Access Login Attempt';
				$this->ajax_add_log($log_type, $details);
				$this->session->set_flashdata('error', '<strong>Login Error!</strong><br />Invalid username and password');
				redirect('/');
			}
		} else {
			$this->session->set_flashdata('error', '<strong>Login Error!</strong><br />Enter your username and password');
			redirect('/');
		}
	}

	public function enter()
	{
		if ($this->session->userdata('username') != '') {
			$data['username'] = $this->session->userdata('username');
		} else {
			redirect('/');
		}
	}

	public function logout()
	{
		$log_type = 'Logout';

		if ($this->session->userdata('administrator') == 0) {
			$details = 'System user logout as Client';
		} else {
			$details = 'System user logout as Administrator';
		}

		$this->ajax_add_log($log_type, $details);
		$this->session->sess_destroy();
		redirect('/');
	}

	public function ajax_add_log($log_type, $details)
	{
		$user_fullname = $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname');

		$data = [
			'user_fullname' => $user_fullname,
			'log_type'      => $log_type,
			'details'       => $details
		];

		$this->logs->save($data);
	}
}
