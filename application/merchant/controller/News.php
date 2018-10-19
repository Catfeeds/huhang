<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/7
 * Time: 15:43
 * Name: 商家端-公司动态，文章类
 */
namespace app\merchant\controller;
use app\admin\model\Setupm;
use app\merchant\model\Commo;
use app\merchant\model\Indexm;
use think\Controller;
use think\Request;

class News extends Controller{
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
}