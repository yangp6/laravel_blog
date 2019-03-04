<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class DemoController extends Controller
{
    //测试
    public function index() {
        $pwd = "123456";
        $enctype_pass = Crypt::encrypt($pwd); //加密
        echo $enctype_pass;
        echo "<br>长度是: ".strlen($enctype_pass);
        echo "<hr>";
        //解密
        $str = "eyJpdiI6IkdkcXdHSDFub0R5QzZ3WitXbTVwNEE9PSIsInZhbHVlIjoidDc4QWJpTHBEOWNyK1FqXC9ETFF0eUE9PSIsIm1hYyI6IjUzMWQ1ZDhlMWZiZWU0MTc0MzQ3ZTg0NjM4ZmFkYzQ0ZmRhMmJmNmE0ZTIwMDlkYTBlZmEzMWI1ZTUyZmQ3NmIifQ==";
        echo Crypt::decrypt($str);
    }
}
