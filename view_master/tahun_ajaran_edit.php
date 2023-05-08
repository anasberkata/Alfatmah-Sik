<?php
session_start();
include "../templates/header.php";

$id_tahun_ajaran = $_GET["id_tahun_ajaran"];

$ta = query(
    "SELECT * FROM tahun_ajaran
    WHERE id_tahun_ajaran = $id_tahun_ajaran"
)[0];

$ta_array = explode(" - ", $ta["tahun_ajaran"]);
$tahun_ajaran_1 = $ta_array[0];
$tahun_ajaran_2 = $ta_array[1];

if (isset($_POST["edit_tahun_ajaran"])) {
    if (tahun_ajaran_edit($_POST) > 0) {
        echo "<script>
            alert('Tahun ajaran berhasil diubah!');
            document.location.href = 'tahun_ajaran.php';
          </script>";
    } else {
        echo "<script>
            alert('Tahun ajaran gagal diubah!');
            document.location.href = 'tahun_ajaran.php';
          </script>";
    }
}
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tahun Ajaran</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="tahun_ajaran.php"
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
                    <h3 class="box-title mb-0">Tambah Tahun Ajaran</h3>
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
                    <div class="form-group row mb-4">
                        <input type="hidden" value="<?= $ta["id_tahun_ajaran"]; ?>" name="id_tahun_ajaran" />
                        <label class="col-md-12 p-0">Tahun Ajaran</label>
                        <div class="col-md-5 border-bottom p-0">
                            <input type="number" class="form-control p-0 border-0" value="<?= $tahun_ajaran_1; ?>"
                                name="tahun_ajaran_1" />
                        </div>
                        <div class="col-md-2 text-center">-</div>
                        <div class="col-md-5 border-bottom p-0">
                            <input type="number" class="form-control p-0 border-0" value="<?= $tahun_ajaran_2; ?>"
                                name="tahun_ajaran_2" />
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit" name="edit_tahun_ajaran">Ubah</button>
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