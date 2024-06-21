<?php
if (isset($_POST['filter'])) {
    $jenisfasilitas = $_POST['jenisfasilitas'];
    if ($jenisfasilitas === 'Semua') {
        $fasilitas = mysqli_query($koneksi, "SELECT * FROM fasilitas ORDER BY id_fasilitas DESC");
    } else {
        $fasilitas = mysqli_query($koneksi, "SELECT * FROM fasilitas WHERE jenisfasilitas='$jenisfasilitas' ORDER BY id_fasilitas DESC");
    }
} else {
    $fasilitas = mysqli_query($koneksi, "SELECT * FROM fasilitas ORDER BY id_fasilitas DESC");
}
?>

<div class="content-wrapper">
    <div class="row ml-0 mr-0">
        <button type="button" class="btn btn-primary mb-2 ml-3" data-toggle="modal" data-target="#tambahModal">
            Tambah Data Fasilitas
        </button>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Fasilitas Kos</h4>
                    <hr>
                    <div class="mb-3">
                        <form method="POST" class="form-inline" action="">
                            <div class="form-group mr-2">
                                <label for="jenisfasilitas" class="mr-2">Jenis Fasilitas:</label>
                                <select name="jenisfasilitas" id="jenisfasilitas" class="form-control">
                                    <option value="Semua" selected>Semua</option>
                                    <?php
                                    $distinct_jenisfasilitas = mysqli_query($koneksi, "SELECT DISTINCT jenisfasilitas FROM fasilitas");
                                    while ($row = mysqli_fetch_array($distinct_jenisfasilitas)) {
                                        echo "<option value='{$row['jenisfasilitas']}'" . ($jenisfasilitas === $row['jenisfasilitas'] ? ' selected' : '') . ">{$row['jenisfasilitas']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="filter" class="btn btn-primary">Apply Filter</button>
                        </form>
                    </div>
                    <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Fasilitas</th>
                                    <th>Jenis Fasilitas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($f = mysqli_fetch_array($fasilitas)) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $f['namafasilitas'] ?></td>
                                        <td><?= $f['jenisfasilitas'] ?></td>
                                        <td>

                                            <a href="" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?php echo $f['id_fasilitas']; ?>">Edit</a>
                                            <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal<?php echo $f['id_fasilitas']; ?>">Hapus</a>
                                            <!-- editModal -->
                                            <div class="modal fade" id="editModal<?= $f['id_fasilitas'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Fasilitas</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="">
                                                                <input type="hidden" name="id_fasilitas" value="<?= $f['id_fasilitas'] ?>">
                                                                <div class="form-group">
                                                                    <select name="jenisfasilitas" class="form-control form-control-sm">
                                                                        <option value="<?= $f['jenisfasilitas'] ?>" disabled>Jenis Fasilitas</option>
                                                                        <option value="Fasilitas Kamar" <?= $f['jenisfasilitas'] == 'Fasilitas Kamar' ? 'selected="selected"' : ''; ?>>Fasilitas Kamar</option>
                                                                        <option value="Fasilitas Kamar Mandi" <?= $f['jenisfasilitas'] == 'Fasilitas Kamar Mandi' ? 'selected="selected"' : ''; ?>>Fasilitas Kamar Mandi</option>
                                                                        <option value="Fasilitas Umum" <?= $f['jenisfasilitas'] == 'Fasilitas Umum' ? 'selected="selected"' : ''; ?>>Fasilitas Umum</option>
                                                                        <option value="Fasilitas Parkir" <?= $f['jenisfasilitas'] == 'Fasilitas Parkir' ? 'selected="selected"' : ''; ?>>Fasilitas Parkir</option>
                                                                        <option value="Keamanan" <?= $f['jenisfasilitas'] == 'Keamanan' ? 'selected="selected"' : ''; ?>>Keamanan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" name="namafasilitas" class="form-control form-control-sm" placeholder="Nama fasilitas" value="<?= $f['namafasilitas'] ?>">
                                                                </div>

                                                                <button type="submit" name="edit_fasilitas" class="btn btn-primary mr-2">Submit</button>
                                                                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of editModal -->

                                            <!-- hapusModal -->
                                            <div class="modal fade" id="hapusModal<?= $f['id_fasilitas'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Fasilitas</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus data fasilitas ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST">
                                                                <input type="hidden" name="id_fasilitas" value="<?= $f['id_fasilitas'] ?>">
                                                                <button type="submit" name="hapus_fasilitas" class="btn btn-danger">Hapus</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of hapusModal -->


                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                    <p> Total data : <b><?= mysqli_num_rows($fasilitas) ?></b></p>
                </div>
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
                    <form method="POST">
                        <div class="form-group">
                            <select name="jenisfasilitas" class="form-control form-control-sm">
                                <option value="Semua" disabled>Jenis Fasilitas</option>
                                <option value="Fasilitas Kamar">Fasilitas Kamar</option>
                                <option value="Fasilitas Kamar Mandi">Fasilitas Kamar Mandi</option>
                                <option value="Fasilitas Umum">Fasilitas Umum</option>
                                <option value="Fasilitas Parkir">Fasilitas Parkir</option>
                                <option value="Keamanan">Keamanan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="namafasilitas" class="form-control form-control-sm" placeholder="Nama fasilitas">
                        </div>
                        <button type="submit" name="tambah_fasilitas" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- end of tambahModal -->

</div>

<!-- process -->
<?php
if (isset($_POST['tambah_fasilitas'])) {
    $jenisfasilitas = $_POST['jenisfasilitas'];
    $namafasilitas = $_POST['namafasilitas'];
    $tambah_fasilitas = mysqli_query($koneksi, "INSERT INTO fasilitas VALUES('','$namafasilitas','$jenisfasilitas')");
    if ($tambah_fasilitas) {
        echo '<script>alert("Data berhasil ditambahkan!");window.location="?page=fasilitaskos/index";</script>';
    } else {
        echo '<script>alert("Data gagal ditambahkan!");window.location="?page=fasilitaskos/index";</script>';
    }
} elseif (isset($_POST['edit_fasilitas'])) {
    $id_fas = $_POST['id_fasilitas'];
    $jenisfas = $_POST['jenisfasilitas'];
    $namafas = $_POST['namafasilitas'];
    $edit_fasilitas = mysqli_query($koneksi, "UPDATE fasilitas SET namafasilitas='$namafas', jenisfasilitas='$jenisfas' WHERE id_fasilitas='$id_fas'");
    if ($edit_fasilitas) {
        echo '<script>alert("Data berhasil diubah!");window.location="?page=fasilitaskos/index";</script>';
    } else {
        echo '<script>alert("Data gagal diubah!");window.location="?page=fasilitaskos/index";</script>';
    }
} elseif (isset($_POST['hapus_fasilitas'])) {
    $id_fas = $_POST['id_fasilitas'];
    $hapus_fasilitas = mysqli_query($koneksi, "DELETE FROM fasilitas WHERE id_fasilitas='$id_fas'");
    if ($hapus_fasilitas) {
        echo '<script>alert("Data berhasil dihapus!");window.location="?page=fasilitaskos/index";</script>';
    } else {
        echo '<script>alert("Data gagal dihapus!");window.location="?page=fasilitaskos/index";</script>';
    }
}
?>