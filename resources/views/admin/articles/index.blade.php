@extends("admin.layouts.layout")
@section('title','文章列表')
@section('static')
    @parent<script type="text/javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/ch-ui.admin.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/layer/layer.js')}}"></script>
@endsection
@section("content")
    <!--面包屑导航 开始-->
    @include('admin.modules._breadNav',['href'=>route('admin.article.index'),'bre_first_title'=>'文章管理','bre_last_title'=>'文章列表'])
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>文章列表</h3>
            </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{route('admin.article.create')}}"><i class="fa fa-plus"></i>添加文章</a>
                    <a href="{{ route("admin.article.index") }}"><i class="fa fa-list"></i>文章列表</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            @include('admin.modules._message')
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th>文章标题</th>
                        <th>点击次数</th>
                        <th>编辑者</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                     <tr>
                        <td class="tc">{{ $v->id }}</td>
                        <td>
                            <a href="#">{{ $v->title }}</a>
                        </td>
                        <td>{{ $v->views }}</td>
                        <td>{{ $v->editor }}</td>
                        <td>{{ date('Y-m-d',$v->pub_time) }}</td>
                        <td>
                            <a href="{{route("admin.article.edit",$v->id)}}">修改</a>
                            <a href="javascript:;" onclick="del({{ $v->id }})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <style>
                    .result_content ul li span {
                        font-size: 15px;
                        padding: 6px 12px;
                    }
                    .page_list {
                        text-align:center;
                    }
                </style>
                <div class="page_list">
                    {{ $data->links() }}
                </div>

            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <script>

        //删除分类
        function del(art_id) {
            layer.confirm('你确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post('{{url("admin/article")}}/'+art_id,{'_token':'{{ csrf_token() }}','_method':'delete'},function(data){
                    if(data.status){
                        layer.msg(data.message, {icon: 5});
                    } else {
                        //loaction.href = loaction.href;   //刷新页面
                        location.reload();   //刷新页面
                        layer.msg(data.message, {icon: 6});
                    }
                });
            }, function(){
            });
        }
    </script>
@endsection