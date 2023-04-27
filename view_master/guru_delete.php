<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id_guru = $_GET["id_guru"];

if (guru_delete($id_guru) > 0) {
    echo "
		<script>
			alert('Guru berhasil dihapus!');
			document.location.href = 'guru.php';
		</script>
	";
} else {
    echo "
		<script>
			alert('Guru gagal dihapus!');
			document.location.href = guru.php';
		</script>
	";
}