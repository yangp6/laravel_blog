<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->engine = 'MyIsam';
            $table->increments('id');
            $table->string('name')->default('')->comment('名称')->index();
            $table->string('title')->default('')->comment('标题');
            $table->string('url')->default('')->comment('链接地址')->unique();
            $table->integer('order')->default(0)->comment('链接顺序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
