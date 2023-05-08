<?php
session_start();
include "../templates/header.php";

if (isset($_POST["import_siswa"])) {
    if (siswa_import($_POST) > 0) {
        echo "<script>
            alert('Import siswa berhasil ditambah!');
            document.location.href = 'siswa.php';
          </script>";
    } else {
        echo "<script>
            alert('Import siswa gagal ditambah!');
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
        <div class="col-sm-6 col-md-6 col-lg-6">
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
                <form class="form-horizontal form-material" action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <p>Download format excel : <a href="../format_excel/format_siswa.xls">Download</a></p>
                                <label class="col-md-12 p-0">Pilih file</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="file" class="form-control p-0 border-0" name="file_excel" required />
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="col-sm-12 text-end">
                                    <button class="btn btn-success" type="submit" name="import_siswa">Import</button>
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