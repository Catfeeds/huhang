<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/20
 * Time: 9:18
 */
namespace app\admin\controller;
use app\admin\model\Commons;
use app\admin\model\Navm;
use app\admin\model\Setupm;
use think\Controller;
use think\Request;

class Nav extends Controller{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $userData=session('userData');
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
        $setupModel=new Setupm();
        $platName=$setupModel->findPlatName();
        $this->assign('platName',$platName[0]);
        $userData=session('userData');
        $adminRoleName=$setupModel->getAdminRoleName($userData['ad_role']);
        $this->assign('adminRoleName',$adminRoleName[0]);
        $adminUrl=$setupModel->findPlatUrl();
        $this->assign('adminUrl',$adminUrl);
        $commonModel=new Commons();
//        $ip=$_SERVER['REMOTE_ADDR'];
        $ip='117.36.76.230';
        $ipInfo=$commonModel->index($ip);
        $this->assign('ipInfo',$ipInfo['data']);
        $this->assign('adminData',$userData);
    }
    /*
     *
     * */
    public function nav(){
        $where=[
            'nav_type' => 1
            ,'nav_fid' => 0
        ];
        $navModel=new Navm();
        $navlist=$navModel->navData($where,1,20);
        $this->assign('navList',$navlist);
        return $this->fetch();
    }

    public function navm(){
        $where=[
            'nav_type' => 2
            ,'nav_fid' => 0
        ];
        $navModel=new Navm();
        $navlist=$navModel->navData($where,1,20);
        $this->assign('navList',$navlist);
        return $this->fetch();
    }


    /*
     * addNav
     * */
    public function addNav(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $navModel=new Navm();
        if($_POST){
            $data['nav_opeatime']=time();
            $data['nav_title']=trim($_POST['nav_title']);
            $data['nav_img']=trim($_POST['nav_img']);
            $data['nav_hover_img']=trim($_POST['nav_hover_img']);
            $data['nav_seo_title']=trim($_POST['nav_seo_title']);
            $data['nav_seo_keywords']=trim($_POST['nav_seo_keywords']);
            $data['nav_seo_desc']=trim($_POST['nav_seo_desc']);
            $data['nav_url']=trim($_POST['nav_url']);
            $data['nav_order']=intval(trim($_POST['nav_order']));
            $data['nav_isable']=intval(trim($_POST['nav_isable']));
            $data['nav_fid']=intval(trim($_POST['nav_fid']));
            $data['nav_type']=1;
            $data['nav_admin']=$admin_id;
            $add=$navModel->addNav($data);
            if($add){
                $this->success('添加成功','nav/nav',$_POST);
            }else{
                $this->error('添加失败','nav/nav',$_POST);
            }
        }else{
            $where=[
                'nav_type' => 1
                ,'nav_fid' => 0
            ];
            $fNav = $navModel->navData($where,1,20);
            $this->assign('faNav',$fNav);
            return $this->fetch();
        }
    }
    public function addNavm(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $navModel=new Navm();
        if($_POST){
            $data['nav_opeatime']=time();
            $data['nav_title']=trim($_POST['nav_title']);
            $data['nav_img']=trim($_POST['nav_img']);
            $data['nav_hover_img']=trim($_POST['nav_hover_img']);
            $data['nav_seo_title']=trim($_POST['nav_seo_title']);
            $data['nav_seo_keywords']=trim($_POST['nav_seo_keywords']);
            $data['nav_seo_desc']=trim($_POST['nav_seo_desc']);
            $data['nav_url']=trim($_POST['nav_url']);
            $data['nav_order']=intval(trim($_POST['nav_order']));
            $data['nav_isable']=intval(trim($_POST['nav_isable']));
            $data['nav_fid']=intval(trim($_POST['nav_fid']));
            $data['nav_type']=2;
            $data['nav_admin']=$admin_id;
            $add=$navModel->addNav($data);
            if($add){
                $this->success('添加成功','nav/navm');
            }else{
                $this->error('添加失败','nav/navm');
            }
        }else{
            $where=[
                'nav_type' => 2
                ,'nav_fid' => 0
            ];
            $fNav = $navModel->navData($where,1,20);
            $this->assign('faNav',$fNav);
            return $this->fetch();
        }
    }


    public function editNav(){
        $nav_id=intval(trim($_GET['nav_id']));
        $nav_fid=intval(trim($_GET['nav_fid']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $navModel=new Navm();
        if($_POST){
            $data['nav_id']=$nav_id;
            $data['nav_opeatime']=time();
            $data['nav_title']=trim($_POST['nav_title']);
            $data['nav_img'] = isset($_POST['nav_img'])?$_POST['nav_img']:'';
            $data['nav_hover_img'] = isset($_POST['nav_hover_img'])?$_POST['nav_hover_img']:'';
            $data['nav_seo_title']=trim($_POST['nav_seo_title']);
            $data['nav_seo_keywords']=trim($_POST['nav_seo_keywords']);
            $data['nav_seo_desc']=trim($_POST['nav_seo_desc']);
            $data['nav_url']=trim($_POST['nav_url']);
            $data['nav_order']=intval(trim($_POST['nav_order']));
            $data['nav_isable']=intval(trim($_POST['nav_isable']));
            $data['nav_fid']=intval(trim($_POST['nav_fid']));
            $data['nav_type']=1;
            $data['nav_admin']=$admin_id;
            $edit=$navModel->editNav($data);
            if($edit){
                $this->success('修改成功','nav');
            }else{
                $this->error('修改失败','nav');
            }
        }else{
            $navInfo=$navModel->findNav($nav_id);
            $this->assign('nav',$navInfo);
            $nav_f_info=$navModel->findNav($nav_fid);
            $this->assign('f_name',$nav_f_info['nav_title']);
            $this->assign('nav_fid',$nav_fid);
            return $this->fetch();
        }
    }
    public function editNavm(){
        $nav_id=intval(trim($_GET['nav_id']));
        $nav_fid=intval(trim($_GET['nav_fid']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $navModel=new Navm();
        if($_POST){
            $data['nav_id']=$nav_id;
            $data['nav_opeatime']=time();
            $data['nav_title']=trim($_POST['nav_title']);
            $data['nav_img'] = isset($_POST['nav_img'])?$_POST['nav_img']:'';
            $data['nav_hover_img'] = isset($_POST['nav_hover_img'])?$_POST['nav_hover_img']:'';
            $data['nav_seo_title']=trim($_POST['nav_seo_title']);
            $data['nav_seo_keywords']=trim($_POST['nav_seo_keywords']);
            $data['nav_seo_desc']=trim($_POST['nav_seo_desc']);
            $data['nav_url']=trim($_POST['nav_url']);
            $data['nav_order']=intval(trim($_POST['nav_order']));
            $data['nav_isable']=intval(trim($_POST['nav_isable']));
            $data['nav_fid']=intval(trim($_POST['nav_fid']));
            $data['nav_type']=2;
            $data['nav_admin']=$admin_id;
            $edit=$navModel->editNav($data);
            if($edit){
                $this->success('修改成功','nav');
            }else{
                $this->error('修改失败','nav');
            }
        }else{
            $navInfo=$navModel->findNav($nav_id);
            $this->assign('nav',$navInfo);
            $nav_f_info=$navModel->findNav($nav_fid);
            $this->assign('f_name',$nav_f_info['nav_title']);
            $this->assign('nav_fid',$nav_fid);
            return $this->fetch();
        }
    }

    /*
     * 删除导航
     * */
    public function delNav(){
        $nav_id=intval(trim($_GET['nav_id']));
        $navModel=new Navm();
        $del=$navModel->delNav($nav_id);
        if($del){
            $this->success('删除成功','nav');
        }else{
            $this->error('删除失败','nav');
        }
    }



    /*
     * status
     * */
    public function status(){
        $data['nav_id']=intval(trim($_POST['nav_id']));
        $data['nav_isable']=intval(trim($_POST['nav_isable']));
        $userData=session('userData');
        $data['nav_admin']=$userData['ad_id'];
        if(isset($data['nav_id']) && isset($data['nav_isable'])){
            $navModel=new Navm();
            $change=$navModel->editNav($data);
            if($data['nav_isable'] == 1){
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
     * 图片上传
     * */
    public function upload(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/nav');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/nav/".$path_date."/".$path_filename;
            // 成功上传后 返回上传信息
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            // 上传失败返回错误信息
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }
}