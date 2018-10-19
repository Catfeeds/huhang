<?php
/**
 * Name: 商户端-基础信息-controller
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 10:37
 */
namespace app\commerce\controller;
use app\commerce\model\Comm;
use app\commerce\model\Examp;
use app\commerce\model\Sets;
use think\Controller;
use think\Db;
use think\Request;

class Basic extends Controller{
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
        //项目类型
        $caseModel=new Examp();
        $type=$caseModel->typeData(['type_sort' => 1,'type_isable' => 1],1,20);
        $this->assign('typeData',$type);
        $merInfo=session('merInfo');
        $setModel=new Sets();
        $merchant=$setModel->getMerchant($merInfo['mt_id']);
        if($_POST){
            $data['mt_name']=$_POST['mt_name'];
            $data['mt_short_name']=$_POST['mt_short_name'];
            $data['mt_hotline']=$_POST['mt_hotline'];
            $data['mt_address']=$_POST['mt_address'];
            $data['mt_location']=$_POST['mt_location'];
            $data['mt_wechat']=$_POST['mt_wechat'];
            $data['mt_email']=$_POST['mt_email'];
            $data['mt_manger']=$_POST['mt_manger'];
            $data['mt_description']=$_POST['mt_description'];
            $data['mt_logo']=$_POST['mt_logo'].",".$_POST['mt_logos'];
            $data['mt_id']=$merInfo['mt_id'];
            $data['mt_addtime']=time();
            $update=$setModel->updateBasicMer($data);
            if($update){
                $this->success('更新成功！');
            }else{
                $this->error('更新失败！');
            }
        }
        $merchant['mt_logoa']=explode(',',$merchant['mt_logo'])[0];
        $merchant['mt_logos']=explode(',',$merchant['mt_logo'])[1];
        $this->assign('merchant',$merchant);
        return $this->fetch();
    }
	
	
	/*
	 * 接单设置
	 */
	public function reciveSet(){
        $merInfo=session('merInfo');
        $setModel=new Sets();
	    if($_POST){
            $data['mt_recive_area'] =implode(',',array_keys($_POST['mt_recive_area']));
            $data['mt_recive_type'] =implode(',',array_keys($_POST['mt_recive_type']));
            $data['mt_service_type'] =implode(',',array_keys($_POST['mt_service_type']));
            $data['mt_id']=$merInfo['mt_id'];
            $receiveSet=$setModel->receiveSet($data);
            if($receiveSet){
                $this->success('设置成功！');
            }else{
                $this->error('设置失败！');
            }
        }else{
            //承接面积
            $setModel=new Sets();
            $space=$setModel->spaceData(['sp_isable' => 1],1,20);
            $this->assign('space',$space);
            //装修类型
            $type=$setModel->typeData(['type_sort' => 1,'type_isable' => 1],1,20);
            $this->assign('typeData',$type);
            //服务类型
            $service=$setModel->serviceType(['st_isable' => 1],1,20);
            $this->assign('service',$service);
            $setInfo=$setModel->findMerchantSets($merInfo['mt_id']);
            //面积
            $area_list = "";
            if($setInfo['mt_recive_area']){
                $area_list = explode(',',trim($setInfo['mt_recive_area'],','));
            }
            $this->assign('area_list',$area_list);
            //装修类型
            $type_list = "";
            if($setInfo['mt_recive_type']){
                $type_list = explode(',',trim($setInfo['mt_recive_type'],','));
            }
            $this->assign('type_list',$type_list);
            //服务
            $service_list = "";
            if($setInfo['mt_service_type']){
                $service_list = explode(',',trim($setInfo['mt_service_type'],','));
            }
            $this->assign('service_list',$service_list);
            return $this->fetch();
        }
	}
	
	
	/*
	*管理员认证
	*/
	public function mangerIdenty(){
        $merInfo=session('merInfo');
        $setModel=new Sets();
        $verifyInfo=$setModel->varifyManger($merInfo['mt_id']);
        if($_POST){
            if($verifyInfo){
                //更新信息
                $data=$_POST;
                $data['mtm_adddtime']=time();
                $data['mtm_is_identy']=1;
                $data['mtm_mt_id']=$merInfo['mt_id'];
                $update=$setModel->updateManger($data);
                if($update){
                    $this->success('更新成功！');
                }else{
                    $this->error('更新失败！');
                }
            }else{
                $data=$_POST;
                $data['mtm_adddtime']=time();
                $data['mtm_mt_id']=$merInfo['mt_id'];
                $data['mtm_is_identy']=1;
                $verify=$setModel->verify($data);
                if($verify){
                    $this->success('更新成功！');
                }else{
                    $this->error('更新失败！');
                }
            }
        }else{
            $this->assign('verify',$verifyInfo);
        }
		return $this->fetch();
	}
	
	
	
	/*
	* 商户认证
	*/
	public function merchantIdenty(){
        $merInfo=session('merInfo');
        $setModel=new Sets();
        $verifyInfo=$setModel->getMerchantVerify($merInfo['mt_id']);
        if($_POST){
            if($verifyInfo){
                //更新信息
                $data=$_POST;
                $data['mtv_addtime']=time();
                $data['mtv_is_aut']=1;
                $data['mtv_mt_id']=$merInfo['mt_id'];
                $update=$setModel->updateMerchant($data);
                if($update){
                    $this->success('更新成功！');
                }else{
                    $this->error('更新失败！');
                }
            }else{
                $data=$_POST;
                $data['mtv_addtime']=time();
                $data['mtv_is_aut']=1;
                $data['mtv_mt_id']=$merInfo['mt_id'];
                $verify=$setModel->addVerify($data);
                if($verify){
                    $this->success('更新成功！');
                }else{
                    $this->error('更新失败！');
                }
            }
        }else{
            $this->assign('verify',$verifyInfo);
        }
        return $this->fetch();
	}
	
	
	
	/*
	*站点模板
	*/
	public function template(){
		return $this->fetch();
	}


	/*
	 * upload
	 * */
	public function upload(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/superior');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/superior/".$path_date."/".$path_filename;
            // 成功上传后 返回上传信息
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            // 上传失败返回错误信息
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }



    /*
     * security
     * */
    public function security(){
        $merInfo=session('merInfo');
        $mt_id=$merInfo['mt_id'];
        //根据商户id去获取登录信息
        $commModel=new Comm();
        $security=$commModel->getSecurityViaMtId($mt_id);
        $this->assign('security',$security);
        return $this->fetch();
    }


    /*
     * resetPwd
     * */
    public function resetPwd(){
        $merInfo=session('merInfo');
        $mt_id=$merInfo['mt_id'];
        if($_POST){
            $oldPwd=md5($_POST['oldPwd']);
            $newPwd=md5($_POST['newPwd']);
            $newPwd1=md5($_POST['newPwd2']);
            $adminInfo=Db::table('huhang_merchant_admin')->where(['ma_mt_id' => $mt_id])->field('ma_pasword')->find();
            $adPwd=$adminInfo['ma_pasword'];
            if($adPwd != $oldPwd){
                $this->error('您输入的密码与原始密码不一致，请重新输入！');
            }else{
                if($newPwd != $newPwd1){
                    $this->error('您两次输入的新密码不一致，请重新输入！');
                }else{
                    if($adPwd == $newPwd){
                        $this->error('输入的新密码请勿与原密码相同！');
                    }else{
                        $data['ma_phone']=trim($_POST['ma_phone']);
                        $data['ma_emails']=trim($_POST['ma_emails']);
                        $data['ma_pasword']=$newPwd;
                        $resetPwd=Db::table('huhang_merchant_admin')->where(['ma_mt_id' => $mt_id])->update($data);
                        if($resetPwd){
                            session('merInfo',null);
                            $this->success('修改密码成功，请重新登录！','login/login');
                        }else{
                            $this->error('修改密码失败','index');
                        }
                    }
                }
            }
        }
    }
}