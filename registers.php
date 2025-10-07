<?php
session_start();
require __DIR__ . '/../config/db.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$pwd = $_POST['password'] ?? '';

if(!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pwd) < 8){
    die('Invalid input. Please go back and correct.');
}

if(!preg_match('/[A-Z]/', $pwd) || !preg_match('/[0-9]/', $pwd) ){
    die('Password must include an uppercase letter and a number.');
}

$hash = password_hash($pwd, PASSWORD_DEFAULT);

try{
    $stmt = safeQuery($pdo, 'INSERT INTO users (name,email,password) VALUES (:name,:email,:password)', [
        ':name'=>$name,':email'=>$email,':password'=>$hash
    ]);
    $userId = $pdo->lastInsertId();
} catch (PDOException $e){
    die('Registration failed: ' . $e->getMessage());
}

$line = date('Y-m-d H:i:s') . " | $name | $email\n";
file_put_contents(__DIR__ . '/../storage/registrations.txt', $line, FILE_APPEND);

$_SESSION['user_id'] = $userId;
$_SESSION['user_name'] = $name;

header('Location: /public/dashboard.php');
exit;
