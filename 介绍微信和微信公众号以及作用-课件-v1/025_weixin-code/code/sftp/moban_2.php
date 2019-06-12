<?php 

	//发送模板消息

	include './Libs/Curl.php';
	include './Libs/Token.php';
	
	$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.Token::getToken();

	$data = ' {
           "touser":"oJAi9wkU-opXqUW8OBCGXkK45EME",
           "template_id":"Iv0WnPoEw6pDAWarYmyAFoKGx-W9LPEErS_60x-QGjo",
           "url":"http://www.baidu.com",  
           "data":{
                   "title": {
                       "value":"恭喜你购买成功！",
                       "color":"#f09987"
                   },
                   "money":{
                       "value":"100元",
                       "color":"#173177"
                   },
                   "name": {
                       "value":"新款的篮球鞋",
                       "color":"#173177"
                   },
                   "remark":{
                       "value":"欢迎您再次购买！",
                       "color":"#173177"
                   }
           }
       }';


    $res = Curl::post($url, $data);

    echo $res;

 ?>