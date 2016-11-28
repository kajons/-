<?php
$username = $_POST['username'];
$email = $_POST['email'];
$conn = mysql_connect('localhost', 'root', '123456') or die("数据库链接出错！");
mysql_select_db("register");
$sql = "SELECT username,password,email FROM user WHERE email='$email' and username='$username'";
$query = mysql_query($sql);
  $num = mysql_num_rows($query);
  if(!$num){
  	echo 1;
  }
  else{
  	$row = mysql_fetch_array($query);
	$pass = $row['password'];
	sendmail('密码找回','亲爱的'.$email.'：'.'</br>'.'用户名：'.$username.'&nbsp;&nbsp;'.'密码是：'.$pass.'。',$email);
  	echo 2;
  };

function sendmail($warn_title,$warn_content,$mail_box){
require("smtp.php");
	
	$smtpserver = "smtp.163.com";
	
	$smtpserverport = 25;
	
	$smtpusermail = "kajonmail@163.com";
	
	$smtpemailto = $mail_box;
	
	$smtpuser = "kajonmail";
	
	$smtppass = "kajon112778";
	
	$mailsubject = $warn_title;
	
	$mailbody = $warn_content;
	
	$mailtype = "HTML";
	
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
	
	$smtp->debug = false;
	
	$smtp->sendmail($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype);
};
?>