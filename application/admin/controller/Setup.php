<?php
namespace app\admin\controller;
use app\admin\model\Commons;
use app\admin\model\Setupm;
use think\Controller;
use think\Request;

class Setup extends Controller{
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





    /*
     * 类型参数-项目类型
     * */
    public function project(){
        return $this->fetch();
    }


    /*
     * 类型参数
     * 请求数据
     * */
    public function projectData(){
        $where=[
            'type_sort' => 1
        ];
        $setModel=new Setupm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $typeData=$setModel->typeData($where,$page,$limit);
        $count=$setModel->typeCount($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $typeData;
        $res['count'] = $count;
        return json($res);
    }


    /*
     * 添加类型参数
     * */
    public function addType(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['type_name']=trim($_POST['type_name']);
            $data['type_img']=trim($_POST['type_img']);
            $data['type_img_alt']=intval(trim($_POST['type_img_alt']));
            $data['type_remarks']=trim($_POST['type_remarks']);
            $data['type_isable']=intval(trim($_POST['type_isable']));
            $data['type_addtime']=time();
            $data['type_order']=0;
            $data['type_sort']=1;
            $data['type_admin']=$admin_id;
            $setModel=new Setupm();
            $add=$setModel->addType($data);
            if($add){
                $this->success('添加成功','project');
            }else{
                $this->error('添加失败','addType');
            }
        }else{
            return $this->fetch();
        }
    }


    /*
     * 修改参数类型
     * */
    public function editType(){
        $type_id=intval(trim($_GET['type_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['type_id']=$type_id;
            $data['type_name']=trim($_POST['type_name']);
            $data['type_img']=trim($_POST['type_img']);
            $data['type_img_alt']=intval(trim($_POST['type_img_alt']));
            $data['type_remarks']=trim($_POST['type_remarks']);
            $data['type_isable']=intval(trim($_POST['type_isable']));
            $data['type_addtime']=time();
            $data['type_sort']=1;
            $data['type_admin']=$admin_id;
            $setModel=new Setupm();
            $edit=$setModel->editType($data);
            if($edit){
                $this->success('修改成功','project');
            }else{
                $this->error('添加失败','project');
            }
        }else{
            $setModel=new Setupm();
            $typeInfo=$setModel->findType($type_id);
            $this->assign('typeInfo',$typeInfo);
            return $this->fetch();
        }
    }



    /*
     * 修改显示状态
     * */
    public function status(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['type_id']=intval(trim($_GET['type_id']));
        $data['type_isable']=intval(trim($_GET['type_isable']));
        $data['type_admin']=$admin_id;
        if(isset($data['type_id']) && isset($data['type_isable'])){
            $setModel=new Setupm();
            $change=$setModel->editType($data);
            if($data['type_isable'] == 1){
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
     * 重新排序
     * */
    public function reOrder(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['type_id']=intval(trim($_POST['type_id']));
        $data['type_order']=intval(trim($_POST['value']));
        $data['type_admin']=$admin_id;
        if(isset($data['type_id']) && isset($data['type_order'])){
            $setModel=new Setupm();
            $reOrder=$setModel->editType($data);
            if($reOrder){
                $this->success('修改排序成功！','project');
            }else{
                $this->success('修改排序失败！','project');
            }
        }
    }


    /*
     *  删除某一类型
     *
     * */
    public function delType(){
        $type_id=intval(trim($_GET['type_id']));
        $setModel=new Setupm();
        $del=$setModel->delType($type_id);
        if($del){
            $this->success('删除成功','project');
        }else{
            $this->error('删除失败','project');
        }
    }





    /*
     * 上传项目类型的图标
     * */
    public function upload(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/type');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/type/".$path_date."/".$path_filename;
            // 成功上传后 返回上传信息
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            // 上传失败返回错误信息
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }




    /*
     * 空间大小
     * */
    public function space(){
        return $this->fetch();
    }


    /*
     * 空间大小数据
     * */
    public function spaceData(){
        $where=[];
        $setMolde=new Setupm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $spaceData=$setMolde->spaceData($where,$page,$limit);
        $count=$setMolde->spaceCount($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $spaceData;
        $res['count'] = $count;
        return json($res);
        return $this->fetch();
    }


    /*
     * 添加空间大小
     * */
    public function addSpace(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['sp_name']=trim($_POST['sp_name']);
            $data['sp_min']=intval(trim($_POST['sp_min']));
            $data['sp_max']=intval(trim($_POST['sp_max']));
            $data['sp_remarks']=trim($_POST['sp_remarks']);
            $data['sp_isable']=intval(trim($_POST['sp_isable']));
            $data['sp_addtime']=time();
            $data['sp_order']=0;
            $data['sp_admin']=$admin_id;
            $setModel=new Setupm();
            $add=$setModel->addSpace($data);
            if($add){
                $this->success('添加成功','space');
            }else{
                $this->error('添加失败','addSpace');
            }
        }else{
            return $this->fetch();
        }
    }


    /*
     * 修改空间大小
     * */
    public function editSpace(){
        $sp_id=intval(trim($_GET['sp_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['sp_id']=$sp_id;
            $data['sp_name']=trim($_POST['sp_name']);
            $data['sp_min']=trim($_POST['sp_min']);
            $data['sp_max']=trim($_POST['sp_max']);
            $data['sp_remarks']=trim($_POST['sp_remarks']);
            $data['sp_isable']=intval(trim($_POST['sp_isable']));
            $data['sp_addtime']=time();
            $data['sp_order']=0;
            $data['sp_admin']=$admin_id;
            $setModel=new Setupm();
            $edit=$setModel->editSpace($data);
            if($edit){
                $this->success('修改成功','space');
            }else{
                $this->error('添加失败','space');
            }
        }else{
            $setModel=new Setupm();
            $spaceInfo=$setModel->findSpace($sp_id);
            $this->assign('space',$spaceInfo);
            return $this->fetch();
        }
    }


    /*
     * 删除空间大小
     * */
    public function delSpace(){
        $sp_id=intval(trim($_GET['sp_id']));
        $setModel=new Setupm();
        $del=$setModel->delSpace($sp_id);
        if($del){
            $this->success('删除成功','space');
        }else{
            $this->error('删除失败','space');
        }
    }


    /*
     * 修改显示状态
     * */
    public function editSpaceStatus(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['sp_id']=intval(trim($_GET['sp_id']));
        $data['sp_isable']=intval(trim($_GET['status']));
        $data['sp_admin']=$admin_id;
        if(isset($data['type_id']) && isset($data['type_isable'])){
            $setModel=new Setupm();
            $edit=$setModel->editSpace($data);
            if($data['sp_isable'] == 1){
                $msg='显示';
            }else{
                $msg='隐藏';
            }
            if($edit){
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
     * 重新排序空间大小
     *
     * */
    public function reOrderSpace(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['sp_id']=intval(trim($_POST['sp_id']));
        $data['sp_order']=intval(trim($_POST['value']));
        $data['sp_admin']=$admin_id;
        if(isset($data['sp_id']) && isset($data['sp_order'])){
            $setModel=new Setupm();
            $reOrder=$setModel->editSpace($data);
            if($reOrder){
                $this->success('修改排序成功！','space');
            }else{
                $this->success('修改排序失败！','space');
            }
        }
    }
























    /*
     *
     * 指数等级配置页面渲染
     * */
    public function rank(){
        return $this->fetch();
    }

    /*
     * 指数等级配置数据
     * */
    public function rankData(){
        $where=[
            'type_sort' => 2
        ];
        $setModel=new Setupm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $typeData=$setModel->typeData($where,$page,$limit);
        $count=$setModel->typeCount($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $typeData;
        $res['count'] = $count;
        return json($res);
    }


    /*
     *
     * 添加等级
     * */
    public function addRank(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['type_name']=trim($_POST['type_name']);
            $data['type_img']=trim($_POST['type_img']);
            $data['type_img_alt']=trim($_POST['type_img_alt']);
            $data['type_remarks']=trim($_POST['type_remarks']);
            $data['type_isable']=intval(trim($_POST['type_isable']));
            $data['type_addtime']=time();
            $data['type_order']=0;
            $data['type_sort']=2;
            $data['type_admin']=$admin_id;
            $setModel=new Setupm();
            $add=$setModel->addType($data);
            if($add){
                $this->success('添加成功','project');
            }else{
                $this->error('添加失败','addType');
            }
        }else{
            return $this->fetch();
        }
    }


    /*
     * 修改等级指数
     * */
    public function editRank(){
        $type_id=intval(trim($_GET['type_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['type_id']=$type_id;
            $data['type_name']=trim($_POST['type_name']);
            $data['type_img']=trim($_POST['type_img']);
            $data['type_img_alt']=trim($_POST['type_img_alt']);
            $data['type_remarks']=trim($_POST['type_remarks']);
            $data['type_isable']=intval(trim($_POST['type_isable']));
            $data['type_addtime']=time();
            $data['type_order']=0;
            $data['type_sort']=2;
            $data['type_admin']=$admin_id;
            $setModel=new Setupm();
            $edit=$setModel->editType($data);
            if($edit){
                $this->success('修改成功','project');
            }else{
                $this->error('添加失败','project');
            }
        }else{
            $setModel=new Setupm();
            $rankInfo=$setModel->findType($type_id);
            $this->assign('rank',$rankInfo);
            return $this->fetch();
        }
    }

    /*
     * 删除等级指数
     * */
    public function delRank(){
        $type_id=intval(trim($_GET['type_id']));
        $setModel=new Setupm();
        $del=$setModel->delType($type_id);
        if($del){
            $this->success('删除成功','rank');
        }else{
            $this->error('删除失败','rank');
        }

    }





    /*
     * 修改积分
     * */
    public function editScore(){
        $data['type_id']=intval(trim($_POST['type_id']));
        $data['type_img_alt']=intval(trim($_POST['value']));
        $userData=session('userData');
        $data['type_admin']=$userData['ad_id'];
        $setModel=new Setupm();
        $edit=$setModel->editType($data);
        if($edit){
            $this->success('修改积分成功','rank');
        }else{
            $this->error('添加积分失败','rank');
        }
    }














    /*
     * 区域配置-省份
     *
     * */
    public function province(){
        $where=[];
        $setModel=new Setupm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $province=$setModel->provinceData($where,'1','15');
        $count=$setModel->provinceCount($where);
        $this->assign('count',$count);
        $this->assign('page',$page);
        $this->assign('limit',$limit);
        $this->assign('provInfo',$province);
        return $this->fetch();
    }


    /*
     * 区域配置-城市
     * */
    public function city(){
        $where=[];
        $setModel=new Setupm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $city=$setModel->cityData($where,$page,$limit);
        $count=$setModel->cityCount($where);
        $this->assign('count',$count);
        $this->assign('page',$page);
        $this->assign('limit',$limit);
        $this->assign('city',$city);
        return $this->fetch();
    }




    /*
     * 添加省份
     * */
    public function addProvince(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['p_name']=trim($_POST['p_name']);
            $data['p_opeatime']=time();
            $data['p_admin']=$admin_id;
            $setModel=new Setupm();
            $add=$setModel->addProv($data);
            if($add){
                $this->success('添加成功','province');
            }else{
                $this->error('添加失败','province');
            }
        }else{
            return $this->fetch();
        }
    }


    /*
     * 修改省份
     * */
    public function editProvince(){
        $p_id=intval(trim($_GET['p_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['p_name']=trim($_POST['p_name']);
            $data['p_opeatime']=time();
            $data['p_admin']=$admin_id;
            $data['p_id']=$p_id;
            $setModel=new Setupm();
            $edit=$setModel->editProv($data);
            if($edit){
                $this->success('修改成功','province');
            }else{
                $this->error('添加失败','province');
            }
        }else{
            $setModel=new Setupm();
            $province=$setModel->findProv($p_id);
            $this->assign('prov',$province);
            return $this->fetch();
        }
    }



    /*
     * 删除省份
     *
     * */
    public function delProv(){
        $p_id=intval(trim($_GET['p_id']));
        $setModel=new Setupm();
        $province=$setModel->delProv($p_id);
        if($province){
            $this->success('删除成功','province');
        }else{
            $this->error('删除失败','province');
        }
    }



    /*
     * 添加城市
     *
     * */
    public function addCity(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['c_name']=trim($_POST['c_name']);
            $data['c_p_id']=intval(trim($_POST['c_p_id']));
            $data['c_rank']=intval(trim($_POST['c_rank']));
            $data['c_opeatime']=time();
            $data['c_admin']=$admin_id;
            $setModel=new Setupm();
            $add=$setModel->addCity($data);
            if($add){
                $this->success('添加成功','city');
            }else{
                $this->error('添加失败','city');
            }
        }else{
            $where=[];
            $setModel=new Setupm();
            $province=$setModel->provinceData($where,'1','15');
            $this->assign('prov',$province);
            //城市等级
            $cityRank=$setModel->cityRank($where,'1','15');
            $this->assign('rank',$cityRank);
            return $this->fetch();
        }
    }




    /*
     * editCity
     * */
    public function editCity(){
        $c_id=intval(trim($_GET['c_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setModel=new Setupm();
        if($_POST){
            $data['c_name']=trim($_POST['c_name']);
            $data['c_p_id']=intval(trim($_POST['c_p_id']));
            $data['c_rank']=intval(trim($_POST['c_rank']));
            $data['c_opeatime']=time();
            $data['c_admin']=$admin_id;
            $data['c_id'] = $c_id;
            $edit=$setModel->editCity($data);
            if($edit){
                $this->success('修改成功','city');
            }else{
                $this->error('添加失败','city');
            }
        }else{
            //城市信息
            $city=$setModel->findCity($c_id);
            $this->assign('city',$city);
            //省份信息
            $where=[];
            $province=$setModel->provinceData($where,'1','15');
            $this->assign('prov',$province);
            //城市等级
            $cityRank=$setModel->cityRank($where,'1','15');
            $this->assign('rank',$cityRank);
            return $this->fetch();
        }
    }


    /*
     * delCity
     * */
    public function delCity(){
        $c_id=intval(trim($_GET['c_id']));
        $setModel=new Setupm();
        $del=$setModel->delCity($c_id);
        if($del){
            $this->success('删除成功','city');
        }else{
            $this->error('删除失败','city');
        }
    }





















    /*
     * 服务类型页面渲染
     * */
    public function service(){
        return $this->fetch();
    }



    /*
     * 服务类型数据读取
     * */
    public function serviceData(){
        $where=[];
        $setModel=new Setupm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $service=$setModel->serviceData($where,$page,$limit);
        $count=$setModel->serviceCount($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $service;
        $res['count'] = $count;
        return json($res);
    }

    /*
     * 服务类型 添加
     * */
    public function addService(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['st_name']=trim($_POST['st_name']);
            $data['st_remarks']=trim($_POST['st_remarks']);
            $data['st_isable']=trim($_POST['st_isable']);
            $data['st_addtime']=time();
            $data['st_order']=0;
            $data['st_admin']=$admin_id;
            $setModel=new Setupm();
            $add=$setModel->addService($data);
            if($add){
                $this->success('添加成功','service');
            }else{
                $this->error('添加失败','service');
            }
        }else{
            return $this->fetch();
        }
    }










    /*
     *修改服务类型
     * */
    public function editService(){
        $st_id=intval(trim($_GET['st_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['st_id']=$st_id;
            $data['st_name']=trim($_POST['st_name']);
            $data['st_remarks']=trim($_POST['st_remarks']);
            $data['st_isable']=trim($_POST['st_isable']);
            $data['st_addtime']=time();
            $data['st_order']=0;
            $data['st_admin']=$admin_id;
            $setModel=new Setupm();
            $edit=$setModel->editService($data);
            if($edit){
                $this->success('修改成功','service');
            }else{
                $this->error('添加失败','service');
            }
        }else{
            $setModel=new Setupm();
            $service=$setModel->findService($st_id);
            $this->assign('service',$service);
            return $this->fetch();
        }
    }


    /*
     * 修改显示状态
     *
     * */

    public function serviceStatus(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['st_id']=intval(trim($_GET['st_id']));
        $data['st_isable']=intval(trim($_GET['st_isable']));
        $data['st_admin']=$admin_id;
        if(isset($data['st_id']) && isset($data['st_isable'])){
            $setModel=new Setupm();
            $edit=$setModel->editService($data);
            if($data['st_isable'] == 1){
                $msg='显示';
            }else{
                $msg='隐藏';
            }
            if($edit){
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
     * 修改显示排序
     * */
    public function editOrder(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['st_id']=intval(trim($_POST['st_id']));
        $data['st_order']=intval(trim($_POST['value']));
        $data['st_admin']=$admin_id;
        if(isset($data['st_id']) && isset($data['st_order'])){
            $setModel=new Setupm();
            $reOrder=$setModel->editService($data);
            if($reOrder){
                $this->success('修改排序成功！','service');
            }else{
                $this->success('修改排序失败！','service');
            }
        }
    }


    /*
     * 删除服务类型
     * */
    public function delService(){
        $st_id=intval(trim($_GET['st_id']));
        $setModel=new Setupm();
        $del=$setModel->delService($st_id);
        if($del){
            $this->success('删除成功','service');
        }else{
            $this->error('删除失败','service');
        }
    }



    /*
     * 文章类型 type_sort = 4
     * */
    public function article(){
        return $this->fetch();
    }


    /*
        * 文章类型数据
        * */
    public function articleData(){
        $where=[
            'type_sort' => 4
        ];
        $setModel=new Setupm();
        $typeData=$setModel->typeData($where,'1','15');
        $count=$setModel->typeCount($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $typeData;
        $res['count'] = $count;
        return json($res);
    }



    /*
        *
        * 添加文章类型
        * */
    public function addArticle(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['type_name']=trim($_POST['type_name']);
            $data['type_remarks']=trim($_POST['type_remarks']);
            $data['type_isable']=intval(trim($_POST['type_isable']));
            $data['type_addtime']=time();
            $data['type_order']=0;
            $data['type_sort']=4;
            $data['type_admin']=$admin_id;
            $setModel=new Setupm();
            $add=$setModel->addType($data);
            if($add){
                $this->success('添加成功','level');
            }else{
                $this->error('添加失败','level');
            }
        }else{
            return $this->fetch();
        }
    }


    /*
     * 修改文章类型
     * */
    public function editArticle(){
        $type_id=intval(trim($_GET['type_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setModel=new Setupm();
        if($_POST){
            $data['type_id']=$type_id;
            $data['type_name']=trim($_POST['type_name']);
            $data['type_remarks']=trim($_POST['type_remarks']);
            $data['type_isable']=intval(trim($_POST['type_isable']));
            $data['type_addtime']=time();
            $data['type_order']=0;
            $data['type_sort']=4;
            $data['type_admin']=$admin_id;
            $edit=$setModel->editType($data);
            if($edit){
                $this->success('修改成功','level');
            }else{
                $this->error('添加失败','level');
            }
        }else{
            $rankInfo=$setModel->findType($type_id);
            $this->assign('level',$rankInfo);
            return $this->fetch();
        }
    }




    /*
     * 装修品质
     * */
    public function level(){
        return $this->fetch();
    }



    /*
     * 装修品质数据
     * */
    public function levelData(){
        $where=[
            'type_sort' => 3
        ];
        $setModel=new Setupm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $typeData=$setModel->typeData($where,$page,$limit);
        $count=$setModel->typeCount($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $typeData;
        $res['count'] = $count;
        return json($res);
    }


    /*
     *
     * 添加品质
     * */
    public function addLevel(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['type_name']=trim($_POST['type_name']);
            $data['type_remarks']=trim($_POST['type_remarks']);
            $data['type_isable']=intval(trim($_POST['type_isable']));
            $data['type_addtime']=time();
            $data['type_order']=0;
            $data['type_sort']=3;
            $data['type_admin']=$admin_id;
            $setModel=new Setupm();
            $add=$setModel->addType($data);
            if($add){
                $this->success('添加成功','level');
            }else{
                $this->error('添加失败','level');
            }
        }else{
            return $this->fetch();
        }
    }


    /*
     * 修改品质
     * */
    public function editLevel(){
        $type_id=intval(trim($_GET['type_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setModel=new Setupm();
        if($_POST){
            $data['type_id']=$type_id;
            $data['type_name']=trim($_POST['type_name']);
            $data['type_remarks']=trim($_POST['type_remarks']);
            $data['type_isable']=intval(trim($_POST['type_isable']));
            $data['type_addtime']=time();
            $data['type_order']=0;
            $data['type_sort']=3;
            $data['type_admin']=$admin_id;
            $edit=$setModel->editType($data);
            if($edit){
                $this->success('修改成功','level');
            }else{
                $this->error('添加失败','level');
            }
        }else{
            $rankInfo=$setModel->findType($type_id);
            $this->assign('level',$rankInfo);
            return $this->fetch();
        }
    }

    /*
     * 删除品质
     * */
    public function delLevel(){
        $type_id=intval(trim($_GET['type_id']));
        $setModel=new Setupm();
        $del=$setModel->delType($type_id);
        if($del){
            $this->success('删除成功','level');
        }else{
            $this->error('删除失败','level');
        }

    }

    public function levelOrder(){
        $data['type_id']=intval(trim($_POST['type_id']));
        $data['type_order']=intval(trim($_POST['value']));
        $userData=session('userData');
        $data['type_admin']=$userData['ad_id'];
        $setModel=new Setupm();
        $edit=$setModel->editType($data);
        if($edit){
            $this->success('修改排序成功','level');
        }else{
            $this->error('修改排序失败','level');
        }
    }

    /*
     * 修改显示状态
     * */
    public function levelStatus(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['type_id']=intval(trim($_GET['type_id']));
        $data['type_isable']=intval(trim($_GET['type_isable']));
        $data['type_admin']=$admin_id;
        if(isset($data['type_id']) && isset($data['type_isable'])){
            $setModel=new Setupm();
            $change=$setModel->editType($data);
            if($data['type_isable'] == 1){
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
     * 装修品质
     * */
    public function job(){
        return $this->fetch();
    }



    /*
     * 装修品质数据
     * */
    public function jobData(){
        $where=[
            'type_sort' => 5
        ];
        $setModel=new Setupm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $typeData=$setModel->typeData($where,$page,$limit);
        $count=$setModel->typeCount($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $typeData;
        $res['count'] = $count;
        return json($res);
    }


    /*
     *
     * 添加品质
     * */
    public function addJob(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['type_name']=trim($_POST['type_name']);
            $data['type_remarks']=trim($_POST['type_remarks']);
            $data['type_isable']=intval(trim($_POST['type_isable']));
            $data['type_addtime']=time();
            $data['type_order']=0;
            $data['type_sort']=5;
            $data['type_admin']=$admin_id;
            $setModel=new Setupm();
            $add=$setModel->addType($data);
            if($add){
                $this->success('添加成功','job');
            }else{
                $this->error('添加失败','job');
            }
        }else{
            return $this->fetch();
        }
    }


    /*
     * 修改品质
     * */
    public function editJob(){
        $type_id=intval(trim($_GET['type_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setModel=new Setupm();
        if($_POST){
            $data['type_id']=$type_id;
            $data['type_name']=trim($_POST['type_name']);
            $data['type_remarks']=trim($_POST['type_remarks']);
            $data['type_isable']=intval(trim($_POST['type_isable']));
            $data['type_addtime']=time();
            $data['type_order']=0;
            $data['type_sort']=5;
            $data['type_admin']=$admin_id;
            $edit=$setModel->editType($data);
            if($edit){
                $this->success('修改成功','job');
            }else{
                $this->error('添加失败','job');
            }
        }else{
            $rankInfo=$setModel->findType($type_id);
            $this->assign('level',$rankInfo);
            return $this->fetch();
        }
    }

























    /*
     * cityrank
     * */
    public function rankCity(){
        return $this->fetch();
    }

    /*
     * cityRankData
     * */
    public function cityRankData(){
        $where=[];
        $setModel=new Setupm();
        $cityRank=$setModel->cityRank($where,'1','15');
        $count=$setModel->cityRankCount($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $cityRank;
        $res['count'] = $count;
        return json($res);
    }




    /*
     * addcityrank
     * */
    public function addCityRank(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['cr_name']=trim($_POST['cr_name']);
            $data['cr_remarks']=trim($_POST['cr_remarks']);
            $data['cr_isable']=1;
            $data['cr_level_id']=rtrim($_POST['ids'],',');
            $data['cr_level_price']=rtrim($_POST['prices'],',');
            $data['cr_addtime']=time();
            $data['cr_order']=0;
            $data['cr_admin']=$admin_id;
            $setModel=new Setupm();
            $add=$setModel->addCityRank($data);
            if($add){
                $this->success('添加成功','rankCity');
            }else{
                $this->error('添加失败','rankCity');
            }
        }else{
            //装修品质
            $wheres=[
                'type_sort' => 3
            ];
            $setModel=new Setupm();
            $quality=$setModel->typeData($wheres,'1','15');
            $this->assign('quality',$quality);
            return $this->fetch();
        }
    }





    /*
     * editCityRank
     * */
    public function editCityRank(){
        $cr_id=intval(trim($_GET['cr_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setModel=new Setupm();
        if($_POST){
            $data['cr_name']=trim($_POST['cr_name']);
            $data['cr_remarks']=trim($_POST['cr_remarks']);
            $data['cr_isable']=1;
            $data['cr_level_id']=rtrim($_POST['ids'],',');
            $data['cr_level_price']=rtrim($_POST['prices'],',');
            $data['cr_addtime']=time();
            $data['cr_order']=0;
            $data['cr_admin']=$admin_id;
            $data['cr_id']=$cr_id;
            $edit=$setModel->editCityRank($data);
            if($edit){
                $this->success('修改成功','rankCity');
            }else{
                $this->error('添加失败','rankCity');
            }
        }else{
            //装修品质
            $wheres=[
                'type_sort' => 3
            ];
            $quality=$setModel->typeData($wheres,'1','15');

            $rankInfo=$setModel->cityRankFind($cr_id);
            if($quality){
                foreach ($quality as $k => $v){
                    $quality[$k]['price'] = "";
                    for($i = 0 ; $i < count($rankInfo['cr_level_price']) ; $i++){
                        if($i == $k){
                            $quality[$k]['type_name'] = $v['type_name'];
                            $quality[$k]['price'] = $rankInfo['cr_level_price'][$i];
                        }
                    }
                }
            }
            $this->assign('quality',$quality);
            $this->assign('rank',$rankInfo);
            return $this->fetch();
        }
    }



    /*
     *
     * cityRankOrder
     * */
    public function cityRankOrder(){
        $data['cr_id']=intval(trim($_POST['cr_id']));
        $data['cr_order']=intval(trim($_POST['value']));
        $userData=session('userData');
        $data['cr_admin']=$userData['ad_id'];
        $setModel=new Setupm();
        $edit=$setModel->editCityRank($data);
        if($edit){
            $this->success('修改排序成功','rankCity');
        }else{
            $this->error('添加排序失败','rankCity');
        }
    }



    /*
     * cityRankStatus
     * */
    public function cityRankStatus(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['cr_id']=intval(trim($_GET['cr_id']));
        $data['cr_isable']=intval(trim($_GET['cr_isable']));
        $data['cr_admin']=$admin_id;
        if(isset($data['cr_id']) && isset($data['cr_isable'])){
            $setModel=new Setupm();
            $change=$setModel->editCityRank($data);
            if($data['cr_isable'] == 1){
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
     * delCityRank
     * */
    public function delCityRank(){
        $cr_id=intval(trim($_GET['cr_id']));
        $setModel=new Setupm();
        $del=$setModel->delCityRank($cr_id);
        if($del){
            $this->success('删除成功','rankCity');
        }else{
            $this->error('删除失败','rankCity');
        }
    }







/*-------站点模板  start-----------------------------------------------------------------------------------------------*/

    public function temp(){
        return $this->fetch();
    }


    /*
     * 商家模板
     * */
    public function tempmt(){
        return $this->fetch();
    }

    /*
     * 商家模板数据
     * */
    public function tempDatamt(){
        $setupModel=new Setupm();
        $where=[
            'tem_type' => 1
        ];
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $tempData=$setupModel->tempData($where,$page,$limit);
        $count=$setupModel->countTemp($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $tempData;
        $res['count'] = $count;
        return json($res);
    }
    public function tempData(){
        $setupModel=new Setupm();
        $where=[
            'tem_type' => 2
        ];
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $tempData=$setupModel->tempData($where,$page,$limit);
        $count=$setupModel->countTemp($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $tempData;
        $res['count'] = $count;
        return json($res);
    }

    public function addTemp(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setModel=new Setupm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $wheres='tem_addtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$setModel->countTemp($wheres);
            //生成用户编号；
            $data['tem_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['tem_name']=trim($_POST['tem_name']);
            $data['tem_remarks']=trim($_POST['tem_remarks']);
            //模板存放路径现在还没想好要做怎么做，所以展示为‘index’;
            $data['tem_url']='index';
            $data['tem_isable']=intval(trim($_POST['tem_isable']));
            $data['tem_type']=2;
            $data['tem_addtime']=time();
            $data['tem_admin']=$admin_id;
            $add=$setModel->addTemp($data);
            if($add){
                $this->success('添加成功','temp');
            }else{
                $this->error('添加失败','temp');
            }
        }else{
            return $this->fetch();
        }
    }


    public function addTempmt(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setModel=new Setupm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $wheres='tem_addtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$setModel->countTemp($wheres);
            //生成用户编号；
            $data['tem_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['tem_name']=trim($_POST['tem_name']);
            $data['tem_remarks']=trim($_POST['tem_remarks']);
            //模板存放路径现在还没想好要做怎么做，所以展示为‘index’;
            $data['tem_url']='index';
            $data['tem_isable']=intval(trim($_POST['tem_isable']));
            $data['tem_type']=1;
            $data['tem_addtime']=time();
            $data['tem_admin']=$admin_id;
            $add=$setModel->addTemp($data);
            if($add){
                $this->success('添加成功','temp');
            }else{
                $this->error('添加失败','temp');
            }
        }else{
            return $this->fetch();
        }
    }


    public function editTempmt(){
        $temp_id=intval(trim($_GET['temp_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setModel=new Setupm();
        if($_POST){
            $data['tem_id'] = $temp_id;
            $data['tem_name']=trim($_POST['tem_name']);
            $data['tem_remarks']=trim($_POST['tem_remarks']);
            //模板存放路径现在还没想好要做怎么做，所以展示为‘index’;
            $data['tem_url']='index';
            $data['tem_isable']=intval(trim($_POST['tem_isable']));
            $data['tem_addtime']=time();
            $data['tem_admin']=$admin_id;
            $edit=$setModel->editTemp($data);
            if($edit){
                $this->success('修改成功','temp');
            }else{
                $this->error('添加失败','temp');
            }
        }else{
            $temp=$setModel->findTemp($temp_id);
            $this->assign('temp',$temp);
            return $this->fetch();
        }
    }


    public function editTemp(){
        $temp_id=intval(trim($_GET['temp_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setModel=new Setupm();
        if($_POST){
            $data['tem_id'] = $temp_id;
            $data['tem_name']=trim($_POST['tem_name']);
            $data['tem_remarks']=trim($_POST['tem_remarks']);
            //模板存放路径现在还没想好要做怎么做，所以展示为‘index’;
            $data['tem_url']='index';
            $data['tem_isable']=intval(trim($_POST['tem_isable']));
            $data['tem_addtime']=time();
            $data['tem_admin']=$admin_id;
            $edit=$setModel->editTemp($data);
            if($edit){
                $this->success('修改成功','temp');
            }else{
                $this->error('添加失败','temp');
            }
        }else{
            $temp=$setModel->findTemp($temp_id);
            $this->assign('temp',$temp);
            return $this->fetch();
        }
    }

    public function tempStatus(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['tem_id']=intval(trim($_GET['tem_id']));
        $data['tem_isable']=intval(trim($_GET['status']));
        $data['tem_admin']=$admin_id;
        if(isset($data['tem_id']) && isset($data['tem_isable'])){
            $setModel=new Setupm();
            $change=$setModel->editTemp($data);
            if($data['tem_isable'] == 1){
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

    public function delTemp(){
        $temp_id=intval(trim($_GET['temp_id']));
        $setModel=new Setupm();
        $del=$setModel->delTemp($temp_id);
        if($del){
            $this->success('删除成功','temp');
        }else{
            $this->error('删除失败','temp');
        }
    }


/*-------站点模板  end-----------------------------------------------------------------------------------------------*/




/*-------县区数据  end-----------------------------------------------------------------------------------------------*/
    /*
     * 县区数据
     * */
    public function area(){
        $where=[];
        $setModel=new Setupm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $area=$setModel->areaData($where,$page,$limit);
        $count=$setModel->countArea($where);
        $this->assign('count',$count);
        $this->assign('page',$page);
        $this->assign('limit',$limit);
        $this->assign('area',$area);
        return $this->fetch();
    }

    /*
     * addArea
     * */
    public function addArea(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['p_id']=intval(trim($_POST['p_id']));
            $data['c_id']=intval(trim($_POST['c_id']));
            $data['a_name']=trim($_POST['a_name']);
            $data['a_addtime']=time();
            $data['a_admin']=$admin_id;
            $setModel=new Setupm();
            $add=$setModel->addArea($data);
            if($add){
                $this->success('添加成功','area');
            }else{
                $this->error('添加失败','area');
            }
        }else{
            $where=[];
            $setModel=new Setupm();
            $province=$setModel->provinceData($where,'1','50');
            $this->assign('prov',$province);
            return $this->fetch();
        }
    }


    /*
     * editArea
     * */
    public function editArea(){
        $a_id=intval(trim($_GET['a_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        if($_POST){
            $data['a_id']=$a_id;
            $data['p_id']=intval(trim($_POST['p_id']));
            $data['c_id']=intval(trim($_POST['c_id']));
            $data['a_name']=trim($_POST['a_name']);
            $data['a_addtime']=time();
            $data['a_admin']=$admin_id;
            $setModel=new Setupm();
            $edit=$setModel->editArea($data);
            if($edit){
                $this->success('修改成功','area');
            }else{
                $this->error('添加失败','area');
            }
        }else{
            $setModel=new Setupm();
            $area=$setModel->findArea($a_id);
            $this->assign('area',$area);
            $where=[];
            $province=$setModel->provinceData($where,'1','50');
            $this->assign('prov',$province);
            $wheres=[
                'p_id' => $area['p_id']
            ];
            $city=$setModel->cityData($wheres,'1','50');
            $this->assign('city',$city);
            return $this->fetch();
        }
    }



    /*
     * delArea
     *
     * */
    public function delArea(){
        $a_id=intval(trim($_GET['a_id']));
        $setModel=new Setupm();
        $province=$setModel->delArea($a_id);
        if($province){
            $this->success('删除成功','area');
        }else{
            $this->error('删除失败','area');
        }
    }


/*-------县区数据  end-----------------------------------------------------------------------------------------------*/



/*-------友情链接  end-----------------------------------------------------------------------------------------------*/


    public function friendLink(){
        return $this->fetch();
    }

    public function friendData(){
        $setupModel=new Setupm();
        $where=[];
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$setupModel->friendData($where,$page,$limit);
        $count=$setupModel->countFriend($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }


    public function addFriend(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setModel=new Setupm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $wheres='fl_createtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$setModel->countFriend($wheres);
            //生成用户编号；
            $data['fl_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['fl_p_id']=intval(trim($_POST['fl_p_id']));
            $data['fl_c_id']=intval(trim($_POST['fl_c_id']));
            $data['fl_name']=trim($_POST['fl_name']);
            $data['fl_remarks']=trim($_POST['fl_remarks']);
            $data['fl_url']=trim($_POST['fl_url']);
            $data['fl_isadmin']=1;      //添加类型：是否为平台添加，1.平台
            $data['fl_createtime']=time();
            $data['fl_updatetime']=time();
            $data['fl_admin']=$admin_id;
            $add=$setModel->addFriend($data);
            if($add){
                $this->success('添加成功','friendLink');
            }else{
                $this->error('添加失败','friendLink');
            }
        }else{
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            return $this->fetch();
        }
    }


    public function editFriend(){
        $fl_id=intval(trim($_GET['fl_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $setModel=new Setupm();
        if($_POST){
            $data['fl_id'] = $fl_id;
            $data['fl_p_id']=intval(trim($_POST['fl_p_id']));
            $data['fl_c_id']=intval(trim($_POST['fl_c_id']));
            $data['fl_name']=trim($_POST['fl_name']);
            $data['fl_remarks']=trim($_POST['fl_remarks']);
            $data['fl_url']=trim($_POST['fl_url']);
            $data['fl_isadmin']=1;      //添加类型：是否为平台添加，1.平台
            $data['fl_updatetime']=time();
            $data['fl_admin']=$admin_id;
            $edit=$setModel->editFriend($data);
            if($edit){
                $this->success('修改成功','friendLink');
            }else{
                $this->error('添加失败','friendLink');
            }
        }else{
            $friend=$setModel->findFriend($fl_id);
            $this->assign('friend',$friend);
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            $p_id=$friend['fl_p_id'];
            $where=[
                'c_p_id' => $p_id
            ];
            $city=$setModel->cityData($where,1,50);
            $this->assign('city',$city);
            return $this->fetch();
        }
    }

    public function friendStatus(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['fl_id']=intval(trim($_GET['fl_id']));
        $data['fl_isable']=intval(trim($_GET['fl_isable']));
        $data['fl_admin']=$admin_id;
        if(isset($data['fl_id']) && isset($data['fl_isable'])){
            $setModel=new Setupm();
            $change=$setModel->editFriend($data);
            if($data['fl_isable'] == 1){
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
    public function friendOrder(){
        $userData=session('userData');
        $admin_id=intval($userData['ad_id']);
        $data['fl_id']=intval(trim($_GET['fl_id']));
        $data['fl_istop']=intval(trim($_GET['fl_istop']));
        $data['fl_admin']=$admin_id;
        if(isset($data['fl_id']) && isset($data['fl_istop'])){
            $setModel=new Setupm();
            $change=$setModel->editFriend($data);
            if($data['fl_istop'] == 1){
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

    public function delFriend(){
        $fl_id=intval(trim($_GET['fl_id']));
        $setModel=new Setupm();
        $del=$setModel->delFriend($fl_id);
        if($del){
            $this->success('删除成功','friendLink');
        }else{
            $this->error('删除失败','friendLink');
        }
    }








    /*-------友情链接  end-----------------------------------------------------------------------------------------------*/






    /*
     * 投诉建议
     * */
    public function suggestion(){
        return $this->fetch();
    }

    /*
     * 建议数据
     * */
    public function suggestData(){
        $setupModel=new Setupm();
        $where=[];
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$setupModel->suggestData($where,$page,$limit);
        $count=$setupModel->countSuggest($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }



    /*
     *delSuggestion
     * */
    public function delSuggestion(){
        $sg_id=intval(trim($_GET['sg_id']));
        $setModel=new Setupm();
        $del=$setModel->delSuggest($sg_id);
        if($del){
            $this->success('删除成功','suggestion');
        }else{
            $this->error('删除失败','suggestion');
        }
    }


    public function suggestReplay(){
        $sg_id=intval(trim($_GET['sg_id']));
        $setModel=new Setupm();
        $suggest=$setModel->findSuggest($sg_id);
        $this->assign('suggest',$suggest);
        return $this->fetch();
    }







}