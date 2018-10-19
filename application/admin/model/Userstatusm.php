<?php
/**
 * Name: 平台端-基本参数-客户状态-Model
 * Created by PhpStorm.
 * User: Dang Meng
 * Date: 2018/8/10
 * Time: 11:29
 */
namespace app\admin\model;
use think\Db;
use think\Model;

class Userstatusm extends Model{

    public function statusData($where,$page,$limit){
        $per=($page-1)*$limit;
        $data=Db::table('huhang_user_status')
            ->join('huhang_admin','huhang_user_status.us_admin = huhang_admin.ad_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('us_isable,us_order desc')
            ->field('huhang_user_status.*,huhang_admin.ad_realname')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['us_addtime']=date('Y-m-d H:i:s',$v['us_addtime']);
        }
        return $data ? $data : null;
    }
    /*
     * 2.count
     * */
    public function countStatus($where){
        $count=Db::table('huhang_user_status')
            ->join('huhang_admin','huhang_user_status.us_admin = huhang_admin.ad_id')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.find
     *
     * */
    public function findStatus($us_id){
        $data=Db::table('huhang_user_status')
            ->join('huhang_admin','huhang_user_status.us_admin = huhang_admin.ad_id')
            ->where(['us_id' => $us_id])
            ->field('huhang_user_status.*,huhang_admin.ad_realname')
            ->find();
        $data['us_addtime']=date('Y-m-d H:i:s',$data['us_addtime']);
        return $data ? $data : null;
    }

    /*
     * 4.add
     * */
    public function addStatus($data){
        $add=Db::table('huhang_user_status')->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.edit
     * */
    public function editStatus($data){
        $us_id=$data['us_id'];
        $update=Db::table('huhang_user_status')->where(['us_id' => $us_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 6.del
     * */
    public function delStatus($us_id){
        $del=Db::table('huhang_user_status')->where(['us_id' => $us_id])->delete();
        return $del ? true : false;
    }

}