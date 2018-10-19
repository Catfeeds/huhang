<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Setinfom extends Model{


/*-------平台配置  start-----------------------------------------------------------------------------------------------*/

    /*
     * 平台配置读取数据
     * */
    public function setData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $setData=Db::table('huhang_setinfo')
            ->join('huhang_admin','huhang_setinfo.s_admin = huhang_admin.ad_id ')
            ->where($where)
            ->limit($per,$limit)
            ->order('s_id desc')
            ->field('huhang_setinfo.*,huhang_admin.ad_realname')
            ->select();
        foreach($setData as $k => $v){
            $setData[$k]['s_opeatime']=date('Y-m-d H:i:s',$v['s_opeatime']);
        }
        return $setData ? $setData : null;
    }


    /*
     * 统计
     * */
    public function countSet($where){
        $count=Db::table('huhang_setinfo')->where($where)->count();
        return $count ? $count : 0;
    }
    /*
     * 查找一条数据
     * */
    public function findSet($s_id){
        $find=Db::table('huhang_setinfo')->find($s_id);
        return $find ? $find : null;
    }



    /*
     * 添加平台配置
     * */
    public function addSet($data){
        $add=Db::table('huhang_setinfo')->insert($data);
        return $add ? $add : 0;
    }

    /*
     * 修改平台配置
     * */
    public function editSet($data){
        $s_id=$data['s_id'];
        $update=Db::table('huhang_setinfo')->where(['s_id' => $s_id])->update($data);
        return $update ? true : false;
    }

    /*
     * 删除平台配置
     * */
    public function delSet($s_id){
        $del=Db::table('huhang_setinfo')->delete($s_id);
        return $del ? true : false;
    }


/*-------平台配置  end-------------------------------------------------------------------------------------------------*/



    /*
     * 站点管理
     *2018/07/13
     * */
/*-------站点管理  end-------------------------------------------------------------------------------------------------*/

    /*
     * 数据读取
     * */
    public function branchData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $branchData=Db::table('huhang_branch')
            ->join('huhang_admin','huhang_branch.b_admin = huhang_admin.ad_id')
            ->join('huhang_province','huhang_branch.b_province = huhang_province.p_id ')
            ->join('huhang_city','huhang_branch.b_city = huhang_city.c_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('b_id desc')
            ->field('huhang_branch.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name')
            ->select();
        foreach($branchData as $k => $v){
            $branchData[$k]['b_createtime']=date('Y-m-d H:i:s',$v['b_createtime']);
            $branchData[$k]['p_name']=$v['p_name'].'-'.$v['c_name'];
        }
        return $branchData ? $branchData : null;
    }

    /*
     * 数据统计
     * */
    public function branchCount($where){
        $count=Db::table('huhang_branch')->where($where)->count();
        return $count ? $count : 0;
    }

    /*
     * 查找一条数据
     * */
    public function findBranch($b_id){
        $find=Db::table('huhang_branch')->find($b_id);
        return $find ? $find :null;
    }

    /*
     * 开通分站
     * */
    public function addBranch($data){
        $add=Db::table('huhang_branch')->insert($data);
        return $add ? $add : 0;
    }

    /*
     * 修改分站
     * */
    public function editBranch($data){
        $b_id=$data['b_id'];
        $edit=Db::table('huhang_branch')->where(['b_id' => $b_id])->update($data);
        return $edit ? true : false;
    }

    /*
     * 删除分站
     * */
    public function delBranch($b_id){
        $del=Db::table('huhang_branch')->delete($b_id);
        return $del ? true : false ;
    }
/*-------站点管理  end-------------------------------------------------------------------------------------------------*/




/*-------模板管理  start-----------------------------------------------------------------------------------------------*/

    /*
     * 模板数据读取
     * */
    public function temData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $temData=Db::table('huhang_templet')
            ->join('huhang_admin','huhang_templet.tem_admin = huhang_admin.ad_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('tem_id')
            ->field('huhang_templet.*,huhang_admin.ad_realname')
            ->select();
        foreach($temData as $k => $v){
            $temData[$k]['tem_addtime']=date('Y-m-d H:i:s',$v['tem_addtime']);
        }
        return $temData ? $temData : null;
    }
/*-------模板管理  end-------------------------------------------------------------------------------------------------*/




}