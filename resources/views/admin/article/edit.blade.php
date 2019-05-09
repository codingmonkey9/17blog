<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>修改文章</title>
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
        <form action="{{url('/article/'.$article['art_id'])}}" method="post" id="art_form" class="layui-form layui-form-pane">
            {{csrf_field()}}
            {{method_field('put')}}
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>文章分类
                    </label>
                    <div class="layui-input-inline">
                        <select name="cate_id">
                          @foreach($cates as $v)
                            <option value="{{$v['cate_id']}}" @if($v['cate_pid']==0) disabled @endif @if($v['cate_id']==$article['cate_id']) selected @endif>{{$v['cate_name']}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>文章标题
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="art_title" value="{{$article['art_title']}}"  
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>文章标签
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="art_tag" value="{{$article['art_tag']}}"
                        autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>缩略图
                    </label>
                    <button type="button" class="layui-btn" id="test1">
                      <i class="layui-icon">&#xe67c;</i>上传图片
                    </button>
                    <div class="layui-input-inline">
                        <input type="file" id="name" name="pic" style="display:none;" 
                        autocomplete="off" class="layui-input">
                        <input type="hidden" name="art_thumb" value="{{$article['art_thumb']}}">
                    </div>
                    <div class="layui-input-block">
                        <img src="{{$article['art_thumb']}}" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;">
                    </div>
                </div>
                
                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">
                        <span class="x-red">*</span>文章描述
                    </label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容" id="desc" name="art_description" class="layui-textarea">{{$article['art_description']}}</textarea>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">
                        文章内容
                    </label>
                    <div class="layui-input-block">
                        <!-- 加载编辑器的容器 -->
                        <script id="container" style="height:400px;" name="art_content" type="text/plain">
                            {!!$article['art_content']!!}
                        </script>
                        <!-- 配置文件 -->
                        <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
                        <!-- 编辑器源码文件 -->
                        <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
                        <!-- 实例化编辑器 -->
                        <script type="text/javascript">
                            var ue = UE.getEditor('container');
                        </script>

                    </div>
                </div>
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>作者
                    </label>
                    <div class="layui-input-inline">
                        <input type="text" id="name" name="art_editor" value="{{$article['art_editor']}}" 
                        autocomplete="off" class="layui-input">
                        <input type="hidden" name="art_time" value="{{$article['art_time']}}">
                    </div>
                </div>
                <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="add">保存修改</button>
              </div>
            </form>
    </div>
    <script>

        //处理图片上传   trigger触发器
        $('#test1').click(function(){
          $('input[name="pic"]').trigger('click');
            $('input[name="pic"]').change(function(){
              var obj = this;
              var art_thumb = $('#art_thumb_img').attr('src');
              console.log(art_thumb);
              //在form表单添加属性值id="art_form"
              var formData = new FormData($('#art_form')[0]);
              $.ajax({
                type:'post',
                url:'/article/upload',
                data:formData,
                processData:false,
                contentType:false,
                success:function(data){
                  if(data['ServerNo']==200){
                    $('#art_thumb_img').attr('src','/uploads/'+data['ResultData']);
                    $('input[name=art_thumb]').val('/uploads/'+data['ResultData']);
                    $(obj).off('change');
                    //文件上传成功后将原来的图片删除
                    // $.ajax({
                    //   type:'post',
                    //   url:'/article/delFile',
                    //   data:{art_thumb:art_thumb},
                    //   success:function(data){
                    //     if(data){
                    //       console.log('删除成功');
                    //     }else{
                    //       console.log('删除失败');
                    //     }
                    //   },
                    // });
                  }else{
                    alert(data['ResultData']);
                  }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    var number = XMLHttpRequest.status;
                    var info = "错误号"+number+"文件上传失败!";
                    // 将菊花换成原图
                    // $('#pic').attr('src', '/file.png');
                    alert(info);
                },
                async: true
              });
            });
          
        });

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