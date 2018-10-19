<?php
/**
 * Name: 商户端-人才招聘-controller
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 10:48
 */
namespace app\commerce\controller;
use app\commerce\model\Recruitm;
use think\Controller;
use think\Db;
use think\Request;

class Recruit extends Controller{
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
    public function wantedData(){
        $merInfo=session('merInfo');
        $where=[
            'wt_m_id' => $merInfo['mt_id']
        ];
        $recruitModel=new Recruitm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$recruitModel->wantedData($where,$page,$limit);
        $count=$recruitModel->countWanted($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }

    /*
     * addWanted
     * */
    public function addWanted(){
        $merInfo=session('merInfo');
        $recruitModel=new Recruitm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='wt_addtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$recruitModel->countWanted($where);
            //生成用户编号；
            $data['wt_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['wt_name']=trim($_POST['wt_name']);
            $data['wt_salary']=trim($_POST['wt_min']).'-'.trim($_POST['wt_max']);
            $data['wt_num']=trim($_POST['wt_num']);
            $data['wt_deadline']=strtotime($_POST['wt_deadline']);
            $data['wt_duty']=trim($_POST['wt_duty']);
            $data['wt_skills']=trim($_POST['wt_skills']);
            $data['wt_p_id']=$merInfo['mt_p_id'];
            $data['wt_c_id']=$merInfo['mt_c_id'];
            $data['wt_m_id']=$merInfo['mt_id'];
            $data['wt_addtime']=time();
            $data['wt_updatetime']=time();
            $data['wt_status']=1;
            $data['wt_admin']=$merInfo['mt_id'];
            $add=$recruitModel->addWanted($data);
            if($add){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败','index');
            }
        }else{
            return $this->fetch();
        }
    }

    /*
     * editWanted
     * */
    public function editWanted(){
        $wt_id=intval(trim($_GET['wt_id']));
        $merInfo=session('merInfo');
        $recruitModel=new Recruitm();
        if($_POST){
            $data['wt_id']=$wt_id;
            $data['wt_name']=trim($_POST['wt_name']);
            $data['wt_salary']=trim($_POST['wt_min']).'-'.trim($_POST['wt_max']);
            $data['wt_num']=trim($_POST['wt_num']);
            $data['wt_deadline']=strtotime($_POST['wt_deadline']);
            $data['wt_duty']=trim($_POST['wt_duty']);
            $data['wt_skills']=trim($_POST['wt_skills']);
            $data['wt_addtime']=time();
            $data['wt_status']=1;
            $data['wt_admin']=$merInfo['mt_id'];
            $edit=$recruitModel->editWanted($data);
            if($edit){
                $this->success('修改成功','index');
            }else{
                $this->error('修改失败','index');
            }
        }else{
            $wanted=$recruitModel->findWanted($wt_id);
            $salary=$wanted['wt_salary'];
            $wanted['wt_min']=explode('-',$salary)[0];
            $wanted['wt_max']=explode('-',$salary)[1];
            $wanted['wt_deadline']=date('Y-m-d',$wanted['wt_deadline']);
            $this->assign('wanted',$wanted);
            return $this->fetch();
        }
    }


    /*
     * delWanted
     * */
    public function delWanted(){
        $wt_id=intval(trim($_GET['wt_id']));
        $recruitModel=new Recruitm();
        $del=$recruitModel->delWanted($wt_id);
        if($del){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败','index');
        }
    }

    /*
     * wantedStatus
     * */
    public function wantedStatus(){
        $merInfo=session('merInfo');
        $recruitModel=new Recruitm();
        $data['wt_admin']=$merInfo['mt_id'];
        $data['wt_id']=intval(trim($_GET['wt_id']));
        $data['wt_isable']=intval(trim($_GET['wt_isable']));
        if(isset($data['wt_id']) && isset($data['wt_isable'])){
            $change=$recruitModel->editWanted($data);
            if($data['wt_isable'] == 1){
                $msg='显示';
            }else{
                $msg='隐藏';
            }
            if($change){
                $res['code'] = 1;
                $res['msg'] = $msg.'成功！';
            }else{
                $res['code'] = 0;
                $res['msg'] = $msg.'失败！';
            }
        }else{
            $res['code'] = 0;
            $res['msg'] = '这是个意外！';
        }
        return $res;
    }


    /*
     * wantedTop
     * */
    public function wantedTop(){
        $merInfo=session('merInfo');
        $recruitModel=new Recruitm();
        $data['wt_admin']=$merInfo['mt_id'];
        $data['wt_id']=intval(trim($_GET['wt_id']));
        $data['wt_istop']=intval(trim($_GET['wt_istop']));
        if(isset($data['wt_id']) && isset($data['wt_istop'])){
            $change=$recruitModel->editWanted($data);
            if($data['wt_istop'] == 1){
                $msg='置顶';
            }else{
                $msg='取消置顶';
            }
            if($change){
                $res['code'] = 1;
                $res['msg'] = $msg.'成功！';
            }else{
                $res['code'] = 0;
                $res['msg'] = $msg.'失败！';
            }
        }else{
            $res['code'] = 0;
            $res['msg'] = '这是个意外！';
        }
        return $res;
    }

}