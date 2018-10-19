<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/20
 * Time: 10:11
 */
namespace app\admin\model;
use think\Db;
use think\Model;

class Navm extends Model{

    public function navData($where,$page,$limit){
        $per=($page-1)*$limit;
        $data=Db::table('huhang_nav')
            ->join('huhang_admin','huhang_nav.nav_admin = huhang_admin.ad_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('nav_order desc')
            ->field('huhang_nav.*,huhang_admin.ad_realname')
            ->select();
        foreach($data as $k =>$v){
            $data[$k]['subNav']=Db::table('huhang_nav')
                ->join('huhang_admin','huhang_nav.nav_admin = huhang_admin.ad_id')
                ->where(['nav_fid' => $v['nav_id']])
                ->order('nav_order desc')
                ->select();
        }
        return $data ? $data : null;
    }
    /*
     * 2.count
     * */
    public function countNav($where){
        $count=Db::table('huhang_nav')
            ->join('huhang_admin','huhang_nav.nav_admin = huhang_admin.ad_id')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.find
     * */
    public function findNav($nav_id){
        $data=Db::table('huhang_nav')
            ->join('huhang_admin','huhang_nav.nav_admin = huhang_admin.ad_id')
            ->where(['nav_id' => $nav_id])
            ->field('huhang_nav.*,huhang_admin.ad_realname')
            ->find();
        return $data ? $data : null;
    }

    /*
     * 4.add
     * */
    public function addNav($data){
        $add=Db::table('huhang_nav')->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.edit
     * */
    public function editNav($data){
        $nav_id=$data['nav_id'];
        $update=Db::table('huhang_nav')->where(['nav_id' => $nav_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 6.del
     * */
    public function delNav($nav_id){
        $del=Db::table('huhang_nav')->where(['nav_id' => $nav_id])->delete();
        return $del ? true : false;
    }


}