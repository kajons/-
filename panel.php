<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link type="text/css" href="css/panel.css" rel="stylesheet" />
<script src="js/jquery-1.12.1.min.js" type="text/javascript"></script>
<script src="js/panel.js" type="text/javascript"></script>
<script src="edition/panel_config.js" type="text/javascript"></script>
<script src="js/dtreeck.js" type="text/javascript"></script>
<script src="js/jquery.cookie.js" type="text/javascript"></script>
</head>
<body>
<!--判断中英文-->
<?php
$username= $_COOKIE['name'];
mysql_connect('localhost', 'root', '123456') or die("数据库连接出错！");
mysql_select_db("register");
$sql = "SELECT username,email,password FROM user WHERE username='$username'";
$query = mysql_query($sql);
$row = mysql_fetch_array($query);
$email = $row['email'];
$password = $row['password'];
?>
<script type="text/javascript">
var g_id = $.cookie("yuyan");
var g_username="<?php echo htmlentities($username);?>";
var g_password="<?php echo htmlentities($password);?>";
var g_email="<?php echo htmlentities($email);?>";
//alert (g_password);
function langtr(stringIds)
{
if(g_id == 2){
	return strChinese[stringIds];
}
	else if(g_id == 1){
		return strEnglish[stringIds]; 
	}
}
</script>
<!--主页-->
<div id="logo"></div>
<div id="top">
	<a id="ss"><script>document.write(langtr(ss))</script></a>
	<a id="sb"><script>document.write(langtr(sb))</script></a>
	<a id="xx"><script>document.write(langtr(xx))</script></a>
	<a id="down" href="anycam.exe"><script>document.write(langtr(down))</script></a>
	<a id="quit"><script>document.write(langtr(quit))</script></a>
</div>
<div id="live">
<div id="treediv" style="position:absolute; top:12%; overflow:auto; background-color:#27292e;  width: 15.3%; height:85%;  padding: 5px;background:none;color:#CCCCCC;border: 1px solid #FFFFFF"  >
	<script language="JavaScript" type="text/JavaScript">
	var arr="";
	var wrr = langtr(tongdao);
	var rrr = langtr(sbname);
		//树代码
		mydtree = new dTree('mydtree','imgmenu/','no','no');
		mydtree.add(0, -1,rrr,false);
		$(document).ready(function(){
			$.post("shebei.php",
				{g_username:g_username},
				function(data){
				arr = data;
				var strs = new Array();
				strs = arr.split(",");
				for (var i=0;i<strs.length-1 ;i++ ) 
					{ 
						var strs2 = new Array();
					         strs2=strs[i].split("-");
						mydtree.add(i+1,0,strs2[0],'#',false);
						for(var j=0;j<strs2[1];j++){
							mydtree.add(j+100,
							i+1,
							wrr+(j+1),
							strs2[0]+'-'+(j+1),
							'#');
						}
					} 
		document.getElementById("treediv").innerHTML = mydtree;
				});
			});	   
	</script>
</div>

<script type="text/javascript">
//判断鼠标在不在弹出层范围内
 function   checkIn(id){
	var yy = 20;   //偏移量
	var str = "";
	var   x=window.event.clientX;   
	var   y=window.event.clientY;   
	var   obj=$("#"+id)[0];
	if(x>obj.offsetLeft&&x<(obj.offsetLeft+obj.clientWidth)&&y>(obj.offsetTop-yy)&&y<(obj.offsetTop+obj.clientHeight)){   
		return true;
	}else{   
		return false;
	}   
  }   
</script>
<form method="POST" name="form1" onSubmit="" action="">
<div id="connetc">
<object id='glnkViewer' codebase='anycam.cab#version=3,0,3,0' classid='CLSID:28B6AEE4-EA70-4C29-AB05-2A9DA0202A46'>
	<param name='_Version' value='65536' />
	<param name='_ExtentX' value='33015' />
	<param name='_ExtentY' value='17881' />
	<param name='_StockProps' value='0' />
	<param name="wmode" value="transparent" />
</object>
</div>

<a class="snap" onclick="Snapshot();"><img id="img_snap" src="image/操作图标/snap0.png"; onmouseover="show()"; onmouseout="clears()" />
	<label id="stext"></label>
</a>
<a class="record" onclick="StartRecord();"><img id="img_record" src="image/操作图标/record0.png"; onmouseover="rshow()"; onmouseout="rclears()"; />
	<label id="rtext"></label>
</a>
<a class="close" onclick="stopVideo();"><img id="img_close" src="image/操作图标/close0.png"; onmouseover="cshow()"; onmouseout="cclears()"; />
	<label id="ctext"></label>
</a>
<a id="voice" onclick="Chang_Sound(0)"><img id="img_voice" style="border: none;" src="image/操作图标/voice0.png" onmouseover="vshow()" onmouseout="vclears()" />
	<label id="vtext"></label>
</a>
<a id="voice7" onclick="Chang_Sound(1)" style="display: none;"><img id="img_voice1" style="border: none;" src="image/操作图标/voices0.png" onmouseover="vshow1()" onmouseout="vclears1()" />
	<label id="vtext1"></label>
</a>
<a id="talk" onclick="Chang_Phone(0);"><img id="img_talk" style="border: none;" src="image/操作图标/talk0.png" onmouseover="tshow()" onmouseout="tclears()" />
	<label id="ttext"></label>
</a>
<a id="talk7" onclick="Chang_Phone(1)" style="display: none;"><img id="img_talk1" style="border: none;" src="image/操作图标/talk0s.png" onmouseover="tshow1()" onmouseout="tclears1()" />
	<label id="ttext1"></label>
</a>
<a class="closev" onclick="stopAllVideo();"><img id="img_closev" src="image/操作图标/closev0.png"; onmouseover="clshow()"; onmouseout="clclears()"; />
	<label id="cltext"></label>
</a>
<a onclick="SetPlayWndModel('1');"><img class="img_1" src="image/操作图标02/1-1.png" onmouseover="this.src='image/操作图标02/1.png'"; onmouseout="this.src='image/操作图标02/1-1.png'" />
</a>
<a onclick="SetPlayWndModel('2');"><img class="img_4" src="image/操作图标02/4-1.png" onmouseover="this.src='image/操作图标02/4.png'"; onmouseout="this.src='image/操作图标02/4-1.png'" />
</a>
<a onclick="SetPlayWndModel('8');"><img class="img_8" src="image/操作图标02/8-1.png" onmouseover="this.src='image/操作图标02/8.png'" onmouseout="this.src='image/操作图标02/8-1.png'" />
</a>
<a onclick="SetPlayWndModel('4');"><img class="img_16" src="image/操作图标02/16-1.png" onmouseover="this.src='image/操作图标02/16.png'" onmouseout="this.src='image/操作图标02/16-1.png'" />
</a>
<a onclick="SetPlayWndModel('5');"><img class="img_25" src="image/操作图标02/25-1.png" onmouseover="this.src='image/操作图标02/25.png'" onmouseout="this.src='image/操作图标02/25-1.png'" />
</a>
<a onclick="SetPlayWndModel('6');"><img class="img_36" src="image/操作图标02/36-1.png" onmouseover="this.src='image/操作图标02/36.png'" onmouseout="this.src='image/操作图标02/36-1.png'" />
</a>
<a onclick="PtzCtrlUp();"><img class="up" src="image/操作图标/up0.png" onmouseover="this.src='image/操作图标/up.png'" onmouseout="this.src='image/操作图标/up0.png'" /></a>
<a><img class="h" src="image/操作图标/h0.png" onmouseover="this.src='image/操作图标/h.png'" onmouseout="this.src='image/操作图标/h0.png'" /></a>
<a onclick="PtzCtrlLeft();"><img class="left" src="image/操作图标/left0.png" onmouseover="this.src='image/操作图标/left.png'" onmouseout="this.src='image/操作图标/left0.png'" /></a>
<a onclick="PtzCtrlRight();"><img class="right" src="image/操作图标/right0.png" onmouseover="this.src='image/操作图标/right.png'" onmouseout="this.src='image/操作图标/right0.png'" /></a>
<a onclick="PtzCtrlDown();"><img class="down" src="image/操作图标/down0.png" onmouseover="this.src='image/操作图标/down.png'" onmouseout="this.src='image/操作图标/down0.png'" /></a>
<table class="tupian">
<tr>
<td><a style="width: 100%; height: 100%;" href="#" onclick="PtzCtrlFocusNear();"><img class="fangda" src="image/操作图标/jjj0.png" border="0" onmouseover="this.src='image/操作图标/jjj.png'" onmouseout="this.src='image/操作图标/jjj0.png'" /></a></td>
<td><a style="width: 100%; height: 100%;" href="#" onclick="PtzCtrlZoomIn();"><img class="yuanda" src="image/操作图标/sxd0.png" border="0" onmouseover="this.src='image/操作图标/sxd.png'" onmouseout="this.src='image/操作图标/sxd0.png'" /></a></td>
<td><a style="width: 100%; height: 100%;" href="#" onclick="PtzCtrlIrisIncrease();"><img class="quanxi" src="image/操作图标/q0.png" border="0" onmouseover="this.src='image/操作图标/q.png'" onmouseout="this.src='image/操作图标/q0.png'" /></a></td>
</tr>
<tr>
<td><a style="width: 100%; height: 100%;" href="#" onclick="PtzCtrlFocusFar();"><img class="fangxiao" src="image/操作图标/jj0.png" border="0" onmouseover="this.src='image/操作图标/jj.png'" onmouseout="this.src='image/操作图标/jj0.png'" /></a></td>
<td><a style="width: 100%; height: 100%;" href="#" onclick="PtzCtrlZoomOut();"><img class="yuanxiao" src="image/操作图标/sxx0.png" border="0" onmouseover="this.src='image/操作图标/sxx.png'" onmouseout="this.src='image/操作图标/sxx0.png'" /></a></td>
<td><a style="width: 100%; height: 100%;" href="#" onclick="PtzCtrlIrisDecrease();"><img class="quanchu" src="image/操作图标/qq0.png" border="0" onmouseover="this.src='image/操作图标/qq.png'" onmouseout="this.src='image/操作图标/qq0.png'" /></a></td></tr>
</table>

<div id="capture">
	<input id="stopR" type="button" style="margin-bottom:3px; width: 100%; padding-top: 2%; cursor: pointer;" onclick="StopRecord()" />
	<input id="Capture" type="button" style="margin-bottom:3px; width: 100%; padding-top: 2%; cursor: pointer;" onclick="SetSnapshotPath();" />
	<input id="videotape" type="button" style="width: 100%; padding-top: 2%; cursor: pointer;" onclick="SetRecordPath();" />
</div>
</form>
</div>
<!--设备管理页面-->
<div id="div_sb">
	<table class="gridtable">
		<tr>
			<th><label id="IsD"></label></th>
			<th><label id="names"></label></th>
			<th><label id="users"></label></th>
			<th><label id="passs"></label></th>
			<th><label id="numbers"></label></th>
			<th><label id="cz"></label></th>
		</tr>
		<tr>
			<td><input id="id" type="text" style="ime-mode: disabled;" /></td>
			<td><input id="name" type="text" maxlength="20"; /></td>
			<td><input id="user" type="text" value=admin /></td>
			<td><input id="pass" type="password" value=admin /></td>
			<td>
				<select id="number">
					<option value="1" selected="selected">1</option>
					<option value="4">4</option>
					<option value="8">8</option>
					<option value="16">16</option>
					<option value="32">32</option>
				</select>
			</td>
			<td><button type="button" id="tj"></button></td>
		</tr>
		
		<?php
		$username= $_COOKIE['name'];
		$conn = mysql_connect('localhost', 'root', '123456') or die("数据库链接出错！");
		mysql_select_db("register");
		$result = mysql_query("SELECT ID,Name,User,Password,Number FROM panel WHERE username='$username'");
		while($row = mysql_fetch_array($result))
  		{
  			echo "<tr><td><label id='ind' style='background:none;' value={$row['ID']}>{$row['ID']}</label></td><td><input id=inn type='text' maxlength=20 value={$row['Name']}></td><td><input id=inu type='text' value={$row['User']}></td><td><input id=inp type='password' value={$row['Password']}></td>
  			<td><select id=inc>
  			<option value='{$row['Number']}' style='display:none;'>{$row['Number']}</option>
  			<option value='1'>1</option>
			<option value='4'>4</option>
			<option value='8'>8</option>
			<option value='16'>16</option>
			<option value='32'>32</option>
			</select></td>
			<td><button id='sure_btn' type='button' style='background:#CCCCCC;' onclick=callup(this)><script>document.write(langtr(sure_btn))</script></button>&nbsp;&nbsp;<button id='dele_btn' type='button' style='background:#CCCCCC;' onclick=deletes(this)><script>document.write(langtr(dele_btn))</script></button></td>
			</tr>";
 		 }
		?>
	</table>
</div>
<!--信息管理页面-->
<div id="Information">
	<div id="mation">
		<p id="mation_text"><script>document.write(langtr(mation_text))</script></p>
		<div class="jhr"></div>
		
		<div id="shuruk1">
			<input id="mimak1" type="password" value="<?php echo htmlentities($password) ?>" />
		</div>
		<img id="ymima" src="image/注册页面/suo.png" />
		<img id="ymima1" src="image/注册页面/suo.png" />
		<div id="shuruk2">
			<input id="mimak2" type="password" placeholder=""  value=""/>
		</div>
		<img id="ymima2" src="image/注册页面/suo.png" />
		<div id="shuruk3">
			<input id="mimak3" type="password" placeholder="" value="" />
		</div>
		<div id="baocun_btn"><button id="bc_btn" type="button"><script>document.write(langtr(bc_btn))</script></button></div>
		
		<p id="mation_text1"><script>document.write(langtr(mation_text1))</script></p>
		<div class="jhr"></div>
		<img id="youxiang" src="image/注册页面/youxiang.png" />
		<div id="shuruk4">
			<input id="mimak4" type="text" value="<?php echo htmlentities($email) ?>" />
		</div>
		<div id="baocun_btn1"><button id="bc_btn1" type="button"><script>document.write(langtr(bc_btn1))</script></button></div>
	</div>
</div>
</body>
</html>
<script language="javascript" type="text/javascript" src="js/anycam_main.js"></script>