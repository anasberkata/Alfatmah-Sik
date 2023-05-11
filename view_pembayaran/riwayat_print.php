<?php

// require_once __DIR__ . '/vendor/autoload.php';
require_once '../vendor/autoload.php';
require '../functions.php';

$tanggal_awal = $_GET["tanggal_awal"];
$tanggal_akhir = $_GET["tanggal_akhir"];

$data_sekolah = query(
    "SELECT * FROM data_sekolah
        INNER JOIN users ON data_sekolah.id_bendahara = users.id_user"
)[0];

if ($tanggal_akhir == 0) {
    $pembayaran = query(
        "SELECT * FROM pembayaran
        INNER JOIN siswa ON siswa.id_siswa = pembayaran.id_siswa
        INNER JOIN jenis_pembayaran ON jenis_pembayaran.id_jenis_pembayaran = pembayaran.id_jenis_pembayaran"
    );

    $pembayaran_amount = query(
        "SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran"
    )[0];
} else {
    $tanggal_awal = $_GET["tanggal_awal"];
    $tanggal_akhir = $_GET["tanggal_akhir"];

    $pembayaran = query(
        "SELECT * FROM pembayaran
        INNER JOIN siswa ON siswa.id_siswa = pembayaran.id_siswa
        INNER JOIN jenis_pembayaran ON jenis_pembayaran.id_jenis_pembayaran = pembayaran.id_jenis_pembayaran
        WHERE tanggal_pembayaran BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"
    );

    $pembayaran_amount = query(
        "SELECT SUM(nominal_pembayaran) AS amount FROM pembayaran  WHERE tanggal_pembayaran BETWEEN '$tanggal_awal' AND '$tanggal_akhir'"
    )[0];
}

$html = '
<body>
    <table cellpadding="20px" cellspacing="0" width="100%">
        <tr>
            <td width="20%" style="text-align: center;"><img src="../assets/img/' . $data_sekolah["logo"] . '" width="10%"></td>
            <td width="60%" style="text-align: center;">
                <h3>YAYASAN PONDIK PASANTREN AL-FATMAH</h3>
                <h2>SMK AL-FATMAH CIANJUR</h2>
                <p style="font-size: 10px";>Alamat : JL. Pertigaan Pasir Hayam, 13/32, Sukawangi, Kec. Cianjur, Kabupaten Cianjur, Jawa Barat 43285
                <br>
                Telepon : 0263-2911770, Whatsapp : +62 896 8735 5890, E-Mail : hallo@alfatmahcianjur.sch.id
                </p>
            </td>
            <td width="20%" style="text-align: center;"></td>
        </tr>
    </table>
    <table border="1" cellpadding="10px" cellspacing="0" width="100%" style="font-size: 10px">
        <tr style="background-color: #6495ED; font-style: bold; color: #fff;">
            <td>No.</td>
            <td>ID Pembayaran</td>
            <td>Nama Siswa</td>
            <td>Jenis Pembayaran</td>
            <td>Tanggal Pembayaran</td>
            <td>Status</td>
            <td>Nominal</td>
        </tr>';

$i = 1;
foreach ($pembayaran as $p) {
    $html .=
        '<tr>
            <td style="text-align: center;">' . $i . '</td>
            <td>' . date("dmy", strtotime($p["tanggal_pembayaran"])) . $p["id_pembayaran"] . '</td>
            <td>' . $p["nama_siswa"] . '</td>
            <td>' . $p["jenis_pembayaran"] . '</td>
            <td>' . date("d F Y", strtotime($p["tanggal_pembayaran"])) . '</td>
            <td>';
    if ($p["status"] == 1) {
        $html .= 'Diterima';
    } else {
        $html .= "Pending";
    }

    $html .= '</td>
            <td style="text-align: right;">Rp. ' . number_format($p["nominal_pembayaran"], 0, ',', '.') . '</td>
        </tr>';
    $i++;
}

$html .= '<tr>
            <td colspan="6" style="text-align: center;">
                TOTAL
            </td>
            <td style="text-align: right;">Rp. ' . number_format($pembayaran_amount["amount"], 0, ',', '.') . '</td>
        </tr>
    </table>


    <table style="font-size: 10px; margin-top: 20px;" cellpadding="10px" width="100%">
        <tr>
            <td width="75%"></td>
            <td style="text-align: center; width: 25%">
            Cianjur, ' . date("d F Y") . '
            <br>
            Bendahara
            <br>
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

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);

// $stylesheet = file_get_contents('style_print.css');
// $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML("$html", \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output('Riwayat Pembayaran.pdf', 'I');
// $mpdf->Output();