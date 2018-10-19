<?php
/**
 * Name: 商户端-设计团队-controller
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 10:45
 */
namespace app\commerce\controller;
use app\commerce\model\Design;
use app\commerce\model\Examp;
use think\Controller;
use think\Db;
use think\Request;

class Designer extends Controller{
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
     * 商户广告数据
     * */
    public function designerData(){
        $designerModel=new Design();
        $merInfo=session('merInfo');
        $where=[
            'des_m_id' =>$merInfo['mt_id']
        ];
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$designerModel->designerData($where,$page,$limit);
        $count=$designerModel->countDesigner($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }

    /*
     * addBanner
     * */

    public function addDesigner(){
        $designerModel=new Design();
        $merInfo=session('merInfo');
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='des_createtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$designerModel->countDesigner($where);
            //生成用户编号；
            $data['des_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['des_createtime']=time();
            $data['des_updatetime']=time();
            $data['des_status']=1;
            $data['des_name']=trim($_POST['des_name']);
            $data['des_avatar']=trim($_POST['des_avatar']);
            $data['des_img_alt']=trim($_POST['des_img_alt']);
            $data['des_tanlent'] =implode(',',array_keys($_POST['des_tanlent']));
            $data['des_guand'] = trim($_POST['des_guand']);
            $data['des_age'] = intval(trim($_POST['des_age']));
            $data['des_phone'] = $_POST['des_phone'];
            $data['des_remarks'] = $_POST['des_remarks'];
            $data['des_seo_keywords'] = $_POST['des_seo_keywords'];
            $data['des_email'] = $_POST['des_email'];
            $data['des_exp'] = $_POST['des_exp'];
            $data['des_img']=trim($_POST['des_img']);
            $data['des_p_id']=$merInfo['mt_p_id'];
            $data['des_c_id']=$merInfo['mt_c_id'];
            $data['des_m_id']=$merInfo['mt_id'];
            $add=$designerModel->addDesigner($data);
            if($add){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败','index');
            }
        }else{
            //项目类型
            $caseModel=new Examp();
            $type=$caseModel->typeData(['type_sort' => 1,'type_isable' => 1],1,20);
            $this->assign('typeData',$type);
            return $this->fetch();
        }
    }


    public function editDesigner(){
        $designerModel=new Design();
        $des_id=intval(trim($_GET['des_id']));
        if($_POST){
            $data['des_id']=$des_id;
            $data['des_updatetime']=time();
            $data['des_status']=1;
            $data['des_name']=trim($_POST['des_name']);
            $data['des_avatar']=trim($_POST['des_avatar']);
            $data['des_img_alt']=trim($_POST['des_img_alt']);
            $data['des_tanlent'] =implode(',',array_keys($_POST['des_tanlent']));
            $data['des_guand'] = trim($_POST['des_guand']);
            $data['des_age'] = intval(trim($_POST['des_age']));
            $data['des_remarks'] = $_POST['des_remarks'];
            $data['des_seo_keywords'] = $_POST['des_seo_keywords'];
            $data['des_phone'] = $_POST['des_phone'];
            $data['des_email'] = $_POST['des_email'];
            $data['des_exp'] = $_POST['des_exp'];
            $data['des_img']=trim($_POST['des_img']);
            $edit=$designerModel->editDesigner($data);
            if($edit){
                $this->success('修改成功','index');
            }else{
                $this->error('修改失败','index');
            }
        }else{
             //项目类型
            $caseModel=new Examp();
            $type=$caseModel->typeData(['type_sort' => 1,'type_isable' => 1],1,20);
            $this->assign('typeData',$type);
            $designer=$designerModel->findDesigner($des_id);
            $type_list = "";
            if($designer['des_tanlent']){
                $type_list = explode(',',trim($designer['des_tanlent'],','));
            }
            $this->assign('type_list',$type_list);
            $this->assign('design',$designer);
            return $this->fetch();
        }
    }
    /*
     * delBanner
     * */
    public function delDesigner(){
        $des_id=intval(trim($_GET['des_id']));
        $designerModel=new Design();
        $del=$designerModel->delDesigner($des_id);
        if($del){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败','index');
        }
    }


    public function refreshDesigner(){
        $designerModel=new Design();
        $data['des_id']=intval(trim($_GET['des_id']));
        $data['des_updatetime']=time();
        $update=$designerModel->editDesigner($data);
        $inc=$designerModel->designerInc($data['des_id']);
        if($update && $inc){
            $this->success('刷新成功','index');
        }else{
            $this->error('刷新失败','index');
        }

    }




    /*
     * articleStatus
     * */
    public function designerStatus(){
        $designerModel=new Design();
        $data['des_id']=intval(trim($_GET['des_id']));
        $data['des_isable']=intval(trim($_GET['des_isable']));
        if(isset($data['des_id']) && isset($data['des_isable'])){
            $change=$designerModel->editDesigner($data);
            if($data['des_isable'] == 1){
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
    * 商户端设计师图片上传
    * */
    public function upload(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/commerce/designer');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/commerce/designer/".$path_date."/".$path_filename;
            // 成功上传后 返回上传信息
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            // 上传失败返回错误信息
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }

}