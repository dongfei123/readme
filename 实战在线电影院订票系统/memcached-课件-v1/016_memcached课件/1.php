<?php 

	//创建memcache对象
	$mem = new Memcache;

	//连接memcache服务器
	$mem->connect('127.0.0.1', 11211);

	//写入
	// $mem->set('name','xiaohigh',MEMCACHE_COMPRESSED, 0);
	// $res = $mem->set('fruit',['apple','pear','banaba'], MEMCACHE_COMPRESSED, 0);

	//读取
	// $res = $mem->get('name');
	// $res = $mem->get('fruit');

	//删除
	// $res = $mem->delete('name');

	//清除
	// $res = $mem->flush();

	//断开连接
	$mem->close();

 ?>