<?php
// CONTROLLER: authentication.
// The database role is the source of truth for post-login routing.

function login_controller($conn) {
    // The role query parameter is only a UI hint (Admin/Vendor/Seller/Customer login label).
    // It is NEVER trusted to decide the authenticated user's destination.
    $role = sanitize_role($_GET['role'] ?? '') ?: '';
    $email = '';
    $emailErr = $passwordErr = $loginErr = $generalErr = '';
    $successMsg = get_flash('success');
    $generalErr = get_flash('error');

    // A logged-in account always belongs on the dashboard defined by its session role.
    if (is_logged_in()) {
        redirect(role_home_url(current_role()));
    }

    if (isset($_GET['timeout'])) {
        $generalErr = 'Your session expired. Please login again.';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        csrf_check();
        $email = clean_input($_POST['email'] ?? '');
        $password = (string)($_POST['password'] ?? '');

        if ($email === '') {
            $emailErr = 'Email is required';
        } elseif (!is_valid_email($email)) {
            $emailErr = 'Invalid email format';
        }

        if ($password === '') {
            $passwordErr = 'Password is required';
        }

        if (!$emailErr && !$passwordErr) {
            if (!$conn) {
                $generalErr = 'Database not available.';
            } else {
                $user = user_find_by_email($conn, $email);

                if (!$user || !password_verify($password, $user['password'])) {
                    $loginErr = 'Invalid email or password';
                } elseif ($user['status'] !== 'active') {
                    $loginErr = 'Account is inactive. Contact admin.';
                } else {
                    // IMPORTANT: derive role from users.role in shop_db, not from GET/POST.
                    $authenticatedRole = sanitize_role($user['role'] ?? '');

                    if (!$authenticatedRole) {
                        $loginErr = 'This account has an invalid role.';
                    } else {
                        session_regenerate_id(true);
                        $_SESSION['user_id'] = (int)$user['id'];
                        $_SESSION['name'] = $user['name'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['role'] = $authenticatedRole;
                        $_SESSION['_last_activity'] = time();

                        if ($authenticatedRole === 'customer' && !isset($_SESSION['cart'])) {
                            $_SESSION['cart'] = [];
                        }

                        // Route strictly by the authenticated database role.
                        redirect(role_home_url($authenticatedRole));
                    }
                }
            }
        }
    }

    $page_title = $role ? ucfirst($role) . ' Login' : 'Login';
    require __DIR__ . '/../views/auth/login.php';
}

function register_controller($conn) {
    $role = sanitize_role($_GET['role'] ?? '') ?: 'customer';
    if ($role === 'admin') {
        set_flash('error', 'Admin registration is disabled. Use an admin account from shop_db.');
        redirect(auth_url('login', 'admin'));
    }
    if (is_logged_in()) redirect(role_home_url(current_role()));

    $name = $email = $shop_name = '';
    $nameErr = $emailErr = $passwordErr = $confirmErr = $shopErr = $generalErr = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        csrf_check();
        $name = clean_input($_POST['name'] ?? '');
        $email = clean_input($_POST['email'] ?? '');
        $shop_name = clean_input($_POST['shop_name'] ?? '');
        $password = (string)($_POST['password'] ?? '');
        $confirm = (string)($_POST['confirm'] ?? '');

        if ($name === '') $nameErr = 'Name is required';
        elseif (!preg_match("/^[a-zA-Z-' ]+$/", $name)) $nameErr = 'Only letters, spaces, hyphen and apostrophe allowed';
        if ($email === '') $emailErr = 'Email is required';
        elseif (!is_valid_email($email)) $emailErr = 'Invalid email format';
        if ($shop_name !== '' && strlen($shop_name) < 2) $shopErr = 'Shop name must be at least 2 characters';
        if ($password === '') $passwordErr = 'Password is required';
        elseif (strlen($password) < 8) $passwordErr = 'Password must be at least 8 characters';
        if ($confirm === '') $confirmErr = 'Confirm password is required';
        elseif ($password !== $confirm) $confirmErr = 'Passwords do not match';

        if (!$nameErr && !$emailErr && !$passwordErr && !$confirmErr && !$shopErr) {
            if (!$conn) $generalErr = 'Database not available.';
            elseif (user_email_exists($conn, $email)) $emailErr = 'Email already registered';
            else {
                $shop = in_array($role, ['vendor', 'seller'], true) ? ($shop_name === '' ? null : $shop_name) : null;
                if (user_create($conn, $name, $email, $password, $role, $shop)) {
                    set_flash('success', 'Registration successful. Please login.');
                    redirect(auth_url('login', $role));
                }
                $generalErr = 'Registration failed.';
            }
        }
    }

    $page_title = ucfirst($role) . ' Register';
    require __DIR__ . '/../views/auth/register.php';
}

function logout_controller() {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
    redirect(url_for('home'));
}
