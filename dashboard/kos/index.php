<?php
if ($_SESSION['role'] == 'Admin') {
    $kosan = mysqli_query($koneksi, "SELECT * FROM kos JOIN users ON kos.id_user=users.id_user ORDER BY id_kos DESC");
} else {
    $id_pemilik_kos = $_SESSION['id_pemilik_kos'];
    $kosan = mysqli_query($koneksi, "SELECT * FROM kos JOIN users ON kos.id_user=users.id_user WHERE kos.id_user='$id_pemilik_kos' ORDER BY id_kos DESC");
}


?>

<div class="content-wrapper">
    <div class="row">
        <?php
        if ($_SESSION['role'] == 'Pemilik Kos') {
            if ($_SESSION['verif'] == 'Telah Diverifikasi') {
        ?>
                <a href="?page=kos/tambah" class="btn btn-primary mb-2 ml-3">Tambah Data Kos</a>
            <?php
            } elseif ($_SESSION['verif'] == 'Pending') { ?>
                <p class="text-danger">Maaf, anda belum dapat menambahkan data kos. Mohon menunggu proses verifikasi identitas terlebih dahulu dan silakan login kembali.</p>
            <?php
            } elseif ($_SESSION['verif'] == 'Ditolak') { ?>
                <p class="text-danger">Maaf, anda tidak dapat menambahkan data kos. Verifikasi identitas gagal.</p>
        <?php
            }
        }
        ?>


        <div class="col-lg-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h4 class="card-title mb-3">Daftar Kosan</h4>
                    </div>
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table">
                            <tbody>
                                <?php
                                $no = 1;
                                while ($kos = mysqli_fetch_array($kosan)) { ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex ">
                                                <img class="img-sm rounded-circle mb-md-0 mr-2" src="../assets/images/kos/<?= $kos['fotopreview'] ?>" alt="profile image">
                                                <div>
                                                    <div> <?= $kos['namakos'] ?></div>
                                                    <?php
                                                    if ($_SESSION['role'] == 'Admin') { ?>
                                                        <div class="font-weight-bold mt-1">Disewakan oleh: <a href="?page=users/detail&id_user=<?= $kos['id_user'] ?>"><?= $kos['namalengkap'] ?></a></div>
                                                    <?php
                                                    } ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            Jenis
                                            <div class="font-weight-bold  mt-1"><?= $kos['jenis'] ?> </div>
                                        </td>
                                        <td>

                                            Harga/bulan
                                            <div class="font-weight-bold  mt-1">Rp. <?= number_format($kos['harga'], 2, '.', ',') ?> </div>


                                        </td>


                                        <td>
                                            <a href="?page=kos/detail&id_kos=<?= $kos['id_kos'] ?>" class="btn btn-sm btn-info">Detail</a>
                                            <?php
                                            if ($_SESSION['role'] == 'Pemilik Kos') { ?>
                                                <a href="?page=kos/edit&id_kos=<?= $kos['id_kos'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <?php
                                            }
                                            ?>
                                            <a href="" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal<?php echo $kos['id_kos']; ?>">Hapus</a>
                                            <!-- hapusModal -->
                                            <div class="modal fade" id="hapusModal<?= $kos['id_kos'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kos</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus data kos ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST">
                                                                <input type="hidden" name="id_kos" value="<?= $kos['id_kos'] ?>">
                                                                <button type="submit" name="hapus_kos" class="btn btn-danger">Hapus</button>
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
                    <p>Total data : <b><?= mysqli_num_rows($kosan) ?></b></p>
                </div>
            </div>
        </div>
    </div>



</div>

<?php
if (isset($_POST['hapus_kos'])) {
    $id_kos = $_POST['id_kos'];
    $hapus_kos = mysqli_query($koneksi, "DELETE FROM kos WHERE id_kos='$id_kos'");
    if ($hapus_kos) {
        echo '<script>alert("Data berhasil dihapus!");window.location="?page=kos/index";</script>';
    } else {
        echo '<script>alert("Data gagal dihapus!");window.location="?page=kos/index";</script>';
    }
}
?>