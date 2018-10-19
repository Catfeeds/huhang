<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/28
 * Time: 16:43
 */
namespace app\index\model;
use think\Db;
use think\Model;

class Registers extends Model {

    /*
     * 商户注册
     * */
    public function register($data){
        $register=Db::table('huhang_merchant')->insert($data);
        return $register ? $register : null;
    }

    /*
     * 当天入住的商户的统计
     * */
    public function countMer($where){
        $register=Db::table('huhang_merchant')
            ->where($where)
            ->count();
        return $register ? $register : null;
    }

    /*
     * 检测该公司是否已在本平台注册
     * */
    public function nameIsRepeat($merName){
        $isRepeat=Db::table('huhang_merchant')
            ->where(['mt_name' =>$merName])
            ->find();
        return $isRepeat ? true : false;
    }


    /*
     * 检测该账号是否已在本平台注册
     * */
    public function accountIsRepeat($account){
        $isRepeat=Db::table('huhang_merchant')
            ->where(['mt_email' =>$account])
            ->whereOr(['mt_phone' =>$account])
            ->find();
        return $isRepeat ? true : false;
    }

    /*
     * 商户检测密码进行登录
     * */
    public function checkPwd($mt_account,$mt_password){
        $login=Db::table('huhang_merchant')
            ->where(['mt_email' => $mt_account,'mt_password' => $mt_password])
            ->whereOr(['mt_phone' =>$mt_account,'mt_password' => $mt_password])
            ->find();
        return $login ? $login : null;
    }

    /*
     * addManger
     * */
    public function addManger($data){
        $add=Db::table('huhang_merchant_manager')->insert($data);
        $userId = Db::name('huhang_merchant_manager')->getLastInsID();
        if($add && $userId){
            return $userId;
        }else{
            return null;
        }
    }

}