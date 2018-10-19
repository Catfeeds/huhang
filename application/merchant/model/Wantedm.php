<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/25
 * Time: 15:03
 */
namespace app\merchant\model;
use think\Db;
use think\Model;

class Wantedm extends Model{

    /*
     * 该商户的发布的招聘信息
     * */
    public function wantedData($mt_id){
        $wanted=Db::table('huhang_wanted')
            ->join('huhang_merchant','huhang_merchant.mt_id = huhang_wanted.wt_m_id')
            ->where(['wt_isable' => 1,'wt_status' =>2,'wt_m_id'=>$mt_id])
            ->field('huhang_wanted.*,huhang_merchant.mt_address')
            ->select();
        return $wanted ? $wanted : null;
    }

    /*
     * find
     * */
    public function findWanted($wt_id){
        $wanted=Db::table('huhang_wanted')
            ->join('huhang_merchant','huhang_merchant.mt_id = huhang_wanted.wt_m_id')
            ->where(['wt_isable' => 1,'wt_status' =>2,'wt_id'=>$wt_id])
            ->field('huhang_wanted.*,huhang_merchant.mt_address')
            ->find();
        return $wanted ? $wanted : null;
    }




    /*
    * 投诉建议
    * */
    public function addSuggest($data){
        $add=Db::table('huhang_suggestion')->insert($data);
        return $add ? $add : 0;
    }

    /*
     * 统计这个ip在当天的投诉次数
     * */
    public function countSugIp($where){
        $count=Db::table('huhang_suggestion')->where($where)->count();
        return $count ? $count : 0 ;
    }


}