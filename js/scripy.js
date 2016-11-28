var stringId;
var strChinese = new Array(255);
var strEnglish = new Array(255);
var id =2;
var g_savee = 1;
var g_znt; 	  		//注册页面用户名内容为空错误提示
var g_zpt;   			//注册页面密码内容为空错误提示
var g_zpst;  			//注册页面密码确认框内容为空错误提示
var g_zpsts;			//注册页面两次密码不一致错误提示
var g_zyt;			//注册页面邮箱框内容为空错误提示
var g_zyts;			//注册页面邮箱格式不正确错误提示
var g_zno;			//注册页面注册失败
var g_zyes;			//注册页面注册成功
var g_mnt;			//忘记密码页面用户名内容为空错误提示
var g_myt;			//忘记密码页面邮箱框内容为空错误提示
var g_myts;			//忘记密码页面邮箱格式不正确错误提示
var g_mno;			//忘记密码页面邮件发送失败
var g_myes;			//忘记密码页面邮件发送成功
var g_ont;			//老用户页面用户名内容为空错误提示
var g_oyt;			//老用户页面邮箱框内容为空错误提示
var g_oyts;			//老用户页面邮箱格式不正确错误提示
var g_oyes;			//老用户页面登录成功
var g_namet;			//登录界面用户名为空提示
var g_passt;			//登录界面密码为空提示
var g_no;				//登录界面登录失败提示

//自动识别浏览器语言
window.onload = function(){
	var type=navigator.appName
	if (type=="Netscape"){
	var lang = navigator.language
	}
	else{
	var lang = navigator.userLanguage
	}
	//取得浏览器语言的前两个字母
	var lang = lang.substr(0,2)
	// 英语
	if (lang == "zh"){
	id = 2;
	}
	// 中文 - 不分繁体和简体
	else{
	id = 1;
	var txt = $('#1').text();
	$('#yuyan').html(txt);
	}
	document.getElementById("head").innerHTML = langtr(head);
	document.getElementById("save").innerHTML = langtr(save);
	document.getElementById("zhuce").innerHTML = langtr(zhuce);
	document.getElementById("wangjimima").innerHTML = langtr(wangji);
	document.getElementById("login").innerHTML = langtr(button);
	document.getElementById("name").placeholder = langtr(username);
	document.getElementById("password").placeholder = langtr(password);
	document.getElementById("old_user").innerHTML = langtr(old_user);
	//注册页面
	document.getElementById("zhuce_head").innerHTML = langtr(zhuce_head);
	document.getElementById("bctxt").innerHTML = langtr(bctxt);
	document.getElementById("qxtxt").innerHTML = langtr(qxtxt);
	document.getElementById("zhuce_name").placeholder = langtr(zhuce_name);
	document.getElementById("zhuce_pass").placeholder = langtr(zhuce_pass);
	document.getElementById("zhuce_passs").placeholder = langtr(zhuce_passs);
	document.getElementById("zhuce_youxiang").placeholder = langtr(zhuce_youxiang);
	//忘记密码页面
	document.getElementById("mima_head").innerHTML = langtr(mima_head);
	document.getElementById("sure").innerHTML = langtr(sure);
	document.getElementById("qxtext").innerHTML = langtr(qxtext);
	document.getElementById("mima_name").placeholder = langtr(mima_name);
	document.getElementById("mima_yx").placeholder = langtr(mima_youxiang);
	//老用户页面
	document.getElementById("old_head").innerHTML = langtr(old_head);
	document.getElementById("old_name").placeholder = langtr(old_name);
	document.getElementById("old_yx").placeholder = langtr(old_yx);
	document.getElementById("old_sure").innerHTML = langtr(old_sure);
	document.getElementById("qxtexts").innerHTML = langtr(qxtexts);
	g_znt = langtr(g_zhuce_name_text);
	g_zpt = langtr(g_zhuce_pass_text);
	g_zpst = langtr(g_zhuce_passs_text);
	g_zpsts = langtr(g_zhuce_passss_text);
	g_zyt = langtr(g_zhuce_youxiang_text);
	g_zyts = langtr(g_zhuce_youxiangs_text);
	g_zno = langtr(g_zhuce_no_text);
	g_zyes = langtr(g_zhuce_yes_text);
	g_mnt = langtr(g_mima_name_text);
	g_myt = langtr(g_mima_youxiang_text);
	g_myts = langtr(g_mima_youxiangs_text);
	g_mno = langtr(g_mima_no_text);
	g_myes = langtr(g_mima_yes_text);
	g_ont = langtr(g_old_name_text);
	g_oyt = langtr(g_old_youxiang_text);
	g_oyts = langtr(g_old_youxiangs_text);
	g_oyes = langtr(g_old_yes_text);
	g_namet = langtr(g_name_text);
	g_passt = langtr(g_pass_text);
	g_no = langtr(g_no_text);
}

//语言切换
jQuery.divselect = function(divselectid,inputselectid) {
	$(divselectid+" cite").click(function(){
		var ul = $(divselectid+" ul");
		if(ul.css("display")=="none"){
			ul.slideDown("fast");
		}else{
			ul.slideUp("fast");
		}
	});
	$(divselectid+" ul li a").click(function(){
		 id = $(this).attr("id");
		 var txt = $(this).text();
		$(divselectid+" cite").html(txt);
		$(divselectid+" ul").hide();
		document.getElementById("head").innerHTML = langtr(head);
		document.getElementById("save").innerHTML = langtr(save);
		document.getElementById("zhuce").innerHTML = langtr(zhuce);
		document.getElementById("wangjimima").innerHTML = langtr(wangji);
		document.getElementById("login").innerHTML = langtr(button);
		document.getElementById("name").placeholder = langtr(username);
		document.getElementById("password").placeholder = langtr(password);
		document.getElementById("old_user").innerHTML = langtr(old_user);
	//注册页面
		document.getElementById("zhuce_head").innerHTML = langtr(zhuce_head);
		document.getElementById("bctxt").innerHTML = langtr(bctxt);
		document.getElementById("qxtxt").innerHTML = langtr(qxtxt);
		document.getElementById("zhuce_name").placeholder = langtr(zhuce_name);
		document.getElementById("zhuce_pass").placeholder = langtr(zhuce_pass);
		document.getElementById("zhuce_passs").placeholder = langtr(zhuce_passs);
		document.getElementById("zhuce_youxiang").placeholder = langtr(zhuce_youxiang);
	//忘记密码页面
		document.getElementById("mima_head").innerHTML = langtr(mima_head);
		document.getElementById("sure").innerHTML = langtr(sure);
		document.getElementById("qxtext").innerHTML = langtr(qxtext);
		document.getElementById("mima_name").placeholder = langtr(mima_name);
		document.getElementById("mima_yx").placeholder = langtr(mima_youxiang);
	//老用户页面
		document.getElementById("old_head").innerHTML = langtr(old_head);
		document.getElementById("old_name").placeholder = langtr(old_name);
		document.getElementById("old_yx").placeholder = langtr(old_yx);
		document.getElementById("old_sure").innerHTML = langtr(old_sure);
		document.getElementById("qxtexts").innerHTML = langtr(qxtexts);
		g_znt = langtr(g_zhuce_name_text);
		g_zpt = langtr(g_zhuce_pass_text);
		g_zpst = langtr(g_zhuce_passs_text);
		g_zpsts = langtr(g_zhuce_passss_text);
		g_zyt = langtr(g_zhuce_youxiang_text);
		g_zyts = langtr(g_zhuce_youxiangs_text);
		g_zno = langtr(g_zhuce_no_text);
		g_zyes = langtr(g_zhuce_yes_text);
		g_mnt = langtr(g_mima_name_text);
		g_myt = langtr(g_mima_youxiang_text);
		g_myts = langtr(g_mima_youxiangs_text);
		g_mno = langtr(g_mima_no_text);
		g_myes = langtr(g_mima_yes_text);
		g_ont = langtr(g_old_name_text);
		g_oyt = langtr(g_old_youxiang_text);
		g_oyts = langtr(g_old_youxiangs_text);
		g_oyes = langtr(g_old_yes_text);
		g_namet = langtr(g_name_text);
		g_passt = langtr(g_pass_text);
		g_no = langtr(g_no_text);
		return ;
	});
	$(document).click(function(){
		$(divselectid+" ul").hide();
	});
};

function langtr(stringId)
{
if(id == 2){
		$("input[name='yy']").val('zh');
		return strChinese[stringId];
	}
	else if(id == 1){
		$("input[name='yy']").val('en');
		return strEnglish[stringId]; 
	};
};



//勾选框
function changeImage(){
	element = document.getElementById('gx')
	if(element.src.match("danxuankuangin"))
	{
		element.src="image/danxuankuang.png";
		g_savee = 0;
	}
	else
	{
		element.src="image/danxuankuangin.png";
		g_savee = 1;
	};
};

//注册
function changeImage1(){
	$('#div_zhuce').css('display','block');
	$('#yc').css('display','none');
};

//注册页面取消按钮
function clears(){
	$('#div_zhuce').css('display','none');
	$('#yc').css('display','block');
};

//忘记密码
function changeImage2(){
	$('#div_mima').css('display','block'); 
	$('#yc').css('display','none');
};

//忘记密码页面取消按钮
function guanbi(){
	$('#div_mima').css('display','none');
	$('#yc').css('display','block');
};

//老用户
function show_box(){
	$('#div_old').css('display','block');
	$('#yc').css('display','none');
	$('#div_zhuce').css('display','none');
	$('#div_mima').css('display','none');
};

//老用户页面取消按钮
function guanbi1(){
	$('#div_old').css('display','none');
	$('#yc').css('display','block');
};

//老用户激活入口
$(document).ready(function(){
	$('#old_queding').click(function(){
		if($('#old_name').val() == ""){
			alert(g_ont);
		}else if($('#old_yx').val() == ""){
			alert(g_oyt);
		}else if(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test($('#old_yx').val()) == false){
			alert(g_oyts);
		}else{
			$.get("olduser.php",
			  {name : $("#old_name").val(),yx : $("#old_yx").val()},
			  function(data){
				  if(data == 1){
			  	  alert(g_oyes);
				  $('#div_old').css('display','none');
				  $("#old_name").val("");
				  $("#old_yx").val("");
				  $('#yc').css('display','block');
			  	  }
			  });
		};
	});
});

//注册信息保存
$(document).ready(function(){
	$('#bctxt').click(function(){
		if($('#zhuce_name').val() == ""){
			alert(g_znt);
		}else if($('#zhuce_pass').val() == ""){
			alert(g_zpt);
		}else if($('#zhuce_passs').val() == ""){
			alert(g_zpst);
		}else if($('#zhuce_passs').val() != $('#zhuce_pass').val()){
			alert(g_zpsts);
		}else if($('#zhuce_youxiang').val() == ""){
			alert(g_zyt);
		}else if(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test($('#zhuce_youxiang').val()) == false){
			alert(g_zyts);
		}else{
		$.post("reg.php",
			   {username : $("#zhuce_name").val(),password : $("#zhuce_pass").val(),email : $("#zhuce_youxiang").val(),video : $("#zhuce_luxiang").val(),picture : $("#zhuce_zhaoxiang").val()},
			   function(data){
			   		if(data == 1){
			   			alert(g_zno);
			   		}else if(data == 2){
			   			alert(g_zyes);
			   			$('#div_zhuce').css('display','none');
					$("#zhuce_name").val("");
					$("#zhuce_pass").val("");
					$("#zhuce_passs").val("");
					$("#zhuce_youxiang").val("");
					$("#zhuce_luxiang").val("d:/video/");
					$("#zhuce_zhaoxiang").val("d:/picture/");
					$('#yc').css('display','block');
			   		}
			   });
		};
	});
});

//登录查询验证
$(document).ready(function(){
	$('#denglu_button').click(function(){
		if($('#name').val() == ""){ 
			alert(g_namet);
		}else if($('#password').val() == ""){
			alert(g_passt);
		}else{
		$.post("select.php",
				{username : $("#name").val(),password : $("#password").val()},
				function(data){
					if(data == "True"){
						str_num();
						str_id();
						window.location = "panel.php";
					}
					else{
						alert(g_no);
					};
		});
		};
	});
});

//忘记密码页面邮件发送
$(document).ready(function(){
	var N;
	$('#mima_queding').click(function(){
		if($('#mima_name').val() == ""){
			alert(g_mnt);
		}else if($('#mima_yx').val() == ""){
			alert(g_myt);
		}else if(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test($('#mima_yx').val()) == false){
			alert(g_myts);
		}else{
		$.post("email.php",
			   {username : $("#mima_name").val(),email : $("#mima_yx").val()},
			   function(data){
			   		if(data == 1){
			   			alert(g_mno);
			   		}else if(data == 2){
			   			alert(g_myes);
					$('#div_mima').css('display','none');
					$("#mima_name").val("");
					$("#mima_yx").val("");
					$('#yc').css('display','block');
			   		};
			   });
		};
	});
});

//回车
$(document).ready(function(){
		document.onkeydown = function(e){
			e = e || window.event;
			if(e.keyCode == 13){
				if($('#yc').css('display') == 'block'){
					$('#denglu_button').click();
				}
			}
		}
});

//cookie
function str_num(){
	if(g_savee == 1){
		var str_username = $("#name").val();
		var str_password = $("#password").val();
		$.cookie("rmbUser", "true", { expires: 7 });
		$.cookie("username", str_username, { expires: 7 });
		$.cookie("password", str_password, { expires: 7 });
	}
	else{
		$.cookie("rmbUser", "false", { expires: -1 });
		$.cookie("username", "", { expires: -1 });
		$.cookie("password", "", { expires: -1 });
	}
};

function str_id(){
	var str_yuyan = id;
	var str_name = $("#name").val();
	$.cookie("yuyan", str_yuyan, { expires: 7 });
	$.cookie("name", str_name, { expires: 7 });
};