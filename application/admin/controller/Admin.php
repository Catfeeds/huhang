<?php
namespace app\admin\controller;
use app\admin\model\Adminm;
use app\admin\model\Commons;
use app\admin\model\Setupm;
use think\Controller;
use think\Request;

class Admin extends Controller{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $userData=session('userData');
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
        $setupModel=new Setupm();
        $platName=$setupModel->findPlatName();
        $this->assign('platName',$platName[0]);
        $userData=session('userData');
        $adminRoleName=$setupModel->getAdminRoleName($userData['ad_role']);
        $this->assign('adminRoleName',$adminRoleName[0]);
        $adminUrl=$setupModel->findPlatUrl();
        $this->assign('adminUrl',$adminUrl[0]);
        $commonModel=new Commons();
//        $ip=$_SERVER['REMOTE_ADDR'];
        $ip='117.36.76.230';
        $ipInfo=$commonModel->index($ip);
        $this->assign('ipInfo',$ipInfo['data']);
        $this->assign('adminData',$userData);
    }

    public function welcome(){
        return $this->fetch();
    }


/*---装修公司------------------------------------------------------------------------------------------------------------*/

    /*
     * 装修公司
     *
     * */
    public function merchant(){
        return $this->fetch();
    }


    /*
     * 分站站长管理员
     * */


}