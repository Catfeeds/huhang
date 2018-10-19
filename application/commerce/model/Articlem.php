<?php
/**
 * Name: 商户端-文章管理-model
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 17:52
 */
namespace app\commerce\model;
use think\Db;
use think\Model;

class Articlem extends Model{

    /*
     *1. 文章数据读取
     * */
    public function articleData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $article=Db::table('huhang_article')
            ->join('huhang_type','huhang_article.art_type = huhang_type.type_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('art_createtime desc')
            ->field('huhang_article.*,huhang_type.type_name')
            ->select();
        foreach($article as $k => $v){
            $article[$k]['art_updatetime']=date('Y-m-d H:i:s',$v['art_updatetime']);
            $article[$k]['art_indextime']=date('Y-m-d',$v['art_updatetime']);
            $article[$k]['art_createtime']=date('Y-m-d H:i:s',$v['art_createtime']);
            $art_status=$v['art_status'];
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
            $article[$k]['art_status'] = $typeName;
        }
        return $article ? $article : null;
    }

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



    /*
     * 2.countArticle
     * */
    public function countArticle($where){
        $count=Db::table('huhang_article')
            ->join('huhang_type','huhang_article.art_type = huhang_type.type_id')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findArticle
     * */
    public function findArticle($art_id){
        $article=Db::table('huhang_article')
            ->join('huhang_type','huhang_article.art_type = huhang_type.type_id')
            ->where(['art_id' => $art_id])
            ->find();
        $article['art_indextime']=date('Y-m-d',$article['art_updatetime']);
        return $article ? $article : null;
    }

    /*
     * 4.addArticle
     * */
    public function addArticle($data){
        $add=Db::table('huhang_article')
            ->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.editArticle
     * */
    public function editArticle($data){
        $art_id=$data['art_id'];
        $update=Db::table('huhang_article')
            ->where(['art_id' => $art_id])
            ->update($data);
        return $update ? true : false;
    }

    /*
     * 6.delArticle
     * */
    public function delArticle($art_id){
        $del=Db::table('huhang_article')
            ->where(['art_id' => $art_id])
            ->delete();
        return $del ? true : false;
    }

    /*
     * 7.view setInc();
     * */
    public function articleInc($art_id){
        $inc=Db::table('huhang_article')
            ->where(['art_id' => $art_id])
            ->setInc('art_view');
        return $inc ? true : false ;
    }
}