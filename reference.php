<?php
$username = $_REQUEST['g_username'];
$xemail = $_REQUEST['xemail'];
mysql_connect('localhost', 'root', '123456') or die("数据库链接出错！");
mysql_select_db("register");
$sql = "UPDATE user SET email='$xemail' WHERE username='$username'";
$result = mysql_query($sql);
$mark = mysql_affected_rows();
if($mark > 0){
	echo ("1");
}else{
	echo ("2");
}
?>