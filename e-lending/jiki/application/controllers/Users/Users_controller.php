<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Session               $session
 * @property CI_Input                 $input
 * @property CI_Loader                $load
 * @property CI_DB_query_builder      $db
 * @property Clients_model            $clients
 * @property Atm_model                $atm
 * @property Companies_model          $companies
 * @property Loans_model              $loans
 * @property Transactions_model       $transactions
 * @property Users_model              $users
 */
class Users_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users/Users_model', 'users');
	}

	public function index()
	{
		if (
			$this->session->userdata('user_id') == '' ||
			$this->session->userdata('administrator') == '0'
		) {
			redirect('error500');
		}

		$username_duplicates = $this->users->get_username_duplicates($this->session->userdata('username'));
		if ($username_duplicates->num_rows() === 0) {
			redirect('error500');
		}

		$this->load->helper('url');
		$data['title'] = '<i class="fas fa-user-shield"></i> &nbsp; Users';

		$this->load->view('template/dashboard_header', $data);
		$this->load->view('users/users_view', $data);
		$this->load->view('template/dashboard_navigation');
		$this->load->view('template/dashboard_footer');
	}

	public function ajax_list()
	{
		$list = $this->users->get_datatables();
		$data = [];
		$no = $_POST['start'];

		foreach ($list as $user) {
			$no++;
			$row = [];

			$row[] = 'U' . $user->user_id;
			$row[] = $user->administrator == 0 ? 'User' : 'Administrator';
			$row[] = '<b>' . $user->username . '</b>';
			$row[] = $user->lastname . ', ' . $user->firstname;
			$row[] = $user->client_id == '' ? 'n/a' : 'C' . $user->client_id;
			$row[] = $user->date_registered;

			if ($user->user_id == 101) {
				$row[] = $this->_action_buttons($user->user_id, true, true);
			} elseif ($user->client_id == '') {
				$row[] = $this->_action_buttons($user->user_id, false, false);
			} else {
				$row[] = $this->_action_buttons($user->user_id, false, true);
			}

			$data[] = $row;
		}

		$output = [
			'draw'            => $_POST['draw'],
			'recordsTotal'    => $this->users->count_all(),
			'recordsFiltered' => $this->users->count_filtered(),
			'data'            => $data,
		];

		echo json_encode($output);
	}

	public function ajax_edit($user_id)
	{
		$user = $this->users->get_by_id($user_id);
		if ($user) {
			unset($user->password); // Do not expose hashed password
			echo json_encode($user);
		} else {
			echo json_encode(['status' => false, 'error' => 'User not found']);
		}
	}

	public function ajax_add()
	{
		$this->_validate();

		$data = [
			'username'      => $this->input->post('username'),
			'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'lastname'      => $this->input->post('lastname'),
			'firstname'     => $this->input->post('firstname'),
			'contact'       => $this->input->post('contact'),
			'email'         => $this->input->post('email'),
			'address'       => $this->input->post('address'),
			'administrator' => '0',
			'removed'       => '0'
		];

		$this->users->save($data);
		echo json_encode(['status' => true]);
	}

	public function ajax_update()
	{
		$this->_validate();

		$data = [
			'username'  => $this->input->post('username'),
			'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'lastname'  => $this->input->post('lastname'),
			'firstname' => $this->input->post('firstname'),
			'contact'   => $this->input->post('contact'),
			'email'     => $this->input->post('email'),
			'address'   => $this->input->post('address')
		];

		$this->users->update(['user_id' => $this->input->post('user_id')], $data);
		echo json_encode(['status' => true]);
	}

	public function ajax_privileges_update()
	{
		if (
			$this->input->post('current_administrator') == '1' &&
			$this->input->post('administrator') == '0'
		) {
			$admin_count = $this->users->get_admin_count();

			if ($admin_count->num_rows() <= 2) {
				echo json_encode([
					'inputerror'   => ['administrator'],
					'error_string' => ['Unable to downgrade one remaining administrator account'],
					'status'       => false
				]);
				exit();
			}
		}

		$data = ['administrator' => $this->input->post('administrator')];
		$this->users->update(['user_id' => $this->input->post('user_id')], $data);

		echo json_encode(['status' => true]);
	}

	public function ajax_delete($user_id)
	{
		$is_admin = $this->users->get_user_admin($user_id);
		$username = $this->users->get_username($user_id);

		if ($username !== 'super_admin') {
			if ($is_admin == '1') {
				$admin_count = $this->users->get_admin_count();
				if ($admin_count->num_rows() > 2) {
					$this->users->update(['user_id' => $user_id], ['removed' => '1']);
					echo json_encode(['status' => true]);
				}
				// Prevent deletion of last admin
			} else {
				$this->users->update(['user_id' => $user_id], ['removed' => '1']);
				echo json_encode(['status' => true]);
			}
		}
	}

	private function _validate()
	{
		$post = $this->input->post();
		$errors = [
			'error_string' => [],
			'inputerror'   => [],
			'status'       => true
		];

		$addError = function (&$errors, $field, $message) {
			$errors['inputerror'][]   = $field;
			$errors['error_string'][] = $message;
			$errors['status']         = false;
		};

		$isNewUser = empty($post['id']) || $post['id'] == 0;

		if ($isNewUser) {
			if (empty($post['password'])) {
				$addError($errors, 'password', 'Password is required');
			}
			if (empty($post['repassword'])) {
				$addError($errors, 'repassword', 'Password is required');
			}
		}

		if (!empty($post['password']) && !empty($post['repassword']) && $post['password'] !== $post['repassword']) {
			$addError($errors, 'repassword', 'Password mismatch');
		}

		if (empty($post['username'])) {
			$addError($errors, 'username', 'Username is required');
		} elseif ($post['current_username'] !== $post['username']) {
			if ($this->users->get_username_duplicates($post['username'])->num_rows() > 0) {
				$addError($errors, 'username', 'Username is already registered');
			}
		}

		if (empty($post['firstname'])) {
			$addError($errors, 'firstname', 'First name is required');
		}

		if (empty($post['lastname'])) {
			$addError($errors, 'lastname', 'Last name is required');
		} else {
			$fullName = $post['lastname'] . $post['firstname'];
			if ($post['current_name'] !== $fullName) {
				if ($this->users->get_duplicates($post['lastname'], $post['firstname'])->num_rows() > 0) {
					$addError($errors, 'lastname', 'User full name is already registered');
				}
			}
		}

		if ($errors['status'] === false) {
			echo json_encode($errors);
			exit();
		}
	}

	private function _action_buttons($user_id, $disable_all = false, $disable_privileges = false)
	{
		$disabled_attr = $disable_all ? 'disabled' : '';
		$priv_attr     = $disable_privileges || $disable_all ? 'disabled' : '';

		return '
            <a class="btn btn-default" href="javascript:void(0)" title="View / Edit" onclick="view_edit_user(\'' . $user_id . '\')" ' . $disabled_attr . '><i class="far fa-eye"></i></a>
            <a class="btn btn-info" href="javascript:void(0)" title="Privileges" onclick="edit_privileges(\'' . $user_id . '\')" ' . $priv_attr . '><i class="fas fa-user-lock"></i></a>
            <a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_user(\'' . $user_id . '\')" ' . $disabled_attr . '><i class="far fa-trash-alt"></i></a>
        ';
	}
}
