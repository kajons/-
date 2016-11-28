<?php
	mysql_connect('localhost', 'root', '123456') or die("数据库链接出错！");
	mysql_select_db("register");
	$result = mysql_query("SELECT * FROM panel");
	while($row = mysql_fetch_array($result))
	{
		$id = $row['ID'];
		$num = $row['Number'];
		$name = $row['Name'];
		$user = $row['User'];
		$Password = $row['Password'];
		$GID = $row['GID'];
		$GSIP = $row['GSIP'];
		$GSPort = $row['GSPort'];
		$username = $row['username'];
		echo ($id."-". $name."-".$user."-".$Password."-".$GID."-".$GSIP."-".$GSPort."-".$username.",");
	}
?>