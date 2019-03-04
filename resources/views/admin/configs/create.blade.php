@extends("admin.layouts.layout")
@section('title','添加网站配置')
@section('static')
    @parent<script type="text/javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/ch-ui.admin.js')}}"></script>
@endsection
@section('content')
    @include('admin.modules._breadNav',['href'=>route('admin.config.index'),'bre_first_title'=>'网站配置管理','bre_last_title'=>'添加网站配置'])

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        @include('admin.modules._message',['h3'=>'添加网站配置'])
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{route('admin.config.create')}}"><i class="fa fa-plus"></i>添加配置</a>
                <a href="{{ route("admin.config.index") }}"><i class="fa fa-list"></i>配置列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{route('admin.config.store')}}" method="post">
            {{ csrf_field() }}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th><i class="require">*</i>标题：</th>
                        <td>
                            <input type="text" name="title">
                            <span><i class="fa fa-exclamation-circle yellow"></i>配置项标题必须填写</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>名称：</th>
                        <td>
                            <input type="text" name="name">
                            <span><i class="fa fa-exclamation-circle yellow"></i>配置项名称必须填写(首字符不能为数字)</span>
                        </td>
                    </tr>
                    <tr>
                        <th>类型：</th>
                        <td>
                            <label for=""> <input type="radio" name="field_type" value="input" onclick="showOrHidden()" checked>input</label>
                            <label for=""><input type="radio" name="field_type" value="textarea" onclick="showOrHidden()">textarea</label>
                            <label for=""> <input type="radio" name="field_type" value="radio" onclick="showOrHidden()">radio</label>
                        </td>
                    </tr>
                    <tr class="field_value">
                        <th>类型值：</th>
                        <td>
                            <input type="text"  name="field_value" >
                            <span><i class="fa fa-exclamation-circle yellow"></i>只有在类型为radio时才需要配置，格式：1|开启,0|关闭</span>
                        </td>
                    </tr>
                    <tr>
                        <th>排序：</th>
                        <td>
                            <input type="text" class="sm" name="order" value="0">
                        </td>
                    </tr>
                    <tr>
                        <th>备注(说明)：</th>
                        <td>
                            <textarea name="tips" id="" cols="30" rows="10"></textarea>
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
    <script>
        showOrHidden();
        function showOrHidden() {
            var type = $("input[name='field_type']:checked").val();
            if(type == 'radio'){
                $('tr.field_value').show();
            } else {
                $('tr.field_value').hide();
            }
        }
    </script>
@endsection