<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Loginm extends Model{

    /*
     *$data 登录的数据
     * $password 经过处理的密码
     */
    public function login($data,$password){
        $userData =Db::table('huhang_admin')
            ->where(['ad_email' => $data['username'],'ad_isable' => '1'])
            ->whereOr(['ad_phone' => $data['username'],'ad_isable' => '1'])
            ->find();
        if(!$userData){
            return false;
        }
        $PWD = $userData['ad_password'];
        if($password == $PWD){
            session('userData',$userData);
            session('expiretime',time() + 1800);
            return true;
        }
        return false;
    }
}