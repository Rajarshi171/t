<?php

//get data from letzbefriends

function get_data($id, $grp){
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:8888');
$url='https://letzbefriends.com/ords/lez/tds/xtract?xtr='.$id.'&grpid='.$grp;
curl_setopt($ch, CURLOPT_URL,$url);
$jsondata = curl_exec($ch);
curl_close($ch);

$ar = json_decode($jsondata);

return $ar;

}

?>