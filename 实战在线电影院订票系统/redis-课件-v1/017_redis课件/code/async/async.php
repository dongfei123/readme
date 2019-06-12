<?php 
	
	set_time_limit(0);
	
	$redis = new Redis;
	$redis->connect('localhost', 6379);
	//键名
	$key = 'questions';

	$pdo = new PDO('mysql:host=localhost;dbname=lamp;charset=utf8','root','');

	while(1) {
		//如果队列中存在数据
		if($redis->llen($key) > 0 ) {
			//读取数据
			$data = $redis->rpop($key);
			//数据转换
			$arr = unserialize($data);
			//数据库操作
			$stmt = $pdo->prepare('insert into users (username,password,email) values (:username, :password, :email)');

			//执行
			$stmt->execute($arr);
			//获取受影响的行数
			$res = $stmt->rowCount();

			var_dump($res);
			
		}else{
			//如果队列中没有数据的话 可以休息一下
			sleep(5);
		}
	}



 ?>