<?php

$textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <FuncFlag>0</FuncFlag>
            </xml>"; 
            
$newsTpl = "<xml>
           <ToUserName><![CDATA[%s]]></ToUserName>
           <FromUserName><![CDATA[%s]]></FromUserName>
           <CreateTime>%s</CreateTime>
           <MsgType><![CDATA[%s]]></MsgType>
           <ArticleCount>%s</ArticleCount>
           <Articles>
           <item>
           <Title><![CDATA[%s]]></Title> 
           <Description><![CDATA[%s]]></Description>
           <PicUrl><![CDATA[%s]]></PicUrl>
           <Url><![CDATA[%s]]></Url>
           </item>
           </Articles>
           <FuncFlag>1</FuncFlag>
           </xml> ";

$musicTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <Music>
            <Title><![CDATA[%s]]></Title>
            <Description><![CDATA[%s]]></Description>
            <MusicUrl><![CDATA[%s]]></MusicUrl>
            <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
            </Music>
            <FuncFlag>0</FuncFlag>
            </xml>";

$imageTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <PicUrl><![CDATA[%s]]></PicUrl>
            <MediaId><![CDATA[%s]]></MediaId>
            <MsgId>%s</MsgId>
            </xml>";

$soundTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <MediaId><![CDATA[%s]]></MediaId>
            <Format><![CDATA[%s]]></Format>
            <MsgId>%s</MsgId>
            </xml>";

$soundTpl2 = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <MediaId><![CDATA[%s]]></MediaId>
            <Format><![CDATA[%s]]></Format>
            <Recognition><![CDATA[翔飞科技]]></Recognition>
            <MsgId>%s</MsgId>
            </xml>";

$videoTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <MediaId><![CDATA[%s]]></MediaId>
            <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
            <MsgId>%s</MsgId>
            </xml>";

$small_videoTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <MediaId><![CDATA[%s]]></MediaId>
                    <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                    <MsgId>%s</MsgId>
                    </xml>";

$positionTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                <Location_X>%s</Location_X>
                <Location_Y>%s</Location_Y>
                <Scale>20</Scale>
                <Label><![CDATA[位置信息]]></Label>
                <MsgId>%s</MsgId>
                </xml>";

$linkTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>%s</CreateTime>
            <MsgType><![CDATA[%s]]></MsgType>
            <Title><![CDATA[公众平台官网链接]]></Title>
            <Description><![CDATA[公众平台官网链接]]></Description>
            <Url><![CDATA[%s]]></Url>
            <MsgId>%s</MsgId>
            </xml>";
?>