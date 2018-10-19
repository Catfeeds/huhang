<?php
/**
 * Name: 商户端-人才招聘-model
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 16:24
 */
namespace app\commerce\model;
use think\Db;
use think\Model;
class Recruitm extends Model{
    /*
    * 1.读取招聘数据
    * */
    public function wantedData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_wanted')
            ->where($where)
            ->limit($per,$limit)
            ->order('wt_updatetime desc')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['wt_updatetime']=date('Y-m-d H:i:s',$v['wt_updatetime']);
            $data[$k]['wt_addtime']=date('Y-m-d H:i:s',$v['wt_addtime']);
            $art_status=$v['wt_status'];
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
            $data[$k]['wt_status'] = $typeName;
        }
        return $data ? $data : null;
    }



    /*
     * 2.countWanted
     * */
    public function countWanted($where){
        $count=Db::table('huhang_wanted')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findWanted
     * */
    public function findWanted($wt_id){
        $data=Db::table('huhang_wanted')
            ->where(['wt_id' => $wt_id])
            ->find();
        return $data ? $data : null;
    }

    /*
     * 4.addWanted
     * */
    public function addWanted($data){
        $add=Db::table('huhang_wanted')->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.editWanted
     * */
    public function editWanted($data){
        $wt_id=$data['wt_id'];
        $update=Db::table('huhang_wanted')->where(['wt_id' => $wt_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 6.delWanted
     * */
    public function delWanted($wt_id){
        $del=Db::table('huhang_wanted')->where(['wt_id' => $wt_id])->delete();
        return $del ? true : false;
    }

}