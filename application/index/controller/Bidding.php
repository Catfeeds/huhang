<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 13:39
 * Name: 平台端-工装招标
 */
namespace app\index\controller;
use app\admin\model\Platformm;
use app\admin\model\Setinfom;
use app\admin\model\Setupm;
use app\index\model\Commo;
use app\index\model\Indexm;
use think\Controller;
use think\Request;

class Bidding extends Controller{
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
        //平台，名称
        $paltName=$setupModel->findPlatName();
        $this->assign('paltName',$paltName);
        //导航
        $comModel=new Commo();
        $navInfo=$comModel->merNav();
        $this->assign('navInfo',$navInfo);
    }
    public function index(){
        $city_id=session('city_id');
        //友情链接
        $setupModel=new Setupm();
        $wheref=[
            'fl_isable' =>1
            ,'fl_c_id' =>$city_id
        ];
        $friend=$setupModel->friendData($wheref,1,24);
        $this->assign('friend',$friend);

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
        return $this->fetch();
    }
}