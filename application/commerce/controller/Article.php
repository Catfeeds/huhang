<?php
/**
 * Name: 商户端-文章管理-controller
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/30
 * Time: 10:47
 */
namespace app\commerce\controller;
use app\commerce\model\Articlem;
use think\Controller;
use think\Db;
use think\Request;

class Article extends Controller
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


    public function articleData(){
        $articleModel=new Articlem();
        $merInfo=session('merInfo');
        $where=[
            'art_m_id' =>$merInfo['mt_id']
        ];
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $typeData=$articleModel->articleData($where,$page,$limit);
        $count=$articleModel->countArticle($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $typeData;
        $res['count'] = $count;
        return json($res);
    }

    /*
     * addArticle
     * */
    public function addArticle(){
        $articleModel=new Articlem();
        $merInfo=session('merInfo');
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='art_createtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$articleModel->countArticle($where);
            //生成用户编号；
            $data['art_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['art_title']=trim($_POST['art_title']);
            $data['art_keywords']=trim($_POST['art_keywords']);
            $data['art_subtitle']=trim($_POST['art_subtitle']);
            $data['art_keywords']=trim($_POST['art_keywords']);
            $data['art_img_alt']=trim($_POST['art_img_alt']);
            $data['art_img']=trim($_POST['art_img']);
            $data['art_content']=trim($_POST['art_content']);
            $data['art_p_id']=$merInfo['mt_p_id'];
            $data['art_c_id']=$merInfo['mt_c_id'];
            $data['art_m_id']=$merInfo['mt_id'];
            $data['art_type']=intval(trim($_POST['art_type']));
            $data['art_istop']=intval(trim($_POST['art_istop']));
            $data['art_createtime']=time();
            $data['art_updatetime']=time();
            $data['art_status']=1;
            $data['art_isable']=1;
            $data['art_admin']=$merInfo['mt_id'];
            $add=$articleModel->addArticle($data);
            if($add){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败','index');
            }
        }else{
            //文章类型
            $where=[
                'type_sort' => 4
            ];
            $typeData=$articleModel->typeData($where,'1','15');
            $this->assign('typeData',$typeData);
            return $this->fetch();
        }
    }

    /*
     * editArticle
     * */
    public function editArticle(){
        $art_id=intval(trim($_GET['art_id']));
        $articleModel=new Articlem();
        if($_POST){
            $data['art_id']=$art_id;
            $data['art_title']=trim($_POST['art_title']);
            $data['art_keywords']=trim($_POST['art_keywords']);
            $data['art_subtitle']=trim($_POST['art_subtitle']);
            $data['art_keywords']=trim($_POST['art_keywords']);
            $data['art_img_alt']=trim($_POST['art_img_alt']);
            $data['art_img']=trim($_POST['art_img']);
            $data['art_content']=trim($_POST['art_content']);
            $data['art_type']=intval(trim($_POST['art_type']));
            $data['art_updatetime']=time();
            $edit=$articleModel->editArticle($data);
            if($edit){
                $this->success('修改成功','branch',$_POST);
            }else{
                $this->error('修改失败','branch');
            }
        }else{
            $article=$articleModel->findArticle($art_id);
            $this->assign('article',$article);
            //文章类型
            $where=[
                'type_sort' => 4
            ];
            $typeData=$articleModel->typeData($where,'1','15');
            $this->assign('typeData',$typeData);
            return $this->fetch();
        }
    }


    /*
     * art_id
     * */
    public function delArticle(){
        $art_id=intval(trim($_GET['art_id']));
        $articleModel=new Articlem();
        $del=$articleModel->delArticle($art_id);
        if($del){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败','index');
        }
    }

    /*
     * articleStatus
     * */
    public function articleStatus(){
        $articleModel=new Articlem();
        $merInfo=session('merInfo');
        $data['art_admin']=$merInfo['mt_id'];
        $data['art_id']=intval(trim($_GET['art_id']));
        $data['art_isable']=intval(trim($_GET['art_isable']));
        if(isset($data['art_id']) && isset($data['art_isable'])){
            $change=$articleModel->editArticle($data);
            if($data['art_isable'] == 1){
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
     * articleTop
     * */
    public function articleTop(){
        $articleModel=new Articlem();
        $merInfo=session('merInfo');
        $data['art_admin']=$merInfo['mt_id'];
        $data['art_id']=intval(trim($_GET['art_id']));
        $data['art_istop']=intval(trim($_GET['art_istop']));
        if(isset($data['art_id']) && isset($data['art_istop'])){
            $change=$articleModel->editArticle($data);
            if($data['art_istop'] == 1){
                $msg='置顶';
            }else{
                $msg='取消置顶';
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
     * refreshArticle
     * */
    public function refreshArticle(){
        $articleModel=new Articlem();
        $merInfo=session('merInfo');
        $data['art_admin']=$merInfo['mt_id'];
        $data['art_id']=intval(trim($_GET['art_id']));
        $data['art_updatetime']=time();
        $update=$articleModel->editArticle($data);
        $inc=$articleModel->articleInc($data['art_id']);
        if($update && $inc){
            $this->success('刷新成功','index');
        }else{
            $this->error('刷新失败','index');
        }
    }




    /*
     * 文章封面图上传
     * */
    public function upload(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/commerce/article');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/commerce/article/".$path_date."/".$path_filename;
            // 成功上传后 返回上传信息
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            // 上传失败返回错误信息
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }
}