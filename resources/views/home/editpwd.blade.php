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
    <h1><a href="/home/login" title="{{config('webconfig.web_title')}}" tabindex="-1">{{config('webconfig.web_title')}}</a></h1>

    <form name="loginform" id="loginform" action="{{url('updatepwd')}}" method="post">
        {{ csrf_field() }}
        @if(session('msg'))
        <p style="color:yellowgreen;">{{session('msg')}}</p>
        @endif
        <p>
            <label for="user_login">新密码<br>
                <input type="password" name="user_pass" id="" class="input" value="" size="20"></label>
        </p>
        <p>
            <label for="user_login">确认密码<br>
                <input type="password" name="repass" id="" class="input" value="" size="20"></label>
        </p>
        <p class="submit">
            <input type="hidden" name="id" value="{{$id}}">
            <input type="submit"  id="wp-submit" class="button button-primary button-large" value="修改密码">
        </p>
    </form>

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
    
</script>
</body>
</html>
