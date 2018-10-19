<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 15:39
 * Name: 商家端-首页
 */
namespace app\merchant\controller;
use app\admin\model\Platformm;
use app\admin\model\Setupm;
use app\merchant\model\Commo;
use app\merchant\model\Indexm;
use think\Controller;
use think\Request;

class Index extends Controller{

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
        //导航
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

    public function indexs(){
        $mtId=intval(trim($_GET['mt_id']));
        $indexModel=new Indexm();
        //根据商户id查找商户模板
        $meTemp=$indexModel->getMerTempViaMtId($mtId);
        $temp=$meTemp[0];
        //url($temp.'/index/index',['mt_id' => 2]);
        $this->redirect($temp.'/index/index',['mt_id' => 2]);
    }

    /*
     * 商家端-首页
     * */
    public function index(){
        $mtId=intval(trim($_GET['mt_id']));
        $indexModel=new Indexm();
        session('mt_id',$mtId);
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
        //类型案例
        $mt_id=$mtId;
        $this->assign('mt_id',$mt_id);
        $typeCase=$indexModel->getTypeCase($mt_id);
        foreach ($typeCase as $k =>  $v){
            foreach ($typeCase[$k]['type_case'] as $key =>$val){
                $typeCase[$k]['type_case'][$key]['case_img']=explode(',',$val['case_img'])[0];
                $typeCase[$k]['type_case'][$key]['case_img_alt']=explode(',',$val['case_img_alt'])[0];
            }
        }
        $this->assign('typeCase',$typeCase);
        //平台所有的预约总数；
        $indexModel=new Indexm();
        $allOrder=$indexModel->countAll();
        $this->assign('allOrder',$allOrder);
        //商家banner
        $whereb=[
            'ba_type' => 2
            ,'ba_m_id' => $mtId
            ,'ba_isable' => 1
            ,'ba_status' => 2
        ];
        $platModel=new Platformm();
        $banner=$platModel->bannerData($whereb,'1','15');
        if($banner){
            foreach($banner as $k => $v){
                $banner[$k]['ba_url']=explode(',',$v['ba_url'])[0];
            }
        }
        $this->assign('banner',$banner);

        //行业新闻
        $whereNews=[
            'art_type' => 110
            ,'art_isable' => 1
            ,'art_status' => 2
            ,'art_m_id' =>$mtId
        ];
        $news=$platModel->articleData($whereNews,'1','5');
        $this->assign('news',$news);
        //行业新闻
        $whereind=[
            'art_type' => 111
            ,'art_isable' => 1
            ,'art_status' => 2
            ,'art_m_id' =>$mtId
        ];
        $industral=$platModel->articleData($whereind,'1','5');
        $this->assign('industral',$industral);


        //商户端的友情链接，显示该商户所在的城市的优秀链接
        $c_id=$indexModel->getCityIdViaMerId($mtId);
        //友情链接
        $wheref=[
            'fl_isable' =>1
            ,'fl_c_id' =>$c_id[0]
            ,'fl_status' =>2
        ];
        $friend=$setModel->friendData($wheref,1,24);
        $this->assign('friend',$friend);
        return $this->fetch();
    }

    /*
     * 客户预约
     * */
    public function point(){
        $indexModel=new Indexm();
        $commonModel=new Commo();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='cus_opptime > '.$stime.' and cus_opptime < '.$etime;
            //获取当日预约的数量
            $cusNum=$indexModel->countCus($where);
            //生成用户编号；
            $data['cus_bid'] = date('Ymd').sprintf("%04d", $cusNum+1);
            $referUrl=$_POST['refer'];
            $data['cus_keywords']=$commonModel->saveKeyword($referUrl,$referUrl);
            $data['cus_link'] = $_POST['cus_link'];
            $data['cus_position'] = $_POST['cus_position'];
            $data['cus_phone'] = $_POST['cus_phone'];
            $cus_name="";
            if(isset($_POST['cus_name']) && $_POST['cus_name'] != ""){
                $cus_name=$_POST['cus_name'];
            }
            $data['cus_name'] = $cus_name;
            $cus_isrent="";
            if(isset($_POST['cus_isrent']) && $_POST['cus_isrent'] != ""){
                $cus_isrent=$_POST['cus_isrent'];
            }
            $data['cus_isrent'] = $cus_isrent;
            //房屋面积
            $area="";
            if(isset($_POST['cus_area']) && $_POST['cus_area'] != ""){
                $area=$_POST['cus_area'];
            }
            $data['cus_area'] = $area;
            //项目类型
            $fengge="";
            if(isset($_POST['cus_type']) && $_POST['cus_type'] != ""){
                $fengge=intval($_POST['cus_type']);
            }
            $data['cus_provid'] = $_POST['cus_provid'];
            $data['cus_cityid'] = $_POST['cus_cityid'];
            $data['cus_type'] = $fengge;
            $data['cus_from'] = $_POST['cus_from'];
            $data['cus_device']=session('device');
            $data['cus_net_type']=session('netType');
            $data['cus_origin'] = $_POST['cus_origin'];
            $data['cus_ip'] = $_POST['cus_ip'];
            $data['cus_opptime'] = time();
            //判断当前用户是否用重复提交\\
            $where.=" and cus_phone = ".$_POST['cus_phone']." and cus_ip = '".$data['cus_ip']."'";
            $isRepeat=$indexModel->countCus($where);
            if($isRepeat){
                $this->error('您已预约，请勿重复提交！');
            }else{
                $makePoint=$indexModel->makePoint($data);
                if($makePoint){
                    return  json(['code' => '1','msg' => '预约成功！','data' =>$data]);
                }else{
                    return  json(['code' => '0','msg' => '预约失败！','data' =>$data]);
                }
            }
        }
    }




}