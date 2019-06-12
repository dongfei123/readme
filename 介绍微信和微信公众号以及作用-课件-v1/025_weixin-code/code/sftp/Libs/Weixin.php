<?php 

	class Weixin
	{
		private $postObj = null;
		private $FromUserName = '';
		private $ToUserName = '';
		/**
		 * 初始化操作
		 */
		public function __construct()
		{
			//获取微信发送过来的内容
			$str = file_get_contents("php://input");
			//记录日志
			file_put_contents('log.txt', $str."\r\n\r\n", FILE_APPEND);
			//解析字符串为对象
			libxml_disable_entity_loader(true);
			$this->postObj = simplexml_load_string($str, 'SimpleXMLElement', LIBXML_NOCDATA);

			$this->FromUserName = $this->postObj->FromUserName;
			$this->ToUserName = $this->postObj->ToUserName;
		}

		/**
		 * 被动回复文本
		 */
		public function bReplyText($content)
		{
			//文本
			echo '<xml>
			<ToUserName><![CDATA['.$this->FromUserName.']]></ToUserName>
			<FromUserName><![CDATA['.$this->ToUserName.']]></FromUserName>
			<CreateTime>'.time().'</CreateTime>
			<MsgType><![CDATA[text]]></MsgType>
			<Content><![CDATA['.$content.']]></Content>
			</xml>';die;
		}

		/**
		 * 根据配置进行回复
		 */
		public function bReplyByConfig()
		{
			//引入配置文件
			$message = include './Config/message.php';
			//获取用户的输入内容
			$Content = $this->postObj->Content;
			//检测键名是否存在
			$res = array_key_exists((String)$Content, $message);
			//自动回复配置存在
			if($res){
				$this->bReplyText($message[(String)$Content]);
			}else{
				$this->bReplyText('welcome');
			}
		}

		/**
		 * 被动回复图片消息
		 */
		public function bReplyImage($mediaId)
		{
			echo '<xml>
				<ToUserName><![CDATA['.$this->FromUserName.']]></ToUserName>
				<FromUserName><![CDATA['.$this->ToUserName.']]></FromUserName>
				<CreateTime>'.time().'</CreateTime>
				<MsgType><![CDATA[image]]></MsgType>
				<Image>
				<MediaId><![CDATA['.$mediaId.']]></MediaId>
				</Image>
				</xml>';die;
		}

		/**
		 * 被动的回复语音消息
		 */
		public function bReplyVoice($mediaId)
		{
			echo '<xml>
			<ToUserName><![CDATA['.$this->FromUserName.']]></ToUserName>
			<FromUserName><![CDATA['.$this->ToUserName.']]></FromUserName>
			<CreateTime>'.time().'</CreateTime>
			<MsgType><![CDATA[voice]]></MsgType>
			<Voice>
			<MediaId><![CDATA['.$mediaId.']]></MediaId>
			</Voice>
			</xml>';
		}

		/**
		 * 被动回复视频消息
		 */
		public function bReplayVideo($mediaId, $title, $description)
		{
			echo '<xml>
			<ToUserName><![CDATA['.$this->FromUserName.']]></ToUserName>
			<FromUserName><![CDATA['.$this->ToUserName.']]></FromUserName>
			<CreateTime>'.time().'</CreateTime>
			<MsgType><![CDATA[video]]></MsgType>
			<Video>
			<MediaId><![CDATA['.$mediaId.']]></MediaId>
			<Title><![CDATA['.$title.']]></Title>
			<Description><![CDATA['.$description.']]></Description>
			</Video> 
			</xml>';
		}

		/**
		 * 被动回复音乐消息
		 */
		public function bReplyMusic($title, $description,$music_url, $media_id)
		{
			echo '<xml>
			<ToUserName><![CDATA['.$this->FromUserName.']]></ToUserName>
			<FromUserName><![CDATA['.$this->ToUserName.']]></FromUserName>
			<CreateTime>'.time().'</CreateTime>
			<MsgType><![CDATA[music]]></MsgType>
			<Music>
			<Title><![CDATA['.$title.']]></Title>
			<Description><![CDATA['.$description.']]></Description>
			<MusicUrl><![CDATA['.$music_url.']]></MusicUrl>
			<HQMusicUrl><![CDATA['.$music_url.']]></HQMusicUrl>
			<ThumbMediaId><![CDATA['.$media_id.']]></ThumbMediaId>
			</Music>
			</xml>';
		}

		/**
		 * 被动回复图文消息
		 */
		public function bReplyTuwen()
		{
			echo '<xml>
			<ToUserName><![CDATA['.$this->FromUserName.']]></ToUserName>
			<FromUserName><![CDATA['.$this->ToUserName.']]></FromUserName>
			<CreateTime>'.time().'</CreateTime>
			<MsgType><![CDATA[news]]></MsgType>
			<ArticleCount>5</ArticleCount>
			<Articles>
				<item>
					<Title><![CDATA[百度]]></Title> 
					<Description><![CDATA[百度一下 你就知道]]></Description>
					<PicUrl><![CDATA[http://xiaox.xiaohigh.com/sucai/images/10.jpg]]></PicUrl>
					<Url><![CDATA[http://www.baidu.com]]></Url>
				</item>

				<item>
					<Title><![CDATA[淘宝]]></Title>
					<Description><![CDATA[淘宝一下 啥都有]]></Description>
					<PicUrl><![CDATA[http://xiaox.xiaohigh.com/sucai/images/14.jpg]]></PicUrl>
					<Url><![CDATA[http://www.taobao.com]]></Url>
				</item>
				<item>
					<Title><![CDATA[淘宝]]></Title>
					<Description><![CDATA[淘宝一下 啥都有]]></Description>
					<PicUrl><![CDATA[http://xiaox.xiaohigh.com/sucai/images/15.jpg]]></PicUrl>
					<Url><![CDATA[http://www.taobao.com]]></Url>
				</item>
				<item>
					<Title><![CDATA[淘宝]]></Title>
					<Description><![CDATA[淘宝一下 啥都有]]></Description>
					<PicUrl><![CDATA[http://xiaox.xiaohigh.com/sucai/images/4.jpg]]></PicUrl>
					<Url><![CDATA[http://www.taobao.com]]></Url>
				</item>
				<item>
					<Title><![CDATA[淘宝]]></Title>
					<Description><![CDATA[淘宝一下 啥都有]]></Description>
					<PicUrl><![CDATA[http://xiaox.xiaohigh.com/sucai/images/9.jpg]]></PicUrl>
					<Url><![CDATA[http://www.taobao.com]]></Url>
				</item>
			</Articles>
			</xml>';
		}

		/**
		 * 进行机器人自动回复
		 */
		public function ibot()
		{
			//获取用户发送的内容
			$content = (String)$this->postObj->Content;

			//引入类文件
			include './Libs/XiaoiBot.php';

			$bot = new XiaoiBot;
			//设置开发者信息
			$bot->setAppInfo( 'mCN1Shbb1gpr', '7x6zFXAppByfITjeRmiM' );
			//将用户发送的内容 传递给ibot
			$askResult = $bot->ask($content);

			$this->bReplyText($askResult[1]);
		}
	}




 ?>