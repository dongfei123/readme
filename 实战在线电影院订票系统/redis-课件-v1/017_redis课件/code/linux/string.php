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
		//写入字符串类型的值
		// $res = $redis -> set('week', '礼拜五!!!');

		//时效性的设置
		// $res = $redis->setex('test', 10, 'iloveyou');

		//批量设置
		// $res = $redis->mset(['a'=>'aaaa','b'=>'bbb','c'=>'ccccc']);

		//设置a
		// $res = $redis->setnx('d','ddddd');

	//删除
		// $res = $redis->delete('a');

		//批量删除
		// $res = $redis->delete(['b','c']);

	//修改更细
		// $res = $redis->set('d','iloveyou');

		//自增
		// $res = $redis->incr('total');
		// $res = $redis->incrby('total', 5);
		//自减
		// $res = $redis->decr('total');
		// $res = $redis->decrby('total', 10);

	//获取
		// $res = $redis->get('d');

		//批量获取
		$res = $redis->mget(['d','week','total']);


		var_dump($res);



 ?>