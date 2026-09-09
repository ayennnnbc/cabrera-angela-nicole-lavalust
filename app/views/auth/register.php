<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register - Product Catalog</title>
	<link rel="stylesheet" href="<?= base_url('assets/crud.css'); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
	<style>
		:root {
			--blush: #fdf2f7;
			--lilac: #f2e9fb;
			--card: #fffdfe;
			--rose: #c96f92;
			--rose-deep: #a8547a;
			--plum: #4a3b47;
			--mauve-grey: #8d7f8a;
			--line: #f0dfe8;
			--error-bg: #fdedec;
			--error-text: #c1546a;
		}

		@media (prefers-reduced-motion: reduce) {
			*, *::before, *::after {
				animation-duration: 0.01ms !important;
				animation-iteration-count: 1 !important;
				transition-duration: 0.01ms !important;
			}
		}

		.login-body {
			margin: 0;
			min-height: 100vh;
			font-family: 'Poppins', sans-serif;
			color: var(--plum);
			background: linear-gradient(160deg, var(--blush) 0%, var(--lilac) 100%);
			display: flex;
			align-items: center;
			justify-content: center;
			position: relative;
			overflow: hidden;
			padding: 24px;
			box-sizing: border-box;
		}

		.blob {
			position: absolute;
			border-radius: 50%;
			filter: blur(2px);
			opacity: 0.5;
			animation: drift 14s ease-in-out infinite;
		}
		.blob-a {
			width: 260px;
			height: 260px;
			background: radial-gradient(circle at 30% 30%, #f4c9dc, transparent 70%);
			top: -80px;
			left: -60px;
		}
		.blob-b {
			width: 320px;
			height: 320px;
			background: radial-gradient(circle at 60% 60%, #dcc7f0, transparent 70%);
			bottom: -100px;
			right: -80px;
			animation-delay: -6s;
		}

		@keyframes drift {
			0%, 100% { transform: translate(0, 0) scale(1); }
			50% { transform: translate(14px, -18px) scale(1.05); }
		}

		.login-wrap {
			position: relative;
			z-index: 1;
			width: 100%;
			max-width: 380px;
		}

		.login-card {
			background: var(--card);
			border-radius: 22px;
			padding: 40px 36px;
			box-shadow: 0 18px 40px -18px rgba(168, 84, 122, 0.28);
			border: 1px solid var(--line);
			opacity: 0;
			transform: translateY(14px);
			animation: rise 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
		}

		@keyframes rise {
			to { opacity: 1; transform: translateY(0); }
		}

		.login-card h1 {
			font-family: 'Fraunces', serif;
			font-weight: 600;
			font-size: 30px;
			margin: 0 0 6px;
			color: var(--rose-deep);
		}

		.login-card .lead {
			margin: 0 0 28px;
			font-size: 14px;
			color: var(--mauve-grey);
		}

		.alert {
			padding: 11px 14px;
			border-radius: 12px;
			font-size: 13px;
			margin-bottom: 18px;
			animation: rise 0.4s ease forwards;
		}
		.alert-error { background: var(--error-bg); color: var(--error-text); }

		.field {
			margin-bottom: 20px;
			text-align: left;
		}

		.login-card label {
			display: block;
			font-size: 13px;
			font-weight: 500;
			color: var(--plum);
			margin-bottom: 6px;
		}

		.login-card input {
			width: 100%;
			box-sizing: border-box;
			padding: 11px 14px;
			border-radius: 12px;
			border: 1.5px solid var(--line);
			background: #fffafd;
			font-family: 'Poppins', sans-serif;
			font-size: 14px;
			color: var(--plum);
			transition: border-color 0.2s ease, box-shadow 0.2s ease;
		}

		.login-card input:focus {
			outline: none;
			border-color: var(--rose);
			box-shadow: 0 0 0 4px rgba(201, 111, 146, 0.14);
		}

		.login-card select {
			width: 100%;
			box-sizing: border-box;
			padding: 11px 14px;
			border-radius: 12px;
			border: 1.5px solid var(--line);
			background: #fffafd url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8"><path d="M1 1l5 5 5-5" fill="none" stroke="%23a8547a" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>') no-repeat right 14px center;
			appearance: none;
			-webkit-appearance: none;
			font-family: 'Poppins', sans-serif;
			font-size: 14px;
			color: var(--plum);
			cursor: pointer;
			transition: border-color 0.2s ease, box-shadow 0.2s ease;
		}

		.login-card select:focus {
			outline: none;
			border-color: var(--rose);
			box-shadow: 0 0 0 4px rgba(201, 111, 146, 0.14);
		}

		.login-card button {
			width: 100%;
			padding: 12px 14px;
			margin-top: 6px;
			border: none;
			border-radius: 12px;
			background: linear-gradient(135deg, var(--rose) 0%, var(--rose-deep) 100%);
			color: #fff;
			font-family: 'Poppins', sans-serif;
			font-weight: 500;
			font-size: 15px;
			cursor: pointer;
			transition: transform 0.18s ease, box-shadow 0.18s ease;
		}

		.login-card button:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 20px -8px rgba(168, 84, 122, 0.45);
		}

		.login-card button:active {
			transform: translateY(0);
		}

		.foot-note {
			text-align: center;
			font-size: 13px;
			color: var(--mauve-grey);
			margin: 20px 0 0;
		}

		.foot-note a {
			color: var(--rose-deep);
			font-weight: 500;
			text-decoration: none;
		}

		.foot-note a:hover {
			text-decoration: underline;
		}
	</style>
</head>
<body class="login-body">
	<div class="blob blob-a"></div>
	<div class="blob blob-b"></div>

	<div class="login-wrap">
		<div class="login-card">
			<h1>Create an account</h1>
			<p class="lead">Sign up to access the product catalog.</p>

			<?php if (!empty($error)): ?>
				<div class="alert alert-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
			<?php endif; ?>

			<form action="<?= site_url('auth/register'); ?>" method="post">
				<div class="field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username" required autofocus>
				</div>

				<div class="field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" required minlength="6">
				</div>

				<div class="field">
					<label for="role">Role</label>
					<select id="role" name="role" required>
						<option value="user">User</option>
						<option value="admin">Admin</option>
					</select>
				</div>

				<button type="submit">Register</button>
			</form>

			<p class="foot-note">Already have an account? <a href="<?= site_url('auth/login'); ?>">Log in</a></p>
		</div>
	</div>
</body>
</html>