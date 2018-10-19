<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 15:39
 * Name: 商家端-公司简介，荣誉资质，关于我们
 */
namespace app\merchant\controller;
use app\admin\model\Setupm;
use app\merchant\model\Commo;
use app\merchant\model\Companym;
use app\merchant\model\Indexm;
use think\Controller;
use think\Request;

class Company extends Controller{


    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $setupModel=new Setupm();
        $weChat=$setupModel->findPlatWechat();
        $this->assign('weChat',$weChat[0]);
        $hotLine=$setupModel->findPlatHotLine();
        $this->assign('hotLine',$hotLine[0]);
        $weiBo=$setupModel->findWeiBo();
        $this->assign('weiBo',$weiBo[0]);
        $address=$setupModel->findPlatAddress();
        $this->assign('address',$address[0]);
        $record=$setupModel->findPlatRecord();
        $this->assign('record',$record[0]);
        $company=$setupModel->findPlatCompany();
        $this->assign('company',$company[0]);
        $mtId=session('mt_id');
        $indexModel=new Indexm();
        //商户端的友情链接，显示该商户所在的城市的优秀链接
        $c_id=$indexModel->getCityIdViaMerId($mtId);
        //友情链接
        $wheref=[
            'fl_isable' =>1
            ,'fl_c_id' =>$c_id[0]
            ,'fl_status' =>2
        ];
        $friend=$setupModel->friendData($wheref,1,24);
        $this->assign('friend',$friend);
        $where=[
            'type_sort' =>1
            ,'type_isable' =>1
        ];
        //项目类型
        $typeData=$setupModel->typeData($where,'1','15');
        $this->assign('typeData',$typeData);

        //省份
        $wherep=[];
        $province=$setupModel->provinceData($wherep,'1','50');
        $this->assign('prov',$province);

        $comModel=new Commo();
        $navInfo=$comModel->merNav();
        $this->assign('navInfo',$navInfo);
        $mt_id=session('mt_id');
        //根据商家id获取城市名称。
        $cityName=$comModel->getMerchantInfoViaMerId($mt_id);
        $this->assign('cityName',$cityName);
        $this->assign('mt_id',$mt_id);
        $platName=$setupModel->findPlatName();
        $this->assign('platName',$platName[0]);
    }
    /*
     * 公司简介
     * */
    public function profile(){
        $mt_id=intval(trim($_GET['mt_id']));
        //$mt_id=session('mt_id');
        $companyModel=new Companym();
        $profile=$companyModel->getCompanyProfile($mt_id);
        $merName=$companyModel->getCompanyName($mt_id);
        $this->assign('merName',$merName[0]);
        $this->assign('profile',$profile[0]);
        return $this->fetch();
    }



    /*
     * 公司动态-列表
     * */
    public function news(){
        $mt_id=session('mt_id');
        $companyModel=new Companym();
        $where=[
            'art_isable' => 1
            ,'art_status' => 2
            ,'art_m_id' =>$mt_id
        ];
        $article=$companyModel->articleData($where,'1','8');
        $this->assign('article',$article);
        $merName=$companyModel->getCompanyName($mt_id);
        $this->assign('merName',$merName[0]);
        return $this->fetch();
    }




    /*
    * 公司动态-详情
    * */
    public function details(){
        $mt_id=session('mt_id');
        $companyModel=new Companym();
        if($_GET){
            $art_id=intval(trim($_GET['art_id']));
            $article=$companyModel->findArticle($art_id);
            $companyModel->articleViewInc($art_id);
        }else{
            $topArticle=$companyModel->articleData([],1,1);
            $article=$topArticle[0];
            $companyModel->articleViewInc($article['art_id']);
        }
        $merName=$companyModel->getCompanyName($mt_id);
        $this->assign('merName',$merName[0]);
        $this->assign('article',$article);
        return $this->fetch();
    }


    /*
    * 荣誉资质
    * */
    public function honor(){
        $mt_id=intval(trim($_GET['mt_id']));
        //获取该商家的荣誉资质
        $conpanyModel=new Companym();
        //$mt_sid=session('mt_id');
        $honors=$conpanyModel->getHonor($mt_id);
        $this->assign('honors',$honors);
        $mt_id=session('mt_id');
        $companyModel=new Companym();
        $merName=$companyModel->getCompanyName($mt_id);
        $this->assign('merName',$merName[0]);
        return $this->fetch();
    }

    /*
    * 关于我们
    * */
    public function about(){
        $mt_id=session('mt_id');
        $companyModel=new Companym();
        //根据商户id获取商户信息
        $merInfo=$companyModel->getConpanyInfo($mt_id);
        $this->assign('merInfo',$merInfo);
        return $this->fetch();
    }
}