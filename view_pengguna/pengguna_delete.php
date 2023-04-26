<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id_user = $_GET["id_user"];

if (pengguna_delete($id_user) > 0) {
    echo "
		<script>
			alert('Pengguna berhasil dihapus!');
			document.location.href = 'pengguna.php';
		</script>
	";
} else {
    echo "
		<script>
			alert('Pengguna gagal dihapus!');
			document.location.href = pengguna.php';
		</script>
	";
}