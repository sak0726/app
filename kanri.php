<!DOCTYPE html>
<?php
$this->load->database('t');

?>

<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" integrity="sha384-vhJnz1OVIdLktyixHY4Uk3OHEwdQqPppqYR8+5mjsauETgLOcEynD9oPHhhz18Nw" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap-theme.min.css" integrity="sha384-jzngWsPS6op3fgRCDTESqrEJwRKck+CILhJVO5VvaAZCq8JYf8HsR/HPpBOOPZfR" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/kanri.css">

    <title>受注登録</title>
</head>
<body>
    <style>
        .h{
            display:none;
        }

    </style>
<div class="wrap">
    
    <div class="form-inline container">
        <div class="form-group">
            <label for="selcust">客先</label>
            <select class="form-control" id="selcust">
            <option value="-">-</option>
                <?php
                    foreach($res->result() as $val){
                        if(!isset($_GET['customer'])){
                            echo '<option value="'.$val->c_name.'">'.$val->c_sy.'</option>';   
                        }else{
                            if($_GET['customer']===$val->c_sy){
                                echo '<option value="'.$val->c_name.'" selected>'.$val->c_sy.'</option>';
                            }else{
                                echo '<option value="'.$val->c_name.'">'.$val->c_sy.'</option>';   
                            }    
                        }
                    }
                ?>
            </select>	
        
            <label for="yea">年</label>
            <select class="form-control" id="yea">
            <?php
                    foreach($year->result() as $y){
                        if($_GET['year']===$y->t_year){
                            echo '<option value="'.$y->t_year.'" selected>'.$y->t_year.'</option>';
                        }else{
                            echo '<option value="'.$y->t_year.'">'.$y->t_year.'</option>';
                        }
                    }
                ?>
            </select>
            <?php
                if(!isset($_GET['num'])){
                    echo '<input id="kanri_num"class="form-control" type="text" style="width:70px;" placeholder="番号">';
                }else{
                    echo '<input id="kanri_num"class="form-control" type="text" style="width:70px;" placeholder="番号" value="'.$_GET['num'].'">';
                }
            ?>
            <input id="print_kanri" type="button" class="btn btn-primary btn-sm" value="管理表">
            <input id="genpin" type="button" class="btn btn-primary btn-sm" value="現品">
            <input id="print_m" type="button" class="btn btn-primary btn-sm" value="見積書">
            <input id="print_n" type="button" class="btn btn-primary btn-sm" value="納品書">
            <input id="reset" type="button" class="btn btn-primary btn-sm" value="クリア">
            <input id="hatyu_kanri" type="button" class="btn btn-primary btn-sm" value="外注発注">
            <input id="zairyo" type="button" class="btn btn-primary btn-sm" value="部材発注">
            <input id="menu" type="button" class="btn btn-primary btn-sm" value="TOP">
        </div>
    </div>

    <input id="k_Kid" type="hidden" value="">
    <div class="pgn">
        <?php
            $c=$count;//年ごと総受注数
            $p=50;
            $pgs=ceil($c/$p);
            if(isset($_GET['pages'])){
                $pg=$_GET['pages'];
            }
            if($pgs==1){
                echo '1';
            }else if($pgs<21){
                for($i=1;$i<$pgs;$i++){
                    echo '<span><a onclick="pg(this.text)">'.$i.'</a></span> _ ';
                }
                echo '<span><a onclick="pg(this.text)">'.$pgs.'</a></span>';    
            }else{
                for($i=1;$i<21;$i++){
                    echo '<span><a onclick="pg(this.text)">'.$i.'</a></span><span style="font-weight:normal;"> _ </span>';
                }
                echo '<span><select class="pg_sel" id="pg">
                    <option value="">...</option>';
                
                for($i=21;$i<=$pgs;$i++){
                    if($pg==$i){
                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                    }else{
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                }
                echo '</select></span>';
            }
            echo '<span id="kensuu">全 '.$c.' 件</span>';

        ?>
    </div>
<div class="" style="width:98%;height:400px;margin-top:10px;">
    <div class="form-group" style="width:100%;height:400px;overflow:auto;">
            <input id="b_ck" type="hidden" value="">
        <table class="table table-striped table-hover nonpad">
            <tr><th></th><th></th><th style="width:7%;">登録日</th><th style="width:7%;">受注日</th><th style="width:15%;">管理番号</th><th style="width:23%;text-align:center;">客先</th><th class="h" style="width:5%;">請け</th><th class="h" style="width:5%;">現場</th><th class="h" style="width:5%;">場所</th><th style="width:5%;">項目数</th><th style="width:7%;text-align:center;">金額</th><th style="width:7%;text-align:center;">納期日</th><th style="width:7%;text-align:center;">納品日</th><th style="text-align:center;">備考</th></tr>
                <?php
                    foreach($rs->result() as $res) {
                    $id=$res->k_id;
                    print '<tr id='.$res->k_Kid.' style="" onclick="kan(this.id)">
                    <td><input id="k_id" type="hidden" value="'.$id.'"</td>
                    <td>
                        <input id="nb'.$id.'" type="button" class="btn btn-primary btn-sm" style="position:relative;height:25px;margin:3px 5px 0 0;padding:0 5px;" value="納品" onclick="nb(this.id)">
                        <div id="pop'.$id.'" class="pop_menu" style="display:none;">'.$res->k_Kid.' 納品書を発行します<br>
                            <input id="nh'.$id.'" type="text" value="'.date('Y/m/d',strtotime($res->nouki)).'" onChange="genDate(this.value,this.id)">
                            <input type="button" class="nhb btn btn-primary btn-sm" value="納品">
                        </div>
                    </td>
                    <td>'.date('Y/m/d',strtotime($res->t_day)).'</td><td>'.date('Y/m/d',strtotime($res->jutyu_D)).'</td><td><a id="k'.$res->k_Kid.'" href="jutyu?id='.$res->k_Kid.'">'.$res->k_Kid.'</a></td>
                    <td>'.$res->cust.'</td><td  class="h">'.$res->k_uke.'</td><td  class="h">'.$res->k_genba.'</td><td  class="h">'.$res->k_tiki.'</td><td id="k_key'.$res->k_Kid.'" style="text-align:center;">'.$res->z_mai.'</td>
                    <td id="k_total'.$res->k_Kid.'" style="text-align:center;padding-right:5px;">'.number_format($res->total).'</td>';
                    if($res->nouki==Null){
                    print '<td><input id="n'.$id.'" type="text" class="form-control" value=""  onChange="genDate(this.value,this.id);kanri_Up(this.id)"></td>';
                    }else{
                    print '<td><input id="n'.$id.'" type="text" class="form-control" value="'.date('Y/m/d',strtotime($res->nouki)).'"  onChange="genDate(this.value,this.id);kanri_Up(this.id)"></td>';
                    }
                    if($res->nouhin_D==Null){
                    print '<td><input id="k'.$id.'" type="text" class="form-control" value="" onChange="kanri_Up(this.id)"></td>';
                    }else{
                    print '<td><input id="k'.$id.'" type="text" class="form-control" value="'.date('Y/m/d',strtotime($res->nouhin_D)).'" onChange="kanri_Up(this.id)"  disabled></td>';
                    }
                    print '<td><input id="h'.$id.'" type="text" class="form-control" value="" onChange="kanri_Up(this.id)"></td>
                    </tr>';
                    }
                ?>
        </table>
    </div>
</div>

<div class="" style="width:99%;">
    <table class="table table-striped table-hover" style="margin-bottom:0;">
        <tr><th style="width:50%;">明細</th><th style="width:50%;">外注</th></tr>
        <tr><td rowspan="2" valign="top">
        <div id="sub" class="form-control" style="height:350px;width:100%;overflow:auto;">

                <table id="sb" class="table table-striped table-hover tbl_meisai">
                        <tr><th>項目</th><th>詳細</th><th>数量</th><th>単価</th><th>金額</th></tr>
 
                </table>
            </td>
            
            <td>

            <div id="gai" class="form-control h" style="height:130px;width:100%;overflow:auto;">

            <table height="200" class="table table-striped table-hover tbl_koutei">
                        <tr><th>工程</th><th>外注</th><th>発注数</th><th>単価</th><th>金額</th></tr>
   
                </table>
            </td>
        </tr>
        <tr>
            <td>
            <div id="zai" class="form-control h" style="height:220px;width:100%;overflow:auto;">

            <table height="150" class="table table-striped table-hover tbl_zai">
                        <tr><th>材質</th><th>仕入</th><th>A</th><th>B</th><th>C</th><th>数量</th><th>単価</th><th>金額</th></tr>
                   
                </table>
            </td>
        </tr>
    </table>

        </div>

    <div>   
</div>

  <script type="text/javascript" src="../js/kanri.js"></script>
  <script type="text/javascript" src="../js/print.js"></script>
  <script type="text/javascript" src="../js/function.js"></script>
</body>
</html>