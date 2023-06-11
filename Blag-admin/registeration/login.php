<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php if (isset($_SESSION['login'])) : ?>
    <?php header("location: http://localhost/blag-admin/admin/index.php"); ?>
    <?php else : ?>
        <div class='main'>
            <h1>وارد شوید</h1>
            <form action="http://localhost/blag-admin/functions/process.php" method="post">
                <input type="text" name="username" placeholder="نام کاربری" required>
                <input type="password" name="password" placeholder="رمز عبور" required>
                <button type="submit" name="login">ورود</button>
                <a href="register.php" class="link-signin">حساب کاربری ندارید؟ ثبت نام کنید</a>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>