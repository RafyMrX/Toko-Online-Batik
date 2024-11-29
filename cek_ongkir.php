<?php
$id_kabupaten = $_POST['kab_id'];
$kurir = $_POST['kurir'];
$berat = $_POST['berat'];

// Define an array of kabupaten and their corresponding ongkir rates
$kabupaten_ongkir = array(
    'Aceh' => array(
        'Banda Aceh' => 10000,
        'Lhokseumawe' => 12000,
        'Langsa' => 15000,
        'Sabang' => 18000,
        'Sigli' => 20000,
        'Meulaboh' => 22000,
        'Takengon' => 25000,
        'Bireuen' => 28000,
        'Lhoksukon' => 30000,
    ),
    'Sumatera Utara' => array(
        'Medan' => 15000,
        'Pematangsiantar' => 18000,
        'Tanjungbalai' => 20000,
        'Rantau Prapat' => 22000,
        'Binjai' => 25000,
        'Tebing Tinggi' => 28000,
        'Pangkalan Brandan' => 30000,
        'Labuhan Deli' => 32000,
        'Stabat' => 35000,
    ),
    'Sumatera Barat' => array(
        'Padang' => 20000,
        'Solok' => 22000,
        'Sawahlunto' => 25000,
        'Padang Panjang' => 28000,
        'Bukittinggi' => 30000,
        'Payakumbuh' => 32000,
        'Solok Selatan' => 35000,
    ),
    'Riau' => array(
        'Pekanbaru' => 25000,
        'Dumai' => 28000,
        'Selat Panjang' => 30000,
        'Bagan Siapi-api' => 32000,
        'Rengat' => 35000,
        'Siak Sri Indrapura' => 38000,
    ),
    'Kepulauan Riau' => array(
        'Tanjung Pinang' => 30000,
        'Batam' => 32000,
        'Bintan' => 35000,
        'Karimun' => 38000,
        'Natuna' => 40000,
    ),
    'Jambi' => array(
        'Jambi' => 25000,
        'Sarolangun' => 28000,
        'Bangko' => 30000,
        'Muara Bungo' => 32000,
        'Sungai Penuh' => 35000,
    ),
    'Sumatera Selatan' => array(
        'Palembang' => 25000,
        'Prabumulih' => 28000,
        'Pagar Alam' => 30000,
        'Lahat' => 32000,
        'Muara Enim' => 35000,
    ),
    'Bengkulu' => array(
        'Bengkulu' => 25000,
        'Arga Makmur' => 28000,
        'Curup' => 30000,
        'Kepahiang' => 32000,
        'Lebong' => 35000,
    ),
    'Lampung' => array(
        'Bandar Lampung' => 25000,
        'Metro' => 28000,
        'Lahat' => 30000,
        'Pringsewu' => 32000,
        'Tanggamus' => 35000,
    ),
    'Bangka Belitung' => array(
        'Pangkal Pinang' => 30000,
        'Sungai Liat' => 32000,
        'Manggar' => 35000,
        'Belitung' => 38000,
        'Tanjung Pandan' => 40000,
    ),
    'DKI Jakarta' => array(
        'Jakarta Pusat' => 15000,
        'Jakarta Utara' => 18000,
        'Jakarta Barat' => 20000,
        'Jakarta Selatan' => 22000,
        'Jakarta Timur' => 25000,
    ),
    'Jawa Barat' => array(
        'Bandung' => 20000,
        'Cirebon' => 22000,
        'Bekasi' => 25000,
        'Bogor' => 28000,
'Tasikmalaya' => 30000,
    ),
    'Jawa Tengah' => array(
        'Semarang' => 25000,
        'Pekalongan' => 28000,
        'Magelang' => 30000,
        'Surakarta' => 32000,
        'Salatiga' => 35000,
    ),
    'Jawa Timur' => array(
        'Surabaya' => 25000,
        'Malang' => 28000,
        'Batu' => 30000,
        'Blitar' => 32000,
        'Kediri' => 35000,
    ),
    'Yogyakarta' => array(
        'Yogyakarta' => 25000,
        'Bantul' => 28000,
        'Gunung Kidul' => 30000,
        'Kulon Progo' => 32000,
        'Sleman' => 35000,
    ),
    'Bali' => array(
        'Denpasar' => 30000,
        'Badung' => 32000,
        'Gianyar' => 35000,
        'Tabanan' => 38000,
        'Klungkung' => 40000,
    ),
    'Nusa Tenggara Barat' => array(
        'Mataram' => 35000,
        'Bima' => 38000,
        'Sumbawa' => 40000,
        'Dompu' => 42000,
        'Lombok Timur' => 45000,
    ),
    'Nusa Tenggara Timur' => array(
        'Kupang' => 40000,
        'Ende' => 42000,
        'Maumere' => 45000,
        'Larantuka' => 48000,
        'Bajawa' => 50000,
    ),
    'Kalimantan Barat' => array(
        'Pontianak' => 45000,
        'Ketapang' => 48000,
        'Sintang' => 50000,
        'Sanggau' => 52000,
        'Mempawah' => 55000,
    ),
    'Kalimantan Tengah' => array(
        'Palangka Raya' => 50000,
        'Katingan' => 52000,
        'Lamandau' => 55000,
        'Pulang Pisau' => 58000,
        'Barito Utara' => 60000,
    ),
    'Kalimantan Selatan' => array(
        'Banjarmasin' => 50000,
        'Banjarbaru' => 52000,
        'Tanah Laut' => 55000,
        'Tanah Bumbu' => 58000,
        'Balangan' => 60000,
    ),
    'Kalimantan Timur' => array(
        'Samarinda' => 55000,
        'Balikpapan' => 58000,
        'Bontang' => 60000,
        'Kutai Kartanegara' => 62000,
        'Penajam Paser Utara' => 65000,
    ),
    'Sulawesi Utara' => array(
        'Manado' => 60000,
        'Bitung' => 62000,
        'Tomohon' => 65000,
        'Minahasa' => 68000,
        'Bolaang Mongondow' => 70000,
    ),
    'Sulawesi Tengah' => array(
        'Palu' => 65000,
        'Donggala' => 68000,
        'Toli-Toli' => 70000,
        'Parigi Moutong' => 72000,
        'Banggai' => 75000,
    ),
    'Sulawesi Selatan' => array(
        'Makassar' => 70000,
        'Parepare' => 72000,
        'Gowa' => 75000,
        'Takalar' => 78000,
        'Jeneponto' => 80000,
    ),
    'Sulawesi Tenggara' => array(
        'Kendari' => 75000,
        'Bau-Bau' => 78000,
        'Wakatobi' => 80000,
        'Bombana' => 82000,
        'Kolaka' => 85000,
    ),
    'Gorontalo' => array(
        'Gorontalo' => 80000,
        'Boalemo' => 82000,
        'Bone Bolango' => 85000,
        'Pohuwato' => 88000,
        'North Gorontalo' => 90000,
    ),
    'Maluku' => array(
        'Ambon' => 85000,
        'Tual' => 88000,
        'Ternate' => 90000,
        'Tidore' => 92000,
        'Halmahera Barat' => 95000,
    ),
    'Maluku Utara' => array(
        'Ternate' => 90000,
        'Tidore' => 92000,
        'Halmahera Barat' => 95000,
        'Halmahera Tengah' => 98000,
        'Halmahera Selatan' => 100000,
    ),
    'Papua' => array(
        'Jayapura' => 100000,
        'Biak' => 102000,
        'Merauke' => 104000,
        'Sorong' => 106000,
        'Fakfak' => 108000,
    ),
    'Papua Barat' => array(
        'Manokwari' => 102000,
        'Sorong' => 104000,
        'Fakfak' => 106000,
        'Kaimana' => 108000,
        'Teluk Wondama' => 110000,
    ),
);

// Calculate the ongkir rate based on the selected kabupaten and kurir
$ongkir_rate = $kabupaten_ongkir[$id_kabupaten][$kurir];

// Calculate the total cost of shipping
$total_cost = $ongkir_rate + ($berat * $kurir);

// Display the ongkir rate and total cost
echo "<option>-- Pilih Paket --</option>";
echo "
    <option
    paket = 'Reguler'
    ongkir = '".$ongkir_rate."'>
        Reguler ".number_format($ongkir_rate)." Hari
    </option>
    <option
    paket = 'Express'
    ongkir = '".$ongkir_rate * 2."'>
        Express ".number_format($ongkir_rate * 2)." Hari
    </option>
    <option
    paket = 'Same Day'
    ongkir = '".$ongkir_rate * 3."'>
        Same Day ".number_format($ongkir_rate * 3)." Hari
    </option>
";

?>