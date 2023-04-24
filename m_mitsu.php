<!DOCTYPE html>
<?php

?>

<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/jquery.js"></script>
<!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>受注登録</title>
</head>
<body>

<div id="wrap">
<div id="inner">

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
        <button id="new_od" class="col-sm-1 btn btn-xs" style="margin:5px 0;padding:2px;">新規</button>
        <button id="print" class="col-sm-1 col-sm-offset-10 btn btn-xs" style="margin:5px 0;padding:2px;">印刷</button>
    </div>
<div id="calarea" style="margin:5px auto;">
<form name="mainform" method="post" action="oder">
      



        <div class="row" style="margin:5px auto;background:#2ad63829;">
            <table class="t_cal" style="border:none;"> 
                <tbody>
                <tr>
                    <td>登録日</td><td><input type="date" id="jutyubi" value="2019-02-03"></td>
                    <td>客先</td><td colspan="3">
                        <select id="selcust" class="sel" onChange="od_inst()">
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
                    <td>担当</td><td><input id="tantou" value="相模" placeholder="顧客担当"style="text-align:left;"></td>
                    <td>予定納期</td><td colspan="3"><input type="text" id="odNum" placeholder="予定納期" value="受注後2～3週間程度" style="text-align:left;"></td>
                </tr>
                <tr>
                    <td>件名</td><td colspan="5"><input type="text" id="kenmei" style="text-align:left;" value="部品製作"></td>
                    <td>注文番号</td><td><input type="text" id="tyuNum"style="text-align:left;" placeholder="客先注文番号" value="SH0012934"></td>
                    <td>管理番号</td><td><input type="text" id="od_number"style="text-align:left;" placeholder="自動入力"></td>
                </tr>

                <tr style="margin-bottom:20px;">
                    <td>見積日</td><td style="width:50px;"><input type="date" value="2019-02-03"></td>
                    <td>見積</td><td><input type="checkbox"></td><td>確定</td><td><input type="checkbox"></td>
                    <td rowspan="2">備考</td><td rowspan="2" colspan="3"><textarea style="width:100%;"></textarea></td>
                </tr>
                <tr style="margin-bottom:5px;">
                    <td>受注日</td><td style="width:50px;"><input type="date"></td>
                    <td>納期日</td><td style="width:50px;"><input type="date"></td>
                    <td>納品日</td><td style="width:50px;"><input type="date"></td>
                </tr>
            </tbody>
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