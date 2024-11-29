

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO admin VALUES("1","admin","$2y$10$AIy0X1Ep6alaHDTofiChGeqq7k/d1Kc8vKQf1JZo0mKrzkkj6M626");



CREATE TABLE `bom_produk` (
  `kode_bom` varchar(100) NOT NULL,
  `kode_bk` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `kebutuhan` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;




CREATE TABLE `customer` (
  `kode_customer` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telp` varchar(200) NOT NULL,
  PRIMARY KEY (`kode_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO customer VALUES("C0002","Rafi Akbar","a.rafy@gmail.com","rafi","$2y$10$/UjGYbisTPJhr8MgmT37qOXo1o/HJn3dhafPoSYbOlSN1E7olHIb.","0856748564");
INSERT INTO customer VALUES("C0003","holi","izuddinkhubi@gmail.com","holi","$2y$10$PYm57GT4NRw5BwElvUrmfu6xR9KB2xIWp8OqgLJ1iih4eSxDYBawG","2323");
INSERT INTO customer VALUES("C0004","Kain","izuddinkhubi@gmail.com","kain","$2y$10$0mJr/adDSREVRt23iBYkfe4mspCHeZBpCq9hL8MXw567fJd.FCZsi","12344");
INSERT INTO customer VALUES("C0005","Kusuma","izuddinkhubi@gmail.com","kusuma","$2y$10$q9LiONu7RQSgAJJSFfTedOrmiHUMbMTaTi04sfvOSA1omsRhHULjK","7878787");
INSERT INTO customer VALUES("C0006","Rafi","Rafy@gmail.com","rafymrx","$2y$10$dOlBFaimo9eDptB/cpvU1.8qWN2MmMK5DDZacbZgKAxwEHb5LWbtm","087804616097");
INSERT INTO customer VALUES("C0007","Farid Nurdiansyah","xiomi@gmail.com","FaridN","$2y$10$pd9HK0cBRAKTRqsPfZd3eeiU/i52XbuWtRBkV2p/mZuqXoAUUDycK","089513873079");
INSERT INTO customer VALUES("C0008","FaridNurd","xiooomi@gmail.com","Farid123","$2y$10$ZrUPdEAZ9wwzEounDeFh/OQdinB1zxFDLbZwbbkjyBXcqeY45nNnO","0098765434567");



CREATE TABLE `inventory` (
  `kode_bk` varchar(100) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `satuan` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`kode_bk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO inventory VALUES("M0001","Kain","96","Kodi","8000","2020-10-05");
INSERT INTO inventory VALUES("M0002","Pewarna","500","ml","200","2020-10-04");



CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_customer` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` varchar(200) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  PRIMARY KEY (`id_keranjang`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4;

INSERT INTO keranjang VALUES("75","C0007","P0001","Mega Mendung","1","0","500","m");
INSERT INTO keranjang VALUES("76","C0007","P0004","Batik Al barokah","1","0","500","xl");
INSERT INTO keranjang VALUES("77","C0007","P0004","Batik Al barokah","1","0","500","l");



CREATE TABLE `produk` (
  `kode_produk` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` varchar(255) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `berat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO produk VALUES("P0001","Mega Mendung","5f8271f209bee.jpg","				Mega Mendung
												","50000","m,l","500");
INSERT INTO produk VALUES("P0002","Batik Sarimbit ","5f83a163d58a7.jpg","Batik Sarimbit dengan motif bagus
			","15000,18000,20000,30000,50000","s,m,l,xl,xxl","100");
INSERT INTO produk VALUES("P0003","Batik Sarimbit Kuning","5f83a1b5616e3.jpg","Batik sarimbit kuning dengan motif bagus
			","20000,30000,50000","s,l,m","100");
INSERT INTO produk VALUES("P0004","Batik Al barokah","6688d1c191b4d.jpg","Material : Katun 40s
Model : Slimfit & Tanpa Furing
Size Pada Model : Tinggi 180 cm, Berat 72 kg, Menggunakan Ukuran XL.

Catatan: Motif pada satu produk dan lainnya dapat sedikit berbeda.

Size Chart :
Lingkar Dada (cm) x Panjang Kemeja (cm):
M: 96 cm x 70 cm
L: 102 cm x 72 cm
XL: 108 cm x 75 cm
2XL : 114 cm x 78 cm
3XL : 120 cm x 81 cm
*Toleransi selisih 1-2cm

Cara Perawatan:
1. Gunakan Deterjen cair/bubuk dan jangan memakai pemutih.
2. Cuci dengan warna yang senada.
3. Jangan rendam pakaian terlalu lama.
4. Jangan keringkan pakaian dengan mesin cuci.
5. Cuci dengan membalikan luar-dalam pakaian.
6. Setrika dengan suhu sedang.

Kebijakan Pengembalian Barang :
1. Dalam jangka waktu 2x24 jam sejak barang tersebut diterima oleh konsumen (jika pesanan tersebut sudah diselesaikan /status berubah).
2. Menyertakan video unboxing lengkap dengan menampilkan semua sisi paket untuk memastikan bahwa paket tersebut masih baru dan belum pernah dibongkar.
3. Pricetag/label harga di produk masih ada dan produk belum pernah dicuci
4. Kirimkan bukti resi pengembalian tersebut.
5. Setelah barang sampai, kami akan melakukan pengecekan barang tersebut.  jika ada kesalahan dari seller maka akan dilakukan 2 opsi yaitu :
	a. Pengembalian barang baru.
	b. Pengembalian dana akan diproses dengan batas waktu 2x24 jam kerja.

Catatan: Tidak berlaku untuk tukar size yang di karenakan kesalahan konsumen.			","150000,160000,170000,180000,19000","s,m,l,xl,xxl","500");



CREATE TABLE `produksi` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(200) NOT NULL,
  `kode_customer` varchar(200) NOT NULL,
  `kode_produk` varchar(200) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `ukuran` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `provinsi` varchar(200) NOT NULL,
  `kota` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kode_pos` varchar(200) NOT NULL,
  `ekspedisi` varchar(255) NOT NULL,
  `paket_ekspedisi` varchar(200) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `etd_ekspedisi` varchar(200) NOT NULL,
  `terima` varchar(200) NOT NULL,
  `tolak` varchar(200) NOT NULL,
  `cek` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `timess` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `tgl` date NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;

INSERT INTO produksi VALUES("39","INV0001","C0005","P0001","Mega Mendung","2","20000","m","0","Oct 12, 2020 02:33:09","Papua Barat","Teluk Wondama","Jl Tanah Merah Indah 1 No 10 C","60129","jne","OKE 179,000 5-9 Hari","179000","5-9","1","0","0","40006","01:33:09","5f83533300a31.jpg","2020-10-12");
INSERT INTO produksi VALUES("40","INV0002","C0005","P0001","Mega Mendung","1","20000","m","0","Oct 12, 2020 02:53:28","Jawa Timur","Surabaya","Jl Tanah Merah Indah 1 No 10 C","60129","jne","REG 7,000 2-3 Hari","7000","2-3","1","0","0","20003","01:53:28","5f835ea041f26.jpg","2020-10-12");
INSERT INTO produksi VALUES("41","INV0003","C0006","P0001","Mega Mendung","2","20000","m","0","Oct 12, 2020 08:26:53","Jawa Timur","Surabaya","Jl Tanah Merah Indah 1 No 10 C","60129","jne","REG 7,000 2-3 Hari","7000","2-3","1","0","0","100009","07:26:53","5f83a34f0d970.jpg","2020-10-12");
INSERT INTO produksi VALUES("42","INV0003","C0006","P0003","Batik Sarimbit Kuning","1","30000","l","0","Oct 12, 2020 08:26:53","Jawa Timur","Surabaya","Jl Tanah Merah Indah 1 No 10 C","60129","jne","REG 7,000 2-3 Hari","7000","2-3","1","0","0","100009","07:26:53","5f83a34f0d970.jpg","2020-10-12");
INSERT INTO produksi VALUES("43","INV0003","C0006","P0002","Batik Sarimbit ","1","30000","xl","0","Oct 12, 2020 08:26:53","Jawa Timur","Surabaya","Jl Tanah Merah Indah 1 No 10 C","60129","jne","REG 7,000 2-3 Hari","7000","2-3","1","0","0","100009","07:26:53","5f83a34f0d970.jpg","2020-10-12");
INSERT INTO produksi VALUES("47","INV0004","C0006","P0001","Mega Mendung","1","20000","m","0","Oct 12, 2020 09:50:17","Jawa Timur","Surabaya","Jl Tanah Merah Indah 1 No 10 C","60129","jne","REG 7,000 2-3 Hari","7000","2-3","1","0","0","20009","08:50:17","5f83b6a1f19c8.jpg","2020-10-12");
INSERT INTO produksi VALUES("48","INV0005","C0006","P0003","Batik Sarimbit Kuning","1","30000","l","0","Oct 13, 2020 10:26:03","Jawa Timur","Surabaya","Jl Tanah Merah Indah 1 No 10 C","60129","jne","REG 7,000 2-3 Hari","7000","2-3","1","0","0","30005","09:26:03","","2020-10-13");
INSERT INTO produksi VALUES("49","INV0006","C0007","P0002","Batik Sarimbit ","1","0","nul","0","Jul 06, 2024 05:05:53","","","ledug","09876","","","0","","1","0","0","8","04:05:53","","2424-07-06");
INSERT INTO produksi VALUES("50","INV0006","C0007","P0002","Batik Sarimbit ","1","0","s","0","Jul 06, 2024 05:05:53","","","ledug","09876","","","0","","1","0","0","8","04:05:53","","2424-07-06");
INSERT INTO produksi VALUES("51","INV0007","C0007","P0001","Mega Mendung","1","0","l","0","Jul 06, 2024 05:07:02","","","Kuningan","45555","","","0","","1","0","0","7","04:07:02","6688a6e0cecfe.png","2424-07-06");



;




CREATE TABLE `report_cancel` (
  `id_report_cancel` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_report_cancel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `report_inventory` (
  `id_report_inv` int(11) NOT NULL AUTO_INCREMENT,
  `kode_bk` varchar(100) NOT NULL,
  `nama_bahanbaku` varchar(100) NOT NULL,
  `jml_stok_bk` int(11) NOT NULL,
  `tanggal` varchar(11) NOT NULL,
  PRIMARY KEY (`id_report_inv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `report_omset` (
  `id_report_omset` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_omset` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_report_omset`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `report_produksi` (
  `id_report_prd` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_report_prd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `report_profit` (
  `id_report_profit` int(11) NOT NULL AUTO_INCREMENT,
  `kode_bom` varchar(100) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `kode_produk` varchar(100) NOT NULL,
  `jumlah` varchar(11) NOT NULL,
  `total_profit` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_report_profit`),
  UNIQUE KEY `kode_bom` (`kode_bom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


