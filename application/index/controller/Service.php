<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 14:02
 * Name：平台端-服务保障
 */
namespace app\index\controller;
use app\admin\model\Adminm;
use app\admin\model\Platformm;
use app\admin\model\Setupm;
use app\index\model\Commo;
use app\index\model\Indexm;
use think\Controller;
use think\Request;

class Service extends Controller{

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

        //优秀商家
        $whereml=[
//            城市id 目前为西安
            'mt_c_id' =>$city_id
            ,'mt_status' => 1
        ];
        $adminModel=new Adminm();
        $merLogo=$adminModel->merchantData($whereml,'1','18');
        foreach ($merLogo as $k =>$v){
            $merLogo[$k]['mt_logo']=explode(',',$v['mt_logo'])[1];
        }
        $this->assign('merLogo',$merLogo);


        //本地优秀案例
        $platModel=new Platformm();
        $exWhere=[
            'case_c_id' => $city_id
            ,'case_status' => 2
            ,'case_isable' => 1
        ];
        $superCase=$platModel->exampleData($exWhere,1,8);
        $this->assign('superCase',$superCase);
        return $this->fetch();
    }
}