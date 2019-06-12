<?php 

	// var_dump($_FILES);die;

	include './Libs/Curl.php';
	include './Libs/Token.php';

	//得到token 
	$token = Token::getToken();

	//接口地址
	$url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$token.'&type='.$_POST['type'];

	//获取文件的后缀
	$suffix = trim(strrchr($_FILES['file']['type'], '/'),'/');
	$name = time().rand(100,2000);
	$filePath = './Uploads/'.$name.'.'.$suffix;

	//文件上传操作
	move_uploaded_file($_FILES['file']['tmp_name'], $filePath);

	//上传文件
	$res = Curl::ufile(
			$url, 
			array(), 
			array('media'=> realpath($filePath)), 
			array()
		);


	var_dump($res);








 ?>