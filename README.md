# IT Student Portal

A Laravel 12 student portal with account registration, login, and per-user course management. The existing application structure and views are retained.

## Requirements

- PHP 8.2 or newer with `ctype`, `curl`, `dom`, `fileinfo`, `mbstring`, `openssl`, `PDO`, `session`, `tokenizer`, and `xml` enabled
- Composer
- MySQL with `pdo_mysql`, or SQLite with `pdo_sqlite` enabled
- Node.js and npm (only needed if rebuilding frontend assets)

## Installation

1. Install PHP dependencies:

   ```bash
   composer install
   ```

2. Create your local environment file if it does not exist:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. Configure the database in `.env`.
   - For MySQL, set `DB_CONNECTION=mysql`, the database name, username, and password, and create that database in MySQL first.
   - For SQLite, set `DB_CONNECTION=sqlite` and ensure `database/database.sqlite` exists.

4. Run all database migrations. This creates the `courses` table as well as Laravel's user, session, cache, and queue tables:

   ```bash
   php artisan migrate
   ```

5. Start the Laravel development server:

   ```bash
   php artisan serve
   ```

6. Open the local URL shown by Artisan and register a student account.

## Course rules

- Students can create, view, edit, and delete only their own courses.
- Course codes are normalized to uppercase and must be unique for each student.
- Credit hours must be between 1 and 6.
- The supported semesters are Spring 2026 and Fall 2026.

## Tests

Run the automated test suite with:

```bash
php artisan test
```

The feature tests cover registration, login/logout, course CRUD, ownership protection, duplicate course codes, and validation. PHPUnit uses an in-memory SQLite database; the PHP `pdo_sqlite` extension must be enabled.

## Frontend assets

The dashboard currently loads `public/css/dashboard.css` directly. The login and registration pages keep their existing inline styles. No frontend rebuild is required to run the current UI.
