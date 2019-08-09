<!DOCTYPE html>
<html>
  
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>个人信息</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
      <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" 
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
      <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" 
      integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    
      <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" 
      integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
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
        <form class="layui-form" id="layui_form" method="post" action="/userupdate" enctype="multipart/form-data">
           {{ csrf_field() }}

           @if(session('error'))
           <div class="alert alert-danger">
             <p>{{session('error')}}</p>
           </div>
           @endif
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>用户名
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_email" name="username" readonly="readonly" value="{{$profile->username}}"
                   class="layui-input">
              </div>
          </div>
          <!-- <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>头像
              </label>
              <div class="layui-input-inline">
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    上传头像 <span class="glyphicon glyphicon-picture"></span>
                  </button>
                  <input type="file" name="headpic" style="display: none;">
                  <input type="hidden" name="pic">
                  图片动态创建
                  <img src="" id="headpic" alt="图片丢失.png"/>
              </div>
          </div> -->
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>性别
              </label>
              <div class="layui-input-inline">
                  @if($profile->sex == 1)
                  <input type="radio" name="sex" value="1" checked="">男
                  <input type="radio" name="sex" value="0">女
                  @else
                  <input type="radio" name="sex" value="1">男
                  <input type="radio" name="sex" value="0" checked="">女
                  @endif
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>年龄
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_username" name="age" required=""  
                 value="{{$profile->age}}" autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>婚否
              </label>
              <div class="layui-input-inline">
                  @if($profile->ismarry == 0)
                  <input type="radio" name="ismarry" value="0" checked="">未婚
                  <input type="radio" name="ismarry" value="1">已婚
                  <input type="radio" name="ismarry" value="2">丧偶
                  <input type="radio" name="ismarry" value="3">离异
                  @elseif($profile->ismarry == 1)
                  <input type="radio" name="ismarry" value="0">未婚
                  <input type="radio" name="ismarry" value="1" checked="">已婚
                  <input type="radio" name="ismarry" value="2">丧偶
                  <input type="radio" name="ismarry" value="3">离异
                  @elseif($profile->ismarry == 2)
                  <input type="radio" name="ismarry" value="0">未婚
                  <input type="radio" name="ismarry" value="1">已婚
                  <input type="radio" name="ismarry" value="2" checked="">丧偶
                  <input type="radio" name="ismarry" value="3">离异
                  @else
                  <input type="radio" name="ismarry" value="0">未婚
                  <input type="radio" name="ismarry" value="1">已婚
                  <input type="radio" name="ismarry" value="2">丧偶
                  <input type="radio" name="ismarry" value="3" checked="">离异
                  @endif
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>爱好
              </label>
              <div class="layui-input-inline">
                 <input type="checkbox" name="hobby[]" value="1" <?php if(in_array(1,explode(',',$profile->hobby))) echo 'checked' ?>>说
                 <input type="checkbox" name="hobby[]" value="2" <?php if(in_array(2,explode(',',$profile->hobby))) echo 'checked' ?>>唱
                 <input type="checkbox" name="hobby[]" value="3" <?php if(in_array(3,explode(',',$profile->hobby))) echo 'checked' ?>>跳
                 <input type="checkbox" name="hobby[]" value="4" <?php if(in_array(4,explode(',',$profile->hobby))) echo 'checked' ?>>rap
                 <input type="checkbox" name="hobby[]" value="5" <?php if(in_array(5,explode(',',$profile->hobby))) echo 'checked' ?>>篮球
              </div>
          </div>
          <input type="hidden" name="id" value="{{$profile->id}}">
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  确认修改
              </button>
          </div>
      </form>
    </div>
  </body>
</html>
<script type="text/javascript">
  /***上传头像***/
  //获取按钮元素
  var btn = $('.btn-success');
  btn.bind('click',function(){
    $('input[name="headpic"]').trigger('click'); //触发上传图片
    var formData = new FormData($('#layui_form')[0]);
    // console.log($('.layui-form')[0]);
    // console.log(formData);
    // formData.append('pic',$('.layui-form')[0]);
    $('input[name="headpic"]').change(function(){
      var obj = this;
      $.ajax({
        type: 'post',
        url: '/usercenter/upload',
        data: formData,
        // dataType: 'JSON',
        // cache: false,                      // 不缓存
        processData: false,                // jQuery不要去处理发送的数据
        contentType: false,                // jQuery不要去设置Content-Type请求头
        success: function(data){
          if(data.statusCode == 200){
            $('#headpic').attr('src','headpic/'+data.responseData);
            $('input[name="pic"]').val('headpic/'+data.responseData);
            $(obj).off('change');
          }else{
            alert(data.responseData);
          }
        },
        error: function(){
          alert('uploaded img occur error!!!');
        },
        async: true,
      });
    })
  })
</script>