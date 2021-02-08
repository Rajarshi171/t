<?php

$dan = $_GET['dan'];

$key = "786HU-4R73R-86RGH-943AH-G7854";
$member_id = "1917011";
$live_url = "https://api.custodial.tenancydepositscheme.com";
$sandbox_url = "https://sandbox.api.custodial.tenancydepositscheme.com";
$branch_id = "0";
$api_version = "v0.9";

$url = $sandbox_url."/".$api_version."/TenancyInformation/".$member_id."/".$branch_id."/".$key."/".$dan; 

$result = file_get_contents( $url );

$res = json_decode($result);

//print_r($res);

echo "<strong>Status:</strong> ".$res->status."</br>";
echo "<strong>Case Status:</strong> ".$res->case_status."</br>";
echo "<strong>Adjudication decision published:</strong> ".$res->adjudication_decision_published."</br>";
echo "<strong>Protected Amount:</strong> ".$res->protected_amount."</br>";