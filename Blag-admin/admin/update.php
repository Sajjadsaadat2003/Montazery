<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/update.css">
    <title>حذف و ویرایش</title>
</head>
<body>

  <form action="http://localhost/blag-admin/functions/process.php" method="post">
    <div class='main lists'>
      <input type="text" name="delPost_id" class="delete" placeholder="آیدی پست" required>
      <button type="submit" name="delPost_btn" class="up_del_btn">حذف</button>
    </div>
  </form>
  <hr>
  <form action="http://localhost/blag-admin/functions/process.php" method="post">
    <div class='main lists'>
      <input type="text" name="upPost_id" class="update" placeholder="آیدی پست" required><hr>
      <input type="file" name="upPost_img" accept="image/*" formmethod="post" class="image" required>
      <input type="text" name="upPost_title" class="update" placeholder="عنوان جدید" required>
      <input type="text" name="upPost_text" class="update" placeholder="متن جدید" required>
      <button type="submit" name="upPost_btn" class="up_del_btn">ویرایش</button>
    </div>
  </form>
  <center><a href="http://localhost/blag-admin/admin" class="link-back" style="text-align:center;">بازگشت</a></center>
  <p class="title_Lists">لیست پست ها</p>

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
          echo '<tr>';
          echo '<th id="img_row"><img src="http://localhost/blag-admin/pics/' . $row['imagePost'] . '" style="width:175px; height:125px;" /></th>';
          echo '<th id="id_row">' . $row['id'] . '</th>';
          echo '<th id="title_row">' . $row['titlePost'] . '</th>';
          echo '<th>' . $row['textfulPost'] . '</th>';
          echo '</tr>';
          echo '</table>';
      }
    } else {
      // اگر پستی وجود نداشت خطای زیر را نمایش بده
      echo "هیچ پستی از قبل وارد نشده است";
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