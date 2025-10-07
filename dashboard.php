<?php
session_start();
if(empty($_SESSION['user_id'])){
    header('Location: /public/login.html'); exit;
}
require __DIR__ . '/../config/db.php';

$userName = htmlspecialchars($_SESSION['user_name']);
?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Dashboard</title>
<link rel="stylesheet" href="css/style.css"></head>
<body>
  <div class="container">
    <h2>Welcome, <?php echo $userName; ?></h2>
    <p><a href="/public/menu.php">Order Food</a> | <a href="/public/profile.php">Profile</a> | <a href="/public/logout.php">Logout</a></p>

    <?php
    $stmt = safeQuery($pdo, 'SELECT * FROM orders WHERE user_id = :uid ORDER BY created_at DESC', [':uid'=>$_SESSION['user_id']]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($orders){
        echo '<h3>Your Orders</h3><table class="table"><tr><th>ID</th><th>Items</th><th>Total</th><th>Status</th></tr>';
        foreach($orders as $o){
            echo '<tr><td>'.$o['id'].'</td><td>'.htmlspecialchars($o['items']).'</td><td>'.$o['total'].'</td><td>'.$o['status'].'</td></tr>';
        }
        echo '</table>';
    } else { echo '<p>No orders yet</p>'; }
    ?>
  </div>
</body></html>
