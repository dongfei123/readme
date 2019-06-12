<?php 
	
	include './Libs/Curl.php';
	include './Libs/Token.php';

	//接口地址
	$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.Token::getToken();

	//
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
	               "name":"发送位置"
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
					"name":"拍一拍"
				},
				{
					"type": "pic_photo_or_album",
					"name":"拍照或选图"
				},
				{
					"type":"pic_weixin",
					"name":"微信相册"
				}
	            ]
	       }

	       ]
	 }';


	 //发送请求
	 $res = Curl::post($url, $data);

	 echo $res;

 ?>