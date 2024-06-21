<?php
$id_pemilik_kos = $_SESSION['id_pemilik_kos'];

if (isset($_POST['filter'])) {
    $id_kosan = $_POST['namakos'];
    if ($id_kosan === 'Semua') {
        $gallery_kos = mysqli_query($koneksi, "SELECT GROUP_CONCAT(kos.namakos SEPARATOR ',') AS a,  GROUP_CONCAT(gallery_kos.foto SEPARATOR ',') AS b, GROUP_CONCAT(gallery_kos.id_gallery SEPARATOR ',') as c FROM gallery_kos JOIN kos on kos.id_kos=gallery_kos.id_kos WHERE gallery_kos.id_kos IN (SELECT DISTINCT kos.id_kos FROM kos WHERE kos.id_user='$id_pemilik_kos')");
    } else {
        $gallery_kos = mysqli_query($koneksi, "SELECT GROUP_CONCAT(kos.namakos SEPARATOR ',') AS a,  GROUP_CONCAT(gallery_kos.foto SEPARATOR ',') AS b, GROUP_CONCAT(gallery_kos.id_gallery SEPARATOR ',') as c FROM gallery_kos JOIN kos on kos.id_kos=gallery_kos.id_kos WHERE gallery_kos.id_kos IN (SELECT DISTINCT kos.id_kos FROM kos WHERE kos.id_user='$id_pemilik_kos' AND gallery_kos.id_kos='$id_kosan')");
    }
} else {
    $gallery_kos = mysqli_query($koneksi, "SELECT GROUP_CONCAT(kos.namakos SEPARATOR ',') AS a,  GROUP_CONCAT(gallery_kos.foto SEPARATOR ',') AS b, GROUP_CONCAT(gallery_kos.id_gallery SEPARATOR ',') as c FROM gallery_kos JOIN kos on kos.id_kos=gallery_kos.id_kos WHERE gallery_kos.id_kos IN (SELECT DISTINCT kos.id_kos FROM kos WHERE kos.id_user='$id_pemilik_kos')");
}
?>

<div class="content-wrapper">
    <div class="row">

        <button type="button" class="btn btn-primary ml-3 mb-1" data-toggle="modal" data-target="#tambahModal">Tambah Gallery</button>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Gallery Kos</h4>
                    <hr>
                    <div class="mb-3">
                        <form method="POST" class="form-inline" action="">
                            <div class="form-group mr-2">
                                <label for="namakos" class="mr-2">Pilih Kos:</label>
                                <select name="namakos" id="namakos" class="form-control">
                                    <option value="Semua" <?= ($_POST['namakos'] ?? 'Semua') === 'Semua' ? 'selected' : '' ?>>Semua</option>
                                    <?php
                                    $kosanku = mysqli_query($koneksi, "SELECT * FROM kos WHERE id_user='$id_pemilik_kos'");
                                    while ($row = mysqli_fetch_array($kosanku)) {
                                        $selected = ($_POST['namakos'] ?? '') === $row['id_kos'] ? 'selected' : '';
                                    ?>
                                        <option value="<?= $row['id_kos'] ?>" <?= $selected ?>><?= $row['namakos'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                            <button type="submit" name="filter" class="btn btn-primary">Apply Filter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="container-wrapper-scroll">
            <?php while ($g = mysqli_fetch_array($gallery_kos)) { ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="gallery">
                            <?php
                            $namakos = explode(",", $g['a']);
                            $foto = explode(",", $g['b']);
                            $id_gallery = explode(",", $g['c']);

                            // Check if all arrays have the same length
                            $count = count($namakos);
                            if (count($foto) === $count && count($id_gallery) === $count) {
                                // Iterate over one of the arrays
                                for ($i = 0; $i < $count; $i++) {
                                    $namakos_value = $namakos[$i];
                                    $foto_value = $foto[$i];
                                    $id_value = $id_gallery[$i];
                            ?>
                                    <div class="gallery-item">
                                        <div class="image-container">
                                            <img src="../assets/images/kos/<?= $foto_value ?>" alt="<?= $foto_value ?>">
                                            <span class="namakos"><?= $namakos_value ?></span> <!-- Kos name -->
                                            <!-- Button to trigger delete image modal -->
                                            <button type="button" class="btn btn-sm btn-danger  delete-btn" data-toggle="modal" data-target="#deleteModal<?= $id_value ?>">
                                                X
                                            </button>
                                        </div>
                                        <!-- Delete image modal -->
                                        <div class="modal fade" id="deleteModal<?= $id_value ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $id_value ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $id_value ?>">Delete Image</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this image?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="" method="post"> <!-- Replace "delete_image.php" with your delete image script -->
                                                            <input type="hidden" name="id_gallery" value="<?= $id_value ?>">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="delete_gallery" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                // Handle case where arrays have different lengths
                                echo "Arrays have different lengths";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</div>

<!-- tambahModal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <select name="id_kos" class="form-control form-control-sm">
                            <option value="----" disabled selected>Pilih Kos</option>
                            <?php
                            $kos = mysqli_query($koneksi, "SELECT * FROM kos WHERE id_user='$id_pemilik_kos'");
                            while ($k = mysqli_fetch_array($kos)) {
                            ?>
                                <option value="<?= $k['id_kos'] ?>"><?= $k['namakos'] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <input type="file" name="foto" class="form-control form-control-sm">
                    </div>
                    <button type="submit" name="add_gallery" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- end of tambahModal -->

<?php
function upload()
{

    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 20000000) {
        echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, '../assets/images/kos/' . $namaFileBaru);

    return $namaFileBaru;
}

if (isset($_POST['delete_gallery'])) {
    $id_gallery = $_POST['id_gallery'];
    $hapus_gallery = mysqli_query($koneksi, "DELETE FROM gallery_kos WHERE id_gallery='$id_gallery'");
    if ($hapus_gallery) {
        echo '<script>alert("Data berhasil dihapus!");window.location="?page=gallerykos/index";</script>';
    } else {
        echo '<script>alert("Data gagal dihapus!");window.location="?page=gallerykos/index";</script>';
    }
} else if (isset($_POST['add_gallery'])) {
    $id_kos = $_POST['id_kos'];
    $foto = upload();

    $tambah_gallery = mysqli_query($koneksi, "INSERT INTO gallery_kos VALUES ('','$id_kos','$foto')");
    if ($tambah_gallery) {
        echo '<script>alert("Data berhasil ditambahkan!");window.location="?page=gallerykos/index";</script>';
    } else {
        echo '<script>alert("Terjadi kesalahan!");window.location="?page=gallerykos/index";</script>';
    }
}
?>