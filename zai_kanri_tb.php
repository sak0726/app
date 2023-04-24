<p style="display:flex;font-size:15px;position:absolute;top:0px;right:154px;z-index:100;padding:2px;">全<?php echo number_format($zaims[1]);?>件/(<?=$zaims[2]?>件表示) </span><span style="margin-left:30px;"> 計 <?=number_format($cnt)?></span></p>
                <div class="pgn">
                    <?php
                        if(!isset($_GET['pg'])){
                            $p=50;
                        }else{
                            $p=$_GET['pg'];
                        }
                        $ps=ceil($zaims[1]/$p);
                        if(isset($_GET['pages'])){
                            $pg=$_GET['pages'];
                        }
                        if ($ps===1){
                            echo '<span style="color:#000080;">1</span>';
                        }else{
                            if($ps<21){
                                for($i=1;$i<$ps;$i++){
                                    if($i==$pg){
                                        echo '<span><a onclick="pg(this.text)" style="font-size:20px;font-weight:bolder;">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                                    }else{
                                        echo '<span><a onclick="pg(this.text)">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                                    }
                                }
                                    echo '<span><a onclick="pg(this.text)">'.$ps.'</a></span>';
                            }else{
                                for($i=1;$i<21;$i++){
                                    if($i==$pg){
                                        echo '<span><a onclick="pg(this.text)" style="font-size:20px;font-weight:bolder;">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                                    }else{
                                        echo '<span><a onclick="pg(this.text)">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                                    }                }
                                echo '<span><select id="pg" class="pg_sel" style="border-radius:4px;margin:2px 0;">
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
                    <div id="ajxtb" class="form-group" style="width:100%;height:700px;overflow:auto;">
                    <table id="gai" class="table table-striped table-hover" style="font-size:12px;">
                        <tr>
                            <th style="width:50px;padding-top:10px;">ck</th>
                            <th id="tbmeisai.kb_nouki" style="">納期<span class="material-symbols-outlined tbmeisai-kb_nouki">arrow_drop_down</span></th>
                            <th id="tbz.z_keyNum">管理番号<span class="material-symbols-outlined tbz-z_keyNum">arrow_drop_down</span></th>
                            <th id="tbmeisai.zuban" style="width:160px;">工事名<span class="material-symbols-outlined tbmeisai-zuban">arrow_drop_down</span></th>
                            <th id="tbmeisai.zuban" style="width:160px;">項目<span class="material-symbols-outlined tbmeisai-zuban">arrow_drop_down</span></th>
                            <th id="tbmeisai.hinmei" style="width:160px;">型番<span class="material-symbols-outlined tbmeisai-hinmei">arrow_drop_down</span></th>
                            <th id="tbz.z_store">仕入先<span class="material-symbols-outlined tbz-z_store">arrow_drop_down</span></th>
                            <th style="padding-top:10px;">発注数</th>
                            <th style="padding-top:10px;">発注単価</th>
                            <th style="padding-top:10px;">発注計</th>
                            <th id="tbz.z_hatyu" style="width:90px;">発注日<span class="material-symbols-outlined tbz-z_hatyu"> arrow_drop_down</span></th>
                            <th id="tbz.z_nouhin" style="width:90px;">納品日<span class="material-symbols-outlined tbz-z_nouhin"> arrow_drop_down</span></th>
                            <th style="padding-top:10px;">備考</th>
                        </tr>
                            <?php
                                    $idx=1;
                                    $total=0;
                                    foreach($zaims[0]->result() as $res) {
                                        $total=$total+$res->z_total;

                                    $id=$res->id;
                                    print '<tr id="'.$id.'" class="list bld" name="'.$idx.'" style="height:28px;" onclick="border(this.id)">';
                                    if($res->z_ck==0){
                                        print '<td><input id="k'.$id.'" name="ck" type="checkbox" class="ck form-control" style="width:30px;" value=""></td>';
                                    }else{
                                        print '<td><input id="k'.$id.'" name="ck" type="checkbox" checked class="ck form-control" style="width:30px;" value=""></td>';
                                    }
                                    if(is_null($res->kb_nouki)){
                                        print '<td></td>';
                                    }else{
                                        print '<td style="width:80px;">'.date('Y/m/d',strtotime($res->kb_nouki)).'</td>';
                                    }
                                    print '<td style="width:70px;"><a id="k'.$res->z_keyNum.'" class="if99" href="jutyu?id='.$res->z_keyNum.'">'.$res->z_keyNum.'</a></td>
                                    <td id="j'.$id.'" style="">'.$res->kenmei.'</td>        
                                    <td id="z'.$id.'" style="">'.$res->zuban.'</td>
                                            <td>
                                                <select id="a'.$id.'" class="form-select" value="'.$res->a.'" onChange="z_upd(this.value,this.id)">';
                                                foreach($z_cat[0]->result() as $v){
                                                    if($res->a==$v->kata){
                                                        echo "<option value=".$v->kata." selected>".$v->kata."</option>";
                                                    }else{
                                                        echo "<option value=".$v->kata.">".$v->kata."</option>";
                                                    }
                                                }          
                                                print '</select>
                                            </td>
                                        <td><select id="r'.$id.'" class="tab form-control" style="" onChange="z_upd(this.text,this.id)">';
                                            foreach($z_st->result() as $k){
                                                if($res->z_store===$k->g_name){
                                                    print '<option value="'.$k->g_symb.'" selected>'.$k->g_name.'</option>';
                                                }else if($k->g_name==="-"){
                                                    print '<option value="-" selected>-</option>';
                                                }else{
                                                    print '<option value="'.$k->g_symb.'">'.$k->g_name.'</option>';
                                                }
                                            }
                                    print '</select></td>


                                        <td><input id="q'.$id.'" type="text" class="tab form-control" style="item-align:center;text-align:right;" value="'.number_format($res->z_quan).'" onChange="z_upd(this.value,this.id)"></td>
                                        <td><input id="t'.$id.'" type="text" class="tab form-control" style="item-align:center;text-align:right;" value="'.number_format($res->z_tanka).'" onChange="z_upd(this.value,this.id)"></td>
                                        <td><input id="g'.$id.'" type="text" class="tab form-control" style="item-align:center;text-align:right;" value="'.number_format($res->z_total).'" onChange="z_upd(this.value,this.id)"></td>';
                                    if(is_null($res->z_hatyu)){
                                        print '<td><input id="h'.$id.'" type="text" class="tab form-control dtwid" value="" onChange="genDate(this.value,this.id);z_upd(this.value,this.id)"></td>';
                                    }else{
                                        print '<td><input id="h'.$id.'" type="text" class="tab form-control dtwid" value="'.date('Y/m/d',strtotime($res->z_hatyu)).'" onChange="genDate(this.value,this.id);z_upd(this.value,this.id)"></td>';
                                    }
                                    if(is_null($res->z_nouhin)){
                                        print '<td><input id="n'.$id.'" type="text" class="tab form-control dtwid" value="" onChange="genDate(this.value,this.id);z_upd(this.value,this.id)"></td>';
                                    }else{
                                        print '<td><input id="n'.$id.'" type="text" class="tab form-control dtwid" value="'.date('Y/m/d',strtotime($res->z_nouhin)).'" onChange="genDate(this.value,this.id);z_upd(this.value,this.id)"></td>';
                                    }
                                    if(is_null($res->z_com)){
                                        print '<td><input id="m'.$id.'" type="text" class="tab form-control" style="overflow:hidden;" value="" onChange="z_upd(this.value,this.id)"></td>';
                                    }else{
                                        print '<td><input id="m'.$id.'" type="text" class="tab form-control" style="overflow:hidden;" value="'.$res->z_com.'" onChange="z_upd(this.value,this.id)"></td>';
                                    }
                                    print '</tr>';
                                    $idx++;
                                    }
                                ?>
                        </table>
                    </div>
                </div>

                <div class="pgn" style="position:relative;">
                    <?php
                    if(!isset($_GET['pg'])){
                            $p=50;
                        }else{
                            $p=$_GET['pg'];
                        }
                        $ps=ceil($zaims[1]/$p);
                        if ($ps===1){
                            echo '<span style="color:#000080;">1</span>';
                        }else{
                            if($ps<21){
                                for($i=1;$i<$ps;$i++){
                                    if($i==$pg){
                                        echo '<span><a onclick="pg(this.text)" style="font-size:20px;font-weight:bolder;">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                                    }else{
                                        echo '<span><a onclick="pg(this.text)">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                                    }            }
                                    echo '<span><a onclick="pg(this.text)">'.$ps.'</a></span>';
                            }else{
                                for($i=1;$i<21;$i++){
                                    if($i==$pg){
                                        echo '<span><a onclick="pg(this.text)" style="font-size:20px;font-weight:bolder;">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                                    }else{
                                        echo '<span><a onclick="pg(this.text)">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                                    }            }
                                echo '<span><select class="pg_sel" id="pg" style="border-radius:4px;margin:2px 0;">
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
                    <p style="position:absolute;top:2px;right:40px;">ページ計 <?=number_format($total)?></p>
                </div>

