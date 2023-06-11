<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="container">
<p class="title">پست ها</p>

<?php
// نام سرور، نام کاربری، رمز عبور و نام پایگاه داده دریافت میکند
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myprojectdb";

// ساخت یک شئ PDO
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// تنظیم حالت خطاهای PDO روی استثناها
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// آماده کردن دستور SQL
$stmt = $conn->prepare("SELECT * FROM `post`;");

// اجرای دستور SQL
try {
  $stmt->execute();

  // بررسی اینکه آیا پستی در پایگاه داده وجود دارد یا خیر
  if ($stmt->rowCount() > 0) {
    // مرور پست ها و نمایش آنها
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo '<table id="customers" border="3">';
      echo '<tr><th><img src="pics/' . $row['imagePost'] . '" style="width:375px; height:325px;" /></th></tr>';
      echo '<tr><th>' . $row['titlePost'] . '</th></tr>';
      echo '<tr><th>' . $row['textfulPost'] . '</th></tr>';
      echo '</table>';
    }
  } else {
    // اگر پستی وجود نداشت خطای زیر را نمایش بده
    echo "اطلاعاتی برای نمایش موجود نیست";
  }
} catch (PDOException $e) {
  // هر گونه خطا را مدیریت میکند
  echo $e->getMessage();
} finally {
  // خروج از اتصال PDO
  $conn = null;
}
?>

</div>
</body>
</html>