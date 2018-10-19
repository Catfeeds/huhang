<?php
/**
 * Created by PhpStorm.
 * User: Dang Meng
 * Date: 2018/8/9
 * Time: 13:42
 */
namespace app\admin\model;
use think\Db;
use think\Model;

class Merchat extends Model
{
    /*---装修公司------------------------------------------------------------------------------------------------------------*/

    /*
     * 装修公司数据
     * */
    public function merchantData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $merchant=Db::table('huhang_merchant')
//            ->join('huhang_admin','huhang_merchant.mt_admin = huhang_admin.ad_id')
//            ->join('huhang_service_type','huhang_merchant.mt_services = huhang_service_type.st_id')
            ->join('huhang_province','huhang_merchant.mt_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_merchant.mt_c_id = huhang_city.c_id')
//            ->join('huhang_branch','huhang_merchant.mt_b_id = huhang_branch.b_id')
//            ->join('huhang_templet','huhang_merchant.mt_templet = huhang_templet.tem_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('mt_addtime desc')
            ->field('huhang_merchant.*,huhang_province.p_name,huhang_city.c_name')
            ->select();
        foreach($merchant as $k => $v){
            $merchant[$k]['p_name']=$v['p_name'].'-'.$v['c_name'];
            $merchant[$k]['mt_addtime']=date('Y-m-d H:i:s',$v['mt_addtime']);
            $merchant[$k]['mt_updatetime']=date('Y-m-d',$v['mt_updatetime']);
            $merchant[$k]['ad_realname']=$v['mt_admin'] ? Db::table('huhang_admin')->where(['ad_id' => $v['mt_admin']])->column('ad_realname'): '---';
            $merchant[$k]['tem_name']=$v['mt_templet'] ? Db::table('huhang_templet')->where(['tem_id' => $v['mt_templet']])->column('tem_name'): '---';
            $mt_rank=$v['mt_rank'];
            $typeName='';
            switch($mt_rank){
                case  1;
                    $typeName = '未认证';
                    break;
                case 2;
                    $typeName = '已认证';
                    break;
                case  3;
                    $typeName = '专业版';
                    break;
                case  4;
                    $typeName = '旗舰版';
                    break;
            }
            $merchant[$k]['mt_rank'] = $typeName;
        }
        return $merchant ? $merchant : null;
    }

    /*
     * 数据统计
     * */
    public function countMerchant($where){
        $count=Db::table('huhang_merchant')
            ->where($where)
            ->count();
        return $count ? $count : 0;
    }



    /*
     * eidtMerchant
     * */
    public function eidtMerchant($data){
        $mt_id=$data['mt_id'];
        $update=Db::table('huhang_merchant')->where(['mt_id' => $mt_id])->update($data);
        return $update ? true : false ;
    }


    /*
     * delMerchant
     * */
    public function delMerchant($mt_id){
        $del=Db::table('huhang_merchant')->delete($mt_id);
        return $del ? true : false ;
    }




    /*
     * getManagerInfo
     * */
    public function getManagerInfo($mt_id){
        $manager=Db::table('huhang_merchant_manager')
            ->where(['mtm_mt_id' => $mt_id])
            ->find();
        return $manager ? $manager : null;
    }


    /*
     * identyManger
     * */
    public function identyManger($data){
        $identy=Db::table('huhang_merchant_manager')
            ->where(['mtm_mt_id' => $data['mtm_mt_id']])
            ->update($data);
        return $identy ? true : false ;
    }


    /*
     * getMerchantVerifyInfo
     * */
    public function getMerchantVerifyInfo($mt_id){
        $verify=Db::table('huhang_merchant_verify')
            ->where(['mtv_mt_id' => $mt_id])
            ->find();
        return $verify ? $verify : null;
    }


    /*
     * identyMerchant
     * */
    public function identyMerchant($data){
        $identy=Db::table('huhang_merchant_verify')
            ->where(['mtv_mt_id' => $data['mtv_mt_id']])
            ->update($data);
        return $identy ? true : false ;
    }





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




    /*---装修公司------------------------------------------------------------------------------------------------------------*/
}