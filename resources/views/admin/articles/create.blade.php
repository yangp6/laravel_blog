@extends("admin.layouts.layout")
@section('title','文章添加')
@section('static')
    @parent<script type="text/javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/ch-ui.admin.js')}}"></script>
@endsection
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{ route('admin.info') }}">首页</a> &raquo; <a href="{{ route('admin.article.index') }}">文章管理</a> &raquo; 添加文章
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>添加文章</h3>
            @if(count($errors) > 0)
                <div class="mark">
                    @foreach($errors->all() as $error)
                        <p> {{$error}}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{route('admin.article.create')}}"><i class="fa fa-plus"></i>添加文章</a>
                <a href="{{ route("admin.article.index") }}"><i class="fa fa-list"></i>文章列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <style>
        /*ue编辑器样式调整*/
        .edui-default{line-height: 28px;}
        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
        {overflow: hidden; height:20px;}
        div.edui-box{overflow: hidden; height:22px;}

        /*上传样式调整*/
        .uploadify{display:inline-block;}
        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/uploadify/uploadify.css')}}">
    <div class="result_wrap">
        <form action="{{route('admin.article.store')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <table class="add_tab">
                <tbody>

                    <tr>
                        <th width="120">分类：</th>
                        <td>
                            <select name="cid">
                                @foreach($data as $v)
                                    <option value="{{ $v->id }}">{{ $v->cname }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>文章标题：</th>
                        <td>
                            <input type="text" name="title">
                            <span><i class="fa fa-exclamation-circle yellow"></i>文章标题必须填写</span>
                        </td>
                    </tr>
                    <tr>
                        <th>编辑者：</th>
                        <td>
                            <input type="text" class="sm" name="editor">
                        </td>
                    </tr>
                    <tr>
                        <th>缩略图：</th>
                        <td>
                            <input type="text"  size="50"   name="thumb">
                            <input id="file_upload" name="file_upload" type="file" multiple="true">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td id="art_thumb_img">

                        </td>
                    </tr>
                    <tr>
                        <th>关键词：</th>
                        <td>
                            <input type="text" class="lg" name="tag">
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="description"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <th>文章内容：</th>
                        <td>
                            <script id="editor" name="content" type="text/plain" style="width:860px;height:500px;"></script>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
<script src="{{asset('plugins/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8" src="{{asset('plugins/ue/ueditor.config.js')}}"></script>
<script type="text/javascript" charset="utf-8" src="{{asset('plugins/ue/ueditor.all.min.js')}}"> </script>
<script type="text/javascript" charset="utf-8" src="{{asset('plugins/ue/lang/zh-cn/zh-cn.js')}}"></script>
<script>
var ue = UE.getEditor('editor');
<?php $timestamp = time();?>
$(function() {
    $('#file_upload').uploadify({
        'buttonText' : '图片上传',
        'formData'     : {
            'timestamp' : '<?php echo $timestamp;?>',
            '_token'     : '{{ csrf_token() }}'
        },
        'swf'      : '{{url('plugins/uploadify/uploadify.swf')}}',
        'uploader' : '{{route("admin.upload")}}',
        'onUploadSuccess' : function(file, data, response) {
            $('input[name=thumb]').val(data);  //填入相对路径
            var str = '<img src="'+data+'" style="max-width: 300px; max-height: 100px;">'
            $('#art_thumb_img').append(str);
        },
    });
});
</script>
@endsection