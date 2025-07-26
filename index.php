<?php
session_start();

if (!file_exists(__DIR__ . '/config/installed.lock')) {
    header('Location: install/');
    exit;
}

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$page = $_GET['page'] ?? 'dashboard';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/sidebar.php';

switch ($page) {
    case 'inventory':
        require __DIR__ . '/modules/inventory/index.php';
        break;
    case 'customers':
        require __DIR__ . '/modules/customers/index.php';
        break;
    default:
        require __DIR__ . '/views/dashboard.php';
        break;
}

include __DIR__ . '/includes/close.php';
include __DIR__ . '/includes/footer.php';

