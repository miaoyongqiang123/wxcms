<?php namespace app\wechat\controller;

use houdunwang\route\Controller;
use system\model\Config as ConfigModel;

class Config extends Controller
{
	//动作
	public function __construct ()
	{
		auth ();
	}

	public function index ( ConfigModel $config )
	{
		//此处书写代码...
		//echo 111;
		//把提交的数据保存到数据库，并提示消息
		if ( Request::isMethod ( 'post' ) ) {
			$res = $config->postWechat ( Request::post () );
			if ( $res[ 'valid' ] ) {
				return message ( $res[ 'msg' ] , 'refresh' , 'success' );
			} else {
				return message ( $res[ 'msg' ] , 'back' , 'error' );

			}
		}
		//获取配置项表中的微信配置项数据
		$field = ConfigModel::find ( 1 );
		//把数据转换为数组形式
		$field = json_decode ( $field[ 'wechat_config' ] , true );
		//加载模板，并且把微信配置项数据显示到页面上
		return view ('',compact ('field'));

	}
}
