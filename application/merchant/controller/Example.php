<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 15:40
 * Name: 商家端-发布项目，装修案例
 */
namespace app\merchant\controller;
use app\admin\model\Setupm;
use app\merchant\model\Commo;
use app\merchant\model\Companym;
use app\merchant\model\Examplem;
use app\merchant\model\Indexm;
use think\Controller;
use think\Request;
class Example extends Controller{
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
        /*获取用户设备和网络类型*/
        $agent = $_SERVER['HTTP_USER_AGENT'];
        //*获取用户设备
        $device = action('Common/Index/getOS',['user_agent' =>$agent]);
        session('device',$device);
        //网络类型
        $netType=action('Common/Index/getNetType',['Agent' =>$agent]);
        session('netType',$netType);
        $mt_id=session('mt_id');
        //根据商家id获取城市名称。
        $cityName=$comModel->getMerchantInfoViaMerId($mt_id);
        $this->assign('cityName',$cityName);
        $this->assign('mt_id',$mt_id);
        $platName=$setupModel->findPlatName();
        $this->assign('platName',$platName[0]);
    }

    /*
     *装修案例
     */
    public function index(){
        //案例图片，名称预算面积
        $mtId=session('mt_id');
        $mt_id=$mtId;
        $caseModel=new Examplem();
        $caseData=$caseModel->exampleData($mt_id);
        if($caseData){
            foreach($caseData as $k => $v){
                $caseData[$k]['case_img']=explode(',',$v['case_img'])[0];
                $caseData[$k]['case_img_alt']=explode(',',$v['case_img_alt'])[0];
            }
        }
        $mt_id=session('mt_id');
        $companyModel=new Companym();
        $merName=$companyModel->getCompanyName($mt_id);
        $this->assign('merName',$merName[0]);
        $this->assign('caseData',$caseData);
        return $this->fetch();
    }


    /*
     *
     * 案例详情
     */
    public function details(){
        $caseModel=new Examplem();
        $mtId=session('mt_id');
        $mt_id=$mtId;
        if(isset($_GET['case_id']) && $_GET['case_id']){
            $case_id=intval(trim($_GET['case_id']));
            $example=$caseModel->findExample($case_id);
            $caseModel->caseViewInc($case_id);
        }else{
            $topExample=$caseModel->exampleData($mt_id);
            $example=$topExample[0];
            $caseModel->caseViewInc($example['case_id']);
        }
        if($example){
            $example['case_img']=explode(',',$example['case_img']);
        }else{
            $example=$caseModel->getExample('');
            $example=$example[0];
            $example['case_img']=explode(',',$example['case_img']);
        }
        $this->assign('example',$example);
        $mt_id=session('mt_id');
        $companyModel=new Companym();
        $merName=$companyModel->getCompanyName($mt_id);
        $this->assign('merName',$merName[0]);
        return $this->fetch();
    }


    /*
     *
     * 发布项目
     */
    public function release(){
        $caseModel=new Examplem();
        $companyModel=new Companym();
        $proType=$caseModel->proType();
        $this->assign('proType',$proType);
        //推荐的12家公司
        $merchant=$caseModel->topMerchant(['mt_c_id' => 56],'1','12');
        $this->assign('merchant',$merchant);
        $mt_id=session('mt_id');
        $merName=$companyModel->getCompanyName($mt_id);
        $this->assign('merName',$merName[0]);
        return $this->fetch();
    }













}