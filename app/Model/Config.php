<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Config 网站配置模型
 * @package App\Model
 */
class Config extends Model
{
    protected $table = "configs";
    protected $primaryKey = "id";
    public  $timestamps = false;
    protected $guarded = [];

    //修改排序
    public function changeOrder($data)
    {
        $conf = $this->find($data['id']);
        $conf->order = $data['order'];
        return $conf->update();
    }
}
