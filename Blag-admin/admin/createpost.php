<?php
    session_start();
    if (!isset($_SESSION['login'])) {
        header("location: http://localhost/blag-admin/registeration/index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>پست جدید</title>
</head>
<body>
    <form action="http://localhost/blag-admin/functions/process.php" method="post">
        <div class='main'>
            <h1>ایجاد پست جدید</h1>
            <input type="file" accept="image/*" formmethod="post" name="imagePost" class="image" required>
            <input type="text" name="titlePost" class="title" placeholder="تیتر" required>
            <input type="text" name="textfulPost" class="textful" placeholder="شرح" required>
            <input type="text" name="titleCtg" class="titleCtg" placeholder="نام دسته بندی" required>
            <button type="submit" name="createpost">ثبت</button>
        </div>
    </form>
</body>
</html>