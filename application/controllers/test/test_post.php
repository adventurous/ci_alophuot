<?php
$service_url = 'http://khoinguon.bl.ee/ci_alophuot/index.php/api/speciallogin/';
$curl = curl_init($service_url);
$curl_post_data = array(
        'device_id' => 'admin',
        'code' => 'devteam',
        'rest_client_id' => 'sf1a6dad481fac130b474f6c676fcaa0'
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
echo 'response ok!';
echo $decoded['status'];
?>