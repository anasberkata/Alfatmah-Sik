<?php

// KONEKSI DATABASE =====================================================
$conn = mysqli_connect("localhost", "root", "", "db_sika");


function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// ----------------------------------------------------------------------------------------------------------
// PENGGUNA
function pengguna_add($data)
{
    global $conn;

    $nama = $data["nama"];
    $email = $data["email"];
    $username = $data["username"];
    $password = $data["password"];
    $role = $data["role"];

    $image = "default.jpg";

    $date_created = date("Y-m-d");
    $is_active = 1;

    $cek_username = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    $cek_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");

    // Cek Username Mahasiswa Sudah Ada Atau Belum
    if (mysqli_fetch_assoc($cek_username)) {
        echo "<script>
            alert('Username Sudah Terdaftar!');
            document.location.href = 'pengguna_add.php';
            </script>";
    } else if (mysqli_fetch_assoc($cek_email)) {
        echo "<script>
            alert('Email Sudah Terdaftar!');
            document.location.href = 'pengguna_add.php';
            </script>";
    } else {
        $query = "INSERT INTO users
				VALUES
			(NULL, '$nama', '$username', '$email', '$password', '$image', '$role', '$date_created', '$is_active')
			";

        mysqli_query($conn, $query);
    }

    return mysqli_affected_rows($conn);
}

function pengguna_edit($data)
{
    global $conn;

    $id_user = $data["id_user"];
    $nama = $data["nama"];
    $email = $data["email"];
    $username = $data["username"];
    $password = $data["password"];
    $role = $data["role"];

    $query = "UPDATE users SET
			nama = '$nama',
			email = '$email',
			username = '$username',
			password = '$password',
			role_id = '$role'

            WHERE id_user = $id_user
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function pengguna_delete($id_user)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id_user");
    return mysqli_affected_rows($conn);
}

function profile_edit($data)
{
    global $conn;

    $id_user = $data["id_user"];
    $nama = $data["nama"];
    $email = $data["email"];
    $username = $data["username"];
    $password = $data["password"];
    $role = $data["role"];

    $query = "UPDATE users SET
			nama = '$nama',
			email = '$email',
			username = '$username',
			password = '$password',
			role_id = '$role'

            WHERE id_user = $id_user
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

// ----------------------------------------------------------------------------------------------------------
// GURU
function guru_add($data)
{
    global $conn;

    $nama_guru = $data["nama_guru"];
    $mapel = $data["mapel"];

    $date_created = date("Y-m-d");
    $is_active = 1;

    $query = "INSERT INTO guru
				VALUES
			(NULL, '$nama_guru', '$mapel', '$date_created', '$is_active')
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function guru_edit($data)
{
    global $conn;

    $id_guru = $data["id_guru"];
    $nama_guru = $data["nama_guru"];
    $mapel = $data["mapel"];

    $query = "UPDATE guru SET
			nama_guru = '$nama_guru',
			mapel = '$mapel'

            WHERE id_guru = $id_guru
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function guru_delete($id_guru)
{
    global $conn;

    $guru_delete = mysqli_query($conn, "DELETE FROM guru WHERE id_guru = $id_guru");

    return mysqli_affected_rows($conn);
}

// ----------------------------------------------------------------------------------------------------------
// ROMBEL
function rombel_add($data)
{
    global $conn;

    $rombel = $data["rombel"];
    $id_guru = $data["id_guru"];

    $cek_rombel = mysqli_query($conn, "SELECT rombel FROM rombel WHERE rombel = '$rombel'");

    if (mysqli_fetch_assoc($cek_rombel)) {
        echo "<script>
            alert('Rombongan Belajar Sudah Ada!');
            document.location.href = 'rombel_add.php';
            </script>";
    } else {
        $query = "INSERT INTO rombel
				VALUES
			(NULL, '$rombel', '$id_guru')
			";

        mysqli_query($conn, $query);
    }

    return mysqli_affected_rows($conn);
}

function rombel_edit($data)
{
    global $conn;

    $id_rombel = $data["id_rombel"];
    $rombel = $data["rombel"];
    $id_guru = $data["id_guru"];

    $query = "UPDATE rombel SET
			rombel = '$rombel',
			id_guru = '$id_guru'

            WHERE id_rombel = $id_rombel
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function rombel_delete($id_rombel)
{
    global $conn;

    $rombel_delete = mysqli_query($conn, "DELETE FROM rombel WHERE id_rombel = $id_rombel");

    return mysqli_affected_rows($conn);
}

// ----------------------------------------------------------------------------------------------------------
// SISWA
function siswa_add($data)
{
    global $conn;

    $nis = $data["nis"];
    $nisn = $data["nisn"];
    $nama_siswa = $data["nama_siswa"];
    $id_rombel = $data["id_rombel"];
    $jk = $data["jk"];
    $alamat = $data["alamat"];
    $phone = $data["phone"];
    $username = $data["username"];
    $password = $data["username"];
    $gambar = "default.jpg";
    $id_tahun_ajaran = $data["id_tahun_ajaran"];

    $date_created = date("Y-m-d");
    $is_active = 1;

    $cek_nis = mysqli_query($conn, "SELECT nis FROM siswa WHERE nis = '$nis'");

    // Cek Username Mahasiswa Sudah Ada Atau Belum
    if (mysqli_fetch_assoc($cek_nis)) {
        echo "<script>
            alert('Siswa Sudah Terdaftar!');
            document.location.href = 'siswa_add.php';
            </script>";
    } else {
        $query = "INSERT INTO siswa
				VALUES
			(NULL, '$nis', '$nisn', '$nama_siswa', '$id_rombel', '$jk', '$alamat', '$phone', '$username', '$password', '$gambar', '$id_tahun_ajaran', '$date_created', '$is_active')
			";

        mysqli_query($conn, $query);
    }

    return mysqli_affected_rows($conn);
}


function siswa_import($data)
{
    global $conn;
    include "vendor/import_excel/excel_reader.php";

    // upload file xls
    $target = basename($_FILES['file_excel']['name']);
    move_uploaded_file($_FILES['file_excel']['tmp_name'], $target);

    // beri permisi agar file xls dapat di baca
    chmod($_FILES['file_excel']['name'], 0777);

    // mengambil isi file xls
    $data_excel = new Spreadsheet_Excel_Reader($_FILES['file_excel']['name'], false);
    // menghitung jumlah baris data yang ada
    $jumlah_baris = $data_excel->rowcount($sheet_index = 0);

    // jumlah default data yang berhasil di import

    for ($i = 2; $i <= $jumlah_baris; $i++) {

        // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
        $nis = $data_excel->val($i, 2);
        $nisn = $data_excel->val($i, 3);
        $nama_siswa = $data_excel->val($i, 4);
        $id_rombel = $data_excel->val($i, 5);
        $jk = $data_excel->val($i, 6);
        $alamat = $data_excel->val($i, 7);
        $phone = $data_excel->val($i, 8);
        $username = $data_excel->val($i, 9);
        $password = $data_excel->val($i, 10);
        $gambar = "default.jpg";
        $id_tahun_ajaran = $data_excel->val($i, 11);
        $date_created = date("Y-m-d");
        $is_active = 1;

        if ($nis != "" && $nisn != "" && $nama_siswa != "" && $id_rombel != "") {
            // input data ke database (table barang)
            mysqli_query($conn, "INSERT INTO siswa VALUES(NULL,'$nis','$nisn','$nama_siswa', '$id_rombel', '$jk', '$alamat', '$phone', '$username', '$password', '$gambar', '$id_tahun_ajaran', '$date_created', '$is_active')");
        }
    }

    // hapus kembali file .xls yang di upload tadi
    unlink($_FILES['file_excel']['name']);

    // alihkan halaman ke index.php
    return mysqli_affected_rows($conn);
}

function siswa_edit($data)
{
    global $conn;

    $id_siswa = $data["id_siswa"];
    $nis = $data["nis"];
    $nisn = $data["nisn"];
    $nama_siswa = $data["nama_siswa"];
    $id_rombel = $data["id_rombel"];
    $jk = $data["jk"];
    $alamat = $data["alamat"];
    $phone = $data["phone"];
    $id_tahun_ajaran = $data["id_tahun_ajaran"];
    $username = $data["username"];
    $password = $data["password"];

    $query = "UPDATE siswa SET
			nis = '$nis',
			nisn = '$nisn',
			nama_siswa = '$nama_siswa',
			id_rombel = '$id_rombel',
			jk = '$jk',
			alamat = '$alamat',
			phone = '$phone',
			id_tahun_ajaran = '$id_tahun_ajaran',
			username = '$username',
			password = '$password'

            WHERE id_siswa = $id_siswa
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function siswa_delete($id_siswa)
{
    global $conn;

    $siswa_delete = mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa = $id_siswa");

    return mysqli_affected_rows($conn);
}

// ----------------------------------------------------------------------------------------------------------
// TAHUN AJARAN
function tahun_ajaran_add($data)
{
    global $conn;

    $tahun_ajaran_1 = $data["tahun_ajaran_1"];
    $tahun_ajaran_2 = $data["tahun_ajaran_2"];
    $tahun_ajaran = $tahun_ajaran_1 . " - " . $tahun_ajaran_2;

    $query = "INSERT INTO tahun_ajaran
				VALUES
			(NULL, '$tahun_ajaran')
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tahun_ajaran_edit($data)
{
    global $conn;

    $id_tahun_ajaran = $data["id_tahun_ajaran"];
    $tahun_ajaran_1 = $data["tahun_ajaran_1"];
    $tahun_ajaran_2 = $data["tahun_ajaran_2"];
    $tahun_ajaran = $tahun_ajaran_1 . " - " . $tahun_ajaran_2;

    $query = "UPDATE tahun_ajaran SET
			tahun_ajaran = '$tahun_ajaran'

            WHERE id_tahun_ajaran = $id_tahun_ajaran
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function tahun_ajaran_delete($id_tahun_ajaran)
{
    global $conn;

    $tahun_ajaran_delete = mysqli_query($conn, "DELETE FROM tahun_ajaran WHERE id_tahun_ajaran = $id_tahun_ajaran");

    return mysqli_affected_rows($conn);
}

// ----------------------------------------------------------------------------------------------------------
// JENIS PEMBAYARAN
function jenis_pembayaran_add($data)
{
    global $conn;

    $jenis_pembayaran = $data["jenis_pembayaran"];
    $nominal = $data["nominal"];
    $deskripsi = $data["deskripsi"];

    $query = "INSERT INTO jenis_pembayaran
				VALUES
			(NULL, '$jenis_pembayaran', '$nominal', '$deskripsi')
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function jenis_pembayaran_edit($data)
{
    global $conn;

    $id_jenis_pembayaran = $data["id_jenis_pembayaran"];
    $jenis_pembayaran = $data["jenis_pembayaran"];
    $nominal = $data["nominal"];
    $deskripsi = $data["deskripsi"];

    $query = "UPDATE jenis_pembayaran SET
			jenis_pembayaran = '$jenis_pembayaran',
			nominal = '$nominal',
			deskripsi = '$deskripsi'

            WHERE id_jenis_pembayaran = $id_jenis_pembayaran
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function jenis_pembayaran_delete($id_jenis_pembayaran)
{
    global $conn;

    $jenis_pembayaran_delete = mysqli_query($conn, "DELETE FROM jenis_pembayaran WHERE id_jenis_pembayaran = $id_jenis_pembayaran");

    return mysqli_affected_rows($conn);
}

// ----------------------------------------------------------------------------------------------------------
// KWITANSI
function data_sekolah_edit($data)
{
    global $conn;

    $yayasan = $data["yayasan"];
    $sekolah = $data["sekolah"];
    $id_bendahara = $data["id_bendahara"];

    $logo_lama = $data["logo_lama"];
    $ttd_lama = $data["ttd_lama"];

    if ($_FILES["logo"]["error"] === 4) {
        $logo = $logo_lama;
    } else {
        $logo = upload_logo();
    }

    if ($_FILES["ttd"]["error"] === 4) {
        $ttd = $ttd_lama;
    } else {
        $ttd = upload_ttd();
    }

    $query = "UPDATE data_sekolah SET
			logo = '$logo',
			yayasan = '$yayasan',
			sekolah = '$sekolah',
			id_bendahara = '$id_bendahara',
			ttd = '$ttd'
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}













// ----------------------------------------------------------------------------------------------------------
// PEMBAYARAN
function pembayaran_bpp_add($data)
{
    global $conn;

    $id_siswa = $data["id_siswa"];
    $id_jenis_pembayaran = $data["id_jenis_pembayaran"];
    $bbp_bulan = date("n");
    $bbp_tahun = date("Y");
    $nominal_pembayaran = $data["nominal_pembayaran"];
    $tanggal_pembayaran = $data["tanggal_pembayaran"];

    if ($_FILES["bukti_pembayaran"]["error"] === 4) {
        $bukti = "default.jpg";
    } else {
        $bukti = upload_bukti();
    }

    $status = $data["status"];

    $query = "INSERT INTO pembayaran
				VALUES
			(NULL, '$id_siswa', '$id_jenis_pembayaran', '$bbp_bulan', '$bbp_tahun', '$nominal_pembayaran', '$tanggal_pembayaran', '$bukti', '$status')
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function pembayaran_bbp_add($data)
{
    global $conn;

    $id_siswa = $data["id_siswa"];
    $id_jenis_pembayaran = $data["id_jenis_pembayaran"];
    $bbp_bulan = $data["bbp_bulan"];
    $bbp_tahun = $data["bbp_tahun"];
    $nominal_pembayaran = $data["nominal_pembayaran"];
    $tanggal_pembayaran = $data["tanggal_pembayaran"];

    if ($_FILES["bukti_pembayaran"]["error"] === 4) {
        $bukti = "default.jpg";
    } else {
        $bukti = upload_bukti();
    }

    $status = $data["status"];

    $query = "INSERT INTO pembayaran
				VALUES
			(NULL, '$id_siswa', '$id_jenis_pembayaran', '$bbp_bulan', '$bbp_tahun', '$nominal_pembayaran', '$tanggal_pembayaran', '$bukti', '$status')
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function pembayaran_edit($data)
{

    global $conn;

    $id_pembayaran = $data["id_pembayaran"];
    $id_siswa = $data["id_siswa"];
    $id_jenis_pembayaran = $data["id_jenis_pembayaran"];
    $bbp_bulan = $data["bbp_bulan"];
    $bbp_tahun = $data["bbp_tahun"];
    $nominal_pembayaran = $data["nominal_pembayaran"];
    $tanggal_pembayaran = $data["tanggal_pembayaran"];
    $bukti_pembayaran_lama = $data["bukti_pembayaran_lama"];

    if ($_FILES["bukti_pembayaran"]["error"] === 4) {
        $bukti = $bukti_pembayaran_lama;
    } else {
        $bukti = upload_bukti();
    }

    $query = "UPDATE pembayaran SET
			id_siswa = '$id_siswa',
			id_jenis_pembayaran = '$id_jenis_pembayaran',
			bbp_bulan = '$bbp_bulan',
			bbp_tahun = '$bbp_tahun',
			id_jenis_pembayaran = '$id_jenis_pembayaran',
			nominal_pembayaran = '$nominal_pembayaran',
			tanggal_pembayaran = '$tanggal_pembayaran',
			bukti = '$bukti'

            WHERE id_pembayaran = $id_pembayaran
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function status_pembayaran_edit($data)
{
    global $conn;

    $id_pembayaran = $data["id_pembayaran"];
    $status = $data["status"];

    $query = "UPDATE pembayaran SET
			status = '$status'

            WHERE id_pembayaran = $id_pembayaran
			";

    mysqli_query(
        $conn,
        $query
    );

    return mysqli_affected_rows($conn);
}

function pembayaran_delete($id_pembayaran)
{
    global $conn;

    $pembayaran_delete = mysqli_query($conn, "DELETE FROM pembayaran WHERE id_pembayaran = $id_pembayaran");

    return mysqli_affected_rows($conn);
}

// UPLOAD BUKTI
function upload_bukti()
{
    $namaFile = $_FILES["bukti_pembayaran"]["name"];
    $ukuranFile = $_FILES["bukti_pembayaran"]["size"];
    $error = $_FILES["bukti_pembayaran"]["error"];
    $tmpName = $_FILES["bukti_pembayaran"]["tmp_name"];

    if ($error === 4) {
        echo "<script>
                alert('Foto bukti wajib diupload!');
            </script>";

        return false;
    }

    $ekstensiFileValid = ["jpg", "jpeg"];
    $ekstensiFile = explode(".", $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
        echo "<script>
                alert('Gambar yang diupload bukan .jpg!');
            </script>";

        return false;
    }

    // max 10mb
    if ($ukuranFile > 20000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar, Maksimal 20mb!');
            </script>";

        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, "../assets/img/bukti/" . $namaFileBaru);

    return $namaFileBaru;
}


























// ----------------------------------------------------------------------------------------------------------
// UPLOAD GAMBAR
function upload_logo()
{
    $namaFile = $_FILES["logo"]["name"];
    $ukuranFile = $_FILES["logo"]["size"];
    $error = $_FILES["logo"]["error"];
    $tmpName = $_FILES["logo"]["tmp_name"];

    $ekstensiFileValid = ["png"];
    $ekstensiFile = explode(".", $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
        echo "<script>
                alert('Gambar yang diupload bukan .png!');
            </script>";

        return false;
    }

    // max 10mb
    if ($ukuranFile > 20000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar, Maksimal 20mb!');
            </script>";

        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, "../assets/img/" . $namaFileBaru);

    return $namaFileBaru;
}

function upload_ttd()
{
    $namaFile = $_FILES["ttd"]["name"];
    $ukuranFile = $_FILES["ttd"]["size"];
    $error = $_FILES["ttd"]["error"];
    $tmpName = $_FILES["ttd"]["tmp_name"];

    $ekstensiFileValid = ["png"];
    $ekstensiFile = explode(".", $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiFileValid)) {
        echo "<script>
                alert('Gambar yang diupload bukan .png!');
            </script>";

        return false;
    }

    // max 10mb
    if ($ukuranFile > 20000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar, Maksimal 20mb!');
            </script>";

        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, "../assets/img/ttd/" . $namaFileBaru);

    return $namaFileBaru;
}