<?php
require_once __DIR__ . '/../../models/Customer.php';
$customerModel = new Customer($pdo);

$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerModel->create($_POST);
    header('Location: index.php?page=customers');
    exit;
}

if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
    $customerModel->update($id, $_POST);
    header('Location: index.php?page=customers');
    exit;
}

if ($action === 'delete' && $id) {
    $customerModel->delete($id);
    header('Location: index.php?page=customers');
    exit;
}

$customers = $customerModel->all();
$current = ($action === 'edit' && $id) ? $customerModel->find($id) : null;
?>
<h1 class="mb-4">Customers</h1>
<a class="btn btn-sm btn-primary mb-3" href="index.php?page=customers&action=addform">Add Customer</a>

<?php if ($action === 'addform' || ($action === 'edit' && $current)): ?>
<form method="post" action="index.php?page=customers&action=<?= $action === 'edit' ? 'edit&id=' . $id : 'add' ?>">
    <div class="row g-3">
        <div class="col-md-6">
            <input class="form-control" name="name" placeholder="Name" value="<?= htmlspecialchars($current['name'] ?? '') ?>" required>
        </div>
        <div class="col-md-6">
            <input class="form-control" name="email" placeholder="Email" value="<?= htmlspecialchars($current['email'] ?? '') ?>" required>
        </div>
        <div class="col-md-6">
            <input class="form-control" name="phone" placeholder="Phone" value="<?= htmlspecialchars($current['phone'] ?? '') ?>">
        </div>
        <div class="col-md-6">
            <input class="form-control" name="address" placeholder="Address" value="<?= htmlspecialchars($current['address'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <button class="btn btn-success w-100" type="submit">Save</button>
        </div>
    </div>
</form>
<?php endif; ?>

<table class="table table-bordered mt-3">
    <thead>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php foreach ($customers as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['name']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= htmlspecialchars($c['phone']) ?></td>
            <td>
                <a href="index.php?page=customers&action=edit&id=<?= $c['id'] ?>" class="btn btn-sm btn-secondary">Edit</a>
                <a href="index.php?page=customers&action=delete&id=<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this customer?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
