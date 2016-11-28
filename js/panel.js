var strChinese = new Array(255);
var strEnglish = new Array(255);
var number;
var g_sbid;				//设备管理页面ID内容为空提示
var g_sbname;				//设备管理页面名称为空提示
var g_sbidno;				//设备管理页面ID不可使用提示
var g_sbidnos;				//设备管理页面ID已使用提示
var g_nameno;				//设备管理页面名称已使用提示
var g_sbyes;				//设备管理页面成功提示
var g_xxp;				//信息管理页面密码内容为空提示
var g_xxps;				//信息管理页面确认密码内容为空提示
var g_xxpss;				//信息管理页面两次密码不一致提示
var g_xxpno;				//信息管理页面密码修改失败提示
var g_xxpyes;				//信息管理页面密码修改成功提示
var g_bcno;				//保存按钮，文本框内容为空提示
var g_bcyes;				//保存成功提示
var g_delete;				//删除成功提示
var g_xxy;				//信息管理页面邮箱内容为空提示
var g_xxys;				//信息管理页面邮箱格式错误提示
var g_xxyno;				//信息管理页面邮箱修改成功提示
var g_xxyyes;				//信息管理页面邮箱无变动，修改失败提示
var g_soundon;				//声音开启
var g_soundoff;				//声音关闭
var g_Microphoneon;			//麦克风开启
var g_Microphoneoff;			//麦克风关闭	

window.onload = function(){
	
	document.getElementById('ss').innerHTML = langtr(ss);
	document.getElementById('sb').innerHTML = langtr(sb);
	document.getElementById('xx').innerHTML = langtr(xx);
	document.getElementById('quit').innerHTML = langtr(quit);
	document.getElementById('down').innerHTML = langtr(down);
	document.getElementById('IsD').innerHTML = langtr(IsD);
	document.getElementById('names').innerHTML = langtr(name);
	document.getElementById('users').innerHTML = langtr(user);
	document.getElementById('passs').innerHTML = langtr(pass);
	document.getElementById('numbers').innerHTML = langtr(number);
	document.getElementById('cz').innerHTML = langtr(cz);
	document.getElementById('tj').innerHTML = langtr(tj);
	document.getElementById('Capture').value = langtr(Capture);
	document.getElementById('videotape').value = langtr(videotape);
	document.getElementById('stopR').value = langtr(stopR);
	document.getElementById('mation_text').innerHTML = langtr(mation_text);
	document.getElementById('bc_btn').innerHTML = langtr(bc_btn);
	document.getElementById('mation_text1').innerHTML = langtr(mation_text1);
	document.getElementById('bc_btn1').innerHTML = langtr(bc_btn1);
	document.getElementById('mimak2').placeholder = langtr(mimak2);
	document.getElementById('mimak3').placeholder = langtr(mimak3);
	document.getElementById('stext').innerHTML = langtr(stext);
	document.getElementById('rtext').innerHTML = langtr(rtext);
	document.getElementById('ctext').innerHTML = langtr(ctext);
	document.getElementById('vtext').innerHTML = langtr(vtext);
	document.getElementById('vtext1').innerHTML = langtr(vtext1);
	document.getElementById('ttext').innerHTML = langtr(ttext);
	document.getElementById('ttext1').innerHTML = langtr(ttext1);
	document.getElementById('cltext').innerHTML = langtr(cltext);
	g_sbid = langtr(g_sbid);
	g_sbname = langtr(g_sbname);
	g_sbidno = langtr(g_sbidno);
	g_sbidnos = langtr(g_sbidnos);
	g_nameno = langtr(g_nameno);
	g_sbyes = langtr(g_sbyes);
	g_xxp = langtr(g_xxp);
	g_xxps = langtr(g_xxps);
	g_xxpss = langtr(g_xxpss);
	g_xxpno = langtr(g_xxpno);
	g_xxpyes = langtr(g_xxpyes);
	g_bcno = langtr(g_bcno);
	g_bcyes = langtr(g_bcyes);
	g_delete = langtr(g_delete);
	g_xxy = langtr(g_xxy);
	g_xxys = langtr(g_xxys);
	g_xxyno = langtr(g_xxyno);
	g_xxyyes = langtr(g_xxyyes);
	g_soundon = langtr(g_soundon);
	g_soundoff = langtr(g_soundoff);
	g_Microphoneon = langtr(g_Microphoneon);
	g_Microphoneoff = langtr(g_Microphoneoff);
	document.getElementById('sure_btn').innerHTML = langtr(sure_btn);
	document.getElementById('dele_btn').innerHTML = langtr(dele_btn);
};

//设备页面数据传输
$(document).ready(function(){
	$('#tj').click(function(){
		if($('#id').val() == ""){
			alert(g_sbid);
		}else if($('#name').val() == ""){
			alert (g_sbname);
		}else{
		var options = $("#number option:selected");
   		number = options.val();
		$.post("encryption.php",
			{id : $('#id').val(), name : $('#name').val(), user : $('#user').val(), pass : $('#pass').val(), number : number, username : g_username},
			   function(data){
				if(data == 7){
			   		alert(g_sbidno);
			   	}else if(data == 1){
					alert (g_sbidnos);
				}else if(data == 2){
					alert(g_nameno);
				}else if(data == 3){
					alert (g_sbyes);
					$('#id').val("");
					$('#name').val("");
					$('#user').val("");
					$('#pass').val("");
					window.location.reload();
				};		
		});
		};
	});
});

//信息管理页面密码重置
$(document).ready(function(){
	$('#bc_btn').click(function(){
		if($('#mimak2').val() == ""){
			alert (g_xxp);
		}else if($('#mimak3').val() == ""){
			alert(g_xxps);
		}else if($('#mimak3').val() != $('#mimak2').val()){
			alert(g_xxpss);
		}else{
			$.post("information.php",
				{ypass : $('#mimak1').val(),xpass : $('#mimak2').val(),g_username : g_username},
				function(data){
					if(data == 1){
						alert(g_xxpno);
					}else if(data == 2){
						alert(g_xxpyes);
						$('#mimak2').val("");
						$('#mimak3').val("");
					  };
			});
		}
	});
});

//设备管理页面缩放
$(document).ready(function(){
	$('#sb').click(function(){
		$('#div_sb').css('display', 'block');
		$('#live').css('display', 'none');
		$('#Information').css('display', 'none');
	});
});

//实时视频
$(document).ready(function(){
	$('#ss').click(function(){
		$('#live').css('display', 'block');
		$('#div_sb').css('display', 'none');
		$('#Information').css('display', 'none');
	});
});

//信息管理页面缩放
$(document).ready(function(){
	$('#xx').click(function(){
		$('#Information').css('display', 'block');
		$('#live').css('display', 'none');
		$('#div_sb').css('display', 'none');
	});
});

//保存
function callup(obj){
	var tr=obj.parentNode.parentNode;
	var td_id=tr.firstChild.firstChild.innerHTML;
	var tt=tr.children;
	var td_nn=tt[1].firstChild.value;
	var td_nu=tt[2].firstChild.value;
	var td_np=tt[3].firstChild.value;
	var td_nc=tt[4].firstChild.value;
	if(tt[1].firstChild.value == "" || tt[2].firstChild.value == "" || tt[3].firstChild.value == ""){
		alert(g_bcno);
	}
	else{
		$.post("save.php",
		   {td_id : td_id, td_nn : td_nn, td_nu : td_nu, td_np : td_np, td_nc : td_nc, username : g_username},
		   function(data){
		   		if(data == 1){
		   			alert (g_bcyes);
				window.location.reload();
		   		}
		   });
	}
};

//删除
function deletes(obj){
	var tr=obj.parentNode.parentNode;
	var td=tr.firstChild.firstChild.innerHTML;
	$.post("delete.php",
		   {td : td, username : g_username},
		   function(data){
		   	if(data == 1){
		   		alert (g_delete);
			window.location.reload();
		   	}
		   });
};

//退出按钮
$(document).ready(function(){
	$('#quit').click(function(){
		window.location = "http://www.sficam.com/";
	});
});



//消息管理页面邮箱地址重置
$(document).ready(function(){
	$('#bc_btn1').click(function(){
		if($("#mimak4").val() == ""){
			alert(g_xxy);
		}
		else if(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test($("#mimak4").val()) == false){
			alert(g_xxys);
		}
		else{
			$.post("reference.php",
			   {xemail : $('#mimak4').val(),g_username : g_username},
			   function(data){
				   if(data == 1){
				   		alert(g_xxyno);
				   }else if(data == 2){
				   		alert(g_xxyyes);
				   };
			});
		}	
	});
});

function show(){
	$("#stext").css("display", "block");
	document.getElementById('img_snap').src="image/操作图标/snap.png";
}

function clears(){
	$("#stext").css("display", "none");
	document.getElementById('img_snap').src="image/操作图标/snap0.png";
}
function rshow(){
	$("#rtext").css("display", "block");
	document.getElementById('img_record').src="image/操作图标/record.png";
}

function rclears(){
	$("#rtext").css("display", "none");
	document.getElementById('img_record').src="image/操作图标/record0.png";
}
function cshow(){
	$("#ctext").css("display", "block");
	document.getElementById('img_close').src="image/操作图标/close.png";
}
function cclears(){
	$("#ctext").css("display", "none");
	document.getElementById('img_close').src="image/操作图标/close0.png";
}
function vshow(){
	$("#vtext").css("display", "block");
	document.getElementById('img_voice').src="image/操作图标/voice.png";
}
function vclears(){
	$("#vtext").css("display", "none");
	document.getElementById('img_voice').src="image/操作图标/voice0.png";
}
function vshow1(){
	$("#vtext1").css("display", "block");
	document.getElementById('img_voice1').src="image/操作图标/voices.png";
}
function vclears1(){
	$("#vtext1").css("display", "none");
	document.getElementById('img_voice1').src="image/操作图标/voices0.png";
}
function tshow(){
	$("#ttext").css("display", "block");
	document.getElementById('img_talk').src="image/操作图标/talk.png";
}
function tclears(){
	$("#ttext").css("display", "none");
	document.getElementById('img_talk').src="image/操作图标/talk0.png";
}
function tshow1(){
	$("#ttext1").css("display", "block");
	document.getElementById('img_talk1').src="image/操作图标/talks.png";
}
function tclears1(){
	$("#ttext1").css("display", "none");
	document.getElementById('img_talk1').src="image/操作图标/talk0s.png";
}
function clshow(){
	$("#cltext").css("display", "block");
	document.getElementById('img_closev').src="image/操作图标/closev.png";
}

function clclears(){
	$("#cltext").css("display", "none");
	document.getElementById('img_closev').src="image/操作图标/closev0.png";
}
function Chang_Sound(val){
	var obj1 = document.getElementById('voice');
	var obj2 = document.getElementById('voice7');
	if(val == 0){
		obj2.style.display = "block";
		obj1.style.display = "none";
		document.form1.glnkViewer.StartSound();
		alert(g_soundon);
	}
	else{
		obj2.style.display = "none";
		obj1.style.display = "block";
		document.form1.glnkViewer.StopSound();
		alert(g_soundoff);
	}
}

function Chang_Phone(val){
	var obj1 = document.getElementById('talk');
	var obj2 = document.getElementById('talk7');
	if(val == 0){
		obj2.style.display = "block";
		obj1.style.display = "none";
		document.form1.glnkViewer.StartInterPhone();
		alert(g_Microphoneon);
	}
	else{
		obj2.style.display = "none";
		obj1.style.display = "block";
		document.form1.glnkViewer.StopInterPhone();
		alert(g_Microphoneoff);
	}
}