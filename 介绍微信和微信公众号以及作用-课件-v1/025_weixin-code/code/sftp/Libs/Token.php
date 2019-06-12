<?php 

	class Token
	{
		// public static $appid = 'wx8ed34585c55c40e3';
		// public static $appsecret = 'fef97ac02d867af5d4664d8d26a477eb';

		public static $appid = 'wx4e49f38a17e39e43';
		public static $appsecret = 'ef3f9c6a26de2cf5588dce6e45fb7d67';
		

		public static function getToken()
		{
			//接口地址
			$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.self::$appid.'&secret='.self::$appsecret;
			//发送get请求
			$res = Curl::get($url);
			//解析数据
			$data = json_decode($res, true);

			return $data['access_token'];
		}

	}


 ?>