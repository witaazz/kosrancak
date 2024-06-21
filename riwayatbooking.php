<?php
$id_pencari_kos = $_SESSION['id_pencari_kos'];

$riwayat_booking = mysqli_query($koneksi, "SELECT * FROM booking JOIN kos ON kos.id_kos=booking.id_kos WHERE booking.id_user='$id_pencari_kos'");
?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('assets/images/room-3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.php">Home <i class="fa fa-chevron-right"></i></a></span> <span>Contact <i class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">Riwayat Transaksi</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kos</th>
                            <th>Tanggal Booking</th>
                            <th>Tanggal Check In</th>
                            <th>Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($rb = mysqli_fetch_array($riwayat_booking)) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $rb['namakos'] ?></td>
                                <td><?= $rb['tanggal_booking'] ?></td>
                                <td><?= $rb['tanggal_checkin'] ?></td>

                                <td><?= $rb['status'] ?> <?php
                                                            if ($rb['status'] == 'Lunas') { ?>
                                        | <a href="invoice.php?id_booking=<?= $rb['id_booking'] ?>">Print Bukti Booking</a>
                                    <?php
                                                            }
                                    ?>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>