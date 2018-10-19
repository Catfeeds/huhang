<?php
/**
 * Created by PhpStorm.
 * User: Dang meng
 * Date: 2018/7/28
 * Time: 10:10
 */
namespace app\index\model;
use think\Db;
use think\Model;

class Newsm extends Model{
    public function articleViewInc($art_id){
        $inc=Db::table('huhang_article')->where(['art_id' =>$art_id])->setInc('art_view');
        return $inc ? true : false ;
    }
}