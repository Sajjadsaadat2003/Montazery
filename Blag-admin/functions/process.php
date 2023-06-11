<?php
session_start();
include 'database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    ///بررسی ارسال متدهای موردنظر و خالی نبودن آنها و ارسال کردن دیتاهای موردنیاز به تابع یوزرها و دریافت خروجی کار///
    if (isset($_POST['username']) and isset($_POST['password'])) {
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            if (isset($_POST['register'])) {
                if (register($_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['nationalcode'], $_POST['Pnumber'], $_POST['Rpassword'])) {
                    header("location: http://localhost/blag-admin/registeration/login.php");
                    exit;
                } else {
                    header("location: http://localhost/blag-admin/registeration/register.php?s=0");
                    exit;
                }
            } elseif (isset($_POST['login'])) {
                if (login($_POST['username'], $_POST['password'])) {
                    header("location: http://localhost/blag-admin/registeration/login.php?s=1");
                    exit;
                } else {
                    header("location: http://localhost/blag-admin/registeration/login.php?s=0");
                    exit;
                }
            }
        }
        ///بررسی ارسال متدهاب موردنظر و خالی نبودن آنها و ارسال کردن دیتاهای موردنیاز به تابع ایجاد پست و دریافت خروجی کار///
    }elseif (isset($_POST['imagePost']) and isset($_POST['titlePost']) and isset($_POST['textfulPost']) and isset($_POST['titleCtg'])) {
        if (!empty($_POST['imagePost']) and !empty($_POST['titlePost']) and !empty($_POST['textfulPost']) and !empty($_POST['titleCtg'])) {
            if (isset($_POST['createpost'])) {
                if (createpost($_POST['imagePost'], $_POST['titlePost'], $_POST['textfulPost'], $_POST['titleCtg'])) {
                    header("location: http://localhost/blag-admin/admin/index.php?Successful");
                    exit;
                } else {
                    header("location: http://localhost/blag-admin/admin/createpost.php?error");
                    exit;
                }
            }
        }
        ///بررسی ارسال متد موردنظر و خالی نبودن آن و ارسال کردن دیتاهای موردنیاز به تابع کتگوری و دریافت خروجی کار///
    }elseif (isset($_POST['titleCtg'])) {
        if (!empty($_POST['titleCtg'])) {
            if (isset($_POST['category'])) {
                if (category($_POST['titleCtg'], $_POST['textfulCtg'])) {
                    header("location: http://localhost/blag-admin/admin/index.php?Successful");
                    exit;
                } else {
                    header("location: http://localhost/blag-admin/admin/category.php?error");
                    exit;
                }
            }
        }
        ///آیدی را گرفته و آنرا به تابع delete ارسال میکند///
    }elseif (isset($_POST['delPost_id'])) {
        if (!empty($_POST['delPost_id'])) {
            if (isset($_POST['delPost_btn'])) {
                if (delete($_POST['delPost_id'])) {
                    header("location: http://localhost/blag-admin/admin/index.php?Successful");
                    exit;
                } else {
                    header("location: http://localhost/blag-admin/admin/update.php?error");
                    exit;
                }
            }
        }
        ///آیدی را گرفته و آنرا به تابع Update ارسال میکند/// 
    }elseif (isset($_POST['upPost_img']) and isset($_POST['upPost_id']) and isset($_POST['upPost_title']) and isset($_POST['upPost_text'])) {
        if (!empty($_POST['upPost_img']) and !empty($_POST['upPost_id']) and !empty($_POST['upPost_title']) and !empty($_POST['upPost_text'])) {
            if (isset($_POST['upPost_btn'])) {
                if (update($_POST['upPost_id'], $_POST['upPost_img'], $_POST['upPost_title'], $_POST['upPost_text'])) {
                    header("location: http://localhost/blag-admin/admin/index.php?Successful");
                    exit;
                } else {
                    header("location: http://localhost/blag-admin/admin/update.php?error");
                    exit;
                }
            }
        }   
    }
}

//-----------------------------------------------------------------------//
//////بررسی رجود یوزرنیم///////
function isUserExists($username)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);
    return $stmt->rowCount();
}
//-----------------------------------------------------------------------//
////ارسال اطلاعات به دیتابیس////
function register($username, $password, $firstname, $lastname)
{
    global $pdo;
    if (isUserExists($username)) {
        return false;
    }
    $sql = "INSERT INTO users (username, password, firstname, lastname) VALUES (:username, :password, :firstname, :lastname)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ ':username' => $username, ':password' => md5($password), ':firstname' => $firstname, ':lastname' => $lastname]);
    return $stmt->rowCount();
}
//-----------------------------------------------------------------------//
////بازخوانی اطلاعات از دیتابیس////
function login($username, $password)
{
    global $pdo;
    if (!isUserExists($username)) {
        return false;
    }
    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username, ':password' => md5($password)]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    $_SESSION['login'] = $result->id;
    return true;
}
//-----------------------------------------------------------------------//
////ارسال اطلاعات دسته بندی جدید////
function category($title, $textful)
{
    global $pdo;
    $sql = "INSERT INTO categories (titleCtg, textfulCtg) VALUES (:titleCtg, :textfulCtg)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ ':titleCtg' => $title, ':textfulCtg' => $textful]);
    return $stmt->rowCount();
}
//-----------------------------------------------------------------------//
///بررسی وجود دسته بندی///
function isCategoryExists($titleCtg)
{
    global $pdo;
    $sql = "SELECT * FROM categories WHERE titleCtg = :titleCtg";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':titleCtg' => $titleCtg]);
    return $stmt->rowCount();
}
//-----------------------------------------------------------------------//
////ارسال اطلاعات پست جدید////
function createpost($image, $title, $textful, $titleCtg)
{
    global $pdo;
    if (!isCategoryExists($titleCtg)) {
		echo 'دسته بندی یافت نشد';
    }else{
		$sql = "INSERT INTO post (titlePost, textfulPost, titleCtg, imagePost) VALUES (:titlePost, :textfulPost, :titleCtg, :imagePost)";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([ ':titlePost' => $title, ':textfulPost' => $textful, ':titleCtg' => $titleCtg, ':imagePost' => $image]);
		return $stmt->rowCount();
	}
}
//-----------------------------------------------------------------------//
///بررسی وجود آیدی پست برای ویرایش و حذف///
function isIDExists($id)
{
    global $pdo;
    $sql = "SELECT * FROM post WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->rowCount();
}
//-----------------------------------------------------------------------//
////حذف اطلاعات از دیتابیس////
function delete($id)
{
    global $pdo;
    if (!isIDExists($id)) {
		echo 'پستی با این آیدی یافت نشد';
    }else{
        $sql = "DELETE FROM post WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount();
    }
}
//-----------------------------------------------------------------------//
////ویرایش اطلاعات////
function update($id, $image, $title, $textful)
{
    global $pdo;
    if (!isIDExists($id)) {
		echo 'پستی با این آیدی یافت نشد';
    }else{
        $sql = "UPDATE post SET imagePost = :image, titlePost = :title, textfulPost = :textful WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':image' => $image,':title' => $title, ':textful' => $textful, ':id' => $id]);
        return $stmt->rowCount();
    }
}