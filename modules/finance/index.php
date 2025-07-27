<?php
require_once __DIR__ . '/../../models/Finance.php';
$financeModel = new Finance($pdo);

$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $financeModel->create($_POST);
    header('Location: index.php?page=finance');
    exit;
}

if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $financeModel->update($id, $_POST);
    header('Location: index.php?page=finance');
    exit;
}

if ($action === 'delete' && $id) {
    $financeModel->delete($id);
    header('Location: index.php?page=finance');
    exit;
}

$records = $financeModel->all();
$current = ($action === 'edit' && $id) ? $financeModel->find($id) : null;
?>
<h1 class="mb-4">Finance</h1>
<a class="btn btn-sm btn-primary mb-3" href="index.php?page=finance&action=addform">Add Entry</a>
<?php if ($action === 'addform' || $action === 'edit'): ?>
<form method="post" action="index.php?page=finance&action=<?= $action === 'edit' ? 'edit&id=' . $id : 'add' ?>">
    <div class="row g-3">
        <div class="col-md-4">
            <input class="form-control" name="description" placeholder="Description" value="<?= htmlspecialchars($current['description'] ?? '') ?>" required>
        </div>
        <div class="col-md-2">
            <input class="form-control" type="number" step="0.01" name="amount" placeholder="Amount" value="<?= $current['amount'] ?? '' ?>" required>
        </div>
        <div class="col-md-3">
            <select class="form-select" name="type">
                <option value="income" <?= ($current['type'] ?? '')==='income' ? 'selected' : '' ?>>Income</option>
                <option value="expense" <?= ($current['type'] ?? '')==='expense' ? 'selected' : '' ?>>Expense</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-success w-100" type="submit">Save</button>
        </div>
    </div>
</form>
<?php endif; ?>
<table class="table table-bordered mt-3">
    <thead><tr><th>ID</th><th>Description</th><th>Amount</th><th>Type</th><th>Date</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($records as $f): ?>
        <tr>
            <td><?= $f['id'] ?></td>
            <td><?= htmlspecialchars($f['description']) ?></td>
            <td><?= $f['amount'] ?></td>
            <td><?= $f['type'] ?></td>
            <td><?= $f['created_at'] ?></td>
            <td>
                <a href="index.php?page=finance&action=edit&id=<?= $f['id'] ?>" class="btn btn-sm btn-secondary">Edit</a>
                <a href="index.php?page=finance&action=delete&id=<?= $f['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
