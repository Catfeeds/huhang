<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/19
 * Time: 16:49
 */
namespace app\index\model;
use think\Db;
use think\Model;

class Indexm extends Model{


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

    public function getTypeCase($m_c_id){
        $typeData=Db::table('huhang_type')
            ->where(['type_isable' => 1,'type_sort'=> 1])
            ->order('type_order desc')
            ->select();
        foreach($typeData as $k => $v){
            $typeData[$k]['type_case']=Db::table('huhang_case')
                                            ->where(['case_c_id' => $m_c_id,'case_type' =>$v['type_id'],'case_status' => 2,'case_isable' => 1])
                                            ->order('case_view desc')
                                            ->limit(5)
                                            ->field('case_id,case_img,case_img_alt')
                                            ->select();
        }
        return $typeData ? $typeData : null;
    }




    /*
     *
     * 客户预约数据入库
     * */
    public function makePoint($data){
        $point=Db::table('huhang_customer')->insert($data);
        return $point ? $point : 0;
    }



    /*
     * 平台所有的预约总数
     * */
    public function countAll(){
        $all=Db::table('huhang_customer')->count();
        return $all ? $all :0;
    }


    /*
        * 客户统计
        * */
    public function countCus($where){
        $count=Db::table('huhang_customer')
            ->join('huhang_province','huhang_customer.cus_provid = huhang_province.p_id')
            ->join('huhang_type','huhang_customer.cus_type = huhang_type.type_id')
            ->join('huhang_city','huhang_customer.cus_cityid = huhang_city.c_id')
            ->where($where)
            ->count();
        return $count ? $count : 0;
    }




    /*
     *
     * 根据城市名称去选择要跳转的城市站
     * 如果没有找到相应的城市的id则跳转到西安站的id为56数据库数据禁止修改
     * */
    public function getCityIdViaCityName($c_name){
        $city_id=Db::table('huhang_city')->where(['c_name' => $c_name])->column('c_id');
        return $city_id ? $city_id : 56 ;

    }




    /*
     * 统计投标数目
     * */
    public function countBid($where){
        $count=Db::table('huhang_merchant_order')
            ->join('huhang_city','huhang_merchant_order.mo_c_id = huhang_city.c_id')
            ->where($where)
            ->count();
        return $count ? $count : 0;
    }

    /*
     * 商户投标
     * */
    public function bidding($data){
        $bidding=Db::table('huhang_merchant_order')->insert($data);
        return $bidding ? $bidding : 0;
    }


    /*
     * 装修问答
     * */
    public function questionasd($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $quest=Db::table('huhang_question')
            ->where($where)
            ->limit($per,$limit)
            ->order('qa_istop')
            ->select();
        foreach($quest as $k => $v){
            $quest[$k]['top_answer']=Db::table('huhang_answer')->where(['qaa_question' => $v['qa_id'],'qaa_isable' => 1,'qaa_status' =>2])->order('qaa_istop')->find()?Db::table('huhang_answer')->where(['qaa_question' => $v['qa_id'],'qaa_isable' => 1,'qaa_status' =>2])->order('qaa_istop')->find() :array('qaa_answer' =>'暂无回复！');
        }
        return $quest ? $quest : null;
    }


}