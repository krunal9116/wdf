<?php
session_start();
require __DIR__ . '/../config/db.php';

$items = safeQuery($pdo, 'SELECT * FROM menu_items ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Menu</title>
<link rel="stylesheet" href="css/style.css"></head>
<body>
  <div class="container">
    <h2>Menu</h2>
    <div class="grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px">
    <?php foreach($items as $it): ?>
      <div class="card">
        <h3><?php echo htmlspecialchars($it['title']); ?></h3>
        <p><?php echo htmlspecialchars($it['description']); ?></p>
        <p>₹ <?php echo $it['price']; ?></p>
        <?php if(!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
          <p>
            <a href="/public/admin.php?edit=<?php echo $it['id']; ?>">Edit</a> |
            <a href="/actions/delete_event.php?id=<?php echo $it['id']; ?>" onclick="return confirm('Delete?')">Delete</a>
          </p>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
    </div>

    <?php if(!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
      <p><a href="/public/admin.php">Go to Admin Panel</a></p>
    <?php endif; ?>

  </div>
</body></html>
