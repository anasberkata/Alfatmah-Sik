<?php
session_start();
include "../templates/header.php";

$k = query(
    "SELECT * FROM kwitansi"
)[0];

$bendahara = query("SELECT * FROM users WHERE role_id = 2");

if (isset($_POST["edit_kwitansi"])) {
    if (kwitansi_edit($_POST) > 0) {
        echo "<script>
            alert('Kwitansi berhasil diubah!');
            document.location.href = 'kwitansi.php';
          </script>";
    } else {
        echo "<script>
            alert('Kwitansi gagal diubah!');
            document.location.href = 'kwitansi.php';
          </script>";
    }
}
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Kwitansi</h4>
        </div>
        <!-- <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="guru.php"
                            class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white"><i
                                class="fas fa-angle-left"></i> Kembali</a>
                    </li>
                </ol>

            </div>
        </div> -->
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="d-md-flex mb-3">
                    <h3 class="box-title mb-0">Pengaturan Kwitansi</h3>
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
                <form class="form-horizontal form-material" action="" method="POST" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Logo</label>
                                <img src="../assets/img/logo_kwitansi/<?= $k["logo"]; ?>"
                                    class="img-thumbnail w-50 mb-3">
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="hidden" name="logo_lama" value="<?= $k["logo"]; ?>" />
                                    <input type="file" class="form-control p-0 border-0" name="logo" />
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Nama Yayasan</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" value="<?= $k["yayasan"]; ?>"
                                        name="yayasan" />
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="example-email" class="col-md-12 p-0">Nama Sekolah</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" value="<?= $k["sekolah"]; ?>"
                                        name="sekolah" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-4">
                                <label class="col-sm-12">Bendahara</label>

                                <div class="col-sm-12 border-bottom">
                                    <select class="form-select shadow-none p-0 border-0 form-control-line"
                                        name="id_bendahara">
                                        <?php foreach ($bendahara as $b): ?>
                                            <option value="<?= $b["id_user"]; ?>"><?= $b["nama"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Logo</label>
                                <img src="../assets/img/ttd/<?= $k["ttd"]; ?>" class="img-thumbnail w-50 mb-3">
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="hidden" name="ttd_lama" value="<?= $k["ttd"]; ?>" />
                                    <input type="file" class="form-control p-0 border-0" name="ttd" />
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="col-sm-12">
                                    <button class="btn btn-success" type="submit" name="edit_kwitansi">Ubah</button>
                                </div>
                            </div>
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