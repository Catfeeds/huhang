<?php
/**
 * Name: 商户端-通用模块-model
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/31
 * Time: 9:49
 */
namespace app\commerce\model;
use think\Db;
use think\Model;
use think\Request;

class Comm extends Model{
    /*
     * layui的富文本编辑器
     * */
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


    public function getSecurityViaMtId($mt_id){
        $security=Db::table('huhang_merchant_admin')
            ->where(['ma_mt_id' => $mt_id])
            ->find();
        return $security ? $security : null;
    }
}