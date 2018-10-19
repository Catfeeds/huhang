<?php
namespace app\admin\controller;
use app\admin\model\Adminm;
use app\admin\model\Commons;
use app\admin\model\Platformm;
use app\admin\model\Setinfom;
use app\admin\model\Setupm;
use think\Controller;
use think\Request;

class Platform extends Controller{

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


/*---文章管理 start------------------------------------------------------------------------------------------------------*/
    /*
     * 文章管理
     * */
    public function article(){
        return $this->fetch();
    }

    public function articleData(){
        $where=[];
        $platModel=new Platformm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $typeData=$platModel->articleData($where,$page,$limit);
        $count=$platModel->countArticle($where);
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
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='art_createtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$platModel->countArticle($where);
            //生成用户编号；
            $data['art_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['art_title']=trim($_POST['art_title']);
            $data['art_keywords']=trim($_POST['art_keywords']);
            $data['art_subtitle']=trim($_POST['art_subtitle']);
            $data['art_keywords']=trim($_POST['art_keywords']);
            $data['art_img_alt']=trim($_POST['art_img_alt']);
            $data['art_img']=trim($_POST['art_img']);
            $data['art_content']=trim($_POST['art_content']);
            $data['art_p_id']=intval(trim($_POST['art_p_id']));
            $data['art_c_id']=intval(trim($_POST['art_c_id']));
            $data['art_m_id']=intval(trim($_POST['art_m_id']));
            $data['art_type']=intval(trim($_POST['art_type']));
            $data['art_istop']=intval(trim($_POST['art_istop']));
            $data['art_createtime']=time();
            $data['art_updatetime']=time();
            $data['art_status']=2;
            $data['art_isable']=1;
            $data['art_admin']=$admin_id;
            $add=$platModel->addArticle($data);
            if($add){
                $this->success('添加成功','article');
            }else{
                $this->error('添加失败','article');
            }
        }else{
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            //文章类型
            $where=[
                'type_sort' => 4
            ];
            $setModel=new Setupm();
            $typeData=$setModel->typeData($where,'1','15');
            $this->assign('typeData',$typeData);
            return $this->fetch();
        }
    }

    /*
     * editArticle
     * */
    public function editArticle(){
        $art_id=intval(trim($_GET['art_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            //生成用户编号；
            $data['art_id']=$art_id;
            $data['art_title']=trim($_POST['art_title']);
            $data['art_keywords']=trim($_POST['art_keywords']);
            $data['art_subtitle']=trim($_POST['art_subtitle']);
            $data['art_keywords']=trim($_POST['art_keywords']);
            $data['art_img_alt']=trim($_POST['art_img_alt']);
            $data['art_img']=trim($_POST['art_img']);
            $data['art_content']=trim($_POST['art_content']);
            $data['art_p_id']=intval(trim($_POST['art_p_id']));
            $data['art_c_id']=intval(trim($_POST['art_c_id']));
            $data['art_m_id']=intval(trim($_POST['art_m_id']));
            $data['art_type']=intval(trim($_POST['art_type']));
            $data['art_status']=intval(trim($_POST['art_status']));
            $data['art_tip']=trim($_POST['art_tip']);
            $data['art_createtime']=time();
            $data['art_updatetime']=time();
            $data['art_isable']=1;
            $data['art_admin']=$admin_id;
            $edit=$platModel->editArticle($data);
            if($edit){
                $this->success('修改成功','branch',$_POST);
            }else{
                $this->error('修改失败','branch');
            }
        }else{
            $article=$platModel->findArticle($art_id);
            $this->assign('article',$article);
            //城市信息
            $p_id=$article['art_p_id'];
            $where=[
                'c_p_id' => $p_id
            ];
            $city=$setModel->cityData($where,1,50);
            $this->assign('city',$city);
            //站点信息
            $c_id=$article['art_c_id'];
            $wheres=[
                'b_city' =>$c_id
            ];
            $setInfom=new Setinfom();
            $branch=$setInfom->branchData($wheres,1,50);
            $this->assign('branch',$branch);
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            //商户信息
            $m_id=$article['art_m_id'];
            $whrere=[
                'mt_id' => $m_id
            ];
            $adminModel=new Adminm();
            $merchant=$adminModel->merchantData($whrere,1,50);
            $this->assign('merchant',$merchant);
            //文章类型
            $wheress=[
                'type_sort' => 4
            ];
            $setModel=new Setupm();
            $typeData=$setModel->typeData($wheress,'1','15');
            $this->assign('typeData',$typeData);
            return $this->fetch();
        }
    }


    /*
     * art_id
     * */
    public function delArticle(){
        $art_id=intval(trim($_GET['art_id']));
        $platModel=new Platformm();
        $del=$platModel->delArticle($art_id);
        if($del){
            $this->success('删除成功','article');
        }else{
            $this->error('删除失败','article');
        }
    }

    /*
     * articleStatus
     * */
    public function articleStatus(){
        $data['art_id']=intval(trim($_GET['art_id']));
        $data['art_isable']=intval(trim($_GET['art_isable']));
        $userData=session('userData');
        $data['art_admin']=$userData['ad_id'];
        if(isset($data['art_id']) && isset($data['art_isable'])){
            $platModel=new Platformm();
            $change=$platModel->editArticle($data);
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
        $data['art_id']=intval(trim($_GET['art_id']));
        $data['art_istop']=intval(trim($_GET['art_istop']));
        $userData=session('userData');
        $data['art_admin']=$userData['ad_id'];
        if(isset($data['art_id']) && isset($data['art_istop'])){
            $platModel=new Platformm();
            $change=$platModel->editArticle($data);
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
        $data['art_id']=intval(trim($_GET['art_id']));
        $data['art_updatetime']=time();
        $platModel=new Platformm();
        $update=$platModel->editArticle($data);
        $inc=$platModel->articleInc($data['art_id']);
        if($update && $inc){
            $this->success('刷新成功','article');
        }else{
            $this->error('刷新失败','article');
        }

    }




    /*
     * 文章封面图上传
     * */
    public function upload(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/article');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/article/".$path_date."/".$path_filename;
            // 成功上传后 返回上传信息
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            // 上传失败返回错误信息
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }


    /*
     * 案例图图上传
     * */
    public function uploads(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/case');
        if($info){
            $path_filename =  $info->getFilename();
            $path_date=date("Ymd",time());
            $path="/uploads/case/".$path_date."/".$path_filename;
            // 成功上传后 返回上传信息
            return json(array('state'=>1,'path'=>$path,'msg'=> '图片上传成功！'));
        }else{
            // 上传失败返回错误信息
            return json(array('state'=>0,'msg'=>'上传失败,请重新上传！'));
        }
    }

    /*
     * layedit 图片上传
     * */
    public function editUpload(Request $request)
    {
        $file 	= $request->file('file');
        $info 	= $file->move(ROOT_PATH . 'public' . DS . 'uploads/layui');
        if($info){
            $name_path =str_replace('\\',"/",$info->getSaveName());
            $result['data']["src"] = "/uploads/layui/".$name_path;
            //图片上传成功后，组好json格式，返回给前端
            $arr   = array(
                'code' => 0,
                'message'=>'上传成功',
                'data' =>array(
                    'src' => "/uploads/layui/".$name_path
                ),
            );
        }
        echo json_encode($arr);
    }
/*---文章管理 end ------------------------------------------------------------------------------------------------------*/



/*---案例管理 start ------------------------------------------------------------------------------------------------------*/

    public function example(){
        return $this->fetch();
    }


    public function exampleData(){
        $where=[];
        $platModel=new Platformm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$platModel->exampleData($where,$page,$limit);
        $count=$platModel->countExample($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }


    public function addExample(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='case_decotime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$platModel->countExample($where);
            //生成用户编号；
            $data['case_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['case_title']=trim($_POST['case_title']);
            $data['case_type']=intval(trim($_POST['case_type']));
            $data['case_url']=trim($_POST['case_url']);
            $data['case_img'] = implode(',',$_POST['case_img']);
            $data['case_img_alt'] = implode(',',$_POST['case_img_alt']);
            $data['case_remarks']=trim($_POST['case_remarks']);
            $data['case_p_id']=intval(trim($_POST['case_p_id']));
            $data['case_c_id']=intval(trim($_POST['case_c_id']));
            $data['case_m_id']=intval(trim($_POST['case_m_id']));
            $data['case_designer']=intval(trim($_POST['case_designer']));
            $data['case_seo_keywords']=$_POST['case_seo_keywords'];
            $data['case_price']=intval($_POST['case_price']);
            $data['case_area']=$_POST['case_area'];
            $data['case_decotime']=time();
            $data['case_status']=2;
            $data['case_isable']=1;
            $data['case_istop']=2;
            $data['case_updatetime']=time();
            $data['case_admin'] = $admin_id;
            $add=$platModel->addExample($data);
            if($add){
                $this->success('添加成功','example');
            }else{
                $this->error('添加失败','example');
            }
        }else{
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            //项目类型
            $type=$setModel->typeData(['type_sort' => 1,'type_isable' => 1],1,20);
            $this->assign('typeData',$type);
            //设计师
            $designer=$setModel->designer(['des_isable' => 1,'des_status' =>2]);
            $this->assign('designer',$designer);
            return $this->fetch();
        }
    }

    /*
     * editArticle
     * */
    public function editExample(){
        $case_id=intval(trim($_GET['case_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $data['case_id']=$case_id;
            $data['case_title']=trim($_POST['case_title']);
            $data['case_type']=intval(trim($_POST['case_type']));
            $data['case_url']=trim($_POST['case_url']);
            $data['case_img'] = implode(',',$_POST['case_img']);
            $data['case_img_alt'] = implode(',',$_POST['case_img_alt']);
            $data['case_remarks']=trim($_POST['case_remarks']);
            $data['case_p_id']=intval(trim($_POST['case_p_id']));
            $data['case_c_id']=intval(trim($_POST['case_c_id']));
            $data['case_m_id']=intval(trim($_POST['case_m_id']));
            $data['case_designer']=intval(trim($_POST['case_designer']));
            $data['case_seo_keywords']=$_POST['case_seo_keywords'];
            $data['case_price']=intval($_POST['case_price']);
            $data['case_area']=$_POST['case_area'];
            $data['case_decotime']=time();
            $data['case_status']=intval($_POST['case_status']);
            $data['case_isable']=1;
            $data['case_istop']=2;
            $data['case_updatetime']=time();
            $data['case_admin'] = $admin_id;
            $edit=$platModel->editExample($data);
            if($edit){
                $this->success('修改成功','example');
            }else{
                $this->error('修改失败','example');
            }
        }else{
            $honor=$platModel->findExample($case_id);
            $this->assign('case',$honor);
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            //城市信息
            $p_id=$honor['case_p_id'];
            $where=[
                'c_p_id' => $p_id
            ];
            $city=$setModel->cityData($where,1,50);
            $this->assign('city',$city);
            //站点信息
            $c_id=$honor['case_c_id'];
            $wheres=[
                'b_city' =>$c_id
            ];
            $setInfom=new Setinfom();
            $branch=$setInfom->branchData($wheres,1,50);
            $this->assign('branch',$branch);
            //商户信息
            $m_id=$honor['case_m_id'];
            $whrere=[
                'mt_id' => $m_id
            ];
            $adminModel=new Adminm();
            $merchant=$adminModel->merchantData($whrere,1,50);
            $this->assign('merchant',$merchant);
            //项目类型
            $type=$setModel->typeData(['type_sort' => 1,'type_isable' => 1],1,20);
            $this->assign('typeData',$type);
            //设计师
            $designer=$setModel->designer(['des_isable' => 1,'des_status' =>2]);
            $this->assign('designer',$designer);
            return $this->fetch();
        }
    }


    /*
     * delExample
     * */
    public function delExample(){
        $case_id=intval(trim($_GET['case_id']));
        $platModel=new Platformm();
        $del=$platModel->delExample($case_id);
        if($del){
            $this->success('删除成功','example');
        }else{
            $this->error('删除失败','example');
        }
    }

    /*
     *
     * refreshExample
     * */
    public function refreshExample(){
        $data['case_id']=intval(trim($_GET['case_id']));
        $data['case_updatetime']=time();
        $platModel=new Platformm();
        $update=$platModel->editExample($data);
        $inc=$platModel->exampleInc($data['case_id']);
        if($update && $inc){
            $this->success('刷新成功','example');
        }else{
            $this->error('刷新失败','example');
        }

    }


    /*
     * exampleStatus
     * */
    public function exampleStatus(){
        $data['case_id']=intval(trim($_GET['case_id']));
        $data['case_isable']=intval(trim($_GET['case_isable']));
        $userData=session('userData');
        $data['case_admin']=$userData['ad_id'];
        if(isset($data['case_id']) && isset($data['case_isable'])){
            $platModel=new Platformm();
            $change=$platModel->editExample($data);
            if($data['case_isable'] == 1){
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
     * exampleTop
     * */
    public function exampleTop(){
        $data['case_id']=intval(trim($_GET['case_id']));
        $data['case_istop']=intval(trim($_GET['case_istop']));
        $userData=session('userData');
        $data['case_admin']=$userData['ad_id'];
        if(isset($data['case_istop']) && isset($data['case_id'])){
            $platModel=new Platformm();
            $change=$platModel->editExample($data);
            if($data['case_istop'] == 1){
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

















/*---案例管理 end ------------------------------------------------------------------------------------------------------*/




/*---荣誉资质 start ------------------------------------------------------------------------------------------------------*/

    public function honor(){
        return $this->fetch();
    }

    public function honorData(){
        $where=[];
        $platModel=new Platformm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$platModel->honorData($where,$page,$limit);
        $count=$platModel->countHonor($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }

    /*
     * addArticle
     * */
    public function addHonor(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='h_addtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$platModel->countHonor($where);
            //生成用户编号；
            $data['h_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['h_name']=trim($_POST['h_name']);
            $data['h_img']=trim($_POST['h_img']);
            $data['h_img_alt']=trim($_POST['h_img_alt']);
            $data['h_remarks']=trim($_POST['h_remarks']);
            $data['h_p_id']=intval(trim($_POST['h_p_id']));
            $data['h_c_id']=intval(trim($_POST['h_c_id']));
            $data['h_m_id']=intval(trim($_POST['h_m_id']));
            $data['h_addtime']=time();
            $data['h_updatetime']=time();
            $data['h_status']=2;
            $data['h_admin']=$admin_id;
            $add=$platModel->addHonor($data);
            if($add){
                $this->success('添加成功','honor');
            }else{
                $this->error('添加失败','honor');
            }
        }else{
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            return $this->fetch();
        }
    }

    /*
     * editArticle
     * */
    public function editHonor(){
        $h_id=intval(trim($_GET['h_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $data['h_id']=$h_id;
            $data['h_name']=trim($_POST['h_name']);
            $data['h_img']=trim($_POST['h_img']);
            $data['h_img_alt']=trim($_POST['h_img_alt']);
            $data['h_remarks']=trim($_POST['h_remarks']);
            $data['h_p_id']=intval(trim($_POST['h_p_id']));
            $data['h_c_id']=intval(trim($_POST['h_c_id']));
            $data['h_m_id']=intval(trim($_POST['h_m_id']));
            $data['h_status']=intval(trim($_POST['h_status']));
            $data['h_tip']=trim($_POST['h_tip']);
            $data['h_updatetime']=time();
            $data['h_admin']=$admin_id;
            $edit=$platModel->editHonor($data);
            if($edit){
                $this->success('修改成功','honor');
            }else{
                $this->error('修改失败','honor');
            }
        }else{
            $honor=$platModel->findHonor($h_id);
            $this->assign('honor',$honor);
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            //城市信息
            $p_id=$honor['h_p_id'];
            $where=[
                'c_p_id' => $p_id
            ];
            $city=$setModel->cityData($where,1,50);
            $this->assign('city',$city);
            //站点信息
            $c_id=$honor['h_c_id'];
            $wheres=[
                'b_city' =>$c_id
            ];
            $setInfom=new Setinfom();
            $branch=$setInfom->branchData($wheres,1,50);
            $this->assign('branch',$branch);
            //商户信息
            $m_id=$honor['h_m_id'];
            $whrere=[
                'mt_id' => $m_id
            ];
            $adminModel=new Adminm();
            $merchant=$adminModel->merchantData($whrere,1,50);
            $this->assign('merchant',$merchant);
            return $this->fetch();
        }
    }


    /*
     * art_id
     * */
    public function delHonor(){
        $h_id=intval(trim($_GET['h_id']));
        $platModel=new Platformm();
        $del=$platModel->delHonor($h_id);
        if($del){
            $this->success('删除成功','honor');
        }else{
            $this->error('删除失败','honor');
        }
    }

    /*
     * articleStatus
     * */
    public function honorStatus(){
        $data['h_id']=intval(trim($_GET['h_id']));
        $data['h_isable']=intval(trim($_GET['h_isable']));
        $userData=session('userData');
        $data['h_admin']=$userData['ad_id'];
        if(isset($data['h_id']) && isset($data['h_isable'])){
            $platModel=new Platformm();
            $change=$platModel->editHonor($data);
            if($data['h_isable'] == 1){
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
    public function honorTop(){
        $data['h_id']=intval(trim($_GET['h_id']));
        $data['h_istop']=intval(trim($_GET['h_istop']));
        $userData=session('userData');
        $data['h_admin']=$userData['ad_id'];
        if(isset($data['h_id']) && isset($data['h_istop'])){
            $platModel=new Platformm();
            $change=$platModel->editHonor($data);
            if($data['h_istop'] == 1){
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

/*---荣誉资质 end ------------------------------------------------------------------------------------------------------*/

/*---人才招聘 start ------------------------------------------------------------------------------------------------------*/

    public function wanted(){
        return $this->fetch();
    }
    public function wantedData(){
        $where=[];
        $platModel=new Platformm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$platModel->wantedData($where,$page,$limit);
        $count=$platModel->countWanted($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }

    /*
     * addArticle
     * */
    public function addWanted(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='wt_addtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$platModel->countWanted($where);
            //生成用户编号；
            $data['wt_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['wt_name']=trim($_POST['wt_name']);
            $data['wt_salary']=trim($_POST['wt_min']).'-'.trim($_POST['wt_max']);
            $data['wt_num']=trim($_POST['wt_num']);
            $data['wt_deadline']=strtotime($_POST['wt_deadline']);
            $data['wt_duty']=trim($_POST['wt_duty']);
            $data['wt_skills']=trim($_POST['wt_skills']);
            $data['wt_p_id']=intval(trim($_POST['wt_p_id']));
            $data['wt_c_id']=intval(trim($_POST['wt_c_id']));
            $data['wt_m_id']=intval(trim($_POST['wt_m_id']));
            $data['wt_addtime']=time();
            $data['wt_updatetime']=time();
            $data['wt_status']=2;
            $data['wt_admin']=$admin_id;
            $add=$platModel->addWanted($data);
            if($add){
                $this->success('添加成功','wanted',$_POST);
            }else{
                $this->error('添加失败','wanted');
            }
        }else{
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            return $this->fetch();
        }
    }

    /*
     * editArticle
     * */
    public function editWanted(){
        $wt_id=intval(trim($_GET['wt_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $data['wt_id']=$wt_id;
            $data['wt_name']=trim($_POST['wt_name']);
            $data['wt_salary']=trim($_POST['wt_min']).'-'.trim($_POST['wt_max']);
            $data['wt_num']=trim($_POST['wt_num']);
            $data['wt_deadline']=strtotime($_POST['wt_deadline']);
            $data['wt_duty']=trim($_POST['wt_duty']);
            $data['wt_skills']=trim($_POST['wt_skills']);
            $data['wt_p_id']=intval(trim($_POST['wt_p_id']));
            $data['wt_c_id']=intval(trim($_POST['wt_c_id']));
            $data['wt_m_id']=intval(trim($_POST['wt_m_id']));
            $data['wt_addtime']=time();
            $data['wt_status']=intval(trim($_POST['wt_status']));
            $data['wt_tip']=trim($_POST['wt_tip']);
            $data['wt_admin']=$admin_id;
            $edit=$platModel->editWanted($data);
            if($edit){
                $this->success('修改成功','wanted');
            }else{
                $this->error('修改失败','wanted');
            }
        }else{
            $wanted=$platModel->findWanted($wt_id);
            $salary=$wanted['wt_salary'];
            $wanted['wt_min']=explode('-',$salary)[0];
            $wanted['wt_max']=explode('-',$salary)[1];
            $wanted['wt_deadline']=date('Y-m-d',$wanted['wt_deadline']);
            $this->assign('wanted',$wanted);
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            //城市信息
            $p_id=$wanted['wt_p_id'];
            $where=[
                'c_p_id' => $p_id
            ];
            $city=$setModel->cityData($where,1,50);
            $this->assign('city',$city);
            //站点信息
            $c_id=$wanted['wt_c_id'];
            $wheres=[
                'b_city' =>$c_id
            ];
            $setInfom=new Setinfom();
            $branch=$setInfom->branchData($wheres,1,50);
            $this->assign('branch',$branch);
            //商户信息
            $m_id=$wanted['wt_m_id'];
            $whrere=[
                'mt_id' => $m_id
            ];
            $adminModel=new Adminm();
            $merchant=$adminModel->merchantData($whrere,1,50);
            $this->assign('merchant',$merchant);
            return $this->fetch();
        }
    }


    /*
     * art_id
     * */
    public function delWanted(){
        $wt_id=intval(trim($_GET['wt_id']));
        $platModel=new Platformm();
        $del=$platModel->delWanted($wt_id);
        if($del){
            $this->success('删除成功','wanted');
        }else{
            $this->error('删除失败','wanted');
        }
    }

    /*
     * articleStatus
     * */
    public function wantedStatus(){
        $data['wt_id']=intval(trim($_GET['wt_id']));
        $data['wt_isable']=intval(trim($_GET['wt_isable']));
        $userData=session('userData');
        $data['wt_admin']=$userData['ad_id'];
        if(isset($data['wt_id']) && isset($data['wt_isable'])){
            $platModel=new Platformm();
            $change=$platModel->editWanted($data);
            if($data['wt_isable'] == 1){
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
    public function wantedTop(){
        $data['wt_id']=intval(trim($_GET['wt_id']));
        $data['wt_istop']=intval(trim($_GET['wt_istop']));
        $userData=session('userData');
        $data['wt_admin']=$userData['ad_id'];
        if(isset($data['wt_id']) && isset($data['wt_istop'])){
            $platModel=new Platformm();
            $change=$platModel->editWanted($data);
            if($data['wt_istop'] == 1){
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

/*---人才招聘 end ------------------------------------------------------------------------------------------------------*/

/*---问答管理 start ------------------------------------------------------------------------------------------------------*/

    public function question(){
        return $this->fetch();
    }


    public function questionData(){
        $where=[];
        $platModel=new Platformm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$platModel->questionData($where,$page,$limit);
        $count=$platModel->countQuestion($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }


    public function addQuestion(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='qa_addtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$platModel->countQuestion($where);
            //生成用户编号；
            $data['qa_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['qa_question']=trim($_POST['qa_question']);
            $data['qa_p_id']=intval(trim($_POST['qa_p_id']));
            $data['qa_c_id']=intval(trim($_POST['qa_c_id']));
            $data['qa_m_id']=intval(trim($_POST['qa_m_id']));
            $data['qa_istop']=intval(trim($_POST['qa_istop']));
            $data['qa_addtime']=time();
            $data['qa_status']=2;
            $data['qa_type']=1;
            $data['qa_admin']=$admin_id;
            $add=$platModel->addQuestion($data);
            if($add){
                $this->success('添加成功','question',$_POST);
            }else{
                $this->error('添加失败','question');
            }
        }else{
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            return $this->fetch();
        }
    }


    public function editQuestion(){
        $qa_id=intval(trim($_GET['qa_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $data['qa_id']=$qa_id;
            $data['qa_question']=trim($_POST['qa_question']);
            $data['qa_p_id']=intval(trim($_POST['qa_p_id']));
            $data['qa_c_id']=intval(trim($_POST['qa_c_id']));
            $data['qa_m_id']=intval(trim($_POST['qa_m_id']));
            $data['qa_status']=intval(trim($_POST['qa_status']));
            $data['qa_tip']=trim($_POST['qa_status']);
            $data['qa_admin']=$admin_id;
            $edit=$platModel->editQuestion($data);
            if($edit){
                $this->success('修改成功','question');
            }else{
                $this->error('修改失败','question');
            }
        }else{
            $wanted=$platModel->findQuestion($qa_id);
            $this->assign('question',$wanted);
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            //城市信息
            $p_id=$wanted['qa_p_id'];
            $where=[
                'c_p_id' => $p_id
            ];
            $city=$setModel->cityData($where,1,50);
            $this->assign('city',$city);
            //商户信息
            $m_id=$wanted['qa_m_id'];
            $whrere=[
                'mt_id' => $m_id
            ];
            $adminModel=new Adminm();
            $merchant=$adminModel->merchantData($whrere,1,50);
            $this->assign('merchant',$merchant);
            return $this->fetch();
        }
    }


    /*
     * art_id
     * */
    public function delQuestion(){
        $qa_id=intval(trim($_GET['qa_id']));
        $platModel=new Platformm();
        $del=$platModel->delQuestion($qa_id);
        if($del){
            $this->success('删除成功','question');
        }else{
            $this->error('删除失败','question');
        }
    }

    /*
     * articleStatus
     * */
    public function questionStatus(){
        $data['qa_id']=intval(trim($_GET['qa_id']));
        $data['qa_isable']=intval(trim($_GET['qa_isable']));
        $userData=session('userData');
        $data['qa_admin']=$userData['ad_id'];
        if(isset($data['qa_id']) && isset($data['qa_isable'])){
            $platModel=new Platformm();
            $change=$platModel->editQuestion($data);
            if($data['qa_isable'] == 1){
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
    public function questionTop(){
        $data['qa_id']=intval(trim($_GET['qa_id']));
        $data['qa_istop']=intval(trim($_GET['qa_istop']));
        $userData=session('userData');
        $data['qa_admin']=$userData['ad_id'];
        if(isset($data['qa_id']) && isset($data['qa_istop'])){
            $platModel=new Platformm();
            $change=$platModel->editQuestion($data);
            if($data['qa_istop'] == 1){
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
     * 回复列表
     * */
    public function answer(){
        $qa_id=intval(trim($_GET['qa_id']));
        $where=[
            'qaa_question' => $qa_id
        ];
        $platModel=new Platformm();
        $question=$platModel->findQuestion($qa_id);
        $this->assign('question',$question);
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $answerData=$platModel->answerData($where,$page,$limit);
        $this->assign('answer',$answerData);
        return $this->fetch();

    }


    public function addAnswer(){
        $qa_id=intval(trim($_GET['qa_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='qaa_addtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$platModel->countAnswer($where);
            //生成用户编号；
            $data['qaa_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['qaa_answer']=trim($_POST['qaa_answer']);
            $data['qaa_question']=$qa_id;
            $data['qaa_istop']=intval(trim($_POST['qaa_istop']));
            $data['qaa_addtime']=time();
            $data['qaa_status']=2;
            $data['qaa_isable']=1;
            $data['qaa_type']=1;
            $data['qaa_admin']=$admin_id;
            $add=$platModel->addAnswer($data);
            if($add){
                $this->success('添加成功','question');
            }else{
                $this->error('添加失败','question');
            }
        }else{
            $question=$platModel->findQuestion($qa_id);
            $this->assign('question',$question);
            return $this->fetch();
        }
    }


    public function editAnswer(){
        $qaa_id=intval(trim($_GET['qaa_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        if($_POST){
            $data['qaa_id']=$qaa_id;
            $data['qaa_answer']=trim($_POST['qaa_answer']);
            $data['qaa_status']=intval(trim($_POST['qaa_status']));
            $data['qaa_tip']=trim($_POST['qaa_tip']);
            $data['qaa_admin']=$admin_id;
            $edit=$platModel->editAnswer($data);
            if($edit){
                $this->success('修改成功','question');
            }else{
                $this->error('修改失败','question');
            }
        }else{
            $answer=$platModel->findAnswer($qaa_id);
            $question=$platModel->findQuestion($answer['qaa_question']);
            $this->assign('question',$question);
            $this->assign('answer',$answer);
            return $this->fetch();
        }
    }


    /*
     * art_id
     * */
    public function delAnswer(){
        $qaa_id=intval(trim($_GET['qaa_id']));
        $platModel=new Platformm();
        $del=$platModel->delAnswer($qaa_id);
        if($del){
            $this->success('删除成功','question');
        }else{
            $this->error('删除失败','question');
        }
    }

    /*
     * articleStatus
     * */
    public function answerStatus(){
        $data['qaa_id']=intval(trim($_POST['qaa_id']));
        $data['qaa_isable']=intval(trim($_POST['change']));
        $userData=session('userData');
        $data['qaa_admin']=$userData['ad_id'];
        if(isset($data['qaa_id']) && isset($data['qaa_id'])){
            $platModel=new Platformm();
            $change=$platModel->editAnswer($data);
            if($data['qaa_isable'] == 1){
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
    public function answerTop(){
        $data['qaa_id']=intval(trim($_POST['qaa_id']));
        $data['qaa_istop']=intval(trim($_POST['change']));
        $userData=session('userData');
        $data['qaa_admin']=$userData['ad_id'];
        if(isset($data['qaa_id']) && isset($data['qaa_istop'])){
            $platModel=new Platformm();
            $change=$platModel->editAnswer($data);
            if($data['qaa_istop'] == 1){
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




/*---问答管理 end ------------------------------------------------------------------------------------------------------*/






/***********************************************************************************************************************/
/*-----黄金分割线----以下内容是广告管理--------------------------------------------------------------------------------*/
/***********************************************************************************************************************/





/*-----广告管理--------------------------------------------------------------------------------------------------------*/


    /*
     * 站点广告
     * */
    public function banner(){
        return $this->fetch();
    }

    /*
     * 商户广告
     * */
    public function bannerm(){
        return $this->fetch();
    }

    /*
     * 商户广告数据
     * */
    public function bannermData(){
        $where=[
            'ba_type' => 2
        ];
        $platModel=new Platformm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$platModel->bannerData($where,$page,$limit);
        $count=$platModel->countBanner($where);
        $res['code'] = 0;
        $res['msg'] = "";
        $res['data'] = $data;
        $res['count'] = $count;
        return json($res);
    }

    /*
     *广告数据
     * */
    public function bannerData(){
        $where=[
            'ba_type' => 1
        ];
        $platModel=new Platformm();
        $page= $this->request->param('page',1,'intval');
        $limit=$this->request->param('limit',15,'intval');
        $data=$platModel->bannerData($where,$page,$limit);
        $count=$platModel->countBanner($where);
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
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='ba_createtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$platModel->countBanner($where);
            //生成用户编号；
            $data['ba_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['ba_createtime']=time();
            $data['ba_updatetime']=time();
            $data['ba_status']=2;
            $data['ba_title']=trim($_POST['ba_title']);
            $data['ba_img']=trim($_POST['pc_img']).','.trim($_POST['ba_img']);
            $data['ba_alt']=trim($_POST['ba_alt']);
            $data['ba_url']=trim($_POST['ba_url']).','.trim($_POST['ba_url1']);
            $data['ba_p_id']=intval(trim($_POST['ba_p_id']));
            $data['ba_c_id']=intval(trim($_POST['ba_c_id']));
            $data['ba_m_id']=intval(trim($_POST['ba_p_id']));
            $data['ba_order']=intval(trim($_POST['ba_order']));
            $data['ba_type']=intval(trim($_POST['ba_type']));
            $data['ba_admin']=$admin_id;
            $add=$platModel->addBanner($data);
            if($add){
                $this->success('添加成功','banner');
            }else{
                $this->error('添加失败','banner');
            }
        }else{
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            return $this->fetch();
        }
    }



    /*
     * addbannerm
     * */
    public function addBannerm(){
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $stime=strtotime(date('Y-m-d 00:00:00'));
            $etime=strtotime(date('Y-m-d 23:59:59'));
            $where='ba_createtime between '.$stime.' and '.$etime;
            //获取当日预约的数量
            $buNum=$platModel->countBanner($where);
            //生成用户编号；
            $data['ba_bid'] = date('Ymd').sprintf("%04d", $buNum+1);
            $data['ba_createtime']=time();
            $data['ba_updatetime']=time();
            $data['ba_status']=2;
            $data['ba_title']=trim($_POST['ba_title']);
            $data['ba_img']=trim($_POST['pc_img']).','.trim($_POST['ba_img']);
            $data['ba_alt']=trim($_POST['ba_alt']);
            $data['ba_url']=trim($_POST['ba_url']).','.trim($_POST['ba_url1']);
            $data['ba_p_id']=intval(trim($_POST['ba_p_id']));
            $data['ba_c_id']=intval(trim($_POST['ba_c_id']));
            $data['ba_m_id']=intval(trim($_POST['ba_p_id']));
            $data['ba_order']=intval(trim($_POST['ba_order']));
            $data['ba_type']=intval(trim($_POST['ba_type']));
            $data['ba_admin']=$admin_id;
            $add=$platModel->addBanner($data);
            if($add){
                $this->success('添加成功','banner');
            }else{
                $this->error('添加失败','banner');
            }
        }else{
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            return $this->fetch();
        }
    }


    /*
     * reOrderBanner
     * */
    public function reOrderBanner(){
        $data['ba_id']=intval(trim($_POST['ba_id']));
        $data['ba_order']=intval(trim($_POST['value']));
        $userData=session('userData');
        $data['ba_admin']=$userData['ad_id'];
        $platModel=new Platformm();
        $edit=$platModel->editBanner($data);
        if($edit){
            $this->success('修改排序成功','banner');
        }else{
            $this->error('修改排序失败','banner');
        }
    }



    public function editBanner(){
        $ba_id=intval(trim($_GET['ba_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $data['ba_id']=$ba_id;
            $data['ba_status']=intval(trim($_POST['ba_status']));
            $data['ba_tip']=trim($_POST['ba_tip']);
            $data['ba_title']=trim($_POST['ba_title']);
            $data['ba_img']=trim($_POST['pc_img']).','.trim($_POST['ba_img']);
            $data['ba_alt']=trim($_POST['ba_alt']);
            $data['ba_url']=trim($_POST['ba_url']).','.trim($_POST['ba_url1']);
            $data['ba_p_id']=intval(trim($_POST['ba_p_id']));
            $data['ba_c_id']=intval(trim($_POST['ba_c_id']));
            $data['ba_m_id']=intval(trim($_POST['ba_p_id']));
            $data['ba_order']=intval(trim($_POST['ba_order']));
            $data['ba_type']=intval(trim($_POST['ba_type']));
            $data['ba_admin']=$admin_id;
            $edit=$platModel->editBanner($data);
            if($edit){
                $this->success('修改成功','banner');
            }else{
                $this->error('修改失败','banner');
            }
        }else{
            $banner=$platModel->findBanner($ba_id);
            $banner['pc_img']=explode(',',$banner['ba_img'])[0]?explode(',',$banner['ba_img'])[0]:'';
            $banner['ba_img']=explode(',',$banner['ba_img'])[1]?explode(',',$banner['ba_img'])[1]:'';
            $banner['ba_url1']=explode(',',$banner['ba_url'])[1]?explode(',',$banner['ba_url'])[1]:'';
            $banner['ba_url']=explode(',',$banner['ba_url'])[0]?explode(',',$banner['ba_url'])[0]:'';
            $this->assign('banner',$banner);
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            //城市信息
            $p_id=$banner['ba_p_id'];
            $where=[
                'c_p_id' => $p_id
            ];
            $city=$setModel->cityData($where,1,50);
            $this->assign('city',$city);
            //商户信息
            $m_id=$banner['ba_m_id'];
            $whrere=[
                'mt_id' => $m_id
            ];
            $adminModel=new Adminm();
            $merchant=$adminModel->merchantData($whrere,1,50);
            $this->assign('merchant',$merchant);
            return $this->fetch();
        }
    }
    public function editBannerm(){
        $ba_id=intval(trim($_GET['ba_id']));
        $userData=session('userData');
        $admin_id=$userData['ad_id'];
        $platModel=new Platformm();
        $setModel=new Setupm();
        if($_POST){
            $data['ba_id']=$ba_id;
            $data['ba_status']=intval(trim($_POST['ba_status']));
            $data['ba_tip']=trim($_POST['ba_tip']);
            $data['ba_title']=trim($_POST['ba_title']);
            $data['ba_img']=trim($_POST['pc_img']).','.trim($_POST['ba_img']);
            $data['ba_alt']=trim($_POST['ba_alt']);
            $data['ba_url']=trim($_POST['ba_url']).','.trim($_POST['ba_url1']);
            $data['ba_p_id']=intval(trim($_POST['ba_p_id']));
            $data['ba_c_id']=intval(trim($_POST['ba_c_id']));
            $data['ba_m_id']=intval(trim($_POST['ba_p_id']));
            $data['ba_order']=intval(trim($_POST['ba_order']));
            $data['ba_type']=intval(trim($_POST['ba_type']));
            $data['ba_admin']=$admin_id;
            $edit=$platModel->editBanner($data);
            if($edit){
                $this->success('修改成功','banner');
            }else{
                $this->error('修改失败','banner');
            }
        }else{
            $banner=$platModel->findBanner($ba_id);
            $banner['pc_img']=explode(',',$banner['ba_img'])[0]?explode(',',$banner['ba_img'])[0]:'';
            $banner['ba_img']=explode(',',$banner['ba_img'])[1]?explode(',',$banner['ba_img'])[1]:'';
            $banner['ba_url1']=explode(',',$banner['ba_url'])[1]?explode(',',$banner['ba_url'])[1]:'';
            $banner['ba_url']=explode(',',$banner['ba_url'])[0]?explode(',',$banner['ba_url'])[0]:'';
            $this->assign('banner',$banner);
            $prov=$setModel->provinceData([],1,40);
            $this->assign('prov',$prov);
            //城市信息
            $p_id=$banner['ba_p_id'];
            $where=[
                'c_p_id' => $p_id
            ];
            $city=$setModel->cityData($where,1,50);
            $this->assign('city',$city);
            //商户信息
            $m_id=$banner['ba_m_id'];
            $whrere=[
                'mt_id' => $m_id
            ];
            $adminModel=new Adminm();
            $merchant=$adminModel->merchantData($whrere,1,50);
            $this->assign('merchant',$merchant);
            return $this->fetch();
        }
    }

    /*
     * art_id
     * */
    public function delBanner(){
        $ba_id=intval(trim($_GET['ba_id']));
        $platModel=new Platformm();
        $del=$platModel->delBanner($ba_id);
        if($del){
            $this->success('删除成功','banner');
        }else{
            $this->error('删除失败','banner');
        }
    }

    /*
     * articleStatus
     * */
    public function bannerStatus(){
        $data['ba_id']=intval(trim($_GET['ba_id']));
        $data['ba_isable']=intval(trim($_GET['ba_isable']));
        $userData=session('userData');
        $data['ba_admin']=$userData['ad_id'];
        if(isset($data['ba_id']) && isset($data['ba_isable'])){
            $platModel=new Platformm();
            $change=$platModel->editBanner($data);
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






























/*-----广告管理--------------------------------------------------------------------------------------------------------*/










}