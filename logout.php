
<?php
    session_start();
    unset($_SESSION['login_id']);
    unset($_SESSION['login_user_name']);
    session_destroy();
    header("Location: login.php");
    exit;