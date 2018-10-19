        
        
        一：前端公用到的很多代码，在这里标记一下。
        php代码；
        $setupModel=new Setupm();
        $where=[
            'type_sort' =>1
            ,'type_isable' =>1
        ];
        //项目类型
        $typeData=$setupModel->typeData($where,'1','30');
        $this->assign('typeData',$typeData);
        HTML代码
        {volist name="typeData" id="type"}
            <option value="{$type.type_id}">{$type.type_name}</option>
        {/volist}
        
        //省份
        $wherep=[];
        $province=$setupModel->provinceData($wherep,'1','50');
        $this->assign('prov',$province);
        
        
        
        html 
            <select name="cus_province" lay-verify="required" lay-filter="art_p_id">
                <option value="" selected>省份</option>
                {volist name="prov" id="vo"}
                    <option value="{$vo.p_id}">{$vo.p_name}</option>
                {/volist}
            </select>
            
            
            
            
        {volist name="news" id="new" key="k"}
            <li>
                <a href="">
                    <span class="">{$k}</span>
                    {if condition="$new.art_m_id eq null"}
                    {$paltName[0]}
                     {else/}
                    {$new.mt_name[0]}
                    {/if}
                    <em style="color: #666 ;margin-left: 75px;">{$new.art_title}</em>
                    <i class="fr">{$new.art_indextime}</i>
                </a>
            </li>
        {/volist}    # huhang
