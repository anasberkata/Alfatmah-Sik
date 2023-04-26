<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: view_admin/dashboard.php");
    exit;
}

require "functions.php";

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($conn, "SELECT * FROM `siswa` WHERE `username` = '$username' AND `password` = '$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {

    $data = mysqli_fetch_assoc($login);

    if ($data['role_id'] == 3) {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $data['id_user'];

        header("location: view_admin/dashboard_siswa.php");
    } else {
        header("location: index.php?pesan=Username / Password salah");
    }
} else {
    header("location: index.php?pesan=Username / Password salah");
}