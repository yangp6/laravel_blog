@extends("admin.layouts.layout")
@section('title','文章编辑')
@section('static')
    @parent<script type="text/javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/ch-ui.admin.js')}}"></script>
@endsection
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="{{ route('admin.info') }}">首页</a> &raquo; <a href="{{ route('admin.category.index') }}">分类管理</a> &raquo; 修改分类
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>编辑分类</h3>
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
                <a href="{{route('admin.category.create')}}"><i class="fa fa-plus"></i>添加分类</a>
                <a href="{{ route("admin.category.index") }}"><i class="fa fa-list"></i>分类列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{route('admin.category.update',$category->id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <table class="add_tab">
                <tbody>

                    <tr>
                        <th width="120"><i class="require">*</i>父级分类：</th>
                        <td>
                            <select name="pid">
                                <option value="0">==顶级分类==</option>
                                @foreach($data as $v)
                                    <option value="{{ $v->id }}"  @if($v->id == $category->pid) selected @endif >{{ $v->cname }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>分类名称：</th>
                        <td>
                            <input type="text" name="cname" value="{{ $category->cname }}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>分类名称必须填写</span>
                        </td>
                    </tr>
                    <tr>
                        <th>分类标题：</th>
                        <td>
                            <input type="text" class="lg" name="ctitle" value="{{ $category->ctitle }}">
                        </td>
                    </tr>
                    <tr>
                        <th>关键词：</th>
                        <td>
                            <textarea name="ckeywords">{{ $category->ckeywords }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <textarea name="cdescription">{{ $category->cdescription }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input type="text" class="sm" name="order" value="{{ $category->order }}">
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