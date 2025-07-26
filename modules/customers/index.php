<?php
require_once __DIR__ . '/../../models/Customer.php';
$customerModel = new Customer($pdo);

$action = $_GET['action'] ?? 'list';

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerModel->create($_POST);
    header('Location: index.php?page=customers');
    exit;
}

if ($action === 'delete' && isset($_GET['id'])) {
    $customerModel->delete((int)$_GET['id']);
    header('Location: index.php?page=customers');
    exit;
}

$customers = $customerModel->all();
?>
<h1 class="mb-4">Customers</h1>
<a class="btn btn-sm btn-primary mb-3" href="index.php?page=customers&action=addform">Add Customer</a>
<?php if ($action === 'addform'): ?>
<form method="post" action="index.php?page=customers&action=add">
    <div class="row g-3">
        <div class="col-md-6">
            <input class="form-control" name="name" placeholder="Name" required>
        </div>
        <div class="col-md-6">
            <input class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="col-md-6">
            <input class="form-control" name="phone" placeholder="Phone">
        </div>
        <div class="col-md-6">
            <input class="form-control" name="address" placeholder="Address">
        </div>
        <div class="col-md-3">
            <button class="btn btn-success w-100" type="submit">Save</button>
        </div>
    </div>
</form>
<?php endif; ?>
<table class="table table-bordered">
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($customers as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['name']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= htmlspecialchars($c['phone']) ?></td>
            <td><a href="index.php?page=customers&action=delete&id=<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
