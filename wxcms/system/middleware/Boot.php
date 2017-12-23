<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use system\model\Config;

class Boot implements Middleware{
	//执行中间件
	public function run($next) {
         //echo "中间件执行了";
		//加载系统配置项
		$this->loadSystemConfig();
         $next();
	}



	/**
	 * 全局加载站点配置数据
	 */
	public function loadSystemConfig(){
		//读取系统配置项的数据
		$field = Config::find(1);
		$field = json_decode ($field['system_config'],true);
		//将数据村给v函数中system
		v('system',$field);
	}
}