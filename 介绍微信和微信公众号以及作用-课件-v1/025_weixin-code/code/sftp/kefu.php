<?php 
	
	include './Libs/Curl.php';
	include './Libs/Token.php';

	//接口地址
	$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.Token::getToken();

	//数据  文本类型
	// $data = '{
	//     "touser":"oJAi9wkU-opXqUW8OBCGXkK45EME",
	//     "msgtype":"text",
	//     "text":
	//     {
	//          "content":"哈喽 你好 欢迎我们的公众账号!!!"
	//     }
	// }';

	//图片类型
	$data  = '{
	    "touser":"oJAi9wkU-opXqUW8OBCGXkK45EME",
	    "msgtype":"image",
	    "image":
	    {
	      "media_id":"WTcRyvAmQ6kRG5rJU9HXmVTUpXEEer9jRDHKWblfZ9KeXkhjt9kudhgzFwNEhPhz"
	    }
	}';

	$res = Curl::post($url, $data);

	echo $res;



 ?>