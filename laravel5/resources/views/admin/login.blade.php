<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>博客后台管理系统</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    @include("admin/public/style")
    @include("admin/public/script")
</head>
<body class="login-bg">
    
    <div class="login" style="margin-top:80px;">
        <div class="message">博客后台管理系统</div>
        <div id="darkbannerwrap"></div>
        @if(count($errors) > 0)
        	<div class="alert alert-danger">
        		<ul>
        			@if(is_object($errors))
	        			@foreach($errors->all() as $error)
	        				<li style="color:red;">{{$error}}</li>
	        			@endforeach
	        		@else
	        				<li style="color:red;">{{$errors}}</li>
	        		@endif
        		</ul>
        	</div>
        @endif
        <form action="{{url('admin/doLogin')}}" method="post" class="layui-form" >
            <input name="username" placeholder="用户名" value="{{old('username')}}"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input name="code" lay-verify="required" placeholder="验证码"  type="text" style="width:150px;height:38px;float:left" class="layui-input">
            <img style="margin-left:20px;cursor:pointer;" src="{{url('admin/code')}}" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
            {{csrf_field()}}
        </form>
    </div>

    <script>
        // $(function  () {
        //     layui.use('form', function(){
        //       var form = layui.form;
        //       // layer.msg('玩命卖萌中', function(){
        //       //   //关闭后的操作
        //       //   });
        //       //监听提交
        //       form.on('submit(login)', function(data){
        //         // alert(888)
        //         layer.msg(JSON.stringify(data.field),function(){
        //             location.href='index.html'
        //         });
        //         return false;
        //       });
        //     });
        // })

        
    </script>

    
    <!-- 底部结束 -->
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>