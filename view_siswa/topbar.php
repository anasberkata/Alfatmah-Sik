<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin6">

            <a class="navbar-brand" href="#">
                <b class="logo-text text-dark">
                    S.I.K. ALFATMAH
                </b>
            </a>

            <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

            <ul class="navbar-nav ms-auto d-flex align-items-center">

                <li>
                    <a class="profile-pic" href="profile.php"><span class="text-white font-medium">
                            <?= $user["nama_siswa"]; ?>
                        </span></a>
                </li>
                <li><a href="../logout.php" class="mr-5 profile-pic"><i class="fas fa-sign-out-alt"
                            onclick="return confirm('Yakin ingin keluar dari aplikasi?');"></i></a></li>
            </ul>
        </div>
    </nav>
</header>