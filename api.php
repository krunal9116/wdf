<?php
// actions/api.php
require __DIR__ . '/../config/db.php';
header('Content-Type: application/json');
$action = $_GET['action'] ?? '';
if($action === 'menu'){
    $items = safeQuery($pdo, 'SELECT id,title,description,price FROM menu_items')->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['status'=>'ok','data'=>$items]);
    exit;
}
if($action === 'profile' && !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    $u = safeQuery($pdo, 'SELECT id,name,email,created_at FROM users WHERE id=:id', [':id'=>$id])->fetch(PDO::FETCH_ASSOC);
    echo json_encode($u ?: []);
    exit;
}

echo json_encode(['status'=>'error','message'=>'Unknown action']);
