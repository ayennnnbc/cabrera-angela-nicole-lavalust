<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: CrudUserModel
 *
 * Handles database access for the "crud_user" table (registered
 * accounts for the Product Management login/registration pages).
 * See lab5_products.sql for the table definition.
 */
class CrudUserModel extends Model
{
	protected $table = 'crud_users';
	protected $primary_key = 'id';
	protected $fillable = ['username', 'password', 'role'];
	protected $guarded = ['id'];
	protected $timestamps = false;
}
