<?php
session_start(); require __DIR__ . '/../config/db.php';
if(empty($_SESSION['user_id'])) { header('Location:/public/login.html'); exit; }
$uid = $_SESSION['user_id'];
$user = safeQuery($pdo,'SELECT id,name,email,created_at FROM users WHERE id=:id',[':id'=>$uid])->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Profile</title>
<link rel="stylesheet" href="css/style.css"></head>
<body>
<div class="container">
  <h2>Profile</h2>
  <p>Name: <?php echo htmlspecialchars($user['name']); ?></p>
  <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
  <p>Joined: <?php echo $user['created_at']; ?></p>
  <form method="post" action="/actions/update_profile.php">
    <!-- update logic omitted but would include sanitization & prepared statement -->
  </form>
</div>
</body></html>
