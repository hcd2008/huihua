<?php
namespace app\index\controller;
use app\common\controller\Base;
use think\Db;

class Index extends Base
{
    public function index()
    {
    	$this->view->engine->layout(false); 
        return $this->fetch();
    }
}
