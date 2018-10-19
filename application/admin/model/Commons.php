<?php
/**
 * Created by PhpStorm.
 * User: Dang Meng
 * Date: 2018/8/10
 * Time: 10:37
 */
namespace app\admin\model;
use think\Model;

class Commons extends Model{
    public function index($ip){
        $ip = @file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=".$ip);
        $ip = json_decode($ip,true);
        return $ip;
    }
}