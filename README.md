eCommERP
A lightweight modular ERP system for eCommerce built with PHP and MySQL. Designed to run on shared hosting—no CLI required.

Installation
Upload all files to your hosting space.

Browse to /install/ and provide your database credentials and admin account details.

After successful installation, log in at /login.php with the admin credentials you created.

If you visit /login.php before running the installer, you won’t have an admin account and may see an error. Visit /install/ first.

If you see a database connection error, open config/config.php and ensure your database username and password are correct. You can also set the values through environment variables: DB_HOST, DB_NAME, DB_USER, and DB_PASS.

The installer will prompt you to create the first administrator user. Use those credentials to log in after installation.

Development
Run a PHP syntax check across the project before committing changes:

sh
Copy
Edit
find . -name '*.php' -print0 | xargs -0 -n1 php -l
Features
Web-based installer to create the database and admin user

Simple authentication with role-based sidebar

Inventory module with product CRUD operations

Customers module with basic CRM records

Orders module to track customer orders

Finance module for simple income/expense entries

Dashboard with basic metrics

Default Structure
bash
Copy
Edit
/erp-system/
├── assets/        # CSS, JS
├── config/        # DB config
├── controllers/   # Placeholder
├── models/        # PHP models
├── modules/       # Module entry points
├── views/         # Page templates
├── install/       # Installer scripts
└── index.php      # Front controller
This is a starting point for a larger ERP system.

Expanding for Real Business Use
Modules for orders and finance are included as simple examples.

For production readiness, consider adding:

HR, reporting, and advanced permissions

Role-based access control

CSRF tokens and robust validation

REST API layer, audit logging, and multi-language support

UI: Uses minimalist Bootstrap 5 for speed, responsiveness, and easy customization.

Updated UI
Top navigation bar with search, notifications, and profile menu

Collapsible sidebar navigation with icons

Dashboard includes a sample Profit & Loss bar chart (Chart.js)

CRUD modules include edit capabilities for inventory, customers, orders, and finance

Responsive layout with custom CSS and JavaScript in assets/