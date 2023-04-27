<?php
session_start();
include "../templates/header.php";

$roles = query("SELECT * FROM users_role WHERE NOT id_role = 3");

if (isset($_POST["edit_profile"])) {
    if (profile_edit($_POST) > 0) {
        echo "<script>
            alert('Profile berhasil diubah!');
            document.location.href = 'profile.php';
          </script>";
    } else {
        echo "<script>
            alert('Profile gagal diubah!');
            document.location.href = 'profile.php';
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
                    <li>
                        <!-- <a href="pengguna_add.php"
                            class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white"><i
                                class="fas fa-plus"></i> Tambah</a> -->
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
                    <h3 class="box-title mb-0">Profile</h3>
                    <div class="col-md-3 col-sm-3 col-xs-3 ms-auto">
                        <a href="profile.php"
                            class="btn btn-danger d-md-block pull-right w-100 waves-effect waves-light text-white"><i
                                class="fas fa-angle-left"></i> Kembali</a>
                    </div>
                </div>
                <form class="form-horizontal form-material" action="" method="POST">

                    <input type="hidden" value="<?= $user["id_user"]; ?>" name="id_user" />

                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Nama Lengkap</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" class="form-control p-0 border-0" value="<?= $user["nama"]; ?>"
                                name="nama" />
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="example-email" class="col-md-12 p-0">Email</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="email" class="form-control p-0 border-0" value="<?= $user["email"]; ?>"
                                name="email" />
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Username</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="text" class="form-control p-0 border-0" value="<?= $user["username"]; ?>"
                                name="username" />
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-md-12 p-0">Password</label>
                        <div class="col-md-12 border-bottom p-0">
                            <input type="password" class="form-control p-0 border-0" value="<?= $user["password"]; ?>"
                                name="password" />
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-sm-12">Role</label>

                        <div class="col-sm-12 border-bottom">
                            <select class="form-select shadow-none p-0 border-0 form-control-line" name="role">
                                <option value="<?= $user["role_id"]; ?>"><?= $user["role"]; ?></option>
                                <?php foreach ($roles as $r): ?>
                                    <option value="<?= $r["id_role"]; ?>"><?= $r["role"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit" name="edit_profile">Ubah</button>
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