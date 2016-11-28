<?php
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$video = $_POST['video'];
$picture = $_POST['picture'];
$conn = mysql_connect('localhost', 'root', '123456') or die("数据库链接出错！");
mysql_select_db("register");
$sq = "SELECT username FROM user WHERE username = '$_POST[username]'";
$result = mysql_query($sq);
$num = mysql_num_rows($result);
  if($num){
  	echo 1;
  }
  else{
	$sql = "INSERT INTO user (`username`, `password`, `email`, `video`, `picture`) VALUES ('$username', '$password', '$email', '$video', '$picture')";
	mysql_query($sql);
	echo 2;
  }
?>
