<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/25
 * Time: 10:18
 */
namespace app\merchant\model;
use think\Db;
use think\Model;

class Examplem extends Model{
    /*
     * 获取该公司的案例
     * */
    public function exampleData($mt_id){
        $example=Db::table('huhang_case')
            ->where(['case_m_id' => $mt_id,'case_status' => 2,'case_isable' =>1])
            ->order('case_istop desc,case_view desc')
            ->select();
        return $example ? $example : null;
    }

    public function getExample($where){
        $example=Db::table('huhang_case')
            ->where($where)
            ->where(['case_status' => 2,'case_isable' =>1])
            ->order('case_istop desc,case_view desc')
            ->select();
        return $example ? $example : null;
    }



    /*
     * 根据案例id获取案例
     * */
    public function findExample($case_id){
        $example=Db::table('huhang_case')
            ->where(['case_id' => $case_id])
            ->find();
        return $example ? $example : null ;
    }



    /*
     * 案例浏览量加一
     * */
    public function caseViewInc($case_id){
        $inc=Db::table('huhang_case')->where(['case_id' => $case_id])->setInc('case_view');
        return $inc ? true : false;
    }



    /*
     *项目类型
     * */
    public function proType(){
        $proType=Db::table('huhang_type')
            ->where(['type_isable' => 1,'type_sort' => 1])
            ->order('type_order desc')
            ->select();
        return $proType ? $proType : null;
    }

    /*
     * 省份
     * */
    public function provinceData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $provinceData=Db::table('huhang_province')
            ->join('huhang_admin','huhang_province.p_admin = huhang_admin.ad_id ')
            ->where($where)
            ->limit($per,$limit)
            ->field('huhang_province.*,huhang_admin.ad_realname')
            ->select();
        foreach ($provinceData as $k => $v){
            $provinceData[$k]['p_opeatime'] = date('Y-m-d H:i:s',$v['p_opeatime']);
        }
        return $provinceData ? $provinceData : null;
    }


    public function cityData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $cityData=Db::table('huhang_city')
            ->join('huhang_province','huhang_province.p_id = huhang_city.c_p_id')
            ->join('huhang_city_rank','huhang_city_rank.cr_id = huhang_city.c_rank')
            ->join('huhang_admin','huhang_admin.ad_id = huhang_city.c_admin')
            ->where($where)
            ->limit($per,$limit)
            ->field('huhang_city.*,huhang_province.p_name,huhang_city_rank.cr_name,huhang_admin.ad_realname')
            ->select();
        foreach($cityData as $k =>$v){
            $cityData[$k]['c_opeatime']= date('Y-m-d H:i:s',$v['c_opeatime']);
        }
        return $cityData ? $cityData : null;
    }



    /*
     * 推荐的12 家公司
     * */
    public function topMerchant($where,$page,$limit){
            $per= ($page-1) * $limit;
            $merchant=Db::table('huhang_merchant')
                ->where($where)
                ->limit($per,$limit)
                ->order('mt_rank desc,mt_view desc')
                ->field('mt_id,mt_name')
                ->select();
            return $merchant ? $merchant : null;
    }
}