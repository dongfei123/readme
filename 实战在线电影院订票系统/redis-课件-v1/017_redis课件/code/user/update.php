<?php 

	//redis的初始化
	$redis = new Redis;
	$redis->connect('localhost', 6379);
	$redis->auth('');

	//获取用户的id
	$id = $_POST['id'];
	$key = 'user_'.$id;

	//更新
	$res = $redis->hmset($key, $_POST);

	

 ?>
