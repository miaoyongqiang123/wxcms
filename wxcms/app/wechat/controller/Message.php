<?php namespace app\wechat\controller;

use houdunwang\route\Controller;
use system\model\Config;

class Message extends Controller
{
	//动作
	public function index ( Config $config )
	{
		//p (\Config::get ( 'wechat' ));
		//此处书写代码...
		//把数据存入到数据库，并提示消息
		if ( Request::isMethod ( 'post' ) ) {
			$res = $config->postWechatResponse ( Request::post () );
			if ( $res[ 'valid' ] ) {
				return message ( $res[ 'msg' ] , 'refresh' , 'success' );
			} else {
				return message ( $res[ 'msg' ] , 'back' , 'error' );

			}
		}
		//获取当前数据，并显示在页面上
		$field = Config::find ( 1 );
		//把数据转换为数组
		$field = json_decode ( $field[ 'wechat_response' ] , true );
		return view ('',compact ('field'));
	}
}
