<?php 
	
	include './Libs/Curl.php';
	include './Libs/Token.php';

	//接口地址
	$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.Token::getToken();

	$data = array(
		'button' => array(
			array(
				"type"=>"click",
				"name" => "菜单1",
				"key" => "menu1"
				),
			array(
				"name" => "菜单二",
				"sub_button" => array(
					array(
						"type"=>"click",
						"name" => "菜单3",
						"key" => "menu2"
						),
					array(
						"type"=>"click",
						"name" => "菜单4",
						"key" => "menu4"
						),
					array(
						"type"=>"click",
						"name" => "菜单5",
						"key" => "menu5"
						)
					)
				)
		)
	);

	$data = encode_json($data);	

	/**
	$data = '{
      "button":[
	     {	
	          "type":"click",
	          "name":"菜单1",
	          "key":"V1001_TODAY_MUSIC"
	      },
	      {
	           "name":"菜单2",
	           "sub_button":[
	           {	
	               "type":"view",
	               "name":"搜索",
	               "url":"http://www.soso.com/"
	            },
	            {	
	               "type":"location_select",
	               "name":"发送位置",
	               "key":"location"
	            }
	            ]
	       },

			{
	           "name":"菜单3",
	           "sub_button":[
	           {	
	               "type":"scancode_push",
	               "name":"扫码1",
	               "key":"s1"
	            },
	            {
	               "type":"scancode_waitmsg",
	               "name":"扫码2",
	               "key":"s2"
	            },
				{
					"type":"pic_sysphoto",
					"name":"拍一拍",
					"key": "pai"
				},
				{
					"type": "pic_photo_or_album",
					"name":"拍照或选图",
					"key":"select"
				},
				{
					"type":"pic_weixin",
					"name":"微信相册",
					"key":"weixin"
				}
	            ]
	       }

	       ]
	 }';

	 //发送请求
	 $res = Curl::post($url, $data);

	 echo $res;

	*/

	$res = Curl::post($url, $data);

	echo $res;

	function encode_json($str){  
	    $code = json_encode($str);  
	    return preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $code);  
	}  

 ?>