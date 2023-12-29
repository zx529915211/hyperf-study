<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateQuestionDynamicTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('question_dynamic', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('views')->comment('浏览数');
            $table->integer('comments')->comment('评论数');
            $table->integer('replys')->comment('回复数');
            $table->integer('supports')->comment('点赞数');
            $table->integer('create_time')->comment('创建时间');
            $table->integer('update_time')->comment('更新时间');
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
        Schema::dropIfExists('question_dynamic');
    }
}
