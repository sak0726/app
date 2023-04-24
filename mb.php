<!DOCTYPE html>
<?php

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
    <title>受注登録</title>
</head>
<body>

<div id="wrap">
<div id="sideWrap">
    <div style="position:relative;">    
        <h3 style="text-align:left;margin-bottom:10px;"></h3>
        <div class='sideMenu'>
            <a href="menu"><button type="button" class="btn btn-xs">TOP</button></a>
            <a href="mb"><button type="button" class="btn btn-xs">MOBILE</button></a>
            <a href="m_mitsu"><button type="button" class="btn btn-xs">見積作成</button></a>
            <a href="history"><button type="button" class="btn btn-xs">履歴</button></a>
            <a href="customer"><button type="button" class="btn btn-xs">顧客</button></a>
            <a class="if85" href="gai"><button type="button" class="btn btn-xs cos-sm-2">外注</button></a>
            <a><button type="button" id="opm" class="btn btn-xs">設定</button></a>
                <div id="subMenu">
                    <ul>
                        <li><a href="thick">板厚</a></li>
                        <li><a href="frice_p">加工賃</a></li>
                        <li><a href="material">材料設定</a></li>
                        <li><a href="customer">顧客</a></li>
                        <li><a href="jisya">自社</a></li>
                    </ul>
                </div>
                <p></p>
            <button class="btn btn-xs" onClick="history.back()" style="width:100%;">戻る</button>
            <button class="btn btn-xs cos-sm-2" id="out" style="width:100%;">ログアウト</button>

        </div>
    </div>
</div>
<div id="mainWrap">
    <div class="row" style="margin-left:10px;">
        <button id="new_od" class="col-sm-1 btn btn-xs" style="margin:5px 0;padding:2px;">メニュー</button>
        <button id="print" class="col-sm-1 col-sm-offset-10 btn btn-xs" style="margin:5px 0;padding:2px;">印刷</button>
    </div>
<div id="calarea" style="margin:5px auto;">
<form name="mainform" method="post" action="oder">
      



        <div class="row" style="margin:5px auto;background:#2ad63829;">
            <table class="t_cal" style="border:none;"> 
                <div class="row" style="margin-left:3px;">
                    <div class="col-sm-1">登録日<input type="date" id="jutyubi" value="2019-02-03"></div>
                    <div class="col-sm-1"style="padding-left:50px;">管理番号<input type="text" id="od_number"style="text-align:left;" placeholder="自動入力"></div>
                </div>
                    <div class="row" style="margin-left:3px;">
                    <div class="col-sm-1" style="padding-right:0;">見　積<input type="checkbox"></div><div class="col-sm-1">確　定<input type="checkbox"></div>
                    <div class="col-sm-1" style="padding-left:47px;">注文番号<input type="text" id="tyuNum"style="text-align:left;" placeholder="客先注文番号" value="SH0012934"></div>

                </div>

                </div>
                <div class="row" style="margin-left:3px;">
                    <div class="col-sm-2">客　先
                        <select id="selcust" class="sel" onChange="od_inst()" style="width:190px;font-size:1em;height:20px;margin-top:3px;">
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
                    </div>
                </div>
                <div class="row" style="margin-left:3px;">
                    <div class="col-sm-2">担　当<input id="tantou" value="相模" placeholder="顧客担当"style="text-align:left;"></div>

                </div>
                <div class="row" style="margin-left:3px;">
                    <div class="col-sm-2">納　期<input type="text" id="odNum" placeholder="予定納期" value="受注後2～3週間程度" style="text-align:left;"></div>
                    <div class="col-sm-2">件名<input type="text" id="kenmei" style="text-align:left;" value="部品製作"></div>
                </div>
                <div class="row" style="margin-left:3px;">
                    <div class="col-sm-2">見積日<input type="date" value="2019-02-03"></div>
                </div>
                <div class="row" style="margin-left:3px;">
                    <div class="col-sm-2">受注日<input type="date"></div>
                    <div class="col-sm-2">納期日<input type="date"></div>
                </div>
                <div class="row" style="margin-left:3px;">
                <div class="col-sm-2" style="margin-bottom:5px;">備　考<input style="width:300px;"></div>
                </div>
            </table>
        </div>
        
            <hr style="border:none;height:12px;margin:0;box-shadow:0 12px 12px -12px #000 inset;">
        
            <table id="t_main" class="mhead" style="border:none;background:#2ad63829;">

            <tr><th style="width:3%;">#</th><th style="margin-left:5px;width:18%;">図番</th><th style="margin-left:5px;width:20%;">品名</th><th style="margin-left:5px;width:5%;">数量</th><th style="margin-left:5px;width:10%;">単価</th><th style="margin-left:5px;width:15%;">金額</th><th style="width:5%;"></th></tr>
            <?php
                for ($i=1;$i<8;$i++){
                    echo "<tr><td><input type='number' id='n".$i."' value='".$i."' name='num'>
                    <td><input value='ABCDE00".$i."' id='zuban' type='text' style='text-align:left;' name='t1' onchange='zinst()' onkeydown='return nt(1)'></td>
                    <td><input value='ベースプレート ".$i."' id='hinmei' type='text' style='text-align:left;' name='t1' onkeydown='return nt(2)'></td>
                    <td><input  value='1' type='number' name='t1' onkeydown='return nt(3)'></td>
                    <td><input value='3,000' type='text' name='t1' onkeydown='return nt(4)'></td>
                    <td><input value='3,000' type='text' name='t1' onkeydown='return nt(0)'></td>
                    <td><input type='button' class='btn-xs' style='text-align:center' value='詳細'></td>
                    </tr>";
                }
            ?>
        </table>
        <input type="button" class="btn-xs" id="tsuik" value="追加">

<script type="text/javascript">
            function nt(idx){
                if(window.event.keyCode==13){
                    document.mainform.t1[idx].focus();
                    return false;
                    
                }
            }
        </script>
        
        <script>
            $(function(){
                $('#tsuik').click(function(){
                    var values=[];
                    $('input[name="num"]').each(function(i, elem){
                    　　values.push($(elem).val());
                    });
                    values=Number(values[values.length-1])+1;
                    var html = '<tr><td><input type="number" id="n'+values +'" value='+values+' name="num"><td><input type="text" style="text-align:left; name="zuban""></td><td><input type="text" style="text-align:left;"></td><td><input type="number"></td><td><input type="number"></td><td><input type="number"></td><td><input class="btn-xs" style="text-align:center;" type="button" value="詳細"></td></tr>';
                    $('#t_main').append(html);
                });
                $(document).on('click','.remove',function(){
                    $(this).parents('tr').remove();
                });
            });
        </script>

</form>

<form method="post" id="zai">
    <table class="underMenu" style="width:100%;">
                    <tr>
                        <th style="padding:0 0 0 2px;"><button type="button" id="mdel" class="btn btn-xs btn-del">全削除</th>

                        <th><button type="button" id="delete" class="btn btn-xs">個別削除</th>
                    </tr>
    </table>
</form> 


</div><!--mainWrap-->
</div><!--inner-->


  <script type="text/javascript" src="../js/menu.js"></script>
  <script type="text/javascript" src="../js/mitsumori.js"></script>
  <script type="text/javascript" src="../js/print.js"></script>
</body>
</html>