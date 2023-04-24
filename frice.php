<?php
    $this->load->helper('cookie');
    $cookie=get_cookie('name',true);
    if(empty($cookie)){
      header('Location:/heiwass'); 
    };
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script type="text/javascript" src="../../js/jquery.js"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" integrity="sha384-vhJnz1OVIdLktyixHY4Uk3OHEwdQqPppqYR8+5mjsauETgLOcEynD9oPHhhz18Nw" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap-theme.min.css" integrity="sha384-jzngWsPS6op3fgRCDTESqrEJwRKck+CILhJVO5VvaAZCq8JYf8HsR/HPpBOOPZfR" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <title>フライス</title>
</head>
<body>

<div id="wrap">
<div id="inner">

    <div id="sideWrap">
        <div style="position:relative;">    
            <h3 style="text-align:left;margin-bottom:10px;">見積書作成</h3>
            <div class='sideMenu'>
                <a href="menu"><button type="button" class="btn btn-xs">TOP</button></a>
                <a href="mitsumori"><button type="button" class="btn btn-xs">見積作成</button></a>
                <a href="history"><button type="button" class="btn btn-xs">履歴</button></a>
                <a href="customer"><button type="button" class="btn btn-xs">顧客</button></a>
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
                <button class="btn btn-xs" onClick="history.back()" style="width:100%;">戻る</button>
                <button class="btn btn-xs cos-sm-2" id="out" style="width:100%;">ログアウト</button>

            </div>
        </div>
    </div>

    <div id="mainWrap">
      <div id="frice">
      <?php 
          if(isset($val)){
              echo 
              "<table style='width:100%;text-align:center;margin-top:10px;'>
              <tr>
              <th>幅/丈</th><th>10</th><th>20</th><th>30</th><th>50</th>";
              for($i=100;$i<=1000;$i=$i+50){
                  echo "<th>".$i."</th>";
              }
              echo "</tr>";

              $k=0;
              $l=0;
              foreach($val->result() as $a){
                  echo "<tr style='border:1px solid #000;'><td>".$a->fp_haba."</td>
                            <td><input id='h".$k."f$l' value='$a->fp_10'></td>";
                            $sp="'#h".$k."f".$l."'";
                              $h=$a->fp_haba;
                              $t="'fp_10'";
                          echo
                            "<script>
                              $($sp).change(function(){
                                  var p=$($sp).val();
                                  var h=$h;
                                  var t=$t;
                                  
                                    $.ajax({
                                        type: 'POST',
                                        url: 'frice_price',
                                        data: 'price='+p+'&haba='+h+'&take='+t,
                                        success: function(){
                                          location.href='material?frice';
                                        }
                                  });
                              });
                            </script>";
                            $l++;
                            echo "<td><input id='h".$k."f$l' value='$a->fp_20'></td>";
                            $sp="h".$k."f".$l;
                            $h=$a->fp_haba;
                              $t="'fp_20'";
                            echo
                              "<script>
                              $($sp).change(function(){
                                  var p=$($sp).val();
                                  var h=$h;
                                  var t=$t;
                                  
                                    $.ajax({
                                        type: 'POST',
                                        url: 'frice_price',
                                        data: 'price='+p+'&haba='+h+'&take='+t,
                                        success: function(){
                                          location.href='material?frice';
                                        }
                                  });
                              });
                              </script>";
                            $l++;
                            echo "<td><input id='h".$k."f$l' value='$a->fp_30'></td>";
                            $sp="h".$k."f".$l;
                            $h=$a->fp_haba;
                              $t="'fp_30'";
                            echo
                              "<script>
                              $($sp).change(function(){
                                  var p=$($sp).val();
                                  var h=$h;
                                  var t=$t;
                                  
                                    $.ajax({
                                        type: 'POST',
                                        url: 'frice_price',
                                        data: 'price='+p+'&haba='+h+'&take='+t,
                                        success: function(){
                                          location.href='material?frice';
                                        }
                                  });
                              });
                              </script>";
                            $l++;
                            echo "<td><input id='h".$k."f$l' value='$a->fp_50'></td>";
                            $sp="h".$k."f".$l;
                            $h=$a->fp_haba;
                              $t="'fp_50'";
                            echo
                              "<script>
                              $($sp).change(function(){
                                  var p=$($sp).val();
                                  var h=$h;
                                  var t=$t;
                                  
                                    $.ajax({
                                        type: 'POST',
                                        url: 'frice_price',
                                        data: 'price='+p+'&haba='+h+'&take='+t,
                                        success: function(){
                                          location.href='material?frice';
                                        }
                                  });
                              });
                              </script>";
                            $l++;
                            for($i=100;$i<=1000;$i=$i+50){
                                $res="fp_".$i;
                                $res=$a->$res;
                              echo "<td><input id='h".$k."f$l' value='$res'></td>";
                              $sp="h".$k."f".$l;
                              $h=$a->fp_haba;
                              $t="'fp_".$i."'";
                              echo
                                "<script>
                                $($sp).change(function(){
                                  var p=$($sp).val();
                                  var h=$h;
                                  var t=$t;
                                  
                                    $.ajax({
                                        type: 'POST',
                                        url: 'frice_price',
                                        data: 'price='+p+'&haba='+h+'&take='+t,
                                        success: function(){
                                          location.href='material?frice';
                                        }
                                  });
                              });
                                </script>";
                              $l++;
                          }      
                            echo"</tr>";
                            $k++;
              }

              echo "</table>";
          }

      ?>
      </div><!--frice-->
    </div><!--mainWrap-->
  </div><!--inner-->
</div><!--wrap-->

<script type="text/javascript" src="../../js/menu.js"></script>
<script type="text/javascript" src="../../js/frice.js"></script>
</body>
</html>