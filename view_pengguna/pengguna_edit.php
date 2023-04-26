<?php
session_start();
include "../templates/header.php";

$id_user = $_GET["id_user"];
$u = query(
    "SELECT * FROM users
    INNER JOIN users_role ON users.role_id = users_role.id_role
    WHERE id_user = $id_user"
)[0];

$roles = query("SELECT * FROM users_role WHERE NOT id_role = 3");

if (isset($_POST["edit_pengguna"])) {
    if (pengguna_edit($_POST) > 0) {
        echo "<script>
            alert('Pengguna berhasil diubah!');
            document.location.href = 'pengguna.php';
          </script>";
    } else {
        echo "<script>
            alert('Pengguna gagal diubah!');
            document.location.href = 'pengguna.php';
          </script>";
    }
}
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pengguna</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="pengguna.php"
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
                    <h3 class="box-title mb-0">Edit Pengguna</h3>
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

                    <input type="hidden" value="<?= $u["id_user"]; ?>" name="id_user" />

                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Nama Lengkap</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" class="form-control p-0 border-0" value="<?= $u["nama"]; ?>"
                                name="nama" />
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="example-email" class="col-md-12 p-0">Email</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="email" class="form-control p-0 border-0" value="<?= $u["email"]; ?>"
                                name="email" />
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Username</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" class="form-control p-0 border-0" value="<?= $u["username"]; ?>"
                                name="username" />
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Password</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="password" class="form-control p-0 border-0" value="<?= $u["password"]; ?>"
                                name="password" />
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-sm-12">Role</label>

                        <div class="col-sm-12 border-bottom">
                            <select class="form-select shadow-none p-0 border-0 form-control-line" name="role">
                                <option value="<?= $u["role_id"]; ?>"><?= $u["role"]; ?></option>
                                <?php foreach ($roles as $r): ?>
                                    <option value="<?= $r["id_role"]; ?>"><?= $r["role"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit" name="edit_pengguna">Ubah</button>
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