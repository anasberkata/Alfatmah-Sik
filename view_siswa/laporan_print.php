<?php

// require_once __DIR__ . '/vendor/autoload.php';
require_once '../vendor/autoload.php';
require '../functions.php';

$id_siswa = $_GET["id_siswa"];

$siswa = query("
    SELECT * FROM siswa
    INNER JOIN rombel ON rombel.id_rombel = siswa.id_rombel
    INNER JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran = siswa.id_tahun_ajaran
    INNER JOIN guru ON guru.id_guru = rombel.id_guru
    WHERE siswa.id_siswa = $id_siswa
    ORDER BY siswa.id_tahun_ajaran ASC, rombel.rombel ASC
");

$bpp_nominal = query("SELECT * FROM jenis_pembayaran WHERE id_jenis_pembayaran = 1")[0];
$bbp_nominal = query("SELECT * FROM jenis_pembayaran WHERE id_jenis_pembayaran = 2")[0];
$total_pembayaran = $bpp_nominal["nominal"] + ($bbp_nominal["nominal"] * 12);

$html = '
<body>
<table cellpadding="20px" cellspacing="0" width="100%">
        <tr>
            <td width="100%" style="text-align: center; font-size: 10;">
                <p>REKAP PEMBAYARAN SISWA</p>
                <p>SMK AL-FATMAH CIANJUR</p>';

$id_tahun_ajaran = $_GET["id_tahun_ajaran"];
$ta = query("SELECT * FROM tahun_ajaran WHERE id_tahun_ajaran = $id_tahun_ajaran")[0];

$html .= $ta["tahun_ajaran"];

$html .= '</strong></p>
            </td>
        </tr>
    </table>';

$html .= '<table border="1" cellpadding="10px" cellspacing="0" width="100%" style="font-size: 10px">
        <tr style="background-color: #6495ED; font-style: bold; color: #fff;">
            <td style="text-align: center;" rowspan="2">NO.</td>
            <td style="text-align: center;" rowspan="2">NAMA</td>
            <td style="text-align: center;" rowspan="2">TOTAL BPP</td>
            <td style="text-align: center;" rowspan="2">BPP DIBAYAR</td>
            <td style="text-align: center;" colspan="12">PEMBAYARAN BBP</td>
            <td style="text-align: center;" rowspan="2">JUMLAH</td>
            <td style="text-align: center;" rowspan="2">SISA</td>
            <td style="text-align: center;" rowspan="2">TOTAL PEMBAYARAN</td>
        </tr>
        <tr style="background-color: #6495ED; font-style: bold; color: #fff;">';

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

for ($j = 7; $j <= 12; $j++) {
    $html .= '<td style="text-align: center;">' .
        $bulanIndo[$j] .
        '</td>';
}
for ($j = 1; $j <= 6; $j++) {
    $html .= '<td style="text-align: center;">' .
        $bulanIndo[$j] .
        '</td></tr>';
}

$i = 1;
foreach ($siswa as $s) {
    $bpp_dibayar = query("
        SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_jenis_pembayaran = 1 AND id_siswa = {$s['id_siswa']}
    ")[0];
    $bbp_dibayar = query("
        SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_jenis_pembayaran = 2 AND id_siswa = {$s['id_siswa']}
    ")[0];

    $sisa_pembayaran = $total_pembayaran - $bpp_dibayar["amount"] - $bbp_dibayar["amount"];

    $html .=
        '<tr>
            <td style="text-align: center;">' . $i . '</td>
            <td>' . $s["nama_siswa"] . '</td>
            <td> Rp. ' . number_format($bpp_nominal["nominal"], 0, ',', '.') . '</td>
            <td> Rp. ' . number_format($bpp_dibayar["amount"], 0, ',', '.') . '</td>';


    $rekap_bbp = query("
        SELECT * FROM pembayaran
        WHERE id_jenis_pembayaran = 2 AND id_siswa = {$s['id_siswa']}
    ");


    $rekap_bbp_arr = array_fill(1, 12, 0);

    foreach ($rekap_bbp as $rekap) {
        $bulan = $rekap['bbp_bulan'];
        $nominal = $rekap['nominal_pembayaran'];
        $rekap_bbp_arr[$bulan] = $nominal;
    }


    for ($j = 7; $j <= 12; $j++) {
        $nominalBulan = isset($rekap_bbp_arr[$j]) ? $rekap_bbp_arr[$j] : 0;
        $html .= '<td style="text-align: right;" class="txt-oflo">' .
            'Rp. ' . number_format($nominalBulan, 0, ',', '.') .
            '</td>';
    }

    for ($j = 1; $j <= 6; $j++) {
        $nominalBulan = isset($rekap_bbp_arr[$j]) ? $rekap_bbp_arr[$j] : 0;
        $html .= '<td style="text-align: right;" class="txt-oflo">' .
            'Rp. ' . number_format($nominalBulan, 0, ',', '.') .
            '</td>';
    }

    $html .= '<td style="text-align: right;">Rp. ' . number_format($bbp_dibayar["amount"], 0, ',', '.') . '</td>
    <td style="text-align: right;" class="txt-oflo">Rp. ' . number_format($sisa_pembayaran, 0, ',', '.') .
        '</td>
        <td style="text-align: right;">Rp. '
        . number_format($total_pembayaran, 0, ',', '.') .
        '</td>
        </tr>';
    $i++;
}

$html .= '</table>
    
</body>
';

// $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'legal',
    'orientation' => 'L',
]);

// $stylesheet = file_get_contents('style_print.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML("$html", \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Riwayat Pembayaran.pdf', 'I');
// $mpdf->Output();