<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id_jenis_pembayaran = $_GET["id_jenis_pembayaran"];

if (jenis_pembayaran_delete($id_jenis_pembayaran) > 0) {
    echo "
		<script>
			alert('Jenis pembayaran berhasil dihapus!');
			document.location.href = 'pembayaran.php';
		</script>
	";
} else {
    echo "
		<script>
			alert('Jenis pembayaran gagal dihapus!');
			document.location.href = pembayaran.php';
		</script>
	";
}