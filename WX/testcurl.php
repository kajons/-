<?php 
$ch = curl_init(); 

curl_setopt ($ch, CURLOPT_URL, "http://www.safer.com"); 
curl_setopt ($ch, CURLOPT_HEADER, 0); 

curl_exec ($ch); 

curl_close ($ch); 
?> 
