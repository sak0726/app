


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
            <th id="tbmeisai.kb_nouki" style="">納期<span class="material-symbols-outlined tbmeisai-kb_nouki ar">arrow_drop_down</span></th>
            <th id="tbkt.k_keyNum">管理番号<span class="material-symbols-outlined tbkt-k_keyNum ar">arrow_drop_down</span></th>
            <th id="tbmeisai.zuban" style="width:150px;">図番<span class="material-symbols-outlined tbmeisai-zuban ar">arrow_drop_down</span></th>
            <th id="tbmeisai.hinmei" style="width:150px;">品名<span class="material-symbols-outlined tbmeisai-hinmei ar">arrow_drop_down</span></th>
            <th id="tbkt.kt">工程<span class="material-symbols-outlined tbkt-kt ar">arrow_drop_down</span></th>
            <th id="tbkt.kt_gai">外注<span class="material-symbols-outlined tbkt-kt_gai ar">arrow_drop_down</span></th>
            <th style="padding-top:10px;">発注数</th>
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
                            <td id="z'.$id.'" style="padding-left:3px;">'.$res->koutei.'</td>
                            <td id="i'.$id.'">'.$res->kt_doc.'</td>
                            <td><select id="p'.$id.'" class="form-control tab" onChange="g_upd(this.text,this.id)">';
                            foreach($koutei->result() as $k){
                                if($res->kt===$k->k_name){
                                    print '<option value="'.$k->k_name.'" selected>'.$k->k_name.'</option>';
                                }else{
                                    print '<option value="'.$k->k_name.'">'.$k->k_name.'</option>';
                                }
                            }
                    print '</select></td>
                            <td><select id="s'.$id.'" class="form-control tab" onChange="g_upd(this.text,this.id)">';
                            foreach($gai_cat[0]->result() as $g){
                                if ($res->kt_gai===$g->g_name){
                                    print '<option value="'.$g->g_symb.'" selected>'.$res->kt_gai.'</option>';
                                }else if($g->g_name==="-"){
                                    print '<option value="-" selected>-</option>';
                                }else{
                                    print '<option value="'.$g->g_symb.'">'.$g->g_name.'</option>';
                                }
                            }
                    print '</select></td>
                        <td><input id="q'.$id.'" type="text" class="form-control tab" style="text-align:right;" value="'.number_format($res->kt_quan).'" onChange="g_upd(this.value,this.id)"></td>
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