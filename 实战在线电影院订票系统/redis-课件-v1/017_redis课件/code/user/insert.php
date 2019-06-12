<?php 
	//将数据插入到 redis中
	
	$redis = new Redis;
	$redis->connect('localhost', 6379);
	$redis->auth('');

	//设置主键自增id
	$id = $redis -> incr('user_id');
	//拼接用户 的key
	$key = 'user_'.$id;
	$listKey = 'users';

	//将数据写入到hash中  
	$res = $redis->hmset($key, $_POST);

	//将用户的id写入到一个列表中
	$res = $redis->rpush($listKey, $id);

	var_dump($res);







 ?>