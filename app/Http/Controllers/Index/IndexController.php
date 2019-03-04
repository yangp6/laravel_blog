<?php

namespace App\Http\Controllers\Index;

use App\Model\Category;
use App\Model\Article;
use App\Model\Link;
use Illuminate\Http\Request;

/**
 * Class IndexController    前台首页控制器
 * @package App\Http\Controllers\Index
 */
class IndexController extends CommonController
{
    //首页展示
    public function index()
    {

        //图文列表 带分页效果 5篇
        $data = Article::orderBy('pub_time','desc')->paginate(5);  //limit也可以使用 take()

        //友情链接
        $links = Link::orderBy('order','asc')->get();

        return view('index.index',compact('data','links'));
    }

    //列表展示
    public function lists(Category $category,$id)
    {
        //查看次数自增
        $category->where('id','=',$id)->increment('cview',1);
        //分类信息
        $cates = $category->find($id);

        // 图文列表 带分页效果 5篇
        $data = Article::where('cid',$id)->orderBy('pub_time','desc')->paginate(5);  //limit也可以使用 take()

        //当前分类的子分类
        $subCates = $category->where('pid',$id)->get();
        return view("index.lists",compact('cates','data','subCates'));
    }

    //文章详细页面
    public function show(Article $article,$id)
    {
        //查看次数自增
        $article->where('id','=',$id)->increment('views',1);

        //id对应文章内容
        $arts = $article->select("articles.*",'cname')->join('categorys','articles.cid','=','categorys.id')->find($id);

        //上一篇， 下一篇
        $article['pre'] = $article->where('id','<',$id)->orderBy('id','desc')->first();
        $article['next'] = $article->where('id','>',$id)->orderBy('id','asc')->first();

       //相关文章
        $relativeArticle = $article->where('cid','=',$arts->id)->orderBy('id','desc')->take(6)->get();
        return view("index.show",compact('arts','article','relativeArticle'));
    }
}
