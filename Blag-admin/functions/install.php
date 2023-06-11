<?php

////بررسی اینکه ایا اتصال به سرور برقرار است یا خیر///
$dsn = 'mysql:host=localhost';
$username = 'root';
$password = '';

$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

///ایجاد دیتابیس موردنیاز///
try {
    $pdo->exec('CREATE DATABASE MyProjectDB');
} catch (PDOException $e) {
    echo '- خطا در ساخت دیتابیس - ';
}

?>