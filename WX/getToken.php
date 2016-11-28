<?php

$APPID="wx70c68f31057d452a";
$APPSECRET="642f176ab39d3f530e14afdebf585618";

$TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;

$json=file_get_contents($TOKEN_URL);
$result=json_decode($json,true);
print_r($result);

?>
