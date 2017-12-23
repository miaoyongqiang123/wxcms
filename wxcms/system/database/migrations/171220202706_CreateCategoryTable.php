<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class CreateCategoryTable extends Migration {
    //执行
	public function up() {
		Schema::create( 'category', function ( Blueprint $table ) {
			$table->increments( 'id' );
            $table->timestamps();
            $table->string('cname',100)->defaults ('')->comment('标签名称');
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'category' );
    }
}