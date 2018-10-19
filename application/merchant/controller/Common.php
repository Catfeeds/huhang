<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 15:12
 * Name: 商家端-公共部分
 */
namespace app\merchant\controller;
use think\Controller;

class Common extends Controller{

    /*
     * 公共头部
     * */
    public function header(){
        return $this->fetch();
    }





    /*
    * 公共banner
    * */
    public function banner(){
        return $this->fetch();
    }


    /*
     * 公共底部
     * */
    public function footer(){
        return $this->fetch();
    }



    /*
     * 公共页脚
     * */
    public function bottom(){
        return $this->fetch();
    }





    /*
     * 友情链接
     * */
    public function friendlink(){
        return $this->fetch();
    }



    /*
     * 服务流程
     * */
    public function servicestep(){
        return $this->fetch();
    }





}