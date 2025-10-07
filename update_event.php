<?php
// actions/update_event.php
session_start(); require __DIR__ . '/../config/db.php';
if(empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') die('Forbidden');
$id=(int)$_POST['id'];$title=trim($_POST['title']);$desc=trim($_POST['description']);$price=(float)$_POST['price'];
safeQuery($pdo,'UPDATE menu_items SET title=:t,description=:d,price=:p WHERE id=:id', [':t'=>$title,':d'=>$desc,':p'=>$price,':id'=>$id]);
header('Location: /public/admin.php'); exit;
