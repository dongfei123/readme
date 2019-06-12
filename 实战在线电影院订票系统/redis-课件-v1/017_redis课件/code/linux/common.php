<?php 

	//创建redis对象
	$redis = new Redis;

	//连接redis服务器
	$redis->connect('localhost', 6379);

	//输入密码
	$redis->auth('xiaohigh');

	//选择数据库
	$redis->select(1);

	//
	// $res = $redis->set('name','xiaohigh');

	//添加时效性
	// $redis->expire('name', 20);
	// $redis->expire('list-2', 20);


	//添加一个时效性的值
	// $res = $redis->setex('test_2', 30, 'value_2');

	// $res = $redis->ttl('test_2');

	//删除key
	// $res = $redis->del('list-1');

	//检测是否存在该key
	// $res = $redis->exists('chengji');

	//获取keys
	// $res = $redis->keys('*');

	//清除当前的数据库
	// $res = $redis->flushdb();

	//
	$res = $redis->flushall();

	var_dump($res);



 ?>