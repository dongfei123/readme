<?php 

	//检测缓存是否存在
	///声明键名
	$key = md5($_SERVER['REQUEST_URI']);

	$mem = new memcache;
	$mem->connect('127.0.0.1', 11211);

	$cache = $mem->get($key);

	//没有缓存
	if($cache === false){
		echo 'from mysql<br>';

		include './libs/Model.php';
		include './libs/Page.php';

		//实例化对象
		$singer = new Model('singers');

		//统计数据的总数
		$count = $singer -> count();

		//实例化分页对象
		$page = new Page($count, 10);

		//获取limit参数
		$limit = $page->limit();

		//读取数据
		$data = $singer->limit($limit)->get();

		//获取分页的页面连接
		$pages = $page->show();

		//将数据写入缓存
		$mem->set($key, $data, MEMCACHE_COMPRESSED, 10);
		$mem->set('page', $pages, MEMCACHE_COMPRESSED, 10);


	}else{
		echo 'from cache<br>';
		//如果缓存存在
		$data = $mem->get($key);
		$pages = $mem->get('page');
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
			<?php foreach ($data as $key => $value): ?>
			<tr><td><?php echo $value['id'] ?></td><td><?php echo $value['name'] ?></td><td><a href="">修改</a><a href="">删除</a></td></tr>
			<?php endforeach ?>
		</table>

		<div><?php echo $pages; ?></div>
	</div>
</body>
</html>