-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Mar 2020 pada 03.10
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_soba`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `email` varchar(512) NOT NULL,
  `image` varchar(512) NOT NULL,
  `password` varchar(512) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `address` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`, `address`) VALUES
(4, 'admin', 'admin@gmail.com', 'foto_profile_admin.JPG', '$2y$10$v.towHmrtzWMVFtz1eEjDO57z2FGAJgPtfu9K8B/99GMtiI3GocRG', 1, 1, 1571230404, 'Denpasar'),
(18, 'ITB Stikom Bali', 'stikombali2019@gmail.com', 'logo-baru.png', '$2y$10$v.towHmrtzWMVFtz1eEjDO57z2FGAJgPtfu9K8B/99GMtiI3GocRG', 2, 1, 1572142963, 'Renon, Denpasar, Bali'),
(33, 'Satria Megaartha', 'satriamega14@gmail.com', 'default.png', '$2y$10$XTB2H4brRwO4YhzgUEAFZ.LFQNXmGl/W5s9lyRRBujOntLat8xU1e', 3, 1, 1575201926, 'Renon, Denpasar'),
(68, 'Universitas Mahasaraswati', 'mahasaraswati2019@gmail.com', 'Logo-Unmas.png', '$2y$10$Y539gZHH5NuacRRvsi9/QeGoxVPk3Gxj708x5NCcRmy2SHigoO5d2', 2, 1, 1576660245, 'Jl. Kamboja No.11 A Denpasar, Telp.'),
(69, 'Universitas Pendidikan Ganesha', 'undiksha2019@gmail.com', 'logo.png', '$2y$10$9flDLIh46oM9h7oeEcFFj.PYcGC90mLoDflVTSREhfsVLwtWFbZN.', 2, 1, 1576676472, 'Singaraja, Bali, Indonesia.'),
(70, 'Universitas Udayana', 'univudayana19@gmail.com', 'logo-unud-2018.png', '$2y$10$Y539gZHH5NuacRRvsi9/QeGoxVPk3Gxj708x5NCcRmy2SHigoO5d2', 2, 1, 1576717044, 'Jalan P.B. Sudirman, Dangin Puri Klod, Kec. Denpasar Bar., Kota Denpasar, Bali'),
(71, 'Politeknik Negeri Bali', 'poltekbali19@gmail.com', 'logopnb.jpg', '$2y$10$h1nlrEu6O8FKKGhzUzP8fOfmhqrpS0aMVfa2nBKrclD4PTRVy8TeO', 2, 1, 1576717973, 'Bukit Jimbaran, Kuta Selatan, Badung - Bali'),
(77, 'Universitas Warmadewa', 'univwarmadewa19@gmail.com', 'standar_logo_warmadewa.jpg', '$2y$10$3vuPt4tRCUH1/2AYD.CPK.W.hVLyLsRutVf/StgMmU1kuEFI7MHnC', 2, 1, 1577242550, 'Jl. Terompong 24 Tanjung Bungkak Denpasar Bali, Indonesia'),
(78, 'Satria Megaartha', 'satriamegaartha@gmail.com', 'default.png', '$2y$10$kK6pb6PkgwwMfH2fRe.fl.ALCZ2sFVqMl7OvK46IesUSViBjnvI3C', 3, 1, 1577244450, 'Renon, Denpasar'),
(79, 'I Made Putra Dharma Wiguna', 'dekutha10@yahoo.com', 'default.png', '$2y$10$QQzCTMPT6E1mPCa1vRIH5uaGco52YQ5lL3m0EGvkfy20UaXCJQe8y', 3, 1, 1577246474, 'Jl. Tirta Lepang II Huma River E. Blok B6 Kesiman Kertalangu'),
(80, 'Septi', 'septiyogi98@gmail.com', 'default.png', '$2y$10$sqz4tEdViibXwmHRiKXXK.yhC.FhFtRhCxPOK0GaY6I/Onv67ynyq', 3, 1, 1577247104, 'Septiasri'),
(81, 'Kadek andriyan', 'Kandriyan80@gmail.com', 'default.png', '$2y$10$MI5k4ih87I9qBYoS90xARuQtB.PIuWxCvrOCowBDYPmsjq5HGd3Iy', 3, 1, 1577247876, 'Jl.raya kedewatan, ubud'),
(82, 'Celvin', 'chelvinrizky@gmail.com', 'default.png', '$2y$10$/FJ5GCueb.YkiC53O8PT1.pub3qKeSilB/fbfIQzhYyLyMulvYc4K', 2, 1, 1577248941, 'Rizky'),
(83, 'Erawati', 'srierawati97@gmail.com', 'default.png', '$2y$10$f2XL9R8yFIOjDkeOkD9rmutnwB.g4CBcEy4VddczkJfdJ9b2GmCmG', 0, 1, 1577252727, 'Jalan selar tunjung gang XIII no 8, Denpasar'),
(84, 'Krisma', '2krismaputra@gmail.com', 'default.png', '$2y$10$H5Y8fvDUpdD/89vYnmoyh.uADxOrP./mmYVezOoF.GinrdfaKjfjG', 3, 1, 1577253872, 'Jln nangka'),
(85, 'Wulan Purnamasari', 'Wulanpurnamasari0312@gmail.com', 'default.png', '$2y$10$4ICrxqjGlQ2KLpaLeSL6ZudG8T/gy3qfLAkxVajq97eFzgvmphiaC', 3, 1, 1577254252, 'Perum Dalung Permai'),
(86, 'Tasia Ardia', 'tasiaardiaa@gmail.com', 'default.png', '$2y$10$QkbUngG33h./zpxjWmVELOQegXqYDLt.6xG0y7PkeiiIZxzWQoWBC', 3, 1, 1577271262, 'Jl Manggis I No 12 Gianyar'),
(87, 'april', 'apriliajr08@gmail.com', 'default.png', '$2y$10$C5zgerSpkK3YFzjZQl9OGu0G1xZjm8R9ifRvT8i8ewAJoiolGEYDi', 0, 1, 1577285817, 'lia'),
(88, 'Ni Kadek Pajar Kusumawati', 'pajarkusumawati23@gmail.com', 'default.png', '$2y$10$i4ehrIvbk2yEHHQe8G4NduxP0RhZku5Tk7tFXd88kbka4CdCl0o6G', 3, 1, 1577321933, 'Jl. Cekomaria Gg. Pleno No. 11 Denpasar'),
(89, 'ELISABETH YUNILAN', 'eeth.yun@yahoo.com', 'default.png', '$2y$10$IuSrUAKEhAoKWs6Okdu3ZuprZEOEniJaVqJW0cgqUmvW8K4gb1DLu', 3, 1, 1577334908, 'jalan sudirman'),
(90, 'Marcello Imanuel Mariano Serowero', 'marcelloimanuel25@gmail.com', 'default.png', '$2y$10$cb40ej9tq4o1/9cPeOX7xuYAOnUtZEi69OSHgOjr4EPHNi/Mfu2jG', 0, 1, 1577340579, 'BTN. Taman Sari Blok E/1'),
(91, 'Belli', 'Bellilorghini123@gmail.com', 'default.png', '$2y$10$Ff8vkGmBw5aaKeTR3S4euOtTaHaAEC6cYJzGTc7dNMgB.JlHQgbw.', 0, 1, 1577358925, 'Bellilorghini123@gmail.com'),
(92, 'Dwi Surya Wardana', 'dwisuryawardana@gmail.com', 'default.png', '$2y$10$HZ.eM9MMUaGLTsIDgtfTDeZieLkcx2BVi/wG.ETH9XU86SKwJZ35S', 2, 1, 1577364996, 'Jalan Teratai, Lingkungan Pasdalem, Gianyar'),
(93, 'Budi Gunawan', 'budigunawan9998@gmail.com', 'default.png', '$2y$10$U0GWw945fCBZj.Dj7FM9Qud0xSN8LIeCi9mQkcdWJJSt1kGRGelvG', 3, 1, 1577371891, 'Denpasar'),
(94, 'Candra Purnama', 'candrapurnama1900@gmail.com', 'default.png', '$2y$10$HCd2HuR/J64STsp9mmTfJOofYo6J3/bDCZSImAleZHs6dzUzF2g8e', 3, 1, 1577371959, 'Badung'),
(95, 'Aprilia Rahma', 'raprilia019@gmail.com', 'default.png', '$2y$10$67WSC4JfXRw1m7oVDF31jO89mt5eXzPqFSgRApQIlyqvaJlTCYYKq', 3, 1, 1577372054, 'Denpasar'),
(96, 'ni putu novy diantari', 'niptndiantari@gmail.com', 'default.png', '$2y$10$M.GNWPEEjOLFgwmx2o4jp.mFClGG4i7Jk8tsENVUDRSs8I1nUEOeu', 3, 1, 1577372109, 'gianyar'),
(97, 'Dafid Wijaya', 'dafidwijaya96@gmail.com', 'default.png', '$2y$10$XOcc18N28nWAGKRQ5I0YL.Ckvd3Sv4icFL8b59mDzpdfoyZHdQv.K', 3, 1, 1577372238, 'Denpasar, Bali'),
(98, 'Dinda Maharani', 'dindamaha71@gmail.com', 'default.png', '$2y$10$IqBYkKnP7MGURffeTlZ0JO9ud0HmqUm7IYvcnVjK2Hq2tfrBXZ7xO', 0, 1, 1577372357, 'Denpasar, Bali'),
(99, 'Dian Pitaloka', 'pitalokadian28@gmail.con', 'default.png', '$2y$10$0v45Qc359IBB4m2ShoLV7OfUTojlpjYv21yPiT6q9tKDQo11BQ7pG', 3, 1, 1577372462, 'Gianyar'),
(100, 'Patra Adelia', 'patradelia@gmail.com', 'default.png', '$2y$10$LFxOE51iJJmFXwH7Muar6.OuKlKT40ev7PWExL4APQtPkWx/pAaV6', 3, 1, 1577372516, 'Denpasar'),
(101, 'I Gusti Agung Ngurah Bayu Iswara', 'iswarabayu95@gmail.com', 'default.png', '$2y$10$p2CkF4RdHoKiLJgoD2Ll0.AlbkwrhF0kDl4PVyIGPDKaR.2zhO6Uy', 3, 1, 1577419117, 'BR. Bantas Kaja, Desa Sibanggede'),
(138, 'Vendor Testing', 'satriacoding14@gmail.com', 'FOTO_USER.jpg', '$2y$10$l4WgRcMZxVXeAeMPclVEvOKI.6lMbgFJ/OtjdSfsFwymVXI7NSPOm', 2, 1, 1584274532, 'Renon, Denpasar'),
(139, 'Member Test', 'soberkid14@gmail.com', 'default.png', '$2y$10$A0t1wJ67ebCFz9DgitdtyO.c2NY.utzxcNlL/3SgPFhoYm2khYaZO', 3, 1, 1584274979, 'Renon, Denpasar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(9, 1, 2),
(10, 1, 3),
(11, 2, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_broadcast`
--

CREATE TABLE `user_broadcast` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_broadcast`
--

INSERT INTO `user_broadcast` (`id`, `vendor_id`, `date_created`, `count`) VALUES
(23, 18, '2019-12-01', 2),
(53, 18, '2019-12-02', 2),
(54, 18, '2019-12-03', 3),
(55, 18, '2019-12-04', 1),
(56, 18, '2019-12-07', 2),
(67, 68, '2019-11-23', 1),
(68, 68, '2019-12-04', 1),
(82, 18, '2020-01-01', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_event`
--

CREATE TABLE `user_event` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(512) NOT NULL,
  `name` varchar(512) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `venue` varchar(512) NOT NULL,
  `htm` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(512) NOT NULL,
  `date_created` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `subscribed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_event`
--

INSERT INTO `user_event` (`id`, `user_id`, `user_name`, `name`, `date_start`, `date_end`, `venue`, `htm`, `description`, `image`, `date_created`, `is_active`, `subscribed`) VALUES
(54, 18, 'ITB Stikom Bali', 'Delusi #4', '2019-12-14', '2019-12-14', 'Lapangan Pantai Matahari Terbit', 35000, 'DELUSI #4 Strength of Solidarity\r\nSaturday, 14 December 2019\r\n\r\nSpecial Performance:\r\nNavicula\r\nKaset Kulcha\r\nDesire\r\nThe Catrolls\r\nMatilda\r\nDance of Stikom\r\nKacak Kicak Puppet Theatre\r\nand many more\r\n\r\n4 SKKM Wajib Mahasiswa ITB Stikom Bali\r\nPresale : Rp. 30.000\r\nOTS      : Rp. 35.000\r\n\r\nContact Person:\r\nAdhi Pidada 082247247990\r\nAri Kresna 0895615241227\r\nIG : @delusi_official\r\n\r\nPowered by SBMC', 'eventormawastikombali_79830585_753349015143554_4989362375773760995_n.jpg', 1576654940, 1, 12),
(57, 68, 'Universitas Mahasaraswati Denpasar', 'Versa Dentistry 33rd', '2019-12-23', '2019-12-23', 'JA’AN Bali Restaurant', 150000, 'BEM FKG UNMAS DENPASAR\r\n\r\nThe long wait finally over, now the soul is free to find it’s fondness.\r\nThrough marvellous journey, We gladly present you\r\n\r\nVersa Dentistry 33rd\r\n“Magically Love of Rendezvous”\r\n\r\nBrace yourself for an enduring experience in your prettiest memories and to witness performances that will bring you to heaven\r\n\r\nWill be held on\r\n23rd December 2019\r\nJA’AN Bali Restaurant\r\nOpen Gate 18.00 Wita\r\n\r\nJaw-Dropping Performances by\r\nThe Overtunes\r\nAlien Child\r\nPsycoplo\r\n\r\nAlso Special Performences\r\nVOD Band\r\nPulpa Band\r\nManisgula Band\r\nKencur Band\r\nDentistry Dance Crew\r\nDentistry Model\r\n\r\nFor more information contact our social media\r\nInstagram : @versadentistry\r\n\r\nFor purchasing tickets contact\r\nline : krisnadityad/082145569769\r\nline : manik9999/085969014558\r\n\r\nSave the date, mark your calendar and bring your plus one cuz “together we can go far as long as I\'m with you”\r\nSee You', 'versa_dentistry.jpg', 1576661574, 1, 8),
(58, 68, 'Universitas Mahasaraswati Denpasar', 'ENGLISH DRAMA FIESTA 2020', '2020-01-04', '2020-01-04', 'Widyasabha Hall', 25000, 'Mahasaraswati Denpasar University, Faculty of Teacher Training and Education,English Language Education Study Program\r\nProudly present,\r\nENGLISH DRAMA FIESTA 2020\r\nDate: 4th January 2020\r\nAt: 9AM-3PM\r\nVenue: Widyasabha Hall\r\nSoka Street No. 47, Denpasar\r\n\r\nThere will be 6 plays:\r\n• Men Tiwas & Men Sugih\r\n• Noesa Penida\r\n• Cupak & Gerantang\r\n• Sampek & Engtay\r\n• Barong Landung\r\n• Men Bekung', 'hmpsbahasainggrisunmas_75440985_584629295653632_5083837951821915120_n.jpg', 1576661737, 1, 5),
(59, 18, 'ITB Stikom Bali', 'OTAK ANTIQUE #3', '2020-02-01', '2020-02-01', 'AREA PARKIR ITB STIKOM BALI', 35000, 'UNIT KEGIATAN MAHASISWA\r\nPASUKAN KEAMANAN ACARA STIKOM BALI\r\n\r\nPROUDLY PRESENT\r\n\r\nOTAK ANTIQUE #3\r\n- - - - - - - - - - - - - - - - - - - - - - -\r\n\r\nBACK TO CLASSIC\r\n- - - - - - - - - - - - - - - - - - - - - - -\r\nCLASSIC BIKE SHOW\r\nDANCE PERFORMANCE\r\nLIVE MUSIC\r\nFOOD COURT\r\nCOMMUNITY\r\n- - - - - - - - - - - - - - - - - - - - - - -\r\n\r\n1 FEBRUARI 2020\r\n16:00 WITA - END\r\nAREA PARKIR ITB STIKOM BALI\r\n- - - - - - - - - - - - - - - - - - - - - - -\r\n\r\nTICKET 35.000\r\nSTAND AT LOBBY ITB STIKOM BALI\r\n- - - - - - - - - - - - - - - - - - - - - - -\r\n\r\nFREE 2 + 2 SKKM\r\n- - - - - - - - - - - - - - - - - - - - - - -\r\nFOR MORE INFO :\r\n0813 - 3922 - 7138 (KETUA PANITIA)\r\n0822 - 3508 - 8920 (WAKIL KETUA)\r\n0813 - 3763 - 5311 (KESEKRETARIATAN)', 'otak_antique.jpg', 1576662242, 1, 5),
(60, 69, 'Universitas Pendidikan Ganesha', 'Cakra HUT 2019 FIP Undiksha', '2019-12-22', '2019-12-22', 'Lapangan Sepak Bola Kampus Tengah Undiksha', 50000, 'Om Swastyastu\r\nSalam Harmoni \r\n\r\nHallo gaesss, Kali ini FIP Undiksha merayakan Hari Ulang Tahunnya yang ke-57 yang dikemas dalam acara \"Cakra HUT 2019 FIP Undiksha\"\r\n\r\nMempersembahkan Guest Star Nasional dan Artis Bali :\r\nJazz\r\nDiUbud Band\r\nTika Pagraky feat Rocktober\r\n\r\n\r\nTicket\r\nPresale : 35K\r\nOTS : 50k\r\n\r\nCatat Tanggal, Waktu, dan Tempatnyaaa gaesss ????????????\r\nMinggu, 22 Desember 2019\r\n18.00-Selesai\r\nLapangan Sepak Bola Kampus Tengah Undiksha\r\n\r\nCelebrate your momment with Us\r\n\r\nPemesanan tiket dan Info Lebih Lanjut, Hubungi kontak dibawah ini\r\nVera (087762858432)\r\nAyu Srikawati (085967248738)', 'cakra_hut.jpg', 1576676852, 1, 6),
(61, 70, 'Universitas Udayana', 'Udayana Berbudaya 2019', '2019-12-20', '2019-12-20', 'Aula Student Center Lt. 4 Jl. Dr. Goris No.10 Kampus Unud Sudirman', 0, '[Udayana Berbudaya 2019]\r\n\r\nHalo Ksatria Muda Udayana!\r\nHalo sahabat berbudaya!\r\n\r\nBEM PM Universitas Udayana Proudly Present\r\nUdayana Berbudaya 2019 yang bertemakan \"Bali be Autentic\" Ngajegang Bali Mawit Revitalisasi Budaya.\r\nDikemas dalam bentuk Talkshow Kebudayaan dan turut menghadirkan pembicara-pembicara yang luar biasa.\r\n\r\nDiselenggarakan pada:\r\nHari, tanggal: Jumat, 20 Desember 2019\r\nWaktu: 18.00 WITA - selesai\r\nTempat: Aula Student Center Lt. 4 Jl. Dr. Goris No.10 Kampus Unud Sudirman\r\n\r\nFREE ENTRY!!!\r\nKUOTA TERBATAS!!!\r\nInclude : SKP & snack\r\n\r\nPendaftaran dibuka 10-17 Desember 2019. Jadi tunggu apa lagi? Yuk! Buruan daftar melalui link berikut :\r\nhttp://bit.ly/UdayanaBerbudaya2019\r\n\r\nSetelah mendaftar pada link diatas, segera konfirmasi ke CP dibawah ini ya!\r\nContact Person:\r\nGek ti : 083117205961/ id line: agungdamayanti_\r\nFrity : 081916844958/ id line: frityy\r\n\r\nSampai jumpa di Udayana Berbudaya!\r\n\r\n#UdayanaBerbudaya2019\r\n\r\nKementerian Kebudayaan\r\nBEM PM Universitas Udayana Kabinet Suacita Udayana\r\n========================\r\n\"Gotong Royong Suakan Cita Udayana, Mengabdi Untuk Indonesia\"', 'udayana_berbidaya.jpg', 1576717265, 1, 4),
(62, 70, 'Universitas Udayana', 'MALAM PUNCAK WORLD AIDS', '2019-12-22', '2019-12-22', 'TVRI Renon, Bali', 90000, 'Kelompok Mahasiswa Peduli AIDS (KMPA)\r\nFakultas Kedokteran Universitas Udayana proudly present:\r\nMALAM PUNCAK WORLD AIDS DAY\r\n\r\nSave the date on : Sunday, 22 December 2019 \r\nAt: 4pm - end\r\nVenue: TVRI Renon, Bali\r\nFeel the euphoria with the guest star :\r\nNADIN AMIZAH @cakecaine\r\nNOSSTRESS @nosstressbali\r\nTicket price: 90k\r\n\r\nFor more information:\r\nsathyav26 / 082247489140\r\nrenabudhiarta / 081938383935', 'world_aids_day.jpg', 1577241904, 1, 9),
(63, 77, 'Universitas Warmadewa', 'GRAFIS Tahun 2019', '2019-12-20', '2019-12-20', 'Lapangan Kapten Japa,Kesiman Kertalangu,Denpasar', 25000, 'BADAN EKSEKUTIF MAHASISWA\r\nFAKULTAS ILMU SOSIAL DAN ILMU POLITIK\r\nUNIVERSITAS WARMADEWA\r\n\r\nProudly Present:\r\n\r\nGRAFIS (Gelar Kreativitas Mahasiswa FISIP) Tahun 2019\r\n\r\nDimeriahkan oleh:\r\n*Joni Agung & Double T\r\n*Kroncong Jancuk\r\n*Imagine Rainbow\r\n*Everlasthinx\r\n*Shankar\r\n*Nightmare on stage\r\n*Filth of Drama\r\n*Remember Your Holiday\r\n\r\nHari: Jumat,20 Desember 2019\r\nWaktu: 17.00 - End\r\nVenue: Lapangan Kapten Japa,Kesiman Kertalangu,Denpasar.\r\n\r\nHTM\r\nPresale:20K\r\nOTS:25K\r\n\r\nBagi kalian yang memiliki usaha dibidang apapun dan ingin mensupport acara GRAFIS 2019 bisa menghubungi CP yang sudah tertera diatas,terima kasih.\r\n\r\nDon\'t miss it', 'konserbali_75371310_492274464733383_2638624422533966835_n.jpg', 1577242921, 1, 3),
(65, 68, 'Universitas Mahasaraswati', 'GALENICA FESTIVAL 2020', '2020-02-25', '2020-02-25', 'Lapangan SLUB , Jalan Kamboja No.11 A, Denpasar', 100000, '[ GALENICA FESTIVAL 2020 ]\r\n\r\nBEM FAKULTAS FARMASI UNIVERSITAS MAHASARASWATI DENPASAR PROUDLY PRESENT GALENICA FESTIVAL 2020\r\n\r\nGabut di rumah tapi bingung mau kemana? Kuy join ke acara GALENICA FESTIVAL 2020 \r\n~~~\r\nLokasi :  Lapangan SLUB , Jalan Kamboja No.11 A, Denpasar\r\nHari dan tanggal : Selasa, 25 Februari 2020\r\nWaktu :  18.00 wita - selesai\r\n~~~\r\nGuest star utama \r\n1. Fourtwnty\r\n2. Kaset Kulcha\r\n\r\nEitss ga cuma guest star yang kece kece diatas tapi juga ada band lainnya dan food court yang makanannya pasti bikin ngiler \r\n~~\r\nBuat kalian yang pengen jadi partner sponsor kami bisa banget niihh.. langsung aja hubungi Dwi Novitasari : 081916059235 \r\nJadi tunggu apalagi yuk siapkan diri kalian untuk datang ke GALENICA FESTIVAL 2020 \r\n\r\nHarga tiket\r\nTiket : 80k\r\nOTS : 100k\r\n\r\nInformasi tiket\r\nGungram :  083114396767\r\n\r\n\r\nSEE YOU THERE \r\n#GalenicaFestival2020\r\n#FakultasFarmasiUnmas\r\n#TabulaRasa', 'galenica.jpg', 1580738379, 1, 0),
(71, 138, 'Vendor Testing', 'Event Test', '2020-03-28', '2020-03-28', 'Kampus ITB Stikom Bali', 50000, 'lorem', 'FOTO_EVENT3.jpg', 1584274932, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(4, 'Event');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Vendor'),
(3, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_subscribe`
--

CREATE TABLE `user_subscribe` (
  `sub_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_subscribe`
--

INSERT INTO `user_subscribe` (`sub_id`, `id`, `vendor_id`, `event_id`) VALUES
(16, 33, 68, 57),
(20, 33, 68, 58),
(21, 33, 18, 54),
(22, 33, 69, 60),
(23, 33, 70, 61),
(24, 33, 77, 63),
(25, 33, 70, 62),
(26, 78, 18, 54),
(27, 79, 18, 54),
(28, 79, 68, 57),
(29, 80, 18, 54),
(30, 81, 81, 18),
(31, 83, 18, 54),
(32, 84, 68, 58),
(33, 84, 84, 70),
(34, 84, 84, 77),
(35, 85, 18, 54),
(36, 33, 33, 18),
(37, 33, 18, 59),
(38, 86, 18, 54),
(39, 86, 68, 57),
(40, 86, 70, 62),
(41, 88, 18, 54),
(42, 88, 68, 57),
(43, 88, 68, 58),
(44, 88, 70, 62),
(45, 88, 18, 59),
(46, 88, 69, 60),
(47, 88, 70, 61),
(48, 88, 77, 63),
(49, 89, 18, 54),
(50, 89, 68, 57),
(51, 89, 70, 62),
(52, 89, 70, 61),
(53, 90, 90, 18),
(55, 91, 91, 18),
(56, 91, 18, 54),
(57, 91, 70, 62),
(58, 91, 68, 57),
(59, 91, 69, 60),
(60, 93, 18, 54),
(61, 93, 70, 61),
(62, 94, 70, 62),
(63, 94, 68, 57),
(64, 95, 70, 62),
(65, 95, 68, 57),
(66, 96, 18, 54),
(67, 96, 68, 58),
(68, 96, 69, 60),
(69, 97, 77, 63),
(70, 97, 18, 59),
(71, 98, 70, 62),
(72, 98, 18, 59),
(73, 99, 70, 62),
(74, 99, 18, 59),
(75, 99, 69, 60),
(76, 100, 69, 60),
(77, 100, 68, 58),
(103, 139, 138, 71);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `url` varchar(512) NOT NULL,
  `icon` varchar(512) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin/index', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user/index', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(11, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(12, 4, 'Dashboard Event', 'user/dashboard', 'fas fa-fw fa-calendar-check', 1),
(13, 4, 'Event Management', 'user/eventmanagement', 'fas fa-fw fa-calendar-plus', 1),
(15, 1, 'User Management', 'admin/usermanagement', 'fas fa-fw fa-id-card-alt', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(512) NOT NULL,
  `token` varchar(512) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(2, 'test@gmail.com', 'blngzOyjWdTwXbvtjscWiZKFGYlQ+3fK', 1572164484),
(3, 'test@gmail.com', 'IKMr36rUtlmbI1jl5jhYGjTZCNGwKqzx', 1572164577),
(4, 'test@gmail.com', 'dWZ+4wpBk5jYMt8vo1Z4goL3k66pupee', 1572164861),
(5, 'tesa@gmail.com', 'LuwCCHFzzohcBFCDT99xDaRBxSRSl1bR', 1572164880),
(6, 'admin111@gmail.com', 'uB7csYNs2CeF1CeHxcVHd7i5zXkUg/UQ', 1572436042),
(7, 'member@gmail.com', 'SVQe9J+XgZue0h3z+/CgP1IrXG+L2yoq', 1572438121),
(8, 'member@gmail.com', 'GPTv/ueCg9/l12jCcjHFQUNGEXd2aK3T', 1572488459),
(9, 'membertest@gmail.com', '6SfDezymIbqzquZhBBDctLptBrZfcJBI', 1572667626),
(10, 'membertest@gmail.com', 'ivJzTEVtZOFpTawCPkI9WT8iIZvwxkE/', 1572667650),
(11, 'membertest@gmail.com', 'IYm1zVshOwcNfE1n3v6X1aOVhq4h/dx1', 1572667718),
(12, 'vendor1@gmail.com', 'xEBFUvm/CnCDzl55Rptlrm4Q9N0JDUDe', 1573730041),
(21, 'vendor2@gmail.com', 'cSXl9UwPEeR/TNYcE7GejHHoj/UNYdc+', 1575335705),
(22, 'komangrinartha@gmail.com', 'oF8wEd/xAiMBitX49tiFIF7OJMnYIlw5', 1575708675),
(23, 'komangrinartha@gmail.com', 'qQnD51yfrs2vSNUzlpYlGUj6rEjzIfAJ', 1575363188),
(24, 'komangrinartha@gmail.com', '43lkX5EcIlvAUp/+5s+zzKj4eq+MK5uJ', 1575363285),
(25, 'member2@gmail.com', 'NVKnEP0ZAYc4YODsjdhvU8HGe0wFnSO9', 1575712763),
(56, 'unmas@gmail.com', 'oRRr7Ps68kLeG1b1kHxOzuZL80Ce290L', 1576660245),
(57, 'undiksha@gmail.com', 'a/jaV8rppqELqd6SVuwX+EGp49KTIeag', 1576676472),
(58, 'unud@gmail.com', '4cYX94af+ALOjfZsNs1OdGfPsoYkH7cX', 1576717044),
(59, 'pnbali@gmail.com', 'IDRGZnld+yXiVqjmaAhaACGuwHRB0Wua', 1576717973),
(65, 'univwarmadewa19@gmail.com', 'L9zkE3YXHw6d3jIQxdHb6bDVwKp1KJqT', 1577242550),
(66, 'satriamegaartha@gmail.com', 'hFkoWasB2UKtjcyo30EsgFICo0v1nBCH', 1577244450),
(67, 'dekutha10@yahoo.com', 'zfS3N10VmtVB7fPy2KWSSszBPTHVn5Eg', 1577246474),
(68, 'septiyogi98@gmail.com', 'to/iwAnMz+4MpMkNUNgMc6ouzaEpxK9S', 1577247104),
(69, 'Kandriyan80@gmail.com', 'NmmwT+dzgW3A7emMz2YPA1uCr5q+QU4W', 1577247876),
(70, 'chelvinrizky@gmail.com', 'QrQk/5bqx4AiY98QkqejCijnzTJAFZQY', 1577248941),
(71, 'srierawati97@gmail.com', 'iK2+lCD+Cp35rpYrY9DlKYaOwYopfV8N', 1577252727),
(72, '2krismaputra@gmail.com', 'FvbmB5TcYS1T2HHFQG85zo1lY9wKYFGa', 1577253872),
(73, 'Wulanpurnamasari0312@gmail.com', 'bcAmp3YAIi8759FQAK1j0GFcA4YP0kzT', 1577254252),
(74, 'tasiaardiaa@gmail.com', 'avcqaKSC6e61iUWX33ZEYkousS8tGVeo', 1577271262),
(75, 'apriliajr08@gmail.com', 'LPhlAdWPtWfkNsn5KnkHGy5FtcW5qN8b', 1577285817),
(76, 'pajarkusumawati23@gmail.com', 'qXfLQ5Ga7KmzxxlBRaCAzY85RCxwFGn1', 1577321933),
(77, 'eeth.yun@yahoo.com', '8zgjMA+snMib21XlHoI2YCCsZDEuGrJG', 1577334908),
(78, 'marcelloimanuel25@gmail.com', 'VcFuFLgMT4E+cSyraBd4XXpTSfde5eca', 1577340579),
(79, 'Bellilorghini123@gmail.com', 'r8aT7yIbHBAe6oYaw4hhDrwzRYEfybYy', 1577358925),
(80, 'dwisuryawardana@gmail.com', 'hHmxTWDuqL/+jBrlhLvNocuMDoAwFGsZ', 1577364996),
(81, 'budigunawan9998@gmail.com', '2XCKZFCohBt5s1XEk5fCr/xE3NszrWJ7', 1577371891),
(82, 'candrapurnama1900@gmail.com', 'RyJfQXB++AeixdPlAi8P31QcLTRFdBFD', 1577371959),
(83, 'raprilia019@gmail.com', 'Scyq7maY7GFP2fUyVkfo1YgttH4JgPEO', 1577372054),
(84, 'niptndiantari@gmail.com', 'XOsLIVapGy/HwmtFKFzHlygyfNCUEk11', 1577372109),
(85, 'dafidwijaya96@gmail.com', '1hqojt5hg7498oUZpCSGIP4/dPlhvpdr', 1577372238),
(86, 'dindamaha71@gmail.com', 'Z/sCG6/6k7TXZJpbXtoZliET3mnV7w/4', 1577372357),
(87, 'pitalokadian28@gmail.con', 'cQsfRwmratgCxqgXk6nkPP5KyP8Dll7l', 1577372462),
(88, 'patradelia@gmail.com', 'eP11IoA1Ggox23J0UFHgG4wrjPPT9+qX', 1577372516),
(89, 'iswarabayu95@gmail.com', 'jOarNz7eDM9efqnGB4fSS/Z52mLlLFg6', 1577419117),
(122, 'satriacoding14@gmail.com', 'vY7mmdTuu50lEfsIh5KXd51PSSdbHSiI', 1580891227),
(123, 'satriacoding14@gmail.com', 'OF+TBW+krNPjidnbmU6HKOX+ccRd8kcf', 1584273455),
(124, 'satriacoding14@gmail.com', 'iz+G4Xa6lXaVOBNyeKOioPeW3R9OqEhd', 1584273569),
(125, 'satriacoding14@gmail.com', '7Xtfj+NLYCUzzgXvuwHMkBkjqslyEE9I', 1584274316),
(126, 'satriacoding14@gmail.com', 'MFzBgDj3eYi0zpfz06upKIWLxjMXwjmm', 1584274532),
(127, 'soberkid14@gmail.com', 'gFMbQF9owmW37ESU4PlNoHvKEoVCVWBI', 1584274979);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_broadcast`
--
ALTER TABLE `user_broadcast`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_event`
--
ALTER TABLE `user_event`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_subscribe`
--
ALTER TABLE `user_subscribe`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_broadcast`
--
ALTER TABLE `user_broadcast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `user_event`
--
ALTER TABLE `user_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_subscribe`
--
ALTER TABLE `user_subscribe`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
