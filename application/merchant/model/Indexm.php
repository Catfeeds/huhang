<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/26
 * Time: 10:25
 */
namespace app\merchant\model;
use think\Db;
use think\Model;

class Indexm extends Model{
    public function getTypeCase($mt_id){
        $typeData=Db::table('huhang_type')
            ->where(['type_isable' => 1,'type_sort'=> 1])
            ->order('type_order desc')
            ->select();
        foreach($typeData as $k => $v){
            $typeData[$k]['type_case']=Db::table('huhang_case')
                ->where(['case_m_id' => $mt_id,'case_type' =>$v['type_id'],'case_status' => 2,'case_isable' => 1])
                ->order('case_view desc')
                ->limit(5)
                ->field('case_id,case_img,case_img_alt')
                ->select();
        }
        return $typeData ? $typeData : null;
    }



    /*
     * getMerTempViaMtId
     * 根据商户id获取商户模板
     * */
    public function getMerTempViaMtId($mt_id){
        $merTemp=Db::table('huhang_merchant')
            ->join('huhang_templet','huhang_templet.tem_id = huhang_merchant.mt_templet')
            ->where(['mt_id' => $mt_id])
            ->column('tem_url');
//            ->find();
        return $merTemp ? $merTemp : null;
    }




    /*
     *通过商户id获取城市id
     * getCityIdViaMerId
     * */
    public function getCityIdViaMerId($mt_id){
        $cityId=Db::table('huhang_merchant')
            ->where(['mt_id' => $mt_id])
            ->column('mt_c_id');
        return $cityId ? $cityId : null;

    }



    /*
     *
     * 客户预约数据入库
     * */
    public function makePoint($data){
        $point=Db::table('huhang_customer')->insert($data);
        return $point ? $point : 0;
    }


    /*
        * 客户统计
        * */
    public function countCus($where){
        $count=Db::table('huhang_customer')
            ->join('huhang_province','huhang_customer.cus_provid = huhang_province.p_id')
            ->join('huhang_type','huhang_customer.cus_type = huhang_type.type_id')
            ->join('huhang_city','huhang_customer.cus_cityid = huhang_city.c_id')
            ->where($where)
            ->count();
        return $count ? $count : 0;
    }


    /*
     * 客户统计
     * //平台所有的预约总数；
     * */
    public function countAll(){
        $allOrder=Db::table('huhang_customer')->count();
        return $allOrder ? $allOrder :0;
    }


}