<?php
if (file_exists(__DIR__ . '/../config/installed.lock')) {
    header('Location: ../login.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db_host = trim($_POST['db_host']);
    $db_name = trim($_POST['db_name']);
    $db_user = trim($_POST['db_user']);
    $db_pass = trim($_POST['db_pass']);
    $admin_user = trim($_POST['admin_user']);
    $admin_pass = password_hash($_POST['admin_pass'], PASSWORD_DEFAULT);

    try {
        $dsn = "mysql:host=$db_host;charset=utf8mb4";
        $pdo = new PDO($dsn, $db_user, $db_pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        // Create DB if not exists
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db_name`");
        $pdo->exec("USE `$db_name`");
        // Import SQL
        $sql = file_get_contents(__DIR__ . '/install.sql');
        $pdo->exec($sql);
        // Insert admin
        $stmt = $pdo->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, "admin")');
        $stmt->execute([$admin_user, $admin_pass]);
        // Write config
        $config = "<?php\n";
        $config .= "define('DB_HOST', '$db_host');\n";
        $config .= "define('DB_NAME', '$db_name');\n";
        $config .= "define('DB_USER', '$db_user');\n";
        $config .= "define('DB_PASS', '$db_pass');\n";
        $config .= "define('APP_NAME', 'eCommERP');\n";
        file_put_contents(__DIR__ . '/../config/config.php', $config);
        file_put_contents(__DIR__ . '/../config/installed.lock', 'installed');
        header('Location: ../login.php');
        exit;
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <h3 class="mb-3">Install eCommERP</h3>
            <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post">
                <h5>Database</h5>
                <div class="mb-3"><input class="form-control" name="db_host" placeholder="DB Host" required></div>
                <div class="mb-3"><input class="form-control" name="db_name" placeholder="DB Name" required></div>
                <div class="mb-3"><input class="form-control" name="db_user" placeholder="DB User" required></div>
                <div class="mb-3"><input class="form-control" name="db_pass" placeholder="DB Pass" type="password"></div>
                <h5>Admin Account</h5>
                <div class="mb-3"><input class="form-control" name="admin_user" placeholder="Admin Username" required></div>
                <div class="mb-3"><input class="form-control" name="admin_pass" placeholder="Admin Password" type="password" required></div>
                <button class="btn btn-primary w-100" type="submit">Install</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

