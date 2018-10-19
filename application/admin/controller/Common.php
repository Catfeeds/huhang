<?php
namespace app\admin\controller;
use app\admin\model\Adminm;
use app\admin\model\Setinfom;
use app\admin\model\Setupm;
use think\Controller;

class Common extends Controller{
    //公共头部
    public function header(){
        return $this->fetch();
    }




    /*
     * 根据省份id去获取该省份下的城市
     * */
    public function getCityName(){
        $p_id=intval(trim($_GET['p_id']));
        $setupModel=new Setupm();
        $where=[
            'p_id' => $p_id
        ];
        $citys=$setupModel->cityData($where,1,50);
        if($citys){
            return  json(['code' => '1','data' => $citys]);
        }else{
            return  json(['code' => '0','data' => ['']]);
        }
    }


    /*
     * 根据城市id去查找站点id
     * */
    public function getBranchName(){
        $c_id=intval(trim($_GET['c_id']));
        $setInfom=new Setinfom();
        $where=[
            'c_id' => $c_id
        ];
        $branchs=$setInfom->branchData($where,'1','50');
        if($branchs){
            return  json(['code' => '1','data' => $branchs]);
        }else{
            return  json(['code' => '0','data' => ['']]);
        }
    }



    /*
     * 根据站点id去查找商户id
     * */
    public function getMerchantName(){
        $b_id=intval(trim($_GET['b_id']));
        $adminModel=new Adminm();
        $where=[
            'c_id' => $b_id
        ];
        $merchants=$adminModel->merchantData($where,'1','50');
        if($merchants){
            return  json(['code' => '1','data' => $merchants]);
        }else{
            return  json(['code' => '0','data' => ['']]);
        }
    }









}