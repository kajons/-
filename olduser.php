<?php
$name = $_GET['name'];
$yx = $_GET['yx'];

	$file_path="text.txt";
	$fp=fopen($file_path,"a+");
	$txt = sprintf("%s_%s\r\n",$name,$yx);
	fwrite($fp,$txt);
	fclose($fp);
	echo 1;
?>