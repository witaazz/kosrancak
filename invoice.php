<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        /* Define your CSS styles for the invoice here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            margin: 5px 0;
        }

        .invoice-details {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 20px;
        }

        /* Hide unnecessary elements for printing */
        @media print {
            body {
                display: block;
            }

            .container {
                width: 100%;
                margin: 0;
            }

            .invoice-header {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="invoice-details">
            <center>
                <h2>Invoice</h2>
            </center>

            <?php
            include 'includes/koneksi.php';
            $id_booking = $_GET['id_booking'];
            $invoice = mysqli_query($koneksi, "SELECT * FROM booking JOIN kos on kos.id_kos=booking.id_kos JOIN users on users.id_user=booking.id_user WHERE booking.id_booking='$id_booking'");
            while ($i = mysqli_fetch_array($invoice)) { ?>
                <p><strong>Nama Kos:</strong> <?= $i['namakos']; ?></p>
                <p><strong>Penyewa Kos:</strong> <?= $i['namalengkap']; ?></p>
                <p><strong>No HP Penyewa Kos:</strong> <?= $i['nohp']; ?></p>
                <p><strong>Tanggal Booking:</strong> <?= $i['tanggal_booking']; ?></p>
                <p><strong>Tanggal Check In:</strong> <?= $i['tanggal_checkin']; ?></p>
                <p><strong>Status Pembayaran:</strong> <?= $i['status']; ?></p>
            <?php
            } ?>
        </div>
    </div>
    <script>
        // Automatically open print dialog when the page is loaded
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>