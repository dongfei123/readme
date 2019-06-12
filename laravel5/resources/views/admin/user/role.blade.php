<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>分配角色</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
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
    <div class="x-body">
        <form method="" class="layui-form layui-form-pane">
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                     角色列表
                    </label>
                    <table  class="layui-table layui-input-block">
                        <tbody>
                        	@foreach($roles as $role)
                            <tr>
                                <td>
                                    <div class="layui-input-block">
                                        <input name="id[]" @foreach($hasRoles as $hasRole)
                                        @if($hasRole->role_id == $role->id)
                                        checked
                                        @endif
                                        @endforeach type="checkbox" value="{{$role->id}}"> 
                                        {{$role->role_name}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="add">分配角色</button>
              </div>
            </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
          //自定义验证规则
          form.verify({
            nikename: function(value){
              if(value.length < 5){
                return '昵称至少得5个字符啊';
              }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
          });

          //监听提交
          form.on('submit(add)', function(data){
            //发异步，把数据提交给php
            //获取分配的角色
            var role_ids = [];
            $("input[name='id[]']").each(function(){
            	if($(this)[0].checked == true){
            		role_ids.push($(this).val());
            	}
            });
            $.ajax({
            	type:'POST',
            	dataType:'json',
            	url:'/admin/user/addRole',
            	headers:{
            		'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            	},
            	data:{'user_id':'{{$id}}','role_ids':role_ids},
            	success:function(data){
            		console.log(data);
            		if(data.status == 0){
            			layer.alert(data.message, {icon: 6},function () {
			            // 获得frame索引
			            var index = parent.layer.getFrameIndex(window.name);
			            //关闭当前frame
			            parent.layer.close(index);
			            });
            		}else{
            			layer.alert(data.message, {icon: 5},function () {
			            // 获得frame索引
			            var index = parent.layer.getFrameIndex(window.name);
			            //关闭当前frame
			            parent.layer.close(index);
			            });
            		}
		            
            	},
            	error:function(){
            		//错误信息
            	}
            });
            return false;
          });
          
          
        });
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>