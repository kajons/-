<?php
if($_POST){
	$username = $_POST['g_username'];
	$ypass = $_POST['ypass'];
	$xpass = $_POST['xpass'];
	mysql_connect('localhost', 'root', '123456') or die('数据库链接出错！');
	mysql_select_db("register");
	$sq = "SELECT password FROM user WHERE password = '$ypass' and username = '$username'";
	$result = mysql_query($sq);
	$num = mysql_num_rows($result);
	if(!$num){
		echo("1");
	}else{
		$sql = "UPDATE user SET password='$xpass' WHERE password='$ypass' and username = '$username'";
		mysql_query($sql);
		echo("2");
	}
}else{
	echo '无数据传入';
}
?>