<?php
session_start();
include "header.php";

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
                    <li class="mb-2">
                        <div class="ms-2">
                            <span class="text-dark"><?= $user["nama_siswa"]; ?>
                                <small
                                    class="d-block text-success d-block">NIS : <?= $user["nis"]; ?>
                                </small>
                                <small
                                    class="d-block text-success d-block">NISN : <?= $user["nisn"]; ?>
                                </small>

                                <br>

                                <small
                                    class="d-block text-success d-block">Rombel : <?= $user["rombel"]; ?>
                                </small>

                                <small
                                    class="d-block text-success d-block">Wali Kelas : <?= $user["nama_guru"]; ?>
                                </small>
                                
                                <small
                                    class="d-block text-success d-block">Tahun Ajaran : <?= $user["tahun_ajaran"]; ?>
                                </small>
                            </span>
                        </div>
                    </li>
                    <li class="mb-2">
                        <div class="ms-2">
                            <span class="text-dark">Akun
                                <small
                                    class="d-block text-success d-block">Username : <?= $user["username"]; ?>
                                </small>
                                <small
                                    class="d-block text-success d-block">Password : <?= $user["password"]; ?>
                                </small>
                            </span>
                        </div>
                    </li>

                    <li class="mb-2">
                        <div class="ms-2">
                            <span class="text-dark">Identitas
                                <small
                                    class="d-block text-success d-block">Jenis Kelamin : <?= $user["jk"]; ?>
                                </small>
                                <small
                                    class="d-block text-success d-block">Alamat : <?= $user["alamat"]; ?>
                                </small>
                                <small
                                    class="d-block text-success d-block">Phone / Whatsapp : <?= $user["phone"]; ?>
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
include "footer.php";
?>