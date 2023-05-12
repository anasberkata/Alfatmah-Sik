<?php

// require_once __DIR__ . '/vendor/autoload.php';
require_once '../vendor/autoload.php';
require '../functions.php';

$bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

$id_pembayaran = $_GET["id_pembayaran"];
$id_siswa = $_GET["id_siswa"];

$data_sekolah = query(
    "SELECT * FROM data_sekolah
        INNER JOIN users ON data_sekolah.id_bendahara = users.id_user"
)[0];

$p = query(
    "SELECT * FROM pembayaran
        INNER JOIN siswa ON siswa.id_siswa = pembayaran.id_siswa
        INNER JOIN rombel ON siswa.id_rombel = siswa.id_rombel
        INNER JOIN jenis_pembayaran ON jenis_pembayaran.id_jenis_pembayaran = pembayaran.id_jenis_pembayaran
        WHERE id_pembayaran = $id_pembayaran"
)[0];

$pembayaran_amount = query(
    "SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_pembayaran = $id_pembayaran"
)[0];

$bulan_pembayaran = $p["bbp_bulan"] - 1;
switch ($bulan_pembayaran) {
    case $bulan_pembayaran:
        $bulan[$bulan_pembayaran];
        break;

    default:
        echo "Bulan tidak terdaftar";
}

$jenis_pembayaran = query("SELECT * FROM jenis_pembayaran");
$total_bpp = $jenis_pembayaran[0]["nominal"];
$total_bbp = $jenis_pembayaran[1]["nominal"] * 12;

$sudah_bayar_bpp = query(
    "SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_siswa = $id_siswa AND id_jenis_pembayaran = 1 AND status = 1"
)[0];
$sisa_bpp = $total_bpp - $sudah_bayar_bpp["amount"];

$sudah_bayar_bbp = query(
    "SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran WHERE id_siswa = $id_siswa AND id_jenis_pembayaran = 2 AND status = 1"
)[0];

$sisa_bbp = $total_bbp - $sudah_bayar_bbp["amount"];

$html = '
<body>
    <table cellpadding="20px" cellspacing="0" width="100%" border="1" style="margin-bottom: 20px;">
        <tr>
            <td width="20%" style="text-align: center;"><img src="../assets/img/' . $data_sekolah["logo"] . '" width="10%"></td>
            <td width="40%" style="text-align: left;">
                <p style="font-size: 9px; font-weight: bold; font-family: sans">YAYASAN PONDIK PASANTREN AL-FATMAH</p>
                <p style="font-size: 9px; font-weight: bold; font-family: sans">SMK AL-FATMAH CIANJUR</p>
            </td>
            <td width="20%" style="text-align: left;">
                <p style="font-size: 9px; font-weight: bold; font-family: sans">ID TRANSAKSI </p>
                <p style="font-size: 9px; font-weight: bold; font-family: sans">TANGGAL TERBIT </p>
            </td>
            <td width="20%" style="text-align: left;">
                <p style="font-size: 9px; font-weight: bold; font-family: sans">: ' . date("dmy", strtotime($p["tanggal_pembayaran"])) . $p["id_pembayaran"] . '</p>
                <p style="font-size: 9px; font-weight: bold; font-family: sans">: ' . date("d F Y") . '</p>
            </td>
        </tr>
        </tr>
    </table>




    <table border="0" cellpadding="5px" cellspacing="0" width="100%" style="font-size: 10px">
        <tr style="font-style: bold; color: #fff; font-weight: bold;">
            <td style="font-weight: bold;">PEMBAYARAN</td>
            <td style="font-weight: bold; text-align: right;">JUMLAH</td>
            <td style="font-weight: bold;" width="10%"></td>
            <td style="font-weight: bold;" colspan="2">INFORMASI</td>
        </tr>
        <tr>
            <td rowspan="3">' . $p["jenis_pembayaran"];
if ($p["id_jenis_pembayaran"] == 2) {
    $html .= ' <b>Bulan ' . $bulan[$bulan_pembayaran] . '</b>';
}

$html .= '<br>' . $p["deskripsi"] .
    '</td>
            <td rowspan="3" style="text-align: right;">: Rp. ' . number_format($p["nominal_pembayaran"], 0, ',', '.') . '</td>
            <td rowspan="4"></td>
            <td>Nama</td>
            <td>: ' . $p["nama_siswa"] . '</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>: ' . $p["rombel"] . '</td>
        </tr>
        <tr>
            <td>Total Pembayaran</td>
            <td>: Rp. ';
if ($p["id_jenis_pembayaran"] == 1) {
    $html .= number_format($total_bpp, 0, ',', '.') . '</b>';
} else {
    $html .= number_format($total_bbp, 0, ',', '.') . '</b>';

}
$html .= '</td>
        </tr>
        <tr>
            <td style="text-align: left; font-weight: bold;">
                TOTAL
            </td>
            <td style="text-align: right;">: Rp. ' . number_format($pembayaran_amount["amount"], 0, ',', '.') . '</td>
            <td>Sisa Pembayaran</td>
            <td>: Rp. ';
if ($p["id_jenis_pembayaran"] == 1) {
    $html .= number_format($sisa_bpp, 0, ',', '.') . '</td>';
} else {
    $html .= number_format($sisa_bbp, 0, ',', '.') . '</td>';

}

$html .= '</tr>

        <tr>    
        </tr>
    </table>


    <table style="font-size: 10px; margin-top: 20px;" cellpadding="10px" width="100%">
        <tr>
            <td width="65%"></td>
            <td style="text-align: center; width: 35%">
            Cianjur, ' . date("d F Y") . '
            <br>
            Bendahara
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>' . $data_sekolah["nama"] . '
            </td>
        </td>
    </table>
    
</body>
';

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);

// $stylesheet = file_get_contents('style_print.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML("$html", \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Kwitansi.pdf', 'I');
// $mpdf->Output();