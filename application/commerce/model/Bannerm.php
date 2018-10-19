<?php
/**
 * Name: 商户端-广告管理-model
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 16:56
 */
namespace app\commerce\model;
use think\Db;
use think\Model;
class Bannerm extends Model{
        /*
        *读取广告数据
        * */
    public function bannerData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_banner')
            ->where($where)
            ->limit($per,$limit)
            ->order('ba_order desc ,ba_isable')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['ba_img']=explode(',',$v['ba_img'])[0];
            $data[$k]['ba_updatetime']=date('Y-m-d H:i:s',$v['ba_updatetime']);
            $art_status=$v['ba_status'];
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
            $data[$k]['ba_status'] = $typeName;
        }
        return $data ? $data : null;
    }



    /*
     * 2.countBanner
     * */
    public function countBanner($where){
        $count=Db::table('huhang_banner')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findBanner
     * */
    public function findBanner($ba_id){
        $data=Db::table('huhang_banner')
            ->where(['ba_id' => $ba_id])
            ->find();
        return $data ? $data : null;
    }

    /*
     * 4.addBanner
     * */
    public function addBanner($data){
        $add=Db::table('huhang_banner')
            ->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.editBanner
     * */
    public function editBanner($data){
        $ba_id=$data['ba_id'];
        $update=Db::table('huhang_banner')
            ->where(['ba_id' => $ba_id])
            ->update($data);
        return $update ? true : false;
    }

    /*
     * 6.delBanner
     * */
    public function delBanner($ba_id){
        $del=Db::table('huhang_banner')
            ->where(['ba_id' => $ba_id])
            ->delete();
        return $del ? true : false;
    }
}