<?php
session_start();
include "../templates/header.php";

if (isset($_POST["add_tahun_ajaran"])) {
    if (tahun_ajaran_add($_POST) > 0) {
        echo "<script>
            alert('Tahun ajaran berhasil ditambah!');
            document.location.href = 'tahun_ajaran.php';
          </script>";
    } else {
        echo "<script>
            alert('Tahun ajaran gagal ditambah!');
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
                        <label class="col-md-12 p-0">Tahun Ajaran</label>
                        <div class="col-md-5 border-bottom p-0">
                            <input type="number" min="1900" max="3000" step="1" value="2015"
                                class="form-control p-0 border-0" name="tahun_ajaran_1" />
                        </div>
                        <div class="col-md-2 text-center">-</div>
                        <div class="col-md-5 border-bottom p-0">
                            <input type="number" min="1900" max="3000" step="1" value="2016"
                                class="form-control p-0 border-0" name="tahun_ajaran_2" />
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit" name="add_tahun_ajaran">Tambah</button>
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