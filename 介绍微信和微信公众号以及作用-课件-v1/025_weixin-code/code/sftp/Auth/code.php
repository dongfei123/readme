<?php 
	
	header('content-type:text/html;charset=utf-8');
	include '../Libs/Curl.php';
	$code = $_GET['code'];
	//获取access_token (auth2.0 token)
	$appid = 'wx4e49f38a17e39e43';
	$appsecret = 'ef3f9c6a26de2cf5588dce6e45fb7d67';

	$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';

	//发送请求
	$res = Curl::get($url);

	//提取信息
	$data = json_decode($res, true);

	$openid = $data['openid'];
	$token = $data['access_token'];

	$url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';

	$user = Curl::get($url);

	echo $user;


 ?>