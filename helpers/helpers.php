<?php
// ================================================================
// Shared helpers. No SQL belongs here.
// ================================================================

function clean_input($value) {
    return trim(stripslashes((string)$value));
}

function cleanInput($value) {
    return clean_input($value);
}

function e($value) {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function redirect($url) {
    header('Location: ' . $url);
    exit;
}

function base_url($path = '') {
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
    $base = rtrim(dirname($script), '/.');
    return ($base === '' ? '' : $base) . '/' . ltrim($path, '/');
}

function url_for($page = 'home', $section = '', $extra = []) {
    $params = ['page' => $page];
    if ($section !== '') $params['section'] = $section;
    foreach ($extra as $key => $value) {
        if ($value !== '' && $value !== null) $params[$key] = $value;
    }
    return base_url('index.php?' . http_build_query($params));
}

function auth_url($mode, $role) {
    return url_for($mode, '', ['role' => $role]);
}

function role_home_url($role) {
    if ($role === 'admin') return url_for('admin', 'dashboard');
    if ($role === 'vendor') return url_for('vendor', 'dashboard');
    if ($role === 'seller') return url_for('seller', 'dashboard');
    if ($role === 'customer') return url_for('customer', 'browse');
    return url_for('home');
}

function is_logged_in() {
    return isset($_SESSION['user_id'], $_SESSION['role']);
}

function current_role() {
    return $_SESSION['role'] ?? null;
}

function current_user_id() {
    return (int)($_SESSION['user_id'] ?? 0);
}

function current_user() {
    return [
        'id' => current_user_id(),
        'name' => $_SESSION['name'] ?? '',
        'email' => $_SESSION['email'] ?? '',
        'role' => current_role(),
    ];
}

function require_login() {
    if (!is_logged_in()) redirect(url_for('login'));
}

function require_role($role) {
    if (!is_logged_in()) redirect(url_for('login'));
    if (current_role() !== $role) redirect(role_home_url(current_role()));
}

function sanitize_role($role) {
    return in_array($role, ['admin', 'vendor', 'seller', 'customer'], true) ? $role : null;
}

function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function set_flash($type, $message) {
    $_SESSION['_flash'][$type] = $message;
}

function get_flash($type) {
    $message = $_SESSION['_flash'][$type] ?? '';
    unset($_SESSION['_flash'][$type]);
    return $message;
}

function csrf_token() {
    if (empty($_SESSION['_csrf'])) $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['_csrf'];
}

function csrf_field() {
    return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">';
}

function csrf_check() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
    $token = $_POST['_csrf'] ?? '';
    if (!hash_equals($_SESSION['_csrf'] ?? '', $token)) {
        http_response_code(403);
        die('Invalid form token. Please go back and try again.');
    }
}

function check_session_timeout() {
    if (!is_logged_in()) return;
    $now = time();
    $last = (int)($_SESSION['_last_activity'] ?? $now);
    if (($now - $last) > SESSION_TIMEOUT) {
        $_SESSION = [];
        session_destroy();
        redirect(url_for('login', '', ['timeout' => 1]));
    }
    $_SESSION['_last_activity'] = $now;
}

function db_ready() {
    global $conn;
    return $conn instanceof mysqli;
}
