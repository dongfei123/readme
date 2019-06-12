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
		//单个写入
		// $res = $redis->lpush('list-1', 'zhangsan');
		// $res = $redis->lpush('list-1', 'lisi');
		// $res = $redis->lpush('list-1', 'wangwu');
		//批量写入
		// $res = $redis->lpush('list-1', 'zhaoliu','liqi');

		//右侧
		// $res = $redis->rpush('list-1', 'xiaoa');
		// $res = $redis->rpush('list-1','xiaob');
		// $res = $redis->rpush('list-1','xiaoc','xiaod','xiaoe');

		//在指定的位置插入元素
		// $res = $redis->linsert('list-1', Redis::BEFORE, 'xiaoa','xueqi');

	//删除
		//左侧弹出一个
		// $res = $redis->lpop('list-1');

		//右侧弹出
		// $res = $redis->rpop('list-1');

		//删除指定元素
		// $res = $redis->lrem('list-1', 'xueqi');

		//修改指定的元素的值
		// $res = $redis->lset('list-1', 4, 'xiaoe');

		//移动元素
		// $res = $redis->rpoplpush('list-1','list-2');

	//获取
		//获取索引上的值
		// $res = $redis->lindex('list-1', 4);

		//获取列表中一段的内容
		// $res = $redis->lrange('list-1', 0, 3);
		// $res = $redis->lrange('list-1', 0, -1);

		//获取列表的长度
		// $res = $redis->lsize('list-1');

		var_dump($res);




 ?>