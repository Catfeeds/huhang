<?php
namespace app\admin\controller;
use app\admin\model\Commons;
use app\admin\model\Setupm;
use app\admin\model\Userm;
use think\Controller;
use think\Request;

class User extends Controller{
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






    public function articleList(){
        $a_model = new Articlem();
        $u_model = new User();
        $params = input();
        $where = [];
        $page = $params['page'] = 1;
        $limit = $params['limit'] = 1;
        $articleData = $a_model->articleData($where,$page,$limit);
        if($articleData){
            foreach ($articleData as $key => $val){
                $userData = $u_model->userData($val['uid']);
                $articleData[$key]['username'] = $userData ? $userData["nickname"] : "";
            }
        }
        $count = $a_model->articleCount();
        $this->assign('data',$articleData);
        $this->assign('page',$page);
        $this->assign("limit",$limit);
        $this->assign('count',$count);
        return $this->fetch();
    }











    public function order(){
        $where=[];
        $userModel=new Userm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $cusInfo = $userModel->cusData($where,$page,$limit);
        $count=$userModel->cusCount($where);
        foreach ($cusInfo as $k => $v){
            $cusInfo[$k]['cus_link'] =mb_strlen($v['cus_link'])>30?mb_substr($v['cus_link'],0,30).'...':$v['cus_link'];
        }
        $this->assign('cusInfo',$cusInfo);
        $this->assign('page',$page);
        $this->assign('limit',$limit);
        $this->assign('count',$count);
        return $this->fetch();
    }

    public function orderData(){

    }

    public function back(){
        return $this->fetch();
    }




    public function wait(){
        return $this->fetch();
    }



    public function unconfirm(){
        return $this->fetch();
    }



    public function signed(){
        return $this->fetch();
    }



    public function invalid(){
        return $this->fetch();
    }



    public function query(){
        return $this->fetch();
    }


    public function join(){
        return $this->fetch();
    }

    public function channel(){
        return $this->fetch();
    }

}