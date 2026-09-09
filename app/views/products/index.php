<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Products - Product Catalog</title>
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
			--row-alt: #fdf6fa;
			--success-bg: #eef8f2;
			--success-text: #4f9274;
			--error-bg: #fdedec;
			--error-text: #c1546a;
			--edit-bg: #f1e9fb;
			--edit-text: #7d5aa6;
			--delete-bg: #fdedec;
			--delete-text: #c1546a;
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

		.topbar .who {
			font-size: 14px;
			color: var(--mauve-grey);
		}

		.topbar a {
			color: var(--rose-deep);
			font-weight: 500;
			text-decoration: none;
			font-size: 14px;
		}

		.topbar a:hover { text-decoration: underline; }

		.wrap {
			max-width: 980px;
			margin: 0 auto;
			padding: 36px 24px 60px;
		}

		.page {
			opacity: 0;
			transform: translateY(12px);
			animation: rise 0.55s cubic-bezier(0.22, 1, 0.36, 1) forwards;
		}

		@keyframes rise {
			to { opacity: 1; transform: translateY(0); }
		}

		.alert {
			padding: 12px 16px;
			border-radius: 12px;
			font-size: 14px;
			margin-bottom: 20px;
		}
		.alert-error { background: var(--error-bg); color: var(--error-text); }
		.alert-success { background: var(--success-bg); color: var(--success-text); }

		.card {
			background: var(--card);
			border: 1px solid var(--line);
			border-radius: 20px;
			padding: 28px 30px;
			margin-bottom: 32px;
			box-shadow: 0 16px 36px -20px rgba(168, 84, 122, 0.22);
		}

		.card h1 {
			font-family: 'Fraunces', serif;
			font-weight: 600;
			font-size: 22px;
			margin: 0 0 20px;
			color: var(--rose-deep);
		}

		.card form label {
			display: block;
			font-size: 13px;
			font-weight: 500;
			margin: 0 0 6px;
			color: var(--plum);
		}

		.card form input,
		.card form textarea {
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

		.card form textarea {
			min-height: 90px;
			resize: vertical;
		}

		.card form input:focus,
		.card form textarea:focus {
			outline: none;
			border-color: var(--rose);
			box-shadow: 0 0 0 4px rgba(201, 111, 146, 0.14);
		}

		.card form button {
			padding: 11px 22px;
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

		.card form button:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 20px -8px rgba(168, 84, 122, 0.45);
		}

		h2 {
			font-family: 'Fraunces', serif;
			font-weight: 600;
			font-size: 19px;
			color: var(--plum);
			margin: 0 0 16px;
		}

		.table-wrap {
			background: var(--card);
			border: 1px solid var(--line);
			border-radius: 20px;
			overflow: hidden;
			box-shadow: 0 16px 36px -20px rgba(168, 84, 122, 0.18);
		}

		table {
			width: 100%;
			border-collapse: collapse;
			font-size: 14px;
		}

		thead th {
			text-align: left;
			padding: 14px 18px;
			font-weight: 500;
			font-size: 13px;
			color: var(--mauve-grey);
			background: var(--row-alt);
			border-bottom: 1px solid var(--line);
		}

		tbody td {
			padding: 14px 18px;
			border-bottom: 1px solid var(--line);
			color: var(--plum);
		}

		tbody tr:last-child td { border-bottom: none; }

		tbody tr:nth-child(even) { background: var(--row-alt); }

		tbody tr:hover { background: #faeef4; }

		.empty-row td {
			text-align: center;
			padding: 30px;
			color: var(--mauve-grey);
		}

		.actions {
			display: flex;
			gap: 8px;
			flex-wrap: wrap;
		}

		.action-link {
			padding: 6px 14px;
			border-radius: 999px;
			font-size: 13px;
			font-weight: 500;
			text-decoration: none;
			transition: transform 0.15s ease, box-shadow 0.15s ease;
			display: inline-block;
		}

		.action-edit {
			background: var(--edit-bg);
			color: var(--edit-text);
		}

		.action-delete {
			background: var(--delete-bg);
			color: var(--delete-text);
		}

		.action-link:hover {
			transform: translateY(-1px);
			box-shadow: 0 6px 14px -6px rgba(168, 84, 122, 0.35);
		}

		@media (max-width: 640px) {
			.topbar { flex-direction: column; align-items: flex-start; gap: 8px; }
			.table-wrap { overflow-x: auto; }
			table { min-width: 640px; }
		}
	</style>
</head>
<body>
	<div class="topbar">
		<span class="brand">Product Management</span>
		<span>
			<span class="who">Logged in as <strong><?= htmlspecialchars($username ?? '', ENT_QUOTES, 'UTF-8'); ?></strong></span>
			&nbsp;&middot;&nbsp;
			<a href="<?= site_url('auth/logout'); ?>">Logout</a>
		</span>
	</div>

	<div class="wrap">
		<div class="page">

			<?php if (!empty($success)): ?>
				<div class="alert alert-success"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></div>
			<?php endif; ?>

			<?php if (!empty($error)): ?>
				<div class="alert alert-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
			<?php endif; ?>

			<?php if (!empty($is_admin)): ?>
			<div class="card">
				<h1>Add a product</h1>
				<form action="<?= site_url('products/create'); ?>" method="post">
					<label for="product_name">Product Name</label>
					<input type="text" id="product_name" name="product_name" required>

					<label for="description">Description</label>
					<textarea id="description" name="description" required></textarea>

					<label for="price">Price</label>
					<input type="number" id="price" name="price" step="0.01" min="0" required>

					<label for="quantity">Quantity</label>
					<input type="number" id="quantity" name="quantity" min="0" required>

					<button type="submit">Add Product</button>
				</form>
			</div>
			<?php endif; ?>

			<h2>Product List</h2>
			<div class="table-wrap">
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Product Name</th>
							<th>Description</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Created At</th>
							<?php if (!empty($is_admin)): ?><th>Actions</th><?php endif; ?>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($products)): ?>
							<tr class="empty-row">
								<td colspan="<?= !empty($is_admin) ? '7' : '6'; ?>">No products yet.</td>
							</tr>
						<?php else: ?>
							<?php foreach ($products as $product): ?>
								<tr>
									<td><?= $product['id']; ?></td>
									<td><?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?= htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></td>
									<td><?= number_format((float) $product['price'], 2); ?></td>
									<td><?= $product['quantity']; ?></td>
									<td><?= htmlspecialchars($product['created_at'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
									<?php if (!empty($is_admin)): ?><td class="actions">
										<a class="action-link action-edit" href="<?= site_url('products/edit/' . $product['id']); ?>">Edit</a>
										<a class="action-link action-delete" href="<?= site_url('products/delete/' . $product['id']); ?>"
										   onclick="return confirm('Delete this product?');">Delete</a>
									</td>
									<?php endif; ?>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>