<?php
session_start();
include "../templates/header.php";

$id_pembayaran = $_GET["id_pembayaran"];

$p = query(
    "SELECT * FROM pembayaran
    WHERE id_pembayaran = $id_pembayaran"
)[0];

if (isset($_POST["edit_status_pembayaran"])) {
    if (status_pembayaran_edit($_POST) > 0) {
        echo "<script>
            alert('Status pembayaran berhasil diubah!');
            document.location.href = 'riwayat.php';
          </script>";
    } else {
        echo "<script>
            alert('Status pembayaran gagal diubah!');
            document.location.href = 'riwayat.php';
          </script>";
    }
}
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Status Pembayaran</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="riwayat.php"
                            class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white"><i
                                class="fas fa-angle-left"></i> Kembali</a>
                    </li>
                </ol>

            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="white-box">
                <div class="d-md-flex mb-3">
                    <h3 class="box-title mb-0">Status Pembayaran : <span>
                            <?php if ($p["status"] == 1): ?>
                                <span class="badge bg-success">Diterima</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Pending
                                </span>
                            <?php endif ?>
                        </span></h3>
                    <!-- <div class="col-md-3 col-sm-4 col-xs-6 ms-auto">
                        <select class="form-select shadow-none row border-top">
                            <option>March 2021</option>
                            <option>April 2021</option>
                            <option>May 2021</option>
                            <option>June 2021</option>
                            <option>July 2021</option>
                        </select>
                    </div> -->
                </div>
                <form class="form-horizontal form-material" action="" method="POST">

                    <input type="hidden" value="<?= $p["id_pembayaran"]; ?>" name="id_pembayaran" />

                    <div class="form-group mb-4">
                        <label for="example-email" class="col-md-12 p-0">Status</label>

                        <div class="col-sm-12 border-bottom">
                            <select class="form-select shadow-none p-0 border-0 form-control-line" name="status">
                                <option value="1">Diterima</option>
                                <option value="2">Pending</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit" name="edit_status_pembayaran">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include "../templates/footer.php";
?>