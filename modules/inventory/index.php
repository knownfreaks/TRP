<?php
require_once __DIR__ . '/../../models/Product.php';
$productModel = new Product($pdo);

$action = $_GET['action'] ?? 'list';

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $productModel->create($_POST);
    header('Location: index.php?page=inventory');
    exit;
}

if ($action === 'delete' && isset($_GET['id'])) {
    $productModel->delete((int)$_GET['id']);
    header('Location: index.php?page=inventory');
    exit;
}

$products = $productModel->all();
?>
<h1 class="mb-4">Inventory</h1>
<a class="btn btn-sm btn-primary mb-3" href="index.php?page=inventory&action=addform">Add Product</a>
<?php if ($action === 'addform'): ?>
<form method="post" action="index.php?page=inventory&action=add">
    <div class="row g-3">
        <div class="col-md-6">
            <input class="form-control" name="title" placeholder="Title" required>
        </div>
        <div class="col-md-6">
            <input class="form-control" name="sku" placeholder="SKU" required>
        </div>
        <div class="col-md-12">
            <textarea class="form-control" name="description" placeholder="Description"></textarea>
        </div>
        <div class="col-md-3">
            <input class="form-control" type="number" name="stock" placeholder="Stock" value="0">
        </div>
        <div class="col-md-3">
            <input class="form-control" type="number" step="0.01" name="price" placeholder="Price" value="0">
        </div>
        <div class="col-md-3">
            <input class="form-control" name="category" placeholder="Category">
        </div>
        <div class="col-md-3">
            <button class="btn btn-success w-100" type="submit">Save</button>
        </div>
    </div>
</form>
<?php endif; ?>
<table class="table table-bordered">
    <thead><tr><th>ID</th><th>Title</th><th>SKU</th><th>Stock</th><th>Price</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['title']) ?></td>
            <td><?= htmlspecialchars($p['sku']) ?></td>
            <td><?= $p['stock'] ?></td>
            <td><?= $p['price'] ?></td>
            <td><a href="index.php?page=inventory&action=delete&id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

