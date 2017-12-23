<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class CreateArticleTable extends Migration {
	//执行
	public function up() {
		Schema::create( 'article', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->timestamps();
			$table->string ('title',200)->defaults ('')->comment ('文章标题');
			$table->string ('author',200)->defaults ('')->comment ('文章作者');
			$table->string ('prev',200)->defaults ('')->comment ('文章预览图');
			$table->text  ('content')->comment ('文章内容');
			$table->integer   ('click')->defaults (0)->comment ('文章点击次数');
			$table->integer   ('cid')->defaults (0)->comment ('文章所属栏目');
			$table->tinyInteger ('is_hot')->defaults (2)->comment ('是否热门，1是，2否');
			$table->tinyInteger ('is_recommened')->defaults (2)->comment ('是否推荐，1是，2否');
		});
	}

	//回滚
	public function down() {
		Schema::drop( 'article' );
	}
}