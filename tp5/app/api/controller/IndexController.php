<?php

namespace app\api\controller;
use cmf\controller\HomeBaseController;
use \think\Validate;
use \think\DB;

class IndexController extends HomeBaseController {
	public function index() {
		echo "api ====>  module";
		$rule = [
			'name' => 'require|max:25',
			'age' => 'require|number|between:1,120',
			'email' => 'require|email'
		];
		$msg = [
			'name.require' => '名称必填',
			'name.max' => '名称最多不能超过25个字符',
			'age.number' => '年龄必须是数字',
			'age.between' => '年龄只能1-120之间',
			'email.email' => '邮箱格式错误',
			'email.require' => '邮箱必填',

		];
		$data = input('post.'); 
		$validate = new Validate($rule,$msg);
		$result = $validate->check($data);
		if(!$result){
			dump($validate->getError());
		}
	}
}


