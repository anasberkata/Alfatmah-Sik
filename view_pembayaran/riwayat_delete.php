<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id_pembayaran = $_GET["id_pembayaran"];

if (pembayaran_delete($id_pembayaran) > 0) {
    echo "
		<script>
			alert('Data pembayaran berhasil dihapus!');
			document.location.href = 'riwayat.php';
		</script>
	";
} else {
    echo "
		<script>
			alert('Data pembayaran gagal dihapus!');
			document.location.href = riwayat.php';
		</script>
	";
}