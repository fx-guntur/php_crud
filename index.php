<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data item game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px;
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                    <?php
                    header("refresh:5;url=index.php"); // 5 adalah melakukan redirect setelah 5 detik
                }
                ?>
                <?php
                if ($sukses) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                    <?php
                    header("refresh:5;url=index.php");
                }
                ?>

                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama_item" class="col-sm-2 col-form-label">Nama item</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_item" name="nama_item"
                                value="<?php echo $nama_item ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="harga" name="harga"
                                value="<?php echo $harga ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="rarity" class="col-sm-2 col-form-label">Rarity</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="rarity" name="rarity">
                                <option value=""> - Pilih Rarity - </option>
                                <option value="R" <?php if ($rarity == "R")
                                    echo "selected" ?>>Rare</option>
                                    <option value="SR" <?php if ($rarity == "SR")
                                    echo "selected" ?>>Super Rare</option>
                                    <option value="SSR" <?php if ($rarity == "SSR")
                                    echo "selected" ?>>Super Super Rare
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>

            <!-- untuk menampilkan data -->
            <div class="card">
                <div class="card-header text-white bg-secondary">
                    Data item game
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nama Item</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Rarity</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        <tbody>
                            <?php
                                $sql2 = "SELECT * FROM item_game ORDER BY id_item DESC";
                                $q2 = mysqli_query($conn, $sql2);
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $id_item = $r2['id_item'];
                                    $nama_item = $r2['nama_item'];
                                    $harga = $r2['harga'];
                                    $rarity = $r2['rarity'];

                                    ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $id_item ?>
                                </th>
                                <td scope="row">
                                    <?php echo $nama_item ?>
                                </td>
                                <td scope="row">
                                    <?php echo $harga ?>
                                </td>
                                <td scope="row">
                                    <?php echo $rarity ?>
                                </td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id_item ?>">
                                        <button type="button" class="btn btn-warning">Edit</button>
                                    </a>
                                    <a href="index.php?op=delete&id=<?php echo $id_item ?>" onclick="return confirm('Apakah anda yakin untuk menghapus item ini?')">
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                }
                                ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>