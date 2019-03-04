<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

/**
 * Class IndexController  后台首页控制器
 * @package App\Http\Controllers\Admin
 */
class IndexController extends CommonController
{
    //后台首页
    public function index()
    {
        return view('admin.index');
    }

    //后台首页--右侧信息页
    public function info()
    {
        return view('admin.info');
    }

    //修改密码
    public function changpwd()
    {
        //判断是否有post数据提交
        if($data = Input::except('_token')) {
            //校验数据
            $rules = [
                'password_old'=>'required',
                'password'=>'required|min:6|confirmed'
            ];
            $message = [
                'password_old.required'     =>  '原始密码不能为空!',
                'password.required'     =>  '新密码不能为空!',
                'password.min'     =>  '新密码长度不能小于6位!',
                'password.confirmed'     =>  '新密码与确认密码不一致!'
            ];
            $validator = Validator::make($data,$rules,$message);
            if($validator->passes()) {

                //修改密码
                $user = User::first();
                $password = Crypt::decrypt($user->password);
                if($data['password_old'] == $password) {
                    $user->password = Crypt::encrypt($data['password']);
                    $user->update(); //更新密码

                    return back()->withErrors('密码修改成功!');
                } else {
                    return back()->withErrors('原密码错误，请重试！');
                }
            } else {
                return  back()->withErrors($validator);
            }
        }
        return view('admin.changepwd');
    }


    //退出登录
    public function logout()
    {
        session(["userInfo"=>null]);
        return redirect("admin/login");
    }
}
