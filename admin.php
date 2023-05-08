<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: view_admin/dashboard.php");
    exit;
}

include "templates/auth_header.php";
?>

<div class="container-fluid">

    <div class="row justify-content-center">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-9 col-md-12">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <img src="assets/img/logo-alfatmah_new.png" width="40%" class="my-3">
                    <!-- <h3>S.I.K.A</h3> -->
                    <h3>SISTEM INFORMASI KEUANGAN ALFATMAH</h3>
                    <h6>-- LOGIN ADMIN --</h6>
                </div>
                <div class="card-body">

                    <?php if (isset($_GET["pesan"])): ?>
                        <p class="alert alert-danger my-4" style="font-style: italic; color: red; text-align: center;">
                            <?= $_GET["pesan"]; ?>
                        </p>
                    <?php endif; ?>

                    <form class="form-horizontal form-material" action="cek_admin.php" method="POST">
                        <div class="form-group mb-4">
                            <label for="example-email" class="col-md-12 p-0">Username</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" class="form-control p-0 border-0" name="username" />
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Password</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="password" class="form-control p-0 border-0" name="password" />
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="col-sm-12 text-center">
                                <button class="btn btn-success w-50" type="submit" name="login">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>

</div>

<?php
include "templates/auth_footer.php";
?>