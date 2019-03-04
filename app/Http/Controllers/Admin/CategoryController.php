<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class CategoryController 文章分类控制器
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends CommonController
{
    public function __construct()
    {
        $this->model = new Category();
    }

    //分类列表
    public function index()
    {
        //格式化分类数据
        $data = $this->model -> getTreeCates();
        return view("admin.cates.index",compact('data'));
    }

    //添加表单
    public function create()
    {
        //获取一级分类
        $data = $this->getFisrtCates();
        return view("admin.cates.create",compact('data'));
    }

    //添加操作
    public function store(Request $request)
    {
        //1-接收数据
        $data = $request->except("_token");
        $rules = [
            'cname' => 'required|between:2,20',
            'order'=>'numeric|between:0,255'
        ];
        $message = [
            'cname.required'=>"分类名称不能为空！",
            'cname.between'=>"分类名称长度必须在2-20位！",

            'order.numeric'=>'排序只能是数字!',
            'order.between'=>'排序只能在数字0-255之间!',
        ];
        //2-校验数据
        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            if($res = $this->model->create($data)){
                return redirect("admin/category")->withErrors("添加分类成功！");
            } else {
                return back()->withErrors("添加失败!,请稍后重试！");
            }
        } else {
            return back()->withErrors($validator);
        }
    }
    //修改表单
    public function edit($id)
    {
        $category =$this->model->find($id);
        $data = $this->getFisrtCates();
        return view("admin.cates.edit",compact('data','category'));
    }

    //获取一级分类数据
    private function getFisrtCates()
    {
        return $this->model->where("pid","=",0)->get();
    }
    //修改操作
    public function update(Request $request,$id)
    {
        $data = $request->except("_token","_method");
        $rules = [
            'cname' => 'required|between:2,20',
            'order'=>'numeric|between:0,255'
        ];
        $message = [
            'cname.required'=>"分类名称不能为空！",
            'cname.between'=>"分类名称长度必须在2-20位！",

            'order.numeric'=>'排序只能是数字!',
            'order.between'=>'排序只能在数字0-255之间!',
        ];
        //2-校验数据
        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            if($res = $this->model->where('id','=',$id)->update($data)){
                return redirect("admin/category")->withErrors("修改分类成功！");
            } else {
                return back()->withErrors("修改失败!,请稍后重试！");
            }
        } else {
            return back()->withErrors($validator);
        }
    }

    //删除操作: 如果删除的分类有子类，则直接将子类修改为 顶级分类
    public function destroy($id)
    {
        if( $this->model->where('id',$id)->delete() ){
            $this->model->where('pid','=',$id)->update(['pid'=>0]);
            return ['status'=>0,'message'=>"删除成功"];
        } else {
            return ['status'=>1,'message'=>"删除失败，稍后请重试!"];
        }
    }

    //排序
    public function chageOrder(Request $request)
    {
        $data = $request->except('_token');
        if($this->model->changeOrder($data)){
            return ['status'=>0,'msg'=>'排序修改成功！'];
        } else {
            return ['status'=>1,'msg'=>'排序修改失败！请稍后重试！!'];
        }
    }
}
