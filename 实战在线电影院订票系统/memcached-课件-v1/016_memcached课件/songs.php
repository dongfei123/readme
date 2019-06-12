<?php 

	/**
	 * 歌手的列表显示页面
	 */
	//检测缓存是否存在
	//将数据写入到缓存
	$mem = new Memcache;
	$mem->connect('127.0.0.1', 11211);
	//缓存的键名
	$key = 'singers';
	//获取缓存
	$cache = $mem->get($key);
	//如果缓存存在
	if($cache !== false) {
		//读取缓存
		$singers = $cache;
		echo 'from cache!!!<br>';
	}else{
		//缓存不存在的情况
		$pdo = new PDO('mysql:host=localhost;dbname=lamp;charset=utf8','root','123456');
		$stmt = $pdo->query('select * from singers limit 10');
		//获取结果
		$singers = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//缓存60s
		$mem->set('singers', $singers, MEMCACHE_COMPRESSED, 5);
		echo 'from mysql!!!<br>';
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>列表显示</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="col-md-6 col-md-offset-3">
		<table class="table table-bordered table-striped"> 
			<tr><td>id</td><td>歌手名</td><td>操作</td></tr>
			<?php foreach ($singers as $key => $value): ?>
			<tr><td><?php echo $value['id'] ?></td><td><?php echo $value['name'] ?></td><td><a href="">修改</a><a href="">删除</a></td></tr>
			<?php endforeach ?>
		</table>
	</div>
</body>
</html>