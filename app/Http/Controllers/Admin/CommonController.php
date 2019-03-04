<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //图片上传
    public function uploadImg(Request $request)
    {

        $file = $request->file('Filedata');
        //检查上传文件是否有效
        if($file->isValid()){
            //$realpath = $file->getRealPath(); //缓存在tmp文件夹下的文件的绝对路径
            $extesion = $file-> getClientOriginalExtension(); //上传文件的后缀
            $newName = date('YmdHis').mt_rand(100,999).".".$extesion;
            $path = $file->move(public_path()."/uploads/",$newName);  //移动文件到指定目录名重命名
            return "/uploads/".$newName;  //返回文件相对路径
        }
    }
}
