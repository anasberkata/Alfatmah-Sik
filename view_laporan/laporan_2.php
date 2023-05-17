<?php
session_start();
include "../templates/header.php";

$rombel = query("SELECT * FROM rombel");
$tahun_ajaran = query("SELECT * FROM tahun_ajaran");

$siswa = query(
    "SELECT * FROM siswa
    INNER JOIN rombel ON rombel.id_rombel = siswa.id_rombel
    INNER JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran = siswa.id_tahun_ajaran
    INNER JOIN guru ON guru.id_guru = rombel.id_guru
    ORDER BY siswa.id_tahun_ajaran ASC, rombel.rombel ASC"
);

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
                </div>

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
                                <th>JANUARI</th>
                                <th>FEBRUARI</th>
                                <th>MARET</th>
                                <th>APRIL</th>
                                <th>MEI</th>
                                <th>JUNI</th>
                                <th>JULI</th>
                                <th>AGUSTUS</th>
                                <th>SEPTEMBER</th>
                                <th>OKTOBER</th>
                                <th>NOVEMBER</th>
                                <th>DESEMBER</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($siswa as $s):

                                $bpp_dibayar = query(
                                    "SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_jenis_pembayaran = 1 AND id_siswa = {$s['id_siswa']}"
                                )[0];

                                $bbp_dibayar = query(
                                    "SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_jenis_pembayaran = 2 AND id_siswa = {$s['id_siswa']}"
                                )[0];

                                $sisa_pembayaran = $total_pembayaran - $bpp_dibayar["amount"] - $bbp_dibayar["amount"];
                                ?>
                                <tr>
                                    <td>
                                        <?= $i; ?>
                                    </td>
                                    <td class="txt-oflo">
                                        <?= $s["nama_siswa"]; ?>
                                    </td>
                                    <td class="txt-oflo">
                                        Rp.
                                        <?= number_format($bpp_nominal["nominal"], 2, ',', '.'); ?>
                                    </td>
                                    <td class="txt-oflo">
                                        Rp.
                                        <?= number_format($bpp_dibayar["amount"], 2, ',', '.'); ?>
                                    </td>


                                    <?php
                                    $rekap_bbp = array_fill(1, 12, 0);

                                    $bbp_list = query("SELECT * FROM pembayaran WHERE id_jenis_pembayaran = 2 AND id_siswa = {$s['id_siswa']}");

                                    foreach ($bbp_list as $bbpl) {
                                        $bulan = date('n', strtotime($bbpl['bbp_bulan']));
                                        $nominal = $bbpl['nominal_pembayaran'];
                                        echo $rekap_bbp[$bulan] = $nominal;
                                    }
                                    ?>

                                    <?php for ($j = 1; $j <= 12; $j++): ?>
                                        <td class="txt-oflo">
                                            <?php if (isset($rekap_bbp[$j])): ?>
                                                <?= "Rp. " . number_format($rekap_bbp[$j], 2, ',', '.'); ?>
                                            <?php else: ?>
                                                Rp. 0,00
                                            <?php endif; ?>
                                        </td>
                                    <?php endfor; ?>


                                    <td class="txt-oflo">
                                        Rp.
                                        <?= number_format($bbp_dibayar["amount"], 2, ',', '.'); ?>
                                    </td>
                                    <td class="txt-oflo">
                                        Rp.
                                        <?= number_format($sisa_pembayaran, 2, ',', '.'); ?>
                                    </td>
                                    <td>
                                        Rp.
                                        <?= number_format($total_pembayaran, 2, ',', '.'); ?>
                                    </td>
                                </tr>

                                <?php $i++; ?>
                            <?php endforeach; ?>

                            <tr>
                                <td colspan="16" class="text-center">TOTAL</td>
                                <td>

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