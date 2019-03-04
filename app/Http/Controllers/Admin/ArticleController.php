<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class ArticleController 文章控制器
 * @package App\Http\Controllers\Admin
 */
class ArticleController extends CommonController
{
    //首页--列表页
    public function index()
    {
        //$data = Article::orderBy('id','desc')->paginate(3);
        $data = DB::table('articles')->orderBy('id','desc')->paginate(3);
        return view("admin.articles.index",compact('data'));
    }

    //添加表单
    public function create()
    {
        $data = $this->getTreeCates();
        return view("admin.articles.create",compact('data'));
    }
    //添加操作
    public function store(Request $request)
    {
        //接收数据
        $data = $request->except('_token');

        //校验数据
        $rules = [
            'title'=>'required',
            'editor'=>'required',
            'content'=>'required',
        ];
        $message = [
            'title.required'=>'文章标题不能为空',
            'editor.required'=>'文章作者不能为空',
            'content.required'=>'文章内容不能为空',
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            //写入数据库，给出操作结果提示信息
            $data["pub_time"] = time();
            if($art = Article::create($data)){
                return redirect("admin/article")->withErrors("文章添加成功！");
            } else {
                return back()->withErrors("文章添加失败！ 请稍后重试！");
            }
        } else {
            return back()->withErrors($validator);
        }
    }
    //获取文章分类
    private function getTreeCates()
    {
        $model = new Category();
        return $model->getTreeCates();
    }

    //编辑表单
    public function edit($id)
    {
        //文章数据
        $data = Article::find($id);

        //分类数据
        $cate = $this->getTreeCates();
        return view("admin.articles.edit",compact('data','cate'));
    }

    //修改操作
    public function update(Request $request,$id)
    {
        $data = $request->except("_token","_method");
        if($res = Article::where('id','=',$id)->update($data)){
            return redirect("admin/article")->withErrors("更新数据成功!");
        } else {
            return back()->withErrors("更新数据失败，请稍后重试!");
        }
    }

    //删除操作
    public function destroy($id)
    {
        if( Article::where('id',$id)->delete() ){
            return ['status'=>0,'message'=>"删除成功"];
        } else {
            return ['status'=>1,'message'=>"删除失败，稍后请重试!"];
        }
    }
}
