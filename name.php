<?php
$name = $_POST['name'];	
$user = $_POST['user'];
mysql_connect('localhost', 'root', '123456') or die("数据库链接出错！");
mysql_select_db("register");
$sql = "SELECT Name FROM panel WHERE User = '$user' and Name = '$name'";
$result = mysql_query($sql);
$num = mysql_num_rows($result);
	if($num){
		echo ('1');
	};
?>