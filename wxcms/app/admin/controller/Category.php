<?php namespace app\admin\controller;

use houdunwang\route\Controller;
use \system\model\Category as CategoryModel;

class Category extends Controller
{
	//动作
	public function index ()
	{
		//获取首页数据
		//paginate(num[每页显示数据个数])
		//$field = CategoryModel::paginate ( 2 );
		$data = Db::table('category')->get();
		//p ($data);
		//树状型展示数据
		$field = Arr::tree($data, 'cname', 'id', 'pid');

		return view ( '' , compact ( 'field' ) );
	}

	/**
	 * 添加标签
	 *
	 * @param CategoryModel $category
	 *
	 * @return mixed|string
	 * @throws \Exception
	 */
	public function store ( CategoryModel $category )
	{
		//接收post数据
		if ( Request::isMethod ( 'post' ) ) {
			$res = $category->store ( Request::post() );
			if ( $res[ 'valid' ] ) {
				return message ( $res[ 'msg' ] , u ( 'index' ) , 'success' );

			} else {
				return message ( $res[ 'msg' ] , 'back' , 'success' );
			}
		}
		//获取栏目表中所有数据
		$data = Db::table('category')->get();
		$cateData = Arr::tree($data, 'cname', 'id', 'pid');
		return view ('',compact ('cateData'));
	}

	/**
	 * 编辑标签
	 * @param CategoryModel $category
	 *
	 * @return mixed|string
	 */
	public function edit ( CategoryModel $category )
	{
		//接收编辑数据主键
		//$id=q ('id');
		$id = Request::get ( 'id' );
		//接收post数据
		if ( Request::isMethod ( 'post' ) ) {
			$res = $category->edit ( Request::post () , $id );
			if ( $res[ 'valid' ] ) {
				return message ( $res[ 'msg' ] , u ( 'index' ) , 'success' );
			} else {
				return message ( $res[ 'msg' ] , 'back' , 'error' );
			}
		}
		//把旧数据显示到页面上
		$oldData = CategoryModel::find ( $id );
		//p($oldData);
		//处理所属栏目数据
		$cateData = $category->getCateData($id);
		//p($cateData);
		//return view ('',compact ('oldData'));
		return view ('',compact ('oldData','cateData'));
	}


	/**
	 * 删除数据
	 * @return mixed|string
	 */
	public function del(){
		//接受删除数据主键id
		$id = Request::get('id');//1
		//p($id);die;
		//判断如果删除的该数据有子集，不允许删除
		$sonData = CategoryModel::where('pid',$id)->first();
		if($sonData){
			//不允许删除
			return message ('有子集数据不允许删除','back','error');
		}
		//删除
		CategoryModel::delete($id);
		return message ('操作成功',u('index'),'success');
	}

}
