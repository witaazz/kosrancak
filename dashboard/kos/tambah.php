<div class="content-wrapper">
    <div class="row">
        <a href="?page=kos/index" class="btn btn-primary mb-2 ml-3">Kembali</a>
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Data Kos</h4>
                    <form class="form-sample" action="" method="POST" enctype="multipart/form-data">
                        <p class="card-description">
                            Info kos
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Kos</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="namakos" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jenis Kos</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="jenis" id="membershipRadios1" value="Putra">
                                                Putra
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="jenis" id="membershipRadios2" value="Putri">
                                                Putri
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Harga</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-primary text-white">Rp.</span>
                                                </div>
                                                <input type="number" name="harga" class="form-control" aria-label="Amount (to the nearest dollar)">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">per bulan</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Listrik</label>
                                    <div class="col-sm-9">
                                        <select name="listrik" class="form-control">
                                            <option value="Termasuk Listrik">Termasuk Listrik</option>
                                            <option value="Tidak Termasuk Listrik">Tidak Termasuk Listrik</option>
                                        </select>

                                        <!-- <input class="form-control" placeholder="dd/mm/yyyy" /> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Ukuran</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="number" name="panjang" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Panjang">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">x</span>
                                                </div>
                                                <input type="number" name="lebar" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Lebar">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-primary text-white">Meter</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Maks. isi</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="number" name="isi" class="form-control" aria-label="Amount (to the nearest dollar)">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">orang per kamar</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea name="alamat" class="form-control" id="exampleTextarea1" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Deskripsi</label>
                                    <div class="col-sm-9">
                                        <textarea name="deskripsi" class="form-control" id="exampleTextarea1" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Foto preview</label>
                                    <div class="col-md-9 mt-3">
                                        <input type="file" name="fotopreview">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kamar Tersisa</label>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="number" name="avail_room" class="form-control" aria-label="Amount (to the nearest dollar)">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-3 col-form-label">Fasilitas</label>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <?php
                                            // Define an empty array to store checked values
                                            $checked_values = [];

                                            // Fetch the list of fasilitas
                                            $fasilitas = mysqli_query($koneksi, "SELECT * FROM fasilitas ORDER BY jenisfasilitas");

                                            // Counter to control the number of checkboxes per column
                                            $counter = 0;

                                            while ($f = mysqli_fetch_array($fasilitas)) {
                                                // Check if the checkbox is checked
                                                if (isset($_POST['fasilitas']) && in_array($f['id_fasilitas'], $_POST['fasilitas'])) {
                                                    // Add the checked value to the array
                                                    $checked_values[] = $f['id_fasilitas'];
                                                }
                                            ?>
                                                <div class="col-sm-3">
                                                    <input type="checkbox" name="fasilitas[]" value="<?= $f['id_fasilitas'] ?>" <?php if (isset($_POST['fasilitas']) && in_array($f['id_fasilitas'], $_POST['fasilitas'])) echo 'checked'; ?>> <?= $f['namafasilitas'] ?>
                                                </div>

                                            <?php
                                                // Increment the counter
                                                $counter++;

                                                // Check if 3 checkboxes are displayed, then start a new row
                                                if ($counter % 4 == 0) {
                                                    echo '</div><div class="row">';
                                                }
                                            }

                                            // Implode the checked values into a comma-separated string
                                            $checked_values_string = implode(', ', $checked_values);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-5 mr-0">
                                <button type="submit" name="tambah_kos" class="btn btn-primary mr-2">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

function upload()
{

    $namaFile = $_FILES['fotopreview']['name'];
    $ukuranFile = $_FILES['fotopreview']['size'];
    $error = $_FILES['fotopreview']['error'];
    $tmpName = $_FILES['fotopreview']['tmp_name'];

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

if (isset($_POST['tambah_kos'])) {

    $namakos = $_POST['namakos'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $listrik = $_POST['listrik'];
    $namakos = $_POST['namakos'];
    $ukuran = $_POST['panjang'] . "x" . $_POST['lebar'];
    $isi = $_POST['isi'];
    $alamat = $_POST['alamat'];
    $deskripsi = $_POST['deskripsi'];
    $fotopreview = upload();
    $avail_room = $_POST['avail_room'];
    $fasilitas_checked = $checked_values_string;

    $id_pemilik_kos = $_SESSION['id_pemilik_kos'];


    $tambah_kos = mysqli_query($koneksi, "INSERT INTO kos VALUES ('','$id_pemilik_kos','$namakos','$jenis','$alamat',$avail_room,$harga,'$listrik','$ukuran',$isi,'$deskripsi','$fotopreview','$fasilitas_checked')");
    if ($tambah_kos) {
        $check_info_rekening_pemilik = mysqli_query($koneksi, "SELECT * FROM rekening WHERE id_user='$id_pemilik_kos'");
        if (mysqli_num_rows($check_info_rekening_pemilik) == 0) {
            echo '<script>alert("Data kos berhasil ditambahkan! \nMohon menambahkan INFO REKENING!");window.location="?page=profil/index";</script>';
        } else {
            echo '<script>alert("Data kos berhasil ditambahkan!");window.location="?page=kos/index";</script>';
        }
    } else {
        echo '<script>alert("Data gagal ditambahkan!");window.location="?page=kos/tambah";</script>';
    }
}
?>