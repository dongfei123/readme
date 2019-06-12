<?php
/**
  * wechat php test
  */

//define your token
//如果参数包含 echostr 则是要进行验证
if(!empty($_GET['echostr'])) {
    define("TOKEN", "iloveyou");
    $wechatObj = new wechatCallbackapiTest();
    $wechatObj->valid();die;
}


include './Libs/Weixin.php';

//实例化
$weixin = new Weixin;
// 被动回复文本
$weixin->bReplyText('http://xiaox.xiaohigh.com/Auth/admin.php');
//根据被动回复的配置进行回复
// $weixin->bReplyByConfig();

//被动回复图片
// $weixin-> bReplyImage('ydw4VKOSDwaC_cRoEI2nEolrVImH5n7vaoN1sZbd344mfXDV1dOqiMl-I6F7yDLQ');

//被动回复语音
// $weixin -> bReplyVoice('FlVqps-qKvf7WEXALKPBjIA1H0wRV2eAheP9o1kSFJKbfr4fjtuBZ7sf_j5VfETl');

//被动回复视频消息
// $weixin->bReplayVideo('SuAsFNHTmxXTCUG3FFM-I5WA4OZ8F4Tz33gNYnTT0hHKBQh_C0afRhtTzqMIDuRr','led灯的显示','简单的嵌入式');

//被动回复音乐消息
// $weixin->bReplyMusic(
//     '荣耀',
//     '荣耀,但是不是手机哦!!!!',
//     'http://xiaox.xiaohigh.com/sucai/mp3/rongyao.mp3',
//     '2vawBf9vt7OzIre0QE9eWLxHOq0wrFFfJK7qK_jtSAr3TsAGmdrmf8ukuY2J1RF7'
//     );

//被动回复图文消息
// $weixin->bReplyTuwen();

//机器人自动回复
$weixin->ibot();

class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if(!empty( $keyword ))
                {
              		$msgType = "text";
                	$contentStr = "Welcome to wechat world!";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>