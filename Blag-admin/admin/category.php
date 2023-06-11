<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دسته بندی جدید</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form action="http://localhost/blag-admin/functions/process.php" method="post">
        <div class='main'>
            <h1>ایجاد دسته بندی جدید</h1>
            <input type="text" name="titleCtg" class="title" placeholder="نام دسته بندی" required>
            <input type="text" name="textfulCtg" class="textful" placeholder="(اختیاری) شرح">
            <button type="submit" name="category">ثبت</button>
        </div>
    </form>
</body>
</html>