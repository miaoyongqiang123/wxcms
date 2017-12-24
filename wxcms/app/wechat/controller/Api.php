<?php namespace app\wechat\controller;

use houdunwang\route\Controller;
use system\model\Config;

class Api extends Controller
{
	//动作
	//构造方法，微信验证
	public function __construct ()
	{
		WeChat::valid ();

	}


	/**
	 * 回复用户消息
	 */
	public function index ()
	{
		//实例化消息管理类
		//$instance=Wechat::instance('message');
		$instance = WeChat::instance ( 'message' );
		//获取数据库消息回复数据
		$responseData = json_decode ( Config::find ( 1 )->wechat_response , true );
		//p($responseData);die;
		//判断是否是关注事件
		if ( $instance->isSubscribeEvent () ) {
			//向用户回复消息
			$instance->text ( $responseData[ 'welcome' ] );
		}
		//回复文本消息
		if ( $instance->isTextMsg () ) {
			//向用户回复消息
			//echo 11;
			$instance->text ( $responseData[ 'default' ] );
		}

	}

}
