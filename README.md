# eCommERP

A lightweight modular ERP system for eCommerce built with PHP and MySQL. Designed for shared hosting without CLI access.

---

## Installation

1. Upload all files to your hosting space.
2. Browse to `/install/` and provide your database credentials and admin account details.
3. After successful installation, log in at `/login.php` with the admin credentials you created.
4. If you access `/login.php` before running the installer, you won't have an admin account and the page may show an error. Visit `/install/` first to set up the database and admin user.
5. If you see a database connection error, open `config/config.php` and ensure your database username and password are correct. You can also set the values through environment variables: `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASS`.
6. The installer prompts you to create the first administrator user. Use those credentials to log in after installation.

---

## Development

Run a PHP syntax check across the project before committing changes:

```sh
find . -name '*.php' -print0 | xargs -0 -n1 php -l
```

---

## Features

* Web-based installer that creates the database and admin user.
* Simple authentication with role-based sidebar.
* Inventory module with product CRUD operations.
* Customers module with basic CRM records.
* Orders module to track customer orders.
* Finance module for simple income and expense entries.
* Dashboard with basic metrics.

---

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

---

## Expanding for Real Business Use

Modules for orders and finance are included as simple examples. To move toward production readiness, consider adding modules for HR, reporting, and more advanced permissions. Implement role-based permissions for granular control, and secure all forms with CSRF tokens and validation. A minimalist Bootstrap 5 interface keeps pages fast and responsive while remaining easy to customize. Future enhancements can include a REST API layer, audit logging, and multi-language support to cater to different business types.

---

## Updated UI

* Top navigation bar with search, notifications, and profile menu
* Collapsible sidebar navigation with icons
* Dashboard includes a sample Profit & Loss bar chart powered by Chart.js
* CRUD modules include edit capabilities for inventory, customers, orders, and finance
* Basic responsive layout with custom CSS and JavaScript in `assets/`

---

