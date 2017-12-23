<?php namespace system\database\seeds;
use houdunwang\database\build\Seeder;
use houdunwang\db\Db;
class adminTableSeeder extends Seeder {
    //执行
	public function up() {
		//Db::table('news')->insert(['title'=>'后盾人']);
		$data=[
			'username'=>'myq',
			'password'=>password_hash ('114349',PASSWORD_DEFAULT)
		];
		Db::table('admin')->insert($data);
    }
    //回滚
    public function down() {

    }
}