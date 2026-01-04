<?php
session_start();
unset($_SESSION['logged_in']);
session_destroy();
echo "<script>alert('您已登出!'); location.href = './login.php';</script>";
?>