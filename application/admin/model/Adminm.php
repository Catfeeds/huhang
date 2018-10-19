<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Adminm extends Model{



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
            ->join('huhang_admin','huhang_merchant.mt_admin = huhang_admin.ad_id')
            ->join('huhang_service_type','huhang_merchant.mt_services = huhang_service_type.st_id')
            ->join('huhang_province','huhang_merchant.mt_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_merchant.mt_c_id = huhang_city.c_id')
            ->join('huhang_branch','huhang_merchant.mt_b_id = huhang_branch.b_id')
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










/*---装修公司------------------------------------------------------------------------------------------------------------*/

}