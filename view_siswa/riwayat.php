<?php
session_start();
include "header.php";

$id_siswa = $user["id_siswa"];

$pembayaran = query(
    "SELECT * FROM pembayaran
        INNER JOIN siswa ON siswa.id_siswa = pembayaran.id_siswa
        INNER JOIN jenis_pembayaran ON jenis_pembayaran.id_jenis_pembayaran = pembayaran.id_jenis_pembayaran
        WHERE pembayaran.id_siswa = $id_siswa
        ORDER BY pembayaran.id_pembayaran DESC"
);

$pembayaran_amount = query(
    "SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_siswa = $id_siswa"
)[0];
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Riwayat Pembayaran</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="pembayaran_add.php"
                            class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white"><i
                                class="fas fa-plus"></i> Tambah</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="d-md-flex mb-3">
                    <h3 class="col-12 col-md-6 box-title mb-0">Data Rimayat Pembayaran</h3>


                </div>

                <?php if (isset($_POST["tanggal_awal"])): ?>
                    <div class="my-3">
                        <p>Riwayat Pembayaran pada tanggal :
                            <strong>
                                <?= date("d F Y", strtotime($_POST["tanggal_awal"])); ?> s/d
                                <?= date("d F Y", strtotime($_POST["tanggal_akhir"])); ?>
                            </strong>
                        </p>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="table no-wrap" id="data-table">
                        <thead>
                            <tr>
                                <th class="border-top-0">No.</th>
                                <th class="border-top-0">ID Pembayaran</th>
                                <th class="border-top-0">Nama Siswa</th>
                                <th class="border-top-0">Jenis Pembayaran</th>
                                <th class="border-top-0">Nominal</th>
                                <th class="border-top-0 text-end">Tanggal Pembayaran</th>
                                <th class="border-top-0">Bukti Pembayaran</th>
                                <th class="border-top-0">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($pembayaran as $p): ?>
                                <tr>
                                    <td>
                                        <?= $i; ?>
                                    </td>
                                    <td class="txt-oflo">
                                        <?= date("dmy", strtotime($p["tanggal_pembayaran"])) . $p["id_pembayaran"]; ?>
                                    </td>
                                    <td class="txt-oflo">
                                        <?= $p["nama_siswa"]; ?>
                                    </td>
                                    <td class="txt-oflo">
                                        <?= $p["jenis_pembayaran"]; ?>
                                    </td>
                                    <td class="txt-oflo">
                                        Rp.
                                        <?= number_format($p["nominal_pembayaran"], 0, ',', '.'); ?>
                                    </td>
                                    <td class="txt-oflo text-end">
                                        <?= date("d F Y", strtotime($p["tanggal_pembayaran"])); ?>
                                    </td>
                                    <td class="txt-oflo text-center">

                                        <?php if ($p["bukti"] == "default.jpg"): ?>
                                            <span class="badge bg-success">Pembayaran Tunai</span>
                                        <?php else: ?>
                                            <a href="../assets/img/bukti/<?= $p["bukti"]; ?>" target="_blank"><span
                                                    class="badge bg-info">Buka</span></a>
                                        <?php endif; ?>

                                    </td>
                                    <td class="txt-oflo">
                                        <?php if ($p["status"] == 1): ?>
                                            <span class="badge bg-success">Diterima</span>
                                            <a href="kwitansi.php?id_pembayaran=<?= $p["id_pembayaran"] ?>"
                                                class="badge btn-info" target="_blank">Kwitansi</a>
                                        <?php else: ?>
                                            <span class="badge bg-warning">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>

                            <tr>
                                <td colspan="4" class="text-center">TOTAL</td>
                                <td>
                                    Rp.
                                    <?= number_format($pembayaran_amount["amount"], 0, ',', '.'); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>