<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category 分类模型
 * @package App\Model
 */
class Category extends Model
{
    //表名
    protected $table = "categorys";
    //主键
    protected $primaryKey = 'id';
    //关闭自动写入字段 created_at  和 updated_at
    public $timestamps = false;
    //允许批量赋值的字段
    //protected $fillable = ["cname","ctitle","ckeywords","cdescription","order","pid"];
    //不允许批量赋值的字段
    protected $guarded = [];   //排除法 可以编辑所有字段
    /**
     * 获取格式化后的分类数据
     * @return array  格式化后的数组数据
     */
    public function getTreeCates()
    {
        return $this->getTree($this->orderBy('order','asc')->get());
    }

    /**
     * 二级分类格式化： 只能格式化2级， 既每个pid=0后面跟着其子级（只有1级）
     * @param $data  数组数据
     * @param string $filed_name    字段名字，用于给该字段连接字符串 ‘├─’
     * @param string $field_id      主键id
     * @param string $field_pid     父级id字段民称
     * @param int $pid              父级id
     * @return array                格式化后的数组数据
     */
    private function getTree($data,$filed_name='cname',$field_id='id',$field_pid="pid",$pid=0)
    {
        $arr = [];
        foreach($data as $k=>$v){
            if($v->$field_pid == $pid){  //最顶层
                $arr[] = $data[$k];
            }
            foreach ($data as $m=>$n){
                if($n->$field_pid == $v->$field_id){
                    $data[$m][$filed_name] = '├─'.$data[$m][$filed_name];
                    $arr[] = $data[$m];
                }
            }
        }
        return $arr;
    }

    /**
     * 修改排序字段
     * @param array $data  数组数据
     * @return mixed bool  修改成功返回影响记录行，失败返回false
     */
    public function changeOrder($data)
    {
        $cate = $this->find($data['id']);
        $cate->order = $data['order'];
        return $cate->update();
    }

}
