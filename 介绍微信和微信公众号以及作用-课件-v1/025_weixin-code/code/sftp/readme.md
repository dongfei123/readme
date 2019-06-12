## 服务器如何查看请求是否已经收到请求

## 大文件是需要预上传, 上传完毕之后得到该文件对应的mediaId.

## json_encode中文转码问题
	1. 5.4之后的版本
		json_encode($str, JSON_UNESCAPED_UNICODE);  
	2. 5.4之前的版本
		```
		function encode_json($str){  
		    $code = json_encode($str);  
		    return preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $code);  
		} 
		``` 