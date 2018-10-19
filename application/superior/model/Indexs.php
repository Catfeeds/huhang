<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/26
 * Time: 15:25
 */
namespace app\superior\model;
use think\Db;
use think\Model;

class Indexs extends Model{

    /*
     *新闻
     * */
    public function articleData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $article=Db::table('huhang_article')
            ->where($where)
            ->limit($per,$limit)
            ->order('art_view desc')
            ->select();
        foreach($article as $k => $v){
            $article[$k]['art_updatetime']=date('Y-m-d',$v['art_updatetime']);
        }
        return $article ? $article : null;
    }

    /*
     * 文章浏览量加一
     * */
    public function artViewInc($art_id){
        $inc=Db::table('huhang_article')
            ->where(['art_id' => $art_id])
            ->setInc('art_view');
        return $inc ? true : false ;
    }


    /*
     * findArticle
     *
     * */

    public function findArticle($art_id){
        $article=Db::table('huhang_article')
            ->where(['art_id' => $art_id])
            ->find();
        $article['art_indextime']=date('Y-m-d',$article['art_updatetime']);
        return $article ? $article : null;
    }



    public function exampleData($where,$page,$limit,$order){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_case')
            ->where($where)
            ->limit($per,$limit)
            ->order($order)
            ->select();
        foreach($data as $k => $v){
            $data[$k]['case_indextime']=date('Y-m-d',$v['case_updatetime']);
        }
        return $data ? $data : null;
    }


    public function findExample($case_id){
        $data=Db::table('huhang_case')
            ->where(['case_id' => $case_id])
            ->find();
        return $data ? $data : null;
    }

    public function caseViewInc($case_id){
        $inc=Db::table('huhang_case')
            ->where(['case_id' => $case_id])->setInc('case_view');
        return $inc ? true : false;
    }


    /*
     * getMerchantInfoViaMtId
     *
     * */
    public function getMerchantInfoViaMtId($mt_id){
        $mtInfo=Db::table('huhang_merchant')
            ->where(['mt_id' => $mt_id])
            ->field('mt_id,mt_name,mt_short_name,mt_hotline,mt_logo,mt_wechat,mt_address,mt_manger,mt_email,mt_description')
            ->find();
        $mtInfo['mt_description']=mb_strlen($mtInfo['mt_description'])>95?mb_substr($mtInfo['mt_description'],0,95).'...':$mtInfo['mt_description'];
        $mtInfo['mt_logo']=explode(',',$mtInfo['mt_logo'])[1];
        return $mtInfo ? $mtInfo : null;
    }


    /*
     * bannerData
     * */
    public function bannerData($where){
        $banner=Db::table('huhang_banner')
            ->where($where)
            ->order('ba_order desc')
            ->select();
        foreach ($banner as $k =>$v){
            $banner[$k]['ba_img'] = explode(',',$v['ba_img'])[0];
            $banner[$k]['ba_url']=explode(',',$v['ba_url'])[0];
        }
        return $banner ? $banner : null;
    }

}