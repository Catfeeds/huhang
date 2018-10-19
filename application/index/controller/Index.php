<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 11:16
 * Name: 平台端-平台首页
 */
namespace app\index\controller;
use app\admin\model\Adminm;
use app\admin\model\Platformm;
use app\admin\model\Setupm;
use app\index\model\Commo;
use app\index\model\Indexm;
use think\Controller;
use think\Request;

class Index extends Controller{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        //要根据IP识别出城市，然后去确定是那个城市站，如果没有该城市站，则跳转到西安站。
//        $ip=$_SERVER['REMOTE_ADDR'];
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
        //

        //导航
        $comModel=new Commo();
        $navInfo=$comModel->merNav();
        $this->assign('navInfo',$navInfo);
    }


    public function indexs(){
        $setupModel=new Setupm();
        $city_id=session('city_id');
        $cityUrl=$setupModel->findBranchPrexViaCityId($city_id)[0];
        $adminUrl=$setupModel->findPlatUrl()[0];
        $this->redirect("http://".$cityUrl.".".$adminUrl,302);
    }


    /*
     * 分站首页
     * */
    public function index(){
        $city_id=session('city_id');
        $setModel=new Setupm();
        $where=[
            'type_sort' =>1
            ,'type_isable' =>1
        ];
        //项目类型
        $typeData=$setModel->typeData($where,'1','15');
        $this->assign('typeData',$typeData);



        //项目类型下的案例
        $m_c_id=$city_id;
        $indexModel=new Indexm();
        $typeCase=$indexModel->getTypeCase($m_c_id);
        foreach ($typeCase as $k =>  $v){
            foreach ($typeCase[$k]['type_case'] as $key =>$val){
                $typeCase[$k]['type_case'][$key]['case_img']=explode(',',$val['case_img'])[0];
                $typeCase[$k]['type_case'][$key]['case_img_alt']=explode(',',$val['case_img_alt'])[0];
            }
        }
        $this->assign('typeCase',$typeCase);


        //省份
        $wherep=[];
        $province=$setModel->provinceData($wherep,'1','50');
        $this->assign('prov',$province);

        //平台所有的预约总数；
        $allOrder=$indexModel->countAll();
        $this->assign('allOrder',$allOrder);

        //站点banner
        $whereb=[
            'ba_type' => 1
            ,'ba_c_id' => $city_id
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


        //商户logotop12
        $whereml=[
//            城市id 目前为西安
            'mt_c_id' =>$city_id
            ,'mt_status' => 1
        ];
        $adminModel=new Adminm();
        $merLogo=$adminModel->merchantData($whereml,'1','12');
        foreach ($merLogo as $k =>$v){
            $merLogo[$k]['mt_logo']=explode(',',$v['mt_logo'])[1];
        }
        $this->assign('merLogo',$merLogo);
        //商家top10，交钱了的，浏览量高的。
        $merTop=$adminModel->merchantData($whereml,'1','10');
        $this->assign('merTop',$merTop);
        //案例top10 ，先按交了钱的商家的浏览量排行。
        $whereEx=[];
        $example=$platModel->exampleData($whereEx,'1','10');
        $this->assign('topExample',$example);

        //行业新闻
        $whereNews=[
            'art_type' => 110
            ,'art_isable' => 1
            ,'art_status' => 2
            ,'art_c_id' =>$city_id
        ];
        $news=$platModel->articleData($whereNews,'1','10');
        $this->assign('news',$news);
        //行业新闻
        $whereind=[
            'art_type' => 111
            ,'art_isable' => 1
            ,'art_status' => 2
            ,'art_c_id' =>$city_id
        ];
        $industral=$platModel->articleData($whereind,'1','10');
        $this->assign('industral',$industral);

        //友情链接
        $setupModel=new Setupm();
        $wheref=[
            'fl_isable' =>1
            ,'fl_c_id' =>$city_id
        ];
        $friend=$setupModel->friendData($wheref,1,24);
        $this->assign('friend',$friend);

        //问答管理
        $qWhere=[
            'qa_c_id' => $city_id
            ,'qa_status' =>2
            ,'qa_isable' => 1
        ];
        $quest=$indexModel->questionasd($qWhere,1,10);
        $this->assign('quest',$quest);
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
            $data['cus_type'] = $fengge;
            $data['cus_provid'] = $_POST['cus_provid'];
            $data['cus_cityid'] = $_POST['cus_cityid'];
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





    public function suggestion(){
        $indexModel=new Indexm();
        if($_POST){
            $ip=$_SERVER['REMOTE_ADDR'];
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where="sg_addtime between ".$stime." and ".$etime." and sg_ip = '".$ip."'";
            //获取当日预约的数量
            $buNum=$indexModel->countSugIp($where);
            if($buNum>3){
                $this->error('您的操作过于频繁，请稍后重试！');
            }else{
                $data['sg_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
                $data['sg_addtime']=time();
                $data['sg_updatetime']=time();
                $data['sg_type']=$_POST['sg_type'];
                $data['sg_content']=$_POST['sg_content'];
                $data['sg_link']=$_POST['sg_link'];
                $data['sg_ip']=$ip;
                $add=$indexModel->addSuggest($data);
                if($add){
                    $this->success('您的投诉建议已提交！');
                }else{
                    $this->error('投诉失败！');
                }
            }
        }else{
            return $this->fetch();
        }
    }




    /*
     * 商户投标寻求合作
     *
     * */
    public function bidding(){
        $city_id=session('city_id');
        $indexModel=new Indexm();
        if($_POST){
            $data=$_POST;
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where="mo_addtime between ".$stime." and ".$etime;
            //获取当日预约的数量
            $buNum=$indexModel->countBid($where);
            $data['mo_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['mo_c_id']=$city_id;
            $data['mo_addtime']= time();
            $bidding=$indexModel->bidding($data);
            if($bidding){
                $this->success('投标成功！');
            }else{
                $this->error('投标失败！');
            }

        }
    }
}