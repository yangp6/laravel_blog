<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('meta')
    <link href="{{asset('index/css/base.css')}}" rel="stylesheet">
    @yield('css')
    <!--[if lt IE 9]>
    <script src="{{asset('index/js/modernizr.js')}}"></script>
    <![endif]-->
</head>
<body>
<header>
    <div id="logo"><a href="/"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $nav)<a href="{{ $nav->url }}"><span>{{ $nav->name }}</span><span class="en">{{ $nav->alias }}</span></a>@endforeach
    </nav>
</header>

@section('content')
    <h3>
        <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        @forelse ($new as $n)
            <li><a href="{{url('show/'.$n->id)}}" title="{{$n->title}}" target="_blank">{{$n->title}}</a></li>
        @empty
            暂无最新文章！
        @endforelse
    </ul>
    <h3 class="ph">
        <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
        @forelse ($hots as $h)
            <li><a href="{{url('show/'.$h->id)}}" title="{{$h->title}}" target="_blank">{{$h->title}}</a></li>
            @if ($loop->iteration == 5)
                @break
            @endif
        @empty
            <li>暂无！</li>
        @endforelse
    </ul>
@show


<footer>
    <p>{!! config('website.COPYWRITE') !!} {!! config('website.SITE_COUNT') !!}</p>
</footer>
<script src="{{asset('index/js/silder.js')}}"></script>
</body>
</html>
