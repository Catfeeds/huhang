<?php
/**
 * Created by PhpStorm.
 * User: Dang Meng
 * Date: 2018/8/11
 * Time: 14:07
 */
namespace app\index\model;
use think\Db;
use think\Model;

class Compay extends Model{
    public function merchantData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $merchant=Db::table('huhang_merchant')
            ->where($where)
            ->limit($per,$limit)
            ->order('mt_rank desc,mt_recive_num desc')
            ->field('mt_name,mt_address,mt_logo,mt_rank,mt_money,mt_deadline,mt_id,mt_order_num,mt_service_type')
            ->select();
        foreach($merchant as $k => $v){
            $merchant[$k]['service_id']=explode(',',$v['mt_service_type']);
        }
        return $merchant ? $merchant : null;
    }
}