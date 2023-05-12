<?php
session_start();
include "header.php";

$id_siswa = $user["id_siswa"];

$pembayaran = query("SELECT * FROM pembayaran WHERE id_siswa = $id_siswa");
$total_pembayaran = count($pembayaran);

$pembayaran_diterima = query("SELECT * FROM pembayaran WHERE id_siswa = $id_siswa AND status = 1");
$total_pembayaran_diterima = count($pembayaran_diterima);

$pembayaran_pending = query("SELECT * FROM pembayaran WHERE id_siswa = $id_siswa AND status = 2");
$total_pembayaran_pending = count($pembayaran_pending);

$pembayaran_amount = query(
    "SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_siswa = $id_siswa"
)[0];

$pembayaran_d = query(
    "SELECT * FROM pembayaran
        INNER JOIN siswa ON siswa.id_siswa = pembayaran.id_siswa
        INNER JOIN jenis_pembayaran ON jenis_pembayaran.id_jenis_pembayaran = pembayaran.id_jenis_pembayaran
        WHERE pembayaran.id_siswa = $id_siswa AND status = 2
        ORDER BY pembayaran.id_pembayaran DESC"
);
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard Siswa</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">

            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Pembayaran</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash3"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ms-auto"><span class="counter text-info">
                            <?= $total_pembayaran; ?> Pembayaran
                        </span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Pembayaran Diterima</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ms-auto"><span class="counter text-success">
                            <?= $total_pembayaran_diterima; ?> Pembayaran
                        </span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Pembayaran Pending</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li>
                        <div id="sparklinedash4"><canvas width="67" height="30"
                                style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                        </div>
                    </li>
                    <li class="ms-auto"><span class="counter text-warning">
                            <?= $total_pembayaran_pending; ?> Pembayaran
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="d-md-flex mb-3">
                    <h3 class="box-title mb-0">Pembayaran Pending</h3>
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
                            <?php foreach ($pembayaran_d as $p): ?>
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
                                                    class="badge bg-info">Lihat</span></a>
                                        <?php endif; ?>

                                    </td>
                                    <td class="txt-oflo">
                                        <?php if ($p["status"] == 1): ?>
                                            <span class="badge bg-success">Diterima</span>
                                            <a href="">Download Kwitansi</a>
                                        <?php else: ?>
                                            <span class="badge bg-warning">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
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