<?php
/**
 * Name: 商户端-项目案例-controller
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 10:39
 */
namespace app\commerce\controller;
use app\commerce\model\Examp;
use think\Controller;
use think\Db;
use think\Request;

class Example extends Controller{
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
     * 案例列表
     * */
    public function index(){
        return $this->fetch();
    }



    public function exampleData(){
        $caseModel=new Examp();
        $merInfo=session('merInfo');
        $where=[
            'case_m_id' => $merInfo['mt_id']
        ];
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$caseModel->exampleData($where,$page,$limit);
        $count=$caseModel->countExample($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }


    public function addExample(){
        $caseModel=new Examp();
        $merInfo=session('merInfo');
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='case_decotime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$caseModel->countExample($where);
            //生成用户编号；
            $data['case_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['case_title']=trim($_POST['case_title']);
            $data['case_type']=intval(trim($_POST['case_type']));
            $data['case_url']=trim($_POST['case_url']);
            $data['case_img'] = implode(',',$_POST['case_img']);
            $data['case_img_alt'] = implode(',',$_POST['case_img_alt']);
            $data['case_remarks']=trim($_POST['case_remarks']);
            $data['case_p_id']=$merInfo['mt_p_id'];
            $data['case_c_id']=$merInfo['mt_c_id'];
            $data['case_m_id']=$merInfo['mt_id'];
            $data['case_seo_keywords']=$_POST['case_seo_keywords'];
            $data['case_price']=intval($_POST['case_price']);
            $data['case_area']=$_POST['case_area'];
            $data['case_decotime']=time();
            $data['case_status']=1;
            $data['case_isable']=1;
            $data['case_istop']=2;
            $data['case_updatetime']=time();
            $data['case_admin'] =$merInfo['mt_id'];
            $add=$caseModel->addExample($data);
            if($add){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败','index');
            }
        }else{
            //项目类型
            $type=$caseModel->typeData(['type_sort' => 1,'type_isable' => 1],1,20);
            $this->assign('typeData',$type);
            return $this->fetch();
        }
    }

    /*
     * editArticle
     * */
    public function editExample(){
        $case_id=intval(trim($_GET['case_id']));
        $caseModel=new Examp();
        if($_POST){
            $data['case_id']=$case_id;
            $data['case_title']=trim($_POST['case_title']);
            $data['case_type']=intval(trim($_POST['case_type']));
            $data['case_url']=trim($_POST['case_url']);
            $data['case_img'] = implode(',',$_POST['case_img']);
            $data['case_img_alt'] = implode(',',$_POST['case_img_alt']);
            $data['case_remarks']=trim($_POST['case_remarks']);
            $data['case_seo_keywords']=$_POST['case_seo_keywords'];
            $data['case_price']=intval($_POST['case_price']);
            $data['case_area']=$_POST['case_area'];
            $data['case_status']=1;
            $data['case_updatetime']=time();
            $edit=$caseModel->editExample($data);
            if($edit){
                $this->success('修改成功','index');
            }else{
                $this->error('修改失败','index');
            }
        }else{
            $case=$caseModel->findExample($case_id);
            $this->assign('case',$case);
            //项目类型
            $type=$caseModel->typeData(['type_sort' => 1,'type_isable' => 1],1,20);
            $this->assign('typeData',$type);
            return $this->fetch();
        }
    }


    /*
     * delExample
     * */
    public function delExample(){
        $case_id=intval(trim($_GET['case_id']));
        $caseModel=new Examp();
        $del=$caseModel->delExample($case_id);
        if($del){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败','index');
        }
    }

    /*
     *
     * refreshExample
     * */
    public function refreshExample(){
        $caseModel=new Examp();
        $data['case_id']=intval(trim($_GET['case_id']));
        $data['case_updatetime']=time();
        $update=$caseModel->editExample($data);
        $inc=$caseModel->exampleInc($data['case_id']);
        if($update && $inc){
            $this->success('刷新成功','index');
        }else{
            $this->error('刷新失败','index');
        }

    }


    /*
     * exampleStatus
     * */
    public function exampleStatus(){
        $caseModel=new Examp();
        $merInfo=session('merInfo');
        $data['case_admin']=$merInfo['mt_id'];
        $data['case_id']=intval(trim($_GET['case_id']));
        $data['case_isable']=intval(trim($_GET['case_isable']));
        if(isset($data['case_id']) && isset($data['case_isable'])){
            $change=$caseModel->editExample($data);
            if($data['case_isable'] == 1){
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
     * exampleTop
     * */
    public function exampleTop(){
        $caseModel=new Examp();
        $merInfo=session('merInfo');
        $data['case_admin']=$merInfo['mt_id'];
        $data['case_id']=intval(trim($_GET['case_id']));
        $data['case_istop']=intval(trim($_GET['case_istop']));
        if(isset($data['case_istop']) && isset($data['case_id'])){
            $change=$caseModel->editExample($data);
            if($data['case_istop'] == 1){
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
     * 案例图片上传
     * */
    public function uploads(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/commerce/case');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/commerce/case/".$path_date."/".$path_filename;
            // 成功上传后 返回上传信息
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            // 上传失败返回错误信息
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }
}