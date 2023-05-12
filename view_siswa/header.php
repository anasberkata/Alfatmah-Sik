<?php
if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id = $_SESSION['id'];
$user = query(
    "SELECT * FROM siswa
    INNER JOIN rombel ON rombel.id_rombel = siswa.id_rombel
    INNER JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran = siswa.id_tahun_ajaran
    INNER JOIN guru ON guru.id_guru = rombel.id_guru
    WHERE id_siswa = $id"
)[0];

$bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

ini_set('display_errors', 1); //Atauerror_reporting(E_ALL && ~E_NOTICE);
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Informasi Keuangan Alfatmah</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />

    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/logo-alfatmah_new.png" />

    <!-- <link href="../assets/plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet"> -->
    <link rel="stylesheet"
        href="../assets/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">

    <!-- Datatables -->
    <link rel="stylesheet" href="../vendor/simple-datatables/style.css">

    <link href="../assets/css/style.min.css" rel="stylesheet">
    <style>
        .sidebar-header {
            width: 100%;
            position: relative;
            padding-left: 25px;
            color: #000;
            font-size: 12px;
            /* margin-bottom: 20px; */
        }
    </style>
</head>

<body>
    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> -->

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">


        <?php
        include "topbar.php";
        include "sidebar.php";
        ?>

        <div class="page-wrapper">