<?php 
	
	include './cache.php';

	$key = 'singer_10';

	//读取缓存
	if(!Cache::has($key)) {
		echo 'from mysql<br>';
		include "./libs/Model.php";
		$singer = new Model('singers');
		$data = $singer->first(10);
		//写入缓存
		Cache::set($key, $data, 30);
	}else{
		echo 'from cache<br>';
		$data = Cache::get($key);
	}
	

	var_dump($data);




 ?>