<?php
session_start();
require __DIR__ . '/../config/db.php';

$email = $_POST['email'] ?? '';
$pwd = $_POST['password'] ?? '';

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) die('Invalid email');

$stmt = safeQuery($pdo, 'SELECT id, name, password, role FROM users WHERE email = :email', [':email'=>$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$user || !password_verify($pwd, $user['password'])){
    die('Login failed: incorrect credentials');
}

// create session
session_regenerate_id(true);
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['role'] = $user['role'];

if(!empty($_POST['remember'])){
    setcookie('remember_me', $user['id'], time()+60*60*24*30, '/');
}

header('Location: /public/dashboard.php');
exit;
