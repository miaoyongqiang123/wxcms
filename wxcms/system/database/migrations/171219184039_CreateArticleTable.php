<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class CreateArticleTable extends Migration {
    //执行
	public function up() {
		Schema::create( 'admin', function ( Blueprint $table ) {
			$table->increments( 'id' );
            $table->timestamps();
			$table->string ('username',100)->defaults ('')->comment ('管理员用户名');
			$table->string ('password',100)->defaults ('')->comment ('管理员密码');
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'admin' );
    }
}