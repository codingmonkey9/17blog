<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>激活郵箱</title>
</head>
<body>
	<p> 尊敬的{{$user->user_name}}，感謝您的註冊，請在24小時內激活您的賬號，過期失效 <a href="http://{{$domain}}/active?userid={{$user->user_id}}&token={{$user->token}}">激活鏈接</a></p>
</body>
</html>