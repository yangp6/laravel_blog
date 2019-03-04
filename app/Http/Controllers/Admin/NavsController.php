<?php

namespace App\Http\Controllers\Admin;

use App\Model\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * Class NavsController 导航控制器
 * @package App\Http\Controllers\Admin
 */
class NavsController extends Controller
{
    //自定义导航列表
    public function index()
    {
        $data = Nav::orderBy('order','asc')->get();
        return view('admin.navs.index',compact('data'));
    }

    //添加表单
    public function create()
    {
        return view('admin.navs.create');
    }

    //添加操作
    public function store(Request $request)
    {
        $data =$request->except("_token");
        $rules = [
            'name'=>'required',
            'url'=>'required',
            'order'=>'numeric',
        ];
        $message = [
            'name.required'=>'导航名称不能为空',
            'url.required'=>'导航地址不能为空',
            'order.numeric'=>'导航排序必须是数字',
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            if($res = Nav::create($data)){
                return redirect("admin/navs")->withErrors("添加导航成功！");
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
        $data = Nav::find($id);
        return view("admin.navs.edit",compact('data'));
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
            if($res = Nav::where('id','=',$id)->update($data)){
                return redirect("admin/navs")->withErrors("导航修改成功！");
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
        if( Nav::where('id',$id)->delete() ){
            return ['status'=>0,'msg'=>"删除成功"];
        } else {
            return ['status'=>1,'msg'=>"删除失败，稍后请重试!"];
        }
    }

    //排序
    public function changeOrder(Request $request)
    {
        $data = $request->all();
        $model = new Nav();
        if($model->changeOrder($data)){
            return ['status'=>0,'msg'=>'排序修改成功！'];
        } else {
            return ['status'=>1,'msg'=>'排序修改失败！请稍后重试！!'];
        }
    }
}
