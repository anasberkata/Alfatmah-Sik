<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id_tahun_ajaran = $_GET["id_tahun_ajaran"];

if (tahun_ajaran_delete($id_tahun_ajaran) > 0) {
    echo "
		<script>
			alert('Tahun ajaran berhasil dihapus!');
			document.location.href = 'tahun_ajaran.php';
		</script>
	";
} else {
    echo "
		<script>
			alert('Tahun ajaran gagal dihapus!');
			document.location.href = tahun_ajaran.php';
		</script>
	";
}