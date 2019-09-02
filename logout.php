<?php
session_start();
if ($_SESSION['admin_name'] == false) {
    header("Location: login.php");
} else {

    $_SESSION['admin_name'] = null;
//    $_SESSION['user_name'] = null;
//    $_SESSION['user_email'] = null;
//    $_SESSION['user_role'] = null;
    session_destroy();

    header("Location: login.php");
}