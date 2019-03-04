@extends("admin.layouts.layout")
@section('title','自定义导航修改')
@section('static')
    @parent<script type="text/javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/ch-ui.admin.js')}}"></script>
@endsection
@section('content')
    @include('admin.modules._breadNav',['href'=>route('admin.navs.index'),'bre_first_title'=>'导航管理','bre_last_title'=>'修改导航'])
	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        @include('admin.modules._message',['h3'=>'修改自定义导航'])
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{route('admin.navs.create')}}"><i class="fa fa-plus"></i>添加导航</a>
                <a href="{{ route("admin.navs.index") }}"><i class="fa fa-list"></i>导航列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{route('admin.navs.update',$data->id)}}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th><i class="require">*</i>导航名称：</th>
                        <td>
                            <input type="text" name="name" value="{{ $data->name }}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>链接名称必须填写</span>
                        </td>
                    </tr>
                    <tr>
                        <th>导航别名：</th>
                        <td>
                            <input type="text" class="sm" name="alias" value="{{ $data->alias }}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>导航地址：</th>
                        <td>
                            <input type="text" class="lg" name="url" value="{{ $data->url }}">
                        </td>
                    </tr>
                    <tr>
                        <th>导航排序：</th>
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