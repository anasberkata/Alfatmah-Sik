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
    $password = $data["password"];

    $gambar = "default.jpg";

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
			(NULL, '$nis', '$nisn', '$nama_siswa', '$id_rombel', '$jk', '$alamat', '$phone', '$username', '$password', '$gambar', '$date_created', '$is_active')
			";

        mysqli_query($conn, $query);
    }

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

// PEMBAYARAN
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

// KWITANSI