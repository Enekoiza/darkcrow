<?php
    unset($_COOKIE['login']);
    unset($_COOKIE['password']);
    setcookie('login', null, -1);
    setcookie('password', null, -1);
    header("Location: index.php");
?>