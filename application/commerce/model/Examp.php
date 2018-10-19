<?php
/**
 * Name: 商户端-项目案例-model
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/31
 * Time: 10:04
 */
namespace app\commerce\model;
use think\Db;
use think\Model;

class Examp extends Model{
    /*
         * 1.读取案例数据
         * */
    public function exampleData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_case')
            ->join('huhang_type','huhang_case.case_type = huhang_type.type_id')
            ->join('huhang_merchant','huhang_case.case_m_id = huhang_merchant.mt_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('case_updatetime desc')
            ->field('huhang_case.*,huhang_type.type_name,huhang_merchant.mt_short_name')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['case_updatetime']=date('Y-m-d H:i:s',$v['case_updatetime']);
            $data[$k]['case_indextime']=date('Y-m-d',$v['case_updatetime']);
            $data[$k]['case_decotime']=date('Y-m-d H:i:s',$v['case_decotime']);
            $data[$k]['case_img']=explode(',',$v['case_img'])[0];
            $data[$k]['case_img_alt']=explode(',',$v['case_img_alt'])[0];
            $art_status=$v['case_status'];
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
            $data[$k]['case_status'] = $typeName;
        }
        return $data ? $data : null;
    }



    /*
     * 2.countExample
     * */
    public function countExample($where){
        $count=Db::table('huhang_case')
            ->join('huhang_type','huhang_case.case_type = huhang_type.type_id')
            ->join('huhang_merchant','huhang_case.case_m_id = huhang_merchant.mt_id')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findExample
     * */
    public function findExample($case_id){
        $data=Db::table('huhang_case')
            ->join('huhang_type','huhang_case.case_type = huhang_type.type_id')
            ->join('huhang_merchant','huhang_case.case_m_id = huhang_merchant.mt_id')
            ->where(['case_id' => $case_id])
            ->field('huhang_case.*,huhang_type.type_name,huhang_merchant.mt_short_name')
            ->find();
        //案例图片
        $data['case_img']=explode(',',$data['case_img']);
        $data['case_img_alt']=explode(',',$data['case_img_alt']);
        return $data ? $data : null;
    }

    /*
     * 4.addExample
     * */
    public function addExample($data){
        $add=Db::table('huhang_case')->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.editExample
     * */
    public function editExample($data){
        $case_id=$data['case_id'];
        $update=Db::table('huhang_case')->where(['case_id' => $case_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 6.delExample
     * */
    public function delExample($case_id){
        $del=Db::table('huhang_case')->where(['case_id' => $case_id])->delete();
        return $del ? true : false;
    }

    /*
     * exampleInc
     * */
    public function exampleInc($case_id){
        $inc=Db::table('huhang_case')->where(['case_id' => $case_id])->setInc('case_view');
        return $inc ? true : false ;
    }


    /*
     * 读取省份信息
     * */
    public function provinceData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $provinceData=Db::table('huhang_province')
            ->join('huhang_admin','huhang_province.p_admin = huhang_admin.ad_id ')
            ->where($where)
            ->limit($per,$limit)
            ->field('huhang_province.*,huhang_admin.ad_realname')
            ->select();
        foreach ($provinceData as $k => $v){
            $provinceData[$k]['p_opeatime'] = date('Y-m-d H:i:s',$v['p_opeatime']);
        }
        return $provinceData ? $provinceData : null;
    }


    /*
     * typeData
     * */
    public function typeData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $typeData=Db::table('huhang_type')
            ->where($where)
            ->limit($per,$limit)
            ->order('type_order desc')
            ->select();
        foreach ($typeData as $k => $v){
            $typeData[$k]['type_addtime'] = date('Y-m-d H:i:s',$v['type_addtime']);
        }
        return $typeData ? $typeData : null;
    }

}