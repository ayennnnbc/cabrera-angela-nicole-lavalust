<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * AuthMiddleware
 *
 * Blocks unauthenticated users from reaching the Product Management
 * (CRUD) pages, as required by Laboratory Exercise No. 5.
 */
class AuthMiddleware
{
	public function handle($next)
	{
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}

		if (!empty($_SESSION['logged_in'])) {
			return $next();
		}

		redirect(site_url('auth/login') . '?denied=1');
	}
}
