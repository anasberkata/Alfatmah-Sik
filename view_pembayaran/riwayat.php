<?php
session_start();
include "../templates/header.php";

$pembayaran = query(
    "SELECT * FROM pembayaran
    INNER JOIN siswa ON siswa.id_siswa = pembayaran.id_siswa
    INNER JOIN jenis_pembayaran ON jenis_pembayaran.id_jenis_pembayaran = pembayaran.id_jenis_pembayaran
    ORDER BY pembayaran.id_pembayaran DESC"
);
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
                    <h3 class="box-title mb-0">Data Rimayat Pembayaran</h3>
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
                                <th class="border-top-0">Aksi</th>
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
                                        <a href="../assets/img/bukti/<?= $p["bukti"]; ?>" target="_blank"><span
                                                class="badge bg-info">Buka</span></a>

                                    </td>
                                    <td class="txt-oflo">
                                        <a href="riwayat_status.php?id_pembayaran=<?= $p["id_pembayaran"] ?>">
                                            <?php if ($p["status"] == 1): ?>
                                                <span class="badge bg-success">Diterima</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">Pending</span>
                                            <?php endif; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="riwayat_edit.php?id_pembayaran=<?= $p["id_pembayaran"] ?>"
                                                class="btn btn-info text-white"><i class="fas fa-edit"></i></a>
                                            <a href="riwayat_delete.php?id_pembayaran=<?= $p["id_pembayaran"] ?>"
                                                class="btn btn-danger text-white"
                                                onclick="return confirm('Yakin ingin menghapus pembayaran <?= $p['nama_siswa']; ?>?');"><i
                                                    class="fas fa-trash"></i></a>
                                        </div>
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
include "../templates/footer.php";
?>