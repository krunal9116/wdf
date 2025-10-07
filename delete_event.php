<?php
// actions/delete_event.php
session_start(); require __DIR__ . '/../config/db.php';
if(empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') die('Forbidden');
$id = (int)$_GET['id'];
safeQuery($pdo, 'DELETE FROM menu_items WHERE id = :id', [':id'=>$id]);
header('Location: /public/admin.php'); exit;
