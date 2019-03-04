<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

require resource_path() .'/org/Code/Code.class.php';//引入验证码类
class LoginController extends CommonController
{
    //登录表单界面
    public function create() {
        return view('admin.login.create');
    }

    public function store(Request $request)
    {
        //接收数据
        $data = $request->all();

        //验证码校验
        $code = new \Code();
        $sessionCode = $code->get();
        if(strtoupper($data['code'] != $sessionCode)) {
            return back()->with("alertMsg",'验证码错误!');
        }

        //用户名和密码校验
        $user = User::first();
        if(($user->username != $data['username']) && (Crypt::decrypt($user->password) != $data['pwd']) ) {
            return back()->with("alertMsg",'用户名和密码不匹配!');
        }

        //登录信息写入session,跳转到后台
        session(['userInfo'=>$user]);
        return redirect()->route('admin.index');
    }

    //生成验证码
    public function code()
    {
        $code = new \Code();
        $code->make();
    }
}
