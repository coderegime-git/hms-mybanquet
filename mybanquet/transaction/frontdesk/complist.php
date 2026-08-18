 <option value="">Select</option>
<?php
session_start();
include 'rms/config.php';
include 'rms/token.php';

$url = $result."/companies?limit=999&modelType=basic&offset=0";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$auth  = 'authtoken:'.$token; 
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = $auth;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$val = curl_exec($ch);
$list = json_decode($val, true);
//print_r($val);
foreach ($list as $li) {
?>
								 <option value="<?php echo $li['name']; ?>"><?php echo $li['name']; ?></option>
<?php
    }
?>