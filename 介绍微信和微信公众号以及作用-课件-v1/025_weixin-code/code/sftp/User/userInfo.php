<?php 	

	include '../Libs/Curl.php';
	include '../Libs/Token.php';

	$openid = 'oJAi9wtxmOSP2KUnrBE19td9j81Q';

	$url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.Token::getToken().'&openid='.$openid.'&lang=zh_CN';

	$res = Curl::get($url);

	echo $res;



 ?>