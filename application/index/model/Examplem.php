<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/26
 * Time: 10:19
 */
namespace app\index\model;
use think\Db;
use think\Model;

class Examplem extends Model{
        /*
       * 获取该公司的案例
       * */
    public function exampleData($c_id){
        $example=Db::table('huhang_case')
            ->where(['case_c_id' => $c_id,'case_status' => 2,'case_isable' =>1])
            ->order('case_istop desc,case_view desc')
            ->field('case_id,case_img,case_img_alt,case_title,case_price,case_area,case_remarks,case_updatetime,case_m_id')
            ->select();
        return $example ? $example : null;
    }

    /*
     * 根据案例id获取案例
     * */
    public function findExample($case_id){
        $example=Db::table('huhang_case')
            ->where(['case_id' => $case_id])
            ->field('case_id,case_img,case_img_alt,case_title,case_price,case_area,case_remarks,case_updatetime,case_m_id')
            ->find();
        return $example ? $example : null ;
    }


    /*
     * 案例浏览量加一
     * */
    public function caseViewInc($case_id){
        $inc=Db::table('huhang_case')->where(['case_id' => $case_id])->setInc('case_view');
        return $inc ? true : false;
    }



    /*
    * 1.读取案例数据
    * */
    public function exampleDatas($where,$eWhere,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_case')
            ->join('huhang_type','huhang_case.case_type = huhang_type.type_id')
            ->where($where)
            ->where('case_title|type_name','like','%'.$eWhere.'%')
            ->limit($per,$limit)
            ->order('case_updatetime desc')
            ->field('huhang_case.*,huhang_type.type_name')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['case_img']=explode(',',$v['case_img'])[0];
            $data[$k]['case_img_alt']=explode(',',$v['case_img_alt'])[0];
        }
        return $data ? $data : null;
    }

}