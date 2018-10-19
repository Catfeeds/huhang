<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/8/3
 * Time: 16:49
 */
namespace app\commerce\model;
use think\Db;
use think\Model;
class Sets extends Model{
	
	/*
	*承接面积
	*/
	public function spaceData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $spaceData=Db::table('huhang_space')
            ->where($where)
            ->limit($per,$limit)
            ->order('sp_order desc')
            ->select();
        return $spaceData ? $spaceData : null;
    }
	
	/*
	*装修类型
	*/
	public function typeData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $typeData=Db::table('huhang_type')
            ->where($where)
            ->limit($per,$limit)
            ->order('type_order desc')
            ->select();
        return $typeData ? $typeData : null;
    }
	
	/*
	*服务类型
	*/
	public function serviceType($where,$page,$limit){
		$per = ($page - 1) * $limit;
        $serviceType=Db::table('huhang_service_type')
            ->where($where)
            ->limit($per,$limit)
            ->order('st_order desc')
            ->select();
        return $serviceType ? $serviceType : null;
	}


	/*
	 * receiveSet
	 * */
	public function receiveSet($data){
	    $mt_id=$data['mt_id'];
	    $update=Db::table('huhang_merchant')
            ->where(['mt_id' => $mt_id])
            ->update($data);
	    return $update ? true : false;
    }


    /*
     * findMerchantSets
     * */
    public function findMerchantSets($mt_id){
        $sets=Db::table('huhang_merchant')
            ->where(['mt_id' => $mt_id])
            ->field('mt_recive_area,mt_recive_type,mt_service_type')
            ->find();
        return $sets ? $sets : null;
    }

    /*
     * getMerchant
     * */
    public function getMerchant($mt_id){
        $merchant=Db::table('huhang_merchant')
            ->where(['mt_id' => $mt_id])
            ->find();
        return $merchant ? $merchant : null;
    }


    /*
     * updateBasicMer
     * */
    public function updateBasicMer($data){
        $update=Db::table('huhang_merchant')
            ->where(['mt_id' => $data['mt_id']])
            ->update($data);
        return $update ? true : false ;
    }


    /*
     * getMerchantVerify
     * */
    public function getMerchantVerify($mt_id){
        $verify=Db::table('huhang_merchant_verify')
            ->where(['mtv_mt_id' => $mt_id])
            ->find();
        return $verify ? $verify : null;
    }



    /*
     * varifyManger
     * */
    public function varifyManger($mt_id){
        $verify=Db::table('huhang_merchant_manager')
            ->where(['mtm_mt_id' => $mt_id])->find();
        return $verify ? $verify : null;
    }


    /*
     * verify
     * */
    public function verify($data){
        $verify=Db::table('huhang_merchant_manager')->insert($data);
        return $verify ? true : false ;
    }


    /*
     * updateManger
     * */
    public function updateManger($data){
        $update=Db::table('huhang_merchant_manager')
            ->where(['mtm_mt_id' => $data['mtm_mt_id']])
            ->update($data);
        return $update ? true : false ;
    }

    /*
     * updateMerchant
     * */
    public function updateMerchant($data){
        $update=Db::table('huhang_merchant_verify')
            ->where(['mtv_mt_id' => $data['mtv_mt_id']])
            ->update($data);
        return $update ? true : false ;
    }

    /*
     * addVerify
     * */
    public function addVerify($data){
        $add=Db::table('huhang_merchant_verify')
            ->insert($data);
        return $add ? true : false ;
    }


}