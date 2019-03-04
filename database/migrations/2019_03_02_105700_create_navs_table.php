<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navs', function (Blueprint $table) {
            $table->engine = 'MyIsam';  //指定表存储引擎
            $table->comment = '自定义导航表'; //表注释
            $table->increments('id');
            $table->string('name')->default('')->comment('名称')->index();
            $table->string('alias')->default('')->comment('别名');
            $table->string('url')->default('')->comment('导航链接地址')->unique();
            $table->integer('order')->default(0)->comment('排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('navs');
    }
}
