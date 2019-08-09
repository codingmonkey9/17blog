<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>修改密码</title>
</head>
<body>
	<p> 尊敬的{{$user->user_name}}，您可以修改密码，請尽快修改，修改后的密码请牢记，切勿告诉他人<a href="http://{{$domain}}/editpassword?userid={{$user->user_id}}&token={{$user->token}}"> 激活鏈接</a></p>
</body>
</html>
