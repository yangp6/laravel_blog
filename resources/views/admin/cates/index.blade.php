@extends("admin.layouts.layout")
@section('title','文章分类')
@section('static')
    @parent<script type="text/javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/ch-ui.admin.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/layer/layer.js')}}"></script>
@endsection

@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{route('admin.info')}}">首页</a> &raquo; <a href="{{route('admin.category.index')}}">分类管理</a> &raquo; 分类列表
    </div>
    <!--面包屑导航 结束-->
    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>分类管理</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{route('admin.category.create')}}"><i class="fa fa-plus"></i>新增分类</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_title">
                @if(count($errors) > 0)
                    <div class="mark">
                        @foreach($errors->all() as $error)
                            <p> {{$error}}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">排序</th>
                        <th class="tc" width="5%">ID</th>
                        <th>分类名称</th>
                        <th>标题</th>
                        <th>查看次数</th>
                        <th>父级</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">
                            <input type="text"  onchange="UpdateOrder(this,{{$v->id}})" value="{{$v->order}}">
                        </td>
                        <td class="tc">{{$v->id}}</td>
                        <td>
                            <a href="#">{{$v->cname}}</a>
                        </td>
                        <td>{{$v->ctitle}}</td>
                        <td>{{$v->cview}}</td>
                        <td>{{$v->pid}}</td>
                        <td>
                            <a href="{{route('admin.category.edit',$v->id)}}">修改</a>
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
        function UpdateOrder(obj,$id) {
            $.post('{{route("admin.category.order")}}',{id:$id,_token:'{{ csrf_token() }}',order:obj.value},function(data){
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
                $.post('{{url("admin/category")}}/'+id,{'_token':'{{ csrf_token() }}','_method':'delete'},function(data){
                    if(data.status){
                        layer.msg(data.message, {icon: 5});
                    } else {
                        location.reload();   //刷新页面
                        layer.msg(data.message, {icon: 6});
                    }
                });
            }, function(){
            });
        }
    </script>
@endsection