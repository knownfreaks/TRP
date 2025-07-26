# eCommERP

A lightweight modular ERP system for eCommerce built with PHP and MySQL. Designed for shared hosting without CLI access.

## Installation
1. Upload all files to your hosting space.
2. Browse to `/install/` and provide your database credentials and admin account details.
3. After successful installation, login at `/login.php` with the admin credentials you created.
4. If you see a database connection error, open `config/config.php` and ensure your
   database username and password are correct. You can also set the values
   through environment variables `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASS`.

## Features
- Web-based installer that creates the database and admin user.
- Simple authentication with role-based sidebar.
- Inventory module with product CRUD operations.
- Customers module with basic CRM records.
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

### Expanding for Real Business Use

To turn this starter into a production-ready ERP, consider adding modules for orders, finance, HR, and reporting. Implement role-based permissions for granular control and secure all forms with CSRF tokens and validation. A minimalist Bootstrap 5 interface keeps pages fast and responsive while remaining easy to customize. Future enhancements can include a REST API layer, audit logging, and multi-language support to cater to different business types.

