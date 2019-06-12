<?php

namespace app\api\controller;
use cmf\phpmailer\phpmailer;
use cmf\submail\messagexsend;

class CodeController extends CommonController {
   /**
	*获取验证码
	*@param [string] $username [接收的用户手机或邮箱]
	*@return [type]      [description]
	*/
	public function get_code(){
		$username = $this->param['username'];
		$exist    = $this->param['is_exist'];
		$username_type = $this->check_username($username);
		switch($username_type){
			/*****根据用户类型发送验证码*****/
			case 'phone':
				$this->get_code_by_username($username,'phone',$exist);
				break;
			case 'email':	
				$this->get_code_by_username($username,'email',$exist);
				break;
		}
	   

	}
	/**
		*通过手机/邮箱发送验证码
		*@param [string] $username [用户号]
		*@param [string] $type [用户类型]
		*@param [int] $exist [手机号数据库是否存在]
		*@return [json]    [api返回json数据]
		*/
	public function get_code_by_username($username,$type,$exist){
		if($type == 'phone'){
			$type_name = '手机';
		}else{
			$type_name = '邮箱';
		}
		/***检测手机号/邮箱是否存在***/
		$is_exist = $this->check_exist($username,$type,$exist);
		/***检查验证请求频率30秒 一次***/
		if(session('?'.$username.'_last_send_time')){
			if(time()-session($username.'_last_send_time')<30){
				$this->return_msg(400,$type_name.'验证码 每30秒发送一次');
			}
		}
		/***生成验证码***/
		$code = $this->make_code(6);
		/***session存储验证码 方便后期比对  MD5加密***/
		$md5_code = md5($username.'_'.md5($code));
		session($username.'_code',$md5_code);
		/***session存储验证码发送时间***/
		session($username.'_last_send_time',time());
		/***发送验证码***/
		if($type == 'phone'){
			$this->send_code_to_phone($username,$code);
		}else{
			$this->send_code_to_email($username,$code);
		}
	}
   /**
    *生成验证吗
    *@param [int] $num [生成验证位数]
    *@return [int]  $code    [返回验证码]
    */
   public function make_code($num){
   		$max = pow(10,$num)-1;
   		$min = pow(10,$num-1);
   		$code = rand($min,$max);
   		return $code;
   }
   /**
    *通过手机向用户发送验证码
    *@param [string] $phone [手机]
    *@param [int] $code [验证码]
    *@return [json]      [api返回json数据]
    */
   //获取证书url(https://curl.haxx.se/docs/caextract.html);
   //短信api发送
    public function send_code_to_phone($phone,$code){
    		$curl = curl_init();
    		curl_setopt($curl,CURLOPT_URL,"https:://api.mysubmail.com/message/xsend");
    		curl_setopt($curl,CURLOPT_HEADER,0);
    		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    		curl_setopt($curl,CURLOPT_POST,1);
    		$data = [
    			'appid'=>'',
    			'to'=>'13333333333',
    			'project'=>'',
    			'vars'=>'{"code":'.$code.',"time":"60"}',
    			'signature'=>'appkey',
    		];
    		curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
    		$res = curl_exec($curl);
   			$res = json_encode($res);
   			if($curl->status != 'success'){
   				$this->return_msg(400,$res->msg);
   			}else{
   				$this->return_msg(200,'手机验证码已发送， 每天发送5次，请在一分钟内验证！');
   			}
    		curl_close($curl);
    }
   //短信SDK发送
   // public function send_code_to_phone($phone,$code){
   		
   // }
   /**
    *通过邮箱向用户发送验证码
    *@param [string] $email [邮箱]
    *@param [int] $code [验证码]
    *@return [json]      [api返回json数据]
    */
   public function send_code_to_email($email,$code){
   		$toemail = $email;
   		$mail = new PHPMailer();
   		$mail->isSMTP();
   		$mail->CharSet = 'utf8';
   		$mail->Host = 'smtp.126.com';
   		$mail->SMTPAuth = true;
   		$mail->Username = 'df19979220486@126.com';
   		$mail->Password = 'DF199023DF';
   		$mail->SMTPSecure = 'ssl';
   		$mail->Port = 994;
   		$mail->setFrom('df19979220486@126.com','接口测试');
   		$mail->addAddress($toemail,'test');
   		// $mail->addReply('df19979220486@126.com','Reply');
   		$mail->Subject = "您有新的验证码！";
   		$mail->Body = "这是一个测试邮件，您的验证码是".$code."验证码的有效期是1分钟，本邮件请勿回复！";
   		if(!$mail->send()){
   			$this->return_msg(400,$mail->ErrorInfo);
   		}else{
   			$this->return_msg(200,'验证码已经发送成功，请注意查收！');
   		}
   }

}