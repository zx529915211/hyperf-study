<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('主键id');
            $table->string('email', 50)->comment('邮箱');
            $table->string('password', 255)->comment('密码');
            $table->string('pic', 100)->comment('头像');
            $table->string('nickname', 100)->comment('昵称');
            $table->unique('email','email');
            $table->integer('create_time')->comment('创建时间');
            $table->integer('update_time')->comment('更新时间');
            $table->comment('用户表');
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
        Schema::dropIfExists('users');
    }
}
