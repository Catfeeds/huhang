<?php
/**
 * Name: 商户端-荣誉资质-controller
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 10:52
 */
namespace app\commerce\controller;
use app\commerce\model\Honorm;
use think\Controller;
use think\Db;
use think\Request;

class Honor extends Controller
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
     * 荣誉资质读取数据
     * */
    public function honorData(){
        $merInfo=session('merInfo');
        $where=[
            'h_m_id' => $merInfo['mt_id']
        ];
        $honorModel=new Honorm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$honorModel->honorData($where,$page,$limit);
        $count=$honorModel->countHonor($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }

    /*
     * addHonor
     * */
    public function addHonor(){
        $merInfo=session('merInfo');
        $honorModel=new Honorm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='h_addtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$honorModel->countHonor($where);
            //生成用户编号；
            $data['h_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['h_name']=trim($_POST['h_name']);
            $data['h_img']=trim($_POST['h_img']);
            $data['h_img_alt']=trim($_POST['h_img_alt']);
            $data['h_remarks']=trim($_POST['h_remarks']);
            $data['h_p_id']=$merInfo['mt_p_id'];
            $data['h_c_id']=$merInfo['mt_c_id'];
            $data['h_m_id']=$merInfo['mt_id'];
            $data['h_addtime']=time();
            $data['h_updatetime']=time();
            $data['h_status']=1;
            $data['h_admin']=$merInfo['mt_id'];
            $add=$honorModel->addHonor($data);
            if($add){
                $this->success('添加成功','honor');
            }else{
                $this->error('添加失败','honor');
            }
        }else{
            return $this->fetch();
        }
    }

    /*
     * editArticle
     * */
    public function editHonor(){
        $merInfo=session('merInfo');
        $h_id=intval(trim($_GET['h_id']));
        $honorModel=new Honorm();
        if($_POST){
            $data['h_id']=$h_id;
            $data['h_name']=trim($_POST['h_name']);
            $data['h_img']=trim($_POST['h_img']);
            $data['h_img_alt']=trim($_POST['h_img_alt']);
            $data['h_remarks']=trim($_POST['h_remarks']);
            $data['h_status']=1;
            $data['h_updatetime']=time();
            $data['h_admin']=$merInfo['mt_id'];
            $edit=$honorModel->editHonor($data);
            if($edit){
                $this->success('修改成功','honor');
            }else{
                $this->error('修改失败','honor');
            }
        }else{
            $honor=$honorModel->findHonor($h_id);
            $this->assign('h_id',$h_id);
            $this->assign('honor',$honor);
            return $this->fetch();
        }
    }


    /*
     * art_id
     * */
    public function delHonor(){
        $h_id=intval(trim($_GET['h_id']));
        $honorModel=new Honorm();
        $del=$honorModel->delHonor($h_id);
        if($del){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败','index');
        }
    }

    /*
     * articleStatus
     * */
    public function honorStatus(){
        $merInfo=session('merInfo');
        $data['h_admin']=$merInfo['mt_id'];
        $data['h_id']=intval(trim($_GET['h_id']));
        $data['h_isable']=intval(trim($_GET['h_isable']));
        if(isset($data['h_id']) && isset($data['h_isable'])){
            $honorModel=new Honorm();
            $change=$honorModel->editHonor($data);
            if($data['h_isable'] == 1){
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
     * articleTop
     * */
    public function honorTop(){
        $merInfo=session('merInfo');
        $data['h_admin']=$merInfo['mt_id'];
        $data['h_id']=intval(trim($_GET['h_id']));
        $data['h_istop']=intval(trim($_GET['h_istop']));
        $honorModel=new Honorm();
        if(isset($data['h_id']) && isset($data['h_istop'])){
            $change=$honorModel->editHonor($data);
            if($data['h_istop'] == 1){
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
     * 商户端荣誉资质图片上传
     * */
    public function upload(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/commerce/honor');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/commerce/honor/".$path_date."/".$path_filename;
            // 成功上传后 返回上传信息
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            // 上传失败返回错误信息
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }



}