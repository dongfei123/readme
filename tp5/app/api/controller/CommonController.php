<?php

namespace app\api\controller;
use cmf\controller\HomeBaseController;
use think\Request;
use think\Validate;
use think\Image;
use think\Db;

class CommonController extends HomeBaseController {
	protected $validate;//验证参数
	protected $request;//将用来处理参数
	protected $param; //过滤后符合要求的参数
	protected $rules = array(
		'User' => array(
			'login' => array(
				'user_name'=>"require|chsDash|max:25",
				'user_pwd'=>"require|number|max:30",
			),
			'register' => array(
				'user_name'=>"require|chsDash|max:25",
				'user_pwd'=>"require|chsDash|max:25|min:6",
				'code'=>"require|number|length:6",
			),
			'upload_head_img' => array(
				'user_id'=>"require|number",
				'user_icon'=>"require|image|fileSize:2000000|fileExt:jpg,jpeg,png,bmp",
			),
		),
		'Code' => array(
			'get_code' => array(
				'username' => 'require',
				'is_exist' => 'require|number|length:1',
			),
		),
	);
	public function _initialize() {
		parent::_initialize();
		//接口安全验证过滤参数
		$this->request = Request::instance();
		// $this->check_time($this->request->only(['time']));
		// dump($this->request->param());
		// $this->check_token($this->request->param());
		$this->param = $this->check_param($this->request->param(true));
	}
	/**
	 *验证请求是否超时
	 *@param [type] $arr [包含时间戳的参数数组]
	 *@return [json]      [检测结果]
	 */ 
	public function check_time($arr){
		if(!isset($arr['time'])||intval($arr['time'])<=1){
			$this->return_msg(400,'时间戳不正确');
		}
		if(time()-intval($arr['time'])>60){
			$this->return_msg(401,'请求超时!');
		}
	}
   /**
 	*返回验证信息
 	*@param [int] $code [状态码: 200：正常  /4** 数据问题   /5*** 服务器问题]
 	*@param [string] $msg [接口返回的提示信息]
 	*@param [array] $data [接口返回数据]
 	*@return [json]     [结果的json数据]
 	*/	
	public function return_msg($code,$msg='',$data=[]){
		/**********组合数据********/
		$return_data['code'] = $code;
		$return_data['msg'] = $msg;
		$return_data['data'] = $data;
		/*******返回信息并终止脚本*******/
		echo json_encode($return_data); die;
	}
   /**
	*验证token 防止篡改数据
	*@param [array] $arr [请求参数]
	*@return [json] $data     [结果返回数据]
	*/
	public function check_token($arr){
		/******api传过来的token*****/
		if(!isset($arr['token'])||empty($arr['token'])){
			$this->return_msg(400,'token不能为空！');
		}
		$app_token = $arr['token'];//api传过来的token
		/********服务器端生成token********/
		unset($arr['token']);
		$service_token = '';
		foreach($arr as $key=>$value){
			$service_token .= md5($value);
		}
		$service_token = md5('api_'.$service_token.'_api');//服务器端生成的token
		/*******对比token 返回结果 ******/
		if($app_token !== $service_token){
			$this->return_msg(400,'token值不正确!');
		}
	}
   /**
	*验证参数  参数过滤
	*@param [array] $arr [需要验证的参数数组]
	*@return [json]      [返回过滤后的数据]
	*/
	public function check_param($arr=[]){
		/********获取参数验证规则*******/
		$rule = $this->rules[$this->request->controller()][$this->request->action()];
		/*****验证参数返回信息*****/
		$this->validate = new Validate($rule);
		if(!$this->validate->check($arr)){
			$this->return_msg(400,$this->validate->getError());
		}
		/******验证通过的参数******/
		return $arr;
	}
   /**
	*上传文件
	*@param [object] $file  [上传的文件]
	*@return [json]      [上传结果json数据]
	*/
	public function upload_file($file,$type=''){
		$info = $file->move(ROOT_PATH.'public'.DS.'uploads');
		if($info){
			$path = str_replace('\\','/',ROOT_PATH.'public/uploads/'.$info->getSaveName());
			/****裁剪图片****/
			if(!empty($type)){
				$this->image_edit($path,$type);
			}
			return str_replace('\\','/','/uploads/'.$info->getSaveName());
		}else{
			$this->return_msg(400,$file->getError());
		}
	}

   /**
	*裁剪图片
	*@param [sting] $path [图片路径]
	*@return [json]      [结果json数据]
	*/
	public function image_edit($path,$type=''){
		$image = Image::open($path);
		switch($type){
			case 'head_img':
			$image->thumb(200,200,Image::THUMB_CENTER)->save($path);
			break;
		}
	}

   /**
	*检测用户名返回用户类型
	*@param [string] $username [用户名]
	*@return [string]   [返回检测结果]
	*/
	public function check_username($username){	
		$is_email = Validate::is($username,'email')?1:0;
		$is_phone = preg_match('/^1[345789]\d{9}$/',$username)?4:2; 
		$flag = $is_email + $is_phone;
		switch($flag){
			/****not phone not email****/
			case 2:
				$this->return_msg(400,'手机或邮箱不正确！');
				break;
			/****is phone not email****/
			case 3:
				return 'email';
				break;
			/****is email not phone****/
			case 4:
				return 'phone';
				break;
		}

	}
	/**
	 *检测手机/邮箱是否存在
	 *@param [string] $value [用户名]
	 *@param [string] $type [用户名类型]
	 *@param [int] $exist [用户名是否数据库存在1,0]
	 *@return [type]      [description]
	 */
	public function check_exist($value,$type,$exist){
		$type_num = $type == 'phone' ? 2 : 4;
		$flag = $type_num + $exist;
		$phone_res = db('users')->where('user_phone',$value)->find();
		$email_res = db('users')->where('user_email',$value)->find();
		switch($flag){
			/******/
			case 2:
				if($phone_res){
					$this->return_msg(400,'此手机号已被占用！');
				}
				break;
			case 3:
				if(!$phone_res){
					$this->return_msg(400,'此手机号不存在！');
				}
				break;
			case 4:
				if($email_res){
					$this->return_msg(400,'此邮箱已被占用！');
				}
				break;
			case 5:
				if(!$email_res){
					$this->return_msg(400,'此邮箱不存在！');
				}
				break;
		}
	}
	/**
	 *检测验证码
	 *@param [string] $user_name [用户名]
	 *@param [int] $code [验证码]
	 *@return [json]      [api返回json数据]
	 */
	public function check_code($user_name,$code){
		/***检测是否超时***/
		$last_time = session($user_name.'_last_send_time');
		if(time()-$last_time>60){
			$this->return_msg(400,"验证码已超时，请在一分钟内验证！");
		}
		/***检测验证码是否正确***/
		if(session($user_name.'_code') !== md5($user_name.'_'.md5($code))){
			$this->return_msg(400,'验证码不正确！');
		}
		/***每个验证码只能验证一次***/
		session($user_name.'_code',null);
	}
}


