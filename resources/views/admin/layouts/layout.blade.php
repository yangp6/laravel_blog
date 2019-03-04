<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    @section("static")<link rel="stylesheet" href="{{asset('admin//css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/font/css/font-awesome.min.css')}}">
    @show<title>@yield('title','网站基本信息')-- 博客后台</title>
</head>
<body>
    @yield("content")
</body>
</html>