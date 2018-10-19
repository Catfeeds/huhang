<?php
/**
 * Created by PhpStorm.
 * User: Dang Meng
 * Date: 2018/8/13
 * Time: 15:06
 */
namespace app\commerce\model;
use think\Model;
use think\Db;

class Loginsm extends Model{

    /*
     *$data 登录的数据
     * $password 经过处理的密码
     */
    public function login($data,$password){
        $userData =Db::table('huhang_merchant_admin')
            ->join('huhang_merchant','huhang_merchant.mt_id = huhang_merchant_admin.ma_mt_id')
            ->where(['ma_phone' => $data['username']])
            ->whereOr(['ma_emails' => $data['username']])
            ->field('mt_id,mt_p_id,mt_c_id,mt_name,mt_short_name,mt_manger,ma_pasword')
            ->find();
        if(!$userData){
            return false;
        }
        $PWD = $userData['ma_pasword'];
        if($password == $PWD){
            session('merInfo',$userData);
            session('expiretime',time() + 1800);
            return true;
        }
        return false;
    }
}