<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/20
 * Time: 17:21
 */
namespace app\admin\model;
use think\Model;
use think\Db;

class Activitym extends Model{

    public function activityData($where,$page,$limit){
        $per=($page-1)*$limit;
        $data=Db::table('huhang_activity')
            ->join('huhang_admin','huhang_activity.act_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_activity.act_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_activity.act_c_id = huhang_city.c_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('act_istop,act_view desc')
            ->field('huhang_activity.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['act_p_id']=$v['p_name'].'-'.$v['c_name'];
            $data[$k]['act_addtime']=date('Y-m-d H:i:s',$v['act_addtime']);
            $data[$k]['act_updatetime']=date('Y-m-d H:i:s',$v['act_updatetime']);
            $data[$k]['act_time']=date('Y-m-d',$v['act_starttime']).'至'.date('Y-m-d',$v['act_endtime']);
        }
        return $data ? $data : null;
    }
    /*
     * 2.count
     * */
    public function countActivity($where){
        $count=Db::table('huhang_activity')
            ->join('huhang_admin','huhang_activity.act_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_activity.act_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_activity.act_c_id = huhang_city.c_id')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.find
     *
     * */
    public function findActivity($act_id){
        $data=Db::table('huhang_activity')
            ->join('huhang_admin','huhang_activity.act_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_activity.act_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_activity.act_c_id = huhang_city.c_id')
            ->where(['act_id' => $act_id])
            ->field('huhang_activity.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name')
            ->find();
        $data['act_time']=date('Y-m-d',$data['act_starttime']).' ~ '.date('Y-m-d',$data['act_endtime']);
        return $data ? $data : null;
    }

    /*
     * 4.add
     * */
    public function addActivity($data){
        $add=Db::table('huhang_activity')->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.edit
     * */
    public function editActivity($data){
        $act_id=$data['act_id'];
        $update=Db::table('huhang_activity')->where(['act_id' => $act_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 6.del
     * */
    public function delActivity($act_id){
        $del=Db::table('huhang_activity')->where(['act_id' => $act_id])->delete();
        return $del ? true : false;
    }
}