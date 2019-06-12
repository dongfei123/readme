<?php 

	include '../Libs/Curl.php';
	include '../Libs/Token.php';	
	//接口地址
	$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.Token::getToken();


	$data = '{"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "李四"}}}';

	$res = Curl::post($url, $data);

	echo $res;

	//gQGE8TwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyYUFSRzBIQThlWjIxMDAwMDAwN3YAAgTcedxZAwQAAAAA    张三

	//gQFx8TwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAySVNNSDBWQThlWjIxMDAwMDAwN0EAAgQfetxZAwQAAAAA    李四


 ?>