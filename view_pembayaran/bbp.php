<div class="white-box">
    <div class="d-md-flex mb-3">
        <h3 class="box-title mb-0">Tambah Pembayaran Biaya Bulanan Pendidikan</h3>
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

    <form class="form-horizontal form-material" action="" method="POST">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group mb-4">
                    <label class="col-sm-12">Siswa</label>

                    <div class="col-sm-12 border-bottom">
                        <select class="form-select shadow-none p-0 border-0 form-control-line" name="id_siswa">
                            <option>Pilih Siswa</option>
                            <?php foreach ($siswa as $s): ?>
                                <option value="<?= $s["id_siswa"]; ?>"><?= $s["nama_siswa"]; ?> || Kelas : <?= $s["rombel"]; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="col-sm-12">Jenis Pembayaran</label>

                    <div class="col-sm-12 border-bottom">
                        <select class="form-select shadow-none p-0 border-0 form-control-line"
                            name="id_jenis_pembayaran">
                            <option value="2">BBP</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="form-group mb-4">
                    <label class="col-sm-12">BBP Bulan</label>

                    <div class="row">
                        <div class="col-sm-6 border-bottom">
                            <select class="form-select shadow-none p-0 border-0 form-control-line"
                                name="bbp_bulan">
                                <option>Pilih Bulan</option>
                                <?php $i = 1; ?>
                                <?php foreach($bulan as $b) :?>
                                    <option value="<?= $i; ?>"><?= $b; ?></option>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-6 border-bottom p-0">
                            <input type="number" min="1900" max="3000" step="1" value="<?= date("Y"); ?>" class="form-control p-0 border-0" name="bbp_tahun" />
                        </div>
                    </div>
                    
                </div>
                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Nominal (Rp.)</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="text" class="form-control p-0 border-0" name="nominal_pembayaran" />
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="col-md-12 p-0">Tanggal Pembayaran</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="date" class="form-control p-0 border-0" name="tanggal_pembayaran" />
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="col-sm-12 text-end">
                        <button class="btn btn-success" type="submit" name="add_pembayaran_bbp">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>