<?php
// +----------------------------------------------------------------------
// | LpCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 http://lipeng.org All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Lipeng <service@lipeng.org>
// +----------------------------------------------------------------------
namespace app\common\controller;
class Base EXTENDS \think\Controller{
	function __construct(){
		parent::__construct();
		$this->_init_var();
		$this->_init_constant();
		$this->_init_cache();
		$this->_init_setting();
	}

	private function _init_setting(){
		$this->view->theme_bg = cookie('theme_bg')?cookie('theme_bg'):2;
	}

	/** 
	* 初始化变量
	* @access private 
	* @param
	* @return  
	*/
	private function _init_var(){
		$this->output = [];
		$this->view->_m = $this->request->module();
		$this->view->_c = $this->request->controller();
		$this->view->_a = $this->request->action();
		$this->GET = input('param.');
		if(isset($this->GET['kw'])){
			$this->kw = addslashes($this->GET['kw']);
		}
	}

	/** 
	* 初始化常量
	* @access private 
	* @param
	* @return  
	*/
	private function _init_constant(){
		define('TIMES',$_SERVER['REQUEST_TIME']);
		define('SYS_KEY',config('sys_key'));
		define('IS_POST',($this->request->method()=='POST')?true:false);
		define('SYS_DOMAIN',$this->request->domain());
	}

	private function _init_cache(){

	}

}