<?php
namespace app\admin\controller;
use app\admin\model\Merchat;
use think\Controller;
use think\Request;

class Merchant extends Controller{
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
    }

    public function welcome(){
        return $this->fetch();
    }


    /*
     * 装修公司
     * */
    public function merchant(){
        return $this->fetch();
    }


    /*
     * 装修公司数据
     * */
    public function merchantData(){
        $where=[];
        $merchantModel=new Merchat();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$merchantModel->merchantData($where,$page,$limit);
        $count=$merchantModel->countMerchant($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }

    /*
     * merStatus
     * */
    public function merStatus(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['mt_id']=intval(trim($_GET['mt_id']));
        $data['mt_status']=intval(trim($_GET['status']));
        $data['mt_admin']=$admin_id;
        if(isset($data['mt_id']) && isset($data['mt_status'])){
            $merchantModel=new Merchat();
            $edit=$merchantModel->eidtMerchant($data);
            if($data['mt_status'] == 1){
                $msg='开启';
            }else{
                $msg='关闭';
            }
            if($edit){
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
     * delMerchant
     * */
    public function delMerchant(){
        $mt_id=intval(trim($_GET['mt_id']));
        $merchantModel=new Merchat();
        $del=$merchantModel->delMerchant($mt_id);
        if($del){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }




    /*
     * 后台开通商户
     * */
    public function addMerchant(){
        $userData=session('userData');
        $merchantModel=new Merchat();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='mt_addtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$merchantModel->countMerchant($where);
            //生成用户编号；
            $data['mt_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['mt_name']=$_POST['mt_name'];
            $data['mt_short_name']=$_POST['mt_short_name'];
            $data['mt_hotline']=$_POST['mt_hotline'];
            $data['mt_address']=$_POST['mt_address'];
            $data['mt_location']=$_POST['mt_location'];
            $data['mt_manger']=$_POST['mt_manger'];
            $data['mt_description']=$_POST['mt_description'];
            $data['mt_logo']=$_POST['mt_logo'].",".$_POST['mt_logos'];
            $data['mt_addtime']=time();
            $data['mt_admin']=$userData['ad_id'];
            $data['mt_recive_area'] =implode(',',array_keys($_POST['mt_recive_area']));
            $data['mt_recive_type'] =implode(',',array_keys($_POST['mt_recive_type']));
            $data['mt_service_type'] =implode(',',array_keys($_POST['mt_service_type']));
            $add=$merchantModel->addMerchant($data);
            if($add){
                $this->success('开通成功！');
            }else{
                $this->error('开通失败！');
            }
        }else{
            //承接面积
            $setModel=new Merchat();
            $space=$setModel->spaceData(['sp_isable' => 1],1,20);
            $this->assign('space',$space);
            //装修类型
            $type=$setModel->typeData(['type_sort' => 1,'type_isable' => 1],1,20);
            $this->assign('typeData',$type);
            //服务类型
            $service=$setModel->serviceType(['st_isable' => 1],1,20);
            $this->assign('service',$service);
            return $this->fetch();
        }
    }



    /*
     * 商户管理员认证
     * */
    public function manger(){
        $mt_id=intval(trim($_GET['mt_id']));
        $merchantModel=new Merchat();
        $manger=$merchantModel->getManagerInfo($mt_id);
        $this->assign('manger',$manger);
        return $this->fetch();
    }

    /*
     * 管理员认证程序
     * */
    public function mangerPro(){
        if($_POST){
            $userData=session('userData');
            $admin_id=$userData['ad_id'];
            $data['mtm_mt_id']=intval(trim($_POST['mtm_mt_id']));
            $data['mtm_is_identy']=intval(trim($_POST['mtm_is_identy']));
            $data['mtm_identy_remarks']=trim($_POST['mtm_identy_remarks']);
            $data['mtm_identy_time']=time();
            $data['mtm_identy_admin']=$admin_id;
            $merchantModel=new Merchat();
            $identy=$merchantModel->identyManger($data);
            if($identy){
                $this->success('审核成功！');
            }else{
                $this->error('审核失败！');
            }
        }
    }



    /*
    * 商户企业认证
    * */
    public function verify(){
        $mt_id=intval(trim($_GET['mt_id']));
        $merchantModel=new Merchat();
        $verify=$merchantModel->getMerchantVerifyInfo($mt_id);
        $this->assign('verify',$verify);
        return $this->fetch();
    }

    /*
     * 管理员认证程序
     * */
    public function merchantPro(){
        if($_POST){
            $userData=session('userData');
            $admin_id=$userData['ad_id'];
            $data['mtv_mt_id']=intval(trim($_POST['mtv_mt_id']));
            $data['mtv_is_aut']=intval(trim($_POST['mtv_is_aut']));
            $data['mtv_aut_remarks']=trim($_POST['mtv_aut_remarks']);
            $data['mtv_aut_time']=time();
            $data['mtv_admin']=$admin_id;
            $merchantModel=new Merchat();
            $identy=$merchantModel->identyMerchant($data);
            if($identy){
                $this->success('审核成功！');
            }else{
                $this->error('审核失败！');
            }
        }
    }

    /*
     * 平台端商家图片上传
     * */
    public function upload(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/commerce');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/commerce/".$path_date."/".$path_filename;
            // 成功上传后 返回上传信息
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            // 上传失败返回错误信息
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }

    /*---装修公司------------------------------------------------------------------------------------------------------------*/
}