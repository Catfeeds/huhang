<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class Setupm extends Model{




    /*
     * 类型参数请求数据
     * @param    array      $where    搜索条件
     * @param    string     $page     页码
     * @param    string     $limit    一页显示长度
     * @return   array
     * */
    public function typeData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $typeData=Db::table('huhang_type')
            ->join('huhang_admin','huhang_type.type_admin = huhang_admin.ad_id ')
            ->where($where)
            ->limit($per,$limit)
            ->order('type_order desc')
            ->field('huhang_type.*,huhang_admin.ad_realname')
            ->select();
        foreach ($typeData as $k => $v){
            $typeData[$k]['type_addtime'] = date('Y-m-d H:i:s',$v['type_addtime']);
        }
        return $typeData ? $typeData : null;
    }


    /*
     * 选取设计师
     * */
    public function designer($where){
        $designer=Db::table('huhang_designer')
            ->where($where)
            ->order('des_istop,des_view desc')
            ->field('des_id,des_name')
            ->select();
        return $designer ? $designer : null;
    }




    /*
     * 添加一个类型参数
     *  @param    array $data 添加的数据
     *  @return   string、添加成功返回的自增id
     * */
    public function addType($data){
        $add=Db::table('huhang_type')->insert($data);
        return $add ? $add : null;
    }



    /*
     * 查找一个类型参数
     *  @param    array $type_id 添加的数据
     *  @return   string、添加成功返回的自增id
     * */
    public function findType($type_id){
        $add=Db::table('huhang_type')->find($type_id);
        return $add ? $add : null;
    }




    /*
     * 修改一个类型参数
     * @param    array 修改的数据
     * @return boolean
     * */
    public function editType($data){
        $type_id=$data['type_id'];
        $update=Db::table('huhang_type')
            ->where(['type_id' => $type_id])
            ->update($data);
        return $update ? true : false;
    }



    /*
     * 删除类型
     * @param  string $type_id 类型id
     * @return boolean
     * */
    public function delType($type_id){
        $res =Db::table('huhang_type')->delete($type_id);
        return $res ? true : false;
    }


    /*
     * 类型总长度
     * @param    array      $where    搜索条件
     * */
    public function typeCount($where){
        $count=Db::table('huhang_type')
            ->where($where)
            ->count();
        return $count ? $count : 0;
    }









    /*
     * 空间大小数据显示
     * */

    public function spaceData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $spaceData=Db::table('huhang_space')
            ->join('huhang_admin','huhang_space.sp_admin = huhang_admin.ad_id ')
            ->where($where)
            ->limit($per,$limit)
            ->order('sp_order desc')
            ->field('huhang_space.*,huhang_admin.ad_realname')
            ->select();
        foreach ($spaceData as $k => $v){
            $spaceData[$k]['sp_addtime'] = date('Y-m-d H:i:s',$v['sp_addtime']);
        }
        return $spaceData ? $spaceData : null;
    }


    /*
     * 空间大小统计
     * */

    public function spaceCount($where){
        $count=Db::table('huhang_space')
            ->where($where)
            ->count();
        return $count ? $count : 0;
    }


    /*
     * 添加空间大小
     * */
    public function addSpace($data){
        $add=Db::table('huhang_space')->insert($data);
        return $add ? $add : null;
    }



    /*
     * 修改空间大小
     * */
    public function editSpace($data){
        $sp_id=$data['sp_id'];
        $update=Db::table('huhang_space')->where(['sp_id' =>$sp_id])->update($data);
        return $update ? true : false;
    }


    /*
     * 删除空间大小
     * */
    public function delSpace($sp_id){
        $del=Db::table('huhang_space')->delete($sp_id);
        return $del ? true : false;
    }


    /*
     * 查找一个空间大小
     * */
    public function findSpace($sp_id)
    {
        $space=Db::table('huhang_space')->find($sp_id);
        return $space ? $space : null;
    }





    /*
     * 读取省份信息
     * */
    public function provinceData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $provinceData=Db::table('huhang_province')
            ->join('huhang_admin','huhang_province.p_admin = huhang_admin.ad_id ')
            ->where($where)
            ->limit($per,$limit)
            ->field('huhang_province.*,huhang_admin.ad_realname')
            ->select();
        foreach ($provinceData as $k => $v){
            $provinceData[$k]['p_opeatime'] = date('Y-m-d H:i:s',$v['p_opeatime']);
        }
        return $provinceData ? $provinceData : null;
    }


    /*
     * provinceCount
     * */
    public function provinceCount($where){
        $count=Db::table('huhang_province')
            ->join('huhang_admin','huhang_province.p_admin = huhang_admin.ad_id ')
            ->where($where)
            ->count();
        return $count ? $count : 0;
    }



    /*
     *  读取城市信息
     *
     * */

    public function cityData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $cityData=Db::table('huhang_city')
            ->join('huhang_province','huhang_province.p_id = huhang_city.c_p_id')
            ->join('huhang_city_rank','huhang_city_rank.cr_id = huhang_city.c_rank')
            ->join('huhang_admin','huhang_admin.ad_id = huhang_city.c_admin')
            ->where($where)
            ->limit($per,$limit)
            ->field('huhang_city.*,huhang_province.p_name,huhang_city_rank.cr_name,huhang_admin.ad_realname')
            ->select();
        foreach($cityData as $k =>$v){
            $cityData[$k]['c_opeatime']= date('Y-m-d H:i:s',$v['c_opeatime']);
        }
        return $cityData ? $cityData : null;
    }


    /*
     * cityCount
     * */
    public function cityCount($where){
        $count=Db::table('huhang_city')
            ->join('huhang_province','huhang_province.p_id = huhang_city.c_p_id')
            ->join('huhang_city_rank','huhang_city_rank.cr_id = huhang_city.c_rank')
            ->join('huhang_admin','huhang_admin.ad_id = huhang_city.c_admin')
            ->where($where)
        ->count();
        return $count ? $count : 0;
    }









        /*
         * 添加省份
         *
         * */
    public function addProv($data){
        $add=Db::table('huhang_province')->insert($data);
        return $add ? $add : null;
    }



    /*
     * 修改省份
     *
     * */
    public function editProv($data){
        $p_id=$data['p_id'];
        $update=Db::table('huhang_province')->where(['p_id' =>$p_id])->update($data);
        return $update ? true : false;
    }




    /*
     * 删除省份
     *
     * */
    public function delProv($p_id){
        $del=Db::table('huhang_province')->delete($p_id);
        return $del ? true : false;
    }





    /*
     * findProv
     * */
    public function findProv($p_id){
        $res=Db::table('huhang_province')->find($p_id);
        return $res ? $res : null;
    }





    /*
     * 添加城市
     *
     * */
    public function addCity($data){
        $add=Db::table('huhang_city')->insert($data);
        return $add ? $add : null;
    }



    /*
     * 修改城市
     *
     * */
    public function editCity($data){
        $c_id=$data['c_id'];
        $update=Db::table('huhang_city')->where(['c_id' =>$c_id])->update($data);
        return $update ? true : false;
    }




    /*
     * 删除城市
     *
     * */
    public function delCity($c_id){
        $del=Db::table('huhang_city')->delete($c_id);
        return $del ? true : false;
    }





    /*
     * findCity
     * */
    public function findCity($c_id){
        $res=Db::table('huhang_city')->find($c_id);
        return $res ? $res : null;
    }













/*-------服务类型  start-----------------------------------------------------------------------------------------------*/

    /*
     * 服务类型数据读取
     * */
    public function serviceData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $serviceData=Db::table('huhang_service_type')
            ->join('huhang_admin','huhang_service_type.st_admin = huhang_admin.ad_id ')
            ->where($where)
            ->limit($per,$limit)
            ->order('st_order desc')
            ->field('huhang_service_type.*,huhang_admin.ad_realname')
            ->select();
        foreach($serviceData as $k => $v){
            $serviceData[$k]['st_addtime']=date('Y-m-d H:i:s',$v['st_addtime']);
        }
        return $serviceData ? $serviceData : null;
    }


    /*
     * 服务类型数据统计
     * */
    public function serviceCount($where){
        $count=Db::table('huhang_service_type')->where($where)->count();
        return $count ? $count : 0;
    }



    /*
     * 添加数据类型
     * */

    public function addService($data){
        $add=Db::table('huhang_service_type')->insert($data);
        return $add ? $add : null;
    }


    /*
     * 修改数据类型
     *
     * */
    public function editService($data){
        $st_id=$data['st_id'];
        $update=Db::table('huhang_service_type')->where(['st_id' => $st_id])->update($data);
        return $update ? true : false;
    }



    /*
     * 查询某一条数据
     *
     * */
    public function findService($st_id){
        $find=Db::table('huhang_service_type')->find($st_id);
        return $find ? $find : null;
    }


    /*
     * 删除某一条数据
     * */
    public function delService($st_id){
        $del=Db::table('huhang_service_type')->delete($st_id);
        return $del ? true : false;
    }


/*-------服务类型  end-----------------------------------------------------------------------------------------------*/





/*-------城市等级  start-----------------------------------------------------------------------------------------------*/


    /*
     * 城市等级数据读取
     * */
    public function cityRank($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $cityInfo=Db::table('huhang_city_rank')
            ->join('huhang_admin','huhang_city_rank.cr_admin = huhang_admin.ad_id ')
            ->where($where)
            ->limit($per,$limit)
            ->order('cr_order desc')
            ->field('huhang_city_rank.*,huhang_admin.ad_realname')
            ->select();
        foreach($cityInfo as $k =>$v){
            $cityInfo[$k]['cr_addtime']=date('Y-m-d H:i:s',$v['cr_addtime']);
            $cityInfo[$k]['cr_level_id']=explode(',',$v['cr_level_id']);
            $cityInfo[$k]['cr_level_price']=explode(',',$v['cr_level_price']);
            foreach ($cityInfo[$k]['cr_level_id'] as $item =>$value ){
                $cityInfo[$k]['cr_level_id'][$item]=Db::table('huhang_type')->where(['type_id' => $value])->find();
                $cityInfo[$k]['cr_level_ids'][$item]=$cityInfo[$k]['cr_level_id'][$item]['type_name'];
            }
        }
        foreach($cityInfo as $key => $val){
            $id_price = "";
            if(is_array($val['cr_level_ids']) && $val['cr_level_ids']){
                for($i = 0; $i < count($val['cr_level_ids']); $i++){
                    $id_price .= $val['cr_level_ids'][$i].'每平方米'.$val['cr_level_price'][$i].'元';
                    $cityInfo[$key]['cr_level_ids'] = $id_price;
                }
            }else{
                $cityInfo[$key]['cr_level_ids'] = '暂时没有定价标准';
            }
        }
        return $cityInfo ? $cityInfo : null;
    }

    /*
     * cityRankCount
     * */
    public function cityRankCount($where){
        $count=Db::table('huhang_city_rank')
            ->join('huhang_admin','huhang_city_rank.cr_admin = huhang_admin.ad_id ')
            ->where($where)
            ->count();
        return $count ? $count : 0;
    }

    /*
     * 数据添加
     * */
    public function addCityRank($data){
        $add=Db::table('huhang_city_rank')->insert($data);
        return $add ? $add : null;
    }


    /*
     * 数据修改
     * */
    public function editCityRank($data){
        $cr_id=$data['cr_id'];
        $update=Db::table('huhang_city_rank')->where(['cr_id' => $cr_id])->update($data);
        return $update ? true : false;
    }


    /*
     * 查找一条数据
     * */
    public function cityRankFind($cr_id){
        $quality=$this->typeData(['type_sort' =>3],'1','15');
        $find = Db::table('huhang_city_rank')->find($cr_id);
        $find['cr_level_price']=explode(',',$find['cr_level_price']);
        if($quality){
            foreach ($quality as $k => $v){
                $quality[$k]['price'] = "";
                for($i = 0 ; $i < count($find['cr_level_price']) ; $i++){
                    if($i == $k){
                        $quality[$k]['type_name'] = $v['type_name'];
                        $quality[$k]['price'] = $find['cr_level_price'][$i];
                    }
                }
            }
        }
        return $find ? $find : null;
    }

    /*
     * 删除一条数据
     * */
    public function delCityRank($cr_id){
        $del=Db::table('huhang_city_rank')->delete($cr_id);
        return $del ? true : false;
    }


/*-------城市等级  end-----------------------------------------------------------------------------------------------*/




/*-------前端模板  start-----------------------------------------------------------------------------------------------*/
    /*
     * 1.模板数据读取
     * */
    public function tempData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $tempData=Db::table('huhang_templet')
            ->join('huhang_admin','huhang_templet.tem_admin = huhang_admin.ad_id ')
            ->where($where)
            ->limit($per,$limit)
            ->order('tem_addtime desc')
            ->field('huhang_templet.*,huhang_admin.ad_realname')
            ->select();
        foreach($tempData as $k => $v){
            $tempData[$k]['tem_addtime'] = date('Y-m-d H:i:s',$v['tem_addtime']);
        }
        return $tempData ? $tempData : null;
    }

    /*
     * 2.统计总数
     * */
    public function countTemp($where){
        $count = Db::table('huhang_templet')->where($where)->count();
        return $count ? $count : 0;
    }

    /*
     * 3.添加模板
     * */
    public function addTemp($data){
        $add=Db::table('huhang_templet')->insert($data);
        return $add ? $add : 0;
    }


    /*
     * 4.修改模板
     * */
    public function editTemp($data){
        $temp_id=$data['tem_id'];
        $update=Db::table('huhang_templet')->where(['tem_id' => $temp_id])->update($data);
        return $update ? true : false ;
    }


    /*
     *5. 删除模板
     * */
    public function delTemp($tem_id){
        $del=Db::table('huhang_templet')->delete($tem_id);
        return $del ? true : false ;
    }

    /*
     * 6.查找一条数据
     * */
    public function findTemp($tem_id){
        $find=Db::table('huhang_templet')->find($tem_id);
        return $find ? $find : null;
    }


/*-------前端模板  end-----------------------------------------------------------------------------------------------*/






/*-------县区管理  start-----------------------------------------------------------------------------------------------*/

    /*
         * 1.县区数据读取
         * */
    public function areaData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $tempData=Db::table('huhang_area')
            ->join('huhang_admin','huhang_area.a_admin = huhang_admin.ad_id ')
            ->join('huhang_province','huhang_area.p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_area.c_id = huhang_city.c_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('a_addtime desc')
            ->field('huhang_area.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name')
            ->select();
        foreach($tempData as $k => $v){
            $tempData[$k]['a_addtime'] = date('Y-m-d H:i:s',$v['a_addtime']);
        }
        return $tempData ? $tempData : null;
    }

    /*
     * 2.统计总数
     * */
    public function countArea($where){
        $count = Db::table('huhang_area')->where($where)->count();
        return $count ? $count : 0;
    }

    /*
     * 3.添加模板
     * */
    public function addArea($data){
        $add=Db::table('huhang_area')->insert($data);
        return $add ? $add : 0;
    }


    /*
     * 4.修改模板
     * */
    public function editArea($data){
        $a_id=$data['a_id'];
        $update=Db::table('huhang_area')->where(['a_id' => $a_id])->update($data);
        return $update ? true : false ;
    }


    /*
     *5. 删除模板
     * */
    public function delArea($a_id){
        $del=Db::table('huhang_area')->delete($a_id);
        return $del ? true : false ;
    }

    /*
     * 6.查找一条数据
     * */
    public function findArea($a_id){
        $find=Db::table('huhang_area')->find($a_id);
        return $find ? $find : null;
    }




/*-------县区管理  end-----------------------------------------------------------------------------------------------*/




/*-------友情链接  start-----------------------------------------------------------------------------------------------*/

    /*
             * 1.友情链接数据读取
             * */
    public function friendData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $data=Db::table('huhang_friendlink')
            ->join('huhang_admin','huhang_friendlink.fl_admin = huhang_admin.ad_id ')
            ->join('huhang_province','huhang_friendlink.fl_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_friendlink.fl_c_id = huhang_city.c_id')
            ->where($where)
            ->limit($per,$limit)
            ->order('fl_istop,fl_isable,fl_updatetime desc')
            ->field('huhang_friendlink.*,huhang_admin.ad_realname,huhang_province.p_name,huhang_city.c_name')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['fl_p_id'] = $v['p_name'].'-'.$v['c_name'];
            $data[$k]['fl_updatetime'] = date('Y-m-d H:i:s',$v['fl_updatetime']);
            $art_status=$v['fl_status'];
            $typeName='';
            switch($art_status){
                case  1;
                    $typeName = '待审核';
                    break;
                case 2;
                    $typeName = '通过';
                    break;
                case  3;
                    $typeName = '驳回';
                    break;
            }
            $data[$k]['fl_status'] = $typeName;
        }
        return $data ? $data : null;
    }

    /*
     * 2.友情链接统计总数
     * */
    public function countFriend($where){
        $count = Db::table('huhang_friendlink')
            ->join('huhang_admin','huhang_friendlink.fl_admin = huhang_admin.ad_id ')
            ->join('huhang_province','huhang_friendlink.fl_p_id = huhang_province.p_id')
            ->join('huhang_city','huhang_friendlink.fl_c_id = huhang_city.c_id')
            ->where($where)->count();
        return $count ? $count : 0;
    }

    /*
     * 3.添加友情链接
     * */
    public function addFriend($data){
        $add=Db::table('huhang_friendlink')->insert($data);
        return $add ? $add : 0;
    }


    /*
     * 4.修改友情链接
     * */
    public function editFriend($data){
        $fl_id=$data['fl_id'];
        $update=Db::table('huhang_friendlink')->where(['fl_id' => $fl_id])->update($data);
        return $update ? true : false ;
    }


    /*
     *5. 删除友情链接
     * */
    public function delFriend($fl_id){
        $del=Db::table('huhang_friendlink')->delete($fl_id);
        return $del ? true : false ;
    }

    /*
     * 6.查找一条友情链接
     * */
    public function findFriend($fl_id){
        $find=Db::table('huhang_friendlink')->find($fl_id);
        return $find ? $find : null;
    }



    /*-------友情链接   end-----------------------------------------------------------------------------------------------*/




    /*
     * 投诉建议数据
     * */
    public function suggestData($where,$page,$limit){
        $per = ($page - 1) * $limit;
        $data=Db::table('huhang_suggestion')
            ->where($where)
            ->limit($per,$limit)
            ->order('sg_addtime desc')
            ->select();
        foreach($data as $k => $v){
            $data[$k]['sg_addtime'] = date('Y-m-d H:i:s',$v['sg_addtime']);
            $data[$k]['sg_updatetime'] = date('Y-m-d H:i:s',$v['sg_updatetime']);
            $data[$k]['ad_realname'] = $v['sg_admin'] ? Db::table('huhang_admin')->where(['ad_id' => $v['sg_admin']])->column('ad_realname') : '---';
            $sg_type=$v['sg_type'];
            $typeName='';
            switch($sg_type){
                case  1;
                    $typeName = '投诉商家';
                    break;
                case 2;
                    $typeName = '投诉平台';
                    break;
                case  3;
                    $typeName = '投诉员工';
                    break;
                case  4;
                    $typeName = '其他意见';
                    break;
                case  5;
                    $typeName = '鼓励表扬';
                    break;
            }
            $data[$k]['sg_type'] = $typeName;
        }
        return $data ? $data : null;
    }


    /*
     * countSuggest
     * */
    public function countSuggest($where){
        $count=Db::table('huhang_suggestion')
            ->where($where)
            ->count();
        return $count ? $count : 0 ;
    }

    /*
     * delSuggest
     * */
    public function delSuggest($sg_id){
        $del=Db::table('huhang_suggestion')->delete($sg_id);
        return $del ? true : false ;
    }



    /*
     * findSuggest
     * */
    public function findSuggest($sg_id){
        $find=Db::table('huhang_suggestion')->find($sg_id);
        switch($find['sg_type']){
            case  1;
                $find['sg_type'] = '投诉商家';
                break;
            case 2;
                $find['sg_type'] = '投诉平台';
                break;
            case  3;
                $find['sg_type'] = '投诉员工';
                break;
            case  4;
                $find['sg_type'] = '其他意见';
                break;
            case  5;
                $find['sg_type'] = '鼓励表扬';
                break;
        }
        $find['sg_addtime']=date('Y-m-d H:i:s',$find['sg_addtime']);
        return $find ? $find : null;
    }




    /*
     * 查找平台名称
     * */
    public function findPlatName(){
        $platName=Db::table('huhang_setinfo')->where(['s_key' => 'plat_name'])->column('s_value');
        return $platName ? $platName : null;
    }


    /*
     * getAdminRoleName
     * 根据角色id获取角色名称
     * */
    public function getAdminRoleName($role_id){
        $roleName=Db::table('huhang_role')
            ->where(['r_id' => $role_id])
            ->column('r_name');
        return $roleName ? $roleName : null;
    }

    /*
     * 查找平台微信二维码
     * */
    public function findPlatWechat(){
        $weChat=Db::table('huhang_setinfo')->where(['s_key' => 'plat_wechat'])->column('s_value');
        return $weChat ? $weChat : null;
    }

    /*
     * findWeiBo
     * */
    public function findWeiBo(){
        $weChat=Db::table('huhang_setinfo')->where(['s_key' => 'plat_weibo'])->column('s_value');
        return $weChat ? $weChat : null;
    }

    /*
     * findWeiBo
     * */
    public function findPlatUrl(){
        $weChat=Db::table('huhang_setinfo')->where(['s_key' => 'plat_url'])->column('s_value');
        return $weChat ? $weChat : null;
    }


    /*
     * findBranchPrexViaCityId
     * */
    public function findBranchPrexViaCityId($city_id){
        $cityUrl=Db::table('huhang_branch')->where(['b_city' => $city_id])->column('b_website');
        return $cityUrl ? $cityUrl : null;
    }


    /*
     * 平台地址
     * */
    public function findPlatAddress(){
        $address=Db::table('huhang_setinfo')->where(['s_key' => 'plat_address'])->column('s_value');
        return $address ? $address : null;
    }

    /*
     * 平台热线
     * */
    public function findPlatHotLine(){
        $hotLine=Db::table('huhang_setinfo')->where(['s_key' => 'plat_tel'])->column('s_value');
        return $hotLine ? $hotLine : null;
    }



    /*
     * 平台备案号
     * */
    public function findPlatRecord(){
        $record=Db::table('huhang_setinfo')->where(['s_key' => 'plat_record'])->column('s_value');
        return $record ? $record : null;
    }


    /*
     * 平台备案号
     * */
    public function findPlatCompany(){
        $company=Db::table('huhang_setinfo')->where(['s_key' => 'plat_company_name'])->column('s_value');
        return $company ? $company : null;
    }


}