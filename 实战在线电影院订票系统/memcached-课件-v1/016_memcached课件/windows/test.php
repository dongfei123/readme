<?php 

	$mem = new Memcache;

	$mem->connect('localhost',11211);

	//写入
	$res = $mem->set('name','iloveyou',MEMCACHE_COMPRESSED,60);

	var_dump($res);

	//关闭
	$mem->close();


 ?>