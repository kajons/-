/*
   说明：打开视频函数
   参数：
   DeviceID：设备ID
   Channel： 通道号
   UserName：设备用户
   UserPwd： 设备密码
   ServerUrl：Gooserver服务器IP或域名
   ServerPort:Gooserver服务器端口
   DeviceName：设备别名
   Lang:      语言
   StreamType: 码流类别  0=主码流 1=次码流


*/

function startVideo(DeviceID,Channel,UserName,UserPwd,ServerUrl,ServerPort,DeviceName,Lang,StreamType)
{
	
	var lg=Lang;

   //stopVideo();
   var token="Dn8APSK\/hgcv6f2CZcf8sROkgbE2AzcUXi9IPg==";  //测试token，不要用到实际应用中，测试结束这个值无效

    document.form1.glnkViewer.setCurLanguage(lg);

	document.form1.glnkViewer.SetCurWndIndex(0);

	document.form1.glnkViewer.startVideo(DeviceID,Channel,UserName,UserPwd,ServerUrl,ServerPort,DeviceName,token);
	//设置视频码流，主码流或者次码流
	document.form1.glnkViewer.SetStreamType(StreamType);

}



//设置视频码流，主码流或者次码流
function SetStreamType(StreamType)
{
   document.form1.glnkViewer.SetStreamType(StreamType);
}

function stopVideo()
{
	var intWndID=document.form1.glnkViewer.GetCurWndIndex();
	//intWndID=intWndID-1;
	document.form1.glnkViewer.SetCurWndIndex(intWndID);
    document.form1.glnkViewer.stopVideo();
}

function stopAllVideo()
{
	document.form1.glnkViewer.StopAllVideo();	
}


function StartSound()
{
   document.form1.glnkViewer.StartSound();
}

function StopSound()
{
   document.form1.glnkViewer.StopSound();
}


function StartInterPhone()
{
   document.form1.glnkViewer.StartInterPhone();
}

function StopInterPhone()
{
   document.form1.glnkViewer.StopInterPhone();
}

/*
function Snapshot(path)
{
   document.form1.glnkViewer.SetSnapshotPath(path);
   document.form1.glnkViewer.Snapshot();
}
*/

function Snapshot()
{   
   document.form1.glnkViewer.Snapshot();
}


/*
function StartRecord(path)
{
	
   document.form1.glnkViewer.SetRecordPath(path);
   document.form1.glnkViewer.StartRecord();
}
*/

function StartRecord()
{
   document.form1.glnkViewer.StartRecord();
}


function StopRecord()
{
   document.form1.glnkViewer.StopRecord();
}

function SetCurLanguage(lg)
{
   document.form1.glnkViewer.SetCurLanguage(lg);
}

function SetPtzSpeed(speed)
{
   document.form1.glnkViewer.SetPtzSpeed(speed);
}

function PtzCtrlUp()
{
   document.form1.glnkViewer.PtzCtrlUp();
}

function PtzCtrlDown()
{
   document.form1.glnkViewer.PtzCtrlDown();
}

function PtzCtrlLeft()
{
   document.form1.glnkViewer.PtzCtrlLeft();
}

function PtzCtrlRight()
{
   document.form1.glnkViewer.PtzCtrlRight();
}

function PtzCtrlStop()
{
   document.form1.glnkViewer.PtzCtrlStop();
}

function PtzCtrlReset()
{
   document.form1.glnkViewer.PtzCtrlReset();
}

function PtzCtrlZoomIn()
{
   document.form1.glnkViewer.PtzCtrlZoomIn();
}

function PtzCtrlZoomOut()
{
   document.form1.glnkViewer.PtzCtrlZoomOut();
}

function PtzCtrlIrisDecrease()
{
   document.form1.glnkViewer.PtzCtrlIrisDecrease();
}

function PtzCtrlIrisIncrease()
{
   document.form1.glnkViewer.PtzCtrlIrisIncrease();
}

function PtzCtrlFocusNear()
{
   document.form1.glnkViewer.PtzCtrlFocusNear();
}

function PtzCtrlFocusFar()
{
   document.form1.glnkViewer.PtzCtrlFocusFar();
}

function SetCurWndIndex(index)
{
   document.form1.glnkViewer.SetCurWndIndex(index);
}
//设置当前窗口（从0开始）
function GetCurWndIndex()
{
   document.form1.glnkViewer.GetCurWndIndex();
}
//设置显示模式（几画面）
function SetPlayWndModel(mode)
{
   document.form1.glnkViewer.SetPlayWndModel(mode);
}

function GetPlayWndModel()
{
   document.form1.glnkViewer.GetPlayWndModel();
}

function SetSnapshotPath(path)
{
   document.form1.glnkViewer.SetSnapshotPath(path);
}

function SetRecordPath(path)
{
   document.form1.glnkViewer.SetRecordPath(path);
}

function SetFullScreen(la)
{
   document.form1.glnkViewer.SetFullScreen(la);
}



//开始新接口************************************

/*void			SetSnapshotPath(void);		//设置抓拍路径
	void			SetRecordPath(void);		//设置录像路径 
	void			SetDownloadPath(void);		//设置下载路径
	LONG			OpenSearch(LPCTSTR p_pszDeviceID, LONG p_nChannel, LPCTSTR p_pszUserName, LPCTSTR p_pszPassword, LPCTSTR p_pszServerUrl, LONG p_nServerPort);     //打开搜索
	LONG			CloseSearch(LPCTSTR p_pszDeviceID, LONG p_nChannel); //关闭搜索
	LONG			SearchRecFile(LPCTSTR p_pszBegin, LPCTSTR p_pszEnd, LONG p_nRecType);//搜索文件
	BSTR			GetRecFileList();		//获取录像文件列表
	LONG			DownloadRecFile(LPCTSTR p_szRecFileName);		//下载录像文件
	LONG			GetDownloadPercent(void);				//获取下载进度百分比

	//
	BSTR			GetSnapshotPath(void);		//获取抓拍路径
	BSTR			GetRecordPath(void);		//获取录像存储路径 
	BSTR			GetDownloadPath(void);		//获取下载录像路径
*/	

//设置抓拍路径
function SetSnapshotPath()
{
     document.form1.glnkViewer.SetSnapshotPath();
}


//设置录像路径
function SetRecordPath()
{
     document.form1.glnkViewer.SetRecordPath();
}

//设置下载路径
function SetDownloadPath()
{
     document.form1.glnkViewer.SetDownloadPath();
}

//获取抓拍路径
function GetSnapshotPath()
{
     document.form1.glnkViewer.GetSnapshotPath();
}


//获取录像路径
function GetRecordPath()
{
     document.form1.glnkViewer.GetRecordPath();
}

//获取下载路径
function GetDownloadPath()
{
     document.form1.glnkViewer.GetDownloadPath();
}



function sleep(sleepTime) {
       for(var start = Date.now(); Date.now() - start <= sleepTime; ) { } 
}


//测试查询录像
function TestOpenSearch(DeviceID,Channel,UserName,Pwd,ServerUrl,ServerPort,p_pszBegin, p_pszEnd, p_nRecType)
{
	 
	var token="Dn8APSK\/hgcv6f2CZcf8sROkgbE2AzcUXi9IPg==";  //测试token，不要用到实际应用中,测试结束，这个值无效

   $("#info").html("");//清空info内容
   $("#info").append("正在查询，请等待！");
   alert("test opensearch: deviceid="+DeviceID+" Channel="+Channel+"username="+UserName+"pwd="+Pwd+"url="+ServerUrl+"port="+ServerPort+"begin="+p_pszBegin+"end="+p_pszEnd+"type="+p_nRecType); 
   OpenSearch(DeviceID,Channel,UserName,Pwd,ServerUrl,ServerPort,token);
  
   SearchRecFile(p_pszBegin, p_pszEnd, p_nRecType);
   //sleep(10);
   //alert("延迟10秒")
   var j=document.form1.glnkViewer.GetRecFileList();
   var file = jQuery.parseJSON(j);
   

   $("#info").html("");//清空info内容
   alert("ret="+file.ret);
  
  
   if(file.ret=="0")
   {
	   alert("重新查询");      
  
      SearchRecFile(p_pszBegin, p_pszEnd, p_nRecType);

	  j=document.form1.glnkViewer.GetRecFileList();
      file = jQuery.parseJSON(j);
   }
   for(var i = 0; i < file['filelist'].length; i++)
  {

      alert(file['filelist'][i].id + " " +file['filelist'][i].filename);
	  $("#info").append("录像文件名：<a href=# onclick=\"DownloadRecFile('"+file['filelist'][i].filename+"')\">"+file['filelist'][i].filename+"<br>");

  }


  
   /*alert("设置下载目录 d:/video/");
   document.form1.glnkViewer.SetDownloadPath("d:/video/");
   alert("下载文件704x576x8sxiaoxu.h264");
   var ret=document.form1.glnkViewer.DownloadRecFile("704x576x8sxiaoxu.h264");
   */
 
}


//查询录像
function OpenSearch(DeviceID,Channel,UserName,Pwd,ServerUrl,ServerPort,token)
{
      //OpenSearch(LPCTSTR p_pszDeviceID, LONG p_nChannel, LPCTSTR p_pszUserName, LPCTSTR p_pszPassword, LPCTSTR p_pszServerUrl, LONG p_nServerPort);
    document.form1.glnkViewer.OpenSearch(DeviceID,Channel,UserName,Pwd,ServerUrl,ServerPort,token);
}



//按时间段查询录像
function SearchRecFile(p_pszBegin, p_pszEnd, p_nRecType)
{	
     document.form1.glnkViewer.SearchRecFile(p_pszBegin, p_pszEnd, p_nRecType);
}

/*获取录像文件列表，返回的是字符串JSON
// 获取失败会返回 如：{"ret":-2}   ，-2表示打开设备失败，  -1：表示正在接收，  0：表示搜索文件个数为空 ，X：其它值表示文件个数
//如果文件个数大于0，后面跟着相应的列表信息
//如：

//     {"ret":2,
		"filelist":
		[
		{"id":1,"filename":"v1.h264","channel":1,"starttime":"2014-08-15 01:02:03","endtime":"2014-08-15 01:05:03","length":1024,"type":1,"frames":25}, 
		{"id":1,"filename":"v1.h264","channel":1,"starttime":"2014-08-15 01:02:03","endtime":"2014-08-15 01:05:03","length":1024,"type":1,"frames":25}
		]
		}	
	LONG			GetRecFileList(BSTR* p_szRecFileList);
*/
function GetRecFileList()
{
     document.form1.glnkViewer.GetRecFileList();
}

//需要下载的录像文件名，下载存储到指定的目录，文件名同下载的文件名相同
//LONG			DownloadRecFile(LPCTSTR p_szRecFileName);
function DownloadRecFile( p_szRecFileName)
{
     document.form1.glnkViewer.DownloadRecFile(p_szRecFileName);
	 //获取进度
      $("#Percent").html("");//清空info内容
	  $("#Percent").html("下载进度");//清空info内容		 
      sleep(1);
	  var d= document.form1.glnkViewer.GetDownloadPercent();
	  alert("Prrcent="+d);
	  while(d<100)	  
	  {
	       d= document.form1.glnkViewer.GetDownloadPercent();
		   $("#Percent").html("");//清空info内容
	       $("#Percent").html("下载进度"+d);//清空info内容	
            sleep(1);
	  }

	 
}

//搜索下载完录像之后需要关闭连接设备
//	LONG			CloseSearch(LPCTSTR p_pszDeviceID, LONG p_nChannel);
function CloseSearch(p_pszDeviceID,p_nChannel)
{
     document.form1.glnkViewer.CloseSearch(p_pszDeviceID, p_nChannel);
}





//以下测试用**************************************************************
function loadInfo() {
    $.getJSON("loadInfo", function(data) {
        $("#info").html("");//清空info内容
        $.each(data.comments, function(i, item) {
            $("#info").append(
                    "<div>" + item.id + "</div>" + 
                    "<div>" + item.nickname    + "</div>" +
                    "<div>" + item.content + "</div><hr/>");
        });
        });
}


function showJSON() {    
   var file=
	   {
	   "ret":2,
	   "filelist":
	   [
		   {"id":1,"filename":"704x576x8s.h264","channel":1,"starttime":"2014-04-21 12:31:00","endtime":"2014-04-21 12:10:00","length":4096,"type":1,"frames":1},
		   {"id":1,"filename":"704x576x8sxiaoxu.h264","channel":1,"starttime":"2014-04-21 12:31:00","endtime":"2014-04-21 12:10:00","length":4096,"type":1,"frames":1}
	   ]
	   }

  // $("#info").html("");//清空info内容
  //$("#info").append(j);
  
  var obj=eval(file);


for(var i = 0; i < file['filelist'].length; i++){

   alert(file['filelist'][i].id + " " +file['filelist'][i].filename);

}


    
}   