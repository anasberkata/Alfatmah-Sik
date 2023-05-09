<?php
session_start();
include "../templates/header.php";

$siswa = query("SELECT * FROM siswa INNER JOIN rombel ON rombel.id_rombel = siswa.id_rombel");
// $jenis_pembayaran = query("SELECT * FROM jenis_pembayaran");

if (isset($_POST["add_pembayaran_bbp"])) {
    if (pembayaran_bbp_add($_POST) > 0) {
        echo "<script>
            alert('Pembayaran berhasil ditambah!');
            document.location.href = 'pembayaran_add.php?page=bbp';
          </script>";
    } else {
        echo "<script>
            alert('Pembayaran gagal ditambah!');
            document.location.href = 'pembayaran_add.php?page=bbp';
          </script>";
    }
}
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Ubah Pembayaran</h4>
        </div>
        <!-- <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li>
                       
                    </li>
                </ol>

            </div>
        </div> -->
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">


            <?php require($_page . ".php"); ?>


        </div>
    </div>
</div>

<?php
include "../templates/footer.php";
?>