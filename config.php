<?php
define('host', 'localhost');
define('user', 'root');
define('pass', '');
define('db', 'tutor_crud');

$conn = mysqli_connect(host, user, pass, db);
if (!$conn) {
    die("Tidak bisa terkoneksi ke database");
}

$nama_item = "";
$harga = "";
$rarity = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'delete'){
    $id_item = $_GET['id'];
    $sql1 = "DELETE FROM item_game where id_item = '$id_item'";
    $q1 = mysqli_query($conn, $sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id_item = $_GET['id'];
    $sql1 = "SELECT * FROM item_game where id_item = '$id_item'";
    $q1 = mysqli_query($conn, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nama_item = $r1['nama_item'];
    $harga = $r1['harga'];
    $rarity = $r1['rarity'];

    if ('nama_item' == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama_item = $_POST['nama_item'];
    $harga = $_POST['harga'];
    $rarity = $_POST['rarity'];

    if ($nama_item && $harga && $rarity) {
        if ($op == 'edit') {
            $sql1 = "UPDATE item_game SET nama_item = '$nama_item', harga = '$harga', rarity = '$rarity' WHERE id_item = '$id_item'";
            $q1 = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses = "Data berhasil di Update";
            } else {
                $error = "Data gagal diupdate";
            }
        } else {
            $sqli = "INSERT INTO item_game(nama_item, harga, rarity) VALUES('$nama_item','$harga','$rarity')";
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