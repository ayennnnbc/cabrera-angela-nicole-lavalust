<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: ProductController
 *
 * CRUD operations for the `products` table.
 * All actions are additionally protected by the 'auth' middleware
 * on the routes (see app/config/routes.php); is_logged_in() is
 * checked again here as a second line of defense.
 */
class ProductController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->call->model('ProductModel');
	}

	public function index()
	{
		if (!$this->auth->is_logged_in()) {
			redirect('auth/login');
			return;
		}

		$products = $this->ProductModel->all();

		$this->call->view('products/index', [
			'products' => $products,
			'username' => $this->auth->username(),
			'is_admin' => $this->auth->has_role('admin'),
			'success' => $this->session->flashdata('success'),
			'error' => $this->session->flashdata('error'),
		]);
	}

	public function create()
	{
		if (!$this->require_admin()) {
			return;
		}

		if ($this->request->is_post()) {
			$this->ProductModel->insert([
				'product_name' => $this->request->post('product_name'),
				'description'  => $this->request->post('description'),
				'price'        => $this->request->post('price'),
				'quantity'     => $this->request->post('quantity'),
			]);

			$this->session->set_flashdata('success', 'Product created successfully.');
			redirect('products');
			return;
		}

		redirect('products');
	}

	public function update($id)
	{
		if (!$this->require_admin()) {
			return;
		}

		$product = $this->ProductModel->find($id);

		if (!$product) {
			$this->session->set_flashdata('error', 'Product not found.');
			redirect('products');
			return;
		}

		if ($this->request->is_post()) {
			$this->ProductModel->update($id, [
				'product_name' => $this->request->post('product_name'),
				'description'  => $this->request->post('description'),
				'price'        => $this->request->post('price'),
				'quantity'     => $this->request->post('quantity'),
			]);

			$this->session->set_flashdata('success', 'Product updated successfully.');
			redirect('products');
			return;
		}

		$this->call->view('products/edit', [
			'product' => $product,
		]);
	}

	public function delete($id)
	{
		if (!$this->require_admin()) {
			return;
		}

		$this->ProductModel->delete($id);
		$this->session->set_flashdata('success', 'Product deleted successfully.');
		redirect('products');
	}

	private function require_admin()
	{
		if (!$this->auth->is_logged_in()) {
			redirect('auth/login');
			return false;
		}

		if (!$this->auth->has_role('admin')) {
			$this->session->set_flashdata('error', 'Only administrators can manage products.');
			redirect('products');
			return false;
		}

		return true;
	}
}
