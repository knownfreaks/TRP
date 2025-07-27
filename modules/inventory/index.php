<?php
require_once __DIR__ . '/../../models/Product.php';
$productModel = new Product($pdo);

$action = $_GET['action'] ?? 'list';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $productModel->create($_POST);
    header('Location: index.php?page=inventory');
    exit;
}

if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
    $productModel->update($id, $_POST);
    header('Location: index.php?page=inventory');
    exit;
}

if ($action === 'delete' && $id) {
    $productModel->delete($id);
    header('Location: index.php?page=inventory');
    exit;
}

$products = $productModel->all();
$current = ($action === 'edit' && $id) ? $productModel->find($id) : null;
?>
<h1 class="mb-4">Inventory</h1>
<a class="btn btn-sm btn-primary mb-3" href="index.php?page=inventory&action=addform">Add Product</a>

<?php if ($action === 'addform' || ($action === 'edit' && $current)): ?>
<form method="post" action="index.php?page=inventory&action=<?= $action === 'edit' ? 'edit&id=' . $id : 'add' ?>">
    <div class="row g-3">
        <div class="col-md-6">
            <input class="form-control" name="title" placeholder="Title" value="<?= htmlspecialchars($current['title'] ?? '') ?>" required>
        </div>
        <div class="col-md-6">
            <input class="form-control" name="sku" placeholder="SKU" value="<?= htmlspecialchars($current['sku'] ?? '') ?>" required>
        </div>
        <div class="col-md-12">
            <textarea class="form-control" name="description" placeholder="Description"><?= htmlspecialchars($current['description'] ?? '') ?></textarea>
        </div>
        <div class="col-md-3">
            <input class="form-control" type="number" name="stock" placeholder="Stock" value="<?= htmlspecialchars($current['stock'] ?? 0) ?>">
        </div>
        <div class="col-md-3">
            <input class="form-control" type="number" step="0.01" name="price" placeholder="Price" value="<?= htmlspecialchars($current['price'] ?? 0) ?>">
        </div>
        <div class="col-md-3">
            <input class="form-control" name="category" placeholder="Category" value="<?= htmlspecialchars($current['category'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <button class="btn btn-success w-100" type="submit">Save</button>
        </div>
    </div>
</form>
<?php endif; ?>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>SKU</th>
            <th>Stock</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['title']) ?></td>
            <td><?= htmlspecialchars($p['sku']) ?></td>
            <td><?= htmlspecialchars($p['stock']) ?></td>
            <td><?= htmlspecialchars($p['price']) ?></td>
            <td>
                <a href="index.php?page=inventory&action=edit&id=<?= $p['id'] ?>" class="btn btn-sm btn-secondary">Edit</a>
                <a href="index.php?page=inventory&action=delete&id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
