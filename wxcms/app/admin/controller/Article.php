<?php namespace app\admin\controller;

use houdunwang\route\Controller;
use system\model\Category;
use system\model\Article as ArticleModel;

class Article extends Controller
{
	public function __construct ()
	{
		//auth函数我们自定义的中间件函数。放在system/helper.php
		auth ();

	}

	//动作

	/**
	 * 文章数据展示
	 * @return mixed
	 */
	public function index ()
	{
		//此处书写代码...
		//$num=v ('system.arc_num');
		//数据分页展示
		$field = ArticleModel::paginate ( 20 );

		return view ( '' , compact ( 'field' ) );
	}

	/**
	 * 文章数据添加
	 *
	 * @param Category     $category 栏目
	 * @param ArticleModel $article  文章模型类
	 *
	 * @return mixed|string
	 * @throws \Exception
	 */
	public function store ( Category $category , ArticleModel $article )
	{
		//此处书写代码...
		if ( Request::isMethod ( 'post' ) ) {
			$res = $article->store ( Request::post () );
			if ( $res[ 'valid' ] ) {
				return message ( $res[ 'msg' ] , u ( 'index' ) , 'success' );
			} else {
				return message ( $res[ 'msg' ] , 'back' , 'error' );

			}

		}
		//获取所有栏目数据，并转为树状结构
		$cateData = $category->getCateTreeData ();

		//p ($cateData);
		//显示模板
		return view ( '' , compact ( 'cateData' ) );
	}


	/**
	 * 文章数据编辑
	 *
	 * @param Category     $category
	 * @param ArticleModel $article
	 *
	 * @return mixed|string
	 */
	public function edit ( Category $category , ArticleModel $article )
	{

		//		获取编辑的数据的主键ID
		$id = Request::get ( 'id' , 0 , 'intval' );
		if ( Request::isMethod ( 'post' ) ) {
			$res = $article->edit ( Request::post () , $id );
			if ( $res[ 'valid' ] ) {
				return message ( $res[ 'msg' ] , u ( 'index' ) , 'success' );

			} else {
				return message ( $res[ 'msg' ] , 'back' , 'error' );

			}

		}
		//获取旧数据
		$oldData = ArticleModel::find ( $id );
		//获取所有栏目数据，并转为树状结构
		$cateData = $category -> getCateTreeData ();
		//p ($cateData);
		//此处书写代码...
		return view ( '' , compact ( 'oldData' , 'cateData' ) );
	}

	/**
	 * 文章数据删除
	 * @return mixed|string
	 */
	public function del ()
	{
		//此处书写代码...
		$id=Request::get('id',0,'intval');
		ArticleModel::delete($id);

		return message ('删除成功',u ('index'),'success');


	}


}
