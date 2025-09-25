<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Login_controller
 *
 * Handles user authentication (login, logout) and logs system activities.
 *
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_URI $uri
 * @property CI_Output $output
 * @property CI_Router $router
 * @property CI_Config $config
 * @property CI_Lang $lang
 * @property Login_user_model $login_model
 * @property Logs_model $logs
 */
class Login_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login/Login_user_model', 'login_model');
		$this->load->model('Logs/Logs_model', 'logs');
	}

	/**
	 * Default login page.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('login_view');
	}

	/**
	 * Validate login form, authenticate user, and log attempts.
	 *
	 * @return void
	 */
	public function login_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$result   = $this->login_model->can_login($username, $password);

			if ($result !== false) {
				$user_data = [
					'user_id'       => $result->user_id,
					'username'      => $result->username,
					'lastname'      => $result->lastname,
					'firstname'     => $result->firstname,
					'administrator' => $result->administrator,
				];

				$log_type = 'Login';
				if ((int) $result->administrator === 1) {
					$this->session->set_userdata($user_data);
					$details = 'System user login as Administrator';
					$this->ajax_add_log($log_type, $details);
					redirect(base_url() . 'dashboard');
				} else {
					$log_type = 'Report';
					$details  = 'Admin Access Login as Client Attempt';
					$this->ajax_add_log($log_type, $details);
					$this->session->set_flashdata('error', '<strong>Login Error!</strong><br />Invalid username and password');
					redirect('/sudo');
				}
			} else {
				$log_type = 'Report';
				$details  = 'Failed Admin Access Login Attempt';
				$this->ajax_add_log($log_type, $details);
				$this->session->set_flashdata('error', '<strong>Login Error!</strong><br />Invalid username and password');
				redirect('/sudo');
			}
		} else {
			$this->session->set_flashdata('error', '<strong>Login Error!</strong><br />Enter your username and Password');
			redirect('/sudo');
		}
	}

	/**
	 * Check if user is logged in and redirect if not.
	 *
	 * @return void
	 */
	public function enter()
	{
		if ($this->session->userdata('username') !== '') {
			$data['username'] = $this->session->userdata('username');
		} else {
			redirect('/');
		}
	}

	/**
	 * Logout user, log activity, and destroy session.
	 *
	 * @return void
	 */
	public function logout()
	{
		$log_type = 'Logout';
		if ((int) $this->session->userdata('administrator') === 0) {
			$details = 'System user logout as Client';
		} else {
			$details = 'System user logout as Administrator';
		}

		$this->ajax_add_log($log_type, $details);
		$this->session->sess_destroy();
		redirect('/');
	}

	/**
	 * Add log entry via Logs_model.
	 *
	 * @param string $log_type
	 * @param string $details
	 * @return void
	 */
	public function ajax_add_log($log_type, $details)
	{
		$user_fullname = $this->session->userdata('lastname') . ', ' . $this->session->userdata('firstname');
		$data = [
			'user_fullname' => $user_fullname,
			'log_type'      => $log_type,
			'details'       => $details,
		];
		$this->logs->save($data);
	}
}
