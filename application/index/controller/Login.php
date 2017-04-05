<?php
	namespace app\index\controller;
	use app\common\controller\Base;
	use think\Db;
	use think\View;

	class Login{
		public function index(){
			$view=new View();
			$view->engine->layout(false);
			return $view->fetch();
		}
	}
?>