<?php
session_start();
include "header.php";

if (isset($_GET['page'])) {
    $pages = array("bpp", "bbp");

    if (in_array($_GET['page'], $pages)) {
        $_page = $_GET['page'];
    } else {
        $_page = "bpp";
    }
} else {
    $_page = "bpp";
}

if (isset($_POST["add_pembayaran_bpp"])) {
    if (pembayaran_bpp_add($_POST) > 0) {
        echo "<script>
            alert('Pembayaran berhasil ditambah!');
            document.location.href = 'pembayaran_add.php?page=bpp';
          </script>";
    } else {
        echo "<script>
            alert('Pembayaran gagal ditambah!');
            document.location.href = 'pembayaran_add.php?page=bpp';
          </script>";
    }
}

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
            <h4 class="page-title">Pembayaran</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li>
                        Pilih Jenis Pembayaran :
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <a href="pembayaran_add.php?page=bpp" class="btn btn-info text-white">BPP</a>
                            <a href="pembayaran_add.php?page=bbp" class="btn btn-danger text-white">BBP</a>
                        </div>
                    </li>
                </ol>

            </div>
        </div>
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
include "footer.php";
?>