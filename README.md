# eCommERP

A lightweight modular ERP system for eCommerce built with PHP and MySQL. Designed for shared hosting without CLI access.

## Installation
1. Upload all files to your hosting space.
2. Browse to `/install/` and provide your database credentials and admin account details.
3. After successful installation, login at `/login.php` with the admin credentials you created.

## Features
- Web-based installer that creates the database and admin user.
- Simple authentication with role-based sidebar.
- Inventory module with product CRUD operations.
- Dashboard with basic metrics.

## Default Structure
```
/erp-system/
├── assets/        # CSS, JS
├── config/        # DB config
├── controllers/   # Placeholder
├── models/        # PHP models
├── modules/       # Module entry points
├── views/         # Page templates
├── install/       # Installer scripts
└── index.php      # Front controller
```

This is a starting point for a larger ERP system.

