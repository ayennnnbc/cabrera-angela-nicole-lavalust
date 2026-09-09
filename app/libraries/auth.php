<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Library: Auth
 *
 * Simple session-based authentication used to protect the
 * Product Management (CRUD) pages required by Laboratory Exercise No. 5.
 *
 * Accounts are kept as static credentials for this exercise.
 */
class Auth
{
	protected $_lava;

	protected $accounts = [
		'user' => ['password' => 'user123', 'role' => 'user'],
		'admin' => ['password' => 'admin123', 'role' => 'admin'],
	];

	public function __construct()
	{
		$this->_lava = lava_instance();
		$this->_lava->call->library('session');
		$this->_lava->call->model('CrudUserModel');
	}

	/**
	 * Attempt to log a user in
	 *
	 * @param string $username
	 * @param string $password
	 * @return bool
	 */
	public function login($username, $password)
	{
		$user = $this->accounts[$username] ?? null;

		if ($user && hash_equals($user['password'], $password)) {
			$this->_lava->session->set_userdata([
				'username'  => $username,
				'role'      => $user['role'],
				'logged_in' => true,
			]);
			return true;
		}

		// Check registered (database) accounts.
		$db_user = $this->_lava->CrudUserModel->find_by('username', $username);

		if ($db_user && password_verify($password, $db_user['password'])) {
			$this->_lava->session->set_userdata([
				'username'  => $db_user['username'],
				'role'      => $db_user['role'],
				'logged_in' => true,
			]);
			return true;
		}

		return false;
	}

	/**
	 * Register a new account in the crud_user table
	 *
	 * @param string $username
	 * @param string $password
	 * @return true|string  true on success, or an error message string
	 */
	public function register($username, $password)
	{
		if (isset($this->accounts[$username])) {
			return 'Username already exists. Please choose another.';
		}

		if ($this->_lava->CrudUserModel->find_by('username', $username)) {
			return 'Username already exists. Please choose another.';
		}

		$this->_lava->CrudUserModel->insert([
			'username' => $username,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'role'     => 'user',
		]);

		return true;
	}

	/**
	 * Check whether a user is currently logged in
	 *
	 * @return bool
	 */
	public function is_logged_in()
	{
		return (bool) $this->_lava->session->userdata('logged_in');
	}

	/**
	 * Check the logged-in user's role
	 *
	 * @param string $role
	 * @return bool
	 */
	public function has_role($role)
	{
		return strtolower((string) $this->_lava->session->userdata('role')) === strtolower($role);
	}

	/**
	 * Get the currently logged-in username (or null)
	 *
	 * @return string|null
	 */
	public function username()
	{
		return $this->_lava->session->userdata('username');
	}

	/**
	 * Log the current user out
	 *
	 * @return void
	 */
	public function logout()
	{
		$this->_lava->session->unset_userdata(['username', 'role', 'logged_in']);
	}
}
