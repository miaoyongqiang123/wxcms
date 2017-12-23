<?php namespace system\database\migrations;

use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;

class ChangeCategoryTable extends Migration
{
	//执行
	public function up ()
	{
		Schema::table (
			'category' , function ( Blueprint $table ) {
			//$table->string('name', 50)->add();
			$table->integer ( 'pid' )->defaults ( 0 )->comment ( '父级id' )->add ();
			$table->integer ( 'orders' )->defaults ( 0 )->comment ( '排序' )->add ();
			$table->tinyInteger ( 'is_cate' )->defaults ( 2 )->comment ( '是否栏目封面1代表是，2代表不是' )->add ();
			$table->string ( 'thumb' , 200 )->defaults ( '' )->comment ( '缩略图' )->add ();
		} );
	}

	//回滚
	public function down ()
	{
		//Schema::dropField('category', 'name');
	}
}