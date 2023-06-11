<?php 
    session_start();

    ///از بین بردن سیشن ها در صورت خروج کاربر///
    if(session_destroy()) {
        header("Location: http://localhost/blag-admin/registeration/login.php");
    }
?>