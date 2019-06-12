<?php 
	
	//实例化redis对象
	$redis = new Redis;
	$redis->connect('localhost',6379);

	//将数据装成字符串
	$str = serialize($_POST);

	$key = 'questions';

	$res = $redis->lpush($key, $str);

	if($res) {
		echo '我们已经收到您的信息了!!!';
	}

 ?>