<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use houdunwang\session\Session;

class Auth implements Middleware
{
	//执行中间件
	public function run ( $next )
	{
		//echo "中间件执行了";
		//如果没有登录，跳回到登陆页面
		if ( !Session::has('username') ) {
			return go ( 'admin.login.index' );
		}
		$next();
	}
}