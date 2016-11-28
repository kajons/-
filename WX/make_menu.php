<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TITLE>菜单添加/修改</TITLE>

</HEAD>
<body>
<?php
//创建菜单类
class make_menu
{
    
    private $mc=null;
    
	private $ch=null;
    
    private $AppId="wx70c68f31057d452a";
    
    private $AppSecret="642f176ab39d3f530e14afdebf585618";
    
    //echo "两个参数的初始化，缓冲 memcache 和 curl";

    //初始化缓存、抓取类
    function __construct(){

        $this->ch = curl_init();

        //创建一个memcached对象
        $this->mc = new Memcache;

        //链接到memcached服务
        if(!$this->mc->connect('127.0.0.1',12000)){
            die('memcache链接失败');
        }
	}
    
    //获取token
    function get_access_token()
    {
        //监测token缓存是否有效
        if($this->mc->get("mp_access_token"))
        {
            $access_token= $this->mc->get("mp_access_token");
        
        }
        else
        {
            //获取token，页面地址为https://api.weixin.qq.com/cgi-bin/token
            curl_setopt($this->ch,CURLOPT_URL,"https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->AppId."&secret=".$this->AppSecret);
            curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
            $rst=curl_exec($this->ch);
            if(curl_errno($this->ch)) 
            {
                echo curl_error($this->ch);
                exit;
            }
             else 
            {
               //抓取页面成功，先将抓取的数据转换成数组；
                $rst=json_decode($rst,true);
                 
                 //如果授权失败打印错误代码
                if($rst["errcode"]!=0)
                {
                    echo "获取token失败，错误提示为：".$rst["errmsg"]."，错误代码编号为：".$rst["errcode"];
                    echo "<br><a href='http://mp.weixin.qq.com/wiki/index.php?title=%E8%BF%94%E5%9B%9E%E7%A0%81%E8%AF%B4%E6%98%8E' target='_blank'>错误代码对照表</a>";
                    exit;	
                }
                 //授权成功则将token和过期时间缓存
                else
                {
                    $access_token=$rst["access_token"];
                    $expires_in=$rst["expires_in"];
                    
                    //将获得的token保存到缓存里,过期时间设定为获取的过期时间-60秒
                    
                    $this->mc->set("mp_access_token", $access_token, 0, $expires_in-60);
                }
                     
             }
            
        }
        //返回token
        return $access_token;
 
    }
    //创建菜单
    function create_new_menu($menu)
    {
    	
          curl_setopt_array(
            $this->ch,
            array(
              CURLOPT_URL=>'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->get_access_token(),
              CURLOPT_RETURNTRANSFER=>true,
              CURLOPT_POST=>true,
              CURLOPT_POSTFIELDS=>$menu
            )
          );
        	$rst=curl_exec($this->ch);
            if(curl_errno($this->ch)) 
            {
                echo curl_error($this->ch);
                exit;
            }
             else 
            {
               //抓取页面成功，先将抓取的数据转换成数组；
                $rst=json_decode($rst,true);
                 
                 //如果创建失败打印错误代码
                if($rst["errcode"]!=0)
                {
                    echo "创建菜单失败，错误提示为：".$rst["errmsg"]."，错误代码编号为：".$rst["errcode"];
                    echo "<br><a href='http://mp.weixin.qq.com/wiki/index.php?title=%E8%BF%94%E5%9B%9E%E7%A0%81%E8%AF%B4%E6%98%8E' target='_blank'>错误代码对照表</a>";
                    exit;	
                }
                else
                {
                    echo "创建成功！";
                }
                     
             }
    
    }
    
    //查询菜单
    function get_menu()
    {
    
            //获取token，页面地址为https://api.weixin.qq.com/cgi-bin/token
            curl_setopt($this->ch,CURLOPT_URL,"https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$this->get_access_token());
            curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
            $rst=curl_exec($this->ch);
            if(curl_errno($this->ch)) 
            {
                echo curl_error($this->ch);
                exit;
            }
             else 
            {
               //抓取页面成功，先将抓取的数据转换成数组；
                $rst=json_decode($rst,true);
                 
             }
        	return $rst;
    
    
    }
    //删除菜单
    function del_menu()
    {
    
            //获取token，页面地址为https://api.weixin.qq.com/cgi-bin/token
            curl_setopt($this->ch,CURLOPT_URL,"https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$this->get_access_token());
            curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
            $rst=curl_exec($this->ch);
            if(curl_errno($this->ch)) 
            {
                echo curl_error($this->ch);
                exit;
            }
             else 
            {
               //抓取返回数据；
                $rst=json_decode($rst, true);
                 
                 //如果删除失败打印错误代码
                if($rst["errcode"]!=0)
                {
                    echo "删除菜单失败，错误提示为：".$rst["errmsg"]."，错误代码编号为：".$rst["errcode"];
                    echo "<br><a href='http://mp.weixin.qq.com/wiki/index.php?title=%E8%BF%94%E5%9B%9E%E7%A0%81%E8%AF%B4%E6%98%8E' target='_blank'>错误代码对照表</a>";
                    exit;	
                }
                 
                else
                {
                    echo "删除成功！";
                }
                     
             }
    
    }

}


include_once("base-class.php");

//获取操作标识传入
$action=$_REQUEST["action"];
$action= string::un_script_code($action);
$action= string::un_html($action);

if($action=="update")
{
    //创建菜单数组
    $menu=array();
    //循环三次添加菜单
	for($i=1;$i<=3;$i++)
    {
        //初始化单个菜单数组
        $temp_menu=array();
        //获取主菜单名
        $menu_name=$_POST["main_menu_".$i."_name"];
        //如果主菜单名称存在
        if($menu_name)
        {
            //如果有子菜单
        	if($_POST["sub_menu_".$i])
            {
                $temp_sub_menu=array();
            	$sub_menu=explode("\n",$_POST["sub_menu_".$i]);
                foreach($sub_menu as $value)
                {
                    $value=explode(",",$value);
                    if($value[0] && $value[1])
                    {
                        if($value[2]==1)
                        {
                             $temp_sub_menu[]=array(
                                 "type"=>"view",
                                 "name"=>urlencode($value[0]),
                                 "url"=>urlencode($value[1])
                            );
                        }
                        else
                        {
                             $temp_sub_menu[]=array(
                                 "type"=>"click",
                                 "name"=>urlencode($value[0]),
                                 "key"=>urlencode($value[1])
                            );
                        }
                    }
                }
                //判断子菜单是否是5个
                if(count($temp_sub_menu)>5)
                {
                	echo "<script>alert('子菜单最多5个');history.back();</Script>";
                    exit;
                
                }
            	$temp_menu=array(
         		 "name"=>urlencode($menu_name),
         		 "sub_button"=>$temp_sub_menu
                );
            }
            else
            {
                if($_POST["main_menu_".$i."_key"])
                {
                    $temp_menu=array(
                     "type"=>"click",
                     "name"=>urlencode($menu_name),
                     "key"=>urlencode($_POST["main_menu_".$i."_key"])
                    );
                
                }
                else
                {
                    $temp_menu=array(
                     "type"=>"view",
                     "name"=>urlencode($menu_name),
                     "url"=>urlencode($_POST["main_menu_".$i."_url"])
                    );
                }
            }
        
        }
        $menu["button"][]=$temp_menu;
    
    }
    $mk_menu=new make_menu();
   	$mk_menu->del_menu();
    $mk_menu->create_new_menu(urldecode(json_encode($menu,true)));
    
   
    echo "<script>alert('菜单创建成功，请将公众账号取消再关注后查看效果！');history.back();</Script>";
    exit;
}
else
{
	//获取菜单
    $mk_menu=new make_menu();
	$menu=$mk_menu->get_menu();
    //如果获取失败打印错误代码
    if($menu["errcode"]!=0)
    {
        echo "还没有设置过菜单！";
    }
    else
    {
        $menu_ary=array();
        foreach($menu["menu"]["button"] as $key=>$value)
        {
            //如果菜单项为点击菜单
            if($value["key"] || $value["url"])
            {
                $menu_ary["main_menu_".($key+1)."_name"]=urldecode($value["name"]);
                $menu_ary["main_menu_".($key+1)."_key"]=urldecode($value["key"]);
                $menu_ary["main_menu_".($key+1)."_url"]=urldecode($value["url"]);
            }
            //如果有子菜单
            else
            {
                $menu_ary["main_menu_".($key+1)."_name"]=urldecode($value["name"]);
                $temp_sub_menu_ary=array();
                foreach($value["sub_button"] as $svalue)
                {
                    if($svalue["key"])
                    {
                    	$submenu_type=urldecode($svalue["key"]).",0";
                    }
                    if($svalue["url"])
                    {
                    	$submenu_type=urldecode($svalue["url"]).",1";
                    }
                    
                    $temp_sub_menu_ary[]=urldecode($svalue["name"]).",".$submenu_type;
                }
                $menu_ary["sub_menu_".($key+1)]=implode("\n",$temp_sub_menu_ary);
            
            }
        
        }
    }

}
?>

<!--页面名称-->
<h2>菜单添加/修改</h2>
<h3>如果填写了子菜单则主菜单的关键字无效</h3>
<h4>子菜单的类型判断：1为view，0为click</h4>
<!--表单开始-->
<form action="?" method="post" name="menu_add" id="menu_add" >
    <div id="menu">
        <p>
            <span>主菜单一名称：</span>

            <input type="text" value="<?php echo $menu_ary["main_menu_1_name"];?>" name="main_menu_1_name">
        </p>

        <p>
            <span>主菜单一关键字：</span>

            <input type="text" value="<?php echo $menu_ary["main_menu_1_key"];?>" name="main_menu_1_key">
        </p>

        <p>
            <span>主菜单一连接：</span>
            <input type="text" value="<?php echo $menu_ary["main_menu_1_url"];?>" name="main_menu_1_url">
        </p>
        <p>
            <span>子菜单一：</span>
            <textarea name="sub_menu_1" cols=30 style="height:100px;"><?php echo $menu_ary["sub_menu_1"];?></textarea>
             <br><strong>格式：菜单名,关键字,类型判断，例如：每日一歌,v,0，多个子菜单换行即可，最多5个子菜单</strong>
       </p>
    
        <p>
            <span>主菜单二名称：</span>
            <input type="text" value="<?php echo $menu_ary["main_menu_2_name"];?>" name="main_menu_2_name">
        </p>
        <p>
            <span>主菜单二关键字：</span>
            <input type="text" value="<?php echo $menu_ary["main_menu_2_key"];?>" name="main_menu_2_key">
        </p>
         <p>
            <span>主菜单二连接：</span>
            <input type="text" value="<?php echo $menu_ary["main_menu_2_url"];?>" name="main_menu_2_url">
        </p>
       <p>
            <span>子菜单二：</span>
            <textarea name="sub_menu_2" cols=30  style="height:100px;">><?php echo $menu_ary["sub_menu_2"];?></textarea>
            <br><strong>格式：菜单名,关键字,类型判断，例如：每日一歌,v,0，多个子菜单换行即可，最多5个子菜单</strong>
        </p>

        <p>
            <span>主菜单三名称：</span>
            <input type="text" value="<?php echo $menu_ary["main_menu_3_name"];?>" name="main_menu_3_name">
        </p>
        <p>
            <span>主菜单三关键字：</span>
            <input type="text" value="<?php echo $menu_ary["main_menu_3_key"];?>" name="main_menu_3_key">
        </p>
        <p>
            <span>主菜单三连接：</span>
            <input type="text" value="<?php echo $menu_ary["main_menu_3_url"];?>" name="main_menu_3_url">
        </p>
        <p>
            <span>子菜单三：</span>
            <textarea name="sub_menu_3" cols=30  style="height:100px;">><?php echo $menu_ary["sub_menu_3"];?></textarea>
            <br><strong>格式：菜单名,关键字,类型判断，例如：每日一歌,v,0，多个子菜单换行即可，最多5个子菜单</strong>
        </p>

        <p>
            <input type="hidden" name="action"  value="update">
            <input type="submit" value="生成菜单" />
        </p>
    
        
    </div>
</form>
