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
	// $res = $redis->hset('phone', 'brand','apple');
	// $res = $redis->hmset('phone', ['size'=>'4.9inch','price'=>2000,'color'=>'white']);


	//删除
	// $res = $redis->hdel('phone','color');

	//更新
	// $res = $redis->hset('phone','price', 1999);

	//自增
	// $res = $redis->hincrby('phone','age', 1);

	//获取
	// $res = $redis->hget('phone','brand');

	//select name,pass,email
	// $res = $redis->hmget('phone',['brand','price']);

	//获取字段的个数
	// $res = $redis->hlen('phone');

	//获取所有的字段名
	// $res = $redis->hkeys('phone');

	//获取所有的键值
	// $res = $redis->hvals('phone');

	//检测字段是否存在
	// $res = $redis->hexists('phone', 'brand');

	//获取所有的字段信息
	$res = $redis->hgetall('phone');


	var_dump($res);


 ?>