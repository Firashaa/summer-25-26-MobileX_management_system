# MobileX / MobiTrackk

This build follows the MVC structure of the supplied library-management demo project.

## Architecture

- `index.php` is the single front controller/router.
- `controllers/` contains one controller for each user role plus authentication.
- `models/` contains all database queries and database mutations.
- `views/` contains presentation only; views do not run SQL.
- `views/partials/` contains shared header/footer/profile presentation.
- `config/config.php` starts the session and creates a MySQLi connection.
- `database.sql` is the supplied `shop_db` schema/data.

## Important database rule

The project uses **MySQLi only** (procedural `mysqli_*` functions). It does not use PDO.
The application does not create, alter, or seed tables automatically.

## Setup with XAMPP

1. Put the `MobileX` folder inside `htdocs`.
2. Start Apache and MySQL.
3. Create/import the database using `database.sql` (database name: `shop_db`).
4. If your MySQL username/password differs, edit `config/config.php`.
5. Open `http://localhost/MobileX/`.

## Routes

Examples:

- Admin dashboard: `index.php?page=admin&section=dashboard`
- Vendor pricing: `index.php?page=vendor&section=pricing`
- Seller stock: `index.php?page=seller&section=stock`
- Customer browse: `index.php?page=customer&section=browse`

## Database tables covered

`users`, `vendor_products`, `seller_stock`, `products`, `orders`, `order_items`, `complaints`, `notices`, `reviews`, `store_visits`, `wishlist`.
