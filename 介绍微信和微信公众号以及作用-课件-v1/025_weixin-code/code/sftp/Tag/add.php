<?php 
	
	include '../Libs/Curl.php';
	include '../Libs/Token.php';

	//标签的创建
	$url = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token='.Token::getToken();

	// $data = '{
	//   "tag" : {
	//     "name" : "广东"//标签名
	//   }
	// }';

	//数据数组
	$data = array(
		"tag" => array(
			"name"=>'vip'
			)
		);

	//json的转换
	$data = encode_json($data);

	//发送请求
	$res = Curl::post($url, $data);

	echo $res;



	function encode_json($str){  
	    $code = json_encode($str);  
	    return preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $code);  
	}  

 ?>