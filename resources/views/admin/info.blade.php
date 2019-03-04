@extends("admin.layouts.layout")
@section('title','基本信息');
@section('content')<div class="crumb_warp">
		<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
		<i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
	</div>
	<!--面包屑导航 结束-->
	
	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

	
    <div class="result_wrap">
        <div class="result_title">
            <h3>系统基本信息</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>操作系统</label><span>{{PHP_OS}}</span>
                </li>
                <li>
                    <label>运行环境</label><span>{{$_SERVER['SERVER_SOFTWARE']}}/PHP{{PHP_VERSION}}</span>
                </li>
                <li>
                    <label>浏览器</label><span>{{$_SERVER['HTTP_USER_AGENT']}}</span>
                </li>
                <li>
                    <label>博客后台版本</label><span>v0.1</span>
                </li>
                <li>
                    <label>上传附件限制</label><span>{{get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize") : "不允许上附件"}}</span>
                </li>
                <li>
                    <label>北京时间</label><span>{{date('Y年m月d日 H:i:s')}}</span>
                </li>
                <li>
                    <label>服务器域名/IP</label><span>{{$_SERVER['SERVER_NAME']}} [ {{$_SERVER['SERVER_ADDR']}} ]</span>
                </li>
                <li>
                    <label>Host</label><span>{{$_SERVER['SERVER_ADDR']}}</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="result_wrap">
        <div class="result_title">
            <h3>使用帮助</h3>
        </div>
        <div class="result_content">
            <ul>
                <li>
                    <label>交流网站：</label><span>【轩博客】<a href="#">http://www.yangp67.com</a></span>
                </li>
                <li>
                    <label>QQ联系：</label><span><a href="#"><img  style="CURSOR: pointer" onclick="javascript:window.open('http://b.qq.com/webc.htm?new=0&sid=370061948&o=www.yangp67.com&q=7', '_blank', 'height=502, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');"  border="0" SRC=http://wpa.qq.com/pa?p=1:370061948:10 alt="有事请点击"></a></span>
                </li>
            </ul>
        </div>
    </div>
@endsection