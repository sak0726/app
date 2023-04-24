<!DOCTYPE html>
<?php
    $this->load->library('session');
        $cookie=$_SESSION['user_id'];
        if(empty($cookie)){
        header('Location:/trust'); 
        }
        $data=$this->session->all_userdata();

?>

<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/jutyu.css">
    <link rel="stylesheet" href="../cbox/colorbox.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <title>受注登録</title>

</head>
<body>

<div class="wrap">
    <div id="inner">
        <div id="sideWrap">
            <div style="position:relative;">    
                <p style="margin-bottom:0px;">受注登録</p>
                <div class='sideMenu'>
                    <a href="menu"><button type="button" class="btn btn-sm">TOP</button></a>
                    <a href="gai_kanri?pages=1"><button type="button" class="btn btn-sm">仕入発注</button></a>
                    <a href="zai_kanri?pages=1"><button type="button" class="btn btn-sm">材料発注</button></a>
                    <a class="if98" href="gait"><button type="button" class="btn btn-sm cos-sm-2">各種設定</button></a>
                    <button class="btn btn-sm" onClick="history.back()" style="width:100%;">戻る</button>
                    <button class="btn btn-sm cos-sm-2" id="out" style="width:100%;">ログアウト</button>
                </div>
            </div>
        </div>
        <div id="mainWrap">
            <div class="row" style="margin-left:10px;">
                <input type="button" id="new_rq" class="col-sm-1 btn btn-primary btn-sm" style="margin:5px 0;padding:2px;" value="更新" disabled>
                <input type="button" id="new_od" class="col-sm-1 btn btn-primary btn-sm" style="margin:5px 0;padding:2px;" value="新規" disabled>
                <input type="button" id="print_m" class="col-sm-1 col-sm-offset-10 btn btn-primary btn-sm" style="margin:5px 0;padding:2px;" value="見積書" disabled>
                <input type="button" id="print_n" class="col-sm-1 col-sm-offset-10 btn btn-primary btn-sm" style="margin:5px 0;padding:2px;" value="納品書" disabled>
                <input type="button" id="print_n" class="col-sm-1 col-sm-offset-10 btn btn-primary btn-sm" style="margin:5px 0;padding:2px;" value="管理票" disabled>
                <input type="button" id="print_n" class="col-sm-1 col-sm-offset-10 btn btn-primary btn-sm" style="margin:5px 0;padding:2px;" value="現品票" disabled>
                <input type="button" id="f_delete" class="col-sm-1 col-sm-offset-10 btn btn-danger btn-sm" style="margin:5px 0;padding:2px;" value="削除">
                <input type="button" id="f_close" class="col-sm-1 col-sm-offset-10 btn btn-primary btn-sm" name="0" style="margin:5px 0;padding:2px;" value="閉じる">
            </div>
        <div id="calarea" class="jutyu" style="margin:5px auto;">
        <form name="mainform" method="post" action="oder" style="height:500px;">
            <div class="row input-groupe" style="margin:5px auto;"><input id="main_key" type="hidden" value="0">
            <input type="hidden" id="k_id" value="">
            <div class="row">
                <div class="col-sm-7">
                    <table class="t_cal" style="background:#fff;box-shadow:0 0 2px #000;padding-right:5px;">
                        <tr>
                            <td style="width:50px;"><label for="jutyubi">登録日</label></td><td><input class="form-control" type="text" id="t_day" value=<?=date('Y/m/d')?> onChange="genDate(this.value,this.id);od_upd(this.id,this.value)"></td>
                            <td style="width:50px;"><label for="selcust">客先</label></td>
                            <td colspan="7" style="width:300px;">
                                <select id="selcust" class="form-select" onChange="od_inst(this.text,<?=$maxId['max_Mid']+1?>)">
                                    <option value="-">顧客選択</option>
                                        <?php
                                            foreach($list->result() as $res) {
                                                print('<option value="' . $res->c_id . '">' . $res->c_name . '</option>');
                                            }                            
                                        ?>
                                </select>

                            </td>
                            <td style="width:50px;"><label for="mitsuNum">見積#</label></td><td><input class="form-control" type="text" id="mitsuNum" placeholder="" onChange="od_upd(this.id,this.value)"></td>
                        
                        </tr>
                        <tr>
                            <td><label for="k_bunrui">分類</label></td><td><input class="form-select up_head" id="k_bunrui" value="通常" autocomplete="off"></td>
                            <td><label for="k_kubun">区分</label></td><td><input class="form-select up_head" id="k_kubun" value="大工工事" autocomplete="off"></td>
                            <td><label for="k_uke">請け</label></td><td><input class="form-select up_head" id="k_uke" value="元請" autocomplete="off"></td>
                            <td><label for="k_nyusatsu">入札</label></td><td><input class="form-select up_head" id="k_nyusatsu" value="-" autocomplete="off"></td>
                            <td><label for="k_tantou">ご担当</label></td><td><input class="form-select up_head" id="k_tantou" value="" autocomplete="off"></td>
                            <td><label for="kanriNum">注文#</label></td><td><input class="form-control up_head" type="text" id="k_odNum" placeholder="" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td><label for="k_genba">現場名</label><td colspan="9"><input id="k_genba" class="form-control up_head" value="" autocomplete="off"></td>
                            <td><label for="k_tiki">地域名</label><td><input id="k_tiki" class="form-control up_head" value="-" autocomplete="off"></td>
                        <tr>
                            <td><label for="kenmei">工事名</label></td><td colspan="7"><input class="form-control" style="text-align:left;" type="text" id="kenmei" placeholder="工事名" onChange="od_upd(this.id,this.value)" autocomplete="off"></td>
                            <td><label for="tantou">担当</label></td><td><input class="form-control" id="tantou" placeholder="担当" value="坂本" onChange="od_upd(this.id,this.value)" autocomplete="off"></td>
                            <td><label for="k_Kid">番号</label></td><td><input id="k_Kid" class="form-control" type="text" value="" placeholder="" autocomplete="off"></td>
                        </tr>
                    </table>
                </div>

                <div class="denpyo col-sm-5">
                    <table class="t_cal" style="font-size:10px;background:#fff;box-shadow:0 0 2px #000;">
                        <tr>
                            <td style="width:50px;"><input type="button" class="btn btn-primary btn-sm" value="見積書"></td>
                            <td style="width:35px;">見積</td><td><input type="checkbox" value="m_day" class="day"></td>
                            <td><label>見積日</label></td><td><input id="m_day" name="dp" class="form-control up_head"></td>
                            <td><label>失注</label></td><td style="text-align:left;"><input type="checkbox"></td>
                            <td></td><td></td>
                        </tr>
                        <tr>
                            <td style="width:50px;"><input type="button" class="btn btn-primary btn-sm" value="納品書"></td>
                            <td>確定</td><td><input class="day" value="jutyu_D" type="checkbox"></td>
                            <td><label>受注日</label></td><td><input id="jutyu_D" name="dp" class="form-control up_head"></td>
                            <td><label>納期日</label></td><td><input id="nouki" name="dp" class="form-control up_head" onchange="genDate(this.value,this.id)"></td>
                            <td><label>納品</label></td><td><input class="day" value="nouhin_D" type="checkbox"></td>
                            <td><input id="nouhin_D" name="dp" class="form-control up_head"></td>
                        </tr>
                        <tr>
                            <td style="width:50px;"><input type="button" class="btn btn-primary btn-sm" value="請求書"></td>
                            <td>請求</td><td><input class="day" value="sk_day" type="checkbox"></td>
                            <td><label>請求日</label></td><td><input id="sk_day" name="dp" class="form-control up_head"></td>
                        </tr>
                    </table>
                </div>
            </div>
                    
               
                <div id="meisai" style="height:400px;overflow-y:scroll;border:1px solid #dee2e6;font-size:0.9em;">
                    <table id="t_main" class="mhead  table-hover">
                        <tr id="tr"><th style="width:3%;">#</th><th style="width:20%;">項目</th><th style="width:20%;">詳細</th><th style="width:5%;">数量</th><th style="width:5%;">単位</th><th style="width:10%;">単価</th><th style="width:15%;">金額</th><th style="width:3%;"></th></tr>
                            <tr id="tr<?php echo $maxId['max_Mid']+1;?>" name="1" onclick="kt(this.id)">
                                <td><input id="n<?php echo $maxId['max_Mid']+1;?>" type="number" class="form-control" value=1 name="num"></td>
                                <td><input id="z<?php echo $maxId['max_Mid']+1;?>" type="text" class="form-control" style="text-align:left;" name="1" onchange="zinst(this.name,this.id,this.value)" autocomplete="off"></td>
                                <td><input id="h<?php echo $maxId['max_Mid']+1;?>" type="text" class="form-control" style="text-align:left;" name="1" onchange="zinst(this.name,this.id,this.value)" autocomplete="off"></td>
                                <td><input id="q<?php echo $maxId['max_Mid']+1;?>" type="text" class="form-control" name="1" onchange="zinst(this.name,this.id,this.value)" autocomplete="off"></td>
                                <td>
                                    <input id="i<?php echo $maxId['max_Mid']+1;?>" type="text" list="tani_list<?= $maxId['max_Mid']+1;?>" class="form-control" name="1" onchange="zinst(this.name,this.id,this.value)" autocomplete="off">
                                    <datalist id="tani_list<?= $maxId['max_Mid']+1;?>">
                                        <?php foreach($tanis -> result() as $tani):?>
                                        <option value="<?=$tani->tani?>"></option>
                                        <?php endforeach;?>
                                    </datalist>
                                </td>
                                <td><input id="t<?php echo $maxId['max_Mid']+1;?>" type="text" class="form-control" name="1" onchange="zinst(this.name,this.id,this.value)" autocomplete="off"></td>
                                <td><input id="g<?php echo $maxId['max_Mid']+1;?>" type="text" class="form-control" name="1" onchange="zinst(this.name,this.id,this.value)" autocomplete="off"></td>
                                <td><input id="d<?php echo $maxId['max_Mid']+1;?>" type="text" class="form-control btn btn-danger btn-sm" style="padding:0;text-align:center;" value="x" onclick="kb_delete(this.id)"></td>
                            </tr>
                    </table>

                </div>
                <script>
                    $(function(){
                        $('#tsuik').click(function(){
                                $.ajax({
                                    type:"post",
                                    url:"get_MaxId",
                                    data:"kanri",
                                    success:function(val){
                                        vl=JSON.parse(val);
                                        var values=[];
                                        let kyaku=$("#selcust option:selected").val();
                                        $('input[name="num"]').each(function(i, elem){
                                            values.push($(elem).val());
                                        });
                                        values=Number(values[values.length-1])+1;
                                        var html = '<tr id="tr'+vl['m_id']+'" name="'+vl['num']+'"><td><input type="number" id="n'+vl['m_id']+'" class="form-control" value='+vl['num']+' name="num">';
                                                    html=html+'<td><input id="z'+vl['m_id']+'" type="text" class="form-control" style="text-align:left;" name="'+values+'" onchange="zinst(this.name,this.id,this.value)"></td>'+
                                                    '<td><input id="h'+vl['m_id']+'" type="text" class="form-control" style="text-align:left;" onchange="zinst(this.name,this.id,this.value)"></td>'+
                                                    '<td><input id="q'+vl['m_id']+'" type="text" class="form-control" onchange="zinst(this.name,this.id,this.value)"></td>'+
                                                    '<td>'
                                                        '<input id="i'+vl['m_id']+'" list="datalist'+vl['m_id']+'" type="text" class="form-control" onchange="zinst(this.name,this.id,this.value)">'
                                                            '<datalist id="tani_list'+vl['m_id']+'">'
                                                                '<option></option>'
                                                        '</td>'+

                                                    '<td><input id="t'+vl['m_id']+'" type="text" class="form-control" onchange="zinst(this.name,this.id,this.value)"></td>'+
                                                    '<td><input id="g'+vl['m_id']+'" type="text" class="form-control" onchange="zinst(this.name,this.id,this.value)"></td>'+
                                                    '<td><input id="b'+vl['m_id']+'" type="text" class="form-control btn btn-danger btn-sm" style="padding:0;text-align:center;" value="x" onclick="kb_delete(this)"></td></tr>';
                                        $('#t_main').append(html);
                                    }
                                });

                                    $(document).on('click','.remove',function(){
                                        $(this).parents('tr').remove();
                                    });
                                    
                        })

                    });
                </script>
        </form>
        <div class="row">
        <div class="col">
            <input type="hidden" id="tsuik" value="追加" style="text-align:center;margin:10px 0;" class="btn btn-primary btn-sm">
        </div>
        <div class="col">
            <input id="kei_mai" type="text" class="form-control">
        </div>
        <div class="col">
            <input id="kei_tanka" type="text" class="form-control">
        </div>
        </div>


        <tr><td colspan="8"><hr style="margin:5px 0 0;border:0;height:1px;box-shadow:0 12px 12px -12px #000 inset;"></td></tr>

        <div id="zai" style="display:none;height:300px;overflow-y:scroll;border:1px solid #dee2e6;font-size:0.9em;">
                <table id="zi">
                    <tr><th style="width:5%;">#</th><th style="width:10%;">材料</th><th style="width:10%;">仕入先</th><th style="width:10%;">数量</th><th>単位</th><th style="width:15%;">単価</th><th style="width:15%;">合計</th></tr>
                    <tr>
                        <td><input id="" type="number" class="form-control" value=1 name="nmb"></td>
                        <td>
                                <select id="zz" class="form-control" onchange="mat_set()">
                                    <option value="0">-</option>
                                    <?php
                                        foreach($mat->result() as $res) {
                                        print('<option value="' . $res->z_ID . '">' .$res->z_mat.'</option>');
                                        }
                                    ?>
                                </select>
                        </td>
                        <td><input id="" type="number" class="form-control" value="" name="num">
                        <td><input id="" type="number" class="form-control" value="" name="num">
                        <td><input id="" type="text" class="form-control" style="text-align:left;" name="" onchange="zinst(this.name,this.id,this.value)" value=""></td>
                        <td><input id="" type="text" class="form-control" style="text-align:left;" name="" onchange="zinst(this.name,this.id,this.value)" value=""></td>
                        <td><input id="" type="text" class="form-control" name="" onchange="zinst(this.name,this.id,this.value)" value=""></td>
                        <td><input id="" type="text" class="form-control" name="" onchange="zinst(this.name,this.id,this.value)" value=""></td>
                        <td><input id="" type="text" class="form-control" name="" onchange="zinst(this.name,this.id,this.value)" value=""></td>
                        <td><input id="" type="button" class="form-control btn-danger btn-sm btn-center" name="" onchange="zinst(this.name,this.id,this.value)" value="x"></td>


                    </tr>
        </table>
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
                                            '<td><select id="zz" class="form-control" name="'+bname+'" onchange="adz(this.id,0,this.value,this.name)">'
                                        for(i=0;i<Object.keys(v[0]).length;i++){
                                            html=html+'<option value="'+v[0][i]['mat']+'">'+v[0][i]['mat']+'</option>'
                                        }
                                        html=html+'</select></td>'+
                                            '<td><select id="zy" class="form-control" value="" name="'+bname+'" onchange="adz(this.id,this.name,this.value)">'
                                        for(i=0;i<Object.keys(v[1]).length;i++){
                                            html=html+'<option value="'+v[1][i]['zst']+'">'+v[1][i]['zst']+'</option>'
                                        }
                                        html=html+'</select></td>'+
                                            '<td><input id="za" type="text" class="form-control" style="text-align:left;" name="'+bname+'" onchange="adz(this.id,this.name,this.value)"></td>'+
                                            '<td><input id="zb" type="text" class="form-control" style="text-align:left;" name="'+bname+'" onchange="adz(this.id,this.name,this.value)"></td>'+
                                            '<td><input id="zc" type="text" class="form-control" style="text-align:left;" name="'+bname+'" onchange="adz(this.id,this.name,this.value)"></td>'+
                                            '<td><input id="zq" type="text" class="form-control" name="'+bname+'" onchange="adz(this.id,this.name,this.value)"></td>'+
                                            '<td><input id="zt" type="text" class="form-control" name="'+bname+'" onchange="adz(this.id,this.name,this.value)"></td>'+
                                            '<td><input id="zg" type="text" class="form-control" name="'+bname+'" onchange="adz(this.id,this.name,this.value)"></td>'+
                                            '<td><input id="zd" type="button" class="form-control btn btn-danger btn-sm" value="x" onclick="del(this)"></td>'+
                                        '</tr>'
                                    $('#zi').append(html);                        }
                            })
                        });
                        $(document).on('click','.remove',function(){
                            $(this).parents('tr').remove();
                        });
                    });
                </script>
                
                <tr><td><input type="button" id="tsuika" value="+" style="text-align:center;width:70px;display:none;" class="col-sm-1 btn btn-primary btn-sm btn-center form-control" name="0"></td></tr>


                <table style="width:100%;">
                    <input type="hidden" id="mid" value="0">
                </table>
                <hr style="margin:5px 0 0;border:0;height:1px;box-shadow:0 12px 12px -12px #000 inset;">
        <div id="gai" class="" style="display:none;height:200px;overflow-y:scroll;border:1px solid #dee2e6;font-size:0.9em;">
                <table id="gi" class="table-hover">
                    <tr><th style="width:5%;">#</th><th style="width:10%;">工程</th><th style="width:10%";>外注</th><th style="width:15%;">発注日</th><th style="width:15%;">納期</th><th style="width:10%;">数量</th><th style="width:15%;">発注単価</th><th style="width:15%;">発注金額</th></tr>
                    <tr><td><input class="form-control" type="num" value=1 name="nmg"></td>
                    <td><input class="form-control" type="text" style="text-align:left;" value="-"></td>
                    <td><input class="form-control" type="text" style="text-align:left;" value="-"></td>
                    <td><input class="form-control" type="text"></td>
                    <td><input class="form-control" type="text"></td><td><input class="form-control" type="num"></td>
                    <td><input class="form-control" type="num"></td>
                    <td><input class="form-control" type="num"></td>
                    <td><input class="form-control btn-danger btn-sm btn-center" type="num" value="x"></td></tr>
                </table>
        </div>
        <script>
            $(function(){
                $('#tsuikag').click(function(){
                    var values=[];
                    $('input[name="nmg"]').each(function(i, elem){
                        values.push($(elem).val());
                    });
                    values=Number(values[values.length-1])+1;
                    var html = '<tr><td><input class="form-control" type="num" value='+values+' name="nmg"></td>'+
                    '<td><input class="form-control" type="text"></td>'+
                    '<td><input class="form-control" type="text"></td>'+
                    '<td><input class="form-control" type="date"></td>'+
                    '<td><input class="form-control" type="date"></td>'+
                    '<td><input class="form-control" type="text"></td>'+
                    '<td><input class="form-control" type="text"></td>'+
                    '<td><input class="form-control" type="text"></td></tr>';
                    $('#gi').append(html);
                });
                $(document).on('click','.remove',function(){
                    $(this).parents('tr').remove();
                });
            });
        </script>
                <tr><td><input type="button" id="tsuikag" value="+" style="display:none;text-align:center;width:70px;display:none;" class="col-sm-1 btn-parimary btn btn-sm btn-center form-control"></td></tr>
           


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
                                echo $page." ";
                            }else{
                            echo "<a href='mitsumori?id=".$id."&page=".$i."'>".$i."</a> ";
                            }
                        }
                    }
                }
                ?>
                </td>
            </tr>
    </div>
 


</div><!--wrap-->
<script type="text/javascript" src="../js/jquery.js"></script>
<script>
   $(document).ready(function(){
      $(".if98").colorbox({iframe:true, width:"1000px", height:"900px"});
   });
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
  <script type="text/javascript" src="../js/function.js"></script>
  <script type="text/javascript" src="../js/jutyu.js"></script>
  <script type="text/javascript" src="../js/print.js"></script>
  <!--日本語化datepicker-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
  <!--datepickerここまで-->
</body>
</html>