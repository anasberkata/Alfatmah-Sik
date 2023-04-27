<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}

require "../functions.php";

$id_rombel = $_GET["id_rombel"];

if (rombel_delete($id_rombel) > 0) {
    echo "
		<script>
			alert('Rombel berhasil dihapus!');
			document.location.href = 'rombel.php';
		</script>
	";
} else {
    echo "
		<script>
			alert('Rombel gagal dihapus!');
			document.location.href = rombel.php';
		</script>
	";
}