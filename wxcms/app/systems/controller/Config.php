<?php namespace app\systems\controller;

use houdunwang\route\Controller;
use system\model\Config as ConfigModel;

class Config extends Controller
{
	//动作
	public function index ( ConfigModel $config )
	{
		//此处书写代码...
		if ( Request::isMethod ( 'post' ) ) {
			$res = $config->post ( Request::post () );
			if ( $res[ 'valid' ] ) {
				return message ( $res[ 'msg' ] , 'refresh' , 'success' );
			} else {
				return message ( $res[ 'msg' ] , 'back' , 'error' );
			}
		}
		//获取数据表中数据,因为只有一条数据，所以find（）里面传入1；
		$field = ConfigModel::find ( 1 );
		//p ($field);die;
		//把jeson数据转换为数组形式
		$field = json_decode ( $field[ 'system_config' ] , true );

		//p($field);die;
		return view ( '' , compact ( 'field' ) );

	}
}
