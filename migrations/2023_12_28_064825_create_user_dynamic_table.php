<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUserDynamicTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_dynamic', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('主键id');
            $table->bigInteger('uid')->comment('用户id');
            $table->integer('answers')->comment('回答数');
            $table->integer('supports')->comment('被点赞数');
            $table->integer('create_time')->comment('创建时间');
            $table->integer('update_time')->comment('更新时间');
            $table->unique('uid','uid');
            // 指定表存储引擎
            $table->engine = 'InnoDB';
            // 指定数据表的默认字符集
            $table->charset = 'utf8';
            // 指定数据表默认的排序规则
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_dynamic');
    }
}
