<?php
$role = $_SESSION['user']['role'] ?? 'staff';
?>
<div class="d-flex">
    <nav class="navbar navbar-dark bg-dark flex-column align-items-stretch p-3" style="min-height:100vh;width:200px">
        <a class="navbar-brand" href="index.php">ERP</a>
        <ul class="navbar-nav flex-column">
            <li class="nav-item"><a class="nav-link text-white" href="index.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="index.php?page=inventory">Inventory</a></li>
            <?php if ($role === 'admin' || $role === 'manager'): ?>
            <li class="nav-item"><a class="nav-link text-white" href="#">Orders</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="index.php?page=customers">Customers</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#">Finance</a></li>
            <?php endif; ?>
            <li class="nav-item mt-auto"><a class="nav-link text-white" href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container-fluid p-4">
