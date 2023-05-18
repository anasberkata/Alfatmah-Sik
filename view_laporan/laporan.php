<?php
session_start();
include "../templates/header.php";

$rombel = query("SELECT * FROM rombel");
$tahun_ajaran = query("SELECT * FROM tahun_ajaran");

if (isset($_POST["search"])) {
    $id_rombel = $_POST["id_rombel"];
    $id_tahun_ajaran = $_POST["id_tahun_ajaran"];

    $siswa = query("
    SELECT * FROM siswa
    INNER JOIN rombel ON rombel.id_rombel = siswa.id_rombel
    INNER JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran = siswa.id_tahun_ajaran
    INNER JOIN guru ON guru.id_guru = rombel.id_guru
    WHERE siswa.id_rombel = $id_rombel
    ORDER BY siswa.id_tahun_ajaran ASC, rombel.rombel ASC
");
} else {
    $siswa = query("
    SELECT * FROM siswa
    INNER JOIN rombel ON rombel.id_rombel = siswa.id_rombel
    INNER JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran = siswa.id_tahun_ajaran
    INNER JOIN guru ON guru.id_guru = rombel.id_guru
    ORDER BY siswa.id_tahun_ajaran ASC, rombel.rombel ASC
");
}

$bpp_nominal = query("SELECT * FROM jenis_pembayaran WHERE id_jenis_pembayaran = 1")[0];
$bbp_nominal = query("SELECT * FROM jenis_pembayaran WHERE id_jenis_pembayaran = 2")[0];
$total_pembayaran = $bpp_nominal["nominal"] + ($bbp_nominal["nominal"] * 12);
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Rekap Laporan</h4>
        </div>
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
                                        <option value="<?= $ta["id_tahun_ajaran"]; ?>"><?= $ta["tahun_ajaran"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                    <button type="submit" name="search" class="btn btn-info">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <?php if (!isset($_POST["id_rombel"])): ?>
                                        <a href="laporan_print.php?id_rombel=0&id_tahun_ajaran=0" name="print"
                                            class="btn btn-warning" target="_blank"><i class="fas fa-print"></i></a>
                                    <?php else: ?>
                                        <a href="laporan_print.php?id_rombel=<?= $_POST["id_rombel"]; ?>&id_tahun_ajaran=<?= $_POST["id_tahun_ajaran"]; ?>"
                                            name="print" class="btn btn-warning" target="_blank"><i
                                                class="fas fa-print"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <?php if (isset($_POST["id_rombel"])):
                    $id_rombel = $_POST["id_rombel"];
                    $id_tahun_ajaran = $_POST["id_tahun_ajaran"];
                    $kelas = query("SELECT * FROM rombel INNER JOIN guru ON rombel.id_guru = guru.id_guru WHERE id_rombel = $id_rombel")[0];
                    $ta = query("SELECT * FROM tahun_ajaran WHERE id_tahun_ajaran = $id_tahun_ajaran")[0];
                    ?>
                    <div class="my-3">
                        <p>
                            Kelas : <strong>
                                <?= $kelas["rombel"] ?>
                            </strong>
                            <br>
                            Wali Kelas : <strong>
                                <?= $kelas["nama_guru"] ?>
                            </strong>
                            <br>
                            Tahun Pelajaran : <strong>
                                <?= $ta["tahun_ajaran"] ?>
                            </strong>
                        </p>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="no-wrap" id="data-table" cellpadding="20" cellspacing="0">
                        <thead class="bg-info">
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
                                <?php
                                $bulanIndo = array(
                                    1 => "JANUARI",
                                    2 => "FEBRUARI",
                                    3 => "MARET",
                                    4 => "APRIL",
                                    5 => "MEI",
                                    6 => "JUNI",
                                    7 => "JULI",
                                    8 => "AGUSTUS",
                                    9 => "SEPTEMBER",
                                    10 => "OKTOBER",
                                    11 => "NOVEMBER",
                                    12 => "DESEMBER"
                                );
                                for ($j = 7; $j <= 12; $j++):
                                    ?>
                                    <th>
                                        <?= $bulanIndo[$j]; ?>
                                    </th>
                                <?php endfor; ?>
                                <?php for ($j = 1; $j <= 6; $j++):
                                    ?>
                                    <th>
                                        <?= $bulanIndo[$j]; ?>
                                    </th>
                                <?php endfor; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($siswa as $s):

                                if (isset($_POST["id_rombel"])) {
                                    $id_rombel = $_POST["id_rombel"];
                                    $id_tahun_ajaran = $_POST["id_tahun_ajaran"];

                                    $bpp_dibayar = query("
                                        SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_jenis_pembayaran = 1 AND id_siswa = {$s['id_siswa']} AND id_rombel = $id_rombel AND id_tahun_ajaran = $id_tahun_ajaran
                                    ")[0];
                                    $bbp_dibayar = query("
                                        SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_jenis_pembayaran = 2 AND id_siswa = {$s['id_siswa']} AND id_rombel = $id_rombel AND id_tahun_ajaran = $id_tahun_ajaran
                                    ")[0];
                                } else {
                                    $bpp_dibayar = query("
                                        SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_jenis_pembayaran = 1 AND id_siswa = {$s['id_siswa']}
                                    ")[0];
                                    $bbp_dibayar = query("
                                        SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_jenis_pembayaran = 2 AND id_siswa = {$s['id_siswa']}
                                    ")[0];
                                }

                                $sisa_pembayaran = $total_pembayaran - $bpp_dibayar["amount"] - $bbp_dibayar["amount"];
                                ?>
                                <tr>
                                    <td>
                                        <?= $i; ?>
                                    </td>
                                    <td class="txt-oflo">
                                        <?= $s["nama_siswa"]; ?>
                                    </td>
                                    <td class="txt-oflo">Rp.
                                        <?= number_format($bpp_nominal["nominal"], 0, ',', '.'); ?>
                                    </td>
                                    <td class="txt-oflo">Rp.
                                        <?= number_format($bpp_dibayar["amount"], 0, ',', '.'); ?>
                                    </td>



                                    <?php
                                    if (isset($_POST["id_rombel"])) {
                                        $id_rombel = $_POST["id_rombel"];
                                        $id_tahun_ajaran = $_POST["id_tahun_ajaran"];

                                        $rekap_bbp = query("
                                                    SELECT * FROM pembayaran
                                                    WHERE id_jenis_pembayaran = 2 AND id_siswa = {$s['id_siswa']} AND id_rombel = $id_rombel AND id_tahun_ajaran = $id_tahun_ajaran
                                                ");
                                    } else {
                                        $rekap_bbp = query("
                                                    SELECT * FROM pembayaran
                                                    WHERE id_jenis_pembayaran = 2 AND id_siswa = {$s['id_siswa']}
                                                ");
                                    }

                                    $rekap_bbp_arr = array_fill(1, 12, 0);

                                    foreach ($rekap_bbp as $rekap) {
                                        $bulan = $rekap['bbp_bulan'];
                                        $nominal = $rekap['nominal_pembayaran'];
                                        $rekap_bbp_arr[$bulan] = $nominal;
                                    }
                                    ?>

                                    <?php for ($j = 7; $j <= 12; $j++): ?>
                                        <?php
                                        // $namaBulan = DateTime::createFromFormat('!m', $j)->format('F');
                                        $nominalBulan = isset($rekap_bbp_arr[$j]) ? $rekap_bbp_arr[$j] : 0;
                                        ?>
                                        <td class="txt-oflo">
                                            <!-- <?= $namaBulan; ?><br> -->
                                            Rp.
                                            <?= number_format($nominalBulan, 0, ',', '.'); ?>
                                        </td>
                                    <?php endfor; ?>
                                    <?php for ($j = 1; $j <= 6; $j++): ?>
                                        <?php
                                        // $namaBulan = DateTime::createFromFormat('!m', $j)->format('F');
                                        $nominalBulan = isset($rekap_bbp_arr[$j]) ? $rekap_bbp_arr[$j] : 0;
                                        ?>
                                        <td class="txt-oflo">
                                            <!-- <?= $namaBulan; ?><br> -->
                                            Rp.
                                            <?= number_format($nominalBulan, 0, ',', '.'); ?>
                                        </td>
                                    <?php endfor; ?>



                                    <td class="txt-oflo">Rp.
                                        <?= number_format($bbp_dibayar["amount"], 0, ',', '.'); ?>
                                    </td>
                                    <td class="txt-oflo">Rp.
                                        <?= number_format($sisa_pembayaran, 0, ',', '.'); ?>
                                    </td>
                                    <td>Rp.
                                        <?= number_format($total_pembayaran, 0, ',', '.'); ?>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            <!-- <tr>
                                <td colspan="17" class="text-end">TOTAL</td>
                                <td></td>
                            </tr> -->
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