<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Nav;
use App\Model\Article;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        $navs = Nav::all(); // 自定义导航

        //点击量最高的 6 篇文章
        $hots = Article::orderBy('views','desc')->limit(6)->get();  //limit也可以使用 take()

        //最新发布文章 8 篇
        $new = Article::orderBy('pub_time','desc')->take(8)->get();

        View::share('navs',$navs);  //视图共享变量
        View::share('hots',$hots);  //视图共享变量
        View::share('new',$new);  //视图共享变量
    }
}
