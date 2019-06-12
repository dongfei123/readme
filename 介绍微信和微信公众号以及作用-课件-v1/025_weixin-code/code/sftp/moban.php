<?php 

	include './Libs/Curl.php';
	include './Libs/Token.php';


	$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.Token::getToken();

	$data = ' {
           "touser":"oJAi9wkU-opXqUW8OBCGXkK45EME",
           "template_id":"MbhDxrl6wJa0Hy3_NiwxYN0AShZIO2CtrLv5uvIATpU",
           "url":"http://www.baidu.com",  
           "data":{
                   "first": {
                       "value":"恭喜你购买成功！",
                       "color":"#173177"
                   },
                   "orderMoneySum":{
                       "value":"100",
                       "color":"#173987"
                   },
                   "orderProductName" :{
                   		"value":"新款篮球鞋",
                        "color":"#173987"
                   },
                   "Time":{
                       "value":"'.date('Y-m-d').'",
                       "color":"#173177"
                   },
                   "Remark":{
                       "value":"欢迎再次购买！",
                       "color":"#173177"
                   }
           }
       }';

       $res = Curl::post($url, $data);

       echo $res;

 ?>