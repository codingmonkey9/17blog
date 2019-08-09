<!DOCTYPE html>
<!-- saved from url=(0032)http://www.iydu.net/wp-login.php -->
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <script src="/home/js/jquery.min.js"></script>
    <script src="/home/js/jquery.cookie.js"></script>
    <title>登录 {{config('webconfig.web_title')}}</title>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(http://www.iydu.net/wp-content/themes/tinection/images/wordpress-logo.png);
            -webkit-background-size: 85px 85px;
            background-size: 85px 85px;
            width: 85px;
            height: 85px
        }</style>
    <link rel="dns-prefetch" href="http://s.w.org/">
    <link rel="stylesheet" href="{{ asset('home/css/login.css') }}" type="text/css" media="all">
    <meta name="robots" content="noindex,follow">
    <meta name="viewport" content="width=device-width">
</head>
<body class="login login-action-login wp-core-ui  locale-zh-cn" onload="getCookie();">
<div id="login">
    <h1><a href="http://www.boke.com/home/login" title="{{config('webconfig.web_title')}}" tabindex="-1">{{config('webconfig.web_title')}}</a></h1>

    <form name="loginform" id="loginform" action="{{ url('dologin') }}" method="post">
        {{ csrf_field() }}
        @if(session('msg'))
           <p style="color:red;">{{ session('msg') }}</p>
        @endif

        @if(session('active'))
            <p style="color:red;">{{ session('active') }}</p>
        @endif
        <p>
            <label for="user_login">用户名或电子邮件地址<br>
                <input type="text" name="user_name" id="user_name" class="input" value="" size="20"></label>
        </p>
        <p>
            <label for="user_pass">密码<br>
                <input type="password" name="user_pass" id="user_pass" class="input" value="" size="20"></label>
        </p>
        <p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme"
                                      value="forever"> 记住我的登录信息</label></p>
        <p class="submit">
            <input type="submit"  id="wp-submit" class="button button-primary button-large" value="登录">
        </p>
    </form>

    <p id="nav">
        <a href="{{ asset('forget') }}">忘记密码？</a>
    </p>

    <script type="text/javascript">
        function wp_attempt_focus() {
            setTimeout(function () {
                try {
                    d = document.getElementById('user_login');
                    d.focus();
                    d.select()
                } catch (e) {
                }
            }, 200)
        }

        wp_attempt_focus();
        if (typeof wpOnload == 'function') wpOnload();</script>

    <p id="backtoblog"><a href="/home/index">← 返回前台首页</a></p>
    <p id="backtoblog"><a href="/phoneregister">← 手机注册页</a></p>
    <p id="backtoblog"><a href="/emailregister">← 邮箱注册页</a></p>

</div>


<div class="clear"></div>
<script>

    var is_check;

    $('input[name="rememberme"]').click(function(){
        // var checked = $('input[name="rememberme"]').attr('checked');//这个不可用，因为是动态添加的，attr获取不到
        var checked = $("input[type='checkbox']").prop("checked") ;//判断是否勾选
        if(checked){
            var name = $('input[name="user_name"]').val();
            //密码不存在cookie中，不安全，我只获取密码长度，然后伪造一个相同长度的值填充到密码区域
            var pwd = $('input[name="user_pass"]').val();
            var pwdlen = pwd.length;
            //cookie中可以设置一个变量标记是否选中的状态
            is_check = 1; //当再次登录的时候，若为1，则复选框为勾选状态，填充文本框，若为0则用户手动输入密码等
            document.cookie = "user_name="+name+",user_pass="+pwd+",is_check="+is_check;
            // alert(name);
        }else{
            is_check = 0;
            document.cookie = "user_name= ,user_pass= ,is_check="+is_check;//key-value部分不能使用;分割？
        }
    });

    //读取cookie，检测是否勾选
    // var _cookie = document.cookie;
    // console.log(_cookie);
    // var username = get_cookie('user_name');
    // console.log(username);
    //获取cookie指定值，只能自己分割得到。
    function get_cookie(key) {
        var _cookie = document.cookie;
        var arr = _cookie.split(';')[0].split(',');
        for(var i=0;i<arr.length;i++){
            var kv = arr[i].split('=');
            if(key == kv[0]){
                //要获取的cookie值的键存在
                return kv[1];
            }
        }
        //否则不存在
        return "error";
    }

    function getCookie(){ //获取cookie
        if(get_cookie('is_check') == 1){
            var name = get_cookie('user_name');
            var pass = get_cookie('user_pass');
            //填充信息到表单
            $('input[name="user_name"]').val(name);
            $('input[name="user_pass"]').val(pass);
            $("input[type='checkbox']").prop("checked",'checked');
        }else{
            var name = get_cookie('user_name');
            var pass = get_cookie('user_pass');
            //填充信息到表单
            $('input[name="user_name"]').val('');
            $('input[name="user_pass"]').val('');
            $("input[type='checkbox']").prop("checked",'');
        }
    }

</script>
</body>
</html>
