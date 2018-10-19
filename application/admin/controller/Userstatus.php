<?php
/**
 * Name: 平台端-基本参数-客户状态-Controller
 * Created by PhpStorm.
 * User: Dang Meng
 * Date: 2018/8/10
 * Time: 11:23
 */
namespace app\admin\controller;
use app\admin\model\Commons;
use app\admin\model\Setupm;
use app\admin\model\Userstatusm;
use think\Controller;
use think\Request;

class Userstatus extends Controller{
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


    /*
     * 客户状态
     * */
    public function index(){
        return $this->fetch();
    }


    /*
     * statusData
     * */
    public function statusData(){
        $where=[];
        $statusModel=new Userstatusm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$statusModel->statusData($where,$page,$limit);
        $count=$statusModel->countStatus($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }

    /*
     * addNav
     * */
    public function addStatus(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $statusModel=new Userstatusm();
        if($_POST){
            $data['us_addtime']=time();
            $data['us_name']=trim($_POST['us_name']);
            $data['us_remarks']=trim($_POST['us_remarks']);
            $data['us_isable']=intval(trim($_POST['us_isable']));
            $data['us_sort']=1;
            $data['us_order']=1;
            $data['us_admin']=$admin_id;
            $add=$statusModel->addStatus($data);
            if($add){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败','index');
            }
        }else{
            return $this->fetch();
        }
    }


    public function editStatus(){
        $us_id=intval(trim($_GET['us_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $statusModel=new Userstatusm();
        if($_POST){
            $data['us_addtime']=time();
            $data['us_name']=trim($_POST['us_name']);
            $data['us_remarks']=trim($_POST['us_remarks']);
            $data['us_isable']=intval(trim($_POST['us_isable']));
            $data['us_sort']=1;
            $data['us_id']=$us_id;
            $data['us_admin']=$admin_id;
            $edit=$statusModel->editStatus($data);
            if($edit){
                $this->success('修改成功','index');
            }else{
                $this->error('修改失败','index');
            }
        }else{
            $status=$statusModel->findStatus($us_id);
            $this->assign('status',$status);
            return $this->fetch();
        }
    }
    /*
     * 删除
     * */
    public function delStatus(){
        $us_id=intval(trim($_GET['us_id']));
        $statusModel=new Userstatusm();
        $del=$statusModel->delStatus($us_id);
        if($del){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败','index');
        }
    }


    /*
     * status
     * */
    public function status(){
        $data['us_id']=intval(trim($_GET['us_id']));
        $data['us_isable']=intval(trim($_GET['us_isable']));
        $userData=session('userData');
        $data['us_admin']=$userData['ad_id'];
        if(isset($data['us_id']) && isset($data['us_isable'])){
            $statusModel=new Userstatusm();
            $change=$statusModel->editStatus($data);
            if($data['us_isable'] == 1){
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
     * 排序
     * */
    public function reOrder(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['us_id']=intval(trim($_POST['us_id']));
        $data['us_order']=intval(trim($_POST['value']));
        $data['us_admin']=$admin_id;
        if(isset($data['us_id']) && isset($data['us_order'])){
            $statusModel=new Userstatusm();
            $reOrder=$statusModel->editStatus($data);
            if($reOrder){
                $this->success('修改排序成功！','index');
            }else{
                $this->success('修改排序失败！','index');
            }
        }
    }


}