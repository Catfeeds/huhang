<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 14:07
 * Name: 平台端-装修公司
 */
namespace app\index\controller;
use app\admin\model\Adminm;
use app\admin\model\Platformm;
use app\admin\model\Setupm;
use app\index\model\Commo;
use app\index\model\Compay;
use app\index\model\Indexm;
use think\Controller;
use think\Db;
use think\Request;

class Company extends Controller{

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
     * 装修公司
     * */
    public function index(){
        $city_id=session('city_id');
        $setupModel=new Setupm();
        $where=[
            'type_sort' =>1
            ,'type_isable' =>1
        ];
        $typeData=$setupModel->typeData($where,'1','30');
        $this->assign('typeData',$typeData);
        $wheref=[
            'fl_isable' =>1
            ,'fl_c_id' =>$city_id
        ];
        $friend=$setupModel->friendData($wheref,1,24);
        $this->assign('friend',$friend);
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


        //装修公司
        $whereml=[
//            城市id 目前为西安
            'mt_c_id' =>$city_id
            ,'mt_status' => 1
        ];
        $conpanyModel=new Compay();
        $merchant=$conpanyModel->merchantData($whereml,'1','6');
        foreach ($merchant as $k => $v){
            $service='';
            if(is_array($merchant[$k]['service_id']) && $merchant[$k]['service_id']){
                for($i = 0; $i < count($merchant[$k]['service_id']); $i++){
                    $merchant[$k]['service_id'][$i]=Db::table('huhang_service_type')
                        ->where(['st_isable' => 1 ,'st_id' =>$merchant[$k]['service_id'][$i]])
                        ->column('st_name');
                    $service.=$merchant[$k]['service_id'][$i][0].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                }
            }
            $merchant[$k]['service_id']=$service;
            $merchant[$k]['mt_logo']=explode(',',$v['mt_logo'])[0];
        }
        $this->assign('merchant',$merchant);
        $currentTime=time();
        $this->assign('current',$currentTime);


        return $this->fetch();

    }
}