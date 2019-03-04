@extends("admin.layouts.layout")
@section('title','网站配置列表')
@section('static')
    @parent<script type="text/javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/ch-ui.admin.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/layer/layer.js')}}"></script>
@endsection

@section("content")
    @include('admin.modules._breadNav',['href'=>route('admin.config.index'),'bre_first_title'=>'网站配置管理','bre_last_title'=>'站点配置列表'])

    <!--搜索结果页面 列表 开始-->
        <div class="result_wrap">
            @include('admin.modules._message',['h3'=>'网站配置列表'])
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{route('admin.config.create')}}"><i class="fa fa-plus"></i>添加网站配置</a>
                    <a href="{{ route("admin.config.index") }}"><i class="fa fa-list"></i>网站配置列表</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <form action="{{ route('admin.config.content') }}" method="post">
                    {{ csrf_field() }}
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">排序</th>
                        <th class="tc" width="5%">ID</th>
                        <th>配置名称</th>
                        <th>配置项健名</th>
                        <th>内容</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            <input type="text" onchange="UpdateOrder(this,{{$v->id}})" value="{{$v->order}}">
                        </td>
                        <td class="tc">{{$v->id}}</td>
                        <td>
                            <a href="#">{{$v->title}}</a>
                        </td>
                        <td>{{$v->name}}</td>
                        <td>
                            {!! $v->_html !!}</td>
                        <td>
                            <a href="{{route('admin.config.edit',$v->id)}}">修改</a>
                            <a href="javascript:;" onclick="del({{ $v->id }})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                    <div class="btn_group">
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回" >
                    </div>
                </form>
            </div>
        </div>
    <!--搜索结果页面 列表 结束-->
    <script>
        //修改排序
        function UpdateOrder(obj,$id) {
            $.post('{{route("admin.config.order")}}',{id:$id,_token:'{{ csrf_token() }}',order:obj.value},function(data){
                if(data.status){
                    layer.msg(data.msg,{icon:5});
                } else {
                    layer.msg(data.msg,{icon:6,time: 1200},function(){
                        //loaction.href = loaction.href;   //刷新页面
                        location.reload();   //刷新页面
                    });
                }
            });
        }
        //删除配置项
        function del(id) {
            layer.confirm('你确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post('{{url("admin/config")}}/'+id,{'_token':'{{ csrf_token() }}','_method':'delete'},function(data){
                    if(data.status){
                        layer.msg(data.message, {icon: 5});
                    } else {
                        layer.msg(data.msg,{icon:6,time: 1200},function(){
                            //loaction.href = loaction.href;   //刷新页面
                            location.reload();   //刷新页面
                        });
                    }
                });
            }, function(){
            });
        }
    </script>


@endsection