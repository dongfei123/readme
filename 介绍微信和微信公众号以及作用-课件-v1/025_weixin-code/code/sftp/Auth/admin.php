<?php
	//判断用户是否授权  如果没有授权需要跳转到授权页
	session_start();
	if(empty($_SESSION['user'])) {
		$appid = 'wx4e49f38a17e39e43';
		$redirect = 'http://xiaox.xiaohigh.com/Auth/code.php';
		//跳转到授权页面
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect.'&response_type=code&scope=snsapi_userinfo&state=web';

		header('location: '.$url);
	}
?>