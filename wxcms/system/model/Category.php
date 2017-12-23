<?php namespace system\model;

use houdunwang\model\Model;

class Category extends Model
{
	//数据表
	protected $table = "category";

	//允许填充字段
	protected $allowFill = [ '*' ];

	//自动验证
	protected $validate
		= [//['字段名','验证方法','提示信息',验证条件,验证时间]
			//自动验证标签名是否为空
			[ 'cname' , 'isnull' , '请输入标签名' , self::MUST_VALIDATE , self::MUST_VALIDATE ]
		];

	//时间操作,需要表中存在created_at,updated_at字段
	protected $timestamps = true;

	/**
	 * 添加栏目
	 *
	 * @param $post
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function store ( $post )
	{
		//1.执行数据验证
		//2.执行添加
		//执行save会触发自动验证
		$this->save ( $post );

		return [ 'valid' => 1 , 'msg' => '操作成功' ];
	}

	/**
	 * 编辑栏目
	 *
	 * @param $post post数据
	 * @param $id   数据主键
	 *
	 * @return array
	 */
	public function edit ( $post , $id )
	{
		$model = Category::find ( $id );// 查找主键为1的数据
		$model->save ( $post );// 保存当前数据对象

		return [ 'valid' => 1 , 'msg' => '操作成功' ];
	}


	/**
	 * 获取不在这个数据子集的数据
	 *
	 * @param $id
	 *
	 * @return mixed
	 */
	public function getCateData ( $id )
	{
		//1,找到自己所有的子集，通过递归的方法
		//获取category表中的所有数据
		$data = Db::table ( 'category' )->get ();
		//通过getson方法找所有子集
		$cids = $this->getSon ( $data , $id );
		//2，找见自己
		$cids[] = $id;
		//3，将自己和子集踢出去，并且转为树状结构
		//选出不在子集中的数据
		$data = Db::table ( 'category' )->whereNotIn ( 'id' , $cids )->get ();

		//转为树状结构
		return Arr::tree ( $data , 'cname' , 'id' , 'pid' );


	}

	/**
	 * 递归找子集
	 *
	 * @param $data 所有栏目数据
	 * @param $id   主键id
	 *
	 * @return array 所有的子集id集合（包括自己）
	 */
	public function getSon ( $data , $id )
	{
		static $temp = [];
		foreach ( $data as $k => $v ) {
			if ( $v[ 'pid' ] == $id ) {
				$temp[] = $v[ 'id' ];
				$this->getSon ( $data , $v[ 'id' ] );
			}

			return $temp;
		}

	}

	/**
	 * 获取栏目所有数据并且转为树状结构
	 * 方便在其它的类调用
	 *
	 * @return mixed
	 */
	public function getCateTreeData ()
	{
		$data = Db::table ( 'category' )->get ();

		return Arr::tree ( $data , 'cname' , 'id' , 'pid' );


	}


}