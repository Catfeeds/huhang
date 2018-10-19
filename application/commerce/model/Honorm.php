<?php
/**
 * Name: 商户端-荣誉资质-model
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 14:29
 */
namespace app\commerce\model;
use think\Db;
use think\Model;

class Honorm extends Model
{
    /*
     * 1.读取荣誉资质数据
     * */
    public function honorData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_honor')
            ->join('huhang_merchant','huhang_honor.h_m_id = huhang_merchant.mt_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('h_istop ASC ,h_isable Asc')
            ->field('huhang_honor.*,huhang_merchant.mt_short_name')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['h_updatetime']=date('Y-m-d H:i:s',$v['h_updatetime']);
            $data[$k]['h_addtime']=date('Y-m-d H:i:s',$v['h_addtime']);
            $art_status=$v['h_status'];
            $typeName='';
            switch($art_status){
                case  1;
                    $typeName = '待审核';
                    break;
                case 2;
                    $typeName = '通过';
                    break;
                case  3;
                    $typeName = '驳回';
                    break;
            }
            $data[$k]['h_status'] = $typeName;
        }
        return $data ? $data : null;
    }



    /*
     * 2.countHonor
     * */
    public function countHonor($where){
        $count=Db::table('huhang_honor')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findHonor
     * */
    public function findHonor($h_id){
        $data=Db::table('huhang_honor')
            ->where(['h_id' => $h_id])
            ->find();
        return $data ? $data : null;
    }

    /*
     * 4.addHonor
     * */
    public function addHonor($data){
        $add=Db::table('huhang_honor')->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.editHonor
     * */
    public function editHonor($data){
        $h_id=$data['h_id'];
        $update=Db::table('huhang_honor')->where(['h_id' => $h_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 6.delHonor
     * */
    public function delHonor($h_id){
        $del=Db::table('huhang_honor')->where(['h_id' => $h_id])->delete();
        return $del ? true : false;
    }
}