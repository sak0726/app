<!DOCTYPE html>
<?php
	$this->load->database('t');
    $this->load->library('session');
    
    if(empty($_SESSION['name'])){
        header("location:../");
    }
?>

<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/gai_kanri.css">
    <link rel="stylesheet" href="../cbox/colorbox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-ja.js"></script>
    <title>発注管理</title>
</head>
<body>
    <div class="wrap" style="margin-top:20px;position:relative;">
        <div class="form-inline container" style="margin-top:10px;">
                <div id="menu_bar" class="mn_bar" style="display:block;position:absolute;top:87px;left:70px;float:left;font-size:12px;box-shadow:0px 0px 5px #000080;">
                メニュー
                </div>
                <div id="order_ctl" class="pop_in" style="display:none;position:absolute;top:0px;left:20px;float:left;z-index:110;font-size:12px;box-shadow:0px 0px 5px #000080;">
                    <div id="move">
                        <p id="ipop_title">チェック済み一括更新<span id="c_cnt" style="margin:10px;"></span></p>
                        <p style="display:flex;">
                        <label for="hatyu_d">発注日</label><input id="hatyu_d" type="text" class="hd form-control" style="width:100px;" value="" onchange="genDate(this.value,this.id)" autocomplete="off">
                        <label for="nouki_d" style="margin-left:3px;">納期日</label><input id="nouki_d" type="text" class="hd form-control" style="width:100px;" value="" onchange="genDate(this.value,this.id)" autocomplete="off"></p>
                        <p style="display:flex;">
                        <label style="margin-left:12px;" for="ct_gai">外注</label>
                            <select id="ct_gai" class="form-control" style="width:100px;">
                            <?php foreach($gai_cat[0]->result() as $g){
                                echo "<option value=".$g->g_symb.">".$g->g_name."</option>";
                            }?>
                            </select>
                        <label for="nouhin" style="margin-left:3px;">納品日</label><input id="nouhin" type="text" class="hd form-control" style="width:100px;" value="" onchange="genDate(this.value,this.id)" autocomplete="off">

                        </p>
                        <p id="p_btn" style="display:flex; justify-content: center;position:relative;">
                            <input type="button" id="ckOn" class="btn btn-primary btn-sm" value="On/Off">
                            <input type="button" class="btn btn-primary btn-sm p_ent" value="更新">
                            <input type="button" class="btn btn-primary btn-sm p_cls" value="閉じる">
                            <div id="ok" class="pop_in" style="display:none;position:absolute;top:83px;left:100px;">
                                <input type="button" id="onback" class="btn btn-primary btn-sm" value="戻す">
                                <input type="button" class="btn btn-primary btn-sm p_ok" value="確定">
                            </div>
                        </p>
                    </div>
                </div>
                <div class="g_cat" style="width:100%;height:unset;">
                        <div style="display:flex;">
                            <?php
                                foreach($koutei->result() as $val){
                                    if($val->k_name=="-"){
                                        echo'<input id="g_cat'.$val->kt_id.'" type="button" class="cgcat btn btn-primary btn-sm" value="全て" checked>';
                                    }else{
                                    echo'<input id="g_cat'.$val->kt_id.'" type="button" class="cgcat btn btn-primary btn-sm" value="'.$val->k_name.'" checked>';
                                    }
                                }
                            ?>
                                <input id="mitehai" type="button" class="state btn btn-primary btn-sm" name="1" style="margin-left:30px;" value="未手配">
                                <input id="minouhin" type="button" class="state btn btn-primary btn-sm" name="0" style="" value="未納品">
                                <input id="nouhin" type="button" class="state btn btn-primary btn-sm" name="1" style="margin-right:10px;" value="納品済">
                                <input id="all_Rec" type="button" class="btn btn-primary btn-sm" style="margin-left:10px;" value="クリア">
                            </div>
                            <div style="display:flex;margin-left:440px;margin-top:10px;">
                            <?php for($i=1;$i<13;$i++){
                                        echo '<input type="button" class="btn btn-primary btn-sm month" name="'.$i.'" value="'.$i.'月";">';
                            }?>

                            </div>
                            <div style="display:flex;margin-left:150px;margin-top:10px;">
                                <div class="g_table" style="display:flex;border:unset;">
                                    <label for="selg">外注</label>
                                    <select class="form-control tab" id="selg" style="width:100px;">
                                        <?php
                                            foreach($gai_cat[1]->result() as $val){
                                                if($_GET['fil_g']===$val->g_name){
                                                    echo '<option value="'.$val->g_symb.'" selected>'.$val->g_name.'</option>';
                                                }else if($val->g_symb==="-"){
                                                    echo '<option value="-" selected>-</option>';
                                                }else{
                                                    echo '<option value="'.$val->g_symb.'">'.$val->g_name.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                            
                                    <label for="yea">年</label>
                                    <select class="form-control tab" id="selyear" style="width:50px;">
                                        <?php
                                            foreach($year->result() as $y){
                                                if($_GET['year']===$y->kb_nouki){
                                                    echo '<option value="'.$y->kb_nouki.'" selected>'.$y->kb_nouki.'</option>';
                                                }else{
                                                    echo '<option value="'.$y->kb_nouki.'">'.$y->kb_nouki.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                    <input id="sechk" class="form-control tab" type="text" style="width:80px;" placeholder="管理番号" autocomplete="off">
                                    <input id="sechz" class="form-control tab" type="text" style="width:200px;" placeholder="工事名" value="" autocomplete="off">
                                    <input id="kensaku" type="button" class="btn btn-primary btn-sm" value="全検索">
                                    <input id="" type="button" class="cli btn btn-primary btn-sm" value="チェック">
                                    <input id="gai_hatyu" type="button" class="btn btn-primary btn-sm" value="発注">
                                    <input id="all_Rec" type="button" class="btn btn-primary btn-sm" value="クリア">                                    
                                    <input id="g_setting" type="button" class="if98 btn btn-primary btn-sm" style="margin-left:10px;" href="gait" value="各種設定">
                                    <input id="kanri" type="button" class="btn btn-primary btn-sm" value="受注一覧">
                                    <input id="zai" type="button" class="btn btn-primary btn-sm" value="部材発注">
                                    <input id="top_menu" type="button" class="btn btn-primary btn-sm" value="トップ">
                                    <select id="indx" class="tab" style="border:1px solid #ced4da;border-radius:0.25rem;margin-left:2px;">
                                    <?php for($i=50;$i<201;$i=$i*2){
                                        if($_GET['idx']==$i){
                                            echo '<option value='.$i.' selected>'.$i.'</option>';
                                        }else{
                                            echo '<option value='.$i.'>'.$i.'</option>';
                                        }
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                </div>

        </div>
        <input type="hidden" id="url_pages" value="1">
        <input type="hidden" id="url_cat" value="0">
        <input type="hidden" id="url_month" value="0">
        <input type="hidden" id="url_monthe" value="0">
        <input type="hidden" id="url_state" value="0">
        <input type="hidden" id="sort_state" value="0">
        <input type="hidden" id="sort_ctg" value="tbkanri.nouki">
    
    <div id="gai_ajax" style="position:relative;">
    <p style="font-size:15px;position:absolute;top:0px;right:28px;z-index:100;padding:2px;">全<span><?php echo number_format($gaims[1]);?>件 合計 <?php echo number_format($total);?></span></p>

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


        <div class="pop_ck" style="display:none;">
            <p>チェックを外します</p>
            <input id="" type="button" value="Yes" class="cli btn-primary btn-sm" style="margin-left:3px;">
            <input id="n_cli" type="button" value="No" class="btn-primary btn-sm" style="margin-right:0px;">
        </div>
        <div class="" style="width:98%;">
            <div class="form-group" style="position:relative;width:100%;height:850px;overflow:auto;">
                <div id="date_ctl" class="pop_in" style="display:none;position:fixed;top:15px;left:30px;float:left;font-size:12px;padding:3px;box-shadow:0px 0px 5px #000080;">
                    <p>発注します</p>
                    <p style="display:flex; justify-content: center;">
                        <input type="button" id="hatyu" class="btn btn-primary btn-sm" value="発注" href="print?cat=h">
                        <input type="button" class="btn btn-primary btn-sm p_cls" value="閉じる">
                    </p>
                </div>
                <div id="ckOff" class="pop_in" style="display:none;position:absolute;top:4px;left:700px;z-index:20;float:left;font-size:12px;padding:3px;box-shadow:0px 0px 5px #000080;">
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
                        <th id="tbkt.kt_hatyu">発注日<span class="material-symbols-outlined tbkt.kt_hatyu ar">arrow_drop_down</span></th>
                        <th id="tbkt.kt_nouki">納期日<span class="material-symbols-outlined tbkt.kt_nouki ar">arrow_drop_down</span></th>
                        <th id="tbkt.kt_nouhin">納品日<span class="material-symbols-outlined tbkt.kt_nouhin ar">arrow_drop_down</span></th>
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
                                        <td id="z'.$id.'" style="padding-left:3px;"><select id="p'.$id.'" class="form-control" style="padding:2px;width:fit-content;" onChange="g_upd(this.text,this.id)"">';
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

                                        <td><select id="s'.$id.'" class="form-control tab" style="width:fit-content;" onChange="g_upd(this.text,this.id)">';
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
                                    <td><input id="q'.$id.'" type="text" class="form-control tab" style="text-align:right;" value="'.number_format($res->kt_quan).'" onChange="g_upd(this.value,this.id)"></td>
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
                                $cked=false;
                            }
                            
                        ?>
                </table>
            </div>
        </div>
        <div class="pgn" style="position:relative;">
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
    </div>
        <script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="../js/gai_kanri.js"></script>
        <script type="text/javascript" src="../js/function.js"></script>
        <script type="text/javascript" src="../js/print.js"></script>

    </div>

</body>
</html>