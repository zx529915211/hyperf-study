<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('question', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid')->comment('用户id');
            $table->string('title',100)->comment('内容');
            $table->string('content_path',100)->comment('内容地址');
            $table->string('content_hash',100)->comment('内容hash值');
            $table->integer('create_time')->comment('创建时间');
            $table->integer('update_time')->comment('更新时间');
            $table->unique('content_hash','content_hash');
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
        Schema::dropIfExists('question');
    }
}
