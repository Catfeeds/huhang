<?php
/**
 * Name: 商户端-平台活动-controller
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 10:54
 */
namespace app\commerce\controller;
use app\commerce\model\Atc;
use think\Controller;
use think\Db;
use think\Request;

class Activity extends Controller
{
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
        return $this->fetch();
    }


    /*
     * 活动数据读取
     * */
    public function actData(){
        $where=[];
        $actModel=new Atc();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$actModel->activityData($where,$page,$limit);
        $count=$actModel->countActivity($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }

    /*
     * 参与报名
     * */
    public function takePart(){
        $act_id=intval(trim($_GET['act_id']));
        $merInfo=session('merInfo');
        $actModel=new Atc();
        $activity=$actModel->findActivity($act_id,$merInfo['mt_id']);
        $this->assign('activity',$activity);
        return $this->fetch();
    }

    /*
     * signAct
     * */
    public function signAct(){
        $merInfo=session('merInfo');
        $actModel=new Atc();
        if($_POST){
            $data=$_POST;
            $data['sign_m_id']=$merInfo['mt_id'];
            $data['sign_addtime']=time();
            $sign=$actModel->makeSign($data);
            if($sign){
                $this->success('报名成功！');
            }else{
                $this->error('报名成功！');
            }
        }
    }
}