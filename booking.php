<?php
if (!isset($_SESSION['id_pencari_kos'])) {
    echo '<script>alert("Silakan login sebelum booking kos!");window.location="login.php";</script>';
} else {
    if ($_SESSION['verif_pencari_kos'] == 'Pending') {
        echo '<script>alert("Maaf, anda belum bisa melakukan proses booking kos. Mohon menunggu proses verifikasi identitas terlebih dahulu dan silakan login kembali.");window.location="logout.php";</script>';
    } else if ($_SESSION['verif_pencari_kos'] == 'Ditolak') {
        echo '<script>alert("Maaf, anda tidak dapat melakukan proses booking kos. Verifikasi identitas gagal!");window.location="index.php";</script>';
    } else {
        $id_kos = $_POST['id_kos'];
        $paymentinfo = mysqli_query($koneksi, "SELECT kos.namakos AS namakos, 
        kos.fotopreview AS fotopreview, 
        kos.harga AS harga, 
        rekening.norekening AS norekening, 
        rekening.namabank AS namabank, 
        users.namalengkap AS namalengkap
        FROM kos 
        JOIN rekening ON rekening.id_user = kos.id_user 
        JOIN users ON users.id_user = kos.id_user 
        WHERE kos.id_kos = '$id_kos' LIMIT 1;
        ");
    }
}




?>
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row no-gutters">

            <div class="col-md-12">
                <div class="wrapper">
                    <div class="row no-gutters">
                        <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                            <div class="info-wrap bg-primary w-100 p-md-5 p-4">
                                <?php
                                while ($p = mysqli_fetch_assoc($paymentinfo)) { ?>
                                    <h3><?= $p['namakos'] ?></h3>
                                    <div class="dbox w-100 d-flex align-items-start">
                                        <img src="assets/images/kos/<?= $p['fotopreview'] ?>" alt="<?= $p['fotopreview'] ?>" width="330px">
                                    </div>
                                    <div class="dbox w-100 d-flex align-items-start">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-money"></span>
                                        </div>
                                        <div class="text pl-3">
                                            <p><span>Harga </span><br>
                                                Rp. <?= number_format($p['harga'], 2, '.', ',') ?>/bulan </p>
                                        </div>
                                    </div>
                                    <div class="dbox w-100 d-flex align-items-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-university"></span>
                                        </div>
                                        <div class="text pl-3">
                                            <p><span>Rekening tujuan</span> <br>
                                                <?= $p['norekening'] ?></p>
                                            <p> <?= $p['namabank'] ?></p>
                                            <p>a.n. <?= $p['namalengkap'] ?></p>
                                        </div>
                                    </div>
                            </div>
                        <?php
                                } ?>
                        </div>
                        <div class="col-lg-8 col-md-7 d-flex align-items-stretch">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Pembayaran</h3>
                                <form id="contactForm" name="contactForm" class="contactForm" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" class="form-control" name="id_kos" value="<?= $id_kos ?>">
                                        <input type="hidden" class="form-control" name="tanggal_booking" value="<?= date('Y-m-d') ?>">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="icon"><span class="ion-md-calendar"></span></div>
                                                <label for="tanggal_checkin">Tanggal Check-In</label>
                                                <input type="date" class="form-control" name="tanggal_checkin" id="tanggal_checkin" required>
                                                <i>
                                                    <p>Tanggal checkin maksimal sebulan sejak tanggal booking (<?= date('d-M-Y') ?>)</p>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-field">
                                                    <div class="select-wrap">
                                                        <label for="metodebayar">Metode Pembayaran</label>
                                                        <select name="metodebayar" id="metodebayar" class="form-control" required>
                                                            <option value="" selected disabled>Pilih Metode Pembayaran</option>
                                                            <option value="Transfer Bank BCA">Transfer Bank BCA</option>
                                                            <option value="Transfer Bank BNI">Transfer Bank BNI</option>
                                                            <option value="Transfer Bank BRI">Transfer Bank BRI</option>
                                                            <option value="Transfer Bank Mandiri">Transfer Bank Mandiri</option>
                                                            <option value="Transfer Bank Syariah Indonesia (BSI)">Transfer Bank Syariah Indonesia (BSI)</option>
                                                            <option value="Transfer Bank Permata">Transfer Bank Permata</option>
                                                            <option value="Transfer Bank Mega">Transfer Bank Mega</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-wrap">
                                                    <div class="icon"><span class="ion-md-calendar"></span></div>
                                                    <label for="buktibayar">Screenshoot/foto bukti pembayaran</label>
                                                    <input type="file" class="form-control" name="buktibayar" id="buktibayar" required>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" name="booking" value="Book Appartment Now" class="btn btn-primary py-3 px-4">Upload bukti pembayaran</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
if (isset($_POST['booking'])) {

    function upload()
    {

        $namaFile = $_FILES['buktibayar']['name'];
        $ukuranFile = $_FILES['buktibayar']['size'];
        $error = $_FILES['buktibayar']['error'];
        $tmpName = $_FILES['buktibayar']['tmp_name'];

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
        if ($ukuranFile > 50000000) {
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

        move_uploaded_file($tmpName, 'dashboard/assets/images/uploads/payment/' . $namaFileBaru);

        return $namaFileBaru;
    }

    // $id_kos = $_POST['id_kos'];
    $tanggal_booking = $_POST['tanggal_booking'];
    $tanggal_checkin = $_POST['tanggal_checkin'];
    $metodebayar = $_POST['metodebayar'];
    $buktibayar = upload();

    $status = "Menunggu Konfirmasi";

    $id_user = $_SESSION['id_pencari_kos'];



    $booking = mysqli_query($koneksi, "INSERT INTO booking VALUES ('','$id_user','$id_kos','$tanggal_booking','$tanggal_checkin','$metodebayar','$buktibayar','$status')");
    if ($booking) {
        echo '<script>alert("Booking berhasil! Mohon menunggu konfirmasi pembayaran dari pemilik kos!");
        window.location="?page=riwayatbooking";</script>';
    }
}
?>

<script>
    // Get today's date
    var today = new Date();
    // Set maximum date for check-in (1 month from today)
    var maxDate = new Date(today.getFullYear(), today.getMonth() + 1, today.getDate()).toISOString().split('T')[0];

    // Set the maximum date for the input field
    document.getElementById("tanggal_checkin").setAttribute("max", maxDate);
</script>