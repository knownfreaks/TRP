<?php
$role = $_SESSION['user']['role'] ?? 'staff';
?>
<div class="d-flex">
    <nav id="sidebar" class="navbar navbar-dark bg-dark flex-column align-items-stretch p-3 sidebar" style="min-height:100vh; width:220px;">
        <a class="navbar-brand text-center mb-3" href="index.php">ERP</a>
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?page=inventory">
                    <i class="fas fa-box me-2"></i>Inventory
                </a>
            </li>
            <?php if ($role === 'admin' || $role === 'manager'): ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?page=orders">
                    <i class="fas fa-shopping-cart me-2"></i>Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?page=customers">
                    <i class="fas fa-users me-2"></i>Customers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?page=finance">
                    <i class="fas fa-money-bill-wave me-2"></i>Finance
                </a>
            </li>
            <?php endif; ?>
            <li class="nav-item mt-auto">
                <a class="nav-link text-white" href="logout.php">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid p-4" id="mainContent">
        <!-- Your main page content goes here -->
