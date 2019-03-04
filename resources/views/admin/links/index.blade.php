@extends("admin.layouts.layout")
@section('title','友情链接列表')
@section('static')
    @parent<script type="text/javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/ch-ui.admin.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/layer/layer.js')}}"></script>
@endsection

@section("content")
    <!--面包屑导航 开始-->
    @include('admin.modules._breadNav',['href'=>route('admin.links.index'),'bre_first_title'=>'友情链接管理','bre_last_title'=>'友情链接列表'])
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>友情链接列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{route('admin.links.create')}}"><i class="fa fa-plus"></i>添加友情链接</a>
                    <a href="{{ route("admin.links.index") }}"><i class="fa fa-list"></i>友情链接列表</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            @include('admin.modules._message')
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">排序</th>
                        <th class="tc" width="5%">ID</th>
                        <th>链接名称</th>
                        <th>链接标题</th>
                        <th>链接地址</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            <input type="text" onchange="UpdateOrder(this,{{$v->id}})" value="{{$v->order}}">
                        </td>
                        <td class="tc">{{$v->id}}</td>
                        <td>
                            <a href="#">{{$v->name}}</a>
                        </td>
                        <td>{{$v->title}}</td>
                        <td>{{$v->url}}</td>
                        <td>
                            <a href="{{route('admin.links.edit',$v->id)}}">修改</a>
                            <a href="javascript:;" onclick="del({{ $v->id }})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <script>
        //修改排序
        function UpdateOrder(obj,$id) {
            $.post('{{route("admin.links.order")}}',{id:$id,_token:'{{ csrf_token() }}',order:obj.value},function(data){
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
        //删除分类
        function del(id) {
            layer.confirm('你确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post('{{url("admin/links")}}/'+id,{'_token':'{{ csrf_token() }}','_method':'delete'},function(data){
                    if(data.status){
                        layer.msg(data.msg, {icon: 5});
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