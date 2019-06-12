<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>角色列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    @include("admin.public.style")
    @include("admin.public.script")
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form action="{{url('admin/role')}}" method="get" class="layui-form layui-col-md12 x-so">
          <input class="layui-input" placeholder="开始日" name="start" id="start">
          <input class="layui-input" placeholder="截止日" name="end" id="end">
          <input type="text" value="{{$request->input('rolename')}}" name="rolename"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
          <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加角色','{{url('admin/role/create')}}')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：{{$counts}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>角色名</th>
            <th>拥有权限规则</th>
            <th>描述</th>
            <th>状态</th>
            <th>操作</th>
        </thead>
        <tbody>
          @foreach($roles as $role)	
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$role->id}}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$role->id}}</td>
            <td>{{$role->role_name}}</td>
            <td>会员列表，问题列表</td>
            <td>具有至高无上的权利</td>
            @if($role->status == 0)
            <td class="td-status">
              <span class="layui-btn layui-btn-disabled layui-btn-mini">已停用</span>
          	</td>
          	@else
          	<td class="td-status">
              <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
          	</td>
          	@endif
            <td class="td-manage">
              @if($role->role_name == '系统管理员')
              <a href="javascript:;"  title="启用">
                <i class="layui-icon layui-btn-disabled">&#xe601;</i>
              </a>
              @else
              @if($role->status == 1)
              <a onclick="member_stop(this,'10001')" href="javascript:;"  title="启用">
                <i class="layui-icon">&#xe601;</i>
              </a>
              @else
              <a onclick="member_stop(this,'10001')" href="javascript:;"  title="停用">
                <i class="layui-icon">&#xe62f;</i>
              </a>
              @endif
              @endif
              <a title="编辑"  onclick="x_admin_show('编辑','role-add.html')" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a title="角色授权"  onclick="x_admin_show('角色授权','{{url('admin/role/auth')}}/'+{{$role->id}})" href="javascript:;">
                <i class="layui-icon">&#xe630;</i>
              </a>
              @if($role->role_name == "系统管理员")
              <a title="删除" href="javascript:;">
                <i class="layui-icon layui-btn-disabled">&#xe640;</i>
              </a>
              @else
              <a title="删除" onclick="member_del(this,'{{$role->id}}')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        {!!$roles->appends($request->input())->render()!!}
      </div>

    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){
                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 6,time:1000});
              }
              
          });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $.post('/admin/role/'+id,{'_method':'DELETE','_token':'{{csrf_token()}}'},function(data){
              	console.log(data);
              	if(data.status == 0){
              		$(obj).parents("tr").remove();
              		layer.msg(data.message,{icon:1,time:1000});
              	}else{
              		layer.msg(data.message,{icon:2,time:1000});
              	}
              });
              
          });
      }



      function delAll (argument) {
        // var data = tableCheck.getData();
  		//获取批量删除的id
  		var ids = [];
  		$(".layui-form-checked").not(".header").each(function(i,v){
  			var id = $(v).attr('data-id');
  			ids.push(id);
  		});
        layer.confirm('确认要批量删除吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.post('/admin/role/del',{'ids':ids,'_token':"{{csrf_token()}}"},function(data){
            	console.log(data);
            	if(data.status == 0){
            		layer.msg(data.message, {icon: 1,time:1000});
            		$(".layui-form-checked").not('.header').parents('tr').remove();
            	}else{
            		layer.msg(data.message, {icon: 2,time:1000});
            	}
            });
        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>