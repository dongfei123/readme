<?php 

	//思路
	// 类名:  Page
	//参数:  总数 (total)    每页显示的数量(num)
	//功能:
	// 1. 返回数据 (返回limit)(CalculateLimit)
	// select * from user limit 0,10     1
	// select * from user limit 10,10    2
	// select * from user limit 20,10	 3
	// select * from user limit 30,10	 4

	// $user = new Model('users');
	// $user->limit('0,10')->get();
	// $user->limit('10,10')->get();
	// $user->limit('20,10')->get();
	// $user->limit('30,10')->get();

	// 2. 返回页面字符串(返回html a连接字符串) (show)
	class Page
	{
		//成员属性
		public $total;
		public $num;

		//构造方法
		public function __construct($total, $num)
		{
			$this->total = $total;
			$this->num = $num;
		}

		//成员方法
		// 1    0,10
		// 2    10,10
		// 3    20,10
		// 4    30,10
		// n    (n-1)*10, 10
		//作用: 根据页码的数字 来返回响应的limit参数
		// 默认是使用 url地址中的page参数来作为页码
		public function limit()
		{
			//获取页码的参数
			$page = $this->getCurrentPage(); //1 0,10  2 10,10  n
			//计算逗号之前的参数
			$start = ($page-1) * $this->num;
			//逗号之后的数字
			$end = $this->num;
			//返回limit字符串
			return $start.','.$end;
		}

		public function getCurrentPage()
		{
			return isset($_GET['page']) ? $_GET['page'] : 1;
		}

		/**
		 * 作用:  返回分页的页码字符串(a链接)
		 */
		public function show()
		{

			$script_name = $_SERVER['SCRIPT_NAME'];
			// echo $script_name;die;
			// var_dump($_SERVER);die;
			// unset($_GET['page']);
			// $param = http_build_query($_GET);
			
			//定义空字符串
			$pages = '';
			//当前的页码数
			$page = $this->getCurrentPage();
			//判断左侧是否越界
			$prev = $page > 1 ? ($page-1) : 1;
			//上一页字符串
			$pages .= '<a href="'.$script_name.'?page='.$prev.'"><上一页</a>';

			//计算总的页数
			$total = ceil($this->total / $this->num);// ceil 天花板  floor 地板

			//创建页码的字符串   7        4 5 6 7 8 9 10
			for($i=1;$i<=$total;$i++) {
				//检测页码数
				if($i == $page) {
					$pages .= '<a class="active" href="'.$script_name.'?page='.$i.'">'.$i.'</a>';
				}else{
					$pages .= '<a href="'.$script_name.'?page='.$i.'">'.$i.'</a>';
				}
			}
			$next = $page >= $total ? $total : ($page+1);
			//下一页
			$pages .= '<a href="'.$script_name.'?page='.($next).'">下一页></a>';
			//细节内容
			$pages .= "共".$total."页 到<form action='{$script_name}'><input type='number' min='1' max='".$total."'  name='page' value='".$page."'>页 <button>确定</button></form>";

			return $pages;
		}
	}

 ?>

