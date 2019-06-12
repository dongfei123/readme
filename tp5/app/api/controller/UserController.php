<?php

namespace app\api\controller;

class UserController extends CommonController {

	public function index($id) {
		echo "controller --user-- ";
		echo "<br/>";
		echo $id;

	}

	public function login(){
		echo "<br/>";
		echo "controller --login-- ";
		echo "<br/>";
	}
	public function upload_head_img(){
		/*****接受参数*****/
		$data = $this->param;
		/*****上传图片获得路径*****/
		$head_img_path = $this->upload_file($data['user_icon'],'head_img');
		/*****存入数据库*****/
		$res = db('users')->where('user_id',$data['user_id'])->setField('user_icon',$head_img_path);
		dump(str_replace('\\','/',ROOT_PATH.'public'.$head_img_path));die;
		if($res){
			$this->return_msg(200,'上传头像成功!',$head_img_path);
		}else{
			/***删除上传的头像***/
			unlink(ROOT_PATH.'public'.$head_img_path);
			$this->return_msg(400,'上传头像失败!');
		}		
	}

	/**
	 *用户进行注册
	 *@return [json]      [返回结果json格式数据]
	 */
	public function register(){
		/***接收参数***/
		$data = $this->param;
		/***检查验证码***/
		$this->check_code($data['user_name'],$data['code']);
		/***检测用户数据***/
		$user_name_type = $this->check_username($data['user_name']);
		switch($user_name_type){
			case 'phone':
				$this->check_exist($data['user_name'],'phone',0);
				$data['user_phone'] = $data['user_name'];
				break;
			case 'email':
				$this->check_exist($data['user_name'],'email',0);
				$data['user_email'] = $data['user_name'];
				break;
		}
		/***将用户信息写入数据库***/
		unset($data['user_name']);
		$data['user_rtime'] = time();//register  time
		$res = db('users')->insert($data);
		if(!$res){
			$this->return_msg(400,"用户注册失败！");
		}else{
			$this->return_msg(200,"用户注册成功！",$res);
		}
	}
}


