<?php
/**
 * Created by PhpStorm.
 * User: Dang Meng
 * Date: 2018/8/15
 * Time: 15:33
 */
namespace app\admin\controller;
use think\console\command\make\Controller;

class Manager extends Controller{

    /*
     * 分站管理员
     * */
    public function index(){
        return $this->fetch();
    }
}