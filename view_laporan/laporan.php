<?php
session_start();
include "../templates/header.php";

$rombel = query("SELECT * FROM rombel");
$tahun_ajaran = query("SELECT * FROM tahun_ajaran");

if (!isset($_POST["search"])) {
    $pembayaran = query(
        "SELECT * FROM pembayaran
        INNER JOIN siswa ON siswa.id_siswa = pembayaran.id_siswa
        INNER JOIN jenis_pembayaran ON jenis_pembayaran.id_jenis_pembayaran = pembayaran.id_jenis_pembayaran
        ORDER BY pembayaran.id_pembayaran DESC"
    );

    $ppb_amount = query(
        "SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran"
    )[0];
} else {

    $tanggal_awal = $_POST["tanggal_awal"];
    $tanggal_akhir = $_POST["tanggal_akhir"];

    $pembayaran = query(
        "SELECT * FROM pembayaran
        INNER JOIN siswa ON siswa.id_siswa = pembayaran.id_siswa
        INNER JOIN jenis_pembayaran ON jenis_pembayaran.id_jenis_pembayaran = pembayaran.id_jenis_pembayaran
        WHERE tanggal_pembayaran BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
        ORDER BY pembayaran.id_pembayaran DESC"
    );

    $pembayaran_amount = query(
        "SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran  WHERE tanggal_pembayaran BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"
    )[0];
}
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Rekap Laporan</h4>
        </div>
        <!-- <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="pembayaran_add.php"
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
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="white-box">
                <div class="d-md-flex mb-3">
                    <h3 class="col-12 col-md-6 box-title mb-0">Data Rekap Laporan</h3>

                    <form class="col-12 col-md-6 app-search me-3" method="post" action="">
                        <div class="row">
                            <div class="col-4 border-bottom">
                                <select class="form-select shadow-none p-0 border-0" name="id_rombel">
                                    <option>Pilih Rombel</option>
                                    <?php foreach ($rombel as $r): ?>
                                        <option value="<?= $r["id_rombel"]; ?>"><?= $r["rombel"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-5 border-bottom">
                                <select class="form-select shadow-none p-0 border-0" name="id_tahun_ajaran">
                                    <option>Pilih Tahun Ajaran</option>
                                    <?php foreach ($tahun_ajaran as $ta): ?>
                                        <option value="<?= $ta["id_tahun_ajaran"]; ?>"><?= $ta["tahun_ajaran"]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                    <button type="submit" name="search" class="btn btn-info">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <?php if (!isset($_POST["tanggal_awal"])): ?>
                                        <a href="riwayat_print.php?tanggal_awal=0&tanggal_akhir=0" name="print"
                                            class="btn btn-warning" target="_blank"><i class="fas fa-print"></i></a>
                                    <?php else: ?>
                                        <a href="riwayat_print.php?tanggal_awal=<?= $_POST["tanggal_awal"]; ?>&tanggal_akhir=<?= $_POST["tanggal_akhir"]; ?>"
                                            name="print" class="btn btn-warning" target="_blank"><i
                                                class="fas fa-print"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </form>
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
                    <table class="no-wrap" id="data-table" cellpadding="20" cellspading="0">
                        <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;" rowspan="2">NO.</th>
                                <th style="text-align:center; vertical-align:middle;" rowspan="2">NAMA</th>
                                <th style="text-align:center; vertical-align:middle;" rowspan="2">TOTAL BPP</th>
                                <th style="text-align:center; vertical-align:middle;" rowspan="2">BPP DIBAYAR</th>
                                <th style="text-align:center; vertical-align:middle;" colspan="12">PEMBAYARAN BBP</th>
                                <th style="text-align:center; vertical-align:middle;" rowspan="2">JUMLAH</th>
                                <th style="text-align:center; vertical-align:middle;" rowspan="2">SISA</th>
                                <th style="text-align:center; vertical-align:middle;" rowspan="2">TOTAL PEMBAYARAN</th>
                            </tr>
                            <tr>
                                <th>JULI</th>
                                <th>AGUSTUS</th>
                                <th>SEPTEMBER</th>
                                <th>OKTOBER</th>
                                <th>NOVEMBER</th>
                                <th>DESEMBER</th>
                                <th>JANUARI</th>
                                <th>FEBRUARI</th>
                                <th>MARET</th>
                                <th>APRIL</th>
                                <th>MEI</th>
                                <th>JUNI</th>
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
                                        <?= $p["nama_siswa"]; ?>
                                    </td>
                                    <td class="txt-oflo">
                                        <?= $p["nominal"]; ?>
                                    </td>
                                    <td class="txt-oflo">
                                    </td>
                                    <td class="txt-oflo">
                                    </td>
                                    <td class="txt-oflo">
                                    </td>
                                    <td class="txt-oflo">
                                    </td>
                                    <td class="txt-oflo">
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>

                            <tr>
                                <td colspan="16" class="text-center">TOTAL</td>
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
include "../templates/footer.php";
?>