<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('cate_id');
            $table->string('cate_name',10)->nullable(false)->default('');
            $table->bigInteger('cate_p_id')->nullable(false)->default(0);
            $table->integer('cate_level')->nullable(false)->default(0);
            $table->tinyInteger('cate_status')->nullable(false)->default(0)->comment('状态， 0 游客可访问，1 需要登录才能访问 2 删除 ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
