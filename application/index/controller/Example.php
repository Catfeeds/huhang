<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 11:45
 * Name：平台端-项目案例
 */
namespace app\index\controller;
use app\admin\model\Platformm;
use app\admin\model\Setupm;
use app\index\model\Commo;
use app\index\model\Examplem;
use app\index\model\Indexm;
use think\Controller;
use think\Request;

class Example extends Controller{

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


        //友情链接
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
     * 项目案例
     * */
    public function index(){
        $city_id=session('city_id');
        $setModel=new Setupm();
        $where=[
            'type_sort' =>1
            ,'type_isable' =>1
        ];
        //项目类型
        $typeData=$setModel->typeData($where,'1','30');
        $this->assign('typeData',$typeData);

        //空间大小
        $whereSpace=[
            'sp_isable' => 1
        ];
        $space=$setModel->spaceData($whereSpace,'1','30');
        $this->assign('space',$space);
        //案例
        $exWhere=[
            'case_c_id' => $city_id
            ,'case_status' => 2
            ,'case_isable' => 1
        ];
        $eWhere='';
        if(isset($_GET['keys']) && $_GET['keys']){
            $keys=trim($_GET['keys']);
            $eWhere=$keys;
            $this->assign('keys',$eWhere);
        }
        $examModel=new Examplem();
        $example=$examModel->exampleDatas($exWhere,$eWhere,1,8);
        $this->assign('example',$example);
        return $this->fetch();
    }




    /*
     * 发布项目
     * */
    public function release(){
        $setModel=new Setupm();
        $where=[
            'type_sort' =>1
            ,'type_isable' =>1
        ];
        //项目类型
        $typeData=$setModel->typeData($where,'1','15');
        $this->assign('typeData',$typeData);
        //省份
        $wherep=[];
        $province=$setModel->provinceData($wherep,'1','50');
        $this->assign('prov',$province);
        //平台所有的预约总数；
        $indexModel=new Indexm();
        $allOrder=$indexModel->countAll();
        $this->assign('allOrder',$allOrder);
        return $this->fetch();
    }


    /*
     * 案例详情
     * */
    public function details(){
        $city_id=session('city_id');
        $caseModel=new Examplem();
        $c_id=$city_id;
        if(isset($_GET['case_id']) && $_GET['case_id']){
            $case_id=intval(trim($_GET['case_id']));
            $example=$caseModel->findExample($case_id);
            $caseModel->caseViewInc($case_id);
        }else{
            $topExample=$caseModel->exampleData($c_id);
            $example=$topExample[0];
            $caseModel->caseViewInc($example['case_id']);
        }
        $example['case_img']=explode(',',$example['case_img']);
        $example['case_updatetime']=date('Y-m-d H:i:s',$example['case_updatetime']);
        $this->assign('case',$example);

        $setModel=new Setupm();
        $where=[
            'type_sort' =>1
            ,'type_isable' =>1
        ];
        //项目类型
        $typeData=$setModel->typeData($where,'1','15');
        $this->assign('typeData',$typeData);
        //省份
        $wherep=[];
        $province=$setModel->provinceData($wherep,'1','50');
        $this->assign('prov',$province);
        //平台所有的预约总数；
        $indexModel=new Indexm();
        $allOrder=$indexModel->countAll();
        $this->assign('allOrder',$allOrder);
        return $this->fetch();
    }

}