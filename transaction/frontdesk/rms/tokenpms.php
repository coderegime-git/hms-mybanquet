<?php	
$clnturl = $tykurl.'/clienturl/'.$clientid;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $clnturl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$headers = array(
        'Content-Type: application/json'
        );
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
//echo $result;

$data = array(
  "agentId" => $agentid,
  "agentPassword" => $agentpassword,
  "clientId" => $clientid,
  "clientPassword" => $clientpassword,
  "useTrainingDatabase" => $trndta,
  "moduleType" => [
    "KIOSK"
  ]
);
$postdata = json_encode($data);
//echo $postdata;
$url = $result.'/authToken';
$headers = array(
        'Content-Type: application/json'
        );
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$resultss = curl_exec($ch);
curl_close($ch);
//print_r ($resultss);
$someArray = json_decode($resultss, true);
$token = $someArray["token"];
?>