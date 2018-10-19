<?php
namespace app\admin\controller;
use app\admin\model\Adminm;
use app\admin\model\Commons;
use app\admin\model\Setinfom;
use app\admin\model\Setupm;
use think\Controller;
use think\Request;

class Setinfo extends Controller{
    //公共头部
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
        $this->assign('adminUrl',$adminUrl[0]);
        $commonModel=new Commons();
//        $ip=$_SERVER['REMOTE_ADDR'];
        $ip='117.36.76.230';
        $ipInfo=$commonModel->index($ip);
        $this->assign('ipInfo',$ipInfo['data']);
        $this->assign('adminData',$userData);
    }

    public function welcome(){
        return $this->fetch();
    }

/*-------平台配置  start-----------------------------------------------------------------------------------------------*/

    /*
     * 平台配置
     * */
    public function index(){
        return $this->fetch();
    }

    /*
     * 平台配置数据
     * */
    public function setData(){
        $setInfom=new Setinfom();
        $where=[];
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $setData=$setInfom->setData($where,$page,$limit);
        $count=$setInfom->countSet($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $setData;
        $res['count'] = $count;
        return json($res);
    }

    /*
     * 添加
     * */
    public function add(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['s_key']=trim($_POST['s_key']);
            $data['s_desc']=trim($_POST['s_desc']);
            $data['s_value']=trim($_POST['s_value']);
            $data['s_is_able']=intval(trim($_POST['s_is_able']));
            $data['s_opeatime']=time();
            $data['s_admin']=$admin_id;
            $setInfom=new Setinfom();
            $add=$setInfom->addSet($data);
            if($add){
                $this->success('添加成功','index');
            }else{
                $this->error('添加失败','index');
            }
        }else{
            return $this->fetch();
        }
    }

    public function edit(){
        $s_id=intval(trim($_GET['s_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setInfom=new Setinfom();
        if($_POST){
            $data['s_id']=$s_id;
            $data['s_key']=trim($_POST['s_key']);
            $data['s_desc']=trim($_POST['s_desc']);
            $data['s_value']=trim($_POST['s_value']);
            $data['s_is_able']=intval(trim($_POST['s_is_able']));
            $data['s_opeatime']=time();
            $data['s_admin']=$admin_id;
            $edit=$setInfom->editSet($data);
            if($edit){
                $this->success('修改成功','index');
            }else{
                $this->error('添加失败','index');
            }
        }else{
            $find=$setInfom->findSet($s_id);
            $this->assign('find',$find);
            return $this->fetch();
        }
    }

    /*
     * delSet
     * */
    public function delSet(){
        $s_id=intval(trim($_GET['s_id']));
        $setInfom=new Setinfom();
        $del=$setInfom->delSet($s_id);
        if($del){
            $this->success('删除成功','index');
        }else{
            $this->error('删除失败','index');
        }
    }



/*-------平台配置  end-----------------------------------------------------------------------------------------------*/

    /*
     * 站点管理2018/07/13
     * */
/*-------站点管理 start-----------------------------------------------------------------------------------------------*/

    /*
     * 页面渲染
     * */
    public function branch(){
        return $this->fetch();
    }


    /*
     * 站点数据
     * */
    public function branchData(){
        $setInfom=new Setinfom();
        $where=[];
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$setInfom->branchData($where,$page,$limit);
        $count=$setInfom->branchCount($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }



    /*
     * 开通新站
     * */
    public function addBranch(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setInfom=new Setinfom();
        $setModel=new Setupm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='b_createtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$setInfom->branchCount($where);
            //生成用户编号；
            $data['b_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['b_name']=trim($_POST['b_name']);
            $data['b_website']=trim($_POST['b_website']);
            $data['b_tel']=trim($_POST['b_tel']);
            $data['b_address']=trim($_POST['b_address']);
            $data['b_location']=trim($_POST['b_location']);
            $data['b_manger']=trim($_POST['b_manger']);
            $data['b_templet']=intval(trim($_POST['b_templet']));
            $data['b_manger_phone']=trim($_POST['b_manger_phone']);
            $data['b_manger_email']=trim($_POST['b_manger_email']);
            $data['b_province']=intval(trim($_POST['b_province']));
            $data['b_city']=intval(trim($_POST['b_city']));
            $data['b_isopen']=1;
            $data['b_description']=trim($_POST['b_description']);
            $data['b_createtime']=time();
            $data['b_updatetime']=time();
            $data['b_admin']=$admin_id;
            $add=$setInfom->addBranch($data);
            if($add){
                $this->success('添加成功','branch');
            }else{
                $this->error('添加失败','branch');
            }
        }else{
            //站点模板
            $templet=$setInfom->temData(['tem_type' => 2],1,10);
            $this->assign('templet',$templet);
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            return $this->fetch();
        }
    }



    /*
     * editBranch
     * */
    public function editBranch(){
        $b_id=intval(trim($_GET['b_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setInfom=new Setinfom();
        $setModel=new Setupm();
        if($_POST){
            //生成用户编号；
            $data['b_id']=$b_id;
            $data['b_name']=trim($_POST['b_name']);
            $data['b_website']=trim($_POST['b_website']);
            $data['b_tel']=trim($_POST['b_tel']);
            $data['b_address']=trim($_POST['b_address']);
            $data['b_location']=trim($_POST['b_location']);
            $data['b_manger']=trim($_POST['b_manger']);
            $data['b_manger_phone']=trim($_POST['b_manger_phone']);
            $data['b_manger_email']=trim($_POST['b_manger_email']);
            $data['b_province']=intval(trim($_POST['b_province']));
            $data['b_city']=intval(trim($_POST['b_city']));
            $data['b_templet']=intval(trim($_POST['b_templet']));
            $data['b_description']=trim($_POST['b_description']);
            $data['b_updatetime']=time();
            $data['b_admin']=$admin_id;
            $edit=$setInfom->editBranch($data);
            if($edit){
                $this->success('修改成功','branch');
            }else{
                $this->error('修改失败','branch');
            }
        }else{
            $branch=$setInfom->findBranch($b_id);
            $this->assign('branch',$branch);
            $p_id=$branch['b_province'];
            $where=[
                'c_p_id' => $p_id
            ];
            $city=$setModel->cityData($where,1,20);
            $this->assign('city',$city);
            //站点模板
            $templet=$setInfom->temData(['tem_type' => 2],1,10);
            $this->assign('templet',$templet);
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            return $this->fetch();
        }
    }


    /*
     * 删除数据
     * */
    public function delBranch(){
        $b_id=intval(trim($_GET['b_id']));
        $setInfom=new Setinfom();
        $del=$setInfom->delBranch($b_id);
        if($del){
            $this->success('删除成功','branch');
        }else{
            $this->error('删除失败','branch');
        }
    }



    /*
     * branchStatus
     * */
    public function branchStatus(){
        $data['b_id']=intval(trim($_GET['b_id']));
        $data['b_isopen']=intval(trim($_GET['change']));
        $userData=session('userData');
        $data['b_admin']=$userData['ad_id'];

        if(isset($data['b_id']) && isset($data['b_isopen'])){
            $setInfom=new Setinfom();
            $change=$setInfom->editBranch($data);
            if($data['b_isopen'] == 1){
                $msg='开通';
            }else{
                $msg='关闭';
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

/*-------站点管理  end------------------------------------ -----------------------------------------------------------*/



    //layui文本编辑器图片上传接口
    public function editUpload(Request $request)
    {
        $file 	= $request->file('file');
        $info 	= $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            $name_path =str_replace('\\',"/",$info->getSaveName());
            $result['data']["src"] = "/uploads/layui/".$name_path;
            $url 	= $info->getSaveName();
            //图片上传成功后，组好json格式，返回给前端
            $arr   = array(
                'code' => 0,
                'message'=>'',
                'data' =>array(
                    'src' => "/uploads/".$name_path
                ),
            );
        }
        echo json_encode($arr);
    }






    //图片上传
    public function upload(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/platform');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/platform/".$path_date."/".$path_filename;
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }
}