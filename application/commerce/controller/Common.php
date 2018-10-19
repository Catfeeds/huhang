<?php
/**
 * Name: 商户端-通用模块-controller
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/31
 * Time: 9:58
 */
namespace app\commerce\controller;
use think\Controller;
use think\Request;
class Common extends Controller {
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
}