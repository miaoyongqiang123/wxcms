<?php namespace system\model;

use houdunwang\model\Model;

class Article extends Model
{

	//数据表
	protected $table = "article";

	//允许填充字段
	protected $allowFill = [ '*' ];

	//自动验证
	protected $validate
		= [//['字段名','验证方法','提示信息',验证条件,验证时间]
			[ 'title' , 'isnull' , '请输入文章标题' , self::MUST_VALIDATE , self::MODEL_BOTH ] , [ 'author' , 'isnull' , '请输入文章作者' , self::MUST_VALIDATE , self::MODEL_BOTH ] , [ 'is_hot' , 'isnull' , '请选择是否热门' , self::MUST_VALIDATE , self::MODEL_BOTH ] , [ 'is_recommened' , 'isnull' , '请选择是否推荐' , self::MUST_VALIDATE , self::MODEL_BOTH ] , [ 'cid' , 'isnull' , '请选择所属栏目' , self::MUST_VALIDATE , self::MODEL_BOTH ] , [ 'prev' , 'isnull' , '请上传预览图' , self::MUST_VALIDATE , self::MODEL_BOTH ] , [ 'content' , 'isnull' , '请输入文章内容' , self::MUST_VALIDATE , self::MODEL_BOTH ] ,
		];

	//时间操作,需要表中存在created_at,updated_at字段
	protected $timestamps = true;

	/**
	 * 文章数据添加
	 *
	 * @param $post 要添加的数据
	 *
	 * @return array 返回提示消息
	 * @throws \Exception
	 */
	public function store ( $post )
	{
		$this->save ( $post );

		return [ 'valid' => 1 , 'msg' => '编辑成功' ];
	}

	/**
	 * 文章数据编辑
	 * @param $post 编辑后提交的数据
	 * @param $id 数据主键id
	 *
	 * @return array 提示消息
	 */
	public function edit ( $post , $id )
	{
		$modle = Article::find ( $id );
		$modle->save ( $post );

		return [ 'valid' => 1 , 'msg' => '编辑成功'];
	}

	/**
	 * 一对多(反向关联)
	 *
	 * @return mixed
	 */
	public function category ()
	{
		return $this->belongsTo ( Category::class , 'cid' , 'id' );
	}
}