-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 01:48 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kosrancak`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`) VALUES
(1, 'Administrator', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kos` int(11) NOT NULL,
  `tanggal_booking` date NOT NULL,
  `tanggal_checkin` date NOT NULL,
  `metodebayar` varchar(255) NOT NULL,
  `buktibayar` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_user`, `id_kos`, `tanggal_booking`, `tanggal_checkin`, `metodebayar`, `buktibayar`, `status`) VALUES
(4, 6, 1, '2024-05-08', '2024-06-07', 'Transfer Bank Mandiri', '663b1ee79d884.png', 'Lunas'),
(6, 7, 3, '2024-05-10', '2024-06-09', 'Transfer Bank Mandiri', '663e07139c68e.png', 'Lunas'),
(7, 8, 1, '2024-05-11', '2024-05-30', 'Transfer Bank BCA', '663ee03129520.png', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `namafasilitas` varchar(255) NOT NULL,
  `jenisfasilitas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `namafasilitas`, `jenisfasilitas`) VALUES
(1, 'Kasur', 'Fasilitas Kamar'),
(2, 'Lemari Baju', 'Fasilitas Kamar'),
(3, 'Bantal', 'Fasilitas Kamar'),
(4, 'AC', 'Fasilitas Kamar'),
(5, 'Kipas Angin', 'Fasilitas Kamar'),
(7, 'Ventilasi', 'Fasilitas Kamar'),
(8, 'Guling', 'Fasilitas Kamar'),
(9, 'Jendela', 'Fasilitas Kamar'),
(10, 'Cermin', 'Fasilitas Kamar'),
(11, 'Kamar Mandi Dalam', 'Fasilitas Kamar Mandi'),
(12, 'Kloset Duduk', 'Fasilitas Kamar Mandi'),
(13, 'Kloset Jongkok', 'Fasilitas Kamar Mandi'),
(15, 'Shower', 'Fasilitas Kamar Mandi'),
(16, 'Air Panas', 'Fasilitas Kamar Mandi'),
(17, 'Ember', 'Fasilitas Kamar Mandi'),
(19, 'WIFI', 'Fasilitas Umum'),
(20, 'Meja Belajar', 'Fasilitas Kamar'),
(30, 'Ruang Tamu', 'Fasilitas Umum'),
(31, 'Laundry', 'Fasilitas Umum'),
(32, 'Parkir Motor', 'Fasilitas Parkir'),
(33, 'Parkir Mobil', 'Fasilitas Parkir'),
(34, 'Parkir Sepeda', 'Fasilitas Parkir'),
(35, 'CCTV', 'Keamanan'),
(36, 'Pengurus Kos', 'Keamanan'),
(37, 'Kamar Mandi Luar', 'Fasilitas Kamar Mandi'),
(38, 'Ruang Jemur', 'Fasilitas Umum'),
(39, 'Mesin Cuci', 'Fasilitas Umum'),
(40, 'Ruang Cuci', 'Fasilitas Umum'),
(41, 'Kulkas', 'Fasilitas Umum'),
(42, 'Dapur', 'Fasilitas Umum');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_kos`
--

CREATE TABLE `gallery_kos` (
  `id_gallery` int(11) NOT NULL,
  `id_kos` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery_kos`
--

INSERT INTO `gallery_kos` (`id_gallery`, `id_kos`, `foto`) VALUES
(1, 1, 'image_2.jpg'),
(2, 1, 'image_5.jpg'),
(3, 1, 'room-6.jpg'),
(9, 3, '663e039c8c63e.jpg'),
(10, 3, '663e03a62d1b9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kos`
--

CREATE TABLE `kos` (
  `id_kos` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `namakos` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `avail_room` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `listrik` varchar(255) NOT NULL,
  `ukuran` varchar(10) NOT NULL,
  `isi` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `fotopreview` varchar(255) NOT NULL,
  `fasilitas_kos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kos`
--

INSERT INTO `kos` (`id_kos`, `id_user`, `namakos`, `jenis`, `alamat`, `avail_room`, `harga`, `listrik`, `ukuran`, `isi`, `deskripsi`, `fotopreview`, `fasilitas_kos`) VALUES
(1, 1, 'Kos Wita', 'Putri', 'Lubuk Begalung tantang sinan tu a', 8, 500000, 'Tidak Termasuk Listrik', '3x4', 1, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus aspernatur commodi nobis eligendi laborum! Harum optio saepe modi sequi. Enim, commodi. Enim vero, distinctio cumque accusantium sunt autem minima iste voluptatum numquam possimus rem dolor illum quis assumenda temporibus blanditiis iure id molestias quod. Consectetur veritatis cupiditate obcaecati. Suscipit adipisci omnis sequi eos, sint ut modi eaque provident debitis perferendis nostrum necessitatibus commodi praesentium deleniti repellendus veniam earum fugit dignissimos cum rerum. Autem sequi nulla numquam officia, nihil animi veritatis ducimus eaque tempore aperiam earum atque inventore hic a nemo quia amet soluta dicta. Corporis neque quod dignissimos est, blanditiis magni fugit eum quas optio quasi illum necessitatibus nobis corrupti fuga ad alias aspernatur quo illo dolor? Odio porro cum eveniet, architecto eos dolore in perspiciatis illum officiis mollitia amet quaerat recusandae velit autem fuga iure totam iste aspernatur saepe aperiam ut. Eius pariatur iure eaque facere incidunt impedit totam voluptatem reiciendis expedita. Soluta rem architecto, ab doloribus reprehenderit possimus voluptatibus, eveniet delectus sequi excepturi cum commodi, deserunt dolores consequuntur perferendis quaerat quibusdam voluptate corporis adipisci veritatis pariatur assumenda obcaecati eaque? Cum voluptatibus eos, eum cumque quis vero! Incidunt deserunt, quam sed iste, nostrum iure vitae esse ea saepe obcaecati cumque quod alias laudantium suscipit soluta? Repellendus esse in, accusamus reiciendis rem eos quod nostrum excepturi culpa laboriosam obcaecati quis quam nulla aliquam. Consectetur perspiciatis est facilis ab laudantium voluptate architecto quo facere iste expedita soluta at, molestias assumenda. Excepturi velit non dicta repellendus nam enim repellat quaerat sunt! Maxime temporibus optio mollitia exercitationem culpa at error, laborum aliquid corrupti dolor soluta. Et officiis quia non, deleniti aut quidem quo eos, quisquam temporibus natus sint distinctio nulla dolor, nemo amet? Sit quam doloribus est sint. Mollitia voluptatum dolor impedit veniam autem aliquid similique odio voluptates libero! Voluptate esse hic dolorum aliquam quis impedit itaque cumque, corrupti ipsa qui veniam quam unde est reiciendis minus eius iure neque earum id tempore atque minima quas similique. Consectetur ullam alias necessitatibus quia maxime sapiente eaque molestias assumenda nihil autem, ab tenetur sed architecto nulla. Laudantium officiis unde aliquid veritatis est dolorum cum quidem. Eius obcaecati tenetur consequatur et quisquam eveniet, officia laborum neque, ratione voluptates laudantium nemo modi illum, dolorum ipsa! Temporibus explicabo aliquid, cumque eius iste hic veritatis! Distinctio, repudiandae! Culpa suscipit dolor minima natus quisquam consequatur doloribus. Possimus quibusdam quo veritatis unde nesciunt omnis debitis commodi atque maxime temporibus, dolores necessitatibus.', 'room-1.jpg', '1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13'),
(3, 1, 'Kos ABC', 'Putri', 'Dima dima se', 2, 1000000, 'Termasuk Listrik', '4x4', 1, 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias eaque tenetur totam possimus odit, corrupti veniam sed dolorum id excepturi reprehenderit ipsa animi ullam quam, nesciunt qui ducimus ut adipisci enim in. Incidunt dolores saepe ipsum harum quod iure natus laborum molestias delectus quae, doloremque alias consectetur expedita! Soluta distinctio fugit vitae, obcaecati assumenda animi, neque consequuntur non earum rem ea quas ratione error velit! Laboriosam neque deserunt sit ipsam commodi, quis voluptate cupiditate velit? Provident fuga aperiam mollitia quasi, dolore vel rerum, repellendus tempora alias sed cupiditate quod delectus ex vitae accusantium voluptatem nemo eius enim saepe. Esse, corporis.', 'room-2.jpg', '9, 16, 34, 38'),
(8, 5, 'Kos No Name', 'Putra', 'Dima dima hatiku suram', 5, 800000, 'Termasuk Listrik', '4x5', 1, 'cheuwfh  weiufh ewiufh uewh uwf huwe', '663c7f2323bb7.jpg', '1, 2, 3, 20, 11, 13, 32, 19, 30, 38, 42, 35, 36'),
(9, 5, 'Kos WAZ', 'Putra', 'eh rhr iir irv', 4, 300000, 'Tidak Termasuk Listrik', '3x3', 2, 'rh frihiruh irhv', '663af4e4563e2.jpg', '20, 15, 34');

-- --------------------------------------------------------

--
-- Table structure for table `penghuni_kos`
--

CREATE TABLE `penghuni_kos` (
  `id_penghuni` int(11) NOT NULL,
  `id_kos` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penghuni_kos`
--

INSERT INTO `penghuni_kos` (`id_penghuni`, `id_kos`, `id_user`) VALUES
(2, 3, 0),
(3, 3, 7),
(4, 1, 8),
(5, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `norekening` varchar(255) NOT NULL,
  `namabank` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`norekening`, `namabank`, `id_user`) VALUES
('0987654321', 'Bank CakIcak User 2', 5),
('1234567890', 'Bank Icakicak', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `namapengirim` varchar(255) NOT NULL,
  `emailpengirim` varchar(255) NOT NULL,
  `ulasan` text NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `namapengirim`, `emailpengirim`, `ulasan`, `status`) VALUES
(3, 'Rahasia', 'email@email.com', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Seen'),
(4, 'Ano', 'anonim@email.com', 'WOOWWWWWWWWWWWWWWWWWW', 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jeniskelamin` varchar(255) NOT NULL,
  `nohp` varchar(255) NOT NULL,
  `idcard` varchar(255) NOT NULL,
  `selfie` varchar(255) NOT NULL,
  `verif` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `namalengkap`, `email`, `password`, `jeniskelamin`, `nohp`, `idcard`, `selfie`, `verif`, `role`) VALUES
(1, 'Wita Az Zahrah', 'witaazz@gmail.com', 'dd5972131e8d99cf64f37912de36945c', 'Perempuan', '62895627609990', '663ad63a95df33.png', '663ad63a95df88.png', 'Telah Diverifikasi', 'Pemilik Kos'),
(4, 'TATATA', 'witaazz1@gmail.com', 'dfd88155fc25d8025550db1c425089da', 'Perempuan', '0895627609990', '6635f80a25309.png', '6635f80a2531d.png', 'Telah Diverifikasi', 'Pencari Kos'),
(5, 'WITA', 'witaazz2@gmail.com', '9757bb3cf28a5797e08ff7247bcc5ff0', 'Perempuan', '0895627609990', '663ad63a95df3.png', '663ad63a95df8.png', 'Telah Diverifikasi', 'Pemilik Kos'),
(6, 'Mancari kos', 'witaazz3@gmail.com', '9757bb3cf28a5797e08ff7247bcc5ff0', 'Laki-laki', '0895627609990', '663ae67967d9a.png', '663ae67967da0.png', 'Telah Diverifikasi', 'Pencari Kos'),
(7, 'NakKos', 'nakkos@gmail.com', 'd4148ee6c1e20b8e5c12916a22054d95', 'Laki-laki', '12345678', '663e050a3aa10.png', '663e050a3af92.png', 'Telah Diverifikasi', 'Pencari Kos'),
(8, 'Upiak', 'upiak@gmail.com', 'dffa9c5498af21592b566634d6ad2297', 'Perempuan', '089652345786', '663edf6a9690f.png', '663edf6a9750e.png', 'Telah Diverifikasi', 'Pencari Kos');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `gallery_kos`
--
ALTER TABLE `gallery_kos`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indexes for table `kos`
--
ALTER TABLE `kos`
  ADD PRIMARY KEY (`id_kos`);

--
-- Indexes for table `penghuni_kos`
--
ALTER TABLE `penghuni_kos`
  ADD PRIMARY KEY (`id_penghuni`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`norekening`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `gallery_kos`
--
ALTER TABLE `gallery_kos`
  MODIFY `id_gallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kos`
--
ALTER TABLE `kos`
  MODIFY `id_kos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `penghuni_kos`
--
ALTER TABLE `penghuni_kos`
  MODIFY `id_penghuni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
