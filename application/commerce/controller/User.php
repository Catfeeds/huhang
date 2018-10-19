<?php
/**
 * Name: 商户端-客户管理-controller
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 10:34
 */
namespace app\commerce\controller;
use app\admin\model\Setupm;
use think\Controller;
use think\Request;

class User extends Controller{
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



    /*
     * 已预约已分配到该商户，商户未接单
     * */
    public function order(){
        //项目类型
        $setModel=new Setupm();
        $where=[
            'type_sort' =>1
            ,'type_isable' =>1
        ];
        $typeData=$setModel->typeData($where,'1','15');
        $this->assign('typeData',$typeData);
        return $this->fetch();
    }

    /*
     * 商户已接单
     * */
    public function ordered(){
        //项目类型
        $setModel=new Setupm();
        $where=[
            'type_sort' =>1
            ,'type_isable' =>1
        ];
        $typeData=$setModel->typeData($where,'1','15');
        $this->assign('typeData',$typeData);
        return $this->fetch();
    }


    /*
     * 未接单客户详情
     * */
    public function orderDetails(){
        return $this->fetch();
    }

    /*
     * 已接单客户详情
     * */
    public function orderedDetail(){
        return $this->fetch();
    }
}