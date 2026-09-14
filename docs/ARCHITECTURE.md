# MVC flow

Request → `index.php` → role controller → model functions → role view.

Controllers validate input and coordinate actions. Models own every SQL statement. Views only render variables supplied by controllers. The database connection is MySQLi and follows the supplied `shop_db` schema.


## Navigation and customer browse fixes
- Logged-in users opening the bare project root are redirected to their role route, so the shared navigation is always rendered.
- The shared header only hides the topbar on the public home page.
- Customer browse loads all products from `products` instead of imposing a 30-row application limit.

## Role-safe login routing
Login role selection is only a presentation hint. After credentials are verified, the application reads `users.role` from `shop_db`, stores that database role in the session, and redirects using `role_home_url()`:

- `admin` -> Admin dashboard
- `vendor` -> Vendor dashboard
- `seller` -> Seller dashboard
- `customer` -> Customer browse/dashboard

This prevents a selected/default login role from sending every account to the customer area.
