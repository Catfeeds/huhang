<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Userm extends Model{

    //客户数据查询
    public function cusData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $customer=Db::table('huhang_customer')
            ->join('huhang_province','huhang_customer.cus_provid = huhang_province.p_id')
//           // ->join('huhang_type','huhang_customer.cus_type = huhang_type.type_id')
            ->join('huhang_city','huhang_customer.cus_cityid = huhang_city.c_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('cus_opptime desc')
            ->field('huhang_customer.*,huhang_province.p_name,huhang_city.c_name')
            ->select();
        foreach($customer as $k => $v){
            $customer[$k]['cus_opptime']=date('Y-m-d H:i:s',$v['cus_opptime']);
        }
        return $customer ? $customer : null;
    }


    /*
     * cusCount
     * */
    public function cusCount($where){
        $count=Db::table('huhang_customer')
            ->join('huhang_province','huhang_customer.cus_provid = huhang_province.p_id')
            ->join('huhang_city','huhang_customer.cus_cityid = huhang_city.c_id')
            ->where($where)
            ->count();
        return $count ? $count : 0;
    }



}