<?php

namespace App\Http\Controllers\Admin;

use App\Model\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
/**
 * Class ConfigController 网站配置控制器
 * @package App\Http\Controllers\Admin
 */
class ConfigController extends CommonController
{
    //配置列表
    public function index()
    {
        $data = Config::orderBy('order','asc')->get();
        foreach ($data as $k=>$v){
            $id = $v->id;
            switch($v->field_type){
                case 'input':
                    $data[$k]->_html = '<input class="lg" type="text" name="content['.$id.']" value="'.$v->content.'">';
                    break;
                case 'textarea':
                    $data[$k]->_html = '<textarea class="lg" name="content['.$id.']">'.$v->content.'</textarea>';
                    break;
                case 'radio':
                    //1|开启，0|关闭
                    $arr = explode(",",$v->field_value);
                    $str = '';
                    foreach ($arr as $m=>$n){
                        $arrRes = explode("|",$n);
                        $c = ($v->content == $arrRes[0])? ' checked ':''; //内容为1，则开启的radio选中，反之关闭的radio选中
                        $str .= '<label><input type="radio" name="content['.$id.']" value="'.$arrRes[0].'" '.$c.'>'.$arrRes[1].'</label>';
                    }
                    $data[$k] ->_html = $str;
                    break;
            }
        }
        return view('admin.configs.index',compact('data'));
    }

    //添加表单
    public function create()
    {
        return view('admin.configs.create');
    }
    //添加操作
    public function store(Request $request)
    {
        $data = $request->except("_token");
        $rules = [
            'name'=>'required',
            'title'=>'required',
            'order'=>'numeric',
        ];
        $message = [
            'name.required'=>'配置名称不能为空',
            'title.required'=>'配置标题不能为空',
            'order.numeric'=>'排序必须是数字',
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            $data['name'] = strtoupper($data['name']);  //将配置项的名称转换为大写
            if($res = Config::create($data)){
                return redirect("admin/config")->withErrors("配置项添加成功!");
            } else {
                return back()->withErrors("添加失败!,请稍后重试！");
            }
        } else {
            return back()->withErrors($validator);
        }
    }

    //编辑表单
    public function edit(Config $config)
    {
        return view("admin.configs.edit",compact('config'));
    }

    /**
     * 更新操作
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Config $config)
    {
        $data =$request->except('_token','_method');
        $rules = [
            'name'=>'required',
            'title'=>'required',
            'order'=>'numeric',
        ];
        $message = [
            'name.required'=>'配置名称不能为空',
            'title.required'=>'配置标题不能为空',
            'order.numeric'=>'排序必须是数字',
        ];
        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            $data['name'] = strtoupper($data['name']);  //将配置项的名称转换为大写
            if($res = Config::where('id','=',$config->id)->update($data)){
                $this->putFile(); //更新配置文件
                return redirect("admin/config")->withErrors("配置修改成功！");
            } else {
                return back()->withErrors("修改失败!,请稍后重试！");
            }
        } else {
            return back()->withErrors($validator);
        }
    }

    //修改内容
    public function changeContent(Request $request)
    {
        $data = $request->all();
        foreach ($data['content'] as $k=>$v){
            Config::where('id','=',$k)->update(['content'=>$v]);
        }
        $this->putFile(); //更新配置文件
        return back()->withErrors("配置内容改成功!");
    }

    /**
     * 删除配置项
     *
     * @param  \App\Model\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        if( Config::where('id',$config->id)->delete() ){
            $this->putFile(); //更新配置文件
            return ['status'=>0,'msg'=>"删除成功"];
        } else {
            return ['status'=>1,'msg'=>"删除失败，稍后请重试!"];
        }
    }


    //排序
    public function changeOrder(Request $request)
    {
        $data = $request->all();
        $model = new Config();
        if($model->changeOrder($data)){
            return ['status'=>0,'msg'=>'排序修改成功！'];
        } else {
            return ['status'=>1,'msg'=>'排序修改失败！请稍后重试！!'];
        }
    }


    //把配置项写入到配置文件中去
    public function putFile()
    {
        //pluck()获取集合中给定键对应的所有值. 参数1是查询的字段名称，参数2是使用值作为键名
        $data = Config::pluck('content','name')->all();
        //将数组转换为字符串
        $str = "<?php  \n\n return ".var_export($data,true).";";

        //配置文件 路径
        $path = config_path().DIRECTORY_SEPARATOR."website.php";
        //下面两种方式都可以
        file_put_contents($path,$str);
    }
}
