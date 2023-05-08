<?php
session_start();
include "../templates/header.php";

$siswa = query("SELECT * FROM siswa INNER JOIN rombel ON rombel.id_rombel = siswa.id_rombel");
$jenis_pembayaran = query("SELECT * FROM jenis_pembayaran");

if (isset($_POST["add_pembayaran"])) {
    if (pembayaran_add($_POST) > 0) {
        echo "<script>
            alert('Pembayaran berhasil ditambah!');
            document.location.href = 'pembayaran.php';
          </script>";
    } else {
        echo "<script>
            alert('Pembayaran gagal ditambah!');
            document.location.href = 'pembayaran.php';
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
                    <li><a href="pembayaran.php"
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
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="d-md-flex mb-3">
                    <h3 class="box-title mb-0">Tambah Pembayaran</h3>
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

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#bpp">BPP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#bbp">BBP</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="bpp" class="tab-pane active">
                        <h3>Home</h3>
                        <p>Content for the home tab goes here.</p>
                    </div>
                    <div id="bbp" class="tab-pane">
                        <h3>Profile</h3>
                        <p>Content for the profile tab goes here.</p>
                    </div>
                </div>





                <form class="form-horizontal form-material" action="" method="POST">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-4">
                                <label class="col-sm-12">Siswa</label>

                                <div class="col-sm-12 border-bottom">
                                    <select class="form-select shadow-none p-0 border-0 form-control-line"
                                        name="id_siswa">
                                        <option>Pilih Siswa</option>
                                        <?php foreach ($siswa as $s): ?>
                                            <option value="<?= $s["id_siswa"]; ?>"><?= $s["nama_siswa"]; ?> || Kelas : <?= $s["rombel"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-sm-12">Jenis Pembayaran</label>

                                <div class="col-sm-12 border-bottom">
                                    <select class="form-select shadow-none p-0 border-0 form-control-line"
                                        name="id_jenis_pembayaran">
                                        <option>Pilih Jenis Pembayaran</option>
                                        <?php foreach ($jenis_pembayaran as $jp): ?>
                                            <option value="<?= $jp["id_jenis_pembayaran"]; ?>"><?= $jp["jenis_pembayaran"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">BBP Bulan</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="month" class="form-control p-0 border-0" name="bbp_bulan" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Nominal (Rp.)</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" name="nominal" />
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Tanggal Pembayaran</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="date" class="form-control p-0 border-0" name="tanggal_pembayaran" />
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="col-sm-12 text-end">
                                    <button class="btn btn-success" type="submit" name="add_pembayaran">Tambah</button>
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