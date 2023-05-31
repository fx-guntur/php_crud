<?php
define('host', 'localhost');
define('user', 'root');
define('pass', '');
define('db', 'prares_web');

$conn = mysqli_connect(host, user, pass, db);

if (!$conn) {
    die("Tidak bisa terkoneksi ke database");
}

$kategori = "";
$keterangan = "";
$jumlah = "";
$tipe = "";
$pemasukan = "";
$pengeluaran = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'delete'){
    $id_transaksi = $_GET['id'];
    $sql1 = "DELETE FROM keuangan where id_transaksi = '$id_transaksi'";
    $q1 = mysqli_query($conn, $sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id_transaksi = $_GET['id'];
    $sql1 = "SELECT * FROM keuangan where id_transaksi = '$id_transaksi'";
    $q1 = mysqli_query($conn, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $kategori = $r1['kategori'];
    $keterangan = $r1['keterangan'];
    if($r1['pemasukan']==0){
        $jumlah = $r1['pengeluaran'];
        $tipe = "pengeluaran";
    } else{
        $jumlah = $r1['pemasukan'];
        $tipe = "pemasukan";
    }

    if ('kategori' == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $kategori = $_POST['kategori'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];
    $tipe = $_POST['tipe'];
    if($tipe=="pemasukan"){
        $pemasukan=$jumlah;
        $pengeluaran=0;
    }else{
        $pengeluaran=$jumlah;
        $pemasukan=0;
    }

    if ($kategori && $keterangan && $tipe && $jumlah) {
        if ($op == 'edit') {
            $sql1 = "UPDATE keuangan SET kategori = '$kategori', keterangan = '$keterangan', pemasukan = '$pemasukan',  pengeluaran = '$pengeluaran' WHERE id_transaksi = '$id_transaksi'";
            $q1 = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses = "Data berhasil di Update";
            } else {
                $error = "Data gagal diupdate";
            }
        } else {
            $sqli = "INSERT INTO keuangan(kategori, pemasukan, pengeluaran, keterangan) VALUES('$kategori','$pemasukan','$pengeluaran', '$keterangan')";
            $q1 = mysqli_query($conn, $sqli);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silahkan masukkan semua data!";
    }
}
?>