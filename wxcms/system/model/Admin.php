<?php namespace system\model;

use houdunwang\model\Model;
use houdunwang\session\Session;
use houdunwang\validate\Validate;

class Admin extends Model
{

	//数据表
	protected $table = "admin";

	//时间操作,需要表中存在created_at,updated_at字段
	protected $timestamps = true;

	/**
	 * 接收post数据并进行登录验证
	 *
	 * @param $post
	 *
	 * @return array
	 */
	public function login ( $post )
	{
		//接收post数据并判断
		//1，验证用户名，密码不能为空，验证码是否一致
		$res = Validate::make (
			[
				//[ 'phone', 'phone', '手机号格式错误', Validate::MUST_VALIDATE ]
				[ 'username' , 'isnull' , '请输入用户名' , Validate::MUST_VALIDATE ] , [ 'password' , 'isnull' , '请输入密码' , Validate::MUST_VALIDATE ] , [ 'code' , 'captcha' , '验证码错误' , Validate::MUST_VALIDATE ]
			] , $post );
		//if($res===false){
		//	print_r(Validate::getError());
		//}
		//2.验证用户名是否正确
		$userinfo = $this->where ( 'username' , $post[ 'username' ] )->first ();
		if ( ! $userinfo ) {
			//说明用户名在数据表找不到
			//return ['成功还是失败的标识，1代表成功，0失败','提示消息'];
			return [ 'valid' => 0 , 'msg' => '用户名不正确' ];
		}
		//3.验证密码是否正确
		//p ($userinfo);die;
		if ( ! password_verify ( $post[ 'password' ] , $userinfo[ 'password' ] ) ) {

			return [ 'valid' => 0 , 'msg' => '密码不正确' ];
		}
		//4.登录成功，存储用户名到session
		Session::set ( 'id' , $userinfo[ 'id' ] );
		Session::set ( 'username' , $userinfo[ 'username' ] );

		return [ 'valid' => 1 , 'msg' => '登录成功' ];
	}

	/**
	 * 修改密码并保存
	 *
	 * @param $post
	 *
	 * @return array
	 */
	public function changePass ( $post )
	{
		//1.验证数据是否为空
		$res = Validate::make (
			[
				[ 'old_password' , 'isnull' , '请输入旧密码' , Validate::MUST_VALIDATE ],
				[ 'password' , 'isnull' , '请输入新密码' , Validate::MUST_VALIDATE ] ,
				[ 'confirm_password' , 'confirm:password' , '请确认新密码' , Validate::MUST_VALIDATE ] ,
			] , $post );

		//2.验证旧密码是否正确
		$userinfo = $this->where ( 'id' , Session::get ( 'id' ) )->first ();
		//p ($userinfo);die;
		if ( ! password_verify ( $post[ 'password' ] , $userinfo[ 'password' ] ) ) {
			return [ 'valid' => 0 , 'msg' => '旧密码输入不正确' ];
		}
		//3.执行修改
		//查找主键为1的数据
		$model = Admin::find ( Session::get ( 'id' ) );
		//修改数据对象
		$model->password = password_hash ( $post[ 'password' ] , PASSWORD_DEFAULT );
		//保存数据对象
		$model->save ();

		return [ 'valid' => 1 , 'msg' => '密码修改成功' ];
	}


}