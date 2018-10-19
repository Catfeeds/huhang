<?php
namespace app\admin\controller;
use app\admin\model\Loginm;
use think\Controller;
use think\Request;

class Login extends Controller{

    public function login(){

        if(Request::instance()->isPost()){
            $data=Request::instance()->post();
            $login_model=new Loginm();
            $password=md5($data['password']);
            $loginRes = $login_model->login($data,$password);
            return $loginRes ? json(['code' => 1,'msg' => '登录成功']) :
                json(['code' => -1,'msg' => "登录失败"]);
        }
        $userData = session('userData');
        session('expiretime',time() + 10);
        if(!empty($userData)){
            $this->redirect('index/index');
        }
        return $this->fetch();
    }

    public function loginOut(){
        session(null);
        $this->success('欢迎再来','login', 3);
    }
}