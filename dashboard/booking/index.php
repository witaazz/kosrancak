<?php

if ($_SESSION['role'] == 'Admin') {
    $booking = mysqli_query($koneksi, "SELECT 
    kos.id_kos AS id_kos, kos.namakos AS namakos, 
    users.namalengkap AS  namalengkap,
    booking.id_booking AS id_booking, booking.id_user AS id_user, booking.tanggal_booking AS tanggal_booking, booking.tanggal_checkin AS tanggal_checkin,
    booking.metodebayar AS metodebayar, booking.buktibayar AS buktibayar, booking.status AS status
    FROM booking 
    JOIN users ON users.id_user=booking.id_user
    JOIN kos ON kos.id_kos = booking.id_kos ORDER BY id_booking DESC
    ");
} else {
    $id_pemilik_kos = $_SESSION['id_pemilik_kos'];
    $booking = mysqli_query($koneksi, "SELECT
    kos.id_kos AS id_kos, kos.namakos AS namakos, 
    users.namalengkap AS  namalengkap,
    booking.id_booking AS id_booking, booking.id_user AS id_user, booking.tanggal_booking AS tanggal_booking, booking.tanggal_checkin AS tanggal_checkin,
    booking.metodebayar AS metodebayar, booking.buktibayar AS buktibayar, booking.status AS status
    FROM booking 
    JOIN users ON users.id_user=booking.id_user
    JOIN kos ON kos.id_kos = booking.id_kos
    WHERE booking.id_kos IN (
        SELECT id_kos 
        FROM kos 
        WHERE id_user = '$id_pemilik_kos'
    ) 
    ORDER BY id_booking DESC");
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
                    <h4 class="card-title">Daftar Transaksi & Booking Kos</h4>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <?php
                            $no = 1;
                            while ($b = mysqli_fetch_array($booking)) { ?>
                                <tr>

                                    <td>
                                        <div class="d-flex ">
                                            <div>
                                                <div class="font-weight-bold"><a href="?page=kos/detail&id_kos=<?= $b['id_kos'] ?>"><?= $b['namakos'] ?></a></div>
                                                <hr class="mt-1 mb-1">
                                                Dibooking oleh: <div class="font-weight-bold mt-1"> <a href="?page=users/detail&id_user=<?= $b['id_user'] ?>"><?= $b['namalengkap'] ?></a></div>

                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        Tanggal Booking: <div class="font-weight-bold mb-1"> <?= $b['tanggal_booking'] ?></div>
                                        Tanggal Check In: <div class="font-weight-bold"> <?= $b['tanggal_checkin'] ?></div>
                                    </td>
                                    <td>
                                        Metode Pembayaran
                                        <div class="font-weight-bold  mt-1 mb-1"><?= $b['metodebayar'] ?> </div>

                                        <a href="assets/images/uploads/payment/<?= $b['buktibayar'] ?>">Lihat bukti pembayaran</a>
                                    </td>

                                    <?php
                                    if (($b['status']) === 'Lunas') {
                                        $stat = "text-success";
                                    } else if (($b['status']) === 'Ditolak') {
                                        $stat = "text-danger";
                                    } else {
                                        $stat = "text-warning";
                                    } ?>
                                    <td class="<?= $stat ?>"><?= $b['status'] ?></td>

                                    <?php
                                    if ($_SESSION['role'] == 'Pemilik Kos') { ?>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <form action="" method="POST" id="bookingForm<?= $b['id_booking'] ?>">
                                                    <input type="hidden" name="id_booking" value="<?= $b['id_booking'] ?>">
                                                    <input type="hidden" name="id_kos" value="<?= $b['id_kos'] ?>">
                                                    <input type="hidden" name="id_user" value="<?= $b['id_user'] ?>">
                                                    <button type="button" name="confirmed" class="btn btn-success btn-sm btn-fw mr-2" onclick="confirmBooking(<?= $b['id_booking'] ?>)"><i class="mdi mdi-marker-check"></i></button>
                                                    <button type="button" name="denied" class="btn btn-danger btn-sm btn-fw" onclick="denyBooking(<?= $b['id_booking'] ?>)"><i class="mdi mdi-minus-circle-outline"></i></button>
                                                </form>

                                            </div>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>

                    </div>
                    <p>Total data : <b><?= mysqli_num_rows($booking) ?></b></p>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
if (isset($_POST['confirmed'])) {
    $id_booking = $_POST['id_booking'];
    $id_kos = $_POST['id_kos'];
    $id_user = $_POST['id_user'];
    // echo var_dump($id_kos);
    // echo var_dump($id_user);
    // die();

    $confirmed_payment = mysqli_query($koneksi, "UPDATE booking SET status='Lunas' WHERE id_booking='$id_booking'");
    if ($confirmed_payment) {
        echo '<script>alert("Pembayaran telah anda konfirmasi!");window.location="?page=booking/index";</script>';
        $tambah_penghuni = mysqli_query($koneksi, "INSERT INTO penghuni_kos (id_kos,id_user) VALUES ('$id_kos','$id_user')");
        $kamarsisa = mysqli_query($koneksi, "UPDATE kos SET avail_room=avail_room-1 WHERE id_kos='$id_kos' ");
    } else {
        echo '<script>alert("Terjadi kesalahan!");window.location="?page=booking/index";</script>';
    }
} else if (isset($_POST['denied'])) {
    $id_booking = $_POST['id_booking'];
    $denied_payment = mysqli_query($koneksi, "UPDATE booking SET status='Pembayaran Ditolak' WHERE id_booking='$id_booking'");
    if ($denied_payment) {
        echo '<script>alert("Pembayaran telah anda tolak!");window.location="?page=booking/index";</script>';
    } else {
        echo '<script>alert("Terjadi kesalahan!");window.location="?page=booking/index";</script>';
    }
}
?>

<script>
    function confirmBooking(bookingId) {
        if (confirm('Konfirmasi pembayaran diterima?')) {
            document.getElementById('bookingForm' + bookingId).innerHTML += '<input type="hidden" name="confirmed" value="confirmed">';
            document.getElementById('bookingForm' + bookingId).submit();
        }
    }

    function denyBooking(bookingId) {
        if (confirm('Tolak pembayaran?')) {
            document.getElementById('bookingForm' + bookingId).innerHTML += '<input type="hidden" name="denied" value="denied">';
            document.getElementById('bookingForm' + bookingId).submit();
        }
    }
</script>