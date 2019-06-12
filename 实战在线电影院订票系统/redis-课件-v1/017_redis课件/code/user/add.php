<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>用户的录入</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="col-md-6 col-md-offset-3" style="padding-top:100px;">
			<form class="form-horizontal" action="insert.php" method="post">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
			    <div class="col-sm-10">
			      <input type="username"  name="username" class="form-control" id="inputEmail3" placeholder="">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="">
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">邮箱</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" name="email" id="inputPassword3" placeholder="">
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-default">添加</button>
			    </div>
			  </div>
			</form>

		</div>

	</div>
</body>
</html>