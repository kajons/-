<?php
//装载模板文件
include_once("wx_tpl.php");
include_once("base-class.php");

require_once 'facepp_sdk.php';

//创建一个memcached对象
$mc = new Memcache;

//链接到memcached服务
if(!$mc->connect('127.0.0.1',12000)){
    die('memcache链接失败');
}

//获取微信发送数据
$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

  //返回回复数据
if (!empty($postStr)){
    //echo "testing";  
    //解析数据
      $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    //发送消息方ID
      $fromUsername = $postObj->FromUserName;
    //接收消息方ID
      $toUsername = $postObj->ToUserName;
    //消息类型
      $form_MsgType = $postObj->MsgType;

    //文本消息
    if($form_MsgType == "text")
    {
        //获取用户发送的文字
        $form_Content = trim($postObj->Content);
        
        /*
        //抓取表情
        $s = new SaeStorege(); //可能是 SAE 平台开发特有的一个类
        $->write('weixincourse' , 'bq.txt' , $form_Content);
        exit
        */

        //文字回复音乐1
        if($form_Content == "/::)")
        {
            $msgType = "music";
            $resultStr = sprintf(
                $musicTpl,
                $fromUsername,
                $toUsername,
                $time,
                $msgType,
                "我的歌声里",
                "曲婉婷",
                "http://www.sficam.com/WX/mp3/mysong.mp3",
                "http://www.sficam.com/WX/mp3/mysong.mp3");

            echo $resultStr;
            exit;
        }

        //文字回复音乐2
        if($form_Content == "/:8-)")
        {
            $msgType = "music";
            $resultStr = sprintf(
                $musicTpl,
                $fromUsername,
                $toUsername,
                $time,
                $msgType,
                "梁祝",
                "卓文宣",
                "http://www.sficam.com/WX/mp3/lz.mp3",
                "http://www.sficam.com/WX/mp3/lz.mp3");

            echo $resultStr;
            exit;
        }

        //文字回复音乐3
        if($form_Content == "/::O")
        {
            $msgType = "music";
            $resultStr = sprintf(
                $musicTpl,
                $fromUsername,
                $toUsername,
                $time,
                $msgType,
                "下一个路口",
                "李宇春",
                "http://www.sficam.com/WX/mp3/lk.mp3",
                "http://www.sficam.com/WX/mp3/lk.mp3");

            echo $resultStr;
            exit;
        }

        //文字回图片
        if($form_Content == "abc")
        {
            $msgType = "image";
            $resultStr = sprintf(
                $imageTpl,
                $fromUsername,
                $toUsername,
                $time,
                $msgType,
                "http://www.sficam.com/WX/images/32y.png",
                0);

            echo $resultStr;
            exit;
        }


        //文字回复图文
        if($form_Content == "产品")
        {
            $return_str = "请输入字母编码浏览相应产品：\n\n";
            $return_arr = array("【a】: 模拟机产品\n", "【b】: 网络机产品\n", "【c】: 录像机产品\n", "【d】: 热销产品\n");
            $return_str .= implode(" ", $return_arr);
            $msgType = "text";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $return_str);
            echo $resultStr;
            exit;
        }

        //模拟高清
        if($form_Content == "a")
        {
            $resultStr="<xml>\n
            <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
            <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
            <CreateTime>".time()."</CreateTime>\n
            <MsgType><![CDATA[news]]></MsgType>\n
            <ArticleCount>10</ArticleCount>\n
            <Articles>\n";

            //产品详细数组
            $return_arr = array(
                array(
                    "模拟高清--64SIR",
                    "http://www.sficam.com/WX/images/64sir.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=1&sn=e4c69e878d0aec23866e88fe49c42f56&scene=18#wechat_redirect"
                ),
                array(
                    "模拟高清--63SIR",
                    "http://www.sficam.com/WX/images/63sir.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=2&sn=b94b1daf959d04e502d1a1d5b7d1ece3&scene=18#wechat_redirect"
                ),
                array(
                    "模拟高清--63CPZ-2",
                    "http://www.sficam.com/WX/images/63cpz-2.jpg",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=3&sn=20cb7851d93825b37fb05a8ca2171ab0&scene=18#wechat_redirect"
                ),
                array(
                    "模拟高清--33Y",
                    "http://www.sficam.com/WX/images/33y.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=4&sn=eb630072fa72449758cc2041f1ccaab8&scene=18#wechat_redirect"
                ),
                array(
                    "模拟高清--30J",
                    "http://www.sficam.com/WX/images/30j.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=5&sn=801bfba6f0d5441d1194f827958692be&scene=18#wechat_redirect"
                ),
                array(
                    "模拟高清--35J",
                    "http://www.sficam.com/WX/images/35j.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=6&sn=d6cbe06d7ec72f705d3bbe9a34aebcf9&scene=18#wechat_redirect"
                ), 
                array(
                    "模拟高清--34J",
                    "http://www.sficam.com/WX/images/34j.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=7&sn=2c9dd26b400ddb05db4d825905b08ff2&scene=18#wechat_redirect"
                ),
                array(
                    "模拟高清--36P",
                    "http://www.sficam.com/WX/images/36p.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=1&sn=7e882f06531c2d20ceafe5f2b616a249&scene=20#wechat_redirect"
                ),
                array(
                    "模拟高清--36AZ-1",
                    "http://www.sficam.com/WX/images/36az.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=2&sn=c84a11bfd222184ace8148b42a307dd6&scene=20#wechat_redirect"
                ),
                array(
                    "回复“n”查看下一页, 回复“产品”查看其它产品",
                    "http://www.sficam.com/WX/images/36az-2.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=3&sn=dc2b215831142b9cd8f6392fa91b93ae&scene=20#wechat_redirect"
                ),
            );

            //将上面的数组进行循环转化一下
            foreach($return_arr as $value)
            {
                $resultStr.="<item>\n
                <Title><![CDATA[".$value[0]."]]></Title>\n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[".$value[1]."]]></PicUrl>\n
                <Url><![CDATA[".$value[2]."]]></Url>\n
                </item>\n";
            }

            $resultStr.="</Articles>\n
            <FuncFlag>1</FuncFlag>\n
            </xml>";

            echo $resultStr;
            exit;
        }

        //网络高清
        if($form_Content == "b")
        {
            $resultStr="<xml>\n
            <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
            <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
            <CreateTime>".time()."</CreateTime>\n
            <MsgType><![CDATA[news]]></MsgType>\n
            <ArticleCount>10</ArticleCount>\n
            <Articles>\n";

            //产品详细数组
            $return_arr = array(
                array(
                    "网络高清---37X",
                    "http://www.sficam.com/WX/images/37x.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=1&sn=d28ea8498720835d9fc23cff495951ed&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---30W",
                    "http://www.sficam.com/WX/images/30w.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=2&sn=8554e3dd79690987e28f008dc110da8a&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---33Y",
                    "http://www.sficam.com/WX/images/33y.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=3&sn=962b2aa9f36697f20f240626025b5ee2&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---69QIR",
                    "http://www.sficam.com/WX/images/69qir.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=4&sn=f5fc40c16923fb9a28500e46556df1b2&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---32CZ",
                    "http://www.sficam.com/WX/images/32cz.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=5&sn=38031b05257ba953169a089492565e4e&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---32Y",
                    "http://www.sficam.com/WX/images/32y.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=6&sn=bd816e497b8ce1e2134104caf4813b24&scene=20#wechat_redirect"
                ), 
                array(
                    "网络高清---37FZ",
                    "http://www.sficam.com/WX/images/37fz.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=7&sn=dd49ef21fa335d03fd06f0f3768d0702&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---6A",
                    "http://www.sficam.com/WX/images/6a.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=8&sn=0c42ea1af1c75fd5be60daf3007a223e&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---6B",
                    "http://www.sficam.com/WX/images/6b.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=1&sn=758fd33e5804643fac8a1f67c04f0c7c&scene=20#wechat_redirect"
                ),
                array(
                    "回复“m”查看下一页, 回复“产品”查看其它产品",
                    "http://www.sficam.com/WX/images/6dir.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=2&sn=6a5fc8a82b74f30808601047ffd41f31&scene=20#wechat_redirect"
                ),
            );

            //将上面的数组进行循环转化一下
            foreach($return_arr as $value)
            {
                $resultStr.="<item>\n
                <Title><![CDATA[".$value[0]."]]></Title>\n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[".$value[1]."]]></PicUrl>\n
                <Url><![CDATA[".$value[2]."]]></Url>\n
                </item>\n";
            }

            $resultStr.="</Articles>\n
            <FuncFlag>1</FuncFlag>\n
            </xml>";

            echo $resultStr;
            exit;
        }

        //模拟机第二页
        if($form_Content == "n")
        {
            $resultStr="<xml>\n
            <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
            <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
            <CreateTime>".time()."</CreateTime>\n
            <MsgType><![CDATA[news]]></MsgType>\n
            <ArticleCount>4</ArticleCount>\n
            <Articles>\n";

            //产品详细数组=4条
            $return_arr = array(
                array(
                    "模拟高清--36AZ-2",
                    "http://www.sficam.com/WX/images/36az-2.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=3&sn=dc2b215831142b9cd8f6392fa91b93ae&scene=20#wechat_redirect"
                ),
                array(
                    "模拟高清--36AZ-4",
                    "http://www.sficam.com/WX/images/36az-4.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=4&sn=9be7d6f4a538dbbf7519cad255b9eca1&scene=20#wechat_redirect"
                ),
                array(
                    "模拟高清--63CPZ-2",
                    "http://www.sficam.com/WX/images/63cpz-2.jpg",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=3&sn=20cb7851d93825b37fb05a8ca2171ab0&scene=18#wechat_redirect"
                ),
                array(
                    "模拟高清--38FZ",
                    "http://www.sficam.com/WX/images/38fz.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=5&sn=435d30d5caa2934f78dfac95e80f8716&scene=20#wechat_redirect"
                )
            );

            //将上面的数组进行循环转化一下
            foreach($return_arr as $value)
            {
                $resultStr.="<item>\n
                <Title><![CDATA[".$value[0]."]]></Title>\n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[".$value[1]."]]></PicUrl>\n
                <Url><![CDATA[".$value[2]."]]></Url>\n
                </item>\n";
            }

            $resultStr.="</Articles>\n
            <FuncFlag>1</FuncFlag>\n
            </xml>";

            echo $resultStr;
            exit;
        }

        //网络机第二页
        if($form_Content == "m")
        {
            $resultStr="<xml>\n
            <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
            <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
            <CreateTime>".time()."</CreateTime>\n
            <MsgType><![CDATA[news]]></MsgType>\n
            <ArticleCount>10</ArticleCount>\n
            <Articles>\n";

            //产品详细数组=10条
            $return_arr = array(
                array(
                    "网络高清---6FIR",
                    "http://www.sficam.com/WX/images/6fir.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=3&sn=625ba650a5037d603c9e9f484a1d9aeb&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---36G",
                    "http://www.sficam.com/WX/images/36g.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=4&sn=bd9de18df356d85047e4955fd11d0438&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---33P",
                    "http://www.sficam.com/WX/images/33p.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=5&sn=a44b9e7ad39702b8b1768e9884e23625&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---36P",
                    "http://www.sficam.com/WX/images/36p.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=6&sn=d6d09db236ef141d48559f91a9907e1b&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---36Y",
                    "http://www.sficam.com/WX/images/36y.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=7&sn=805230eb5b79efe2edb729c1e7214834&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---32Y",
                    "http://www.sficam.com/WX/images/32y.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=6&sn=bd816e497b8ce1e2134104caf4813b24&scene=20#wechat_redirect"
                ), 
                array(
                    "网络高清---36AZ-1",
                    "http://www.sficam.com/WX/images/36az.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=8&sn=0a9b44138ae3201caebe98fbe189a66e&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---36AZ-2",
                    "http://www.sficam.com/WX/images/36az-2.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916666&idx=1&sn=5893f36d17756dce04d881f1e780c9d3&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---36AZ-4",
                    "http://www.sficam.com/WX/images/36az-4.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916666&idx=2&sn=19913310697a568f98a5d50a25324bd6&scene=20#wechat_redirect"
                ),
                array(
                    "网络高清---38FZ",
                    "http://www.sficam.com/WX/images/38fz.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916666&idx=3&sn=653256223942e7aa42ddb791d7a3ac3d&scene=20#wechat_redirect"
                ),
            );

            //将上面的数组进行循环转化一下
            foreach($return_arr as $value)
            {
                $resultStr.="<item>\n
                <Title><![CDATA[".$value[0]."]]></Title>\n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[".$value[1]."]]></PicUrl>\n
                <Url><![CDATA[".$value[2]."]]></Url>\n
                </item>\n";
            }

            $resultStr.="</Articles>\n
            <FuncFlag>1</FuncFlag>\n
            </xml>";

            echo $resultStr;
            exit;
        }

        //录像机商品
        if($form_Content == "c")
        {
            $resultStr="<xml>\n
            <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
            <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
            <CreateTime>".time()."</CreateTime>\n
            <MsgType><![CDATA[news]]></MsgType>\n
            <ArticleCount>8</ArticleCount>\n
            <Articles>\n";

            //网络加模拟录像机 = 8条
            $return_arr = array(
                array(
                    "5系网络录像机---NVR5104HA",
                    "http://www.sficam.com/WX/images/nvr.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=1&sn=e6ea55e539366e6939e5dc8f9c0de312&scene=20#wechat_redirect"
                ),
                array(
                    "5系网络录像机---NVR5108HA",
                    "http://www.sficam.com/WX/images/nvr_font.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=2&sn=b604a37498364fe12b6d6da67a94e647&scene=20#wechat_redirect"
                ),
                array(
                    "5系网络录像机---NVR5216H",
                    "http://www.sficam.com/WX/images/nvr_font.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=3&sn=bd5a574dcbe96b2eec922aca92821a47&scene=20#wechat_redirect"
                ),
                array(
                    "5系网络录像机---NVR5432H",
                    "http://www.sficam.com/WX/images/nvr_font.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=4&sn=8f984cf40e1ac1dfd6a8b885f81e4eb1&scene=20#wechat_redirect"
                ),
                array(
                    "WIFI套装---四合一",
                    "http://www.sficam.com/WX/images/nvr_font.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=5&sn=af7e9d4839b821a24794aba799f0ecdd&scene=20#wechat_redirect"
                ),
                array(
                    "AHD同轴高清DVR(720P)",
                    "http://www.sficam.com/WX/images/nvr_font.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=1&sn=970589fab35ffe37d22c3ad8ce59f728&scene=20#wechat_redirect"
                ),
                array(
                    "AHD同轴高清DVR（1080P）",
                    "http://www.sficam.com/WX/images/nvr_font.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=2&sn=612ee041051639764808cd195ac82cc8&scene=20#wechat_redirect"
                ),
                array(
                    "模拟标清DVR",
                    "http://www.sficam.com/WX/images/nvr_font.png",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=3&sn=f4a3a6ca73a2d07de02344fc189c6aa9&scene=20#wechat_redirect"
                )
            );

            //将上面的数组进行循环转化一下
            foreach($return_arr as $value)
            {
                $resultStr.="<item>\n
                <Title><![CDATA[".$value[0]."]]></Title>\n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[".$value[1]."]]></PicUrl>\n
                <Url><![CDATA[".$value[2]."]]></Url>\n
                </item>\n";
            }

            $resultStr.="</Articles>\n
            <FuncFlag>1</FuncFlag>\n
            </xml>";

            echo $resultStr;
            exit;
        }
        
        //热销商品
        if($form_Content == "d")
        {
            $resultStr="<xml>\n
            <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
            <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
            <CreateTime>".time()."</CreateTime>\n
            <MsgType><![CDATA[news]]></MsgType>\n
            <ArticleCount>3</ArticleCount>\n
            <Articles>\n";

            //热销3条
            $return_arr = array(
                array(
                    "热销--65DPZ",
                    "http://www.sficam.com/WX/images/65dp.jpg",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=1&sn=deb5cc343bff85aaea0f2b61e4ab0aa2&scene=20#wechat_redirect"
                ),
                array(
                    "热销--34NZ",
                    "http://www.sficam.com/WX/images/34nz.jpg",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=2&sn=c0292cac81f8f3eb9b513bfd5cd1e7ba&scene=20#wechat_redirect"
                ),
                array(
                    "热销--35Y",
                    "http://www.sficam.com/WX/images/34y.jpg",
                    "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=3&sn=59009edf8b481f56f05f2cebba3daec3&scene=20#wechat_redirect"
                )
            );

            //将上面的数组进行循环转化一下
            foreach($return_arr as $value)
            {
                $resultStr.="<item>\n
                <Title><![CDATA[".$value[0]."]]></Title>\n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[".$value[1]."]]></PicUrl>\n
                <Url><![CDATA[".$value[2]."]]></Url>\n
                </item>\n";
            }

            $resultStr.="</Articles>\n
            <FuncFlag>1</FuncFlag>\n
            </xml>";

            echo $resultStr;
            exit;
        }

        //默认回复
        $msgType = "text";
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, "请输入“产品”查看产品信息");
        echo $resultStr;
        exit;


        /*测试内容==文字回复文字
        //如果发送的内容不为空，则回复用户相同的文字内容
        if(!empty($form_Content))
        {
            $msgType = "text";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $form_Content);
            echo $resultStr;
            exit;
        }
        //否则提示用户输入内容
        else
        {
            $msgType = "text";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, "请输入些什么吧... ...");
            echo $resultStr;
            exit;
        }
        */
    }


    //事件消息
    if($form_MsgType == "event")
    {
        //获取事件类型
        $form_Event = $postObj->Event;
        
        //订阅事件
        if($form_Event == "subscribe")
        {

            //回复欢迎图文消息
            $resultStr="<xml>\n
            <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
            <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
            <CreateTime>".time()."</CreateTime>\n
            <MsgType><![CDATA[news]]></MsgType>\n
            <ArticleCount>5</ArticleCount>\n
            <Articles>\n";


            //添加图文消息
            $resultStr.="<item>\n
            <Title><![CDATA[公司简介]]></Title>\n
            <Description><![CDATA[]]></Description>\n
            <PicUrl><![CDATA[https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpLsr9sF1s3ShcWiajB9uwTJ2G0JJ9UsLDwicpMe4XTnFKVicOlz0ibriaIksapX6nsLdJIfhrvKC9pm3ZQ/0?wx_fmt=jpeg]]></PicUrl>\n
            <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=1&sn=93a857839f718c467671f68cc5527227&scene=18#wechat_redirect]]></Url>\n
            </item>\n";

            $resultStr.="<item>\n
            <Title><![CDATA[发展历程]]></Title>\n
            <Description><![CDATA[]]></Description>\n
            <PicUrl><![CDATA[https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpKZ86BTChHMVsDaQNQhQVfoM6h2VLgc3LKB7E3RwEicfahfEia2qCh9X3cGAwZtAdbSfteVicmRI8BOg/0]]></PicUrl>\n
            <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=2&sn=605c7cddbbf97f36c175c8095ae886c2&scene=18#wechat_redirect]]></Url>\n
            </item>\n";

            $resultStr.="<item>\n
            <Title><![CDATA[企业文化]]></Title>\n
            <Description><![CDATA[]]></Description>\n
            <PicUrl><![CDATA[https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpKZ86BTChHMVsDaQNQhQVfoM6h2VLgc3LKB7E3RwEicfahfEia2qCh9X3cGAwZtAdbSfteVicmRI8BOg/0]]></PicUrl>\n
            <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=3&sn=b48db358210e6b58976abbeafea6fca0&scene=18#wechat_redirect]]></Url>\n
            </item>\n";

            $resultStr.="<item>\n
            <Title><![CDATA[联系我们]]></Title>\n
            <Description><![CDATA[]]></Description>\n
            <PicUrl><![CDATA[https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpI0nP5DhpbEmiaoQdibWLsnQ1GlHKWpxKrNH8D6kfn9r8uFP52SbfdQKZgyfvkYyaVR55D5xqibt7ypA/0?wx_fmt=jpeg]]></PicUrl>\n
            <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=4&sn=d58b23cc9b9abd56e0843766b77a95ec&scene=18#wechat_redirect]]></Url>\n
            </item>\n";

            $resultStr.="<item>\n
            <Title><![CDATA[销售网络]]></Title>\n
            <Description><![CDATA[]]></Description>\n
            <PicUrl><![CDATA[https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpJrsqGE5pM27sNglXp9ftv6cXO26uKd6MnldLuwXOW0GbVJKqU5ibFAKD561RpicqIz6R9wwQYMbDWw/0?wx_fmt=png]]></PicUrl>\n
            <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=5&sn=bc57037053d9e76e76500a3bd53b9655&scene=18#wechat_redirect]]></Url>\n
            </item>\n";

            //结尾部分代码
            $resultStr.="</Articles>\n
            <FuncFlag>1</FuncFlag>\n
            </xml>";
            
            /*
            //回复欢迎文字消息
            $msgType = "text";
            $contentStr = "翔飞科技欢迎您！[玫瑰]";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);
            */
            echo $resultStr;
            exit;
        }

        //获取自定义菜单点击事件
        if($form_Event=="CLICK")
        {
           
            //获取菜单key值
            $form_EventKey = trim($postObj->EventKey);
            
           
            //模拟高清=10条  
            if($form_EventKey=="a")
            {
                
                $msgType = "text";
                $resultStr="<xml>\n
                        <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                        <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                        <CreateTime>".time()."</CreateTime>\n
                        <MsgType><![CDATA[news]]></MsgType>\n
                        <ArticleCount>10</ArticleCount>\n
                        <Articles>\n";

                //产品详细数组
                $return_arr = array(
                    array(
                        "模拟高清--64SIR",
                        "http://www.sficam.com/WX/images/64sir.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=1&sn=e4c69e878d0aec23866e88fe49c42f56&scene=18#wechat_redirect"
                    ),
                    array(
                        "模拟高清--63SIR",
                        "http://www.sficam.com/WX/images/63sir.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=2&sn=b94b1daf959d04e502d1a1d5b7d1ece3&scene=18#wechat_redirect"
                    ),
                    array(
                        "模拟高清--63CPZ-2",
                        "http://www.sficam.com/WX/images/63cpz-2.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=3&sn=20cb7851d93825b37fb05a8ca2171ab0&scene=18#wechat_redirect"
                    ),
                    array(
                        "模拟高清--33Y",
                        "http://www.sficam.com/WX/images/33y.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=4&sn=eb630072fa72449758cc2041f1ccaab8&scene=18#wechat_redirect"
                    ),
                    array(
                        "模拟高清--30J",
                        "http://www.sficam.com/WX/images/30j.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=5&sn=801bfba6f0d5441d1194f827958692be&scene=18#wechat_redirect"
                    ),
                    array(
                        "模拟高清--35J",
                        "http://www.sficam.com/WX/images/35j.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=6&sn=d6cbe06d7ec72f705d3bbe9a34aebcf9&scene=18#wechat_redirect"
                    ), 
                    array(
                        "模拟高清--34J",
                        "http://www.sficam.com/WX/images/34j.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=7&sn=2c9dd26b400ddb05db4d825905b08ff2&scene=18#wechat_redirect"
                    ),
                    array(
                        "模拟高清--36P",
                        "http://www.sficam.com/WX/images/36p.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=1&sn=7e882f06531c2d20ceafe5f2b616a249&scene=20#wechat_redirect"
                    ),
                    array(
                        "模拟高清--36AZ-1",
                        "http://www.sficam.com/WX/images/36az.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=2&sn=c84a11bfd222184ace8148b42a307dd6&scene=20#wechat_redirect"
                    ),
                    array(
                        "回复“n”查看下一页, 回复“产品”查看其它产品",
                        "http://www.sficam.com/WX/images/36az.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=3&sn=dc2b215831142b9cd8f6392fa91b93ae&scene=20#wechat_redirect"
                    ),
                );

                //将上面的数组进行循环转化一下
                foreach($return_arr as $value)
                {
                    $resultStr.="<item>\n
                    <Title><![CDATA[".$value[0]."]]></Title>\n
                    <Description><![CDATA[]]></Description>\n
                    <PicUrl><![CDATA[".$value[1]."]]></PicUrl>\n
                    <Url><![CDATA[".$value[2]."]]></Url>\n
                    </item>\n";
                }

                $resultStr.="</Articles>\n
                <FuncFlag>1</FuncFlag>\n
                </xml>";
                echo $resultStr;
                exit;  
            }              
            //网络高清=10条
            if($form_EventKey=="b")
            {
                
                $msgType = "text";
                $resultStr = $resultStr="<xml>\n
                    <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                    <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                    <CreateTime>".time()."</CreateTime>\n
                    <MsgType><![CDATA[news]]></MsgType>\n
                    <ArticleCount>10</ArticleCount>\n
                    <Articles>\n";

                                //产品详细数组
                $return_arr = array(
                    array(
                        "网络高清---37X",
                        "http://www.sficam.com/WX/images/37x.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=1&sn=d28ea8498720835d9fc23cff495951ed&scene=20#wechat_redirect"
                    ),
                    array(
                        "网络高清---30W",
                        "http://www.sficam.com/WX/images/30w.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=2&sn=8554e3dd79690987e28f008dc110da8a&scene=20#wechat_redirect"
                    ),
                    array(
                        "网络高清---33Y",
                        "http://www.sficam.com/WX/images/33y.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=3&sn=962b2aa9f36697f20f240626025b5ee2&scene=20#wechat_redirect"
                    ),
                    array(
                        "网络高清---69QIR",
                        "http://www.sficam.com/WX/images/69qir.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=4&sn=f5fc40c16923fb9a28500e46556df1b2&scene=20#wechat_redirect"
                    ),
                    array(
                        "网络高清---32CZ",
                        "http://www.sficam.com/WX/images/32cz.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=5&sn=38031b05257ba953169a089492565e4e&scene=20#wechat_redirect"
                    ),
                    array(
                        "网络高清---32Y",
                        "http://www.sficam.com/WX/images/32y.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=6&sn=bd816e497b8ce1e2134104caf4813b24&scene=20#wechat_redirect"
                    ), 
                    array(
                        "网络高清---37FZ",
                        "http://www.sficam.com/WX/images/37fz.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=7&sn=dd49ef21fa335d03fd06f0f3768d0702&scene=20#wechat_redirect"
                    ),
                    array(
                        "网络高清---6A",
                        "http://www.sficam.com/WX/images/6a.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=8&sn=0c42ea1af1c75fd5be60daf3007a223e&scene=20#wechat_redirect"
                    ),
                    array(
                        "网络高清---6B",
                        "http://www.sficam.com/WX/images/6b.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=1&sn=758fd33e5804643fac8a1f67c04f0c7c&scene=20#wechat_redirect"
                    ),
                    array(
                        "回复“m”查看下一页, 回复“产品”查看其它产品",
                        "http://www.sficam.com/WX/images/6dir.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=2&sn=6a5fc8a82b74f30808601047ffd41f31&scene=20#wechat_redirect"
                    ),
                );

                //将上面的数组进行循环转化一下
                foreach($return_arr as $value)
                {
                    $resultStr.="<item>\n
                    <Title><![CDATA[".$value[0]."]]></Title>\n
                    <Description><![CDATA[]]></Description>\n
                    <PicUrl><![CDATA[".$value[1]."]]></PicUrl>\n
                    <Url><![CDATA[".$value[2]."]]></Url>\n
                    </item>\n";
                }

                $resultStr.="</Articles>\n
                    <FuncFlag>1</FuncFlag>\n
                    </xml>";
                echo $resultStr;
                exit;  
            }
            //录像机8条
            if($form_EventKey=="c")
            {
                
                $msgType = "text";
                $resultStr = $resultStr="<xml>\n
                    <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                    <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                    <CreateTime>".time()."</CreateTime>\n
                    <MsgType><![CDATA[news]]></MsgType>\n
                    <ArticleCount>8</ArticleCount>\n
                    <Articles>\n";

                //网络加模拟录像机 = 8条
                $return_arr = array(
                    array(
                        "5系网络录像机---NVR5104HA",
                        "http://www.sficam.com/WX/images/nvr.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=1&sn=e6ea55e539366e6939e5dc8f9c0de312&scene=20#wechat_redirect"
                    ),
                    array(
                        "5系网络录像机---NVR5108HA",
                        "http://www.sficam.com/WX/images/nvr_font.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=2&sn=b604a37498364fe12b6d6da67a94e647&scene=20#wechat_redirect"
                    ),
                    array(
                        "5系网络录像机---NVR5216H",
                        "http://www.sficam.com/WX/images/nvr_font.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=3&sn=bd5a574dcbe96b2eec922aca92821a47&scene=20#wechat_redirect"
                    ),
                    array(
                        "5系网络录像机---NVR5432H",
                        "http://www.sficam.com/WX/images/nvr_font.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=4&sn=8f984cf40e1ac1dfd6a8b885f81e4eb1&scene=20#wechat_redirect"
                    ),
                    array(
                        "WIFI套装---四合一",
                        "http://www.sficam.com/WX/images/nvr_font.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=5&sn=af7e9d4839b821a24794aba799f0ecdd&scene=20#wechat_redirect"
                    ),
                    array(
                        "AHD同轴高清DVR(720P)",
                        "http://www.sficam.com/WX/images/nvr_font.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=1&sn=970589fab35ffe37d22c3ad8ce59f728&scene=20#wechat_redirect"
                    ),
                    array(
                        "AHD同轴高清DVR（1080P）",
                        "http://www.sficam.com/WX/images/nvr_font.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=2&sn=612ee041051639764808cd195ac82cc8&scene=20#wechat_redirect"
                    ),
                    array(
                        "模拟标清DVR",
                        "http://www.sficam.com/WX/images/nvr_font.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=3&sn=f4a3a6ca73a2d07de02344fc189c6aa9&scene=20#wechat_redirect"
                    )
                );

                 
                //将上面的数组进行循环转化一下
                foreach($return_arr as $value)
                {
                    $resultStr.="<item>\n
                    <Title><![CDATA[".$value[0]."]]></Title>\n
                    <Description><![CDATA[]]></Description>\n
                    <PicUrl><![CDATA[".$value[1]."]]></PicUrl>\n
                    <Url><![CDATA[".$value[2]."]]></Url>\n
                    </item>\n";
                }

                $resultStr.="</Articles>\n
                    <FuncFlag>1</FuncFlag>\n
                    </xml>";
                echo $resultStr;
                exit;  
            }
            //热销特价商品3条
            if($form_EventKey=="a_per")
            {
                     
                $msgType = "text";
                $resultStr = $resultStr="<xml>\n
                    <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                    <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                    <CreateTime>".time()."</CreateTime>\n
                    <MsgType><![CDATA[news]]></MsgType>\n
                    <ArticleCount>3</ArticleCount>\n
                    <Articles>\n";

                //热销3条
                $return_arr = array(
                    array(
                        "热销--65DPZ",
                        "http://www.sficam.com/WX/images/65dp.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=1&sn=deb5cc343bff85aaea0f2b61e4ab0aa2&scene=20#wechat_redirect"
                    ),
                    array(
                        "热销--34NZ",
                        "http://www.sficam.com/WX/images/34nz.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=2&sn=c0292cac81f8f3eb9b513bfd5cd1e7ba&scene=20#wechat_redirect"
                    ),
                    array(
                        "热销--35Y",
                        "http://www.sficam.com/WX/images/34y.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=3&sn=59009edf8b481f56f05f2cebba3daec3&scene=20#wechat_redirect"
                    )
                );

                //将上面的数组进行循环转化一下
                foreach($return_arr as $value)
                {
                    $resultStr.="<item>\n
                    <Title><![CDATA[".$value[0]."]]></Title>\n
                    <Description><![CDATA[]]></Description>\n
                    <PicUrl><![CDATA[".$value[1]."]]></PicUrl>\n
                    <Url><![CDATA[".$value[2]."]]></Url>\n
                    </item>\n";
                }

                $resultStr.="</Articles>\n
                    <FuncFlag>1</FuncFlag>\n
                    </xml>";
                echo $resultStr;
                exit; 
            }
            //新发布的产品
            if($form_EventKey=="b_per")
            {
                     
                $msgType = "text";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, "敬请期待...");
                echo $resultStr;
                exit;  
            }
            //6条关于
            if($form_EventKey=="about")
            {
                     
                $msgType = "text";
                //回复欢迎图文消息
                $resultStr="<xml>\n
                <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                <CreateTime>".time()."</CreateTime>\n
                <MsgType><![CDATA[news]]></MsgType>\n
                <ArticleCount>5</ArticleCount>\n
                <Articles>\n";


                //添加图文消息
                $resultStr.="<item>\n
                <Title><![CDATA[公司简介]]></Title>\n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpLsr9sF1s3ShcWiajB9uwTJ2G0JJ9UsLDwicpMe4XTnFKVicOlz0ibriaIksapX6nsLdJIfhrvKC9pm3ZQ/0?wx_fmt=jpeg]]></PicUrl>\n
                <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=1&sn=93a857839f718c467671f68cc5527227&scene=18#wechat_redirect]]></Url>\n
                </item>\n";

                $resultStr.="<item>\n
                <Title><![CDATA[发展历程]]></Title>\n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpKZ86BTChHMVsDaQNQhQVfoM6h2VLgc3LKB7E3RwEicfahfEia2qCh9X3cGAwZtAdbSfteVicmRI8BOg/0]]></PicUrl>\n
                <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=2&sn=605c7cddbbf97f36c175c8095ae886c2&scene=18#wechat_redirect]]></Url>\n
                </item>\n";

                $resultStr.="<item>\n
                <Title><![CDATA[企业文化]]></Title>\n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpKZ86BTChHMVsDaQNQhQVfoM6h2VLgc3LKB7E3RwEicfahfEia2qCh9X3cGAwZtAdbSfteVicmRI8BOg/0]]></PicUrl>\n
                <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=3&sn=b48db358210e6b58976abbeafea6fca0&scene=18#wechat_redirect]]></Url>\n
                </item>\n";

                $resultStr.="<item>\n
                <Title><![CDATA[联系我们]]></Title>\n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpI0nP5DhpbEmiaoQdibWLsnQ1GlHKWpxKrNH8D6kfn9r8uFP52SbfdQKZgyfvkYyaVR55D5xqibt7ypA/0?wx_fmt=jpeg]]></PicUrl>\n
                <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=4&sn=d58b23cc9b9abd56e0843766b77a95ec&scene=18#wechat_redirect]]></Url>\n
                </item>\n";

                $resultStr.="<item>\n
                <Title><![CDATA[销售网络]]></Title>\n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpJrsqGE5pM27sNglXp9ftv6cXO26uKd6MnldLuwXOW0GbVJKqU5ibFAKD561RpicqIz6R9wwQYMbDWw/0?wx_fmt=png]]></PicUrl>\n
                <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=5&sn=bc57037053d9e76e76500a3bd53b9655&scene=18#wechat_redirect]]></Url>\n
                </item>\n";

                //结尾部分代码
                $resultStr.="</Articles>\n
                <FuncFlag>1</FuncFlag>\n
                </xml>";
                
                /*
                //回复欢迎文字消息
                $msgType = "text";
                $contentStr = "翔飞科技欢迎您！[玫瑰]";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType, $contentStr);
                */
                echo $resultStr;
                exit; 
            }

            //8条新闻
            if($form_EventKey=="news")
            {
                     
                $msgType = "text";
                $resultStr="<xml>\n
                    <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                    <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                    <CreateTime>".time()."</CreateTime>\n
                    <MsgType><![CDATA[news]]></MsgType>\n
                    <ArticleCount>8</ArticleCount>\n
                    <Articles>\n";

                //8条新闻
                $return_arr = array(
                    array(
                        "深圳安博会倒计时最后一天，期待惊喜",
                        "http://www.sficam.com/WX/images/yt.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=1&sn=a2874d45588fe86b3c924a9e6dae4a84&scene=20#wechat_redirect"
                    ),
                    array(
                        "深圳翔飞科技有限公司2015安博会完美落幕",
                        "http://www.sficam.com/WX/images/anbo.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=2&sn=b71a8c74d1f36df371312c81f66d624e&scene=20#wechat_redirect"
                    ),
                    array(
                        "翔飞：从产品制造商向服务商蜕变",
                        "http://www.sficam.com/WX/images/shfw2.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=3&sn=c3f7741c8aae07d72d4df9ee2b860e22&scene=20#wechat_redirect"
                    ),
                    array(
                        "翔飞科技邀您相约2014北京安防展",
                        "http://www.sficam.com/WX/images/afz2014.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=4&sn=32e8ae7136f556112e3a001c340233b0&scene=20#wechat_redirect"
                    ),
                    array(
                        "翔飞科技2014北京安博展圆满结束",
                        "http://www.sficam.com/WX/images/afz20142.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=5&sn=1c0b34b84cfbf5b216c9f926a3516742&scene=20#wechat_redirect"
                    ),
                    array(
                        "翔飞新品发布会诚邀您的参加",
                        "http://www.sficam.com/WX/images/fbh.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=6&sn=7aa6e2033b95ea76b58233d499b7190a&scene=20#wechat_redirect"
                    ),
                    array(
                        "翔飞科技斩获“最具影响力十大品牌”和“十大新锐产品奖”",
                        "http://www.sficam.com/WX/images/gsjj2.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=7&sn=76ef6861e52d14c2f279d13c456d3181&scene=20#wechat_redirect"
                    ),
                    array(
                        "翔飞科技又获得六项计算机软件著作权",
                        "http://www.sficam.com/WX/images/ry.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=8&sn=0c137f7584e565d0fc13d7032f6674ab&scene=20#wechat_redirect"
                    )
                );

                //将上面的数组进行循环转化一下
                foreach($return_arr as $value)
                {
                    $resultStr.="<item>\n
                    <Title><![CDATA[".$value[0]."]]></Title>\n
                    <Description><![CDATA[]]></Description>\n
                    <PicUrl><![CDATA[".$value[1]."]]></PicUrl>\n
                    <Url><![CDATA[".$value[2]."]]></Url>\n
                    </item>\n";
                }

                $resultStr.="</Articles>\n
                <FuncFlag>1</FuncFlag>\n
                </xml>";


                echo $resultStr;
                exit;  
            }

            //产品技术4条
            if($form_EventKey=="tech")
            {
                     
                $msgType = "text";
                $resultStr="<xml>\n
                    <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                    <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                    <CreateTime>".time()."</CreateTime>\n
                    <MsgType><![CDATA[news]]></MsgType>\n
                    <ArticleCount>4</ArticleCount>\n
                    <Articles>\n";
                
                //4条技术
                $return_arr = array(
                    array(
                        "八招教会你安装监控摄像机",
                        "http://www.sficam.com/WX/images/shfw4.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916670&idx=1&sn=6a9608a6b4f1b735461c1ba71f3e5a58&scene=20#wechat_redirect"
                    ),
                    array(
                        "安防监控系统常见故障分析及解决办法【模拟】",
                        "http://www.sficam.com/WX/images/32cz.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916670&idx=2&sn=8b2ea80730d8286be5fa19f5c6eeb200&scene=20#wechat_redirect"
                    ),
                    array(
                        "网络摄像机基础知识",
                        "http://www.sficam.com/WX/images/63sir.png",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916670&idx=3&sn=25f0edcdcb83ae85685349939c74fb45&scene=20#wechat_redirect"
                    ),
                    array(
                        "常用存储方案计算方法",
                        "http://www.sficam.com/WX/images/disk.jpg",
                        "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916670&idx=4&sn=3d561c48556f3689980232003d7587ac&scene=20#wechat_redirect"
                    )
                );

                //将上面的数组进行循环转化一下
                foreach($return_arr as $value)
                {
                    $resultStr.="<item>\n
                    <Title><![CDATA[".$value[0]."]]></Title>\n
                    <Description><![CDATA[]]></Description>\n
                    <PicUrl><![CDATA[".$value[1]."]]></PicUrl>\n
                    <Url><![CDATA[".$value[2]."]]></Url>\n
                    </item>\n";
                }

                $resultStr.="</Articles>\n
                <FuncFlag>1</FuncFlag>\n
                </xml>";
                echo $resultStr;
                exit;  
            }
        
        }
    }

    //图片消息
    if($form_MsgType == "image")
    {
        $facepp = new Facepp();
        

        #detect local image 
        $params=array('img'=>'{https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpLsr9sF1s3ShcWiajB9uwTJ2G0JJ9UsLDwicpMe4XTnFKVicOlz0ibriaIksapX6nsLdJIfhrvKC9pm3ZQ/0?wx_fmt=jpeg}');
        $params['attribute'] = 'gender,age,race,smiling,glass,pose';
        $response = $facepp->execute('/detection/detect',$params);
        print_r($response);

        #detect image by url
        $params=array('url'=>'http://www.faceplusplus.com.cn/wp-content/themes/faceplusplus/assets/img/demo/1.jpg');
        $response = $facepp->execute('/detection/detect',$params);
        print_r($response);

        if($response['http_code']==200){
            #json decode 
            $data = json_decode($response['body'],1);
            #get face landmark
            foreach ($data['face'] as $face) {
                $response = $facepp->execute('/detection/landmark',array('face_id'=>$face['face_id']));
                print_r($response);
            }
            #create person 
            $response = $facepp->execute('/person/create',array('person_name'=>'unique_person_name'));
            print_r($response);

            #delete person
            $response = $facepp->execute('/person/delete',array('person_name'=>'unique_person_name'));
            print_r($response);

        }

        /*
        $contentStr = "你的图片很拉风哦！";
        $msgType = "text";
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        echo $resultStr;
        exit;
        */
    }

}

else 
{
      echo "Don't receive the message of weixin_server(服务器无法获取到用户信息)";
      exit;
}
//1p492a2490.iok.la
//xiao1323.6655.la
?>
