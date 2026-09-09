<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Product - Product Catalog</title>
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
		}

		@media (prefers-reduced-motion: reduce) {
			*, *::before, *::after {
				animation-duration: 0.01ms !important;
				animation-iteration-count: 1 !important;
				transition-duration: 0.01ms !important;
			}
		}

		* { box-sizing: border-box; }

		body {
			margin: 0;
			min-height: 100vh;
			font-family: 'Poppins', sans-serif;
			color: var(--plum);
			background: linear-gradient(160deg, var(--blush) 0%, var(--lilac) 100%);
			background-attachment: fixed;
		}

		.topbar {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 18px 32px;
			background: var(--card);
			border-bottom: 1px solid var(--line);
			position: sticky;
			top: 0;
			z-index: 10;
		}

		.topbar .brand {
			font-family: 'Fraunces', serif;
			font-weight: 600;
			font-size: 20px;
			color: var(--rose-deep);
		}

		.topbar a {
			color: var(--rose-deep);
			font-weight: 500;
			text-decoration: none;
			font-size: 14px;
		}

		.topbar a:hover { text-decoration: underline; }

		.wrap {
			max-width: 560px;
			margin: 0 auto;
			padding: 48px 24px 60px;
		}

		.auth-card {
			background: var(--card);
			border: 1px solid var(--line);
			border-radius: 22px;
			padding: 36px 34px;
			box-shadow: 0 18px 40px -18px rgba(168, 84, 122, 0.24);
			opacity: 0;
			transform: translateY(14px);
			animation: rise 0.55s cubic-bezier(0.22, 1, 0.36, 1) forwards;
		}

		@keyframes rise {
			to { opacity: 1; transform: translateY(0); }
		}

		.auth-card h1 {
			font-family: 'Fraunces', serif;
			font-weight: 600;
			font-size: 24px;
			margin: 0 0 24px;
			color: var(--rose-deep);
		}

		.auth-card label {
			display: block;
			font-size: 13px;
			font-weight: 500;
			margin: 0 0 6px;
			color: var(--plum);
		}

		.auth-card input,
		.auth-card textarea {
			width: 100%;
			padding: 11px 14px;
			border-radius: 12px;
			border: 1.5px solid var(--line);
			background: #fffafd;
			font-family: 'Poppins', sans-serif;
			font-size: 14px;
			color: var(--plum);
			margin-bottom: 18px;
			transition: border-color 0.2s ease, box-shadow 0.2s ease;
		}

		.auth-card textarea {
			min-height: 100px;
			resize: vertical;
		}

		.auth-card input:focus,
		.auth-card textarea:focus {
			outline: none;
			border-color: var(--rose);
			box-shadow: 0 0 0 4px rgba(201, 111, 146, 0.14);
		}

		.form-actions {
			display: flex;
			align-items: center;
			gap: 14px;
			margin-top: 4px;
		}

		.auth-card button {
			padding: 11px 24px;
			border: none;
			border-radius: 12px;
			background: linear-gradient(135deg, var(--rose) 0%, var(--rose-deep) 100%);
			color: #fff;
			font-family: 'Poppins', sans-serif;
			font-weight: 500;
			font-size: 14px;
			cursor: pointer;
			transition: transform 0.18s ease, box-shadow 0.18s ease;
		}

		.auth-card button:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 20px -8px rgba(168, 84, 122, 0.45);
		}

		.btn-quiet {
			color: var(--mauve-grey);
			text-decoration: none;
			font-size: 14px;
			font-weight: 500;
			transition: color 0.15s ease;
		}

		.btn-quiet:hover {
			color: var(--rose-deep);
			text-decoration: underline;
		}
	</style>
</head>
<body>
	<div class="topbar">
		<span class="brand">Product Management</span>
		<a href="<?= site_url('products'); ?>">&larr; Back to products</a>
	</div>

	<div class="wrap">
		<div class="auth-card">
			<h1>Edit product</h1>
			<form action="<?= site_url('products/edit/' . $product['id']); ?>" method="post">
				<label for="product_name">Product Name</label>
				<input type="text" id="product_name" name="product_name"
					   value="<?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?>" required>

				<label for="description">Description</label>
				<textarea id="description" name="description" required><?= htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></textarea>

				<label for="price">Price</label>
				<input type="number" id="price" name="price" step="0.01" min="0"
					   value="<?= htmlspecialchars((string) $product['price'], ENT_QUOTES, 'UTF-8'); ?>" required>

				<label for="quantity">Quantity</label>
				<input type="number" id="quantity" name="quantity" min="0"
					   value="<?= htmlspecialchars((string) $product['quantity'], ENT_QUOTES, 'UTF-8'); ?>" required>

				<div class="form-actions">
					<button type="submit">Update Product</button>
					<a class="btn-quiet" href="<?= site_url('products'); ?>">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</body>
</html>