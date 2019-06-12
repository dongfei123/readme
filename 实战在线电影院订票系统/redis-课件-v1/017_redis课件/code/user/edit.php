<?php 

	$redis = new Redis;
	$redis->connect('localhost', 6379);
	$redis->auth('');

	//获取用户的id
	$id = $_GET['id'];
	if(empty($id)) {
		echo '参数错误哦!!';die;
	}

	//拼接用户的键名
	$key = 'user_'.$id;

	//
	$userInfo = $redis->hgetall($key);
	$userInfo['id'] = $id;

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户更新</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="col-md-6 col-md-offset-3" style="padding-top:100px;">
			<form class="form-horizontal" action="update.php" method="post">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
			    <div class="col-sm-10">
			      <input type="username" value="<?php echo $userInfo['username']; ?>"  name="username" class="form-control" id="inputEmail3" placeholder="">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
			    <div class="col-sm-10">
			      <input type="" value="<?php echo $userInfo['password']; ?>" class="form-control" name="password" id="inputPassword3" placeholder="">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">邮箱</label>
			    <div class="col-sm-10">
			      <input type="" class="form-control" value="<?php echo $userInfo['email']; ?>" name="email" id="inputPassword3" placeholder="">
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			    	<input type="hidden" name="id" value="<?php echo $userInfo['id']; ?>">
			      <button type="submit" class="btn btn-default">修改</button>
			    </div>
			  </div>
			</form>

		</div>

	</div>
</body>
</html>