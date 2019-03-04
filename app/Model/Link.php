<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links'; //指定数据表
    protected $primaryKey = 'id'; //指定主键

    public $timestamps = false; //取消 时间 机制

    protected $guarded = [];  //不允许批量修改的字段

    /**
     * 修改排序字段
     * @param $data 友情链接数组数据
     * @return mixed bool  更新结果, 失败返回false
     */
    public function changeOrder($data)
    {
        $links = $this->find($data['id']);
        $links->order = $data['order'];
        return $links->update();
    }
}
