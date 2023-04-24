<!DOCTYPE html>

<?php
	$this->load->database('t');
    $this->load->library('session');
    if(empty($_SESSION['user_id'])){
        header('location:../');
    }
?>

<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/zai_kanri.css">
    <link rel="stylesheet" href="../cbox/colorbox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-ja.js"></script>

</head>

    <body>

        <div class="wrap" style="margin-top:30px;position:relative;">
                <div id="menu_bar" class="mn_bar" style="display:block;position:absolute;top:50px;left:20px;float:left;font-size:12px;box-shadow:0px 0px 5px #000080;">
                            メニュー
                </div>

                <div id="order_ctl" class="pop_in" style="display:none;position:absolute;top:0px;left:20px;float:left;z-index:10;font-size:12px;box-shadow:0px 0px 5px #000080;">
                    <div id="move">
                        <p id="ipop_title">チェック済み一括更新<span id="c_cnt" style="margin:10px;"></span></p>
                        <p style="display:flex;"><label for="ht_date">発注日</label><input id="dp" type="text" class="form-control" style="width:150px;" value="" onchange="genDate(this.value,this.id)" autocomplete="off"></p>
                        <p style="display:flex;position:relative;">
                            <label for="p_zai" style="margin:auto;">
                                <input id="op_cat" type="button" style="font-size:8px;padding:1px;" class="btn btn-primary btn-sm" value="カテゴリ">
                            </label>
                            <select id="p_zai" class="form-control" style="width:150px;">
                                <?php foreach($z_cat[0]->result() as $z){
                                    echo'<option value="'.$z->z_mat.'">'.$z->z_mat.'</option>';
                                }
                                ?>
                            </select>
                            <div class="pop_in_z pop_in" style="position:absolute;display:none;z-index:10;">
                                <?php foreach($z_cat[1]->result() as $zc){
                                    echo'<input type="button" data="'.$zc->ID.'" class="b_cat btn btn-primary btn-sm" value="'.$zc->z_ctg.'">';
                                }
                                    echo'<input type="button" data="0" class="b_cat btn btn-primary btn-sm" value="全て">';
                                ?>
                            </div>
                        </p>
                        
                        <p style="display:flex;"><label for="p_sel">仕入先</label>
                        <select id="p_sel" class="form-control" style="width:150px;">
                                <?php foreach($z_st->result() as $st){
                                    echo '<option value="'.$st->g_symb.'">'.$st->g_name.'</option>';
                                }
                                ?>
                        </select>
                        </p>
                        <p id="p_btn" style="display:flex; justify-content: center;">
                            <input type="button" id="onback" class="btn btn-primary btn-sm" value="戻す">
                            <input type="button" id="ckOn" class="btn btn-primary btn-sm" value="一括">
                            <input type="button" class="btn btn-primary btn-sm p_all" value="更新">
                        </p>
                        <p id="p_btn" style="display:flex; justify-content: center;">
                        <input type="button" class="btn btn-primary btn-sm p_cls" value="閉じる">
                        </p>
                    </div>
                </div>

            <div id="" class="container" style="text-align:left;margin-top:10px;position:relative;">
                <div class="z_cat form-inline" style="width:1300px;font-size:13px;padding:2px;border:1px solid #000080;border-radius:3px;margin-bottom:5px;">
                    <p style="margin-bottom:0;text-align: center">
                        <?php if(!isset($_GET['cat']) || $_GET['cat']==0):?>
                                        <input id="zbtn0" type="button" class="btnctg btn btn-ck btn-sm" value="全て">
                                    <?php foreach($z_cat[1]->result() as $zc):?>
                                        <input id="zbtn<?=$zc->ID?>" type="button" class="btnctg btn btn-primary btn-sm" value="<?=$zc->z_ctg?>">
                                    <?php endforeach;?>
                        <?php else:?>
                                    <input id="zbtn0" type="button" class="btnctg btn btn-primary btn-sm" value="全て">        
                                    <?php foreach($z_cat[1]->result() as $zc):?>
                                            <?php if($_GET['cat']==$zc->ID):?>
                                                <input id="zbtn<?=$zc->ID?>" type="button" class="btnctg btn btn-ck btn-sm" value="<?=$zc->z_ctg?>">
                                            <?php else:?>
                                                <input id="zbtn<?=$zc->ID?>" type="button" class="btnctg btn btn-primary btn-sm" value="<?=$zc->z_ctg?>">
                                            <?php endif;?>
                                    <?php endforeach;?>
                        <?php endif;?>
                        <?php for($i=1;$i<13;$i++){
                                    echo '<input type="button" class="btn btn-primary btn-sm month" name="'.$i.'" value="'.$i.'月">';
                        }?>
                        <?php if(isset($_GET['tehai'])){
                                    print '<input id="mitehai" type="button" class="state btn btn-ck btn-sm" name="1" style="margin-left:10px;" value="未手配">';
                                }else{
                                    print '<input id="mitehai" type="button" class="state btn btn-primary btn-sm" name="0" style="margin-left:10px;" value="未手配">';
                                }
                                if(isset($_GET['minou'])){
                                    print '<input id="minouhin" type="button" class="state btn btn-ck btn-sm" name="1" style="" value="未納品">';
                                }else{
                                    print '<input id="minouhin" type="button" class="state btn btn-primary btn-sm" name="0" style="" value="未納品">';
                                }
                                if(isset($_GET['nouhin'])){
                                    print '<input id="nouhin" type="button" class="state btn btn-ck btn-sm" name="1" style="margin-right:10px;" value="納品済">';
                                }else{
                                    print '<input id="nouhin" type="button" class="state btn btn-primary btn-sm" name="0" style="margin-right:10px;" value="納品済">';
                                }
                        ?>
                                <input id="all_Rec" type="button" class="btn btn-primary btn-sm" style="margin-left:10px;" value="クリア">        
                    </p>


                <div class="z_cat" style="display:none;">
                    <?php if(!isset($_GET['cat']) || $_GET['cat']==0):?>
                            <label for="all">全て</label>
                            <input type="radio" id="ck0" name="cat" value="0" checked>
                            <?php foreach($z_cat[1]->result() as $zc):?>
                            <label for="<?=$zc->z_ctg?>"><?=$zc->z_ctg?></label>
                            <input type="radio" id="ck<?=$zc->ID?>" name="cat" value="<?=$zc->ID?>">
                            <?php endforeach;?>
                    <?php else :?>
                        <label for="all">全て</label>
                        <input type="radio" id="ck0" name="cat" value="0">
                        <?php foreach($z_cat[1]->result() as $zc):?>
                            <?php if($_GET['cat']==$zc->ID):?>
                            <label for="<?=$zc->z_ctg?>"><?=$zc->z_ctg?></label>
                            <input type="radio" id="ck<?=$zc->ID?>" name="cat" value="<?=$zc->ID?>" checked>
                            <?php else:?>
                                <label for="<?=$zc->z_ctg?>"><?=$zc->z_ctg?></label>
                            <input type="radio" id="ck<?=$zc->ID?>" name="cat" value="<?=$zc->ID?>">
                        <?php endif;?>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>

                <div style="display:flex;margin-top:5px;">
                    <label for="selz" style="margin-rigth:10px;">仕入先</label>
                        <select class="form-control" id="selz" style="width:100px;margin-left:3px;">
                            <?php
                                foreach($z_st->result() as $val){
                                    if(isset($_GET['fil_z'])){
                                        if($_GET['fil_z']===$val->g_name){
                                            echo '<option value="'.$val->g_symb.'" selected>'.$val->g_name.'</option>';
                                        }else if(isset($_GET['store'])){
                                            if($_GET['store']===$val->g_name){
                                                echo '<option value="'.$val->g_symb.'" selected>'.$val->g_name.'</option>';
                                            }else{
                                                echo '<option value="'.$val->g_symb.'">'.$val->g_name.'</option>';
                                            }
                                        }else if($val->g_symb==="-"){
                                            echo '<option value="-" selected>-</option>';
                                        }else{
                                            echo '<option value="'.$val->g_symb.'">'.$val->g_name.'</option>';
                                        }
                                    }else{
                                        echo '<option value="'.$val->g_symb.'">'.$val->g_name.'</option>';
                                    } 
                                }
                            ?>
                        </select>
                    <label for="selyear">年</label>
                        <select class="form-control" id="selyear" style="width:100px;">
                            <option value="-">-</option>
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

                    <?php
                        if(isset($_GET['search'])){
                            print '<input id="sechz" class="sr form-control" type="text" style="width:100px;" placeholder="検索" value='.$_GET['search'].'>';
                        }else{
                            print '<input id="sechz" class="sr form-control" type="text" style="width:100px;" placeholder="管理番号" value="">';
                        }
                        if(isset($_GET['mat'])){
                            if($_GET['mat']==""){
                                print '<input id="sechmat" class="sr form-control" type="text" style="width:100px;" placeholder="項目">';
                            }else{
                                print '<input id="sechmat" class="sr form-control" type="text" style="width:100px;" value="'.$_GET['mat'].'">';
                            }
                        }else{
                            print '<input id="sechmat" class="sr form-control" type="text" style="width:100px;" placeholder="項目">';
                        }

                        if(isset($_GET['sizea'])){
                            if($_GET['sizea']!=""){
                                print '<input id="sechsize" class=" sr form-control" type="text" style="width:100px;" value="'.$_GET['sizea'].'">';
                            }else{
                                print '<input id="sechsize" class=" sr form-control" type="text" style="width:100px;" placeholder="型番">';
                            }
                        }else{
                            print '<input id="sechsize" class=" sr form-control" type="text" style="width:100px;" placeholder="型番">';

                        }


                        print '<input id="kensaku" type="button" class="btn btn-primary btn-sm" value="全検索">';
                        
                    ?>
                    <input type="button" id="dph" class="btn btn-primary btn-sm" value="発注日">
                    <input type="button" id="dpn" class="btn btn-primary btn-sm" value="納品日">

                    <div class="hakkou">
                        <input id="zhatyu" type="button" class="btn btn-primary btn-sm"style="position:relative;" value="発注" disabled>
                        <input id="zm" type="button" class="btn btn-primary btn-sm" value="見積依頼">
                            <div class="pop_d" style="display:none;">
                                <p style="margin-bottom:2px;">材料発注</p>
                                <div class="pop_in" style="display:block;">
                                    <div class="" style="display:flex;">
                                        <label for="normal" class="" style="margin-right:29px;margin-bottom:5px;">納期</label>
                                        <label for="normal" class="">通常</label><input type="radio" id="normal" class="form-control pop_day" name="nouhin" style="margin-bottom:2px;" value="0" checked>
                                        <label for="sp" class="">特急</label><input type="radio" id="sp" class="form-control pop_day" name="nouhin" style="margin-bottom:2px;" value="1" >
                                    </div>
                                    <div>
                                        <div class="" style="display:flex;">
                                            <label for="pnormal" style="margin-right:3px;">納品場所</label>
                                            <label for="pnormal">通常</label><input type="radio" id="pnormal" class="form-control pop_day" name="place" style="margin-bottom:2px;" value="弊社" onChange="pc()" checked>
                                            <label for="petc">その他</label><input type="radio" id="petc" class="form-control pop_day" name="place" style="margin-bottom:2px;" value="その他" onChange="pc()" >
                                        </div>
                                        <input type="text" id="place" class="form-control" style="display:none;" value="弊社">
                                    </div>
                                </div>
                                <input id="zai_hakkou" type="button" value="発行" class="btn btn-primary btn-sm" style="margin-right:0px;">
                                <input id="cans_b" type="button" value="キャンセル" class="btn btn-primary btn-sm" style="margin-left:3px;">
                            </div>
                            <div class="pop_ck" style="display:none;">
                                <p>チェックを外します</p>
                                <input id="y_cli" type="button" value="Yes" class="cli btn-primary btn-sm" style="margin-left:3px;">
                                <input id="n_cli" type="button" value="No" class="btn-primary btn-sm" style="margin-right:0px;">
                            </div>
                        <div class="pop_m" style="display:none;">
                            <div class="pop_in">
                                <p>このまま見積依頼をします</p>
                                <input id="zmitsumori" type="button" class="btn btn-primary btn-sm" style="position:relative;" value="見積依頼">
                            </div>
                            <div class="pop_in">
                                <p>選択先へ相見積します</p>
                                    <?php
                                        foreach($z_st->result() as $z) :?>
                                        <?php if($z->g_name!="-"):?>
                                        <div class="form-inline">
                                        <input type="checkbox" name="mitsumori" value="<?=$z->g_name?>"><?=$z->g_name?>
                                        </div> 
                                        <?php endif; ?>                   
                                    <?php endforeach;?>
                                    <input id="send_bm" type="button" value="見積依頼" class="btn btn-primary btn-sm" style="margin-right:0px;">

                            </div>
                            <div class="pop_in">
                                <p>空欄の見積書を発行します</p>
                                <input id="zkara" type="button" class="btn btn-primary btn-sm" style="position:relative;" value="空見積">
                            </div>
                            <input id="cans_bm" type="button" value="キャンセル" class="btn btn-primary btn-sm" style="margin-left:0px;">
                        </div>
                    </div>

                    <input id="g_set" type="button" class="if98 btn btn-primary btn-sm" href="gait" style="margin-left:0px;position:relative;" value="設定">
                    <input id="kanri" type="button" class="btn btn-primary btn-sm" value="受注一覧">
                    <input id="go_top" type="button" class="btn btn-primary btn-sm" value="TOP">
                    <select id="indx" class="form-control" style="width:80px;margin:0 10px;">
                        <?php for($i=50;$i<201;$i=$i*2){
                            if($i==$_GET['pg']){
                                echo'<option value='.$i.' selected>'.$i.'</option>';
                            }else{
                                echo'<option value='.$i.'>'.$i.'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                    </div>
            </div>
            <input type="hidden" id="url_cat" value="0">
            <input type="hidden" id="url_state" value="0">
            <input type="hidden" id="url_month" value="0">                      
            <input type="hidden" id="url_monthe" value="0">
            <input type="hidden" id="url_pages" value="1">
            <input type="hidden" id="order_state" value="0">
            <input type="hidden" id="order_ctg" value="tbmeisai.kb_nouki">
            <div id="zai_ajax" style="position:relative;">
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
                                    echo '<span><a onclick="pg(this.text)" style="font-size:20px;font-weight:bolder;">'.$ps.'</a></span>';
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


                <div class="" style="width:99%;">
                    <div id="ajxtb" class="form-group" style="width:100%;height:700px;overflow:auto;">
                        <table id="gai" class="table table-striped table-hover" style="font-size:12px;">
                        <tr><th style="width:50px;padding-top:10px;">ck</th>
                            <th id="tbmeisai.kb_nouki" style="">納期<span class="material-symbols-outlined tbmeisai-kb_nouki">arrow_drop_down</span></th>
                            <th id="tbz.z_keyNum">管理番号<span class="material-symbols-outlined tbz-z_keyNum">arrow_drop_down</span></th>
                            <th id="tbmeisai.zuban" style="width:160px;">項目<span class="material-symbols-outlined tbmeisai-zuban">arrow_drop_down</span></th>
                            <th id="tbmeisai.hinmei" style="width:160px;">型番<span class="material-symbols-outlined tbmeisai-hinmei">arrow_drop_down</span></th>
                            <th id="tbz.z_store">仕入先<span class="material-symbols-outlined tbz-z_store">arrow_drop_down</span></th>
                            <th id="tbz.a">a<span class="material-symbols-outlined tbz-a"> arrow_drop_down</span></th>
                            <th id="tbz.b">b<span class="material-symbols-outlined tbz-b"> arrow_drop_down</span></th>
                            <th id="tbz.c">c<span class="material-symbols-outlined tbz-c"> arrow_drop_down</span></th>
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
                                            <td id="z'.$id.'" style="">'.$res->zuban.'</td>
                                            <td id="i'.$id.'">'.$res->hinmei.'</td>
                                            
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

                                        <td class="sa"><input id="a'.$id.'" type="text" class="tab sh form-control" name="'.$idx.'" style="item-align:center;text-align:right;" value="'.floatval($res->a).'" onChange="z_upd(this.value,this.id)"></td>
                                        <td class="sb"><input id="b'.$id.'" type="text" class="tab sh form-control" style="item-align:center;text-align:right;" value="'.floatval($res->b).'" onChange="z_upd(this.value,this.id)"></td>
                                        <td class="sc"><input id="c'.$id.'" type="text" class="tab sh form-control" style="item-align:center;text-align:right;" value="'.floatval($res->c).'" onChange="z_upd(this.value,this.id)"></td>

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
                                    echo '<span><a onclick="pg(this.text)" style="font-size:20px;font-weight:bolder;">'.$ps.'</a></span>';
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
            </div>

        </div>

        <script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="../js/zai_kanri.js"></script>
        <script type="text/javascript" src="../js/function.js"></script>
        <script type="text/javascript" src="../js/mitsumori.js"></script>
        <script type="text/javascript" src="../js/print.js"></script>

    </body>
</html>