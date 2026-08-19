<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
	public function handle($next)
	{
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}

		// Simple access condition for this activity.
		// The student must visit the /student page first,
		// which sets $_SESSION['student_access'] = true.
		if (isset($_SESSION['student_access']) && $_SESSION['student_access'] === true) {
			return $next();
		}

		// Not allowed yet, send them back to the student page.
		// The ?denied=1 flag lets the home view show a visible message,
		// so the redirect is provable in a single screenshot.
		redirect(site_url('student') . '?denied=1');
	}
}
?>
