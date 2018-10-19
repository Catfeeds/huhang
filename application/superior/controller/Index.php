<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/26
 * Time: 13:47
 */
namespace app\superior\controller;
use app\admin\model\Setupm;
use app\superior\model\Indexs;
use think\Controller;
use think\Request;

class Index extends Controller{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $setupModel=new Setupm();
        $weChat=$setupModel->findPlatWechat();
        $this->assign('weChat',$weChat[0]);
    }

    /*
     * 首页
     * */
    public function index(){
        $mt_id = intval(trim(input('mt_id')));
        $indexModel=new Indexs();
        $merchant=$indexModel->getMerchantInfoViaMtId($mt_id);
        session('merchant',$merchant);
        $this->assign('merchant',$merchant);
        //banner
        $whereB=[
            'ba_type' => 2
            ,'ba_m_id' =>$mt_id
            ,'ba_status' =>1
        ];
        $banner=$indexModel->bannerData($whereB);
        $this->assign('banner',$banner);
        //6个案例
        $whereC=[
            'case_status' => 2
            ,'case_isable' => 1
            ,'case_m_id' => $mt_id
        ];
        $order="case_istop,case_view desc";
        $caseInfo=$indexModel->exampleData($whereC,1,6,$order);
        foreach($caseInfo as $k => $v){
            $caseInfo[$k]['case_img']=explode(',',$v['case_img'])[0];
        }
        $this->assign('caseInfo',$caseInfo);


        //3个新闻

        $where=[
            'art_status' => 2
            ,'art_isable' => 1
            ,'art_m_id' => $mt_id
        ];
        $article=$indexModel->articleData($where,1,4);
        foreach ($article as $k => $v){
            $article[$k]['art_subtitle']=mb_strlen($v['art_subtitle'])>45?mb_substr($v['art_subtitle'],0,45).'...':$v['art_subtitle'];
        }
        $this->assign('article',$article);
        return $this->fetch();
    }


    /*
     * 关于我们
     * */

    public function about(){
        $url=url('superior/index/index',['mt_id' => 2]);
        $this->assign('indexUrl',$url);
        $merchant=session('merchant');
        $this->assign('merchant',$merchant);
        return $this->fetch();
    }

    /*
     * 设计团队
     * */
    public function designer(){
        $merchant=session('merchant');
        $this->assign('merchant',$merchant);
        return $this->fetch();
    }

    /*
     * 案例列表
     * */
    public function example(){
        $indexModel=new Indexs();
        $merchant=session('merchant');
        $mt_id=$merchant['mt_id'];
        $this->assign('merchant',$merchant);
        //6个案例
        $whereC=[
            'case_status' => 2
            ,'case_isable' => 1
            ,'case_m_id' => $mt_id
        ];
        $order="case_istop,case_view desc";
        $caseInfo=$indexModel->exampleData($whereC,1,9,$order);
        if($caseInfo){
            foreach($caseInfo as $k => $v){
                $caseInfo[$k]['case_img']=explode(',',$v['case_img'])[0];
            }
        }
        $this->assign('caseInfo',$caseInfo);
        return $this->fetch();
    }

    /*
     * 新闻资讯
     * */
    public function news(){
        $merchant=session('merchant');
        $mt_id=$merchant['mt_id'];
        $this->assign('merchant',$merchant);
        //6个新闻
        $where=[
            'art_status' => 2
            ,'art_isable' => 1
            ,'art_m_id' => $mt_id
            ,'art_type' => 110
        ];
        $indexModel=new Indexs();
        $article=$indexModel->articleData($where,1,6);
        if($article){
            foreach ($article as $k => $v){
                $article[$k]['art_subtitle']=mb_strlen($v['art_subtitle'])>45?mb_substr($v['art_subtitle'],0,45).'...':$v['art_subtitle'];
            }
        }
        $this->assign('article',$article);
        return $this->fetch();
    }


    /*
     * 企业招聘
     * */
    public function wanted(){
        $merchant=session('merchant');
        $this->assign('merchant',$merchant);
        return $this->fetch();
    }


    /*
     * 联系我们
     * */
    public function contact(){
        $merchant=session('merchant');
        $this->assign('merchant',$merchant);
        return $this->fetch();
    }

    /*
     * 设计流程
     * */
    public function step(){
        $merchant=session('merchant');
        $this->assign('merchant',$merchant);
        return $this->fetch();
    }

    /*
     * 公司动态
     * */
    public function company(){
        $merchant=session('merchant');
        $mt_id=$merchant['mt_id'];
        $this->assign('merchant',$merchant);
        //6个新闻
        $indexModel=new Indexs();
        $where=[
            'art_status' => 2
            ,'art_isable' => 1
            ,'art_m_id' => $mt_id
            ,'art_type' => 111
        ];
        $article=$indexModel->articleData($where,1,6);
        if($article){
            foreach ($article as $k => $v){
                $article[$k]['art_subtitle']=mb_strlen($v['art_subtitle'])>45?mb_substr($v['art_subtitle'],0,45).'...':$v['art_subtitle'];
            }
        }
        $this->assign('article',$article);
        return $this->fetch();
    }
    /*
     * 文章详情
     * */
    public function details(){
        $merchant=session('merchant');
        $mt_id=$merchant['mt_id'];
        $this->assign('merchant',$merchant);
        $indexModel=new Indexs();
        $art_id=intval(trim(input('art_id')));
        if(isset($art_id) && $art_id){
            $article=$indexModel->findArticle($art_id);
            $indexModel->artViewInc($art_id);
        }else{
            $where=[
                'art_status' => 2
                ,'art_isable' => 1
                ,'art_m_id' => $mt_id
            ];
            $top=$indexModel->articleData($where,1,1);
            $article=$top[0];
            $art_id=$article['art_id'];
            $indexModel->artViewInc($article['art_id']);
        }
        $artId=$art_id;
        $createTime=$article['art_createtime'];



        //上一篇 and 下一篇
        $whereP='art_m_id = '.$mt_id.' and art_status = 2 and art_isable = 1 and art_id != '.$artId.' and art_createtime < '.$createTime;
        $preArt=$indexModel->articleData($whereP,1,1);
        if($preArt){
            $this->assign('preArt',$preArt[0]);
        }else{
            $preArt['art_id']=0;
            $preArt['art_title']="没有上一篇了！";
            $this->assign('preArt',$preArt);
        }
        $whereN='art_m_id = '.$mt_id.' and art_status = 2 and art_isable = 1 and art_id != '.$artId.' and art_createtime > '.$createTime;
        $nextArt=$indexModel->articleData($whereN,1,1);
        if($nextArt){
            $this->assign('nextArt',$nextArt[0]);
        }else{
            $nextArt['art_id']=0;
            $nextArt['art_title']="这是最后一篇！";
            $this->assign('nextArt',$nextArt);
        }
        $article['art_updatetime']=date('Y-m-d',$article['art_updatetime']);
        $this->assign('article',$article);
        return $this->fetch();
    }
    /*
     * 案例详情
     * */
    public function detail(){
        echo url('superior/index/details',['case_id' => 12]);
        $indexModel=new Indexs();
        $merchant=session('merchant');
        $mt_id=$merchant['mt_id'];
        $this->assign('merchant',$merchant);
        $case_id=intval(trim(input('case_id')));
        if(isset($case_id) && $case_id){
            $example=$indexModel->findExample($case_id);
            $indexModel->caseViewInc($case_id);
        }else{
            $where=[
                'case_status' => 2
                ,'case_isable' => 1
                ,'case_m_id' => $mt_id
            ];
            $order="case_istop,case_view desc";
            $top=$indexModel->exampleData($where,1,1,$order);
            $example=$top[0];
            $case_id=$example['case_id'];
            $indexModel->caseViewInc($case_id);
        }
        $example['case_img']=explode(',',$example['case_img']);
        $createTime=$example['case_decotime'];
        //上一篇 and 下一篇
        $orders='case_decotime desc';
        $whereP='case_m_id = '.$mt_id.' and case_status = 2 and case_isable = 1 and case_m_id = '.$mt_id.' and case_id != '.$case_id.' and case_decotime < '.$createTime;
        $preArt=$indexModel->exampleData($whereP,1,1,$orders);
        if($preArt){
            $this->assign('preArt',$preArt[0]);
        }else{
            $preArt['case_id']=0;
            $preArt['art_title']="没有上一篇了！";
            $this->assign('preArt',$preArt);
        }
        $whereN='case_m_id = '.$mt_id.' and case_status = 2 and case_isable = 1 and case_m_id = '.$mt_id.' and case_id != '.$case_id.' and case_decotime > '.$createTime;
        $nextArt=$indexModel->exampleData($whereN,1,1,$orders);
        if($nextArt){
            $this->assign('nextArt',$nextArt[0]);
        }else{
            $nextArt['case_id']=0;
            $nextArt['art_title']="这是最后一篇！";
            $this->assign('nextArt',$nextArt);
        }
        $this->assign('example',$example);
        return $this->fetch();
    }
}