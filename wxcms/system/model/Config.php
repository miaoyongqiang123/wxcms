<?php namespace system\model;

use houdunwang\model\Model;

class Config extends Model
{
	//数据表
	protected $table = "config";

	//自动验证
	protected $validate
		= [//['字段名','验证方法','提示信息',验证条件,验证时间]
		];

	//时间操作,需要表中存在created_at,updated_at字段
	protected $timestamps = true;

	/**
	 * 配置站点文件修改并保存
	 *
	 * @param $post 要保存的数据
	 *
	 * @return array 提示消息
	 * @throws \Exception
	 */
	public function post ( $post )
	{
		$model = Config::find ( 1 ) ? : new Config();
		//p ($model); die;
		//把数据转成jeson格式，并存入数据表
		$model->system_config = json_encode ( $post , JSON_UNESCAPED_UNICODE );
		$model->save ();

		return [ 'valid' => 1 , 'msg' => '操作成功' ];

		//$modle = Article::find ( $id );
		//$modle->save ( $post );

	}

	/**
	 * 保存微信配置项数据
	 *
	 * @param $post 要保存的post数据
	 *
	 * @return array 提示消息
	 * @throws \Exception
	 */
	public function postWechat ( $post )
	{
		//加载配置项数据
		$model = Config::find ( 1 ) ? : new static();
		//把提交上来的数据保存到微信配置项字段中，并不允许编码
		$model->wechat_config = json_encode ( $post , JSON_UNESCAPED_UNICODE );
		//执行保存
		$model->save ();

		//返回成功提示消息
		return [ 'valid' => 1 , 'msg' => '保存成功' ];
	}

	/**
	 * 添加微信回复消息数据
	 * @param $post post数据
	 *
	 * @return array 提示消息
	 * @throws \Exception
	 */
	public function postWechatResponse ( $post )
	{
		$model = Config::find ( 1 ) ? : new static();
		//把post数据转成json格式，并且不编码
		$model->wechat_response = json_encode ( $post , JSON_UNESCAPED_UNICODE );
		//保存post数据
		$model->save ();
		//提示消息
		return ['valid'=>1,'msg'=>'添加成功'];
	}


}