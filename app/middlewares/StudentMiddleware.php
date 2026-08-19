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
		redirect(site_url('student'));
	}
}
?>
