<?php
/**
 * Name: 商户端-问答管理-controller
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 10:22
 */
namespace app\commerce\controller;
use app\commerce\model\Quest;
use think\Controller;
use think\Db;
use think\Request;

class Question extends Controller{
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


    public function questionData(){
        $merInfo=session('merInfo');
        $where=[
            'qa_m_id' => $merInfo['mt_id']
        ];
        $questModel=new Quest();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$questModel->questionData($where,$page,$limit);
        $count=$questModel->countQuestion($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }


    public function addQuestion(){
        $questModel=new Quest();
        $merInfo=session('merInfo');
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='qa_addtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$questModel->countQuestion($where);
            //生成用户编号；
            $data['qa_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['qa_question']=trim($_POST['qa_question']);
            $data['qa_p_id']=$merInfo['mt_p_id'];
            $data['qa_c_id']=$merInfo['mt_c_id'];
            $data['qa_m_id']=$merInfo['mt_id'];
            $data['qa_addtime']=time();
            $data['qa_status']=1;
            $data['qa_type']=1;
            $data['qa_admin']=$merInfo['mt_id'];
            $add=$questModel->addQuestion($data);
            if($add){
                $this->success('添加成功','question',$_POST);
            }else{
                $this->error('添加失败','question');
            }
        }else{
            return $this->fetch();
        }
    }


    public function editQuestion(){
        $qa_id=intval(trim($_GET['qa_id']));
        $questModel=new Quest();
        $merInfo=session('merInfo');
        if($_POST){
            $data['qa_id']=$qa_id;
            $data['qa_question']=trim($_POST['qa_question']);
            $data['qa_admin']=$merInfo['mt_id'];
            $edit=$questModel->editQuestion($data);
            if($edit){
                $this->success('修改成功','question');
            }else{
                $this->error('修改失败','question');
            }
        }else{
            $wanted=$questModel->findQuestion($qa_id);
            $this->assign('question',$wanted);
            return $this->fetch();
        }
    }


    /*
     * art_id
     * */
    public function delQuestion(){
        $qa_id=intval(trim($_GET['qa_id']));
        $questModel=new Quest();
        $del=$questModel->delQuestion($qa_id);
        if($del){
            $this->success('删除成功','question');
        }else{
            $this->error('删除失败','question');
        }
    }

    /*
     * articleStatus
     * */
    public function questionStatus(){
        $questModel=new Quest();
        $merInfo=session('merInfo');
        $data['qa_admin']=$merInfo['mt_id'];
        $data['qa_id']=intval(trim($_GET['qa_id']));
        $data['qa_isable']=intval(trim($_GET['qa_isable']));
        if(isset($data['qa_id']) && isset($data['qa_isable'])){
            $change=$questModel->editQuestion($data);
            if($data['qa_isable'] == 1){
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
    public function questionTop(){
        $questModel=new Quest();
        $merInfo=session('merInfo');
        $data['qa_admin']=$merInfo['mt_id'];
        $data['qa_id']=intval(trim($_GET['qa_id']));
        $data['qa_istop']=intval(trim($_GET['qa_istop']));
        if(isset($data['qa_id']) && isset($data['qa_istop'])){
            $change=$questModel->editQuestion($data);
            if($data['qa_istop'] == 1){
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
     * 回复列表
     * */
    public function answer(){
        $qa_id=intval(trim($_GET['qa_id']));
        $where=[
            'qaa_question' => $qa_id
        ];
        $questModel=new Quest();
        $question=$questModel->findQuestion($qa_id);
        $this->assign('question',$question);
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $answerData=$questModel->answerData($where,$page,$limit);
        $this->assign('answer',$answerData);
        return $this->fetch();

    }


    public function addAnswer(){
        $questModel=new Quest();
        $merInfo=session('merInfo');
        $qa_id=intval(trim($_GET['qa_id']));
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='qaa_addtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$questModel->countAnswer($where);
            //生成用户编号；
            $data['qaa_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['qaa_answer']=trim($_POST['qaa_answer']);
            $data['qaa_question']=$qa_id;
            $data['qaa_addtime']=time();
            $data['qaa_status']=1;
            $data['qaa_type']=1;
            $data['qaa_admin']=$merInfo['mt_id'];
            $add=$questModel->addAnswer($data);
            if($add){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败','index');
            }
        }else{
            $question=$questModel->findQuestion($qa_id);
            $this->assign('question',$question);
            return $this->fetch();
        }
    }


    public function editAnswer(){
        $questModel=new Quest();
        $merInfo=session('merInfo');
        $qaa_id=intval(trim($_GET['qaa_id']));
        if($_POST){
            $data['qaa_id']=$qaa_id;
            $data['qaa_answer']=trim($_POST['qaa_answer']);
            $data['qaa_status']=1;
            $data['qaa_admin']=$merInfo['mt_id'];
            $edit=$questModel->editAnswer($data);
            if($edit){
                $this->success('修改成功','index');
            }else{
                $this->error('修改失败','index');
            }
        }else{
            $answer=$questModel->findAnswer($qaa_id);
            $question=$questModel->findQuestion($answer['qaa_question']);
            $this->assign('question',$question);
            $this->assign('answer',$answer);
            return $this->fetch();
        }
    }


    /*
     * art_id
     * */
    public function delAnswer(){
        $qaa_id=intval(trim($_GET['qaa_id']));
        $questModel=new Quest();
        $del=$questModel->delAnswer($qaa_id);
        if($del){
            $this->success('删除成功','question');
        }else{
            $this->error('删除失败','question');
        }
    }

    /*
     * articleStatus
     * */
    public function answerStatus(){
        $data['qaa_id']=intval(trim($_POST['qaa_id']));
        $data['qaa_isable']=intval(trim($_POST['change']));
        $merInfo=session('merInfo');
        $data['qaa_admin']=$merInfo['mt_id'];
        if(isset($data['qaa_id']) && isset($data['qaa_id'])){
            $questModel=new Quest();
            $change=$questModel->editAnswer($data);
            if($data['qaa_isable'] == 1){
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
    public function answerTop(){
        $data['qaa_id']=intval(trim($_POST['qaa_id']));
        $data['qaa_istop']=intval(trim($_POST['change']));
        $merInfo=session('merInfo');
        $data['qaa_admin']=$merInfo['mt_id'];
        if(isset($data['qaa_id']) && isset($data['qaa_istop'])){
            $questModel=new Quest();
            $change=$questModel->editAnswer($data);
            if($data['qaa_istop'] == 1){
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