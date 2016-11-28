<?php
//主函数
define("TOKEN", "safer_weixin");

//创建一个memcached对象
$mc = new Memcache;

//链接到memcached服务
if(!$mc->connect('127.0.0.1',12000)){
    die('memcache链接失败');
}

$wechatObj = new wechatCallbackapiTest();

if(!isset($_GET['echostr']))
{
    $wechatObj->responseMsg();
}
else
{
    $wechatObj->valid();
}

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature())
        {
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if($tmpStr == $signature)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function responseMsg()
    {
        //获取微信发送数据
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)){
            //$this->logger("R ".$postStr);

            //解析数据
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            
            //从用户发送的消息中获取消息类型
            $form_MsgType = $postObj->MsgType;

/* 测试获取的消息类型
            $content = $form_MsgType;
            $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                <FuncFlag>0</FuncFlag>
                </xml>"; 
            $msgType = "text";
            $result = sprintf(
                $textTpl,
                $postObj->FromUserName,
                $postObj->ToUserName,
                time(),
                $msgType,
                $content
            );
            echo $result;
*/

            //根据收到的消息类型进行消息回复
            switch($form_MsgType)
            {
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
                case "image":
                    $result = $this->receiveImage($postObj);
                    break;
                case "voice":
                    $result = $this->receiveVoice($postObj);
                    break;
                case "shortvideo":
                    $result = $this->small_receiveVideo($postObj);
                    break;
                case "video":
                    $result = $this->receiveVideo($postObj);
                    break;
                case "event":
                    $result = $this->receiveEvent($postObj);
                    break;
                case "location":
                    $result = $this->receiveLocation($postObj);
                    break;
                case "link":
                    $result = $this->receiveLink($postObj);
                    break;
                default:
                    $content = "";
                    $content = "请也可以输入“产品”查看产品信息";
                    $result = $this->transmitText($object, $content);
                    break;
            }
            //$this->logger("T ".$result);
            echo $result;
        }
        else 
        {
              echo "Don't receive the message of weixin_server(服务器无法获取到用户信息)";
              exit;
        }
    }


##########################################################
#
#               接收事件消息的各个模块
#
##########################################################

    private function receiveEvent($object)
    {
        $content = array();


        switch($object->Event)
        {
            case "subscribe":
                $content = array(
                    array(
                    "Title" => "公司简介",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpLsr9sF1s3ShcWiajB9uwTJ2G0JJ9UsLDwicpMe4XTnFKVicOlz0ibriaIksapX6nsLdJIfhrvKC9pm3ZQ/0?wx_fmt=jpeg",
                    "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=1&sn=93a857839f718c467671f68cc5527227&scene=18#wechat_redirect"        
                    ),
                    array(
                    "Title" => "发展历程",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpKZ86BTChHMVsDaQNQhQVfoM6h2VLgc3LKB7E3RwEicfahfEia2qCh9X3cGAwZtAdbSfteVicmRI8BOg/0",
                    "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=2&sn=605c7cddbbf97f36c175c8095ae886c2&scene=18#wechat_redirect"        
                    ),
                    array(
                    "Title" => "销售网络",
                    "Description" => "多图文3内容",
                    "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpJrsqGE5pM27sNglXp9ftv6cXO26uKd6MnldLuwXOW0GbVJKqU5ibFAKD561RpicqIz6R9wwQYMbDWw/0?wx_fmt=png",
                    "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=5&sn=bc57037053d9e76e76500a3bd53b9655&scene=18#wechat_redirect"        
                    ),
                    array(
                    "Title" => "企业文化",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpKZ86BTChHMVsDaQNQhQVfoM6h2VLgc3LKB7E3RwEicfahfEia2qCh9X3cGAwZtAdbSfteVicmRI8BOg/0",
                    "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=3&sn=b48db358210e6b58976abbeafea6fca0&scene=18#wechat_redirect"        
                    ),
                    $content[] = array(
                    "Title" => "联系我们",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/64sir.png",
                    "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=4&sn=d58b23cc9b9abd56e0843766b77a95ec&scene=18#wechat_redirect"        
                    )
                );
                $result = $this->transmitNews($object, $content);
                break;
            case "unsubscribe":
                $content = "取消关注";
                $result = $this->transmitText($object, $content);
                break;
            case "CLICK":
                //获取菜单key值
                $form_EventKey = trim($object->EventKey);

                switch($form_EventKey)
                {
                    //模拟高清=10条
                    case "a":
                        //产品详细数组
                        $content = array(
                            array(
                                    "Title" =>"模拟高清--64SIR",
                                    "Description" => "深圳市翔飞科技股份有限公司",
                                    "PicUrl" => "http://www.sficam.com/WX/images/64sir.png",
                                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=1&sn=e4c69e878d0aec23866e88fe49c42f56&scene=18#wechat_redirect"
                                ),
                                array(
                                    "Title" =>"模拟高清--63SIR",
                                    "Description" => "深圳市翔飞科技股份有限公司",
                                    "PicUrl" => "http://www.sficam.com/WX/images/63sir.png",
                                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=2&sn=b94b1daf959d04e502d1a1d5b7d1ece3&scene=18#wechat_redirect"
                                ),
                                array(
                                    "Title" =>"模拟高清--63CPZ-2",
                                    "Description" => "深圳市翔飞科技股份有限公司",
                                    "PicUrl" => "http://www.sficam.com/WX/images/63cpz-2.jpg",
                                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=3&sn=20cb7851d93825b37fb05a8ca2171ab0&scene=18#wechat_redirect"
                                ),
                                array(
                                    "Title" =>"模拟高清--33Y",
                                    "Description" => "深圳市翔飞科技股份有限公司",
                                    "PicUrl" => "http://www.sficam.com/WX/images/33y.png",
                                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=4&sn=eb630072fa72449758cc2041f1ccaab8&scene=18#wechat_redirect"
                                ),
                                array(
                                    "Title" =>"模拟高清--30J",
                                    "Description" => "深圳市翔飞科技股份有限公司",
                                    "PicUrl" => "http://www.sficam.com/WX/images/30j.png",
                                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=5&sn=801bfba6f0d5441d1194f827958692be&scene=18#wechat_redirect"
                                ),
                                array(
                                    "Title" =>"模拟高清--35J",
                                    "Description" => "深圳市翔飞科技股份有限公司",
                                    "PicUrl" => "http://www.sficam.com/WX/images/35j.png",
                                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=6&sn=d6cbe06d7ec72f705d3bbe9a34aebcf9&scene=18#wechat_redirect"
                                ), 
                                array(
                                    "Title" =>"模拟高清--34J",
                                    "Description" => "深圳市翔飞科技股份有限公司",
                                    "PicUrl" => "http://www.sficam.com/WX/images/34j.png",
                                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=7&sn=2c9dd26b400ddb05db4d825905b08ff2&scene=18#wechat_redirect"
                                ),
                                array(
                                    "Title" =>"模拟高清--36P",
                                    "Description" => "深圳市翔飞科技股份有限公司",
                                    "PicUrl" => "http://www.sficam.com/WX/images/36p.png",
                                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=1&sn=7e882f06531c2d20ceafe5f2b616a249&scene=20#wechat_redirect"
                                ),
                                array(
                                    "Title" =>"模拟高清--36AZ-1",
                                    "Description" => "深圳市翔飞科技股份有限公司",
                                    "PicUrl" => "http://www.sficam.com/WX/images/36az.png",
                                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=2&sn=c84a11bfd222184ace8148b42a307dd6&scene=20#wechat_redirect"
                                ),
                                array(
                                    "Title" =>"回复“n”查看下一页, 回复“产品”查看其它产品",
                                    "Description" => "深圳市翔飞科技股份有限公司",
                                    "PicUrl" =>"http://www.sficam.com/WX/images/36az.png",
                                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=3&sn=dc2b215831142b9cd8f6392fa91b93ae&scene=20#wechat_redirect"
                                )
                        );
                        $result = $this->transmitNews($object, $content);
                        break;

                    //网络高清=10条
                    case "b":
                        //产品详细数组
                        $content = array(
                            array(
                                "Title" =>"网络高清---37X",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/37x.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=1&sn=d28ea8498720835d9fc23cff495951ed&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"网络高清---30W",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/30w.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=2&sn=8554e3dd79690987e28f008dc110da8a&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"网络高清---33Y",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/33y.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=3&sn=962b2aa9f36697f20f240626025b5ee2&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"网络高清---69QIR",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/69qir.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=4&sn=f5fc40c16923fb9a28500e46556df1b2&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"网络高清---32CZ",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/32cz.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=5&sn=38031b05257ba953169a089492565e4e&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"网络高清---32Y",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/32y.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=6&sn=bd816e497b8ce1e2134104caf4813b24&scene=20#wechat_redirect"
                            ), 
                            array(
                                "Title" =>"网络高清---37FZ",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/37fz.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=7&sn=dd49ef21fa335d03fd06f0f3768d0702&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"网络高清---6A",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/6a.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=8&sn=0c42ea1af1c75fd5be60daf3007a223e&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"网络高清---6B",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/6b.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=1&sn=758fd33e5804643fac8a1f67c04f0c7c&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"回复“m”查看下一页, 回复“产品”查看其它产品",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/6dir.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=2&sn=6a5fc8a82b74f30808601047ffd41f31&scene=20#wechat_redirect"
                            )
                        );
                        $result = $this->transmitNews($object, $content);
                        break;

                    //录像机8条
                    case "c":
                        //网络加模拟录像机 = 8条
                        $content = array(
                            array(
                                "Title" =>"5系网络录像机---NVR5104HA",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/nvr.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=1&sn=e6ea55e539366e6939e5dc8f9c0de312&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"5系网络录像机---NVR5108HA",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=2&sn=b604a37498364fe12b6d6da67a94e647&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"5系网络录像机---NVR5216H",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=3&sn=bd5a574dcbe96b2eec922aca92821a47&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"5系网络录像机---NVR5432H",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=4&sn=8f984cf40e1ac1dfd6a8b885f81e4eb1&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"WIFI套装---四合一",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=5&sn=af7e9d4839b821a24794aba799f0ecdd&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"AHD同轴高清DVR(720P)",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=1&sn=970589fab35ffe37d22c3ad8ce59f728&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"AHD同轴高清DVR（1080P）",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=2&sn=612ee041051639764808cd195ac82cc8&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"模拟标清DVR",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=3&sn=f4a3a6ca73a2d07de02344fc189c6aa9&scene=20#wechat_redirect"
                            )
                        );
                        $result = $this->transmitNews($object, $content);
                        break;

                    //热销特价商品3条
                    case "a_per":
                        //热销3条
                        $content = array(
                            array(
                                "Title" =>"热销--65DPZ",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/65dp.jpg",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=1&sn=deb5cc343bff85aaea0f2b61e4ab0aa2&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"热销--34NZ",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" => "http://www.sficam.com/WX/images/34nz.jpg",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=2&sn=c0292cac81f8f3eb9b513bfd5cd1e7ba&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"热销--35Y",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/34y.jpg",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=3&sn=59009edf8b481f56f05f2cebba3daec3&scene=20#wechat_redirect"
                            )
                        );
                        $result = $this->transmitNews($object, $content);
                        break;

                    //新发布的产品
                    case "b_per":
                        $content = "";
                        $content = "敬请期待...";
                        $result = $this->transmitText($object, $content);
                        break;

                    //6条关于
                    case "about":
                        $content = array(
                            array(
                            "Title" => "公司简介",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpLsr9sF1s3ShcWiajB9uwTJ2G0JJ9UsLDwicpMe4XTnFKVicOlz0ibriaIksapX6nsLdJIfhrvKC9pm3ZQ/0?wx_fmt=jpeg",
                            "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=1&sn=93a857839f718c467671f68cc5527227&scene=18#wechat_redirect"        
                            ),
                            array(
                            "Title" => "发展历程",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpKZ86BTChHMVsDaQNQhQVfoM6h2VLgc3LKB7E3RwEicfahfEia2qCh9X3cGAwZtAdbSfteVicmRI8BOg/0",
                            "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=2&sn=605c7cddbbf97f36c175c8095ae886c2&scene=18#wechat_redirect"        
                            ),
                            array(
                            "Title" => "销售网络",
                            "Description" => "多图文3内容",
                            "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpJrsqGE5pM27sNglXp9ftv6cXO26uKd6MnldLuwXOW0GbVJKqU5ibFAKD561RpicqIz6R9wwQYMbDWw/0?wx_fmt=png",
                            "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=5&sn=bc57037053d9e76e76500a3bd53b9655&scene=18#wechat_redirect"        
                            ),
                            array(
                            "Title" => "企业文化",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpKZ86BTChHMVsDaQNQhQVfoM6h2VLgc3LKB7E3RwEicfahfEia2qCh9X3cGAwZtAdbSfteVicmRI8BOg/0",
                            "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=3&sn=b48db358210e6b58976abbeafea6fca0&scene=18#wechat_redirect"        
                            ),
                            $content[] = array(
                            "Title" => "联系我们",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "http://www.sficam.com/WX/images/64sir.png",
                            "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=4&sn=d58b23cc9b9abd56e0843766b77a95ec&scene=18#wechat_redirect"        
                            )
                        );
                        $result = $this->transmitNews($object, $content);
                        break;

                    //8条新闻
                    case "news":
                        //8条新闻
                        $content = array(
                            array(
                                "Title" =>"深圳安博会倒计时最后一天，期待惊喜",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/yt.jpg",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=1&sn=a2874d45588fe86b3c924a9e6dae4a84&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"深圳翔飞科技有限公司2015安博会完美落幕",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/anbo.jpg",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=2&sn=b71a8c74d1f36df371312c81f66d624e&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"翔飞：从产品制造商向服务商蜕变",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/shfw2.jpg",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=3&sn=c3f7741c8aae07d72d4df9ee2b860e22&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"翔飞科技邀您相约2014北京安防展",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/afz2014.jpg",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=4&sn=32e8ae7136f556112e3a001c340233b0&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"翔飞科技2014北京安博展圆满结束",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/afz20142.jpg",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=5&sn=1c0b34b84cfbf5b216c9f926a3516742&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"翔飞新品发布会诚邀您的参加",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/fbh.jpg",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=6&sn=7aa6e2033b95ea76b58233d499b7190a&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"翔飞科技斩获“最具影响力十大品牌”和“十大新锐产品奖”",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/gsjj2.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=7&sn=76ef6861e52d14c2f279d13c456d3181&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"翔飞科技又获得六项计算机软件著作权",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/ry.jpg",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916669&idx=8&sn=0c137f7584e565d0fc13d7032f6674ab&scene=20#wechat_redirect"
                            )
                        );
                        $result = $this->transmitNews($object, $content);
                        break;

                    //产品技术4条
                    case "tech":
                        //4条技术
                        $content = array(
                            array(
                                "Title" => "深圳市翔飞科技股份有限公司","八招教会你安装监控摄像机",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/shfw4.jpg",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916670&idx=1&sn=6a9608a6b4f1b735461c1ba71f3e5a58&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"安防监控系统常见故障分析及解决办法【模拟】",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/32cz.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916670&idx=2&sn=8b2ea80730d8286be5fa19f5c6eeb200&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"网络摄像机基础知识",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/63sir.png",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916670&idx=3&sn=25f0edcdcb83ae85685349939c74fb45&scene=20#wechat_redirect"
                            ),
                            array(
                                "Title" =>"常用存储方案计算方法",
                                "Description" => "深圳市翔飞科技股份有限公司",
                                "PicUrl" =>"http://www.sficam.com/WX/images/disk.jpg",
                                "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916670&idx=4&sn=3d561c48556f3689980232003d7587ac&scene=20#wechat_redirect"
                            )
                        );
                        $result = $this->transmitNews($object, $content);
                        break;

                }
                break;
            case "SCAN":
                $content = "扫描场景 ".$object->EventKey;
                $result = $this->transmitText($object, $content);
                break;
            case "LOCATION":
                $content = "上传位置：纬度 ".$object->Latitude.";经度 ".$object->Longitude;
                $result = $this->transmitText($object, $content);
                break;
            case "VIEW":
                $content = "跳转链接 ".$object->EventKey;
                $result = $this->transmitText($object, $content);
                break;
            default:
                $content = "receive a new event: ".$object->Event;
                $result = $this->transmitText($object, $content);
                break;
        }
        
        return $result;
    }

##########################################################
#
#               日志记录模块
#
##########################################################
/*
    //日志记录，因为我的是自己搭建的服务器，所以这里我是用不到的了
    private function logger($log_content)
    {
        if(isset($_SERVER['HTTP_APPNAME'])){   //SAE
            sae_set_display_errors(false);
            sae_debug($log_content);
            sae_set_display_errors(true);
        }else if($_SERVER['REMOTE_ADDR'] != "127.0.0.1"){ //LOCAL
            $max_size = 10000;
            $log_filename = "log.xml";
            if(file_exists($log_filename) and (abs(filesize($log_filename)) > $max_size)){unlink($log_filename);}
            file_put_contents($log_filename, date('H:i:s')." ".$log_content."\r\n", FILE_APPEND);
        }
    }
*/
##########################################################
#
#               接收普通消息的各个模块
#
##########################################################
/*
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>1351776360</CreateTime>
<MsgType><![CDATA[location]]></MsgType>
<Location_X>23.134521</Location_X>
<Location_Y>113.358803</Location_Y>
<Scale>20</Scale>
<Label><![CDATA[位置信息]]></Label>
<MsgId>1234567890123456</MsgId>
</xml>
*/
    //接收位置消息
    private function receiveLocation($object)
    {
        $content = "你发送的是位置==>\n纬度为：".$object->Location_X."；\n经度为：".$object->Location_Y."；\n缩放级别为：".$object->Scale."；\n位置为：".$object->Label;
        $result = $this->transmitText($object, $content);
        return $result;
    }

/*
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>1351776360</CreateTime>
<MsgType><![CDATA[link]]></MsgType>
<Title><![CDATA[公众平台官网链接]]></Title>
<Description><![CDATA[公众平台官网链接]]></Description>
<Url><![CDATA[url]]></Url>
<MsgId>1234567890123456</MsgId>
</xml>
*/
    //接收链接消息
    private function receiveLink($object)
    {
        $content = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
        $result = $this->transmitText($object, $content);
        return $result;
    }



/*
接收文本的消息格式：

<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName>
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[text]]></MsgType>
 <Content><![CDATA[this is a test]]></Content>
 <MsgId>1234567890123456</MsgId>
 </xml>
*/

    //文本消息接收函数
    private function receiveText($object)
    {
        //$keyword = trim($object->Content);

        switch(trim($object->Content))
        {
            case "wb":
                //如果用户发送的关键字是"文本"，则回复文本消息内容
                $content = "您发送的这是一个文本消息" . $object->Content;
                //$result = $this->transmitText($object, $content);                
                break;
            case "产品":
                $r = array();
                $content = "请输入字母编码浏览相应产品: \n\n";
                $r = array("【a】: 模拟机产品\n", "【b】: 网络机产品\n", "【c】: 录像机产品\n", "【d】: 热销产品\n");
                $content .= implode(" ", $r);
                //$result = $this->transmitText($object, $content);
                break;
            case "a":
                //产品详细数组
                $content = array(
                    array(
                            "Title" =>"模拟高清--64SIR",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "http://www.sficam.com/WX/images/64sir.png",
                            "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=1&sn=e4c69e878d0aec23866e88fe49c42f56&scene=18#wechat_redirect"
                        ),
                        array(
                            "Title" =>"模拟高清--63SIR",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "http://www.sficam.com/WX/images/63sir.png",
                            "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=2&sn=b94b1daf959d04e502d1a1d5b7d1ece3&scene=18#wechat_redirect"
                        ),
                        array(
                            "Title" =>"模拟高清--63CPZ-2",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "http://www.sficam.com/WX/images/63cpz-2.jpg",
                            "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=3&sn=20cb7851d93825b37fb05a8ca2171ab0&scene=18#wechat_redirect"
                        ),
                        array(
                            "Title" =>"模拟高清--33Y",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "http://www.sficam.com/WX/images/33y.png",
                            "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=4&sn=eb630072fa72449758cc2041f1ccaab8&scene=18#wechat_redirect"
                        ),
                        array(
                            "Title" =>"模拟高清--30J",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "http://www.sficam.com/WX/images/30j.png",
                            "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=5&sn=801bfba6f0d5441d1194f827958692be&scene=18#wechat_redirect"
                        ),
                        array(
                            "Title" =>"模拟高清--35J",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "http://www.sficam.com/WX/images/35j.png",
                            "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=6&sn=d6cbe06d7ec72f705d3bbe9a34aebcf9&scene=18#wechat_redirect"
                        ), 
                        array(
                            "Title" =>"模拟高清--34J",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "http://www.sficam.com/WX/images/34j.png",
                            "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=7&sn=2c9dd26b400ddb05db4d825905b08ff2&scene=18#wechat_redirect"
                        ),
                        array(
                            "Title" =>"模拟高清--36P",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "http://www.sficam.com/WX/images/36p.png",
                            "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=1&sn=7e882f06531c2d20ceafe5f2b616a249&scene=20#wechat_redirect"
                        ),
                        array(
                            "Title" =>"模拟高清--36AZ-1",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" => "http://www.sficam.com/WX/images/36az.png",
                            "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=2&sn=c84a11bfd222184ace8148b42a307dd6&scene=20#wechat_redirect"
                        ),
                        array(
                            "Title" =>"回复“n”查看下一页, 回复“产品”查看其它产品",
                            "Description" => "深圳市翔飞科技股份有限公司",
                            "PicUrl" =>"http://www.sficam.com/WX/images/36az.png",
                            "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=3&sn=dc2b215831142b9cd8f6392fa91b93ae&scene=20#wechat_redirect"
                        )
                );
                //$result = $this->transmitNews($object, $content);
                break;
            case "b":
                //产品详细数组
                $content = array(
                    array(
                        "Title" =>"网络高清---37X",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" =>"http://www.sficam.com/WX/images/37x.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=1&sn=d28ea8498720835d9fc23cff495951ed&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---30W",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/30w.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=2&sn=8554e3dd79690987e28f008dc110da8a&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---33Y",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/33y.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=3&sn=962b2aa9f36697f20f240626025b5ee2&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---69QIR",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" =>"http://www.sficam.com/WX/images/69qir.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=4&sn=f5fc40c16923fb9a28500e46556df1b2&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---32CZ",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/32cz.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=5&sn=38031b05257ba953169a089492565e4e&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---32Y",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/32y.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=6&sn=bd816e497b8ce1e2134104caf4813b24&scene=20#wechat_redirect"
                    ), 
                    array(
                        "Title" =>"网络高清---37FZ",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/37fz.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=7&sn=dd49ef21fa335d03fd06f0f3768d0702&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---6A",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/6a.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=8&sn=0c42ea1af1c75fd5be60daf3007a223e&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---6B",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/6b.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=1&sn=758fd33e5804643fac8a1f67c04f0c7c&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"回复“m”查看下一页, 回复“产品”查看其它产品",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" =>"http://www.sficam.com/WX/images/6dir.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=2&sn=6a5fc8a82b74f30808601047ffd41f31&scene=20#wechat_redirect"
                    )
                );
                //$result = $this->transmitNews($object, $content);
                break;
            case "c":
                //网络加模拟录像机 = 8条
                $content = array(
                    array(
                        "Title" =>"5系网络录像机---NVR5104HA",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/nvr.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=1&sn=e6ea55e539366e6939e5dc8f9c0de312&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"5系网络录像机---NVR5108HA",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=2&sn=b604a37498364fe12b6d6da67a94e647&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"5系网络录像机---NVR5216H",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=3&sn=bd5a574dcbe96b2eec922aca92821a47&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"5系网络录像机---NVR5432H",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=4&sn=8f984cf40e1ac1dfd6a8b885f81e4eb1&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"WIFI套装---四合一",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=5&sn=af7e9d4839b821a24794aba799f0ecdd&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"AHD同轴高清DVR(720P)",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=1&sn=970589fab35ffe37d22c3ad8ce59f728&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"AHD同轴高清DVR（1080P）",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=2&sn=612ee041051639764808cd195ac82cc8&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"模拟标清DVR",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=3&sn=f4a3a6ca73a2d07de02344fc189c6aa9&scene=20#wechat_redirect"
                    )
                );
                //$result = $this->transmitNews($object, $content);
                break;
            case "d":
                //热销3条
                $content = array(
                    array(
                        "Title" =>"热销--65DPZ",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/65dp.jpg",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=1&sn=deb5cc343bff85aaea0f2b61e4ab0aa2&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"热销--34NZ",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/34nz.jpg",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=2&sn=c0292cac81f8f3eb9b513bfd5cd1e7ba&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"热销--35Y",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" =>"http://www.sficam.com/WX/images/34y.jpg",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=3&sn=59009edf8b481f56f05f2cebba3daec3&scene=20#wechat_redirect"
                    )
                );
                //$result = $this->transmitNews($object, $content);
                break;
            case "n":
                //产品详细数组=4条
                $content = array(
                    array(
                        "Title" =>"模拟高清--36AZ-2",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/36az-2.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=3&sn=dc2b215831142b9cd8f6392fa91b93ae&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"模拟高清--36AZ-4",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/36az-4.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=4&sn=9be7d6f4a538dbbf7519cad255b9eca1&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"模拟高清--63CPZ-2",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/63cpz-2.jpg",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=3&sn=20cb7851d93825b37fb05a8ca2171ab0&scene=18#wechat_redirect"
                    ),
                    array(
                        "Title" =>"模拟高清--38FZ",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/38fz.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=5&sn=435d30d5caa2934f78dfac95e80f8716&scene=20#wechat_redirect"
                    )
                );
                //$result = $this->transmitNews($object, $content);
                break;
            case "m":
                //产品详细数组=10条
                $content = array(
                    array(
                        "Title" =>"网络高清---6FIR",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/6fir.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=3&sn=625ba650a5037d603c9e9f484a1d9aeb&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---36G",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/36g.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=4&sn=bd9de18df356d85047e4955fd11d0438&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---33P",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/33p.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=5&sn=a44b9e7ad39702b8b1768e9884e23625&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---36P",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/36p.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=6&sn=d6d09db236ef141d48559f91a9907e1b&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---36Y",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/36y.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=7&sn=805230eb5b79efe2edb729c1e7214834&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---32Y",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/32y.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=6&sn=bd816e497b8ce1e2134104caf4813b24&scene=20#wechat_redirect"
                    ), 
                    array(
                        "Title" =>"网络高清---36AZ-1",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/36az.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=8&sn=0a9b44138ae3201caebe98fbe189a66e&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---36AZ-2",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/36az-2.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916666&idx=1&sn=5893f36d17756dce04d881f1e780c9d3&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---36AZ-4",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/36az-4.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916666&idx=2&sn=19913310697a568f98a5d50a25324bd6&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"网络高清---38FZ",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/38fz.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916666&idx=3&sn=653256223942e7aa42ddb791d7a3ac3d&scene=20#wechat_redirect"
                    ),
                );
                //$result = $this->transmitNews($object, $content);
                break;
            case "tw":
                //如果用户发送的关键字是"图文"或"单图文"，则回复单图文内容
                $content[] = array(
                    "Title" => "公司简介",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpLsr9sF1s3ShcWiajB9uwTJ2G0JJ9UsLDwicpMe4XTnFKVicOlz0ibriaIksapX6nsLdJIfhrvKC9pm3ZQ/0?wx_fmt=jpeg",
                    "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=1&sn=93a857839f718c467671f68cc5527227&scene=18#wechat_redirect"        
                );
                //$result = $this->transmitNews($object, $content);
                break;
            case "dtw":
                //同上，如果用户发送的关键字是"多图文", 则回复多图文内容
                $content = array(
                    array(
                    "Title" => "公司简介",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpLsr9sF1s3ShcWiajB9uwTJ2G0JJ9UsLDwicpMe4XTnFKVicOlz0ibriaIksapX6nsLdJIfhrvKC9pm3ZQ/0?wx_fmt=jpeg",
                    "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=1&sn=93a857839f718c467671f68cc5527227&scene=18#wechat_redirect"        
                    ),
                    array(
                    "Title" => "发展历程",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpKZ86BTChHMVsDaQNQhQVfoM6h2VLgc3LKB7E3RwEicfahfEia2qCh9X3cGAwZtAdbSfteVicmRI8BOg/0",
                    "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=2&sn=605c7cddbbf97f36c175c8095ae886c2&scene=18#wechat_redirect"        
                    ),
                    array(
                    "Title" => "销售网络",
                    "Description" => "多图文3内容",
                    "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpJrsqGE5pM27sNglXp9ftv6cXO26uKd6MnldLuwXOW0GbVJKqU5ibFAKD561RpicqIz6R9wwQYMbDWw/0?wx_fmt=png",
                    "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=5&sn=bc57037053d9e76e76500a3bd53b9655&scene=18#wechat_redirect"        
                    ),
                    array(
                    "Title" => "企业文化",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpKZ86BTChHMVsDaQNQhQVfoM6h2VLgc3LKB7E3RwEicfahfEia2qCh9X3cGAwZtAdbSfteVicmRI8BOg/0",
                    "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=3&sn=b48db358210e6b58976abbeafea6fca0&scene=18#wechat_redirect"        
                    ),
                    array(
                    "Title" => "联系我们",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/64sir.png",
                    "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=4&sn=d58b23cc9b9abd56e0843766b77a95ec&scene=18#wechat_redirect"        
                    )
                );
                //$result = $this->transmitNews($object, $content);
                break;
            case "/::)":
                //如果用户发送的关键字是"音乐", 则回复音乐内容
                $content = array(
                    "Title" => "我的歌声里",
                    "Description" => "歌手：曲婉婷",
                    "MusicUrl" => "http://www.sficam.com/WX/mp3/mysong.mp3",
                    "HQMusicUrl" => "http://www.sficam.com/WX/mp3/mysong.mp3"
                );
                //$result = $this->transmitMusic($object, $content);
                break;
            case "/::O":
                //如果用户发送的关键字是"音乐", 则回复音乐内容
                $content = array(
                    "Title" => "下一个路口",
                    "Description" => "歌手：李宇春",
                    "MusicUrl" => "http://www.sficam.com/WX/mp3/lk.mp3",
                    "HQMusicUrl" => "http://www.sficam.com/WX/mp3/lk.mp3"
                );
                //$result = $this->transmitMusic($object, $content);
                break;
            case "/:8-)":
                //如果用户发送的关键字是"音乐", 则回复音乐内容
                $content = array(
                    "Title" => "梁祝",
                    "Description" => "歌手：卓文宣",
                    "MusicUrl" => "http://www.sficam.com/WX/mp3/lz.mp3",
                    "HQMusicUrl" => "http://www.sficam.com/WX/mp3/lz.mp3"
                );
                //$result = $this->transmitMusic($object, $content);
                break;
            default:
                $content = "请输入“产品”查看产品信息";
                //$result = $this->transmitText($object, $content);
                break;

        }
        if(is_array($content)){
            if (isset($content[0]['PicUrl'])){
                $result = $this->transmitNews($object, $content);
            }else if (isset($content['MusicUrl'])){
                $result = $this->transmitMusic($object, $content);
            }
        }else{

            $result = $this->transmitText($object, $content);
        }
        return $result;
/*
        if($keyword == "wb")
        {
            //如果用户发送的关键字是"文本"，则回复文本消息内容
            $content = "您发送的这是一个文本消息" . $object->Content;
            $result = $this->transmitText($object, $content);
            return $result;
        }

        if($keyword == "产品")
        {
            $content = "请输入字母编码浏览相应产品: \n\n";
            $content = array("【a】: 模拟机产品\n", "【b】: 网络机产品\n", "【c】: 录像机产品\n", "【d】: 热销产品\n");
            $content .= implode(" ", $content);
            $result = $this->transmitText($object, $content);
            return $result;
        }

        if($keyword == "a")
        {
            //产品详细数组
            $content = array(
                array(
                        "Title" =>"模拟高清--64SIR",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/64sir.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=1&sn=e4c69e878d0aec23866e88fe49c42f56&scene=18#wechat_redirect"
                    ),
                    array(
                        "Title" =>"模拟高清--63SIR",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/63sir.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=2&sn=b94b1daf959d04e502d1a1d5b7d1ece3&scene=18#wechat_redirect"
                    ),
                    array(
                        "Title" =>"模拟高清--63CPZ-2",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/63cpz-2.jpg",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=3&sn=20cb7851d93825b37fb05a8ca2171ab0&scene=18#wechat_redirect"
                    ),
                    array(
                        "Title" =>"模拟高清--33Y",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/33y.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=4&sn=eb630072fa72449758cc2041f1ccaab8&scene=18#wechat_redirect"
                    ),
                    array(
                        "Title" =>"模拟高清--30J",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/30j.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=5&sn=801bfba6f0d5441d1194f827958692be&scene=18#wechat_redirect"
                    ),
                    array(
                        "Title" =>"模拟高清--35J",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/35j.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=6&sn=d6cbe06d7ec72f705d3bbe9a34aebcf9&scene=18#wechat_redirect"
                    ), 
                    array(
                        "Title" =>"模拟高清--34J",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/34j.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916685&idx=7&sn=2c9dd26b400ddb05db4d825905b08ff2&scene=18#wechat_redirect"
                    ),
                    array(
                        "Title" =>"模拟高清--36P",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/36p.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=1&sn=7e882f06531c2d20ceafe5f2b616a249&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"模拟高清--36AZ-1",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" => "http://www.sficam.com/WX/images/36az.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=2&sn=c84a11bfd222184ace8148b42a307dd6&scene=20#wechat_redirect"
                    ),
                    array(
                        "Title" =>"回复“n”查看下一页, 回复“产品”查看其它产品",
                        "Description" => "深圳市翔飞科技股份有限公司",
                        "PicUrl" =>"http://www.sficam.com/WX/images/36az.png",
                        "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916690&idx=3&sn=dc2b215831142b9cd8f6392fa91b93ae&scene=20#wechat_redirect"
                    )
            );
            $result = $this->transmitNews($object, $content);
            return $result;
        }

        if($keyword == "b")
        {
            //产品详细数组
            $content = array(
                array(
                    "Title" =>"网络高清---37X",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" =>"http://www.sficam.com/WX/images/37x.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=1&sn=d28ea8498720835d9fc23cff495951ed&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"网络高清---30W",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/30w.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=2&sn=8554e3dd79690987e28f008dc110da8a&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"网络高清---33Y",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/33y.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=3&sn=962b2aa9f36697f20f240626025b5ee2&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"网络高清---69QIR",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" =>"http://www.sficam.com/WX/images/69qir.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=4&sn=f5fc40c16923fb9a28500e46556df1b2&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"网络高清---32CZ",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/32cz.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=5&sn=38031b05257ba953169a089492565e4e&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"网络高清---32Y",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/32y.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=6&sn=bd816e497b8ce1e2134104caf4813b24&scene=20#wechat_redirect"
                ), 
                array(
                    "Title" =>"网络高清---37FZ",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/37fz.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=7&sn=dd49ef21fa335d03fd06f0f3768d0702&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"网络高清---6A",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/6a.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916662&idx=8&sn=0c42ea1af1c75fd5be60daf3007a223e&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"网络高清---6B",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/6b.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=1&sn=758fd33e5804643fac8a1f67c04f0c7c&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"回复“m”查看下一页, 回复“产品”查看其它产品",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" =>"http://www.sficam.com/WX/images/6dir.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916663&idx=2&sn=6a5fc8a82b74f30808601047ffd41f31&scene=20#wechat_redirect"
                )
            );
            $result = $this->transmitNews($object, $content);
            return $result;
        }

        if($keyword == "c")
        {
            //网络加模拟录像机 = 8条
            $content = array(
                array(
                    "Title" =>"5系网络录像机---NVR5104HA",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/nvr.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=1&sn=e6ea55e539366e6939e5dc8f9c0de312&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"5系网络录像机---NVR5108HA",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=2&sn=b604a37498364fe12b6d6da67a94e647&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"5系网络录像机---NVR5216H",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=3&sn=bd5a574dcbe96b2eec922aca92821a47&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"5系网络录像机---NVR5432H",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=4&sn=8f984cf40e1ac1dfd6a8b885f81e4eb1&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"WIFI套装---四合一",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916677&idx=5&sn=af7e9d4839b821a24794aba799f0ecdd&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"AHD同轴高清DVR(720P)",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=1&sn=970589fab35ffe37d22c3ad8ce59f728&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"AHD同轴高清DVR（1080P）",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=2&sn=612ee041051639764808cd195ac82cc8&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"模拟标清DVR",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/nvr_font.png",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916680&idx=3&sn=f4a3a6ca73a2d07de02344fc189c6aa9&scene=20#wechat_redirect"
                )
            );
            $result = $this->transmitNews($object, $content);
            return $result;
        }

        if($keyword == "d")
        {
            //热销3条
            $content = array(
                array(
                    "Title" =>"热销--65DPZ",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/65dp.jpg",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=1&sn=deb5cc343bff85aaea0f2b61e4ab0aa2&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"热销--34NZ",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" => "http://www.sficam.com/WX/images/34nz.jpg",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=2&sn=c0292cac81f8f3eb9b513bfd5cd1e7ba&scene=20#wechat_redirect"
                ),
                array(
                    "Title" =>"热销--35Y",
                    "Description" => "深圳市翔飞科技股份有限公司",
                    "PicUrl" =>"http://www.sficam.com/WX/images/34y.jpg",
                    "Url" =>"http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916728&idx=3&sn=59009edf8b481f56f05f2cebba3daec3&scene=20#wechat_redirect"
                )
            );
            $result = $this->transmitNews($object, $content);
            return $result;
        }
        
        if($keyword == "tw" || $keyword == "单图文")
        {
            //如果用户发送的关键字是"图文"或"单图文"，则回复单图文内容
            $content = array();
            $content[] = array(
                "Title" => "公司简介",
                "Description" => "深圳市翔飞科技股份有限公司",
                "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpLsr9sF1s3ShcWiajB9uwTJ2G0JJ9UsLDwicpMe4XTnFKVicOlz0ibriaIksapX6nsLdJIfhrvKC9pm3ZQ/0?wx_fmt=jpeg",
                "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=1&sn=93a857839f718c467671f68cc5527227&scene=18#wechat_redirect"        
            );
            $result = $this->transmitNews($object, $content);
            return $result;
        }
                
        if($keyword == "dtw")
        {
            //同上，如果用户发送的关键字是"多图文", 则回复多图文内容
            $content = array(
                array(
                "Title" => "公司简介",
                "Description" => "深圳市翔飞科技股份有限公司",
                "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpLsr9sF1s3ShcWiajB9uwTJ2G0JJ9UsLDwicpMe4XTnFKVicOlz0ibriaIksapX6nsLdJIfhrvKC9pm3ZQ/0?wx_fmt=jpeg",
                "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=1&sn=93a857839f718c467671f68cc5527227&scene=18#wechat_redirect"        
                ),
                array(
                "Title" => "发展历程",
                "Description" => "深圳市翔飞科技股份有限公司",
                "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpKZ86BTChHMVsDaQNQhQVfoM6h2VLgc3LKB7E3RwEicfahfEia2qCh9X3cGAwZtAdbSfteVicmRI8BOg/0",
                "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=2&sn=605c7cddbbf97f36c175c8095ae886c2&scene=18#wechat_redirect"        
                ),
                array(
                "Title" => "销售网络",
                "Description" => "多图文3内容",
                "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpJrsqGE5pM27sNglXp9ftv6cXO26uKd6MnldLuwXOW0GbVJKqU5ibFAKD561RpicqIz6R9wwQYMbDWw/0?wx_fmt=png",
                "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=5&sn=bc57037053d9e76e76500a3bd53b9655&scene=18#wechat_redirect"        
                ),
                array(
                "Title" => "企业文化",
                "Description" => "深圳市翔飞科技股份有限公司",
                "PicUrl" => "https://mmbiz.qlogo.cn/mmbiz/fnv7SQp8wpKZ86BTChHMVsDaQNQhQVfoM6h2VLgc3LKB7E3RwEicfahfEia2qCh9X3cGAwZtAdbSfteVicmRI8BOg/0",
                "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=3&sn=b48db358210e6b58976abbeafea6fca0&scene=18#wechat_redirect"        
                ),
                array(
                "Title" => "联系我们",
                "Description" => "深圳市翔飞科技股份有限公司",
                "PicUrl" => "http://www.sficam.com/WX/images/64sir.png",
                "Url" => "http://mp.weixin.qq.com/s?__biz=MjM5NzMyMjE5Mw==&mid=505916625&idx=4&sn=d58b23cc9b9abd56e0843766b77a95ec&scene=18#wechat_redirect"        
                )
            );
            $result = $this->transmitNews($object, $content);
            return $result;
        }
        
        if($keyword == "/::)")
        {
            //如果用户发送的关键字是"音乐", 则回复音乐内容
            $content = array(
                "Title" => "我的歌声里",
                "Description" => "歌手：曲婉婷",
                "MusicUrl" => "http://www.sficam.com/WX/mp3/mysong.mp3",
                "HQMusicUrl" => "http://www.sficam.com/WX/mp3/mysong.mp3"
            );
            $result = $this->transmitMusic($object, $content);
            return $result;
        }

        if($keyword == "/::O")
        {
            //如果用户发送的关键字是"音乐", 则回复音乐内容
            $content = array(
                "Title" => "下一个路口",
                "Description" => "歌手：李宇春",
                "MusicUrl" => "http://www.sficam.com/WX/mp3/lk.mp3",
                "HQMusicUrl" => "http://www.sficam.com/WX/mp3/lk.mp3"
            );
            $result = $this->transmitMusic($object, $content);
            return $result;
        }

        if($keyword == "/:8-)")
        {
            //如果用户发送的关键字是"音乐", 则回复音乐内容
            $content = array(
                "Title" => "梁祝",
                "Description" => "歌手：卓文宣",
                "MusicUrl" => "http://www.sficam.com/WX/mp3/lz.mp3",
                "HQMusicUrl" => "http://www.sficam.com/WX/mp3/lz.mp3"
            );
            $result = $this->transmitMusic($object, $content);
            return $result;
        }
        */
    }


/*
接收图片的消息格式：

<xml>
 <ToUserName><![CDATA[toUser]]></ToUserName>
 <FromUserName><![CDATA[fromUser]]></FromUserName>
 <CreateTime>1348831860</CreateTime>
 <MsgType><![CDATA[image]]></MsgType>
 <PicUrl><![CDATA[this is a url]]></PicUrl>
 <MediaId><![CDATA[media_id]]></MediaId>
 <MsgId>1234567890123456</MsgId>
 </xml>
*/
    //图片消息接收函数
    private function receiveImage($object)
    {
        if (isset($object->Recognition) && !empty($object->Recognition)){
            $content = "你刚才发的图片是：".$object->Recognition;
            $result = $this->transmitText($object, $content);
        }else{
            $content = array("MediaId"=>$object->MediaId);
            $result = $this->transmitImage($object, $content);
        }
        
        /*
        //回复图片消息
        $content = array(
            "MediaId" => $object->MediaId    
        );
        $result = $this->transmitImage($object, $content);
        */
        return $result;
    }


/*
接收语音的消息格式：

<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>1357290913</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
<MediaId><![CDATA[media_id]]></MediaId>
<Format><![CDATA[Format]]></Format>
<MsgId>1234567890123456</MsgId>
</xml>

以下是新版本

<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>1357290913</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
<MediaId><![CDATA[media_id]]></MediaId>
<Format><![CDATA[Format]]></Format>
<Recognition><![CDATA[腾讯微信团队]]></Recognition>
<MsgId>1234567890123456</MsgId>
</xml>
*/
    //语音消息接收函数
    private function receiveVoice($object)
    {
        if (isset($object->Recognition) && !empty($object->Recognition)){
            $content = "你刚才说的是：".$object->Recognition;
            $result = $this->transmitText($object, $content);
        }else{
            $content = array("MediaId"=>$object->MediaId);
            $result = $this->transmitVoice($object, $content);
        }
        /*
        //回复语音消息
        $content = array(
            "MediaId" => $object->MediaId    
        );
        $result = $this->transmitVoice($object, $content);
        */
        return $result;
    }

/*
接收视频的消息格式：

<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>1357290913</CreateTime>
<MsgType><![CDATA[video]]></MsgType>
<MediaId><![CDATA[media_id]]></MediaId>
<ThumbMediaId><![CDATA[thumb_media_id]]></ThumbMediaId>
<MsgId>1234567890123456</MsgId>
</xml>

小视频：
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>1357290913</CreateTime>
<MsgType><![CDATA[shortvideo]]></MsgType>
<MediaId><![CDATA[media_id]]></MediaId>
<ThumbMediaId><![CDATA[thumb_media_id]]></ThumbMediaId>
<MsgId>1234567890123456</MsgId>
</xml>
*/
    //视频消息接收函数
    private function receiveVideo($object)
    {
        //回复视频消息
        $content = array(
            "MediaId" => $object->MediaId,
            "ThumbMediaId" => $object->ThumbMediaId,
            "Title" => "视频消息",
            "Description" => "视频描述内容");
        $result = $this->transmitVideo($object, $content);;
        return $result;
    }

    //小视频消息接收函数
    private function small_receiveVideo($object)
    {
        //回复视频消息
        $content = array(
            "MediaId" => $object->MediaId,
            "ThumbMediaId" => $object->ThumbMediaId,
            "Title" => "小小视频消息",
            "Description" => "小小视频描述内容");
        $result = $this->small_transmitVideo($object, $content);;
        return $result;
    }



##########################################################
#
#               回复事件消息的各个模块
#
##########################################################



##########################################################
#
#               回复普通消息的各个模块
#
##########################################################

/*
回复文本的消息格式：

<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[你好]]></Content>
</xml>
*/
    //回复文本消息函数
    private function transmitText($object, $content)
    {
        $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                <FuncFlag>0</FuncFlag>
                </xml>"; 
        $msgType = "text";
        $result = sprintf(
            $textTpl,
            $object->FromUserName,
            $object->ToUserName,
            time(),
            $msgType,
            $content
        );
        return $result;
    }


/*
回复图片的消息格式：

<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
<Image>
<MediaId><![CDATA[media_id]]></MediaId>
</Image>
</xml>
*/
    //回复图片消息函数
    private function transmitImage($object, $imageArray)
    {
        $itemTpl = "<Image>
            <MediaId><![CDATA[%s]]></MediaId>
        </Image>";

        $item_str = sprintf($itemTpl, $imageArray["MediaId"]);

        $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                $item_str
                </xml>"; 

        $msgType = "image";
        $result = sprintf(
            $textTpl,
            $object->FromUserName,
            $object->ToUserName,
            time(),
            $msgType
        );

        return $result;
    }


/*
回复语音的消息格式：

<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
<Voice>
<MediaId><![CDATA[media_id]]></MediaId>
</Voice>
</xml>
*/
    //回复语音消息函数
    private function transmitVoice($object, $voiceArray)
    {
        $itemTpl = "<Voice>
            <MediaId><![CDATA[%s]]></MediaId>
        </Voice>";

        $item_str = sprintf($itemTpl, $voiceArray["MediaId"]);

        $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                $item_str
                </xml>"; 

        $msgType = "voice";
        $result = sprintf(
            $textTpl,
            $object->FromUserName,
            $object->ToUserName,
            time(),
            $msgType
        );

        return $result;
    }



/*
回复视频的消息格式：

<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[video]]></MsgType>
<Video>
<MediaId><![CDATA[media_id]]></MediaId>
<Title><![CDATA[title]]></Title>
<Description><![CDATA[description]]></Description>
</Video> 
</xml>
*/
    //回复视频消息函数
    private function transmitVideo($object, $videoArray)
    {
        $itemTpl = "<Video>
            <MediaId><![CDATA[%s]]></MediaId>
            <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
            <Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            </Video>";

        $item_str = sprintf(
            $itemTpl, 
            $videoArray["MediaId"],
            $videoArray["ThumbMediaId"],
            $videoArray["Title"],
            $videoArray["Description"]);

        $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                $item_str
                </xml>"; 

        $msgType = "video";
        $result = sprintf(
            $textTpl,
            $object->FromUserName,
            $object->ToUserName,
            time(),
            $msgType
        );

        return $result;
    }

    //回复小视频消息函数
    private function small_transmitVideo($object, $videoArray)
    {
        $itemTpl = "<Video>
            <MediaId><![CDATA[%s]]></MediaId>
            <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
            <Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            </Video>";

        $item_str = sprintf(
            $itemTpl, 
            $videoArray["MediaId"],
            $videoArray["ThumbMediaId"],
            $videoArray["Title"],
            $videoArray["Description"]);

        $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                $item_str
                </xml>"; 

        $msgType = "shortvideo";
        $result = sprintf(
            $textTpl,
            $object->FromUserName,
            $object->ToUserName,
            time(),
            $msgType
        );

        return $result;
    }


/*
回复图文的消息格式：

<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<ArticleCount>2</ArticleCount>
<Articles>
<item>
<Title><![CDATA[title1]]></Title> 
<Description><![CDATA[description1]]></Description>
<PicUrl><![CDATA[picurl]]></PicUrl>
<Url><![CDATA[url]]></Url>
</item>
<item>
<Title><![CDATA[title]]></Title>
<Description><![CDATA[description]]></Description>
<PicUrl><![CDATA[picurl]]></PicUrl>
<Url><![CDATA[url]]></Url>
</item>
</Articles>
</xml>
*/
    //回复图文消息函数
    private function transmitNews($object, $arr_item)
    {
        if(!is_array($arr_item))
            return;

        $itemTpl = "<item>
           <Title><![CDATA[%s]]></Title> 
           <Description><![CDATA[%s]]></Description>
           <PicUrl><![CDATA[%s]]></PicUrl>
           <Url><![CDATA[%s]]></Url>
        </item>
        ";

        $item_str = "";
        foreach($arr_item as $item)
            $item_str .= sprintf(
                $itemTpl,
                $item["Title"],
                $item["Description"],
                $item["PicUrl"],
                $item["Url"]
            );

        $newsTpl = "<xml>
               <ToUserName><![CDATA[%s]]></ToUserName>
               <FromUserName><![CDATA[%s]]></FromUserName>
               <CreateTime>%s</CreateTime>
               <MsgType><![CDATA[%s]]></MsgType>
               <ArticleCount>%s</ArticleCount>
               <Articles>
               $item_str
               </Articles></xml> ";

        $msgType = "news";
        $result = sprintf(
            $newsTpl,
            $object->FromUserName,
            $object->ToUserName,
            time(),
            $msgType,
            count($arr_item)
        );

        return $result;
    }


/*
回复音乐的消息格式：

<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>12345678</CreateTime>
<MsgType><![CDATA[music]]></MsgType>
<Music>
<Title><![CDATA[TITLE]]></Title>
<Description><![CDATA[DESCRIPTION]]></Description>
<MusicUrl><![CDATA[MUSIC_Url]]></MusicUrl>
<HQMusicUrl><![CDATA[HQ_MUSIC_Url]]></HQMusicUrl>
<ThumbMediaId><![CDATA[media_id]]></ThumbMediaId>
</Music>
</xml>
*/
    //回复音乐消息函数
    private function transmitMusic($object, $musicArray)
    {
        $itemTpl = "<Music>
            <Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            <MusicUrl><![CDATA[%s]]></MusicUrl>
            <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
        </Music>";

        $item_str = sprintf(
            $itemTpl, 
            $musicArray["Title"],
            $musicArray["Description"],
            $musicArray["MusicUrl"],
            $musicArray["HQMusicUrl"]);

        $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                $item_str
                </xml>"; 

        $msgType = "music";
        $result = sprintf(
            $textTpl,
            $object->FromUserName,
            $object->ToUserName,
            time(),
            $msgType
        );

        return $result;
    }
}

// $weixin = new class_weixin("", "");
// var_dump($weixin->access_token);
// var_dump($weixin->lasttime);
// // var_dump($weixin->get_user_list());
// $openid = "oLVPpjkttuZTbwDwN7vjHNlqsmPs";
// var_dump($weixin->get_user_info($openid));
// $data ='{"button":[{"name":"关于我们","sub_button":[{"type":"click","name":"公司简介","key":"公司简介"},{"type":"click","name":"社会责任","key":"社会责任"},{"type":"click","name":"联系我们","key":"联系我们"}]},{"name":"产品服务","sub_button":[{"type":"click","name":"微信平台","key":"微信平台"},{"type":"click","name":"微博应用","key":"微博应用"},{"type":"click","name":"手机网站","key":"手机网站"}]},{"name":"技术支持","sub_button":[{"type":"click","name":"文档下载","key":"文档下载"},{"type":"click","name":"技术社区","key":"技术社区"},{"type":"click","name":"服务热线","key":"服务热线"}]}]}';
// var_dump($weixin->create_menu($data));
// var_dump($weixin->create_qrcode("QR_SCENE", "134324234"));
// var_dump($weixin->create_group("老师"));
// var_dump($weixin->update_group($openid, "100"));
// var_dump($weixin->location_geocoder(22.539968,113.954980));
// var_dump($weixin->upload_media("image","pondbay.jpg"));
// var_dump($weixin->send_custom_message($openid, "text", "asdf"));


/*
    方倍工作室
    CopyRight 2014 All Rights Reserved
*/

class class_weixin_adv
{
	var $appid = "wx70c68f31057d452a";
	var $appsecret = "642f176ab39d3f530e14afdebf585618";

    //构造函数，获取Access Token
	public function __construct($appid = NULL, $appsecret = NULL)
	{
        /*
        if($appid){
            $this->appid = $appid;
        }
        if($appsecret){
            $this->appsecret = $appsecret;
        }

        //hardcode
        $this->lasttime = 1395049256;
        $this->access_token = "nRZvVpDU7LxcSi7GnG2LrUcmKbAECzRf0NyDBwKlng4nMPf88d34pkzdNcvhqm4clidLGAS18cN1RTSK60p49zIZY4aO13sF-eqsCs0xjlbad-lKVskk8T7gALQ5dIrgXbQQ_TAesSasjJ210vIqTQ";
        
        if (time() > ($this->lasttime + 7200)){
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
            $res = $this->https_request($url);
            $result = json_decode($res, true);
            //save to Database or Memcache
            //将获得的token保存到缓存里,过期时间设定为获取的过期时间-60秒                    
            $this->mc->set("mp_access_token", $access_token, 0, $expires_in-60);
            $this->access_token = $result["access_token"];
            $this->lasttime = time();
        }
        */

        //监测token缓存是否有效
        if($this->mc->get("mp_access_token"))
        {
            $access_token= $this->mc->get("mp_access_token");
        
        }
        else
        {
            //获取token，页面地址为https://api.weixin.qq.com/cgi-bin/token
            curl_setopt($this->ch,CURLOPT_URL,"https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret);
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
	}

    //获取关注者列表
	public function get_user_list($next_openid = NULL)
    {
		$url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$this->access_token."&next_openid=".$next_openid;
        $res = $this->https_request($url);
        return json_decode($res, true);
	}

    //获取用户基本信息
	public function get_user_info($openid)
    {
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->access_token."&openid=".$openid."&lang=zh_CN";
		$res = $this->https_request($url);
        return json_decode($res, true);
	}

    //创建菜单
    public function create_menu($data)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }

    //发送客服消息，已实现发送文本，其他类型可扩展
	public function send_custom_message($touser, $type, $data)
    {
        $msg = array('touser' =>$touser);
        switch($type)
        {
			case 'text':
				$msg['msgtype'] = 'text';
				$msg['text']    = array('content'=> urlencode($data));
				break;
        }
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$this->access_token;
		return $this->https_request($url, urldecode(json_encode($msg)));
	}

    //生成参数二维码
    public function create_qrcode($scene_type, $scene_id)
    {
        switch($scene_type)
        {
			case 'QR_LIMIT_SCENE': //永久
                $data = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$scene_id.'}}}';
				break;
			case 'QR_SCENE':       //临时
                $data = '{"expire_seconds": 1800, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": '.$scene_id.'}}}';
				break;
        }
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        $result = json_decode($res, true);
        return "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($result["ticket"]);
    }
    
    //创建分组
    public function create_group($name)
    {
        $data = '{"group": {"name": "'.$name.'"}}';
        $url = "https://api.weixin.qq.com/cgi-bin/groups/create?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }
    
    //移动用户分组
    public function update_group($openid, $to_groupid)
    {
        $data = '{"openid":"'.$openid.'","to_groupid":'.$to_groupid.'}';
        $url = "https://api.weixin.qq.com/cgi-bin/groups/members/update?access_token=".$this->access_token;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }
    
    //上传多媒体文件
    public function upload_media($type, $file)
    {
        $data = array("media"  => "@".dirname(__FILE__).'\\'.$file);
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=".$this->access_token."&type=".$type;
        $res = $this->https_request($url, $data);
        return json_decode($res, true);
    }
   
    //地理位置逆解析
    public function location_geocoder($latitude, $longitude)
    {
        $url = "http://api.map.baidu.com/geocoder/v2/?ak=B944e1fce373e33ea4627f95f54f2ef9&location=".$latitude.",".$longitude."&coordtype=gcj02ll&output=json";
        $res = $this->https_request($url);
        $result = json_decode($res, true);
        return $result["result"]["addressComponent"];
    }

    //https请求（支持GET和POST）
    protected function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}




?>