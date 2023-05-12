<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: view_admin/dashboard.php");
    exit;
}

require "functions.php";

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {

    $data = mysqli_fetch_assoc($login);

    if ($data['role_id'] == 1) {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $data['id_user'];

        header("location: view_admin/dashboard.php");
    } else if ($data['role_id'] == 2) {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $data['id_user'];

        header("location: view_admin/dashboard.php");
    } else {
        header("location: admin.php?pesan=Username / Password salah");
    }
} else {
    header("location: admin.php?pesan=Username / Password salah");
}