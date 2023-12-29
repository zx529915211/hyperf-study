<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('uid')->comment('用户id');
            $table->bigInteger('question_id')->comment('问题id');
            $table->bigInteger('pid')->comment('父id');
            $table->string('content', 500)->comment('回复内容');
            $table->integer('supports')->comment('点赞数');
            $table->integer('create_time')->comment('创建时间');
            $table->integer('update_time')->comment('更新时间');
            $table->index('question_id', 'question_id');
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
        Schema::dropIfExists('answer');
    }
}
