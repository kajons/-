<?php
$username = $_POST['username'];
$password = $_POST['password'];
$id = $_POST['id'];
$conn = mysql_connect('localhost', 'root', '123456') or die("数据库连接出错！");
mysql_select_db("register");
$sql = "SELECT username,password FROM user WHERE username='$username' and password = '$password'";
$result = mysql_query($sql);
  $num = mysql_num_rows($result);
  if($num){
  	echo ("True");
  }
  else{
  	echo ("flase");
  }
?>