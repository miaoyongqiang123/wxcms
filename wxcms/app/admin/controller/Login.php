<?php namespace app\admin\controller;

use houdunwang\code\Code;
use houdunwang\route\Controller;
use system\model\Admin;

class Login extends Controller
{
	//动作
	//依赖注入
	public function index ( Admin $admin )
	{
		//此处书写代码...
		//echo 111;
		if ( Request::isMethod ( 'post' ) ) {
			//如果是post请求
			//调用Admin模型中login方法,将所有post提交的数据作为参数传递
			//用php hd make:model admin命令创建模型，存放在system/model里面
			//调用Admin模型中login方法,将所有post提交的数据作为参数传递
			$res = $admin->login ( Request::post () );
			if ( $res[ 'valid' ] ) {
				//如果valid=1，提示登陆成功，并跳转到entry首页
				return message ( $res[ 'msg' ] , u ( 'admin.entry.index' ) , 'success' );

			} else {
				//失败回到登录页
				return message ( $res[ 'msg' ] , 'back' , 'error' );
			}


		}

		return view ( 'login' );
	}

	/**
	 * 验证码
	 */
	public function code ()
	{

		Code::height ( '30' )->num ( '1' )->make ();
	}
}
