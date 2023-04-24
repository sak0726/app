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
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/jutyu.css">
    <link rel="stylesheet" href="../css/ken.css">
    <link rel="stylesheet" href="../cbox/colorbox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>受注登録</title>

</head>
<body>
<style>
    .h{
        display:none!important;
    }
    </style>
<div class="wrap">
<div id="inner">

<div id="sideWrap" style="width:18%;">
    <div style="position:relative;">    
        <div class='sideMenu'>
        <p style="margin-bottom:0px;font-weight:100;">受注登録</p>

        <a href="menu"><button type="button" class="btn btn-primary btn-sm">TOP</button></a>
        <a href="kanri?pages=1"><button type="button" class="btn btn-primary btn-sm">受注管理</button></a>
        <a href="gai_kanri?pages=1"><button type="button" class="btn btn-primary btn-sm">仕入管理</button></a>
        <a href="zai_kanri?pages=1" class=""><button type="button" class="btn btn-primary btn-sm">在庫管理</button></a>
        <a class="if98" href="gait"><button type="button" class="btn btn-primary btn-sm cos-sm-2">各種設定</button></a>
        <button class="btn btn-primary btn-sm" onClick="history.back()" style="width:100%;">戻る</button>
        <button class="btn btn-primary btn-sm cos-sm-2" id="out" style="width:100%;">ログアウト</button>

        </div>
    </div>
</div>
<div id="mainWrap" style="width:82%;">
    <div class="row" style="margin-left:10px;position:relative;">
        <button id="new_od" class="col-sm-1 btn btn-primary btn-sm" style="margin:5px 0;padding:2px;">新規</button>
        <div id="pop_s" style="position:absolute;display:none;top:30px;left:293px;padding:5px;border:1px solid #000080;background:#fff;width:auto;">
            <input id="print_zk" type="button" class="btn btn-primary btn-sm" value="税込">
            <input id="print_zn" type="button" class="btn btn-primary btn-sm" value="税抜">
        </div>
        <input type="button" id="f_close" class="col-sm-1 col-sm-offset-10 btn btn-primary btn-sm" name="<?=$_GET['id']?>" style="margin:5px 0;padding:2px;" value="保存">
        <input type="button" id="f_delete" class="col-sm-1 col-sm-offset-10 btn btn-danger btn-sm" style="margin:5px 0;padding:2px;" value="削除">

    </div>
<div id="calarea" class="jutyu" style="margin:5px auto;">
<div name="mainform" method="post" action="oder" style="height:480px;">
<input type="hidden" id="k_id" value="">
            <div class="row">
                <div class="col-sm-7">
                    <table class="t_cal" style="background:#fff;box-shadow:0 0 2px #000;padding-right:5px;">
                        <tr>
                            <td style="width:50px;"><label for="t_day">登録日</label></td><td><input class="form-control" type="text" id="t_day" value=<?=date('Y/m/d',strtotime($hist[0]['jutyu_D']))?> onChange="genDate(this.value,this.id);od_upd(this.id,this.value)"></td>
                            <td style="width:50px;"><label for="selcust">客先</label></td>
                            <td colspan="7" style="width:300px;">
                                <select id="selcust" class="form-select" onChange="od_inst(this.text,<?=$maxId['max_Mid']+1?>)">
                                    <?php
                                        foreach($list->result() as $res) {
                                            if($res->c_name===$hist[0]['cust']){
                                                print('<option value="'.$res->c_id.'" selected>'.$res->c_name.'</option>');
                                            }else{
                                                print('<option value="' . $res->c_id . '">' . $res->c_name . '</option>');
                                            }
                                        }                            
                                    ?>
                                </select>
                                

                            </td>
                            <td style="width:50px;"><label for="mitsuNum">見積#</label></td><td><input class="form-control" type="text" id="cust_odId" placeholder="" value="<?=$hist[0]['m_num']?>" onChange="od_upd(this.id,this.value)"></td>
                        
                        </tr>
                        <tr class="">
                            <td><label for="k_bunrui">分類</label></td><td><input class="form-select up_head" id="k_bunrui" value="<?=$hist[0]['k_bunrui']?>" autocomplete="off"></td>
                            <td><label for="k_tantou">ご担当</label></td><td><input class="form-select up_head" id="k_tantou" value="<?=$hist[0]['k_tantou']?>" autocomplete="off"></td>
                            <td><label for="k_odNum">注文#</label></td><td><input class="form-control up_head" type="text" id="k_odNum" placeholder="" value="<?=$hist[0]['k_odNum']?>" onChange="od_upd(this.id,this.value)" autocomplete="off"></td>
                        </tr>
                        <tr class="h">
                            <td><label for="k_genba">現場名</label><td colspan="9"><input id="k_genba" class="form-control up_head" value="<?=$hist[0]['k_genba']?>" autocomplete="off"></td>
                            <td><label for="k_tiki">地域名</label><td><input id="k_tiki" class="form-control up_head" value="<?=$hist[0]['k_tiki']?>" autocomplete="off"></td>
                        <tr>
                            <td><label for="kenmei">案件名</label></td><td colspan="7"><input class="form-control up_head" style="text-align:left;" type="text" id="kenmei" value="<?=$hist[0]['kenmei']?>" onChange="od_upd(this.id,this.value)" autocomplete="off" placeholder="販売"></td>
                            <td><label for="tantou">担当</label></td><td><input class="form-control up_head" id="tantou" placeholder="担当" value="坂本" onChange="od_upd(this.id,this.value)"></td>
                            <td><label for="k_Kid">受注#</label></td><td><input id="k_Kid" class="form-control" type="text" value="<?=$hist[0]['k_Kid']?>" placeholder=""></td>
                        </tr>
                    </table>
                </div>

                <div class="denpyo col-sm-5">
                    <table class="t_cal" style="font-size:10px;background:#fff;box-shadow:0 0 2px #000;">
                        <tr>
                            <td style="width:50px;"><input id="print_m" type="button" class="btn btn-primary btn-sm btn_day" name="m_day" value="見積書"></td>
                            <?php if($hist[0]['m_day']!="" && $hist[0]['m_day']!="0000-00-00"):?>
                                <td style="width:35px;">見積</td><td><input class="day" value="m_day" type="checkbox" checked></td><td><label>見積日</label></td><td><input id="m_day" name="dp" class="form-control up_head" value="<?=date('Y/m/d',strtotime($hist[0]['m_day']))?>"></td>
                            <?php else:?>
                                <td style="width:35px;">見積</td><td><input class="day" value="m_day" type="checkbox"></td><td><label>見積日</label></td><td><input id="m_day" name="dp" class="form-control up_head" value=""></td>
                            <?php endif;?>
                            <td><label>失注</label></td><td style="text-align:left;"><input type="checkbox"></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td style="width:50px;"><input id="print_n" type="button" class="btn btn-primary btn-sm btn_day" name="nouhin_D" value="納品書"></td>
                            <?php if($hist[0]['jutyu_D']!="0000-00-00" && $hist[0]['jutyu_D']!=""):?>
                                <td>確定</td><td><input class="day" value="jutyu_D" type="checkbox" checked></td><td><label>受注日</label></td><td><input id="jutyu_D" name="dp" class="form-control up_head" value="<?=date('Y/m/d',strtotime($hist[0]['jutyu_D']))?>"></td>
                            <?php else:?>
                                <td>確定</td><td><input class="day" value="jutyu_D" type="checkbox"></td><td><label>受注日</label></td><td><input id="jutyu_D" name="dp" class="form-control up_head" value=""></td>
                            <?php endif;?>

                            <td><label>納期日</label></td>
                            <?php if($hist[0]['nouki']!="" && $hist[0]['nouki']!="0000-00-00"):?>
                                <td><input id="nouki" name="dp" class="form-control up_head" value="<?=date("Y/m/d",strtotime($hist[0]["nouki"]))?>"></td>
                            <?php else:?>
                                <td><input id="nouki" name="dp" class="form-control up_head" value=""></td>
                            <?php endif;?>

                            <td><label>納品</label></td>
                            <?php if($hist[0]['nouhin_D']!="" && $hist[0]['nouhin_D']!="0000-00-00"):?>
                                <td><input class="day" value="nouhin_D" type="checkbox" checked></td><td><input id="nouhin_D" name="dp" class="form-control up_head" value="<?=date('Y/m/d',strtotime($hist[0]['nouhin_D']))?>"></td>
                            <?php else:?>
                                <td><input class="day" value="nouhin_D" type="checkbox"></td><td><input id="nouhin_D" name="dp" class="form-control up_head"></td>
                            <?php endif;?>
                            </tr>
                        <tr>
                            <td style="width:50px;"><input id="print_s" type="button" class="btn btn-primary btn-sm btn_day" name="sk_day" value="請求書"></td><td>請求</td>
                            <?php if($hist[0]['sk_day']!="" && $hist[0]['sk_day']!="0000-00-00"):?>
                                <td><input class="day" value="sk_day" type="checkbox" checked></td><td><label>請求日</label></td><td><input id="sk_day" class="form-control up_head" name="dp" value="<?=date('Y/m/d',strtotime($hist[0]['sk_day']))?>"></td>
                            <?php else:?>
                                <td><input class="day" value="sk_day" type="checkbox"></td><td><label>請求日</label></td><td><input id="sk_day" name="dp" class="form-control up_head" value=""></td>
                            <?php endif;?>
                        </tr>
                    </table>
                </div>
            </div>
        <div class="value" style="text-align:-webkit-right;margin-bottom:10px;">

        <div class="row">
            <div class="col-10">
                <label style="font-weight:100;">合計</label>
            </div>
            <div class="col-2 text-right;display:inline;">
                <input id="kei_tanka" class="form-control" style="text-align:right;" value="<?=number_format($hist[0]['total'])?>">
            </div>
        </div>

        <div id="meisai" style="height:358px;overflow-y:scroll;border:1px solid #dee2e6;">
            <table id="t_main" class="mhead" style="font-size:0.7em;">

                    <tr><th class="h" style="width:2%;"><input type="button" class="btn btn-primary btn-sm" style="height:20px;padding:0 8px;" value="一括"></th><th style="width:2%;"></th><th style="width:2%;"></th><th style="width:2%;"></th><th style="width:3%;">#</th><th style="width:5%;">Code</th><th>項目</th><th style="width:20%;">詳細</th><th class="h" style="width:5%;">区分</th><th style="width:5%;">数量</th><th style="width:5%;">単位</th><th style="width:7%;">単価</th><th style="width:10%;">金額</th><th style="width:2%;"></th><th style="width:2%;"></th></tr>

                <?php foreach($hist[1] as $key=>$val):
                    $kazu=$val['quan'];
                    $tanka=$val['tanka'];
                    if($kazu!=null){
                        $kazu=number_format($kazu);
                    }
                    if($tanka!=null){
                        $tanka=number_format($tanka);
                    }
                ?>

                <tr id="tr<?= $val['m_id']?>" style="border-bottom: 1px solid rgb(204, 201, 201);" name="<?=$val['num']?>" onclick="kt(this.id)">
                <td class="h"><input type="button" id="b<?=$val['m_id']?>" class="hb btn btn-sm" value="管理" style="height:24px;font-size:12px;text-align:center;padding-top:2px;"></td>
                <td><button type="button" id="mmu<?=$val['m_id']?>" class="btn btn-sm btn-center" style="padding:0px;height:23px;" onclick="m_moveUp(this)"><span class="material-symbols-outlined">north</span></button></td>
                <td><button type="button" id="mmd<?=$val['m_id']+1?>" class="btn btn-sm btn-center" style="padding:0px;height:23px;" onclick="m_moveDown(this)"><span class="material-symbols-outlined">south</span></button></td>
                <td><button id="ad<?= $val['m_id']?>" type="button" class="btn btn-primary btn-sm tk" style="text-align:center;height:23px;padding:0;"><span class="material-symbols-outlined">arrow_right</span></button></td>

                    <td><input id="n<?=$val['m_id']?>" type="number" class="form-control tab" value=<?=$val['num']?> onchange="m_up(this.id,this.value)">
                    <td style="position:relative;"><div id="cat<?=$val['m_id']?>" style="width:500px;z-index:2;position:absolute;display:none;padding:20px;text-align:center;background: #8caaffa3;">
                    <div class="row">
                        <div id="mat<?=$val['m_id']?>" class="col-sm-3">    
                            <input type="button" class="btn btn-primary btn-sm ajc" style="text-align:center;" value="野菜" data="6">
                            <input type="button" class="btn btn-primary btn-sm ajc" style="text-align:center;" value="果物" data="7">
                            <input type="button" class="btn btn-primary btn-sm ajc" style="text-align:center;" value="穀物" data="">
                            <input type="button" class="btn btn-primary btn-sm ajc" style="text-align:center;" value="加工品" data="8">
                        </div>
                        <div id="cat_pannel<?=$val['m_id']?>" class="col-sm-9" style="background: #e3f1fd;display:none;height: 220px;overflow-y: scroll;">    
                            <table id="cat_ajax<?=$val['m_id']?>">
                                <tr><th>code</th><th>項目</th><th>詳細</th><th>単価</th><th>在庫数</th></tr>
                            </table>
                        </div>
                    </div>
                </div>
                    <input id="c<?=$val['m_id']?>" type="number" class="form-control cat tab" value="<?=$val['od_no']?>" name="num" autocomplete="off">
                    <td><input id="z<?=$val['m_id']?>" type="text" class="form-control tab" style="text-align:left;" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="<?=$val['zuban']?>" autocomplete="off"></td>
                    <td><input id="h<?=$val['m_id']?>" type="text" class="form-control tab" style="text-align:left;" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="<?=$val['hinmei']?>" autocomplete="off"></td>
                    <td class="h"><select id="w<?=$val['m_id']?>" type="datelist" class="form-control tab" style="text-align:center;" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" autocomplete="off">
                            <?php if($val['m_kubun']=="工事"):?>
                                <option value="工事" selected>工事</option>
                                <option value="物品">物品</option>
                                <option value="経費">経費</option>
                            <?php elseif($val['m_kubun']=="物品"):?>
                                <option value="工事" >工事</option>
                                <option value="物品" selected>物品</option>
                                <option value="経費">経費</option>
                            <?php else:?>
                                <option value="工事">工事</option>
                                <option value="物品">物品</option>
                                <option value="経費" selected>経費</option>
                            <?php endif ;?>
                        </select>
                    </td>
                    <td><input id="q<?=$val['m_id']?>" type="text" class="form-control tab" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="<?=$kazu?>" autocomplete="off"></td>
                    <td><input id="i<?=$val['m_id']?>" list="tani_list<?=$val['m_id']?>" type="text" class="form-control tab d_list" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="<?=$val['tani']?>" autocomplete="off">
                        <datalist id="tani_list<?=$val['m_id']?>">
                            <?php foreach($tanis->result() as $tani):?>
                                <option value="<?=$tani->tani?>"></option>
                            <?php endforeach;?>
                        </datalist>
                    </td>
                    <td><input id="t<?=$val['m_id']?>" type="text" class="form-control tab" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="<?=$tanka?>" autocomplete="off"></td>
                    <td><input id="g<?=$val['m_id']?>" type="text" class="form-control tab" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="<?=number_format($val['z_total'])?>" autocomplete="off"></td>
                    <td><button id="d<?php echo $val['m_id'];?>" type="text" class="form-control btn btn-danger btn-sm tab" style="text-align:center;height:23px;padding:0;" onclick="kb_delete(this)"><span class="material-symbols-outlined">delete_sweep</span></button></td>
                    <td><button type="button" id="r<?=$val['m_id']?>" class="btn btn-primary btn-sm graf" style="text-align:center;height:23px;padding:0;"><span class="material-symbols-outlined">donut_large</span></button></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
 
        
        <script>

            $(function(){
                $('#tsuik').click(function(v){
                    let kanriId=$(this).attr('name');
                    let kb=$("#nouki").val();
                        $.ajax({
                            type:"post",
                            url:"get_MaxId",//Get_data->max_id()296;
                            data:"kanri_id="+kanriId+"&kb_nouki="+kb,
                            success:function(val){
                                let kyaku=$("#selcust option:selected").val();
                                vl=JSON.parse(val);
                                let t_cnt=Object.keys(vl[1]).length;
                                var html = '<tr id="tr'+vl[0]['m_id']+'" name="'+vl[0]['num']+'" class="trclass">'+
                                '<td><input type="button" id="b'+vl[0]['m_id']+'" class="hb btn btn-sm" value="管理" style="height:24px;font-size:12px;text-align:center;padding-top:2px;"></td>'+
                                '<td><button type="button" id="mmu<?=$val['m_id']?>" class="btn btn-sm btn-center" style="padding:0px;height:23px;" onclick="m_moveUp(this)"><span class="material-symbols-outlined">north</span></button></td>'+
                                '<td><button type="button" id="mmd<?=$val['m_id']+1?>" class="btn btn-sm btn-center" style="padding:0px;height:23px;" onclick="m_moveDown(this)"><span class="material-symbols-outlined">south</span></button></td>'+
                                '<td><button id="ad<?= $val['m_id']?>" type="button" class="btn btn-primary btn-sm tk" style="text-align:center;height:23px;padding:0;"><span class="material-symbols-outlined">arrow_right</span></button></td>'+

                                '<td><input id="n'+vl[0]['m_id']+'" type="number" class="form-control" name="num" value='+vl[0]['num']+'></td>';
                                    html=html+'<td><input id="c'+vl[0]['m_id']+'" type="number" class="form-control cat" value="<?=$val['od_no']?>" name="num" autocomplete="off"></td>'+
                                    '<td><input id="z'+vl[0]['m_id']+'" type="text" class="form-control tab" style="text-align:left;" name="'+vl[0]['num']+'" onchange="zinst(this.name,this.id,this.value)"></td>'+
                                    '<td><input id="h'+vl[0]['m_id']+'" type="text" class="form-control tab" style="text-align:left;" onchange="zinst(this.name,this.id,this.value)"></td>'+
                                    '<td><select id="w'+vl[0]['m_id']+'" type="text" class="form-control tab" style="text-align:center;" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" autocomplete="off">'+
                                        '<option value="工事">工事</option><option value="物品">物品</option><option value="経費">経費</option></select>'+
                                    '</td>'+
                                    '<td><input id="q'+vl[0]['m_id']+'" type="text" class="form-control tab" name="<?=$val['num']?>" value="<?=$val['od_num']?>" autocomplete="off"></td>'+
                                    '<td><input id="i'+vl[0]['m_id']+'" list="tani_list'+vl[0]['m_id']+'" type="text" class="form-control tab d_list" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="" autocomplete="off">'+
                                        '<datalist id="tani_list'+vl[0]['m_id']+'">';
                                        for(i=0;i<t_cnt;i++){
                                            html+='<option value="'+vl[1][i]['tani']+'"></option>';
                                        }
                                    html+='</datalist></td>'+
                                    '<td><input id="t'+vl[0]['m_id']+'" type="text" class="form-control tab" onchange="zinst(this.name,this.id,this.value)"></td>'+
                                    '<td><input id="g'+vl[0]['m_id']+'" type="text" class="form-control tab" onchange="zinst(this.name,this.id,this.value)"></td>'+
                                    '<td><button id="d'+vl[0]['m_id']+'" type="text" class="form-control btn btn-danger btn-sm tab" style="text-align:center;height:23px;" onclick="kb_delete(this)"><span class="material-symbols-outlined">delete_sweep</span></button></td>'+
                                    '<td><button type="button" id="r'+vl[0]['m_id']+'" class="btn btn-primary btn-sm graf" style="text-align:center;height:23px;padding:0;"><span class="material-symbols-outlined">donut_large</span></button></td></tr>';

                                $('#t_main').append(html);
                            }
                        });

                            $(document).on('click','.remove',function(){
                                $(this).parents('tr').remove();
                            });
                            
                })

            });
        </script>
</div>
<div id="<?=$_GET['id']?>" class="row">

</div>
<div class="row h" style="padding:0;font-weight:normal;"><span class="col-sm-4" style="padding-left:322px;">売上</span><span class="col-sm-6" style="padding-left:314px;">原価</span></div>

<div style="display:none;font-weight:normal;">
    <input type="button" id="tsuik" value="+" name="<?=$_GET['id']?>" style="text-align:center;width:70px;margin-right:10px;" class="form-control btn btn-primary btn-sm">
    <input type="hidden" id="graf" value="グラフ" style="text-align:center;width:70px;margin:5px 0 0 0;background:lightskyblue;" class="form-control btn">
    <label for="kouji_kei" style="margin:5px 0 0 5px;">工事</label><input id="kouji_kei" type="text" class="form-control kei al-r" value="<?=number_format($hist[0]['k_kouji'])?>" disabled>
    <label for="buppin_kei" style="margin-top:5px;">物品</label><input id="buppin_kei" type="text" class="form-control kei al-r" value="<?=number_format($hist[0]['k_buppin'])?>" disabled>
    <label for="keihi_kei" style="margin-top:5px;">経費</label><input id="keihi_kei" type="text" class="form-control kei al-r" value="<?=number_format($hist[0]['k_keihi'])?>" disabled>
    <label for="ki_tanka" style="margin-top:5px;">合計</label><input id="kei_tanka" type="text" class="form-control kei al-r" value="<?=number_format($hist[0]['total'])?>" disabled>
    <label for="kei_mai" style="margin:5px 0 0 0;">点数</label><input id="kei_mai" type="text" class="form-control kei al-r" style="width:80px;" value="<?=$hist[0]['z_mai']?>" disabled>
    <label for="zai_kei" style="margin-top:5px;">物品</label><input id="zai_kei" type="text" class="form-control kei al-r" value="">
    <label for="kt_kei" style="margin-top:5px;">外注工事費</label><input id="kt_kei" type="text" class="form-control kei al-r" value="">
    <label for="genka_kei" style="margin-top:5px;">原価計</label><input id="genka_kei" type="text" class="form-control kei al-r" value="">
    <label for="arari" style="margin-top:5px;">粗利</label><input id="arari" type="text" class="form-control kei al-r" value="">
    <?php if($hist[0]['total']==0):?>
        <label for="ritsu" style="margin-top:5px;">利率</label><input id="ritsu" type="text" class="form-control kei al-r" style="width:80px;" value="">
    <?php else: ?>
        <label for="ritsu" style="margin-top:5px;">利率</label><input id="ritsu" type="text" class="form-control kei al-r" style="width:80px;" value="">
    <?php endif;?>
    <td><button type="button" class="btn btn-primary btn-sm grafk" style="text-align:center;padding:0;margin:5px 0 0 2px;"><span class="material-symbols-outlined">donut_large</span></button></td>
</div>

<div class="chart-area">
<canvas id="chart01"></canvas>
</div>
<tr><td colspan="8"><hr style="margin:5px 0 5px 0;border:0;height:1px;box-shadow:0 12px 12px -12px #000 inset;"></td></tr>

<div id="zai" class="jutyu h" style="height:200px;overflow-y:scroll;border:1px solid #c1c6cb;font-size:0.9em;">
    <table id="zi" class="jutyu">
    <tr><th><input type="button" class="btn btn-primary btn-sm" style="height:20px; padding:0 0px;" value="一括"></th>
    <th style="width:3%;">#</th><th style="width:5%;">Code</th><th style="">項目</th><th style="">型番/型式</th><th style="width:100px;">仕入先</th><th style="width:5%;">数量</th><th style="width:5%;">単位</th><th style="width:7%;">単価</th><th style="width:7%;">合計</th>
    <th style="width:5%;">区分</th><th style="width:2%;"></th>
</tr>

        <?php foreach($zai->result() as $z):?>
           <tr id="zr<?=$z->zid?>" class="del">
            <td><input type="checkbox"></td>
            <td style="position:relative;"><input type="button" class="btn btn-primary btn-sm" style="height:23px;padding:0 4px;" value="発注">

            </td>

            <td><input id="zn<?=$z->zid?>" type="number" class="form-control al-r" value='<?=$z->zid?>' name="<?=$z->zid?>"></td>
            <td><input id="zc<?=$z->zid?>" type="number" class="form-control al-r" value='<?=$z->z_code?>' name="<?=$z->zid?>"></td>
            <td><input id="zz<?=$z->zid?>" class="form-select" style="text-align:left!important;" value="<?=$z->material?>" name="<?=$z->zid?>" onchange="adz(this.id,0,this.value,this.name)"></td>
            <td><input id="zh<?=$z->zid?>" class="form-select" style="text-align:left!important;" value="<?=$z->a?>" name="<?=$z->zid?>" onchange="adz(this.id,0,this.value,this.name)"></td>
            <td><input id="zy<?=$z->zid?>" class="form-select" value="<?=$z->z_store?>" name="<?=$z->zid?>" onchange="adz(this.id,this.name,this.value)">
            </td>
            <td><input id="zq<?=$z->zid?>" type="text" class="form-control al-r" value="<?=number_format($z->z_quan)?>" name="<?=$z->zid?>" onchange="adz(this.id,this.name,this.value)"></td>
            <td><input id="zo<?=$val['m_id']?>" list="z_tani_list<?=$val['m_id']?>" type="text" class="form-control al-r" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="<?=$z->z_tani?>" autocomplete="off">
                        <datalist id="z_tani_list<?=$val['m_id']?>">
                            <?php foreach($tanis->result() as $tani):?>
                                <option value="<?=$tani->tani?>"></option>
                            <?php endforeach;?>
                        </datalist>
                    </td>
            <td><input id="zt<?=$z->zid?>" type="text" class="form-control al-r" value="<?=number_format($z->z_tanka)?>" name="<?=$z->zid?>" onchange="adz(this.id,this.name,this.value)"></td>
            <td><input id="zg<?=$z->zid?>" type="text" class="form-control al-r" value="<?=number_format($z->z_total)?>" name="<?=$z->zid?>" onchange="adz(this.id,this.name,this.value)"></td>
            <td><input class="form-select" value="物品"></td>
            <td><input type="button" class="btn btn-primary btn-sm" style="height:23px;padding:1px 4px;" value="在庫"></td>
            <td><button id="zd<?=$z->zid?>" type="button" class="form-control btn btn-danger btn-sm btn-center" style="height:23px;padding:0;" value="x" onclick="del(this)"><span class="material-symbols-outlined">delete_sweep</span></button></td>
        </tr>
        <?php endforeach;?>
    </table>
</div>
<div class="zairyou h" style="position:relative;padding:0 0 0 217px;font-size:0.7rem;">
    <div id="zaiko_pannel" style="display:none;position:absolute;padding:10px;top:-539px;left:35%;width: 500px;background: #ddedfbeb;text-align:center;box-shadow:0 0 4px;border: 3px solid #000080;">
        <div style="display:flex;"><span style="width:80px;">Code</span><input class="form-control" style="margin-left:-11px;width:100px;padding:0;font-size:12px;" value="12022"><span style="width:80px;">在庫数</span><input class="form-control" style="width:100px;padding:0;font-size:12px;" value="0"></div>
        <div style="display:flex;"><span style="width:80px;">項目</span><input class="form-control" style="padding:0;font-size:12px;" value="Cクランプ"></div>
        <div style="display:flex;"><span style="width:80px;">型番</span><input class="form-control" style="padding:0;font-size:12px;" value="W200"></div>
            <hr>
            <label>入出庫<label><select class="form-select" style="padding: 0;width: 65px;margin-left: 402px;font-size: 16px;">
            <option value="2020">2020</option></select>
            <table style="width:100%;font-size:15px;">
            <tr><th>繰越</th><th>日付</th><th>取引先</th><th>入庫</th><th>出庫</th><th>合計</th></tr>
            <?php foreach($zaiko->result() as $zk):?>
                <tr style="border-bottom:1px solid #000;"><td><?=number_format($zk->z_mae)?></td><td><?=date('Y/m/d',strtotime($zk->z_day))?></td><td><a href="jutyu?id=fs20-6"><?=$zk->z_saki?></a></td><td><?=number_format($zk->z_iri)?></td><td><?=number_format($zk->z_de)?></td><td><?=number_format($zk->z_kei)?></td><tr>
            <?php endforeach;?>
            </table>
    </div>
</div>
    <div class="h" style="display:none;position:absolute;padding:10px;top:500px;left:20%;width: 500px;background: #ddedfbeb;text-align:center;box-shadow:0 0 4px;border: 3px solid #000080;">
        <div style="display:flex;"><span style="width:80px;">Code</span><input class="form-control" style="margin-left:-11px;width:100px;padding:0;font-size:12px;" value="12022"><span style="width:80px;">在庫数</span><input class="form-control" style="width:100px;padding:0;font-size:12px;" value="0"></div>
        <div style="display:flex;"><span style="width:80px;">項目</span><input class="form-control" style="padding:0;font-size:12px;" value="Cクランプ"></div>
        <div style="display:flex;"><span style="width:80px;">型番</span><input class="form-control" style="padding:0;font-size:12px;" value="W200"></div><hr>
        <div style="display:flex;"><span style="width:80px;">発注先</span><input class="form-select" style="width:30%;" value="朝日"></div>
        <div style="display:flex;"><span style="width:80px;">発注日</span><input class="form-control" style="width:30%;" value="2020/06/01"></div>
        <div style="display:flex;"><span style="width:80px;">発注数</span><input class="form-control" style="width:30%;" value="5"></div>
        <div style="display:flex;"><span style="width:80px;">発注単価</span><input class="form-control" style="width:30%;" value="12,300"></div>
        <div style="display:flex;position:relative;"><span style="width:80px;">希望納期</span><input class="form-control" style="width:30%;" value="2020/06/01"></div>
        <input type="botton" class="btn btn-primary btn-sm" style="position:absolute;top:204px;right:34px;" value="発注">
    </div>
    <div style="display:none;position:absolute;padding:10px;top:500px;left:20%;width: 1200px;background: #ddedfbeb;text-align:center;box-shadow:0 0 4px;border: 3px solid #000080;">
        <div style="display:flex;">
                    <label style="width:80px;">発注日</label><input class="form-control cdp" style="width:150px;height:24px;"><input type="button" class="btn btn-primary btn-sm" style="height:24px;padding:0 8px;" value="適用">
                </div>
                <div style="display:flex">
                    <label style="width:80px;">納期日</label><input class="form-control cdp" style="width:150px;height:24px;"><input type="button" class="btn btn-primary btn-sm" style="height:24px;padding:0 8px;" value="適用"> 
                </div>
                <table style="width:100%;margin-bottom:50px;"><tr><th>Code</th><th>品目</th><th>型番</th><th>仕入先</th><th>数量</th><th>単価</th><th>計</th><th>発注日</th><th>希望納期</th></tr>
                <?php foreach($zai->result() as $z):?>
                    <tr><td class="rmv"><input class="form-control" style="text-align:right;width:50px;" value="<?=$z->z_code?>"></td>
                    <td><input class="form-control" style="width:200px;" value="<?=$z->material?>"></td>
                    <td><input class="form-control" style="width:200px;" value="<?=$z->a?>"></td>
                    <td><input class="form-select" value="<?=$z->z_store?>"></td>
                    <td><input class="form-control" style="text-align:right;width:80px;" value="<?=$z->z_quan?>"></td>
                    <td><input class="form-control" style="text-align:right;" value="<?=number_format($z->z_tanka)?>"></td>
                    <td><input class="form-control" style="text-align:right;" value="<?=number_format($z->z_total)?>"></td>
                    <td><input class="form-control" value="2020/06/01"></td>
                    <td><input class="form-control" value="2020/06/08"></td></tr>
                <?php endforeach;?>
                </table>
        </div>
        <input type="botton" class="btn btn-primary btn-sm if98" style="display:none;position:absolute;top:715px;right:39%;" value="発注" href="print?cat=zai">
    </div>
        <script>
            $(function(){
                $('#tsuika').click(function(){
                    let bname=$(this).attr('name').substr(2);
                    if(bname===""){
                        return;
                    }
                    var values=[];
                    $('input[name="nmb"]').each(function(i, elem){
                        values.push($(elem).val());
                    });
                    values=Number(values[values.length-1])+1;
                    //材料と仕入先取得
                    $.ajax({
                        type:'post',
                        url:'get_zairyo',//Get_data->get_zairyo()519
                        data:'zai',
                        success:function(val){
                            let v=JSON.parse(val);
                            var html = '<tr id="zr" class="del"><td><input id="zn" type="number" class="form-control" value='+values+' name="nmb"></td>'+
                                    '<td><input id="zc" class="form-control" style="" name="'+bname+'" onchange="adz(this.id,0,this.value,this.name)"></td>'+
                                    '<td><input id="zz" class="form-control" style="" name="'+bname+'" onchange="adz(this.id,0,this.value,this.name)"></td>'+
                                    '<td><select id="zy" class="form-control" value="" name="'+bname+'" onchange="adz(this.id,this.name,this.value)">'
                                for(i=0;i<Object.keys(v[1]).length;i++){
                                    html=html+'<option value="'+v[1][i]['zst']+'">'+v[1][i]['zst']+'</option>'
                                }
                                html=html+'</select></td>'+
                                    '<td><input id="zq" type="text" class="form-control" name="'+bname+'" onchange="adz(this.id,this.name,this.value)"></td>'+
                                    '<td><input id="zt" type="text" class="form-control" name="'+bname+'" onchange="adz(this.id,this.name,this.value)"></td>'+
                                    '<td><input id="zg" type="text" class="form-control" name="'+bname+'" onchange="adz(this.id,this.name,this.value)"></td>'+
                                    '<td><input id="zd" type="button" class="form-control btn btn-danger btn-sm btn-center" value="x" onclick="del(this)"></td>'+
                                '</tr>'
                            $('#zi').append(html);                        
                        }
                    })
                });
                $(document).on('click','.remove',function(){
                    $(this).parents('tr').remove();
                });
            });
        </script>
        
        <div style="display:none;margin-bottom:3px;">
            <input id="tsuika" type="button" class="btn btn-primary btn-sm" style="text-align:center;width:70px;margin-left:10px;padding:2px;" name=0 value="+" >
            <input id="hatyu_b" type="button" class="btn btn-primary btn-sm" style="text-align:center;width:70px;margin-left:10px;padding:2px;" value="部材管理">
        </div>


        <table style="width:100%;">
            <input type="hidden" id="mid" value="0">
        </table>
<div id="gai" class="h" style="font-size:0.9rem!important;overflow-y:scroll;height:150px;border:1px solid #f1f8ff;font-size:0.9em;display:block;width:99%;margin:auto;padding:2px;">
    <table id="gi" class="table-hover">
        <tr><th></th><th style="width:2%;"><input class="btn btn-primary btn-sm" style="height:20px;width:50px;" value="一括"></th><th style="width:2%;">#</th><th>工程</th><th>外注</th><th style="width:400px;">内容</th><th>発注日</th><th>納期</th><th style="width:5%;">数量</th><th style="width:5%;">単位</th><th>発注単価</th><th>発注金額</th><th style="width:5%;">区分</th><th></th><th></th></tr>
        <?php foreach($kt->result() as $k):?>
            <tr id="kr<?=$k->ktid?>"><td><input type="checkbox"></td>
            <td><a href="print?cat=h"><input class="btn btn-primary btn-sm" style="height:20px;width:50px;" value="発注" href="print?cat=h"></a>
            <td><input id="kn<?=$k->ktid?>" class="form-control tab kt_up" name="kt_num" style="text-align:right;" value="1"></td>
            <td><input id="kt<?=$k->ktid?>" class="form-control tab kt_up" name="koutei" style="height:28px;" list="op_koutei<?=$k->ktid?>" value="<?=$k->koutei?>">
                <datalist id="op_koutei<?=$k->ktid?>">
                    <?php foreach($ke->result() as $koutei){
                        echo "<option value='".$koutei->k_name."'></option>";
                    }?>
                </datalist>
        
            </td>
            <td><input id="kg<?=$k->ktid?>" class="form-control tab kt_up d_list" name="kt_gai" style="height:28px;" list="op_ktgai<?=$k->ktid?>" value="<?=$k->kt_gai?>">
                <datalist id="op_ktgai<?=$k->ktid?>">
                    <?php foreach($gai_all->result() as $kt_gaityu){
                            echo '<option value="'.$kt_gaityu->g_name.'"></option>';
                        }?>                
                </datalist>
            </td>
            <td><input id="ks<?=$k->ktid?>" class="form-control kt_up" name="kt_sub" value="<?=$k->kt_sub?>"></td>
            <td><input id="kj<?=$k->ktid?>" class="form-control kt_up" name="kt_hatyu" value="<?=$k->kt_hatyu?>" onchange="genDate(this.value,this.id)"></td>
            <td><input id="kl<?=$k->ktid?>" class="form-control kt_up" name="kt_nouki" value="<?=$k->kt_nouki?>" onchange="genDate(this.value,this.id)"></td>
            <td><input id="kq<?=$k->ktid?>" class="form-control cul" name="kt_quan" style="text-align:right;" value="<?=$k->kt_quan?>"></td>
            <td><input id="ki<?=$k->ktid?>" list="k_tani_list<?=$val['m_id']?>" type="text" class="form-control al-r kt_up" name="kt_tani" value="<?=$k->kt_tani?>" autocomplete="off">
                <datalist id="k_tani_list<?=$val['m_id']?>">
                    <?php foreach($tanis->result() as $tani):?>
                        <option value="<?=$tani->tani?>"></option>
                    <?php endforeach;?>
                </datalist>
            </td>
            <td><input id="ka<?=$k->ktid?>" class="form-control cul" name="kt_tanka" style="text-align:right;" value="<?=number_format($k->kt_tanka)?>"></td>
            <td><input id="ko<?=$k->ktid?>" class="form-control cul" name="kt_total" style="text-align:right;" value="<?=number_format($k->kt_total)?>"></td>
            <td><input id="kk<?=$k->ktid?>" class="form-control" style="padding:1px;" value="工事"></td>
            <td><button id="kd<?=$k->ktid?>" class="btn btn-danger btn-sm btn-center kj_del" type="button" style="height:23px;padding:0;" value="x"><span class="material-symbols-outlined">delete_sweep</span></button></td></tr>
        </tr>
        <?php endforeach;?>
    </table>
</div>
<style>
    .kjpanel input,.kjpanel textarea{
        padding:2px 5px;
    }
</style>

<div class="kjpanel" style="display:none;position:absolute;padding:10px;top:400px;left:34%;width: 600px;background: #ddedfbeb;text-align:center;box-shadow:0 0 4px;border: 3px solid #000080;">
    <div style="display:flex;">
        <label style="width:80px;">外注先</label><input class="form-control" style="width:250px;height:24px;" value="諏訪設備"><label style="width:80px;">カテゴリ</label><input class="form-control" style="width:150px;height:24px;" value="大工工事">
    </div> 
    <div style="display:flex;">
        <label style="width:80px;">内容</label><input class="form-control" style="width:480px;height:24px;" value="イベントブースの製作">
    </div>
    <div style="display:flex;">
        <label style="width:80px;">詳細</label><textarea class="form-control txt" style="width:480px;height:300px;"><?=$kt->row('kt_sub')?></textarea>
    </div>
    <div style="display:flex;">
        <label style="width:80px;">備考</label><textarea class="form-control txt" style="width:480px;height:100px;">お支払いは従来通り</textarea>
    </div>
    <div style="display:flex;">
        <label style="width:80px;">工期</label><input class="form-control" style="width:480px;height:24px;" value="6月上旬～6月20日目安">
    </div>
    <div style="display:flex;">
        <label style="width:80px;">発注日</label><input class="form-control cdp" style="width:150px;height:24px;">
    </div>
    <div style="display:flex">
        <label style="width:80px;">納期日</label><input class="form-control cdp" style="width:150px;height:24px;">
    </div>
    <input type="button" class="btn btn-primary btn-sm kt_update" style="position:absolute;top:500px;right:26px;" value="保存">
</div>

        <script>
            $(function(){
                $('#tsuikag').click(function(){
                    let bname=$(this).attr('name').substr(2);
                    
                    if (bname===""){
                        return;
                    }
                    var values=[];
                    $('input[name="nmg"]').each(function(i, elem){
                        values.push($(elem).val());
                    });
                    values=Number(values[values.length-1])+1;
                    $.ajax({
                        type:'post',
                        url:'get_koutei',
                        data:'get',
                        success:function(val){
                            let v=JSON.parse(val);
                  
                    var html = '<tr id="kr" class="del"><td><input id="kn" class="form-control" type="num" value='+values+' name="nmg"></td>'+
                                '<td><select id="ks" class="form-control" name="'+values+'" type="text" onchange="adkt(this.id,0,this.name,this.value)">'
                            for(i=0;i<Object.keys(v[1]).length;i++){
                                html=html+'<option value="'+v[1][i]['k_name']+'">'+v[1][i]['k_name']+'</option>'
                            }
                            html=html+'</select></td>'+
                                '<td><select id="kk" class="form-control" name="'+values+'" type="text" onchange="adkt(this.id,0,this.name,this.value)">'
                            for(i=0;i<Object.keys(v[0]).length;i++){
                                html=html+'<option value="'+v[0][i]['g_name']+'">'+v[0][i]['g_name']+'</option>'
                            }
                            html=html+'</select></td>'+
                                '<td><input id="kh" class="form-control" name="'+values+'" type="text" onchange="genDate(this.value,this.id);adkt(this.id,0,this.name,this.value)"></td>'+
                                '<td><input id="kl" class="form-control" name="'+values+'" type="text" onchange="genDate(this.value,this.id);adkt(this.id,0,this.name,this.value)"></td>'+
                                '<td><input id="kq" class="form-control" name="'+values+'" type="text" onchange="adkt(this.id,0,this.name,this.value)"></td>'+
                                '<td><input id="kt" class="form-control" name="'+values+'" type="text" onchange="adkt(this.id,0,this.name,this.value)"></td>'+
                                '<td><input id="kg" class="form-control" name="'+values+'" type="text" onchange="adkt(this.id,0,this.name,this.value)"></td>'+
                                '<td><input id="ke" class="form-control btn btn-danger btn-sm btn-center" name="0" type="button" value="x" onclick="del(this)"></td></tr>';
                    $('#gi').append(html);
                    }
                    })
                });
                $(document).on('click','.remove',function(){
                    $(this).parents('tr').remove();
                });
            });
        </script>
                <div style="display:none;margin-bottom:10px;">
                    <input id="tsuikag" type="button" class="btn btn-parimary btn btn-sm" style="text-align:center;width:70px;margin-left:10px;padding:2px;" name=0 value="+">
                    <input type="button" id="hatyu_kt" class="btn btn-primary btn-sm" style="text-align:center;width:70px;margin-left:10px;padding:2px;" value="工事管理">
                </div>
           
    </div>
    </div>
    </form> 


</div><!--mainWrap-->
</div><!--inner-->
<script>
   $(document).ready(function(){
      $(".if98").colorbox({iframe:true, width:"1000px", height:"900px"});
   });
</script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
  <script type="text/javascript" src="../js/function.js"></script>
  <script type="text/javascript" src="../js/jutyu_hist.js"></script>
  <script type="text/javascript" src="../js/print.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/protonet-jquery.inview/1.1.2/jquery.inview.min.js"></script>
  <script src="../js/ken.js"></script>
  <!--日本語化datepicker-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
  <!--datepickerここまで-->


</body>
</html>