<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/31
 * Time: 15:32
 */
namespace app\commerce\model;
use think\Db;
use think\Model;

class Design extends Model{
    public function designerData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_designer')
            ->where($where)
            ->limit($per,$limit)
            ->order('des_updatetime desc')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['des_updatetime']=date('Y-m-d H:i:s',$v['des_updatetime']);
            $art_status=$v['des_status'];
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
            $data[$k]['des_status'] = $typeName;
        }
        return $data ? $data : null;
    }



    /*
     * 2.countDesigner
     * */
    public function countDesigner($where){
        $count=Db::table('huhang_designer')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findDesigner
     * */
    public function findDesigner($des_id){
        $data=Db::table('huhang_designer')
            ->where(['des_id' => $des_id])
            ->find();
        return $data ? $data : null;
    }

    /*
     * 4.addDesigner
     * */
    public function addDesigner($data){
        $add=Db::table('huhang_designer')
            ->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.editDesigner
     * */
    public function editDesigner($data){
        $des_id=$data['des_id'];
        $update=Db::table('huhang_designer')
            ->where(['des_id' => $des_id])
            ->update($data);
        return $update ? true : false;
    }

    /*
     * 6.delDesigner
     * */
    public function delDesigner($des_id){
        $del=Db::table('huhang_designer')
            ->where(['des_id' => $des_id])
            ->delete();
        return $del ? true : false;
    }


    /*
     * designerInc
     * */
    public function designerInc($des_id){
        $inc=Db::table('huhang_designer')
            ->where(['des_id' => $des_id])
            ->setInc('des_view');
        return $inc ? true : false;
    }


}