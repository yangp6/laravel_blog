<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Nav 导航模型类
 * @package App\Model
 */
class Nav extends Model
{
    protected $table = 'navs'; //指定数据表
    protected $primaryKey = 'id'; //指定主键
    public $timestamps = false; //取消 时间 机制
    protected $guarded = [];  //不允许批量修改的字段


    //修改排序
    public function changeOrder($data)
    {
        $navs = $this->find($data['id']);
        $navs->order = $data['order'];
        return $navs->update();
    }
}
