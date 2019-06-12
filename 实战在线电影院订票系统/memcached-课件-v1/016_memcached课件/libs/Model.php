<?php 

	class Model
	{
		//成员属性
		public $tableName = '';
		public $fields = [];
		public $pk = '';
		public $link = null;
		public $field= '';//当前sql指令的字段内容
		public $where = '';
		public $orderBy = '';
		public $limit = '';

		//构造方法
		public function __construct($tableName)
		{
			$this->tableName = $tableName;
			$this->getFields();
		}

		//增加操作
			//	['username'=>'admin','password'=>'admin','email'=>'admin@qq.com']
			//                      ||
			//						||
			// 						\/
			//  insert into users (username,password,email) values('admin','admin','admin@qq.com')
		public function insert($arr)
		{
			//检测数组中的字段的合法性
			foreach($arr as $k=>$v) {
				if(!$this->checkKeyIsCommonField($k)){
					echo '数据有误 请重试!!!';die;
				}
			}

			//提取数组的键名
			$keys = array_keys($arr);// ['username','password','email']
			$keys_sql = implode(',',$keys);//  username,password,email
			//提取键值的内容
			$value = array_values($arr);// ['admin','admin','admin@qq.com']
			$value_sql = '"'.implode('","',$value).'"';//"admin","admin","admin@qq.com"
			//拼接sql指令
			$sql = "insert into ".$this->tableName." (".$keys_sql.") values(".$value_sql.")";
			//发送sql指令
			$result = mysqli_query($this->link, $sql);
			//判断结果
			if($result) {
				return mysqli_insert_id($this->link);
			}else{
				return false;
			}
		}

		//删除
		public function delete($id)
		{
			//拼接sql指令
			$sql = 'delete from '.$this->tableName.' where '.$this->pk.' = '.$id;
			//发送sql
			$result = mysqli_query($this->link, $sql);
			//检测
			if($result) {
				return mysqli_affected_rows($this->link);// affected受影响的   rows行数
			}else{
				return false;
			}
		}

		//修改的方法
		// ['username'=>'xiaobai','password'=>'xiaohei','uid'=>164]
		// update users set username = 'xiaobai', password = 'xiaohei' where uid = 164;
		//					username='xiaobai',password='xiaohei',uid='164'
		public function update($arr)
		{
			//检测数组的合法性
			foreach($arr as $k=>$v) {
				//检测非法性
				if(!$this->checkKeyIsCommonField($k) && !$this->checkKeyIsPk($k) ) {
					echo '您的数据有问题.  请重试!!!';die;
				}
			}

			//声明变量  修改字段内容的sql
			$set = '';
			$where = '';
			//遍历数组
			foreach($arr as $k=>$v) {
				//如果是主键
				if($k == $this->pk) {
					$where = "$k = ".$v;
				}else{ //如果不是主键
					$set .= "{$k}='{$v}',";
				}
			}

			//检测是否有where条件
			if(empty($where)) {
				echo '不允许没有条件的更新';die;
			}

			//sql
			$set_sql = rtrim($set, ',');

			//
			$sql = "update ".$this->tableName." set ".$set_sql." where ".$where;

			//发送sql指令
			$result = mysqli_query($this->link, $sql);

			//检测结果
			if($result) {
				return mysqli_affected_rows($this->link);
			}else{
				return false;
			}
		}

		//获取单挑的结果
		public function first($id)
		{
			//拼接sql语句
			$sql = 'select * from '.$this->tableName.' where '.$this->pk.' = '.$id;
			//发送sql
			$result = mysqli_query($this->link, $sql);
			//判断
			if($result) {
				return mysqli_fetch_assoc($result);
			}else{
				return false;
			}
		}

		//检测键名是否为普通字段
		public function checkKeyIsCommonField($key)
		{
			return in_array($key, $this->fields);
		}

		//检测是否为主键
		public function checkKeyIsPk($key)
		{
			return $key === $this->pk; //
		}

		//提取当前表中的字段
		public function getFields()
		{
			//连接数据库
			$this->connect();
			//
			$sql = 'show columns from '.$this->tableName; //desc $this->tableName;
			$result = mysqli_query($this->link, $sql);
			//检测并提取结果集
			if($result) {
				$fields = []; // ['username','password','email']   in_array
				while($row = mysqli_fetch_assoc($result)) {
					//主键
					if($row['Key'] == "PRI") {
						$pk = $row['Field'];
					}else{
						//普通字段
						$fields[] = $row['Field'];
					}
				}
				//将值存入到成员属性中
				$this->fields = $fields;
				$this->pk = $pk;
			}else{
				return false;
			}
		}

		//连接数据库
		public function connect()
		{
			//连接数据库
			$this->link = mysqli_connect('localhost','root','123456');
			//设置字符集
			mysqli_set_charset($this->link, 'utf8');
			//选择数据库
			mysqli_select_db($this->link, 'lamp');
		}

		//清空查询属性
		public function clear()
		{
			//清空查询的属性
			$this->field = '';
			$this->where = '';
			$this->orderBy = '';
			$this->limit = '';
		}

		//获取多条数据 //拼接sql指令 发送 并获取结果集的
		public function get()
		{
			//拼接sql指令
			$field = empty($this->field) ? '*' : $this->field;
			//where
			$where = !empty($this->where) ? 'where '.$this->where : '';
			//排序
			$orderBy = !empty($this->orderBy) ? 'order by '.$this->orderBy : '';
			//分页
			$limit = !empty($this->limit) ? 'limit '.$this->limit : '';
			//拼接
			$sql = 'select '.$field.'  from '.$this->tableName.' '.$where.' '.$orderBy.' '.$limit;

			$this->clear();

			//发送sql指令
			$result = mysqli_query($this->link, $sql);
			//检测
			if($result) {
				$data = [];
				while($row = mysqli_fetch_assoc($result)) {
					$data[] = $row;
				}
				return $data;
			}else{
				return false;
			}
		}

		//用来设置字段子句的  username ,password
		public function select($str)
		{
			//将字段信息存入到成员属性中
			$this->field = $str;
			return $this;
		}

		//用来设置where子句
		public function where($str)
		{
			$this->where = $str;
			return $this;
		}

		//设置排序子句  orderBy('id desc')
		public function orderBy($str)
		{
			$this->orderBy = $str;
			return $this;
		}

		//分页设置  limit('10,10')   skip(10) -> take(10)
		public function limit($str)
		{
			$this->limit = $str;
			return $this;
		}

		//统计
		public function count()
		{
			$sql = 'select count(*) as total from '.$this->tableName;

			//发送
			$result = mysqli_query($this->link, $sql);
			if($result) {
				$res = mysqli_fetch_assoc($result);
				return $res['total'];
			}else{
				return false;
			}
		}
	}

	//当代码要写重复的时候, 或者即将要写重复的时候 应该想到封装.
	// $user = new Model('users');
	// $song = new Model('songs');

	//插入
	// $res = $user->insert(['username'=>'xiaohigh','password'=>'xiaohigh','email'=>'xiaohigh@163.com']);

	// $songs = new Model('songs');

	// $res = $songs->insert(['name'=>'love you like a movie','singer' => 'wangle','lyric'=>'love you like a movie']);

	//删除
	// $res = $user->delete(172);

	//修改
	// $arr = ['username'=>'xiaobai','password'=>'xiaohongss','uid'=>164];
	// $res = $user->update($arr);

	//获取单条
	// $res = $user->first(168);

	//获取多条
	// $res = $user->select('username,password')->where('uid>100')->orderBy('uid desc')->limit('10,10')->get();

	// $res =  $song->limit(20)->where('id > 100000')->select('id,name,singer')->get();

	// var_dump($res);

	// $res_2 = $song->get();

	// var_dump($res_2);


	//统计
	// $total = $user->count();
	// var_dump($total);

 ?>