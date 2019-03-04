<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('admin/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('admin/font/css/font-awesome.min.css')}}">
</head>
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>Blog 博客系统</h1>
		<h2>欢迎使用博客管理平台</h2>
		<div class="form">

			@if(session('alertMsg'))
			<p style="color:red;font-size: 16px;background: #ffddff;">{{ session('alertMsg') }}</p>
			@endif

			<form action="{{route('admin.login')}}" method="post">
				{{ csrf_field() }}
				<ul>
					<li>
					<input type="text" name="username" class="text" value="{{old('username')}}"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="password" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{url('/admin/code')}}" alt="请填写验证码" onclick="this.src='{{route("admin.code")}}?'+Math.random()">
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
			<p><a href="#">返回首页</a> &copy; 2019 Powered by <a href="http://www.yangp67.com" target="_blank">http://www.yangp67.com</a></p>
		</div>
	</div>
</body>
</html>