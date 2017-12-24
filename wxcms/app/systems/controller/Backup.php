<?php namespace app\systems\controller;

use houdunwang\route\Controller;
use Backup as BackupModel;
/**
 * 数据备份
 * Class Backup
 *
 * @package app\system\controller
 */
class Backup extends Controller{
	public function __construct ()
	{
		//echo 111;die;
		//auth函数我们自定义的函数。放在system/helper.php
		auth ();
	}
	/**
	 * 备份列表
	 * @return mixed
	 */
	public function index(){
		$dirs = BackupModel::getBackupDir('backup');
		return view('',compact ('dirs'));
	}

	/**
	 * 运行备份
	 */
	public function post(){
		$config = [
			'size' => 20,//分卷大小单位KB
			'dir'  => 'backup/' . date( "Ymdhis" ),//备份目录
		];
		$status = BackupModel::backup( $config, function ( $result ) {
			if ( $result['status'] == 'run' ) {
				$message = $result['message'];
				die(view ('message',compact ('message')));
				//备份进行中
				//echo $result['message'];
				//刷新当前页面继续下次
				//echo "<script>setTimeout(function()		{location.href='{$_SERVER['REQUEST_URI']}'},100);</script>";
			} else {
				//备份执行完毕
				//echo $result['message'];
				die(message($result['message'],u('index'),'success'));
			}
		} );
		if($status===false){
			//备份过程出现错误
			die(message(BackupModel::getError(),'back','error'));
			//echo  Backup::getError();
		}
	}

	/**
	 * 还原
	 */
	public function recovery() {
		//要还原的备份目录
		$config=['dir'=>Request::get('path')];
		$status = BackupModel::recovery( $config, function ( $result ) {
			if ( $result['status'] == 'run' ) {
				$message = $result['message'];
				die(view ('message',compact ('message')));
				//备份进行中
				//echo $result['message'];
				//刷新当前页面继续下次
				//echo "<script>setTimeout(function()		{location.href='{$_SERVER['REQUEST_URI']}'},100);</script>";
			} else {
				//备份执行完毕
				//echo $result['message'];
				die(message($result['message'],u('index'),'success'));
			}
		} );
		if($status===false){
			die(message(BackupModel::getError(),'back','error'));
			//还原过程出现错误
			//echo  Backup::getError();
		}
	}

	/**
	 * 删除备份，实际上就是删除对应目录
	 * 使用Dir::del
	 * 参考手册：目录操作(http://doc.hdphp.com/215237#_15)
	 */
	public function del(){
		$path = Request::get('path');
		//p($path);die;
		//dd(is_dir ('backup/20171223085421'));
		if(is_dir ($path)){
			Dir::del($path);
		}else{
			return message('备份不存在','back','error');
		}
		return message('操作成功',u('index'),'success');
	}
}
