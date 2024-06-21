<?php

if ($_SESSION['role'] == 'Admin') {
    $penghuni = mysqli_query($koneksi, "SELECT *
    FROM penghuni_kos 
    JOIN kos ON kos.id_kos = penghuni_kos.id_kos
    JOIN users ON users.id_user=penghuni_kos.id_user
    
    ");
} else {
    $id_pemilik_kos = $_SESSION['id_pemilik_kos'];
    $penghuni = mysqli_query($koneksi, "SELECT *
    FROM penghuni_kos 
    JOIN kos ON kos.id_kos = penghuni_kos.id_kos
    JOIN users ON users.id_user=penghuni_kos.id_user
    WHERE penghuni_kos.id_kos IN (
        SELECT id_kos 
        FROM kos 
        WHERE id_user = '$id_pemilik_kos'
    )");
}

?>

<div class="content-wrapper">
    <!-- <div class="row">
        <div class="col-sm-6 mb-2">
            <h3 class="mb-0 font-weight-bold">Daftar Transaksi</h3>
        </div>

    </div> -->
    <div class="row ml-0 mr-0">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Penghuni Kos</h4>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kos</th>
                                    <th>Nama Penghuni</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($p = mysqli_fetch_array($penghuni)) { ?>
                                    <tr>
                                        <td>
                                            <?= $no++ ?>
                                        </td>
                                        <td>

                                            <a href="?page=kos/detail&id_kos=<?= $p['id_kos'] ?>"><?= $p['namakos'] ?></a>

                                        </td>
                                        <td>
                                            <a href="?page=users/detail&id_user=<?= $p['id_user'] ?>"><?= $p['namalengkap'] ?></a>
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#deleteModal<?= $p['id_penghuni'] ?>">X</a>
                                        </td>

                                        <div class="modal fade" id="deleteModal<?= $p['id_penghuni'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?= $id_value ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?= $p['id_penghuni'] ?>">Hapus Penghuni</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus <b><?= $p['namalengkap'] ?></b> dari daftar penghuni <b><?= $p['namakos'] ?></b> ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="" method="post"> <!-- Replace "delete_image.php" with your delete image script -->
                                                            <input type="hidden" name="id_penghuni" value="<?= $p['id_penghuni'] ?>">
                                                            <input type="hidden" name="id_kos" value="<?= $p['id_kos'] ?>">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="delete_penghuni" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                        </table>
                    </div>
                    <p>Total data : <b><?= mysqli_num_rows($penghuni) ?></b></p>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
if (isset($_POST['delete_penghuni'])) {
    $id_penghuni = $_POST['id_penghuni'];
    $id_kos = $_POST['id_kos'];
    $hapus_penghuni = mysqli_query($koneksi, "DELETE FROM penghuni_kos WHERE id_penghuni='$id_penghuni'");
    if ($hapus_penghuni) {
        echo '<script>alert("Data penghuni telah dihapus!");window.location="?page=penghunikos/index";</script>';
        $kamarsisa = mysqli_query($koneksi, "UPDATE kos SET avail_room=avail_room+1 WHERE id_kos='$id_kos' ");
    } else {
        echo '<script>alert("Terjadi kesalahan!");window.location="?page=penghunikos/index";</script>';
    }
}
?>