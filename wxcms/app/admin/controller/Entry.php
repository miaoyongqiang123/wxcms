<?php namespace app\admin\controller;


use houdunwang\route\Controller;
use system\model\Admin;

class Entry extends Controller
{

	public function __construct ()
	{
		//echo 111;
		//加载中间件，判断是否登录，如果没有登录，跳回登录页
		//Middleware::set ( 'auth' );
		Middleware::set('auth');

	}

	//动作
	public function index ()
	{
		//此处书写代码...
		return view ();
	}

	/**
	 * 修改密码
	 *
	 * @param Admin $admin
	 *
	 * @return mixed|string
	 */
	public function changePass ( Admin $admin )
	{
		//echo 1;
		if ( Request::isMethod ( 'post' ) ) {
			$res = $admin->changePass ( Request::post () );
			if ( $res[ 'valid' ] ) {
				//跳转到登录页没做
				return message ( $res[ 'msg' ] , u('admin.login.index') , 'success' );
			} else {
				return message ( $res[ 'msg' ] , 'back' , 'error' );
			}
		}

		return view ();
	}


	/**
	 * 退出
	 *
	 * @return mixed
	 */
	public function out ()
	{
		//清空session数据
		Session::flush ();

		//跳回到登录页
		return go ( 'admin.login.index' );
	}


}
