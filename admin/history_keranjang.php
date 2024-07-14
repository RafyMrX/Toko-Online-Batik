CREATE TABLE history_keranjang (
    id_history INT AUTO_INCREMENT PRIMARY KEY,
    kode_customer VARCHAR(50),
    kode_produk VARCHAR(50),
    nama_produk VARCHAR(100),
    qty INT,
    harga DECIMAL(10, 2),
    ukuran VARCHAR(50),
    date_checkout DATETIME DEFAULT CURRENT_TIMESTAMP
);
