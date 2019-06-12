<?php 

	$redis = new Redis;
	$redis->connect('localhost', 6379);
	$redis->auth('');

	//读取数据
	$userKey = 'users';
	//根据页码获取列表中的数据
	$page = !empty($_GET['page']) ? $_GET['page'] : 1;
	$num = 5;
	//声明空数组
	$data = [];

	//获取数据的id
	$res = $redis->lrange($userKey, ($page-1) * 5,  ($page-1) * 5 + ($num - 1));// n 
	
	//获取用户的数据
	foreach ($res as $k => $v) {
		//获取用户的key
		$ukey = 'user_'.$v;
		$tmp = $redis->hmget($ukey, ['username','password','email']);
		$tmp['id'] = $v;
		//压入数组中
		$data[] = $tmp;
	}


	//分页 获取分页的页码
	include 'Page.php';
	$page = new Page($redis->llen($userKey), $num);
	$pages = $page->show();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户列表</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<table class="table table-striped table-bordered">
			<tr><td>ID</td><td>用户名</td><td>密码</td><td>操作</td></tr>
			<?php foreach ($data as $key => $value): ?>
			<tr><td><?php echo $value['id'] ?></td><td><?php echo $value['username'] ?></td><td><?php echo $value['password'] ?></td><td><a href="edit.php?id=<?php echo $value['id'] ?>">修改</a>  <a href="delete.php?id=<?php echo $value['id'] ?>">删除</a></td></tr>
			<?php endforeach ?>
		</table>
		<div><?php echo $pages; ?></div>
	</div>
</body>
</html>