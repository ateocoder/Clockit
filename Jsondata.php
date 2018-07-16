<?php 

function seek_data($start_date,$end_date) {

$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => 'https://api.clockit.io/api/v1/app/ar9vj/users/logs?start_date=2018-07-13&end_date=2018-07-13',
CURLOPT_RETURNTRANSFER  => true,
CURLOPT_ENCODING  => "",
CURLOPT_MAXREDIRS  => 10,
CURLOPT_TIMEOUT  => 30,
CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST  => "GET",
CURLOPT_HTTPHEADER  => array(
"authorization: Bearer tick_e78aec11e323ed0e5f7bd33edffa121ffbc59a2af57d32ff704f3c887ef2f708.clockit.io",
"cache-control: no-cache",
"content-type: application/json"
),
));
$response = curl_exec($curl);
$data = json_decode($response,True);
$err = curl_error($curl);
curl_close($curl); 

if ($err) {
echo "CURL Error #:" .$err;
return $err;

          }//if 
else { //no error in data transmission 
return json_decode($response,True);
} //else
                                       }//seekdata

?>