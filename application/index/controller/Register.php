<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/21
 * Time: 13:37
 */
namespace app\index\controller;
use app\admin\model\Setupm;
use app\index\model\Registers;
use think\Controller;
use app\index\model\Commo;
use think\Request;

class Register extends Controller{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $setupModel=new Setupm();
        $weChat=$setupModel->findPlatWechat();
        $this->assign('weChat',$weChat[0]);
        $hotLine=$setupModel->findPlatHotLine();
        $this->assign('hotLine',$hotLine[0]);
        $weiBo=$setupModel->findWeiBo();
        $this->assign('weiBo',$weiBo[0]);
        $address=$setupModel->findPlatAddress();
        $this->assign('address',$address[0]);
        $record=$setupModel->findPlatRecord();
        $this->assign('record',$record[0]);
        $company=$setupModel->findPlatCompany();
        $this->assign('company',$company[0]);
        //平台，名称
        $paltName=$setupModel->findPlatName();
        $this->assign('paltName',$paltName);
        //导航
        $comModel=new Commo();
        $navInfo=$comModel->merNav();
        $this->assign('navInfo',$navInfo);
    }

    public function register(){
        $registerModel=new Registers();
        if($_POST){
            //公司名称是否已被注册，
            $merName=trim($_POST['mt_name']);
            $nameIsRepeat=$registerModel->nameIsRepeat($merName);
            if($nameIsRepeat){
                $this->error('该公司已在该平台注册！');
            }
            //账号是否已被注册
            $account=trim($_POST['mt_email']);
            $accountIsRepeat=$registerModel->accountIsRepeat($account);
            if($accountIsRepeat){
                $this->error('该账号已在本平台注册！');
            }
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='mt_addtime > '.$stime.' and mt_addtime < '.$etime;
            //获取当日预约的数量
            $res['mtm_manager']=trim($_POST['mt_manger']);
            $addManger=$registerModel->addManger($res);
            $merNum=$registerModel->countMer($where);
            $data=$_POST;
            //生成用户编号；
            $data['mt_bid'] = date('Ymd').sprintf("%04d", $merNum+1);
            $data['mt_password']=md5($_POST['mt_password']);
            $data['mt_addtime']=time();
            $data['mt_rank']=1;
            $data['mt_status']=1;
            $data['mt_manger']=$addManger;
            $register=$registerModel->register($data);
            if($register){
                $this->success('注册成功!','register',$register);
            }else{
                $this->error('注册失败!','register');
            }
        }
        $setModel=new Setupm();
        //省份
        $wherep=[];
        $province=$setModel->provinceData($wherep,'1','50');
        $this->assign('prov',$province);

        return $this->fetch();
    }

    public function login(){
        if($_POST){
            $mt_account=trim($_POST['mt_account']);
            $mt_password=md5(trim($_POST['mt_password']));
            //第一步检测账号的存在性
            $registerModel=new Registers();
            $isRegister=$registerModel->accountIsRepeat($mt_account);
            if($isRegister){
                //第二步检查密码是否正确
                $login=$registerModel->checkPwd($mt_account,$mt_password);
                if($login){
                    session('merchantData',$login);
                    $this->success('登录成功！','',$login);
                }else{
                    $this->error('密码或账号错误！');
                }
            }else{
                $this->error('该账户不存在！');
            }
        }else{
            return $this->fetch();
        }
    }
}