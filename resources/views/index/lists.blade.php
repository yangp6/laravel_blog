@extends('index.layouts.index')
@section('meta')
    <title>{{$cates->cname}}-- {{ Config::get('website.SITE_TITLE')}}</title>
    <meta name="keywords" content="{{$cates->ckeywords}}" />
    <meta name="description" content="{{$cates->cdescription}}" />
@endsection
@section('css')
    <link href="{{ asset('index/css/style.css') }}" rel="stylesheet">
@endsection
@section('content')
<article class="blogs">
<h1 class="t_nav"><span>{{$cates->ctitle}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('lists/'.$cates->id)}}" class="n2">{{$cates->cname}}</a></h1>
<div class="newblog left">

    @forelse ($data as $d)
   <h2>{{$d->title}}</h2>
   <p class="dateview"><span>发布时间：{{date('Y-m-d',$d->pub_time)}}</span><span>作者：{{$d->editor}}</span><span>分类：[<a href="{{url('lists/'.$cates->id)}}">{{$cates->cname}}</a>]</span></p>
    <figure><img src="{{url($d->thumb)}}" title="平轩博客"></figure>
    <ul class="nlist">
      <p>{{str_limit(strip_tags($d->content),300)}}</p>
      <a title="{{$d->title}}" href="{{url('show/'.$d->id)}}" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <div class="line"></div>
    @empty
        暂无文章！
    @endforelse

    <div class="blank"></div>
    <div class="ad">  
    <img src="{{asset('index/images/ad.png')}}">
    </div>

        <div class="page">
            {{ $data->links() }}
        </div>
</div>
<aside class="right">
    @if ($subCates->all())
       <div class="rnav">
          <ul>
              @foreach ($subCates as $k=>$s)
            <li class="rnav{{(($k + 1)%4) ? ($k + 1)%4 : 4 }}"><a href="{{url('lists/'.$s->id)}}" target="_blank" title="{{$s->cname}}">{{$s->cname}}</a></li>
              @endforeach
         </ul>
        </div>
    @endif
    <!-- Baidu Button BEGIN -->
        <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
        <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
        <script type="text/javascript" id="bdshell_js"></script>
        <script type="text/javascript">
            document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
        </script>
        <!-- Baidu Button END -->
        <div class="news right">
    @parent
    </div>

</aside>
</article>
@endsection