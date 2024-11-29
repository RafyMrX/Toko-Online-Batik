<?php

$provinsi_id = $_GET['prov_id'];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://rajaapi.ongkir.com/starter/city?province=$provinsi_id",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: 8883c249d80d8bccfb0f18077e1ff594"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
}

$data = json_decode($response, true);
for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
    echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'
    nama_provinsi = '".$data['rajaongkir']['results'][$i]['province']."'
    nama_kota = '".$data['rajaongkir']['results'][$i]['city_name']."'
    tipe_kota = '".$data['rajaongkir']['results'][$i]['type']."'
    kodepos = '".$data['rajaongkir']['results'][$i]['postal_code']."'
    >".$data['rajaongkir']['results'][$i]['city_name']."</option>";
}

?>