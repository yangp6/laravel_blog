@extends('index.layouts.index')
@section('meta')
  <title>{{$arts->title}}—{{ Config::get('website.SITE_TITLE')}}</title>
  <meta name="keywords" content="{{$arts->tag}}" />
  <meta name="description" content="{{$arts->description}}" />
@endsection
@section('css')
  <link href="{{ asset('index/css/new.css') }}" rel="stylesheet">
@endsection

@section('content')

<article class="blogs">
  <h1 class="t_nav"><span>您当前的位置：<a href="{{url('/')}}">首页</a>&nbsp;&gt;&nbsp;<a href="{{url('lists/'.$arts->cid)}}" title="{{$arts->cname}}">{{$arts->cname}}</a></span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('lists/'.$arts->cid)}}"  class="n2" title="{{$arts->cname}}">{{$arts->cname}}</a></h1>
  <div class="index_about">
    <h2 class="c_titile">{{$arts->title}}</h2>
    <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d',$arts->pub_time)}}</span><span>编辑：{{$arts->editor}}</span><span>查看次数：{{$arts->views}}</span></p>
    <ul class="infos">
      {!! $arts->content !!}
    </ul>
    <div class="keybq">
    <p><span>关键字词</span>：{{$arts->tag}}</p>
    
    </div>
    <div class="ad"> </div>
    <div class="nextinfo">
      <p>上一篇：
        @if ($article['pre'])
        <a href="{{url('show/').$article['pre']->id}}">{{$article['pre']->title}}</a></p>
      @else
        <span>没有上一篇了</span>
      @endif
      <p>下一篇：
        @if ($article['next'])
        <a href="{{url('show/').$article['next']->id}}">{{$article['next']->title}}</a></p>
      @else
        <span>没有下一篇了</span>
        @endif
    </div>
    <div class="otherlink">
      <h2>相关文章</h2>
      <ul>
        @forelse($relativeArticle as $r)
        <li><a href="{{url('show/').$r->id}}" title="{{$r->title}}">{{$r->title}}</a></li>
          @empty
          <li>暂无相关文章！</li>
      @endforelse
      </ul>
    </div>
  </div>
  <aside class="right">
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <!-- Baidu Button END -->
    <div class="blank"></div>
    <div class="news">
      @parent
    </div>
  </aside>
</article>
@endsection