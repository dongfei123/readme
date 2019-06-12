<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2019 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\cache\driver\Memcache;

class IndexController extends HomeBaseController
{
	private static $name="董飞";
	private static $age=29; 
    public function index()
    {
    	$name = self::$name;
    	$age = self::$age;
    	$str = $this->str_random();
    	self::number_random();
    	$mem = new Memcache;
    	// $mem = $mem->connect("localhost",11211);
    	$num = $mem->get("numbers");
    	sort($num);
    	dump($name);
    	dump($age);
    	dump($str);
    	print_r($num);
    	$this->assign('randNum',$str);
        return $this->fetch(":index");
    }
    //返回随机六位数字
    private static function str_random(){
    	$str = str_shuffle("1234567890");
    	return mb_substr($str,0,6);
    }
    //返回100个0~10000的随机数
    private static function number_random(){
    	$index = 1;
    	$number_random = [];
    	do{
    		$num = mt_rand(0,10000);
    		$number_random[$index] = $num;
    		$number_random = array_unique($number_random);
    		$index++;
    	}while($index<101);
    	$mem = new Memcache;
    	// $mem = $mem->connect("localhost",11211);
    	$mem->set("numbers",$number_random,30);
    	// $mem->close();
    }


}
