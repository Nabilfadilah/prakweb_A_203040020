<?php


if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                    alert('Data Berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>";
    } else {
        echo "<script>
                    alert('Data Gagal ditambahkan!');
                    document.location.href = 'index.php';
                </script>";
    }
}
?>

<!-- Si areel -->
<?php
function koneksi()
{
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "prakweb_a_203040020_pw");
    return $conn;
}

// function upload
function upload()
{
    $nama_file = $_FILES['gambar']['name'];
    $tipe_file = $_FILES['gambar']['type'];
    $ukuran_file = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    // ketika tidak ada gambar yang dipilih
    if ($error == 4) {
        // echo "<script>
        //       alert('pilih gambar terlebih dahulu');
        //       </script>";
        return 'akun.png';
    }
    // cek ekstensi file
    $daftar_gambar = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));
    if (!in_array($ekstensi_file, $daftar_gambar)) {
        echo "<script>
          alert('yang anda pilih bukan gambar');
          </script>";
        return false;
    }

    // cek type file
    if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
        echo "<script>
          alert('yang anda pilih bukan gambar');
          </script>";
        return false;
    }

    // cek ukuran file
    // maks 5 mb
    if ($ukuran_file > 5000000) {
        echo "<script>
          alert('ukuran terlalu besar');
          </script>";
        return false;
    }

    // lolos pengecekan
    // siap uploaad file
    // generate nama file baru
    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;
    move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);
    return $nama_file_baru;
}

// menambahkan fungsi tambah
function tambah($data)
{
    // ambil data dari tiap elemen dalam form
    $conn = koneksi();

    $nama = htmlspecialchars($data["nama"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $penulis = htmlspecialchars($data["penulis"]);
    // $poster = htmlspecialchars($data["poster"]);
    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO buku
                VALUES
                ('', '$nama', '$gambar', '$penulis')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// cek apakah tombol sudah ditekan atau belum
if (isset($_POST["tambah"])) {
    // cek apakah data berhasil di tambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan')
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
    <script>
        alert('data gagal ditambahkan')
        document.location.href = 'index.php';
    </script>
";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />

    <!-- my css -->
    <link rel="stylesheet" href="css/style.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- <style>
        section {
            min-height: 420px;
        }

        h1 {
            text-align: center;
        }

        ul,
        li {
            text-align: center;
        }

        span {
            font-family: arial;
            border: 1px solid black;
            padding: 5px;
            background-color: blue;
            font-weight: bold;
        }
    </style> -->
</head>

<body style="background-image: url(../img/slider/tambah.jpg); background-size: 507px;">
    <section id="tambah" class="tambah">
        <div class="container" style="margin-top: 100px;">
            <div class="row">
                <div class="col offset-m3 s6">
                    <form action="" method="POST">
                        <div class="card-panel m3 s6">
                            <h5 style="text-align: center;">Form Tambah Data</h5>

                            <div class="input-field">
                                <input type="text" name="nama" id="nama" required class="validate" autocomplete="off">
                                <label for="nama" class="active">Nama :</label>
                            </div>

                            <div class="input-field">
                                <input type="text" name="gambar" id="gambar" required class="validate" autocomplete="off">
                                <label for="gambar" class="active">Gambar :</label>
                            </div>

                            <div class="input-field">
                                <input type="text" name="penulis" id="penulis" required class="validate" autocomplete="off">
                                <label for="penulis" class="active">Penulis :</label>
                            </div>

                            <button type="submit" name="tambah">Tambah Data!</button>
                            <button type="submit">
                                <a href="../index.php" style="text-decoration: none; color: black;">Kembali</a>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </form>

</body>

</html>




<!-- 
<body style="background-image: url(../assets/slider/tambah.jpg); background-size: 507px;">
    <h1>Form Tambah Data Produk</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="nama">Nama :</label><br>
                <input type="text" name="nama" id="nama" required><br><br>
            </li>
            <li>
                <label for="gambar">Gambar :</label><br>
                <input type="text" name="gambar" id="gambar" required><br><br>
            </li>
            <li>
                <label for="penulis">Penulis :</label><br>
                <input type="text" name="penulis" id="penulis" required><br><br>
            </li>
            <br>
            <button type="submit" name="tambah">Tambah Data!</button>
            <button type="submit">
                <a href="../index.php" style="text-decoration: none; color: black;">Kembali</a>
            </button>
        </ul>
    </form>

</body>

</html> -->