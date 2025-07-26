<h1 class="mb-4">Dashboard</h1>
<div class="row g-4">
    <div class="col-md-3">
        <div class="card shadow-sm p-3 d-flex align-items-center">
            <i class="fas fa-box text-primary card-icon"></i>
            <div>
                <h5><?= (int)($pdo->query('SELECT COUNT(*) FROM products')->fetchColumn()) ?></h5>
                <p class="mb-0">Products</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm p-3 d-flex align-items-center">
            <i class="fas fa-users text-success card-icon"></i>
            <div>
                <h5><?= (int)($pdo->query('SELECT COUNT(*) FROM users')->fetchColumn()) ?></h5>
                <p class="mb-0">Users</p>
            </div>
        </div>
    </div>
</div>

