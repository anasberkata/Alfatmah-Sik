<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: view_siswa/dashboard.php");
    exit;
}

require "functions.php";

$username = $_POST['username'];
$password = $_POST['password'];

$login = mysqli_query($conn, "SELECT * FROM `siswa` WHERE `username` = '$username' AND `password` = '$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {

    $data = mysqli_fetch_assoc($login);

    $_SESSION['login'] = true;
    $_SESSION['id'] = $data['id_siswa'];

    header("location: view_siswa/dashboard.php");

} else {
    header("location: index.php?pesan=Username / Password salah");
}