<?php
session_start();
require __DIR__ . '/../config/db.php';
if(empty($_SESSION['role']) || $_SESSION['role'] !== 'admin'){ header('Location: /public/login.html'); exit; }

if(isset($_GET['edit'])){
  $id = (int)$_GET['edit'];
  $row = safeQuery($pdo, 'SELECT * FROM menu_items WHERE id = :id', [':id'=>$id])->fetch(PDO::FETCH_ASSOC);
}

$users = safeQuery($pdo, 'SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC);
$menu = safeQuery($pdo, 'SELECT * FROM menu_items ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin</title>
<link rel="stylesheet" href="css/style.css"></head>
<body>
<div class="container">
  <h2>Admin Panel</h2>
  <p><a href="/public/menu.php">View Site</a> | <a href="/public/logout.php">Logout</a></p>

  <h3>Users</h3>
  <table class="table"><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Joined</th></tr>
  <?php foreach($users as $u) echo '<tr><td>'.$u['id'].'</td><td>'.htmlspecialchars($u['name']).'</td><td>'.htmlspecialchars($u['email']).'</td><td>'.$u['role'].'</td><td>'.$u['created_at'].'</td></tr>'; ?>
  </table>

  <h3>Menu Items (CRUD)</h3>
  <?php if(isset($row)): ?>
    <h4>Edit Item</h4>
    <form method="post" action="/actions/update_event.php">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
      <label>Title<br><input name="title" value="<?php echo htmlspecialchars($row['title']); ?>"></label><br>
      <label>Description<br><textarea name="description"><?php echo htmlspecialchars($row['description']); ?></textarea></label><br>
      <label>Price<br><input name="price" value="<?php echo $row['price']; ?>"></label><br>
      <button class="btn" type="submit">Update</button>
    </form>
  <?php else: ?>
    <h4>Add New Item</h4>
    <form method="post" action="/actions/add_event.php">
      <label>Title<br><input name="title" required></label><br>
      <label>Description<br><textarea name="description"></textarea></label><br>
      <label>Price<br><input name="price" required></label><br>
      <button class="btn" type="submit">Add Item</button>
    </form>
  <?php endif; ?>

  <h4>Existing Items</h4>
  <table class="table"><tr><th>ID</th><th>Title</th><th>Price</th><th>Created</th></tr>
  <?php foreach($menu as $m) echo '<tr><td>'.$m['id'].'</td><td>'.htmlspecialchars($m['title']).'</td><td>'.$m['price'].'</td><td>'.$m['created_at'].'</td></tr>'; ?>
  </table>
</div>
</body></html>
