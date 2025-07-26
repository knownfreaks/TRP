<h1 class="mb-4">Dashboard</h1>
<div class="row g-4 mb-4">
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
                <h5><?= (int)($pdo->query('SELECT COUNT(*) FROM customers')->fetchColumn()) ?></h5>
                <p class="mb-0">Customers</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm p-3 d-flex align-items-center">
            <i class="fas fa-shopping-cart text-warning card-icon"></i>
            <div>
                <h5><?= (int)($pdo->query('SELECT COUNT(*) FROM orders')->fetchColumn()) ?></h5>
                <p class="mb-0">Orders</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm p-3 d-flex align-items-center">
            <i class="fas fa-money-bill-wave text-danger card-icon"></i>
            <div>
                <h5><?= (float)($pdo->query("SELECT SUM(CASE WHEN type='income' THEN amount ELSE -amount END) FROM finance")->fetchColumn()) ?></h5>
                <p class="mb-0">Net Income</p>
            </div>
        </div>
    </div>
</div>
<canvas id="plChart" height="100"></canvas>
<script>
const ctx = document.getElementById('plChart');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr'],
        datasets: [{
            label: 'Income',
            data: [12, 19, 3, 5],
            backgroundColor: 'rgba(255,99,132,0.5)'
        }, {
            label: 'Expense',
            data: [8, 11, 5, 7],
            backgroundColor: 'rgba(54,162,235,0.5)'
        }, {
            label: 'Net',
            data: [4, 8, -2, -2],
            backgroundColor: 'rgba(75,192,192,0.5)'
        }]
    },
    options: {responsive: true, maintainAspectRatio:false}
});
</script>
