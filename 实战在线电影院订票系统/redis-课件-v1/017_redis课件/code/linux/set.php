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
		//将数据写入到集合中
		$res = $redis->sadd('sports-2','篮球');
		//批量写入
		$res = $redis->sadd('sports-2','乒乓球','羽毛球','足球','台球','桌上足球');

	//删除
		// $res = $redis->srem('sports', '足球');

	//修改
		// $res = $redis->smove('sports','favirate', '篮球');

	//获取
		//获取所有的值
		// $res = $redis->smembers('sports');

		//获取元素的个数
		// $res = $redis->ssize('sports');

		//随机取出一个
		// $res = $redis->srandmember('sports');

		//获取交集
		// $res = $redis->sinter('sports','sports-2');

		//获取并集
		// $res = $redis->sunion('sports','sports-2');

		//获取差集
		// $res = $redis->sdiff('sports-2', 'sports');

		//检测元素
		// $res = $redis->sismember('sports', '羽毛球');
		// var_dump($res);

 ?>