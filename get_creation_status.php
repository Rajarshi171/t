<?php 

$batchid = $_GET['batchid'];

$key = "786HU-4R73R-86RGH-943AH-G7854";
$member_id = "1917011";
$live_url = "https://api.custodial.tenancydepositscheme.com";
$sandbox_url = "https://sandbox.api.custodial.tenancydepositscheme.com";
$branch_id = "0";
$api_version = "v0.9";

$url = $sandbox_url."/".$api_version."/CreateDepositStatus/".$member_id."/".$branch_id."/".$key."/".$batchid; 

$result = file_get_contents( $url );

$res = json_decode($result);

//print_r($res);

echo "<strong>Status:</strong> ".$res->status."</br>";
echo "<strong>DAN:</strong> ".$res->dan."</br>";
echo "<strong>Branch id:</strong> ".$res->branch_id."</br>";
if(!empty($res->errors)){
echo "<strong>Errors:</strong></br>";
foreach($res->errors as $er){
	echo $er->value."</br>";
}
}