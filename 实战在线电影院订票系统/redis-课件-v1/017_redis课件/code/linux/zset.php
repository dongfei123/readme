<?php 	

	//创建redis对象
	$redis = new Redis;

	//连接redis服务器
	$redis->connect('localhost', 6379);

	//输入密码
	$redis->auth('xiaohigh');

	//选择数据库
	$redis->select(1);

	//写入
		// $res = $redis->zadd('chengji', 50, 'zhangsan');
		// $res = $redis->zadd('chengji', 99, 'lisi');
		// $res = $redis->zadd('chengji', 80, 'wangwu');
		// $res = $redis->zadd('chengji', 75, 'zhaoliu');
		// $res = $redis->zadd('chengji', 86, 'zhaoqi');

		// $res = $redis->zadd('chengji', 65, 'xiaoa');
		// $res = $redis->zadd('chengji', 78, 'xiaob');
		// $res = $redis->zadd('chengji', 69, 'xiaoc');
		// $res = $redis->zadd('chengji', 90, 'xiaod');


	//删除
		// $res = $redis->zrem('chengji','xiaoa');

	//更新
		// $res = $redis->zincrby('chengji', 2, 'xiaob');


	//获取
		// $res = $redis->zrange('chengji', 0, 2);
		// $res = $redis->zrevrange('chengji', 0, 2);

		//根据权重的范围获取数据
		// $res = $redis->zrangebyscore('chengji', 80, 90);
		// $res = $redis->zrangebyscore('chengji', 80, 90, ['withscores'=>true, 'limit'=>[2,2]]);
		//倒序获取
		// $res = $redis->zrevrangebyscore('chengji', 100, 60, ['withscores'=>true]);

		//获取权重区间的元素个数
		// $res = $redis->zcount('chengji', 80, 100);

		//获取元素的个数
		// $res = $redis->zsize('chengji');

		//获取单个元素的权重
		// $res = $redis->zscore('chengji', 'zhangsan');

		//获取数据的排名
		// $res = $redis->zrank('chengji', 'zhangsan');
		$res = $redis->zrevrank('chengji', 'zhangsan');
		var_dump($res);


 ?>