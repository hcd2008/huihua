<?php
	namespace app\index\controller;
	use app\common\controller\Base;
	use think\Db;
	use think\View;
	use think\Controller;
	use think\Session;

	class Login extends Controller{
		/**
		 * 用户登录界面，验证用户名
		 * @Author   hcd
		 * @DateTime 2017-04-05T22:21:21+0800
		 * @version  [version]
		 * @return   [type]                   [description]
		 */
		public function index(){
			if($this->request->isPost()){
				$param=$this->request->param();
				isset($param['username']) or $this->error('登入失败,登入信息不完整!');
				if(!captcha_check($param['vcode'])){
					$this->error("验证码错误");
				}
				$arr=["state"=>1,"username"=>$param['username']];
				$res=Db::name('user')->where($arr)->find();
				if($res){
					if(empty($res['logmsg'])){
						$wenhouyu='您还没有设置问候语，为了您的安全，请尽快设置！';
					}else{
						$wenhouyu='您的问候语'.$res['logmsg'];
					}
					$this->assign("wenhouyu",$wenhouyu);
					$this->assign("username",$param['username']);
					$this->assign("step",2);
					$this->view->engine->layout(false);
					return $this->view->fetch();
				}else{
					$this->error('用户名不存在,或已被冻结!');
				}
			}else{
				$this->view->engine->layout(false);
				$this->assign("step",1);
				return $this->fetch();
			}
			
		}
		/**
		 * 验证密码
		 * @Author   hcd
		 * @DateTime 2017-04-05T22:45:18+0800
		 * @version  [version]
		 * @return   [type]                   [description]
		 */
		public function doCheckPwd(){
			$param=$this->request->param();
			$param['password']!='' or $this->error("请输入密码");
			$arr=["username"=>$param['username'],"password"=>md5($param['password'])];
			$res=Db::name('user')->where($arr)->find();
			if($res){
				$ip = get_client_ip();
				$data['username'] = $param['username'];
				$data['logip'] = $ip;
				$data['logtime'] = date('Y-m-d H:i:s');
				$data['usertype'] = 0;
				$logkey = rand_string(6, 3, '0123456789');
				Session::set('logkey', $logkey);
				$data['logkey'] = $logkey;
				Db::name('login')->insert($data);
				Session::set('un', $param['username']);
				$this->redirect('index/');
			}else{
				$this->error("登入失败,用户或密码不正确!",'index/login/index');
			}
		}
	}
?>