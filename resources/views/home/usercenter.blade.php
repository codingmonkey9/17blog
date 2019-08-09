@extends('layouts.home')
@section('title','个人中心')
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" 
	integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" 
	integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" 
	integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<style type="text/css">
		/**{
			clear: both;
		}*/
		.center{
			width:50%;
			height:60%;
			margin-left:25%;
		}
	</style>
@section('userInfo')
<div class="center">
	<caption>个人信息</caption>
	<table class="table table-striped">
		<tr>
			<td>姓名：</td>
			<td>{{$userInfo['user_name']}}</td>
		</tr>
		<tr>
			<td>手机号：</td>
			@if(!empty($userInfo['phone']))
			<td>{{$userInfo['phone']}}&nbsp;&nbsp;<a href="JavaScript:;">修改 <span class="glyphicon glyphicon-pencil"></span></a></td>
			@else
			<td><a href="/useredit/{{$userInfo['user_id']}}">填写手机号</a></td>
			@endif
		</tr>
		<tr>
			<td>邮箱：</td>
			@if(!empty($userInfo['email']))
			<td>{{$userInfo['email']}}&nbsp;&nbsp;<a href="JavaScript:;">修改 <span class="glyphicon glyphicon-pencil"></span></a></td>
			@else
			<td><a href="/useredit/{{$userInfo['user_id']}}">填写邮箱</a></td>
			@endif
		</tr>
		<tr>
			<td>
				性别：
			</td>
			<td>
				@if($profile->sex == 1)
				<span>男</span>
				@else
				<span>女</span>
				@endif
			</td>
		</tr>
		<tr>
			<td>
				年龄：
			</td>
			<td>
				<span>{{$profile->age}}岁</span>	
			</td>
		</tr>
		<tr>
			<td>
				婚否：
			</td>
			<td>
				@if($profile->ismarry == 0)
				<span>未婚</span>
				@elseif($profile->ismarry == 1)
				<span>已婚</span>
				@elseif($profile->ismarry == 2)
				<span>丧偶</span>
				@else
				<span>离异</span>
				@endif
			</td>
		</tr>
		<?php 
			$hobbys = array(1=>'说',2=>'唱',3=>'跳',4=>'rap',5=>'篮球');
			$hobby = explode(',',$profile->hobby);
		?>
		<tr>
			<td>
				爱好：
			</td>
			<td>
				@foreach($hobbys as $k=>$v)
					@if(in_array($k,$hobby))
					<span>{{$hobbys[$k]}}&nbsp;&nbsp;</span>
					@endif
				@endforeach	
			</td>
		</tr>
		<tr><td colspan="2"><a href="{{url('/useredit/'.$profile->id)}}">修改个人信息</a></td></tr>
	</table>
</div>
@endsection
