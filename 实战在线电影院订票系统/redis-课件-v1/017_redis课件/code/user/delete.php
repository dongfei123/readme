<?php 
	
	//redis的初始化
	$redis = new Redis;
	$redis->connect('localhost', 6379);
	$redis->auth('');

	//获取用户的id
	$id = $_GET['id'];
	if(empty($id)) {
		echo '参数错误哦!!';die;
	}

	//拼接用户的键名
	$listKey = 'users';
	$key = 'user_'.$id;

	//删除hash数据
	$res1 = $redis->del($key);

	//删除列表列表中的id信息
	$res2 = $redis->lrem($listKey, $id, 1);

	if($res1 && $res2) {
		echo '<script>alert("删除成功");setTimeout(function(){location.href="index.php"}, 3000)</script>';
	}


 ?>