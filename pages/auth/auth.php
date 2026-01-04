<?php
// /pages/auth/auth.php

session_start();

if (!isset($_SESSION['email'])) {
    header('Location: /VENDOR_DASHBOARD/pages/login/login.php');
    exit;
}
