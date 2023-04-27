<?php
session_start();
include "../templates/header.php";

$roles = query("SELECT * FROM users_role WHERE NOT id_role = 3");
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Pengguna</h4>
        </div>
        <!-- <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="pengguna_add.php"
                            class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white"><i
                                class="fas fa-plus"></i> Tambah</a>
                    </li>
                </ol>
            </div>
        </div> -->
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-6 col-sm-12">
            <div class="white-box">
                <div class="d-md-flex mb-3">
                    <h3 class="box-title mb-0">Profile Anda</h3>
                    <div class="col-md-3 col-sm-3 col-xs-3 ms-auto">
                        <a href="profile_edit.php"
                            class="btn btn-danger d-md-block pull-right w-100 waves-effect waves-light text-white"><i
                                class="fas fa-edit"></i> Edit</a>
                    </div>
                </div>
                <ul class="chatonline">
                    <li>

                        <div class="ms-2">
                            <span class="text-dark"><?= $user["nama"]; ?>
                                <small
                                    class="d-block text-success d-block">Username : <?= $user["username"]; ?>
                                </small>
                                <small
                                    class="d-block text-success d-block">Email : <?= $user["email"]; ?>
                                </small>
                                <small
                                    class="d-block text-success d-block">Role : <?= $user["role"]; ?>
                                </small>
                            </span>
                        </div>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
include "../templates/footer.php";
?>