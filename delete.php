<?php
$td = $_POST['td'];
$username = $_POST['username'];

mysql_connect('localhost', 'root', '123456') or die("数据库链接出错！");
mysql_select_db("register");
$sql = "DELETE FROM panel WHERE ID='$td' and username='$username'";
$result = mysql_query($sql);
$url= "panel.php";
echo 1;
?>