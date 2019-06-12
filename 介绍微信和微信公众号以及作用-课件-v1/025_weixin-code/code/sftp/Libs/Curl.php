<?php 

	class Curl
	{
		//模拟发送get请求
		public static function get($url, $header=array()) {
			//1. 初始化
			$ch = curl_init($url);

			//2. 设置选项
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//opt  option
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);// 一定要加  file_get_contents
			if(!empty($header)){
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			}

			//3. 执行
			$res = curl_exec($ch);

			//4. 关闭
			curl_close($ch);

			return $res;
		}

		//模拟发送post请求
		public static function post($url, $data=array(), $header=array()) {
			$ch = curl_init($url);

			//
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			//设置post请求选项
			curl_setopt($ch, CURLOPT_POST, 1);
			//设置post字段内容
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			if(!empty($header)){
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			}

			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			//时间设置
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);

			//执行
			$res = curl_exec($ch);

			// var_dump(curl_error($ch));

			//
			curl_close($ch);

			return $res;
		}

		//模拟发送file请求 (文件上传)
		/**
		 * @param $url  请求的url地址   eg: http://www.a.com/index.php
		 * @param $data 普通字段值    eg: ['username'=>'abc' , 'email'=>'1121@qq.com']
		 * @param $file 文件上传字段 路径一定要为绝对路径 eg: ['img'=>'D:/1.jpg','profile'=>'D:/2.jpg'] 
		 * @param $header  头信息数组  eg: ['user-agent: abc','referer: www.baidu.com']
		 */
		public static function ufile($url, $data, $file, $header) {
			$ch = curl_init($url);

			//
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			//实例化curlFIle  class   这里必须要使用绝对路径   php5.5版本之前  

			if(!empty($file)) {
				$tmp = array();
				foreach ($file as $key => $value) {
					// $tmp[$key] = new curlFile($value);
					$tmp[$key] = '@'.$value;
				}
				$data = array_merge($data, $tmp);
			}

			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			if(!empty($header)){
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			}

			//获取结果
			$res = curl_exec($ch);

			$r =curl_error($ch);

			curl_close($ch);

			return $res;
		}

	}

 ?>