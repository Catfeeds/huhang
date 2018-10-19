<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/8/3
 * Time: 11:46
 */
namespace app\commerce\model;
use think\Db;
use think\Model;
class Quest extends Model
{
    /*
   * 1.读取招聘数据
   * */
    public function questionData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_question')
            ->where($where)
            ->limit($per,$limit)
            ->order('qa_istop ,qa_isable')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['qa_type']=$v['qa_type']== 1 ? '后台发布' : '客户提问';
            $data[$k]['qa_addtime']=date('Y-m-d H:i:s',$v['qa_addtime']);
            $data[$k]['qa_count']=$this->countAnswer(['qaa_question' =>$v['qa_id']]);
            $art_status=$v['qa_status'];
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
            $data[$k]['qa_status'] = $typeName;
        }
        return $data ? $data : null;
    }



    /*
     * 2.countWanted
     * */
    public function countQuestion($where){
        $count=Db::table('huhang_question')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findWanted
     * */
    public function findQuestion($qa_id){
        $data=Db::table('huhang_question')
            ->where(['qa_id' => $qa_id])
            ->find();
        return $data ? $data : null;
    }

    /*
     * 4.addWanted
     * */
    public function addQuestion($data){
        $add=Db::table('huhang_question')->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.editWanted
     * */
    public function editQuestion($data){
        $qa_id=$data['qa_id'];
        $update=Db::table('huhang_question')->where(['qa_id' => $qa_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 6.delWanted
     * */
    public function delQuestion($qa_id){
        $del=Db::table('huhang_question')->where(['qa_id' => $qa_id])->delete();
        return $del ? true : false;
    }













    /*
     * 回复管理
     *
     * */

    /*
  * 1.读取招聘数据
  * */
    public function answerData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_answer')
            ->where($where)
            ->limit($per,$limit)
            ->order('qaa_istop ,qaa_isable')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['qaa_type']=$v['qaa_type']== 1 ? '后台回复' : '客户回复';
            $data[$k]['qaa_addtime']=date('Y-m-d H:i:s',$v['qaa_addtime']);
            $art_status=$v['qaa_status'];
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
            $data[$k]['qaa_status'] = $typeName;
        }
        return $data ? $data : null;
    }



    /*
     * 2.countWanted
     * */
    public function countAnswer($where){
        $count=Db::table('huhang_answer')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findWanted
     * */
    public function findAnswer($qaa_id){
        $data=Db::table('huhang_answer')
            ->where(['qaa_id' => $qaa_id])
            ->find();
        return $data ? $data : null;
    }

    /*
     * 4.addWanted
     * */
    public function addAnswer($data){
        $add=Db::table('huhang_answer')->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.editWanted
     * */
    public function editAnswer($data){
        $qaa_id=$data['qaa_id'];
        $update=Db::table('huhang_answer')->where(['qaa_id' => $qaa_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 6.delWanted
     * */
    public function delAnswer($qaa_id){
        $del=Db::table('huhang_answer')->where(['qaa_id' => $qaa_id])->delete();
        return $del ? true : false;
    }




}