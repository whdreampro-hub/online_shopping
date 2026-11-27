# Online Shopping (PHP/MySQL prototype)

This repository is a small PHP and MySQL learning prototype. It contains basic signup and login forms, product listing and ordering, and simple user/order management pages.

**Security status: not production-ready.** Do not expose this application to the public internet or use it with real customer data until the security gaps below are fixed and independently tested.

## Requirements

- PHP 8.0 or later with the MySQLi extension
- MySQL or MariaDB
- A local PHP web server such as Apache/XAMPP

## Local setup

1. Create a local MySQL database named `online_shop`.
2. Create the `users`, `products`, and `orders` tables with the columns used by the PHP pages. No verified schema migration is currently documented in this repository.
3. Configure the local database connection in `db.php`. The current file contains development-only connection defaults; replace them with environment-based configuration before sharing or deploying the application. Never commit real credentials.
4. Ensure the `uploads/` directory is writable by the local PHP process. Uploaded product images are stored there.
5. Serve the repository through Apache or PHP's local development server and open `home.php`.

## Main files

| File | Purpose |
| --- | --- |
| `home.php` | Signup and login forms |
| `signup.php` | Creates a regular user account |
| `login.php` | Checks submitted login credentials |
| `products.php` | Lists products and accepts customer orders |
| `dashboard.php` | User listing and product management |
| `orders_dashboard.php` | Lists and deletes customer orders |
| `edit_user.php` | Updates a user's profile |
| `db.php` | MySQLi database connection |

## Security work required before deployment

The current code is suitable only for local experimentation. A review of the PHP pages found these issues that must be addressed before production use:

- The login query and several order, user, and delete queries interpolate request values directly into SQL. Use prepared statements for every query containing user input.
- The dashboard, order-management, and user-edit pages do not enforce an authenticated administrator session or role.
- Product uploads do not validate file type, file size, or safe generated filenames.
- Database values are rendered into HTML without consistent output escaping, creating cross-site scripting risk.
- State-changing actions use GET or POST without CSRF protection.
- The database connection uses hard-coded local development credentials.

Do not treat the presence of a login form as access control. Add server-side authentication and authorization to every protected route, validate uploads, escape output, and add CSRF protection before enabling public access.

## Development notes

- Uploaded files and local environment files are excluded from Git by `.gitignore`.
- There is currently no automated test or lint command configured. Run PHP syntax checks (for example, `php -l filename.php`) after changing PHP files and add integration tests before production use.
