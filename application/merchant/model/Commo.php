<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/25
 * Time: 16:19
 */
namespace app\merchant\model;
use think\Db;
use think\Model;

class Commo extends Model{
    /*
     * 商家导航
     * */
    public function merNav(){
        $nav=Db::table('huhang_nav')
            ->where(['nav_type' => 2,'nav_isable' =>1])
            ->order('nav_order desc')
            ->select();
        return $nav ? $nav : null;
    }



    /*
     * 根据商户的id获取城市名称
     * */
    public function getMerchantInfoViaMerId($mt_id){
        $cityName=Db::table('huhang_merchant')
            ->join('huhang_city','huhang_city.c_id = huhang_merchant.mt_c_id')
            ->where(['mt_id' => $mt_id])
            ->field('huhang_city.c_name,huhang_merchant.mt_manger,huhang_merchant.mt_address,huhang_merchant.mt_address,huhang_merchant.mt_hotline,huhang_merchant.mt_rank')
            ->find();
        return $cityName ? $cityName : null;
    }




    /*
     * 获取连接中的关键字
     * */
    //获取连接中关键字的方法
    public function saveKeyword($domain,$path){
        $keywords="";
        if(strpos($domain, 'google.com.tw')!==false && preg_match('/q=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // google taiwan
        }
        if(strpos($domain,'google.cn')!==false && preg_match('/q=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // google china
        }
        if(strpos($domain,'google.com')!==false && preg_match('/q=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // google
        }elseif(strpos($domain,'baidu.')!==false && preg_match('/wd=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // baidu
        }elseif(strpos($domain,'baidu.')!==false && preg_match('/word=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // baidu
        }elseif(strpos($domain,'114.vnet.cn')!== false && preg_match('/kw=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // ct114
        }elseif(strpos($domain,'iask.com')!==false && preg_match('/k=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // iask
        }elseif(strpos($domain,'soso.com')!==false && preg_match('/w=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // soso
        }elseif(strpos($domain, 'sogou.com')!==false && preg_match('/query=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // sogou
        }elseif(strpos($domain,'so.163.com')!==false && preg_match('/q=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // netease
        }elseif(strpos($domain,'yodao.com')!== false && preg_match('/q=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // yodao
        }elseif(strpos($domain,'zhongsou.com')!==false && preg_match('/word=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // zhongsou
        }elseif(strpos($domain,'search.tom.com')!==false && preg_match('/w=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // tom
        }elseif(strpos($domain,'live.com')!==false && preg_match('/q=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // MSLIVE
        }elseif(strpos($domain, 'tw.search.yahoo.com')!==false && preg_match('/p=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // yahoo taiwan
        }elseif(strpos($domain,'cn.yahoo.')!==false && preg_match('/p=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // yahoo china
        }elseif(strpos($domain,'yahoo.')!==false && preg_match('/p=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // yahoo
        }elseif(strpos($domain,'msn.com.tw')!==false && preg_match('/q=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // msn taiwan
        }elseif(strpos($domain,'msn.com.cn')!==false && preg_match('/q=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // msn china
        }elseif(strpos($domain,'msn.com')!==false && preg_match('/q=([^&]*)/i',$path,$regs)){
            $keywords = urldecode($regs[1]); // msn
        }
        return $keywords;
    }

}