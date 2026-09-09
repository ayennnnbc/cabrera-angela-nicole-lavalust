<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: ProductModel
 *
 * Handles CRUD access to the `products` table.
 */
class ProductModel extends Model
{
	protected $table = 'products';
	protected $primary_key = 'id';

	// Every column except the primary key may be mass-assigned.
	protected $fillable = ['product_name', 'description', 'price', 'quantity'];
	protected $guarded = ['id'];

	// created_at is set automatically by the database (DEFAULT CURRENT_TIMESTAMP).
	protected $timestamps = false;
	protected $has_soft_delete = false;
}
