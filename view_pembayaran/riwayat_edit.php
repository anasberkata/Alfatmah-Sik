<?php
session_start();
include "../templates/header.php";

$id_pembayaran = $_GET["id_pembayaran"];
$p = query("SELECT * FROM pembayaran
                INNER JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
                INNER JOIN rombel ON siswa.id_rombel = rombel.id_rombel
                INNER JOIN jenis_pembayaran ON pembayaran.id_jenis_pembayaran = jenis_pembayaran.id_jenis_pembayaran
                WHERE id_pembayaran = $id_pembayaran
                ")[0];

$siswa = query("SELECT * FROM siswa INNER JOIN rombel ON rombel.id_rombel = siswa.id_rombel");
// $jenis_pembayaran = query("SELECT * FROM jenis_pembayaran");

$bulan_pembayaran = $p["bbp_bulan"] - 1;

switch ($bulan_pembayaran) {
    case $bulan_pembayaran:
        $bulan[$bulan_pembayaran];
        break;

    default:
        echo "Bulan tidak terdaftar";
}

if (isset($_POST["edit_pembayaran"])) {
    if (pembayaran_edit($_POST) > 0) {
        echo "<script>
            alert('Pembayaran berhasil diubah!');
            document.location.href = 'riwayat.php';
          </script>";
    } else {
        echo "<script>
            alert('Pembayaran gagal diubah!');
            document.location.href = 'riwayat.php';
          </script>";
    }
}
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Ubah Pembayaran</h4>
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
        <div class="col-md-12 col-lg-12 col-sm-12">


            <div class="white-box">
                <div class="d-md-flex mb-3">
                    <h3 class="box-title mb-0">Ubah Data Pembayaran
                        <?= $p["deskripsi"]; ?>
                    </h3>
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

                <input type="hidden" value="<?= $p["id_pembayaran"]; ?>" name="id_pembayaran" />

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-4">
                                <label class="col-sm-12">Siswa</label>

                                <div class="col-sm-12 border-bottom">
                                    <input type="hidden" class="form-control p-0 border-0" name="id_siswa" value="<?= $p["id_siswa"]; ?>" />
                                    <input type="text" class="form-control p-0 border-0" value="<?= $p["nama_siswa"]; ?> || Kelas : <?= $p["rombel"]; ?>" readonly />
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-sm-12">Jenis Pembayaran</label>

                                <div class="col-sm-12 border-bottom">
                                    <input type="hidden" class="form-control p-0 border-0" name="id_jenis_pembayaran" value="<?= $p["id_jenis_pembayaran"]; ?>" />
                                    <input type="text" class="form-control p-0 border-0" value="<?= $p["jenis_pembayaran"]; ?>"
                                        readonly />
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            
                        <?php if($p["id_jenis_pembayaran"] == 1) : ?>
                            <div class="form-group mb-4 d-none">
                                <label class="col-sm-12">BBP Bulan</label>
                                <div class="row">
                                    <div class="col-sm-6 border-bottom">
                                        <select class="form-select shadow-none p-0 border-0 form-control-line"
                                            name="bbp_bulan">
                                            <option value="<?= $p["bbp_bulan"]; ?>"><?= $bulan[$bulan_pembayaran]; ?>
                                            </option>
                                            <?php $i = 1; ?>
                                            <?php foreach ($bulan as $b): ?>
                                                <option value="<?= $i; ?>"><?= $b; ?></option>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 border-bottom p-0">
                                        <input type="number" min="1900" max="3000" step="1" value="<?= $p["bbp_tahun"]; ?>"
                                            class="form-control p-0 border-0" name="bbp_tahun" />
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="form-group mb-4">
                                <label class="col-sm-12">BBP Bulan</label>
                                <div class="row">
                                    <div class="col-sm-6 border-bottom">
                                        <select class="form-select shadow-none p-0 border-0 form-control-line"
                                            name="bbp_bulan">
                                            <option value="<?= $p["bbp_bulan"]; ?>"><?= $bulan[$bulan_pembayaran]; ?>
                                            </option>
                                            <?php $i = 1; ?>
                                            <?php foreach ($bulan as $b): ?>
                                                <option value="<?= $i; ?>"><?= $b; ?></option>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 border-bottom p-0">
                                        <input type="number" min="1900" max="3000" step="1" value="<?= $p["bbp_tahun"]; ?>"
                                            class="form-control p-0 border-0" name="bbp_tahun" />
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Nominal (Rp.)</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" name="nominal_pembayaran" value="<?= $p["nominal_pembayaran"]; ?>" />
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Tanggal Pembayaran</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="date" class="form-control p-0 border-0" name="tanggal_pembayaran" value="<?= $p["tanggal_pembayaran"]; ?>" />
                                </div>
                            </div>

                            <div class="form-group mb-4 d-none">
                                <label class="col-md-12 p-0">Bukti Pembayaran</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" name="bukti_pembayaran_lama" value="<?= $p["bukti"]; ?>" />
                                    <input type="file" class="form-control p-0 border-0" name="bukti_pembayaran" />
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="col-sm-12 text-end">
                                    <button class="btn btn-success" type="submit"
                                        name="edit_pembayaran">Ubah</button>
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