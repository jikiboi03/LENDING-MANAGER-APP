<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users/Users_model','users');
	}

	public function index()
	{
		// check if logged in and admin
		if($this->session->userdata('user_id') == '' || $this->session->userdata('administrator') == '0')
		{
          redirect('error500');
        }

		// validate if username already exist in the database table
        $username_duplicates = $this->users->get_username_duplicates($this->session->userdata('username'));

        if ($username_duplicates->num_rows() == 0)
        {
            redirect('error500');
        }

		$this->load->helper('url');							
		
	   	$data['title'] = '<i class="fas fa-user-shield"></i> &nbsp; Users';	
	   	$this->load->view('template/dashboard_header', $data);
	    $this->load->view('users/users_view', $data);		// mao lang ni ang replaceable
	    $this->load->view('template/dashboard_navigation');
	    $this->load->view('template/dashboard_footer'); 
	}

	public function ajax_list()
	{
		$list = $this->users->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $users) {
			$no++;
			$row = array();
			$row[] = 'U' . $users->user_id;

			// check if the user is admin
			if ($users->administrator == 0){
				$row[] = 'User';
			}else{
				$row[] = 'Administrator';
			}

			$row[] = '<b>' . $users->username . '</b>';
			// $row[] = $users->password;
            $row[] = $users->lastname;
            $row[] = $users->firstname;

            if ($users->client_id == '')
            {
            	$row[] = 'n/a';
            }
            else
            {
            	$row[] = 'C' . $users->client_id;
            }
            
			// $row[] = $users->contact;
			// $row[] = $users->email;
			// $row[] = $users->address;
			$row[] = $users->date_registered;

			if ($users->user_id == 101)
			{
				//add html for action
				$row[] = ' <a class="btn btn-primary" href="javascript:void(0)" title="View / Edit" onclick="view_edit_user('."'".$users->user_id."'".')" disabled><i class="far fa-eye"></i></a>

							<a class="btn btn-success" href="javascript:void(0)" title="Privileges" onclick="edit_privileges('."'".$users->user_id."'".')" disabled><i class="fas fa-user-lock"></i></a>
							
					  		<a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_user('."'".$users->user_id."'".')" disabled><i class="far fa-trash-alt"></i></a>';
			}
			else
			{
				if ($users->client_id == "")
            	{
            		//add html for action
            		$row[] = ' <a class="btn btn-primary" href="javascript:void(0)" title="View / Edit" onclick="view_edit_user('."'".$users->user_id."'".')"><i class="far fa-eye"></i></a>

            					<a class="btn btn-success" href="javascript:void(0)" title="Privileges" onclick="edit_privileges('."'".$users->user_id."'".')"><i class="fas fa-user-lock"></i></a>
            					
            			  		<a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_user('."'".$users->user_id."'".')"><i class="far fa-trash-alt"></i></a>';
				}
				else
				{
					//add html for action
					$row[] = ' <a class="btn btn-primary" href="javascript:void(0)" title="View / Edit" onclick="view_edit_user('."'".$users->user_id."'".')"><i class="far fa-eye"></i></a>

								<a class="btn btn-success" href="javascript:void(0)" title="Privileges" onclick="edit_privileges('."'".$users->user_id."'".')" disabled><i class="fas fa-user-lock"></i></a>
								
						  		<a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_user('."'".$users->user_id."'".')"><i class="far fa-trash-alt"></i></a>';
				}
			}
		
			$data[] = $row;
		}

		$output = array(
						'draw' => $_POST['draw'],
						'recordsTotal' => $this->users->count_all(),
						'recordsFiltered' => $this->users->count_filtered(),
						'data' => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($user_id)
	{
		$data = $this->users->get_by_id($user_id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		//$this->_validate_password();
		$data = array(
				'username' => $this->input->post('username'),
		        'password' => $this->input->post('password'),
		        'lastname' => $this->input->post('lastname'),
		        'firstname' => $this->input->post('firstname'),
		        'contact' => $this->input->post('contact'),
		        'email' => $this->input->post('email'),
		        'address' => $this->input->post('address'),
		        'administrator' => '0',
				'removed' => '0'
			);
		$insert = $this->users->save($data);
		echo json_encode(array('status' => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		//$this->_validate_password();
		$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
		        'lastname' => $this->input->post('lastname'),
		        'firstname' => $this->input->post('firstname'),
		        'contact' => $this->input->post('contact'),
		        'email' => $this->input->post('email'),
		        'address' => $this->input->post('address')	        
			);
		$this->users->update(array('user_id' => $this->input->post('user_id')), $data);
		echo json_encode(array('status' => TRUE));
	}

	public function ajax_privileges_update()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		// check if the user edited is currently an administrator
		if ($this->input->post('current_administrator') == '1' && $this->input->post('administrator') == '0' )
		{
			// check for users with administrator set as '1'
	        $admin_count = $this->users->get_admin_count();

	        // reject if only 1 remaining 
	        if ($admin_count->num_rows() <= 2)
	        {
	        	$data['inputerror'][] = 'administrator';
				$data['error_string'][] = 'Unable to downgrade one remaining administrator account';
				$data['status'] = FALSE;

				if($data['status'] === FALSE)
				{
					echo json_encode($data);
					exit();
				}
	        }
	        // allow if more than 1 admin
            else
            {
				$data = array(
					'administrator' => $this->input->post('administrator'),
					
					
					//'report' => $this->input->post('report')
					  	);
				$this->users->update(array('user_id' => $this->input->post('user_id')), $data);
				echo json_encode(array('status' => TRUE));	
            }
		}
		// if the user is currently not an administrator
		else
		{
			$data = array(
				'administrator' => $this->input->post('administrator'),
				
				//'report' => $this->input->post('report')
			  	);
			$this->users->update(array('user_id' => $this->input->post('user_id')), $data);
			echo json_encode(array('status' => TRUE));
		}
	}

	public function ajax_delete($user_id)
	{
		// check if atleast one admin remains
		// check if the user is an admin
		$is_admin = $this->users->get_user_admin($user_id);
		$username = $this->users->get_username($user_id);

		// check if username is not 'admin'
		if ($username != 'super_admin')
		{
			// check if the user to be deleted is an administrator
	        if ($is_admin == '1')
	        {
	            // check for users with administrator set as '1'
	            $admin_count = $this->users->get_admin_count();

	            // allow if more than 1 admin
	            if ($admin_count->num_rows() > 2)
	            {
	                $data = array(
	                'removed' => '1'
			            );
					$this->users->update(array('user_id' => $user_id), $data);
					echo json_encode(array('status' => TRUE));
	            } 
	            // reject if only 1 remaining -> refer to custom_ajax_datatable.js delete_user
	        }
	        // if not admin
	        else
	        {
	        	$data = array(
	            'removed' => '1'
		            );
				$this->users->update(array('user_id' => $user_id), $data);
				echo json_encode(array('status' => TRUE));
	        }
		}
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		///---------------password validation start
		if($this->input->post('password') == '' AND $this->input->post('id')== 0 ){
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Password is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('repassword') == '' AND $this->input->post('id')== 0){
			$data['inputerror'][] = 'repassword';
			$data['error_string'][] = 'Password is required';
			$data['status'] = FALSE;
		}
		// match password to retyped password
		if($this->input->post('password') != $this->input->post('repassword')){
			$data['inputerror'][] = 'repassword';
			$data['error_string'][] = 'Password mismatch';
			$data['status'] = FALSE;
		}
		///---------------password validation end

		if($this->input->post('username') == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Username is required';
			$data['status'] = FALSE;
		}
		// validation for duplicates
        else
        {
            $new_username = $this->input->post('username');
            // check if name has a new value or not
            if ($this->input->post('current_username') != $new_username)
            {
                // validate if name already exist in the database table
                $username_duplicates = $this->users->get_username_duplicates($this->input->post('username'));

                if ($username_duplicates->num_rows() != 0)
                {
                    $data['inputerror'][] = 'username';
                    $data['error_string'][] = 'Username is already registered';
                    $data['status'] = FALSE;
                }
            }
        }

		
		if($this->input->post('firstname') == '')
		{
			$data['inputerror'][] = 'firstname';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('lastname') == '')
		{
			$data['inputerror'][] = 'lastname';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}
		// validation for duplicates
        else
        {
            $new_name = $this->input->post('lastname') . $this->input->post('firstname');
            // check if name has a new value or not
            if ($this->input->post('current_name') != $new_name)
            {
                // validate if name already exist in the databaase table
                $duplicates = $this->users->get_duplicates($this->input->post('lastname'), $this->input->post('firstname'));

                if ($duplicates->num_rows() != 0)
                {
                    $data['inputerror'][] = 'lastname';
                    $data['error_string'][] = 'User full name is already registered';
                    $data['status'] = FALSE;
                }
            }
        }


		if($this->input->post('contact') == '')
		{
			$data['inputerror'][] = 'contact';
			$data['error_string'][] = 'Contact is required';
			$data['status'] = FALSE;

		}

		if($this->input->post('email') == '')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Email is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('address') == '')
		{
			$data['inputerror'][] = 'address';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}	
}
