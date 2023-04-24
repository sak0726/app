<!DOCTYPE html>
<?php
        $this->load->database('zai');

?>

<html lang="jp">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" integrity="sha384-vhJnz1OVIdLktyixHY4Uk3OHEwdQqPppqYR8+5mjsauETgLOcEynD9oPHhhz18Nw" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap-theme.min.css" integrity="sha384-jzngWsPS6op3fgRCDTESqrEJwRKck+CILhJVO5VvaAZCq8JYf8HsR/HPpBOOPZfR" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>見積書作成</title>
</head>
<body>
<div class="top" style="position:relative;">    
    <h3 style="text-align:left;margin-bottom:10px;">見積書作成</h3>
    <div class="row" style="margin-left:50px;">
        <a href="/heiwass"><button type="button" class="btn btn-xs cos-sm-2">TOP</button></a>
        <a href="mitsumori"><button type="button" class="btn btn-xs cos-sm-2">見積作成</button></a>
        <a href="history"><button type="button" class="btn btn-xs cos-sm-2">履歴</button></a>
        <a href="customer"><button type="button" class="btn btn-xs cos-sm-2">顧客</button></a>
        <a href="submenu"><button type="button" class="btn btn-xs cos-sm-2">設定</button></a>
        <button class="btn btn-xs cos-sm-2" onClick="history.back()" style="width:100%;">戻る</button>
    </div>
        <!--
        <ul id="acord">
        <li id="sm">メニュー<span id="arsp" class="arrow">></span>
          <div class="hme" style="display:none;">
          <dd><a href="/heiwass">トップ</a></dd>
            <dd><a href="mitsumori">見積作成</a></dd>
            <dd><a href="history">注文履歴</a></dd>
            <dd><a href="customer">顧客登録</a></dd>
            <dd id="ac"><a href="submenu">各種設定</a></dd>
            <div id="acset" style="display:none;position:relative">
                <dd class="ssme"><a href="material">材質</a></dd>
                <dd class="ssme"><a href="material?frice">フライス</a></dd>
            </div>
          </div>
        </li>
        </ul>    
    </div>

    <button style="position:absolute;top:30px;right:10px;" class="btn btn-xs" onClick="history.back()">戻る</button>
    -->
</div>
<div class="row" style="margin-left:10px;">
<button id="new_od" class="col-sm-1 btn btn-xs" style="margin:5px 0;padding:2px;">新規</button>
<button id="print" class="col-sm-1 col-sm-offset-10 btn btn-xs" style="margin:5px 0;padding:2px;">印刷</button>
</div>
<form method="post" action="oder">
<div id="calarea" style="margin:5px auto;">
<div class="row" style="margin:5px auto;">
    <table class="col-sm-6 t_cal" style="box-shadow:0 0 2px #000;">
    <tr><th>計算</th></tr>
    <tr><td>
        <table style="width:100%;">
        <div class="row mhead">
            <tr>
            <td style="text-align:center;width:50px;">顧客</td>
                <td style="padding:0 0 0 5px;">
                    <select style="background-color:#fcc;border-radius:5px;" id="selcust" class="sel" onChange="get_rank()">
                        <option value="-">顧客選択▼</option>
                        <?php
                        if(isset($hist)){
                            
                            foreach($list->result() as $res) {
                                    $attr = $res->c_name == $hist->o_c_name? ' selected' : '';
                                    print "<option value=".$res->c_id.$attr.">".$res->c_name."</option>";
                                }
                        }else{
                            foreach($list->result() as $res) {
                                print('<option value="' . $res->c_id . '">' . $res->c_name . '</option>');
                            }
                        }
                        
                        ?>
                    </select>
                </td>
                
           </tr>            
        </div>
        </table>
        
        <table style="width:100%;">
            <tr><th>見積日</th><th style="width:100px;">客先担当者</th><th>見積No.</th><th>客先依頼番号</th></tr>
            <tr>
            <?php if(!isset($hist)):?>
                <td style="padding:0 0 0 5px;"><input type="date" style="width:150px;" id="iraibi" value="<?=date('Y-m-d')?>"></td>
                <td><input type="text" id="tantou" style="width:100px;" placeholder="客先担当者"></td>
                <td><input type="text" id="od_number" value="0"></td>
                <td><input type="text" id="c_od_num" value=""><input type="hidden" id="order_id" value="0"></td>
            <?php else:?>
                <td style="padding:0 0 0 5px;"><input type="date" id="iraibi" value="<?=$hist->irai_day?>"></td>
                <td><input type="text" id="tantou" style="width:100px;" value="<?=$hist->o_tantou?>"></td>
                <td><input type="text" id="od_number" value="<?=$hist->o_number?>"></td>
                <td><input type="text" id="c_od_num" value="<?=$hist->cus_od_number?>"><input type="hidden" id="order_id" value="<?=$hist->o_id?>"></td>

            <?php endif;?>
            </tr>
            <tr><td style="text-align:right;padding:0 5px 0 0;">注文備考：</td><td colspan="3"><input type="text" id="mainmes" style="text-align:left;" value="<?php if (isset($hist)){print $hist->o_mes;};?>"></td></tr>
        </table>

        <hr style="border:none;height:12px;margin:0;box-shadow:0 12px 12px -12px #000 inset;">
        
        <div id="cal1">
        <div style="margin:10px 0;">

            <table id="tb_material">
                <tr>
                    <td valign="top" style="height:100px;">
                        <table id="tb_materialA">
                            <tr><th>グループ</th><tr>
                            <?php foreach($mg->result() as $rs){
                                echo
                                '<tr><input id="cp'.$rs->mg_id.'" type="hidden" value="'.$rs->cut_price.'">
                                <td id="mg'.$rs->mg_id.'"><a>'.$rs->mg_name.'</a></td><tr>
                                <script>
                                    $("#mg'.$rs->mg_id.'").click(function(){
                                        const cp=$("#cp'.$rs->mg_id.'").val();
                                        $("#cut_p").val(cp);
                                        $("#tb_materialB td").css("display","none");
                                        $(".mg'.$rs->mg_id.'").css({"display":"table-cell"});
                                        $("#tb_materialB").css("display","block");

                                    });
                                </script>';
                            }
                             ?>
                        </table>
                    </td>
                    <td valign="top">
                        <table id="tb_materialB">
                            <tr><th colspan="2" style="width:250px;">材質</th></tr>
                            <?php foreach($mat->result() as $rs):?>
                                <tr>
                                    <td id="mat_id<?= $rs->m_id?>" class="mg<?=$rs->m_group?>"><a><?= $rs->m_name?>
                                        <input type="hidden" id="kata_id<?=$rs->kata_id?>" value="<?=$rs->kata_id?>">
                                        <input type="hidden" id="mat_gravity<?=$rs->m_id?>" value="<?=$rs->gravity?>">
                                        <input type="hidden" id="mat_price<?=$rs->m_id?>" value="<?=$rs->m_weight_price?>"></a></td>
                                    <td class="mg<?=$rs->m_group?>" style="display:table-cell;"><a><?=$rs->m_kata?></a></td>
                                <tr>
                                    <script>
                                        $("#mat_id<?=$rs->m_id ?>").click(function(){
                                         let mName =$(this).text();
                                         mName=mName.replace(/\s+/g, "");
                                         const mList=$(this).next('td').text();
                                         const kata_id=($("#kata_id<?=$rs->kata_id?>").val());
                                         const mGravity=$("#mat_gravity<?=$rs->m_id?>").val();
                                         const mPrice=$("#mat_price<?=$rs->m_id?>").val();
                                         $("#grav").val(<?=$rs->m_group?>);
                                         $("#grav option:selected").text(mName);
                                         $("#mat_list").val(kata_id);
                                         $("#gravity").val(mGravity);
                                         $("#m_price").val(mPrice);
                                         $("#tb_material").css("display","none");
                                         $("#grav").css('background','#fff');
                                         mlist2();
                                        });
                                    </script>
                            <?php endforeach;?>
                        </table>
                    </td>
                </tr>
            </table>

            <button type="button" id="g_button" class="btn btn-xs">選択</button>
            <table class="mitsumori" style="width:100%;">
                <tr><th>材質</th><th>種類</th><th>フライス</th><th>研磨</th><th colspan="3" style="width:20%;">面取</th></tr>
                <tr>
                <td style="padding:0 0 0 5px;">
                        <select id="grav" class="sel" style="background-color:#fcc;border-radius:5px;" onchange="mat_set()">
                            <option value="0">材質▼</option>
                            <?php
                                foreach($mat->result() as $res) {
                                print('<option value="' . $res->m_group . '">' . $res->m_name . '</option>');
                                }
                            ?>
                        </select>
                    </td>

                    <td>
                        <select id="mat_list" onChange="mlist()">
                        <?php $data=$this->db->get('m_kata');
                            foreach ($data->result() as $ml):?>
                            <option value="<?=$ml->kata_id?>"><?=$ml->kata?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td style="width:80px;">
                        <select id="frice">
                            <option value="">-</option>
                            <option value="6F" selected>6F</option>
                            <option value="4F">4F</option>
                            <option value="2F">2F</option>
                        </select>
                    </td>
                    <td style="width:80px;">
                        <select id="graind">
                            <option value="">-</option>
                            <option value="2G">2G</option>
                            <option value="4G">4G</option>
                            <option value="6G">6G</option>
                        </select>
                    </td>
                    <td style="width:80px;"><input type="text" id="men" name="men" value="0.5"></td>
                    <td style="width:80px;"><input type="text" id="mn" name="m" value="4"></td>
                    <td><input type="text" id="menkazu" name="menkazu" value="ZC"></td>
                </tr>
            </table>

            <table style="width:100%;">
                <tr>
                    <th id="la">板厚mm</th><th id="lh" class="bhaba">幅mm</th><th id="lt" class="ctake">丈mm</th><th class="honly" style="display:none;">T-t-r</th>
                </tr>
                <tr>
                    <td style="padding:0 0 0 5px;">
                        <table class="kousa" style="margin:0 auto;"><!--A-->
                            <tr>
                                <td rowspan="2" style="width:80px;padding:0 0 0 2px;"><input type="text" id="atu" onchange="acal()"></td>
                                <td style="width:50px;">
                                    <select id="selap">
                                        <option value=""></option>
                                        <option value="1±">±</option>
                                        <option value="2+">+</option>
                                        <option value="3-">-</option>
                                    </select>
                                <td style="width:80px;"><input type="text" id="ap" placeholder="" onchange="intCheck(this.value)"></td>
                            </tr>
                            <tr>
                                <td style="width:50px;">
                                    <select id="selam" placeholder="+-">
                                        <option value=""></option>
                                        <option value="1±">±</option>
                                        <option value="2+">+</option>
                                        <option value="3-">-</option>
                                    </select>
                                <td style="width:80px;"><input type="text" id="am" placeholder="" onchange="intCheck(this.value)"></td>
                            </tr> 
                        </table>                    
                    </td>
                    <td class="bhaba">
                        <table id="habalock" class="kousa" style="margin:0 auto;">
                            <tr><!--B-->
                                <td rowspan="2" style="width:80px;padding:0 0 0 2px;"><input type="text" id="haba" onChange="bcal()"></td>
                                <td style="width:45px;">
                                    <select id="selbp">
                                        <option value=""></option>
                                        <option value="1±">±</option>
                                        <option value="2+">+</option>
                                        <option value="3－">-</option>
                                    </select>
                                </td>
                                <td style="width:80px;"><input type="text" id="bp" placeholder="" onchange="intCheck(this.value)"></td>
                            </tr>
                            <tr>
                                <td style="width:50px;">
                                    <select id="selbm">
                                        <option value=""></option>
                                        <option value="1±">±</option>
                                        <option value="2+">+</option>
                                        <option value="3-">-</option>
                                    </select>
                                </td>
                                <td style="width:80px;"><input type="text" id="bm" placeholder="" onchange="intCheck(this.value)"></td>
                            </tr> 
                        </table> 
                    </td>
                    <td class="ctake">
                        <table class="kousa" style="margin:0 auto;">
                            <tr><!--C-->
                            <td rowspan="2" style="width:80px;padding:0 0 0 2px;"><input type="text" id="take" onChange="ca()"></td>
                            <td style="width:50px;">
                                    <select id="selcp">
                                        <option value=""></option>
                                        <option value="1±">±</option>
                                        <option value="2+">+</option>
                                        <option value="3-">-</option>
                                    </select>
                            </td>
                            <td style="width:80px;"><input type="text" id="cp" placeholder="" onchange="intCheck(this.value)"></td>
                            </tr>
                            <tr>
                                <td style="width:50px;">
                                    <select id="selcm">
                                        <option value=""></option>
                                        <option value="1±">±</option>
                                        <option value="2+">+</option>
                                        <option value="3-">-</option>
                                    </select>
                                </td>
                                <td style="width:80px;"><input type="text" id="cm" placeholder="" onchange="intCheck(this.value)"></td>
                            </tr> 
                        </table> 
                    </td>
                    <td class="honly" style="display:none;">
                        <table id="honly" class="kousa">
                            <tr><!--D-->
                                <td style="width:40px;text-align:center;padding:0 5px;">T =</td>
                                <td style="width:80px;"><input type="text" id="take" onchange="intCheck(this.value)"></td>
                                <td rowspan="2" style="text-align:center;padding:0 5px;">r =<input style="margin-left:5px;width:80px;" type="text" id="r" onchange="intCheck(this.value)"></td>
                            </tr>
                            <tr>
                                <td style="width:40px;text-align:center;padding:0 5px;">t =</td>
                                <td style="width:80px;"><input type="text" id="t" onchange="intCheck(this.value)"></td>
                            </tr>
                        </table> 
                    </td>
                </tr>
            </table>
            <table style="width:100%;">
                <input type="hidden" id="mid" value="0">
                <tr><th>数量</th><th>顧客単価</th><th>合計</th><th rowspan="3" style="background:none;border:none;"><button type="button" style="height:60px;" class="btn btn-xs" id="enter">確定</button></th></tr>
                <tr>
                    <td style="padding:0 0 0 5px;width:100px;"><input type="text" id="kazu" value="1" onChange="k()"></td>
                    <td><input type="text" id="kyaku" name="kyaku" value=""></td>
                    <td><input type="text" id="kei" name="kei" value=""></td>
                </tr>
                <tr>
                    <td style="padding:0 5px 0 0px;text-align:right;">個別備考：</td><td colspan="2"><input type="text" id="mes" name="mes"  style="text-align:left;" value=""></td>
                </tr>
                </table>
                <hr style="margin:5px 0 0;border:0;height:10px;box-shadow:0 12px 12px -12px #000 inset;">
            <div class="calmeisai">
                <table>
                <tr><th colspan="5" style="background:none;">計算詳細</th></tr>
                <tr><th>比重</th><th>kg単価</th><th>切断標準(㎠/円)</th><th>切断面積(㎟)</th><th style="width:150px;">加工賃</th></tr>
                <tr>
                    <td style="padding:0 0 0 5px;"><input type="text" id="gravity" name="gravity" value=""></td>
                    <td><input type="text" id="m_price" name="mp" value=""></td>
                    <td><input type="text" id="cut_p" value=""></td>
                    <td><input type="text" id="danmen" value=""></td>
                    <td style="padding:0 0 0 10px;"><input type="text" id="kakou" value=""></td>
                    
                    
                </tr>
                <tr><th colspan="5" style="background:none;">母材</th></tr>

                <tr><th id="lba">厚mm</th><th id="lbh">幅mm</th><th id="lbt">丈mm</th><th>母材重量kg</th><th style="width:150px;">材料単価(母材)</th></tr>
                <tr>
                    <td style="padding:0 0 0 5px;"><input type="text" id="batu"></td>
                    <td><input type="text" id="bhaba"></td>
                    <td><input type="text" id="btake"></td>
                    <td><input type="text" id="kg"></td>
                    <td style="padding:0 0 0 10px;"><input type="text" id="price"></td>
                </tr>
                </table>
                <table style="width:100%;">
                <tr><th colspan="2">板厚Extra</th><th>研磨</th><th>面取</th><th style="width:150px;">追加計</th></tr>
                <tr>
                    <td style="padding:0 0 0 5px;">
                    <input type="text" id="atuex" style="width:50px;" name="atuex" value="1">
                    </td>
                    <td><input type="text" id="aex" name="atuex" value="0"></td>
                    <td><input type="text" id="graindex" name="graindex" value="0"></td>
                    <td><input type="text" id="menex" name="menex" value="0"></td>
                    <td style="padding:0 0 0 10px;"><input type="text" id="add" name="add" value=""></td>
                </tr>
                </table>

                <table style="width:100%;">
                <tr><th colspan="2">数量値引</th><th>顧客掛率</th><th>顧客掛割</th><th style="width:150px;">値引計</th></tr>
                <tr>
                    <td style="padding:0 0 0 5px;">
                    <input type="text" id="ke" style="width:50px;" name="ke" value="1">
                    </td>
                    <td><input type="text" id="kex" name="kex" value="0"></td>
                    <td><input type="text" id="rank" value="<?php if (isset($hist)){print $hist->c_rank;};?>"></td>
                    <td><input type="text" id="nebiki" value="0"></td>
                    <td style="padding:0 0 0 10px;"><input type="text" id="disc" name="disc" value=""></td>
                </tr>
                </table>

                <table style="width:100%;">
                <tr>
                    <th></th>
                    <th></th><th></th><th style="width:150px;">値引前</th>
                    <th style="width:150px;">販売単価</th>
                </tr>
                <tr>
                    <td style="padding:0 0 0 5px;"><input type="hidden" id="skg" value=""></td>
                    <td></td><td></td><td><input type="text" id="kingaku" name="kingaku" value=""></td>   
                    <td style="padding:0 0 0 10px;"><input type="text" id="urine" value=""></td>
                </tr>
                </table>

                <table style="width:100%;">
                <tr>
                    <th style="padding:0 0 0 2px;"><button type="button" id="mdel" class="btn btn-xs btn-del">全削除</th>
                    <th><button type="button" id="re_cal" class="btn btn-xs" >計算</th>
                    <th><button type="button" id="mancal" class="btn btn-xs">手計算</th>
                    <th><button type="button" id="delete" class="btn btn-xs">個別削除</th>
                </tr>
            </table>
            </div>
        </div>
        </div>
        </td>
    </tr>
    </table>

    <table class="col-sm-6 t_cal" style="box-shadow:0 0 2px #000;position:relative;">
        <tr><th style="box-shadow:0 0 2px #fff inset;">一覧</th></tr>
        <tr>
            <td>
            <div id="meisai">
                <table class="mview" style="text-align:center;">
                <tr><th>材質</th><th>板厚</th><th>幅</th><th>丈</th><th>F</th><th>面取</th><th>数量</th><th>単価</th><th>金額</th></tr>
                <?php if(isset($hsub)){
                        echo '<th style="position:absolute;top:0;right:0;padding:0 5px 0 0;">'.$count['val']." 件/合計 ".number_format($t_price)."円</th>";
                        echo '<input type="hidden" id="odcnt" value="'.$count['val'].'"><input type="hidden" id="odprice" value="'.$t_price.'">';
                    foreach($hsub->result() as $v){
                        echo
                        '<tr style="border-bottom:1px solid #4797a3;">
                            <td><a id="m'.$v->om_id.'" onclick="mlist2()">'.$v->om_material.'</a></td>
                            <td style="border-left:1px solid #4797a3;">
                                <table>
                                <tr><td rowspan="2" class="vi" style="margin:0;padding:0 1px;">'.$v->atsu.'</td><td class="m_kousa" style="margin:0;padding:0;">'.substr($v->sap,1).$v->vap.'</td></tr>
                                <tr><td class="m_kousa">'.substr($v->sam,1).$v->vam.'</td></tr></table>
                                </td>
                            
                            <td style="border-left:1px solid #4797a3;">
                                <table>
                                <tr><td rowspan="2">'.$v->haba.'</td><td class="m_kousa">'.substr($v->sbp,1).$v->vbp.'</td></tr>
                                <tr><td class="m_kousa">'.substr($v->sbm,1).$v->vbm.'</td></tr></table>
                                </td>
                            <td style="border-left:1px solid #4797a3;">
                                <table>
                                <tr><td rowspan="2">'.$v->take.'</td><td class="m_kousa">'.substr($v->scp,1).$v->vcp.'</td></tr>
                                <tr><td class="m_kousa">'.substr($v->scm,1).$v->vcm.'</td></tr></table>
                                </td>
                            <td style="border-left:1px solid #4797a3">'.$v->f.$v->graind.'</td>
                            <td>'.$v->men.'</td>
                            <td>'.$v->kazu.'</td>
                            <td>'.number_format($v->price).'</td>
                            <td>'.number_format($v->t_price).'</td>
                        </tr>
                        <script>
                            $("#m'.$v->om_id.'").click(function(){
                                $("#haba,#bhaba,#atu,#batu,#take,#btake,#selap,#selam,#selbp,#selbm,#selcp,#selcm,#ap,#am,#bp,#bm,#cp,#cm,#tanka,#skg,#kg,#price").val("");';

                                if(ctype_digit($v->atsu)==true){
                                    echo '$("#atu").val('.$v->atsu.');';
                                }else{
                                    $fai=$v->atsu;
                                    $fai=substr($fai,2);
                                    $nul='';
                                    echo '
                                    $("#atu").val('.$fai.');
                                    $("#haba").val("'.$nul.'");';
                                };
                                $tanka=number_format($v->price);
                                $kei=number_format($v->t_price);
                                $mat=$v->om_material;
                                $this->db->select('m_group');
                                $query=$this->db->get_where('material',array("m_name"=>$mat));
                                $mat_g= $query->row('m_group');
                                echo '
                                $("#cut_p").val('.$v->cut_tanka.');
                                $("#atuex").val('.$v->atuex.');
                                $("#aex").val('.$v->ax_price.');

                                $("#selap").val("'.$v->sap.'");
                                $("#selam").val("'.$v->sam.'");
                                $("#ap").val('.$v->vap.');
                                $("#am").val('.$v->vam.');

                                $("#selbp").val("'.$v->sbp.'");
                                $("#selbm").val("'.$v->sbm.'");
                                $("#bp").val('.$v->vbp.');
                                $("#bm").val('.$v->vbm.');

                                $("#selcp").val("'.$v->scp.'");
                                $("#selcm").val("'.$v->scm.'");
                                $("#cp").val('.$v->vcp.');
                                $("#cm").val('.$v->vcm.');
                                
                                $("#haba").val('.$v->haba.');
                                $("#take").val('.$v->take.');
                                $("#kazu").val('.$v->kazu.');
                                $("#frice").val("'.$v->f.'");
                                $("#kyaku").val("'.$v->price.'");
                                $("#urine").val('.$v->price.');
                                $("#kei").val("'.$v->t_price.'");
                                $("#mid").val('.$v->om_id.');
                                $("#grav").prop("disabled",true);
                                $("#grav").val('.$mat_g.');
                                $("#grav option:selected").text("'.$mat.'");
                                $("#grav").css("background-color","#fff");
                                $("#gravity").val('.$v->om_gravity.');
                                $("#mat_list").val("'.$v->mat_type.'");
                                $("#graind").val("'.$v->graind.'");
                                $("#mes").val("'.$v->om_mes.'")';
                                $men=$v->men;
                                $men=substr($men,0,3);
                                $mk=substr($v->men,3);
                                $ne=$v->k_nebiki;
                                $nekei=$ne + $v->kzex_price;
                                $add=$v->graindex + $v->menex + $v->ax_price;
                                echo '
                                $("#men").val('.$men.');
                                $("#menkazu").val("'.$mk.'");
                                $("#kg").val('.$v->b_weight.');
                                $("#skg").val('.$v->om_weight.');
                                $("#kakou").val('.$v->kakou.');
                                $("#m_price").val('.$v->mt_tanka.');
                                $("#kingaku").val('.$v->st_price.');
                                $("#batu").val('.$v->b_atu.');
                                $("#bhaba").val('.$v->b_haba.');
                                $("#btake").val('.$v->b_take.');
                                $("#price").val('.$v->tanka.');
                                $("#ke").val('.$v->kazuex.');
                                $("#kex").val('.$v->kzex_price.');
                                $("#graindex").val('.$v->graindex.');
                                $("#menex").val('.$v->menex.');
                                $("#add").val('.$add.');
                                $("#nebiki").val('.$ne.'); 
                                $("#disc").val('.$nekei.');
                                $("#danmen").val('.$v->danmen.');
                                mlist2();
                            });
                        </script>
                        ';
                    }
                }
                ?>
                </table>
            </div>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;">
            <?php
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                if(isset($_GET['page'])){
                    $page=$_GET['page'];
                }else{
                    $page=1;
                };
                $maxp=30;
                $cnt=$count['val'];

                if ($cnt<$maxp){
                    echo 1;
                }else{
                    $pages=ceil($cnt / $maxp);
                    for ($i=1;$i<=$pages;$i++){
                        if ($page==$i){
                            echo $page."　";
                        }else{
                        echo "<a href='mitsumori?id=".$id."&page=".$i."'>".$i."</a>　";
                        }
                    }
                }
            }
            ?>
            </td>
        </tr>
    </table>
</div>
</div>
</form>   
  <script type="text/javascript" src="../js/menu.js"></script>
  <script type="text/javascript" src="../js/mitsumori.js"></script>
  <script type="text/javascript" src="../js/print.js"></script>
</body>
</html>