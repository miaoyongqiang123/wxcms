<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class ChangeConfigTable extends Migration {
    //执行
	public function up() {
		Schema::table( 'config', function ( Blueprint $table ) {
			//$table->string('name', 50)->add();
			$table->text('wechat_config')->add();
			$table->text('wechat_response')->comment ('微信回复')->add();

        });
    }

    //回滚
    public function down() {
            //Schema::dropField('config', 'name');
    }
}