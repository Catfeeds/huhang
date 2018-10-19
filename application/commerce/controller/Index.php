<?php
/**
 * Name: 商户端-后台首页-controller
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 9:32
 */
namespace app\commerce\controller;
use app\admin\model\Commons;
use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $userData=session('merInfo');
        if(empty($userData)){
            $this->redirect('login/login');
        }
        $expireTime=session('expiretime');
        if(isset($expireTime)) {
            if($expireTime < time()) {
                session(null);
                $this->error('您的登录身份已过期，请重新登录！','login/login');
            } else {
                session('expiretime',time() + 1800); // 刷新时间戳
            }
        }
    }

    public function index(){
        $merInfo=session('merInfo');
        $this->assign('merInfo',$merInfo);
        $commonModel=new Commons();
        //       $ip=$_SERVER['REMOTE_ADDR'];
        $ip='117.36.76.230';
        $ipInfo=$commonModel->index($ip);
        $this->assign('ipInfo',$ipInfo['data']);
        return $this->fetch();
    }

    public function welcome(){
        return $this->fetch();
    }
}