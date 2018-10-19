<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 15:41
 * Name: 商家端-人才招聘
 */
namespace app\merchant\controller;
use app\admin\model\Setupm;
use app\merchant\model\Commo;
use app\merchant\model\Companym;
use app\merchant\model\Indexm;
use app\merchant\model\Wantedm;
use think\Controller;
use think\Request;

class Wanted extends Controller{

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
        $mt_id=session('mt_id');
        $indexModel=new Indexm();
        //商户端的友情链接，显示该商户所在的城市的优秀链接
        $c_id=$indexModel->getCityIdViaMerId($mt_id);
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
     *人才招聘列表
     *
     * */
    public function index(){
        $mt_id=session('mt_id');
        $wantedModel= new Wantedm();
        $wanted=$wantedModel->wantedData($mt_id);
        if($wanted){
            foreach($wanted as $k => $v){
                $wanted[$k]['wt_addtime'] = date('Y-m-d',$v['wt_addtime']);
                $wanted[$k]['wt_deadline'] = date('Y-m-d',$v['wt_deadline']);
            }
        }
        $this->assign('wanted',$wanted);
        $companyModel=new Companym();
        $merName=$companyModel->getCompanyName($mt_id);
        $this->assign('merName',$merName[0]);
        return $this->fetch();
    }

    /*
     *人才招聘详情
     *
     * */
    public function details(){
        $mt_id=session('mt_id');
        $wantModel=new Wantedm();
        if($_GET){
            $wt_id=intval(trim($_GET['wt_id']));
            $wanted=$wantModel->findWanted($wt_id);
        }else{
            $topArticle=$wantModel->wantedData($mt_id);
            $wanted=$topArticle[0];
        }
        $wanted['wt_addtime'] = date('Y-m-d',$wanted['wt_addtime']);
        $wanted['wt_deadline'] = date('Y-m-d',$wanted['wt_deadline']);
        $this->assign('wanted',$wanted);
        $companyModel=new Companym();
        $merName=$companyModel->getCompanyName($mt_id);
        $this->assign('merName',$merName[0]);
        return $this->fetch();
    }



    /*
     * 投诉建议
     * **/
    public function suggestion(){
        $wantModel=new Wantedm();
        if($_POST){
            $ip=$_SERVER['REMOTE_ADDR'];
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where="sg_addtime between ".$stime." and ".$etime." and sg_ip = '".$ip."'";
            //获取当日预约的数量
            $buNum=$wantModel->countSugIp($where);
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
                $add=$wantModel->addSuggest($data);
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

}