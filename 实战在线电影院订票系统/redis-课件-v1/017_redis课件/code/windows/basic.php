<?php 

	$redis = new Redis;

	$redis->connect('localhost', 6379);

	//写入
	$res = $redis->set('name','iloveyou');

	var_dump($res);

 ?>