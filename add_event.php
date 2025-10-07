<?php
session_start(); require __DIR__ . '/../config/db.php';
if(empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') die('Forbidden');
$title = trim($_POST['title']); $desc = trim($_POST['description']); $price = (float)$_POST['price'];
if(!$title || $price<=0) die('Invalid');
safeQuery($pdo, 'INSERT INTO menu_items (title,description,price) VALUES (:t,:d,:p)', [':t'=>$title,':d'=>$desc,':p'=>$price]);
header('Location: /public/admin.php'); exit;
