@extends("admin.layouts.layout")
@section('title','首页')
@section('static')
		@parent<script type="text/javascript" src="{{asset('admin/js/jquery.js')}}"></script>
		<script type="text/javascript" src="{{asset('admin/js/ch-ui.admin.js')}}"></script>
@endsection

@section('content')
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">后台管理模板</div>
			<ul>
				<li><a href="{{url('/')}}" class="active" target="_blank">首页</a></li>
				<li><a href="{{route('admin.info')}}" target="main">管理页</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>管理员：{{session('userInfo.username')}}</li>
				<li><a href="{{route('admin.changpwd')}}" target="main">修改密码</a></li>
				<li><a href="{{route('admin.logout')}}" onclick="javascript:return confirm('你确认要退出吗?')">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
            <li>
            	<h3><i class="fa fa-fw fa-clipboard"></i>常用操作</h3>
                <ul class="sub_menu">
					<li><a href="{{ route('admin.category.index') }}" target="main"><i class="fa fa-fw fa-briefcase"></i>分类管理</a></li>
                    <li><a href="{{ route('admin.article.index') }}" target="main"><i class="fa fa-fw fa-book"></i>文章管理</a></li>
                    <li><a href="{{ route('admin.links.index') }}" target="main"><i class="fa fa-link"></i>友情链接</a></li>
                    <li><a href="{{ route('admin.navs.index') }}" target="main"><i class="fa fa-bars"></i>自定义导航</a></li>
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw fa-cog"></i>系统设置</h3>
                <ul class="sub_menu">
                    <li><a href="{{ route('admin.config.index') }}" target="main"><i class="fa fa-fw fa-cubes"></i>网站配置</a></li>
                </ul>
            </li>
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="{{route('admin.info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
	</div>
	<!--主体部分 结束-->

	<!--底部 开始-->
	<div class="bottom_box">
		CopyRight © 2018. Powered By <a href="http://www.yangp67.com">平轩博客：http://www.yangp67.com</a>.
	</div>
	<!--底部 结束-->


@endsection