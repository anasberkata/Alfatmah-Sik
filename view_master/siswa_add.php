<?php
session_start();
include "../templates/header.php";

$rombel = query("SELECT * FROM rombel");
$tahun_ajaran = query("SELECT * FROM tahun_ajaran");

if (isset($_POST["add_siswa"])) {
    if (siswa_add($_POST) > 0) {
        echo "<script>
            alert('Siswa berhasil ditambah!');
            document.location.href = 'siswa.php';
          </script>";
    } else {
        echo "<script>
            alert('Siswa gagal ditambah!');
            document.location.href = 'siswa.php';
          </script>";
    }
}
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Siswa</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="siswa.php"
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
                    <h3 class="box-title mb-0">Tambah Siswa</h3>
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
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">NIS</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" name="nis" />
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">NISN</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" name="nisn" />
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Nama Siswa</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" name="nama_siswa" />
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-sm-12">Jenis Kelamin</label>

                                <div class="col-sm-12 border-bottom">
                                    <select class="form-select shadow-none p-0 border-0 form-control-line" name="jk">
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Username</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" name="username" />
                                </div>
                            </div>
                            <!-- <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Password</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="password" class="form-control p-0 border-0" name="password" />
                                </div>
                            </div> -->
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-group mb-4">
                                <label class="col-sm-12">Rombel</label>

                                <div class="col-sm-12 border-bottom">
                                    <select class="form-select shadow-none p-0 border-0 form-control-line"
                                        name="id_rombel">
                                        <option>Pilih Rombel</option>
                                        <?php foreach ($rombel as $r): ?>
                                            <option value="<?= $r["id_rombel"]; ?>"><?= $r["rombel"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-sm-12">Tahun Ajaran</label>

                                <div class="col-sm-12 border-bottom">
                                    <select class="form-select shadow-none p-0 border-0 form-control-line"
                                        name="id_tahun_ajaran">
                                        <option>Pilih Tahun Ajaran</option>
                                        <?php foreach ($tahun_ajaran as $ta): ?>
                                            <option value="<?= $ta["id_tahun_ajaran"]; ?>"><?= $ta["tahun_ajaran"]; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Alamat</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <textarea rows="5" class="form-control p-0 border-0" name="alamat"></textarea>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">No.Telepon</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" class="form-control p-0 border-0" name="phone" />
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="col-sm-12 text-end">
                                    <button class="btn btn-success" type="submit" name="add_siswa">Tambah</button>
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