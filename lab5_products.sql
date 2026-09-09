-- Laboratory Exercise No. 5 - CRUD Application with Authentication
-- Run this against your Aiven MySQL database.

-- Table used by AuthController / Auth library for login & registration.
CREATE TABLE IF NOT EXISTS crud_user (
	id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(30) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	role VARCHAR(20) NOT NULL DEFAULT 'user',
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Table used by ProductModel / ProductController for the CRUD demo.
CREATE TABLE IF NOT EXISTS products (
	id INT AUTO_INCREMENT PRIMARY KEY,
	product_name VARCHAR(100) NOT NULL,
	description TEXT,
	price DECIMAL(10,2) NOT NULL,
	quantity INT NOT NULL DEFAULT 0,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Verify
SELECT * FROM crud_user;
SELECT * FROM products;
