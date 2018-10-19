<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 13:51
 * Name: 平台端-新闻资讯
 */
namespace app\index\controller;
use app\admin\model\Platformm;
use app\admin\model\Setupm;
use app\index\model\Commo;
use app\index\model\Indexm;
use app\index\model\Newsm;
use think\Controller;
use think\Request;

class News extends Controller{


    public function __construct(Request $request = null)
    {
        parent::__construct($request);



        //$ip=$_SERVER['REMOTE_ADDR'];
        $ip='117.36.76.230';
        $result = action('Common/Getip/index',['ip' =>$ip]);
        $result=$result['data'];
        $ipCity=$result['city'];
        //根据城市名称去选择要跳转的站；
        $indexModel=new Indexm();
        $cityId=$indexModel->getCityIdViaCityName($ipCity);
        session('city_id',$cityId[0]);
        $city_id=session('city_id');


        $setupModel=new Setupm();
        $wheref=[
            'fl_isable' =>1
            ,'fl_c_id' =>$city_id
        ];
        $friend=$setupModel->friendData($wheref,1,24);
        $this->assign('friend',$friend);
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
        //平台，名称
        $paltName=$setupModel->findPlatName();
        $this->assign('paltName',$paltName);
        //导航
        $comModel=new Commo();
        $navInfo=$comModel->merNav();
        $this->assign('navInfo',$navInfo);
    }


    /*
     * 本地资讯
     * */
    public function index(){
        $city_id=session('city_id');
        $setupModel=new Setupm();
        $where=[
            'type_sort' =>1
            ,'type_isable' =>1
        ];
        //项目类型
        $typeData=$setupModel->typeData($where,'1','30');
        $this->assign('typeData',$typeData);

        //省份
        $wherep=[];
        $province=$setupModel->provinceData($wherep,'1','50');
        $this->assign('prov',$province);
        //平台所有的预约总数；
        $indexModel=new Indexm();
        $allOrder=$indexModel->countAll();
        $this->assign('allOrder',$allOrder);
        //大家都在看项目案例top5
        $where=[];
        $platModel=new Platformm();
        $case=$platModel->exampleData($where,'1','5');
        $this->assign('caseInfo',$case);
        //文章分类
        $wheret=[
            'type_sort' => 4
        ];
        $artType=$setupModel->typeData($wheret,'1','30');
        //文章咨询
        $wherea=[
            'art_isable' =>1
            ,'art_status' =>2
            ,'art_c_id' => $city_id
        ];
        $article=$platModel->articleData($wherea,'1','8');
        $this->assign('article',$article);
        foreach ($artType as $k => $v){
            $wherea['art_type']=$v['type_id'];
            $artType[$k]['article_content']=$platModel->articleData($wherea,'1','8');
        }
        $this->assign('artType',$artType);
        return $this->fetch();
    }




    /*
     * 资讯详情
     * */
    public function details(){
        $platModel=new Platformm();
        $newsModel=new Newsm();
        if($_GET){
            $art_id=intval(trim($_GET['art_id']));
            $article=$platModel->findArticle($art_id);
            //浏览量加一
            $newsModel->articleViewInc($art_id);
        }else{
            $topArticle=$platModel->articleData([],1,1);
            $article=$topArticle[0];
            $newsModel->articleViewInc($article['art_id']);
        }
        $this->assign('article',$article);

        $setupModel=new Setupm();
        $where=[
            'type_sort' =>1
            ,'type_isable' =>1
        ];
        //项目类型
        $typeData=$setupModel->typeData($where,'1','30');
        $this->assign('typeData',$typeData);

        //省份
        $wherep=[];
        $province=$setupModel->provinceData($wherep,'1','50');
        $this->assign('prov',$province);
        //平台所有的预约总数；
        $indexModel=new Indexm();
        $allOrder=$indexModel->countAll();
        $this->assign('allOrder',$allOrder);
        //大家都在看项目案例top5
        $where=[];
        $case=$platModel->exampleData($where,'1','5');
        $this->assign('caseInfo',$case);
        return $this->fetch();
        //导航
        $comModel=new Commo();
        $navInfo=$comModel->merNav();
        $this->assign('navInfo',$navInfo);
    }





}

