<?php 
	
	$config  = include 'config.php';
	
	class RedisCache
	{	
		public static $redis = null;

		/**
		 * 获取redis对象
		 */
		public static function getInstance()
		{
			global $config;

			if(self::$redis == null) {
				self::$redis = new Redis;
				self::$redis->connect($config['redis']['host'], $config['redis']['port']);
				self::$redis->auth($config['redis']['auth']);
			}
			return self::$redis;
		}

		/**
		 * 写入缓存
		 */
		public static function set($key, $value, $time)
		{
			//实例化redis对象
			return self::getInstance()->setex($key, $time, $value);
		}

		/**
		 * 读取缓存
		 */
		public static function get($key)
		{
			return self::getInstance()->get($key);
		}

		/**
		 * 检测缓存是否存在
		 */
		public static function exists($key)
		{
			return self::get($key) === false ? false : true;
		}

		/**
		 * 删除缓存
		 */
		public static function delete($key)
		{
			return self::getInstance()->delete($key);
		}
	}

	//缓存数据
	$res = RedisCache::set('pingban', 'xiaomi', 30);
	//读取数据
	// $res = RedisCache::get('name');
	//检测
	// $res = RedisCache::exists('nameddfdffdf');
	//删除
	// $res = RedisCache::delete('name');

	// var_dump($res);



 ?>