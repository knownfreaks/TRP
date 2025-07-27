<?php
require_once __DIR__ . '/../../models/Order.php';
require_once __DIR__ . '/../../models/Customer.php';
$orderModel = new Order($pdo);
$customerModel = new Customer($pdo);

$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderModel->create($_POST);
    header('Location: index.php?page=orders');
    exit;
}

if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderModel->update($id, $_POST);
    header('Location: index.php?page=orders');
    exit;
}

if ($action === 'delete' && $id) {
    $orderModel->delete($id);
    header('Location: index.php?page=orders');
    exit;
}

$orders = $orderModel->all();
$customers = $customerModel->all();
$current = ($action === 'edit' && $id) ? $orderModel->find($id) : null;
?>
<h1 class="mb-4">Orders</h1>
<a class="btn btn-sm btn-primary mb-3" href="index.php?page=orders&action=addform">Add Order</a>
<?php if ($action === 'addform' || $action === 'edit'): ?>
<form method="post" action="index.php?page=orders&action=<?= $action === 'edit' ? 'edit&id=' . $id : 'add' ?>">
    <div class="row g-3">
        <div class="col-md-4">
            <select class="form-select" name="customer_id" required>
                <option value="">Select Customer</option>
                <?php foreach ($customers as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= isset($current['customer_id']) && $current['customer_id']==$c['id'] ? 'selected' : '' ?>><?= htmlspecialchars($c['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <input class="form-control" type="date" name="order_date" value="<?= $current['order_date'] ?? date('Y-m-d') ?>">
        </div>
        <div class="col-md-3">
            <select class="form-select" name="status">
                <?php $statuses = ['Pending','Processing','Shipped','Delivered'];
                foreach ($statuses as $s): ?>
                    <option value="<?= $s ?>" <?= ($current['status'] ?? '')==$s ? 'selected' : '' ?>><?= $s ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <input class="form-control" type="number" step="0.01" name="total" placeholder="Total" value="<?= $current['total'] ?? 0 ?>">
        </div>
        <div class="col-md-2">
            <button class="btn btn-success w-100" type="submit">Save</button>
        </div>
    </div>
</form>
<?php endif; ?>
<table class="table table-bordered mt-3">
    <thead><tr><th>ID</th><th>Customer</th><th>Date</th><th>Status</th><th>Total</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($orders as $o): ?>
        <tr>
            <td><?= $o['id'] ?></td>
            <td><?= htmlspecialchars($o['customer']) ?></td>
            <td><?= $o['order_date'] ?></td>
            <td><?= htmlspecialchars($o['status']) ?></td>
            <td><?= $o['total'] ?></td>
            <td>
                <a href="index.php?page=orders&action=edit&id=<?= $o['id'] ?>" class="btn btn-sm btn-secondary">Edit</a>
                <a href="index.php?page=orders&action=delete&id=<?= $o['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
