<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id_siswa = $_GET["id_siswa"];

if (siswa_delete($id_siswa) > 0) {
    echo "
		<script>
			alert('Siswa berhasil dihapus!');
			document.location.href = 'siswa.php';
		</script>
	";
} else {
    echo "
		<script>
			alert('Siswa gagal dihapus!');
			document.location.href = siswa.php';
		</script>
	";
}