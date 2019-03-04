<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/***
 * Class Article 文章模型
 * @package App\Model
 */
class Article extends Model
{
    protected  $table = "articles";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $guarded = [];
}
