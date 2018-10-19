<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/15
 * Time: 9:37
 */
namespace app\admin\model;
use think\Db;
use think\Model;

class Platformm extends Model{

/*---文章管理 start------------------------------------------------------------------------------------------------------*/


    /*
     *1. 文章数据读取
     * */
    public function articleData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $article=Db::table('huhang_article')
            ->join('huhang_admin','huhang_article.art_admin = huhang_admin.ad_id')
            ->join('huhang_type','huhang_article.art_type = huhang_type.type_id','left')
            ->join('huhang_province','huhang_article.art_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_article.art_c_id = huhang_city.c_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('art_createtime desc')
            ->field('huhang_article.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name,huhang_type.type_name')
            ->select();
        foreach($article as $k => $v){
            $article[$k]['mt_short_name']=$v['art_m_id']?Db::table('huhang_merchant')->where(['mt_id' => $v['art_m_id']])->column('mt_short_name'):'---';
            $article[$k]['mt_name']=$v['art_m_id']?Db::table('huhang_merchant')->where(['mt_id' => $v['art_m_id']])->column('mt_name'):'---';
            $article[$k]['art_p_id']=$v['p_name'].'-'.$v['c_name'];
            $article[$k]['art_p_id']=$v['p_name'].'-'.$v['c_name'];
            $article[$k]['art_updatetime']=date('Y-m-d H:i:s',$v['art_updatetime']);
            $article[$k]['art_indextime']=date('Y-m-d',$v['art_updatetime']);
            $article[$k]['art_createtime']=date('Y-m-d H:i:s',$v['art_createtime']);
            $article[$k]['art_subtitle']=mb_strlen($v['art_subtitle'])>130?mb_substr($v['art_subtitle'],0,130).'...':$v['art_subtitle'];
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



    /*
     * 2.countArticle
     * */
    public function countArticle($where){
        $count=Db::table('huhang_article')
            ->join('huhang_admin','huhang_article.art_admin = huhang_admin.ad_id')
            ->join('huhang_type','huhang_article.art_type = huhang_type.type_id','left')
            ->join('huhang_province','huhang_article.art_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_article.art_c_id = huhang_city.c_id')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findArticle
     * */
    public function findArticle($art_id){
        $article=Db::table('huhang_article')
            ->join('huhang_admin','huhang_article.art_admin = huhang_admin.ad_id')
            ->join('huhang_type','huhang_article.art_type = huhang_type.type_id','left')
            ->join('huhang_province','huhang_article.art_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_article.art_c_id = huhang_city.c_id')
            ->where(['art_id' => $art_id])
            ->field('huhang_article.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name,huhang_type.type_name')
            ->find();
        $article['mt_name']=$article['art_m_id']?Db::table('huhang_merchant')->where(['mt_id' => $article['art_m_id']])->column('mt_name'):'---';
        $article['mt_short_name']=$article['art_m_id']?Db::table('huhang_merchant')->where(['mt_id' => $article['art_m_id']])->column('mt_short_name'):'---';
        $article['art_indextime']=date('Y-m-d',$article['art_updatetime']);
        return $article ? $article : null;
    }

    /*
     * 4.addArticle
     * */
    public function addArticle($data){
        $add=Db::table('huhang_article')->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.editArticle
     * */
    public function editArticle($data){
        $art_id=$data['art_id'];
        $update=Db::table('huhang_article')->where(['art_id' => $art_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 6.delArticle
     * */
    public function delArticle($art_id){
        $del=Db::table('huhang_article')->where(['art_id' => $art_id])->delete();
        return $del ? true : false;
    }

    /*
     * 7.view setInc();
     * */
    public function articleInc($art_id){
        $inc=Db::table('huhang_article')->where(['art_id' => $art_id])->setInc('art_view');
        return $inc ? true : false ;
    }

/*---文章管理 end ------------------------------------------------------------------------------------------------------*/


/*---案例管理 start ------------------------------------------------------------------------------------------------------*/
    /*
     * 1.读取案例数据
     * */
    public function exampleData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_case')
            ->join('huhang_admin','huhang_case.case_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_case.case_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_case.case_c_id = huhang_city.c_id')
            ->join('huhang_type','huhang_case.case_type = huhang_type.type_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('case_updatetime desc')
            ->field('huhang_case.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name,huhang_type.type_name')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['mt_short_name']=$v['case_m_id']?Db::table('huhang_merchant')->where(['mt_id' => $v['case_m_id']])->column('mt_short_name'):'---';
            $data[$k]['case_designer']=$v['case_designer']?Db::table('huhang_designer')->where(['des_id' => $v['case_designer']])->column('des_name'):'---';
            $data[$k]['case_p_id']=$v['p_name'].'-'.$v['c_name'];
            $data[$k]['case_p_id']=$v['p_name'].'-'.$v['c_name'];
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
            ->join('huhang_admin','huhang_case.case_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_case.case_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_case.case_c_id = huhang_city.c_id')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findExample
     * */
    public function findExample($case_id){
        $data=Db::table('huhang_case')
            ->join('huhang_admin','huhang_case.case_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_case.case_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_case.case_c_id = huhang_city.c_id')
            ->where(['case_id' => $case_id])
            ->field('huhang_case.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name')
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

/*---案例管理 end ------------------------------------------------------------------------------------------------------*/

/*---荣誉资质 start ------------------------------------------------------------------------------------------------------*/

    /*
     * 1.读取荣誉资质数据
     * */
    public function honorData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_honor')
            ->join('huhang_admin','huhang_honor.h_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_honor.h_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_honor.h_c_id = huhang_city.c_id')
            ->join('huhang_merchant','huhang_honor.h_m_id = huhang_merchant.mt_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('h_istop ASC ,h_isable Asc')
            ->field('huhang_honor.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name,huhang_merchant.mt_short_name')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['h_p_id']=$v['p_name'].'-'.$v['c_name'];
            $data[$k]['h_updatetime']=date('Y-m-d H:i:s',$v['h_updatetime']);
            $data[$k]['h_addtime']=date('Y-m-d H:i:s',$v['h_addtime']);
            $art_status=$v['h_status'];
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
            $data[$k]['h_status'] = $typeName;
        }
        return $data ? $data : null;
    }



    /*
     * 2.countHonor
     * */
    public function countHonor($where){
        $count=Db::table('huhang_honor')
            ->join('huhang_admin','huhang_honor.h_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_honor.h_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_honor.h_c_id = huhang_city.c_id')
            ->join('huhang_merchant','huhang_honor.h_m_id = huhang_merchant.mt_id')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findHonor
     * */
    public function findHonor($h_id){
        $data=Db::table('huhang_honor')
            ->join('huhang_admin','huhang_honor.h_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_honor.h_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_honor.h_c_id = huhang_city.c_id')
            ->join('huhang_merchant','huhang_honor.h_m_id = huhang_merchant.mt_id')
            ->where(['h_id' => $h_id])
            ->field('huhang_honor.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name,huhang_merchant.mt_short_name')
            ->find();
        return $data ? $data : null;
    }

    /*
     * 4.addHonor
     * */
    public function addHonor($data){
        $add=Db::table('huhang_honor')->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.editHonor
     * */
    public function editHonor($data){
        $h_id=$data['h_id'];
        $update=Db::table('huhang_honor')->where(['h_id' => $h_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 6.delHonor
     * */
    public function delHonor($h_id){
        $del=Db::table('huhang_honor')->where(['h_id' => $h_id])->delete();
        return $del ? true : false;
    }

/*---荣誉资质 end ------------------------------------------------------------------------------------------------------*/










/*---招聘管理 start ------------------------------------------------------------------------------------------------------*/
    /*
     * 1.读取招聘数据
     * */
    public function wantedData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_wanted')
            ->join('huhang_admin','huhang_wanted.wt_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_wanted.wt_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_wanted.wt_c_id = huhang_city.c_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('wt_istop ,wt_isable')
            ->field('huhang_wanted.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['mt_short_name']=$v['wt_m_id']?Db::table('huhang_merchant')->where(['mt_id' => $v['wt_m_id']])->column('mt_short_name'):'---';
            $data[$k]['wt_p_id']=$v['p_name'].'-'.$v['c_name'];
            $data[$k]['wt_updatetime']=date('Y-m-d H:i:s',$v['wt_updatetime']);
            $data[$k]['wt_addtime']=date('Y-m-d H:i:s',$v['wt_addtime']);
            $data[$k]['wt_deadline']=date('Y-m-d',$v['wt_deadline']);
            $art_status=$v['wt_status'];
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
            $data[$k]['wt_status'] = $typeName;
        }
        return $data ? $data : null;
    }



    /*
     * 2.countWanted
     * */
    public function countWanted($where){
        $count=Db::table('huhang_wanted')
            ->join('huhang_admin','huhang_wanted.wt_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_wanted.wt_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_wanted.wt_c_id = huhang_city.c_id')
            ->join('huhang_merchant','huhang_wanted.wt_m_id = huhang_merchant.mt_id')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findWanted
     * */
    public function findWanted($wt_id){
        $data=Db::table('huhang_wanted')
            ->join('huhang_admin','huhang_wanted.wt_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_wanted.wt_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_wanted.wt_c_id = huhang_city.c_id')
            ->join('huhang_merchant','huhang_wanted.wt_m_id = huhang_merchant.mt_id')
            ->where(['wt_id' => $wt_id])
            ->field('huhang_wanted.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name,huhang_merchant.mt_short_name')
            ->find();
        return $data ? $data : null;
    }

    /*
     * 4.addWanted
     * */
    public function addWanted($data){
        $add=Db::table('huhang_wanted')->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.editWanted
     * */
    public function editWanted($data){
        $wt_id=$data['wt_id'];
        $update=Db::table('huhang_wanted')->where(['wt_id' => $wt_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 6.delWanted
     * */
    public function delWanted($wt_id){
        $del=Db::table('huhang_wanted')->where(['wt_id' => $wt_id])->delete();
        return $del ? true : false;
    }

/*---招聘管理 end ------------------------------------------------------------------------------------------------------*/



/*---问答管理 start ------------------------------------------------------------------------------------------------------*/


    /*
    * 1.读取招聘数据
    * */
    public function questionData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_question')
            ->join('huhang_admin','huhang_question.qa_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_question.qa_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_question.qa_c_id = huhang_city.c_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('qa_istop ,qa_isable')
            ->field('huhang_question.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['mt_short_name']=$v['qa_m_id']?Db::table('huhang_merchant')->where(['mt_id' => $v['qa_m_id']])->column('mt_short_name'):'---';
            $data[$k]['qa_p_id']=$v['p_name'].'-'.$v['c_name'];
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
            ->join('huhang_admin','huhang_question.qa_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_question.qa_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_question.qa_c_id = huhang_city.c_id')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findWanted
     * */
    public function findQuestion($qa_id){
        $data=Db::table('huhang_question')
            ->join('huhang_admin','huhang_question.qa_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_question.qa_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_question.qa_c_id = huhang_city.c_id')
            ->where(['qa_id' => $qa_id])
            ->field('huhang_question.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name')
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
            ->join('huhang_admin','huhang_answer.qaa_admin = huhang_admin.ad_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('qaa_istop ,qaa_isable')
            ->field('huhang_answer.*,huhang_admin.ad_realname')
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
            ->join('huhang_admin','huhang_answer.qaa_admin = huhang_admin.ad_id')
            ->where(['qaa_id' => $qaa_id])
            ->field('huhang_answer.*,huhang_admin.ad_realname')
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






/*---问答管理 end ------------------------------------------------------------------------------------------------------*/







/***********************************************************************************************************************/
/*-----黄金分割线----以下内容是广告管理--------------------------------------------------------------------------------*/
/***********************************************************************************************************************/





/*-----广告管理--------------------------------------------------------------------------------------------------------*/


    /*
     *读取广告数据
     * */
    public function bannerData($where,$page,$limit){
        $per= ($page-1) * $limit;
        $data=Db::table('huhang_banner')
            ->join('huhang_admin','huhang_banner.ba_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_banner.ba_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_banner.ba_c_id = huhang_city.c_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('ba_order desc ,ba_isable')
            ->field('huhang_banner.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['mt_short_name']=Db::table('huhang_merchant')->where(['mt_id'=> $v['ba_m_id']])->column('mt_short_name');
            $data[$k]['ba_p_id']=$v['p_name'].'-'.$v['c_name'];
            $data[$k]['ba_img']=explode(',',$v['ba_img'])[0];
            $data[$k]['ba_updatetime']=date('Y-m-d H:i:s',$v['ba_updatetime']);
            $art_status=$v['ba_status'];
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
            $data[$k]['ba_status'] = $typeName;
        }
        return $data ? $data : null;
    }



    /*
     * 2.countWanted
     * */
    public function countBanner($where){
        $count=Db::table('huhang_banner')
            ->where($where)
            ->count();
        return  $count ? $count : 0;
    }


    /*
     * 3.findWanted
     * */
    public function findBanner($ba_id){
        $data=Db::table('huhang_banner')
            ->join('huhang_admin','huhang_banner.ba_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_banner.ba_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_banner.ba_c_id = huhang_city.c_id')
            ->where(['ba_id' => $ba_id])
            ->field('huhang_banner.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name')
            ->find();
        return $data ? $data : null;
    }

    /*
     * 4.addWanted
     * */
    public function addBanner($data){
        $add=Db::table('huhang_banner')->insert($data);
        return $add ? $add : null;
    }

    /*
     * 5.editWanted
     * */
    public function editBanner($data){
        $ba_id=$data['ba_id'];
        $update=Db::table('huhang_banner')->where(['ba_id' => $ba_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 6.delWanted
     * */
    public function delBanner($ba_id){
        $del=Db::table('huhang_banner')->where(['ba_id' => $ba_id])->delete();
        return $del ? true : false;
    }




    /*-----广告管理--------------------------------------------------------------------------------------------------------*/





















}