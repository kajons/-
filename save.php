<?php
$td_id = $_REQUEST['td_id'];
$td_nn = $_REQUEST['td_nn'];
$td_nu = $_REQUEST['td_nu'];
$td_np = $_REQUEST['td_np'];
$td_nc = $_REQUEST['td_nc'];
$username = $_REQUEST['username'];
mysql_connect('localhost', 'root', '123456') or die("数据库链接出错！");
mysql_select_db("register");
$sql = "UPDATE panel SET Name='$td_nn', User='$td_nu', Password='$td_np', Number='$td_nc' WHERE ID='$td_id' and username='$username'";
$result = mysql_query($sql);
$mark = mysql_affected_rows();
$url= "panel.php";
echo 1;
?>