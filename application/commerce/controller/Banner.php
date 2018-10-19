<?php
/**
 * Name: 商户端-广告管理-controller
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 10:51
 */
namespace app\commerce\controller;
use app\commerce\model\Bannerm;
use think\Controller;
use think\Db;
use think\Request;

class Banner extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $userData=session('merInfo');
        if(empty($userData)){
            $this->redirect('login/login');
        }
        $expireTime=session('expiretime');
        if(isset($expireTime)) {
            if($expireTime < time()) {
                session(null);
                $this->error('您的登录身份已过期，请重新登录！','login/login');
            } else {
                session('expiretime',time() + 1800); // 刷新时间戳
            }
        }
    }
    public function index(){
        return $this->fetch();
    }
    /*
     * 商户广告数据
     * */
    public function bannerData(){
        $bannerModel=new Bannerm();
        $merInfo=session('merInfo');
        $where=[
            'ba_type' => 2
            ,'ba_m_id' =>$merInfo['mt_id']
        ];
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$bannerModel->bannerData($where,$page,$limit);
        $count=$bannerModel->countBanner($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }

    /*
     * addBanner
     * */

    public function addBanner(){
        $bannerModel=new Bannerm();
        $merInfo=session('merInfo');
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='ba_createtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$bannerModel->countBanner($where);
            //生成用户编号；
            $data['ba_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['ba_createtime']=time();
            $data['ba_updatetime']=time();
            $data['ba_status']=1;
            $data['ba_title']=trim($_POST['ba_title']);
            $data['ba_img']=trim($_POST['pc_img']).','.trim($_POST['ba_img']);
            $data['ba_alt']=trim($_POST['ba_alt']);
            $data['ba_url']=trim($_POST['ba_url']).','.trim($_POST['ba_url1']);
            $data['ba_p_id']=$merInfo['mt_p_id'];
            $data['ba_c_id']=$merInfo['mt_c_id'];
            $data['ba_m_id']=$merInfo['mt_id'];
            $data['ba_order']=intval(trim($_POST['ba_order']));
            $data['ba_type']=2;
            $add=$bannerModel->addBanner($data);
            if($add){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败','index');
            }
        }else{
            return $this->fetch();
        }
    }

    /*
     * reOrderBanner
     * */
    public function reOrderBanner(){
        $bannerModel=new Bannerm();
        $merInfo=session('merInfo');
        $data['ba_id']=intval(trim($_POST['ba_id']));
        $data['ba_order']=intval(trim($_POST['value']));
        $data['ba_admin']=$merInfo['mt_id'];
        $edit=$bannerModel->editBanner($data);
        if($edit){
            $this->success('修改排序成功','index');
        }else{
            $this->error('修改排序失败','index');
        }
    }



    public function editBanner(){
        $bannerModel=new Bannerm();
        $ba_id=intval(trim($_GET['ba_id']));
        if($_POST){
            $data['ba_id']=$ba_id;
            $data['ba_status']=1;
            $data['ba_title']=trim($_POST['ba_title']);
            $data['ba_img']=trim($_POST['pc_img']).','.trim($_POST['ba_img']);
            $data['ba_alt']=trim($_POST['ba_alt']);
            $data['ba_updatetime']=time();
            $data['ba_url']=trim($_POST['ba_url']).','.trim($_POST['ba_url1']);
            $data['ba_order']=intval(trim($_POST['ba_order']));
            $edit=$bannerModel->editBanner($data);
            if($edit){
                $this->success('修改成功','index');
            }else{
                $this->error('修改失败','index');
            }
        }else{
            $banner=$bannerModel->findBanner($ba_id);
            $banner['pc_img']=explode(',',$banner['ba_img'])[0]?explode(',',$banner['ba_img'])[0]:'';
            $banner['ba_img']=explode(',',$banner['ba_img'])[1]?explode(',',$banner['ba_img'])[1]:'';
            $banner['ba_url1']=explode(',',$banner['ba_url'])[1]?explode(',',$banner['ba_url'])[1]:'';
            $banner['ba_url']=explode(',',$banner['ba_url'])[0]?explode(',',$banner['ba_url'])[0]:'';
            $this->assign('banner',$banner);
            return $this->fetch();
        }
    }
    /*
     * delBanner
     * */
    public function delBanner(){
        $ba_id=intval(trim($_GET['ba_id']));
        $bannerModel=new Bannerm();
        $del=$bannerModel->delBanner($ba_id);
        if($del){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败','index');
        }
    }

    /*
     * articleStatus
     * */
    public function bannerStatus(){
        $bannerModel=new Bannerm();
        $merInfo=session('merInfo');
        $data['ba_admin']=$merInfo['mt_id'];
        $data['ba_id']=intval(trim($_GET['ba_id']));
        $data['ba_isable']=intval(trim($_GET['ba_isable']));
        if(isset($data['ba_id']) && isset($data['ba_isable'])){
            $change=$bannerModel->editBanner($data);
            if($data['ba_isable'] == 1){
                $msg='显示';
            }else{
                $msg='隐藏';
            }
            if($change){
                $res['code'] = 1;
                $res['msg'] = $msg.'成功！';
            }else{
                $res['code'] = 0;
                $res['msg'] = $msg.'失败！';
            }
        }else{
            $res['code'] = 0;
            $res['msg'] = '这是个意外！';
        }
        return $res;
    }


    /*
    * 商户端广告banner图片上传
    * */
    public function uploads(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/commerce/banner');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/commerce/banner/".$path_date."/".$path_filename;
            // 成功上传后 返回上传信息
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            // 上传失败返回错误信息
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }
}