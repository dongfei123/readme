<?php 
		
	include '../cache.php';

	session_set_save_handler(['Session','open'],['Session','close'],['Session','read'],['Session','write'],['Session','destroy'],['Session','gc']);

	class Session 
	{
		// session_start
		public static function open() {
			return true;
		}

		//
		public static function close() {
			return true;
		}

		//echo $_SESSION['name']
		public static function read($sid) {
			// var_dump(Cache::get($sid));
			return Cache::get($sid);
		}

		//$_SESSION['name'] = 'iloveyou';
		public static function write($sid, $data) {
			Cache::set($sid, $data, 600);
			return true;
		}

		//session_destroy
		public static function destroy($sid){
			Cache::delete($sid);
			return true;
		}

		//垃圾回收机制触发时 会执行该函数
		public static function gc() {
		}
	}

	//启动session
	// session_start();
	
	//写入session
	// $_SESSION['name'] = 'xiaohigh';

	//读取
	// $name = $_SESSION['name'];
	// var_dump($name);


	//删除session
	// session_destroy();

 ?>