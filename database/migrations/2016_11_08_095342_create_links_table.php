<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * 数据迁移是一种数据库的版本控制。
     * 可以让团队在修改数据库结构的同时，保持彼此的进度一致
     * Migrations把表结构存储为一个PHP类，通过调用其中的方法来创建、更改数据库。
     * Migrations存放在在 database/migrations 目录中。
     * 初始情况下，其中包含了两个文件：***_create_users_table.php
     * 和 ***_create_password_resets_table.php，
     * 分别是用户表和用户密码重置表。
     * 每个文件中都包含了 up() 和 down() 两个方法，一个用来创建、更改数据表，
     * 一个用来回滚操作，即撤 up() 中的操作
     *  创建表
     * @return void
     * $table->bigIncrements('id'); 	自增ID，类型为bigint
     * $table->bigInteger('votes'); 	等同于数据库中的BIGINT类型
     * $table->binary('data'); 	等同于数据库中的BLOB类型
     * $table->boolean('confirmed'); 	等同于数据库中的BOOLEAN类型
     * $table->char('name', 4); 	等同于数据库中的CHAR类型
     * $table->date('created_at'); 	等同于数据库中的DATE类型
     * $table->dateTime('created_at'); 	等同于数据库中的DATETIME类型
     * $table->decimal('amount', 5, 2); 	等同于数据库中的DECIMAL类型，带一个精度和范围
     * $table->double('column', 15, 8); 	等同于数据库中的DOUBLE类型，带精度, 总共15位数字，小数点后8位.
     * $table->enum('choices', ['foo', 'bar']); 	等同于数据库中的 ENUM类型
     * $table->float('amount'); 	等同于数据库中的 FLOAT 类型
     * $table->increments('id'); 	数据库主键自增ID
     * $table->integer('votes'); 	等同于数据库中的 INTEGER 类型
     * $table->json('options'); 	等同于数据库中的 JSON 类型
     * $table->jsonb('options'); 	等同于数据库中的 JSONB 类型
     * $table->longText('description'); 	等同于数据库中的 LONGTEXT 类型
     * $table->mediumInteger('numbers'); 	等同于数据库中的 MEDIUMINT类型
     * $table->mediumText('description'); 	等同于数据库中的 MEDIUMTEXT类型
     * $table->morphs('taggable'); 	添加一个 INTEGER类型的 taggable_id 列和一个 STRING类型的 taggable_type列
     * $table->nullableTimestamps(); 	和 timestamps()一样但允许 NULL值.
     * $table->rememberToken(); 	添加一个 remember_token 列： VARCHAR(100) NULL.
     * $table->smallInteger('votes'); 	等同于数据库中的 SMALLINT 类型
     * $table->softDeletes(); 	新增一个 deleted_at 列 用于软删除.
     * $table->string('email'); 	等同于数据库中的 VARCHAR 列  .
     * $table->string('name', 100); 	等同于数据库中的 VARCHAR，带一个长度
     * $table->text('description'); 	等同于数据库中的 TEXT 类型
     * $table->time('sunrise'); 	等同于数据库中的 TIME类型
     * $table->tinyInteger('numbers'); 	等同于数据库中的 TINYINT 类型
     * $table->timestamp('added_on'); 	等同于数据库中的 TIMESTAMP 类型
     * $table->timestamps(); 	添加 created_at 和 updated_at列.
     * http://laravelacademy.org/post/2965.html
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->engine = 'MyISAM'; //设置存储引擎
            $table->increments('id')->comment('友情链接ID');// 主键 自增
            $table->string('name', 60)->comment('友情链接名称'); //VARCHAR，带一个长度
            $table->string('url', 255)->comment('友情链接url');//VARCHAR，带一个长度
            $table->string('descs', 200)->default('')->comment('友情链接描述');//默认值为空 ,VARCHAR，带一个长度
            $table->integer('orders')->default('1')->comment('友情链接排序');
            $table->timestamps(); // 自动创建的两个字段：created_at 和 updated_at
        });
    }

    /**
     * Reverse the migrations.
     * 删除表
     * @return void
     * 重命名/删除表
     * 要重命名一个已存在的数据表，使用rename方法：
     * Schema::rename($from, $to);
     * 要删除一个已存在的数据表，可以使用drop或dropIfExists方法：
     * Schema::drop('users');
     * Schema::dropIfExists('users');
     */
    public function down()
    {
        Schema::drop('users');

    }
}
