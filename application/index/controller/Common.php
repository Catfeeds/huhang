<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 11:33
 * Name：平台端-公共部分
 */
namespace app\index\controller;
use app\admin\model\Setupm;
use think\Controller;

class Common extends Controller{
    public function header(){
        return $this->fetch();
    }

    public function footer(){
        return $this->fetch();
    }
    public function friendlink(){
        $city_id=session('city_id');
        //友情链接
        $setupModel=new Setupm();
        $wheref=[
            'fl_isable' =>1
            ,'fl_c_id' =>$city_id
        ];
        $friend=$setupModel->friendData($wheref,1,24);
        $this->assign('friend',$friend);
        return $this->fetch();
    }


    public function serviceStep(){
        return $this->fetch();
    }
}