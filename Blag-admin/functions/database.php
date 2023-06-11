<?php
include 'install.php';

// نام سرور، نام کاربری، رمز عبور و نام پایگاه داده دریافت میکند
$dsn = 'mysql:host=localhost;dbname=MyProjectDB';
$username = 'root';
$password = '';

// ساخت یک شئ PDO
$pdo = new PDO($dsn, $username, $password);

// تنظیم حالت خطاهای PDO روی استثناها
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

///ایجاد جدول کاربران///
try {
    $sql = 'CREATE TABLE users (
        id INT NOT NULL AUTO_INCREMENT,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        firstname VARCHAR(15) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        PRIMARY KEY (id)
        );';
    $pdo->exec($sql);
} catch (PDOException $e) {
    echo '- خطا در ساخت جدول کاربران -';
}

///ایجاد جدول دسته بندی ها///
try {
    $sql = 'CREATE TABLE categories (
        id INT NOT NULL AUTO_INCREMENT,
        titleCtg VARCHAR(20) NOT NULL,
        textfulCtg VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
        );';
    $pdo->exec($sql);
} catch (PDOException $e) {
    echo '- خطا در ساخت جدول دسته بندی ها -' ;
}

///ایجاد جدول پست ها///
try {
    $sql = 'CREATE TABLE post (
        id INT NOT NULL AUTO_INCREMENT,
        titlePost VARCHAR(20) NOT NULL,
        textfulPost LONGTEXT NOT NULL,
        titleCtg VARCHAR(20) NOT NULL,
        imagePost BLOB NOT NULL,
        PRIMARY KEY (id)
        );';
    $pdo->exec($sql);
} catch (PDOException $e) {
    echo '- خطا در ساخت جدول پست ها -' ;
}