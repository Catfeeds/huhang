<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/25
 * Time: 9:13
 */
namespace app\merchant\model;
use think\Db;
use think\Model;

class Companym extends Model{
    /*
     * 获取该公司的简介
     * */
    public function getCompanyProfile($mt_id){
        $companyProfile=Db::table('huhang_merchant')->where(['mt_id' => $mt_id])->column('mt_description');
        return $companyProfile ? $companyProfile : null;
    }
    /*
     * 获取该公司的名称
     * */
    public function getCompanyName($mt_id){
        $companyName=Db::table('huhang_merchant')->where(['mt_id' => $mt_id])->column('mt_name');
        return $companyName ? $companyName : null;
    }


    /*
     * getConpanyInfo
     * */
    public function getConpanyInfo($mt_id){
        $company=Db::table('huhang_merchant')->where(['mt_id' => $mt_id])->find();
        return $company ? $company : null;
    }





    /*
     * 获取荣誉资质
     * */
    public function getHonor($mt_id){
        $honors=Db::table('huhang_honor')
            ->where(['h_m_id' => $mt_id,'h_isable' => 1,'h_status' => 2])
            ->select();
        return $honors ? $honors : null;
    }


    /*
     * 公司动态的文章
     * */
    public function articleData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $article=Db::table('huhang_article')
            ->join('huhang_type','huhang_article.art_type = huhang_type.type_id','left')
            ->limit($per,$limit)
            ->where($where)
            ->order('art_istop ASC ,art_isable Asc,art_view desc')
            ->field('huhang_article.*,huhang_type.type_name')
            ->select();
        foreach($article as $k => $v){
            $article[$k]['art_indextime']=date('Y-m-d',$v['art_updatetime']);
        }
        return $article ? $article : null;
    }


    /*
     * findArticle
     * */
    public function findArticle($art_id){
        $article=Db::table('huhang_article')
            ->join('huhang_type','huhang_article.art_type = huhang_type.type_id','left')
            ->where(['art_id' => $art_id])
            ->field('huhang_article.*,huhang_type.type_name')
            ->find();
        $article['art_indextime']=date('Y-m-d',$article['art_updatetime']);
        return $article ? $article : null;
    }

    /*
     * 获取商家信息
     * */
    public function findMerchant($mt_id){
        $merchant=Db::table('huhang_merchant')
            ->where(['mt_id' => $mt_id])
            ->field('mt_hotline')
            ->find();
        return $merchant ? $merchant : null;
    }


    public function articleViewInc($art_id){
        $inc=Db::table('huhang_article')->where(['art_id' =>$art_id])->setInc('art_view');
        return $inc ? true : false ;
    }
}