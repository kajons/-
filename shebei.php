<?php
$username = $_POST['g_username'];

mysql_connect('localhost', 'root', '123456') or die("数据库连接失败！");
mysql_select_db("register");
$result = mysql_query("SELECT Name,Number FROM panel WHERE username='$username'");
while($row = mysql_fetch_array($result))
{
	$name = $row['Name'];
	$number = $row['Number'];
	echo ($name ."-". $number.",");
		
}
?>