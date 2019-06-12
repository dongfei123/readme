<?php 

	/**
	 * memcache缓存类的封装
	 */

	class Cache
	{	

		public static $cache = null;

		//创建对象 单例模式
		public static function getInstance()
		{
			if(self::$cache == null) {
				self::$cache = new Memcache;
				$res = self::$cache -> connect('localhost', 11211);
				//判断是否连接成功
				if($res === false){
					echo '连接失败!!';die;
				}
			}
			return self::$cache;
		}

		//写入缓存
		public static function set($key, $value, $lifetime)
		{
			//实例化对象
			return self::getInstance()->set($key, $value, MEMCACHE_COMPRESSED, $lifetime);
		}

		//读取缓存
		public static function get($key)
		{
			return self::getInstance()->get($key);
		}

		//检测缓存是否存在  
		public static function has($key)
		{
			return self::get($key) === false ? false : true;
		}

		//删除缓存
		public static function delete($key) 
		{
			return self::getInstance()->delete($key);
		}

	}



 ?>