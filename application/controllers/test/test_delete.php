<?php
$service_url = 'http://example.com/api/conversations/[CONVERSATION_ID]';
$ch = curl_init($service_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
$curl_post_data = array(
        'note' => 'this is spam!',
        'useridentifier' => 'agent@example.com',
        'apikey' => 'key001'
);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
$response = curl_exec($ch);
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
var_export($decoded->response);
?>