<?php 
	
	header('content-type:image/jpeg');

	include '../Libs/Curl.php';
	include '../Libs/Token.php';	

	//张三
	// $ticket = 'gQGE8TwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyYUFSRzBIQThlWjIxMDAwMDAwN3YAAgTcedxZAwQAAAAA';

	//李四
	$ticket = 'gQFx8TwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAySVNNSDBWQThlWjIxMDAwMDAwN0EAAgQfetxZAwQAAAAA';
	//接口地址
	$url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket;

	$res = Curl::get($url);

	echo $res;

 ?>