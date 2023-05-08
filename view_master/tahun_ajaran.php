<?php
session_start();
include "../templates/header.php";

$tahun_ajaran = query(
    "SELECT * FROM tahun_ajaran"
);
?>

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tahun Ajaran</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
                <ol class="breadcrumb ms-auto">
                    <li><a href="tahun_ajaran_add.php"
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
                    <h3 class="box-title mb-0">Data Tahun Ajaran</h3>
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
                    <table class="table no-wrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">No.</th>
                                <th class="border-top-0">ID Tahun Ajaran</th>
                                <th class="border-top-0">Tahun Ajaran</th>
                                <th class="border-top-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($tahun_ajaran as $aj): ?>
                                <tr>
                                    <td>
                                        <?= $i; ?>
                                    </td>
                                    <td class="txt-oflo">
                                        <?= $aj["id_tahun_ajaran"]; ?>
                                    </td>
                                    <td class="txt-oflo">
                                        <?= $aj["tahun_ajaran"]; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="tahun_ajaran_edit.php?id_tahun_ajaran=<?= $aj["id_tahun_ajaran"] ?>"
                                                class="btn btn-info text-white"><i class="fas fa-edit"></i></a>
                                            <a href="tahun_ajaran_delete.php?id_tahun_ajaran=<?= $aj["id_tahun_ajaran"] ?>"
                                                class="btn btn-danger text-white"
                                                onclick="return confirm('Yakin ingin menghapus <?= $aj['tahun_ajaran']; ?>?');"><i
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