<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: AuthController
 *
 * Handles registration, login, and logout for the Product
 * Management CRUD application (Laboratory Exercise No. 5).
 */
class AuthController extends Controller
{
	public function login()
	{
		$error = null;

		if ($this->request->is_post()) {
			$username = (string) $this->request->post('username');
			$password = (string) $this->request->post('password');

			if ($this->auth->login($username, $password)) {
				redirect('products');
				return;
			}

			$error = 'Invalid username or password.';
		}

		$this->call->view('auth/login', [
			'error'  => $error,
			'denied' => (bool) $this->request->get('denied'),
			'success' => $this->session->flashdata('success'),
		]);
	}

	public function register()
	{
		$error = null;
		$allowed_roles = ['user', 'admin'];

		if ($this->request->is_post()) {
			$username = trim((string) $this->request->post('username'));
			$password = (string) $this->request->post('password');
			$role     = (string) $this->request->post('role');

			if ($username === '' || $password === '') {
				$error = 'Username and password are required.';
			} elseif (strlen($password) < 6) {
				$error = 'Password must be at least 6 characters.';
			} elseif (!in_array($role, $allowed_roles, true)) {
				$error = 'Please select a valid role.';
			} else {
				$result = $this->auth->register($username, $password, $role);

				if ($result === true) {
					$this->session->set_flashdata('success', 'Account created successfully. You may now log in.');
					redirect('auth/login');
					return;
				}

				$error = $result;
			}
		}

		$this->call->view('auth/register', [
			'error' => $error,
		]);
	}

	public function logout()
	{
		$this->auth->logout();
		redirect('auth/login');
	}
}