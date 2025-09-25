<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class Login_user_model extends CI_Model
{
	var $table = 'users';

	function can_login($username, $password)
	{
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->where('removed', 0);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$user = $query->row();
			$stored = $user->password;
			if (
				// Check hashed
				password_verify($password, $stored) ||
				// Temporarily accept plain-text (for old users)
				$password === $stored
			) {
				// 🔐 If matched with plain, update to hashed now
				if ($password === $stored) {
					$this->db->where('user_id', $user->user_id);
					$this->db->update($this->table, [
						'password' => password_hash($password, PASSWORD_DEFAULT)
					]);
				}

				return $user;
			}
		}
		return false;
	}
}
