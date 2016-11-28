<?php
    function rc4 ($pwd, $data)
    {
        $key[] ="";
        $box[] ="";
     	$cipher="";
        $pwd_length = strlen($pwd);
        $data_length = strlen($data);
     
        for ($i = 0; $i < 256; $i++)
        {
            $key[$i] = ord($pwd[$i % $pwd_length]);
            $box[$i] = $i;
        }
     
        for ($j = $i = 0; $i < 256; $i++)
        {
            $j = ($j + $box[$i] + $key[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
     
        for ($a = $j = $i = 0; $i < $data_length; $i++)
        {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
     
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
     
            $k = $box[(($box[$a] + $box[$j]) % 256)];
            $cipher .= chr(ord($data[$i]) ^ $k);
        }
         
        return $cipher;
    }

$pwd = 'GoolinkWeb2016';
$data = '{"DevList":"[\"'.$_POST['id'].'\"]"}';
$cipher = rc4($pwd, $data);
$base = base64_encode($cipher);

$remote_server = 'www.goolink.org';
  $post_string= $base;
  $port = 80;
  $errno=0;
  $errstr='' ;
  $timeout = 30;
  $socket = fsockopen($remote_server, $port,  $errno, $errstr, $timeout);
  if (!$socket) die("$errstr($errno)");
  fwrite($socket, "POST /g_devgs_api.php HTTP/1.0\r\n");
  fwrite($socket, "User-Agent: Socket Example\r\n");
  fwrite($socket, "HOST: www.goolink.org\r\n");
  fwrite($socket, "Content-type: application/x-www-form-urlencoded\r\n");
  fwrite($socket, "Content-length: " . strlen($post_string) . "\r\n");
  fwrite($socket, "Accept:*/*\r\n");
  fwrite($socket, "\r\n");
  fwrite($socket, "$post_string\r\n");
  fwrite($socket, "\r\n");
  $header = "";
  while ($str = trim(fgets($socket, 4096))) {
    $header .= $str;
  }

  $data = "";
  while (!feof($socket)) {
    $data .= fgets($socket, 4096);
	$base_de = base64_decode($data);
	$ciphers = rc4($pwd, $base_de);

$str=extract(json_decode($ciphers, true));
$arr=extract($ReDevList);
$GID = $ReDevList[0]['GID'];
$GSIP = $ReDevList[0]['GSIP'];
$GSPort = $ReDevList[0]['GSPort'];

$id = $_POST['id'];
$name = $_POST['name'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$number = $_POST['number'];
$username = $_POST['username'];

mysql_connect('localhost', 'root', '123456') or die("数据库链接出错！");
mysql_select_db("register");
$sq = "SELECT ID,username FROM panel WHERE ID='$id' and username='$username'";
$result = mysql_query($sq);
$num = mysql_num_rows($result);

$sql = "SELECT Name,username FROM panel WHERE Name='$name' and username='$username'";
$results = mysql_query($sql);
$nums = mysql_num_rows($results);

if($GID == ""){
	echo 7;
}
else if($num){
	echo 1;
}
else if($nums){
	echo 2;
}
else{
	$sql = "INSERT INTO panel (ID, Name, User, Password, Number, GID, GSIP, GSPort, username) VALUES ('$id', '$name', '$user', '$pass', '$number', '$GID', '$GSIP', '$GSPort', '$username')";
	mysql_query($sql);
	echo 3;
 };
}
?>