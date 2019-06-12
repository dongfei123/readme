<?php 

	//设置行业
	include './Libs/Curl.php';
	include './Libs/Token.php';

	$url = 'https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token='.Token::getToken();

	$data = ' {
          "industry_id1":"1",
          "industry_id2":"6"
       }';

    $res = Curl::post($url, $data);

    echo $res;


 ?>