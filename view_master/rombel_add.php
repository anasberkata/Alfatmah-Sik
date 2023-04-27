<?php
session_start();
include "../templates/header.php";

$guru = query("SELECT * FROM guru");

if (isset($_POST["add_rombel"])) {
    if (rombel_add($_POST) > 0) {
        echo "<script>
            alert('Rombel berhasil ditambah!');
            document.location.href = 'rombel.php';
          </script>";
    } else {
        echo "<script>
            alert('Rombel gagal ditambah!');
            document.location.href = 'rombel.php';
          </script>";
    }
}
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Rombongan Belajar</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="rombel.php"
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
                    <h3 class="box-title mb-0">Tambah Rombel</h3>
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
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Nama Rombel</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" class="form-control p-0 border-0" name="rombel" />
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-sm-12">Wali Kelas</label>

                        <div class="col-sm-12 border-bottom">
                            <select class="form-select shadow-none p-0 border-0 form-control-line" name="id_guru">
                                <option>Pilih Wali Kelas</option>
                                <?php foreach ($guru as $g): ?>
                                    <option value="<?= $g["id_guru"]; ?>"><?= $g["nama_guru"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit" name="add_rombel">Tambah</button>
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