<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/20
 * Time: 17:12
 */
namespace app\admin\controller;
use app\admin\model\Activitym;
use app\admin\model\Commons;
use app\admin\model\Setupm;
use think\Controller;
use think\Request;

class Activity extends Controller{
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
        $this->assign('adminUrl',$adminUrl);
        $commonModel=new Commons();
//        $ip=$_SERVER['REMOTE_ADDR'];
        $ip='117.36.76.230';
        $ipInfo=$commonModel->index($ip);
        $this->assign('ipInfo',$ipInfo['data']);
        $this->assign('adminData',$userData);
    }
    public function activity(){

        return $this->fetch();
    }


    public function activityData(){
        $where=[];
        $actModel=new Activitym();
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
     * addNav
     * */
    public function addActivity(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $actModel=new Activitym();
        $setModel=new Setupm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='act_addtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$actModel->countActivity($where);
            //生成用户编号；
            $data['act_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['act_p_id']=intval(trim($_POST['act_p_id']));
            $data['act_c_id']=intval(trim($_POST['act_c_id']));
            $acttime=trim($_POST['act_time']);
            $act=explode('~',$acttime);
            strtotime(trim($act[0])." 16:00:10");
            strtotime(trim($act[0]));
            $data['act_starttime']=strtotime(trim($act[0])." 00:00:00");
            $data['act_endtime']=strtotime(trim($act[1])." 23:59:59");
            $data['act_addtime']=time();
            $data['act_updatetime']=time();
            $data['act_title']=trim($_POST['act_title']);
            $data['act_address']=trim($_POST['act_address']);
            $data['act_img']=trim($_POST['act_img']);
            $data['act_img_alt']=trim($_POST['act_img_alt']);
            $data['act_url']=trim($_POST['act_url']);
            $data['act_content']=trim($_POST['act_content']);
            $data['act_admin']=$admin_id;
            $add=$actModel->addActivity($data);
            if($add){
                $this->success('添加成功','activity/activity');
            }else{
                $this->error('添加失败','activity/activity');
            }
        }else{
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            return $this->fetch();
        }
    }


    public function editActivity(){
        $act_id=intval(trim($_GET['act_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $actModel=new Activitym();
        $setModel=new Setupm();
        if($_POST){
            $data['act_id']=$act_id;
            $data['act_p_id']=intval(trim($_POST['act_p_id']));
            $data['act_c_id']=intval(trim($_POST['act_c_id']));
            $acttime=trim($_POST['act_time']);
            $act=explode('~',$acttime);
            strtotime(trim($act[0])." 16:00:10");
            strtotime(trim($act[0]));
            $data['act_starttime']=strtotime(trim($act[0])." 00:00:00");
            $data['act_endtime']=strtotime(trim($act[1])." 23:59:59");
            $data['act_updatetime']=time();
            $data['act_title']=trim($_POST['act_title']);
            $data['act_address']=trim($_POST['act_address']);
            $data['act_img']=trim($_POST['act_img']);
            $data['act_img_alt']=trim($_POST['act_img_alt']);
            $data['act_url']=trim($_POST['act_url']);
            $data['act_content']=trim($_POST['act_content']);
            $data['act_admin']=$admin_id;
            $edit=$actModel->editActivity($data);
            if($edit){
                $this->success('修改成功','activity');
            }else{
                $this->error('修改失败','activity');
            }
        }else{
            $activity=$actModel->findActivity($act_id);
            $this->assign('activity',$activity);
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            //城市信息
            $p_id=$activity['act_p_id'];
            $where=[
                'c_p_id' => $p_id
            ];
            $city=$setModel->cityData($where,1,50);
            $this->assign('city',$city);
            return $this->fetch();
        }
    }
    /*
     * 删除
     * */
    public function delActivity(){
        $act_id=intval(trim($_GET['act_id']));
        $actModel=new Activitym();
        $del=$actModel->delActivity($act_id);
        if($del){
            $this->success('删除成功','activity');
        }else{
            $this->error('删除失败','activity');
        }
    }



    /*
     * status
     * */
    public function activityTop(){
        $data['act_id']=intval(trim($_GET['act_id']));
        $data['act_istop']=intval(trim($_GET['act_istop']));
        $userData=session('userData');
        $data['act_admin']=$userData['ad_id'];
        if(isset($data['act_id']) && isset($data['act_istop'])){
            $actModel=new Activitym();
            $change=$actModel->editActivity($data);
            if($data['act_istop'] == 1){
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


    /*
     * status
     * */
    public function status(){
        $data['act_id']=intval(trim($_GET['act_id']));
        $data['act_isable']=intval(trim($_GET['act_isable']));
        $userData=session('userData');
        $data['act_admin']=$userData['ad_id'];
        if(isset($data['act_id']) && isset($data['act_isable'])){
            $actModel=new Activitym();
            $change=$actModel->editActivity($data);
            if($data['act_isable'] == 1){
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
     * 图片上传
     * */
    public function upload(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/activity');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/activity/".$path_date."/".$path_filename;
            // 成功上传后 返回上传信息
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            // 上传失败返回错误信息
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }
}