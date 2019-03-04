<?php

namespace App\Http\Controllers\Admin;

use App\Model\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class LinksController 友情链接控制器
 * @package App\Http\Controllers\Admin
 */
class LinksController extends CommonController
{
    //列表
    public function index()
    {
        //升序列表
        $data = Link::orderBy('order','asc')->get();
        return view('admin.links.index',compact('data'));
    }

    //添加表单
    public function create()
    {
        return view('admin.links.create');
    }

    //添加操作
    public function store(Request $request)
    {
        $data = $request->except("_token");
        $rules = [
            'name'=>'required',
            'url'=>'required',
            'order'=>'numeric',
        ];
        $message = [
            'name.required'=>'链接名称不能为空',
            'url.required'=>'链接地址不能为空',
            'order.numeric'=>'排序必须是数字',
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            if($res = Link::create($data)){
                return redirect("admin/links")->withErrors("添加友情链接成功！");
            } else {
                return back()->withErrors("添加失败!,请稍后重试！");
            }
        } else {
            return back()->withErrors($validator);
        }
    }

    //编辑表单
    public function edit($id)
    {
        $data = Link::find($id);
        return view("admin.links.edit",compact('data'));
    }
    //编辑操作
    public function update(Request $request,$id)
    {
        $data = $request->except('_token','_method');
        $rules = [
            'name'=>'required',
            'url'=>'required',
            'order'=>'numeric',
        ];
        $message = [
            'name.required'=>'链接名称不能为空',
            'url.required'=>'链接地址不能为空',
            'order.numeric'=>'排序必须是数字',
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            if($res = Link::where('id','=',$id)->update($data)){
                return redirect("admin/links")->withErrors("修改连接成功！");
            } else {
                return back()->withErrors("修改失败!,请稍后重试！");
            }
        } else {
            return back()->withErrors($validator);
        }
    }

    //删除操作
    public function destroy($id)
    {
        if( Link::where('id',$id)->delete() ){
            return ['status'=>0,'msg'=>"删除成功"];
        } else {
            return ['status'=>1,'msg'=>"删除失败，稍后请重试!"];
        }
    }

    //排序
    public function changeOrder(Request $request)
    {
        $data = $request->all();

        $model = new Link();
        if($model->changeOrder($data)){
            return ['status'=>0,'msg'=>'排序修改成功！'];
        } else {
            return ['status'=>1,'msg'=>'排序修改失败！请稍后重试！!'];
        }
    }
}
