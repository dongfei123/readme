<?php 

	//创建redis对象
	$redis = new Redis;

	//连接redis服务器
	$redis->connect('localhost', 6379);

	//输入密码
	$redis->auth('xiaohigh');

	//写入数据
	$res = $redis->set('name','xiaohighiloveyou abcdefg');

	var_dump($res);

 ?>