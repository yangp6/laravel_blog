@extends("admin.layouts.layout")
@section('title','友情链接编辑')
@section('static')
    @parent<script type="text/javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/ch-ui.admin.js')}}"></script>
@endsection
@section('content')
    <!--面包屑导航 结束-->
    @include('admin.modules._breadNav',['href'=>route('admin.links.index'),'bre_first_title'=>'友情链接管理','bre_last_title'=>'友情链接编辑'])
	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        @include('admin.modules._message',['h3'=>'友情链接修改'])
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{route('admin.links.create')}}"><i class="fa fa-plus"></i>添加友情链接</a>
                <a href="{{ route("admin.links.index") }}"><i class="fa fa-list"></i>友情链接列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{route('admin.links.update',$data->id)}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th><i class="require">*</i>链接名称：</th>
                        <td>
                            <input type="text" name="name" value="{{ $data->name }}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>链接名称必须填写</span>
                        </td>
                    </tr>
                    <tr>
                        <th>链接标题：</th>
                        <td>
                            <input type="text" class="lg" name="title" value="{{ $data->title }}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>链接地址：</th>
                        <td>
                            <input type="text" class="lg" name="url" value="{{ $data->url }}" >
                        </td>
                    </tr>
                    <tr>
                        <th>链接排序：</th>
                        <td>
                            <input type="text" class="sm" name="order" value="{{ $data->order }}">
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

@endsection