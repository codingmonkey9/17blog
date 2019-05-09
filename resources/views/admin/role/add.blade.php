<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    @include('admin/public/css')
    @include('admin/public/js')
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-body">
        <form action="{{url('/role')}}" method="post" class="layui-form layui-form-pane">
            {{csrf_field()}}
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>角色名
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="role_name" required="" lay-verify="required"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                        拥有权限
                    </label>
                    <table  class="layui-table layui-input-block">
                        <tbody>
                            <tr>
                                {{--<td>
                                    <input type="checkbox" name="like1[write]" lay-skin="primary" title="用户管理">
                                </td>--}}
                                <td>
                                    <div class="layui-input-block">
                                        <input name="id[]" lay-skin="primary" type="checkbox" title="用户停用" value="2"> 
                                        <input name="id[]" lay-skin="primary" type="checkbox" value="2" title="用户删除"> 
                                        <input name="id[]" lay-skin="primary" type="checkbox" value="2" title="用户修改"> 
                                        <input name="id[]" lay-skin="primary" type="checkbox" value="2" title="用户改密"> 
                                        <input name="id[]" lay-skin="primary" type="checkbox" value="2" title="用户列表">
                                        <input name="id[]" lay-skin="primary" type="checkbox" value="2" title="用户改密"> 
                                        <input name="id[]" lay-skin="primary" type="checkbox" value="2" title="用户列表">
                                        <input name="id[]" lay-skin="primary" type="checkbox" value="2" title="用户改密"> 
                                        <input name="id[]" lay-skin="primary" type="checkbox" value="2" title="用户列表"> 
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                {{--<td>
                                   
                                    <input name="id[]" lay-skin="primary" type="checkbox" value="2" title="文章管理">
                                </td>--}}
                                <td>
                                    <div class="layui-input-block">
                                        <input name="id[]" lay-skin="primary" type="checkbox" value="5" title="文章添加"> 
                                        <input name="id[]" lay-skin="primary" type="checkbox" value="13" title="文章删除"> 
                                        <input name="id[]" lay-skin="primary" type="checkbox" value="14" title="文章修改">
                                        <input name="id[]" lay-skin="primary" type="checkbox" value="12" title="文章列表"> 
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">
                        描述
                    </label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容" id="desc" name="desc" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="add">增加</button>
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
          // form.on('submit(add)', function(data){
          //   console.log(data);
          //   //发异步，把数据提交给php
          //   layer.alert("增加成功", {icon: 6},function () {
          //       // 获得frame索引
          //       var index = parent.layer.getFrameIndex(window.name);
          //       //关闭当前frame
          //       parent.layer.close(index);
          //   });
          //   return false;
          // });
          
          
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