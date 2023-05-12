<div class="white-box">
    <div class="d-md-flex mb-3">
        <h3 class="box-title mb-0">Tambah Pembayaran Biaya Pengembangan Pendidikan</h3>
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

    <form class="form-horizontal form-material" action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 col-lg-6">

                <input type="hidden" value="2" name="status" />

                <div class="form-group mb-4">
                    <label class="col-sm-12">Nama</label>

                    <div class="col-sm-12 border-bottom">
                        <input type="hidden" name="id_siswa" value="<?= $user["id_siswa"]; ?>" />
                        <input type="text" class="form-control p-0 border-0"
                            value="<?= $user["nama_siswa"]; ?> || Kelas : <?= $user["rombel"]; ?>" readonly />
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="col-sm-12">Jenis Pembayaran</label>

                    <div class="col-sm-12 border-bottom">
                        <input type="hidden" name="id_jenis_pembayaran" value="1" />
                        <input type="text" class="form-control p-0 border-0" value="BPP" readonly />
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
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
                    <label class="col-md-12 p-0">Bukti Pembayaran</label>
                    <div class="col-md-12 border-bottom p-0">
                        <input type="file" class="form-control p-0 border-0" name="bukti_pembayaran" />
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="col-sm-12 text-end">
                        <button class="btn btn-success" type="submit" name="add_pembayaran_bpp">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>