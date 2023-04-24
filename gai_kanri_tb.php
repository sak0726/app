<p style="font-size:15px;position:absolute;top:0px;right:195px;z-index:100;padding:2px;">全<span><?php echo number_format($gaims[1]);?>件 合計 <?php echo number_format($gaims[3]);?></span></p>
<div class="pgn">
    <?php
        if(isset($_GET['idx'])){
            $p=$_GET['idx'];
        }else{
            $p=50;

        }

        $ps=ceil($gaims[1]/$p);
        if(isset($_GET['pages'])){
            $pg=$_GET['pages'];
        }
        if ($ps===1){
            echo '<span style="color:#000080;">1</span>';
        }else{
            if($ps<21){
                for($i=1;$i<$ps;$i++){
                    if($_GET['pages']==$i){
                        echo '<span><a onclick="pg(this.text)" style="font-weight:bolder;font-size:18px;">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                    }else{
                        echo '<span><a onclick="pg(this.text)">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                    }
                }
                if($_GET['pages']==$ps){
                    echo '<span><a onclick="pg(this.text)" style="font-weight:bolder;font-size:18px;">'.$ps.'</a></span>';
                }else{
                    echo '<span><a onclick="pg(this.text)">'.$ps.'</a></span>';
                }
            }else{
                for($i=1;$i<21;$i++){
                    echo '<span><a onclick="pg(this.text)">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                }
                echo '<span><select id="pg" class="pg_sel" style="border-radius:0.25rem;">
                    <option value="">...</option>';
                
                for($i=21;$i<=$ps;$i++){
                    if($pg==$i){
                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                    }else{
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                }
                echo '</select></span>';
            }
        }
    ?>
</div>
<div class="" style="width:98%;">
    <div class="form-group" style="position:relative;width:100%;height:850px;overflow:auto;">
                <div id="date_ctl" class="pop_in" style="display:none;position:fixed;top:100px;left:910px;float:left;font-size:12px;padding:3px;box-shadow:0px 0px 5px #000080;">
                    <p>発注します</p>
                    <p style="display:flex; justify-content: center;">
                        <input type="button" id="hatyu" class="btn btn-primary btn-sm" value="発注">
                        <input type="button" class="btn btn-primary btn-sm p_cls" value="閉じる">
                    </p>                
                </div>
                <div id="ckOff" class="pop_in" style="display:none;position:fixed;top:138px;left:700px;float:left;font-size:12px;padding:3px;box-shadow:0px 0px 5px #000080;">
                    <p>チェックを外します</p>
                    <p style="display:flex; justify-content: center;">
                        <input type="button" id="ckof" class="btn btn-primary btn-sm" value="はい">
                        <input type="button" id="ckofno" class="btn btn-primary btn-sm" value="いいえ">
                    </p>
                </div>
        <table id="gai" class="gai table table-striped table-hover" style="font-size:12px;">
        <tr>
            <th style="width:30px;padding-top:10px;">ck</th>
            <th id="tbkanri.nouki" style="">納期<span class="material-symbols-outlined tbmeisai-kb_nouki ar">arrow_drop_down</span></th>
            <th id="tbkt.k_keyNum">管理番号<span class="material-symbols-outlined tbkt-k_keyNum ar">arrow_drop_down</span></th>
            <th id="tbmeisai.zuban" style="width:95px;">項目<span class="material-symbols-outlined tbmeisai-zuban ar">arrow_drop_down</span></th>
            <th id="tbmeisai.hinmei" style="width:250px;">工事名<span class="material-symbols-outlined tbmeisai-hinmei ar">arrow_drop_down</span></th>
            <th style="padding-top:10px;width:50px;">詳細</th>
            <th id="tbkt.kt_gai" style="width:95px;">外注<span class="material-symbols-outlined tbkt-kt_gai ar">arrow_drop_down</span></th>
            <th style="padding-top:10px;width:60px;">発注数</th>
            <th style="padding-top:10px;width:60px;">単位</th>
            <th style="padding-top:10px;">発注単価</th>
            <th style="padding-top:10px;">発注計</th>
            <th id="tbkt.kt_hatyu">発注日<span class="material-symbols-outlined tbkt-kt_hatyu ar">arrow_drop_down</span></th>
            <th id="tbkt.kt_nouki">納期日<span class="material-symbols-outlined tbkt-kt_nouki ar">arrow_drop_down</span></th>
            <th id="tbkt.kt_nouhin">納品日<span class="material-symbols-outlined tbkt-kt_nouhin ar">arrow_drop_down</span></th>
        </tr>
            <?php
                $num=0;
                $kei=0;
                foreach($gaims[0]->result() as $res) {
                    $cked=false;
                    $id=$res->id;
                    foreach($gaims[2]->result() as $ck){
                        if($id==$ck->id){
                            $cked=true;
                        }
                    }
                    print '<tr id="'.$id.'" name="'.$num.'" class="bld" onclick="border(this.id)">';
                    if($cked){
                        print '<td><input checked id="c'.$id.'" data="'.$res->ktid.'" name="ck" type="checkbox" class="ck form-control tab" style="width:30px;" value="" onChange="ck_upd(this.id)"></td>';
                    }else{
                        print '<td><input id="c'.$id.'" data="'.$res->ktid.'" name="ck" type="checkbox" class="c ck form-control tab" style="width:30px;" value="" onChange="ck_upd(this.id)"></td>';
                    }
                    if(is_null($res->nouki)){
                        print '<td></td>';
                    }else{
                        print '<td style="text-align:center;">'.date('Y/m/d',strtotime($res->nouki)).'</td>';
                    }
                    print '<td style="text-align:center;"><span id="k'.$res->k_keyNum.'" class="ifm">'.$res->k_keyNum.'</span></td>
                            <td id="z'.$id.'" style="padding-left:3px;"><select id="p'.$id.'" class="form-control" style="padding:2px;width:fit-content;" onChange="g_upd(this.text,this.id)">';
                            foreach($koutei->result() as $k){
                                if($res->koutei===$k->k_name){
                                    print '<option value="'.$k->k_name.'" selected>'.$k->k_name.'</option>';
                                }else{
                                    print '<option value="'.$k->k_name.'">'.$k->k_name.'</option>';
                                }
                            }
                    print '</select></td>
                            <td id="i'.$id.'"><input id="tl'.$id.'" class="form-control" value="'.$res->kt_doc.'"></td>
                            
                            <td id="d'.$id.'"><input type="button" id="d'.$id.'" class="btn btn-primary btn-sm" style="color:#fff;" value="詳細"></td>
                            
                            <td><select id="s'.$id.'" class="form-control tab" onChange="g_upd(this.text,this.id)">';
                            foreach($gai_cat[1]->result() as $g){
                                if ($res->kt_gai===$g->g_name){
                                    print '<option value="'.$g->g_symb.'" selected>'.$res->kt_gai.'</option>';
                                }else if($g->g_name==="-"){
                                    print '<option value="-" selected>-</option>';
                                }else{
                                    print '<option value="'.$g->g_symb.'">'.$g->g_name.'</option>';
                                }
                            }
                    print '</select></td>
                        <td><input id="q'.$id.'" type="text" class="form-control tab" style="text-align:right;" value="1" onChange="g_upd(this.value,this.id)"></td>
                        <td><input class="form-select" style="padding:0;" value="式"></td>

                        <td><input id="t'.$id.'" type="text" class="form-control tab" style="text-align:right;" value="'.number_format($res->kt_tanka).'" onChange="g_upd(this.value,this.id)"></td>
                        <td><input id="g'.$id.'" type="text" class="form-control tab" style="text-align:right;" value="'.number_format($res->kt_total).'" onChange="g_upd(this.value,this.id)"></td>';
                    if(is_null($res->kt_hatyu)){
                        print '<td><input id="h'.$id.'" type="text" class="form-control hd tab" value="" onChange="genDate(this.value,this.id);g_upd(this.value,this.id)"></td>';
                    }else{
                        print '<td><input id="h'.$id.'" type="text" class="form-control hd tab" value="'.date('Y/m/d',strtotime($res->kt_hatyu)).'" onChange="genDate(this.value,this.id);g_upd(this.value,this.id)"></td>';
                    }
                    if(is_null($res->kt_nouki)){
                        print '<td><input id="n'.$id.'" type="text" class="form-control nk tab" value="" onChange="genDate(this.value,this.id);g_upd(this.value,this.id)"></td>';
                    }else{
                        print '<td><input id="n'.$id.'" type="text" class="form-control nk tab" value="'.date('Y/m/d',strtotime($res->kt_nouki)).'" onChange="genDate(this.value,this.id);g_upd(this.value,this.id)"></td>';
                    }

                    if(is_null($res->kt_nouhin)){
                        print '<td><input id="k'.$id.'" type="text" class="form-control nh tab" value="" onChange="genDate(this.value,this.id);g_upd(this.value,this.id)"></td>';
                    }else{
                        print '<td><input id="k'.$id.'" type="text" class="form-control nh tab" value="'.date('Y/m/d',strtotime($res->kt_nouhin)).'" onChange="genDate(this.value,this.id);g_upd(this.value,this.id)"></td>';
                    }
                    print '</tr>';
                    $num++;
                    $kei=$kei+$res->kt_total;
                }
                
            ?>
        </table>
    </div>
</div>
            
<div class="pgn">
    <?php
        if(isset($_GET['idx'])){
            $p=$_GET['idx'];
        }else{
            $p=50;
        }
            $ps=ceil($gaims[1]/$p);
        if ($ps===1){
            echo '<span style="color:#000080;">1</span>';
        }else{
            if($ps<21){
                for($i=1;$i<$ps;$i++){
                    if($_GET['pages']==$i){
                        echo '<span><a onclick="pg(this.text)" style="font-weight:bolder;font-size:18px;">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                    }else{
                        echo '<span><a onclick="pg(this.text)">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                    }
                }
                if($_GET['pages']==$ps){
                    echo '<span><a onclick="pg(this.text)"style="font-weight:bolder;font-size:18px;">'.$ps.'</a></span>';
                }else{
                    echo '<span><a onclick="pg(this.text)">'.$ps.'</a></span>';
                }
            }else{
                for($i=1;$i<21;$i++){
                    if($_GET['pages']==$i){
                        echo '<span><a onclick="pg(this.text)" style="font-weight:bolder;font-size:18px;">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                    }else{
                        echo '<span><a onclick="pg(this.text)">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                    }
                }
                echo '<span><select id="pg" class="pg_sel" style="border-radius:0.25rem;" >
                    <option value="">...</option>';
                for($i=21;$i<$ps;$i++){
                    if($pg==$i){
                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                    }else{
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                }
                echo '</select></span>';
            }

        }
    ?>
    <p style="position:absolute;top:2px;right:40px;">ページ計 <?=number_format($kei)?></p>

</div>
