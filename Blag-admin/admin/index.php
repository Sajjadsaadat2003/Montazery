<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: http://localhost/blag-admin/registeration/login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ادمین</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class='main'>
        <h1>خوش آمدید</h1>
        <center>
            <button type="submit" onclick="window.open('http://localhost/Blag-admin/admin/category.php');">دسته بندی جدید</button><br>
            <button type="submit" onclick="window.open('http://localhost/Blag-admin/admin/createpost.php');">پست جدید</button><br>
            <button type="submit" onclick="window.open('http://localhost/Blag-admin/admin/update.php');">حذف / ویرایش پست ها</button><br>
            <a href="http://localhost/blag-admin/registeration/logout.php" class="link-signin" style="text-align:center;">خروج</a><br>
            <a href="http://localhost/blag-admin/index.php" class="link-signin" style="text-align:center;">ورود به صفحه اصلی سایت</a>
        </center>
    </div>
</body>
</html>