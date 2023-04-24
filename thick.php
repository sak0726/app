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
    
    <script type="text/javascript" src="../js/jquery.js"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" integrity="sha384-vhJnz1OVIdLktyixHY4Uk3OHEwdQqPppqYR8+5mjsauETgLOcEynD9oPHhhz18Nw" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap-theme.min.css" integrity="sha384-jzngWsPS6op3fgRCDTESqrEJwRKck+CILhJVO5VvaAZCq8JYf8HsR/HPpBOOPZfR" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

    <title>材料</title>
</head>
<body>

<div id="wrap">
  <div id="inner">
    <div id="sideWrap">
      <div style="position:relative;">    
        <h3 style="text-align:left;margin-bottom:10px;">板厚</h3>
        <div class="sideMenu">
          <a href="/heiwass"><button type="button" class="btn btn-xs">TOP</button></a>
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
    </div><!--sideWrap-->

<div id="mainWrap">
  <div class="row" style="margin-left:10px;position:relative;">
    <button id="bnew" class="col-sm-1 btn btn-xs" style="margin:5px 0;padding:2px;">新規グループ</button>
    <button id="nomal" class="col-sm-1 btn btn-xs" style="margin:5px 0;padding:2px;" onclick="sela(this);">板厚のみ</button>
    <button id="two" class="col-sm-1 btn btn-xs" style="margin:5px 0;padding:2px;" onclick="sela(this);">板厚/幅</button>
    <button id="three" class="col-sm-1 btn btn-xs" style="margin:5px 0;padding:2px;" onclick="sela(this);">H/T</button>

    <span class="col-sm-3 col-sm-offset-9" style="text-align:right;color:#000;font-weight:bold;">※材質クリックで板厚追加</span>
    <div id='tgplate' style='display:none;position:absolute;top:30px;left:20px;z-index:2;background:#fff;padding:2px;box-shadow:0 0 5px #fff;border-radius:3px;'>
      <input type="text" id="tg" value="">
          <?php $this->load->database('zai');
            $val=$this->db->get('t_group');?>
            <?php foreach($val->result() as $mg):?>
          <?php endforeach;?>

          <?php 
            if (isset($_GET['f'])){
            echo
              '<button id="addmg" class="btn btn-xs">追</button>';
            }elseif(isset($_GET['h'])){
            echo
              '<button id="addh" class="btn btn-xs">追</button>';            
            }else{
            echo
              '<button id="admg" class="btn btn-xs">追加</button>';
            }
          ?>
    </div>
  </div>

  <div id="page">
    <?php
      if(isset($_GET['f'])){
        $gr='f';
        $tp=$this->db->get_where('t_group','kh=1')->num_rows();
      }elseif(isset($_GET['h'])){
        $gr='h';
        $tp=$this->db->get_where('t_group','kh=2')->num_rows();

      }else{
        $gr='n';
        $tp=$this->db->get_where('t_group','kh=0')->num_rows();
      }

      if(!isset($_GET['page'])){
        $p=1;
      }else{
        $p=$_GET['page'];
      }

      $nex=$p+1;
      $nex='<a id="'.$gr.$nex.'" onclick="pg(this)">></a>　';

      $pages=ceil($tp / 6);
      
      for ($i=1;$i<=$pages;$i++){
        if(!isset($_GET['page']) || $_GET['page']==1){
          $page=1;
          if ($i===1){
           echo '<span style="color:#000080;"><　1</span>　';
          }elseif($i==$pages){
           echo '<a id="'.$gr.$pages.'" onclick="pg(this)">'.$i.'</a>　';
          }else{
           echo '<a id="'.$gr.$i.'" onclick="pg(this)">'.$i.'</a>　';
          }
        }else{
          $p=$_GET['page'];
          $prev=$p-1;
          $prev='<a id="'.$gr.$prev.'" onclick="pg(this)"><</a>　';
          if ($p!=$i){
            if($i==1){
              echo $prev;
            }
              echo '<a id="'.$gr.$i.'" onclick="pg(this)">'.$i.'</a>　';        
          }else{
            echo '<span style="color:#000080;">'.$i.'</span>　';
          }
        }
      }

      if ($p==$pages){
        echo '<span style="color:#000080;">></span>';
      }else{
        echo $nex;
      }
    ?>
  </div>

  <div id="calareaA" style="width:98%;margin:5px 0 0 15px;display:none;">
      <?php
      if(isset($thick)){
        $i=0;
        echo "<div class='row' style='border:1px solid black;border-radius:3px;padding:2px;height:800px;'>";

        foreach ($thick as $a) {
            $zai=$a[0][1];
            echo "<div id='nav$zai' class='col-sm-2 nav' style='height:790px;overflow-y:scroll;position:relative;margin-bottom:30px;'>
            <div id='fx$zai' class='fx'>
            <p id='p$zai' style='position:relative;margin-bottom:0;' onclick='syou(this)'>".$zai."</p>
            <div id='plate".$zai."' class='madd open' style='width:100%;z-index:1;text-align:center;display:none;position:absolute:top:0;'>
            ".$zai."の板厚を追加します
              <div>
                <input type='text' id='mat".$zai."' style='width:50px;color:#000;'>
                <button type='button' id='b$zai' class='btn-xs ad' style='padding:0;width:50px;'>追加</button><span class='winclose' style='float:right;padding:0 5px 0 0;margin-top:10px;'>x</span>
                <button type='button' id='ncpy$zai' class='bcopy btn btn-xs' style='padding:2px 5px;margin:2px 0 2px 0;width:100%;'>コピー</button>
                <input type='hidden' value=$zai>
              </div>
            </div>
            </div>
            <table id='tb".$i."' style='box-shadow:0 0 5px #000;'>
              <tr>
                <th id='m".$zai."' class='trm' onclick='show_p(this)'>".$zai."</th>
                <th class='dlm'><button class='btn btn-xs' style='padding:0;width:50px;'>削除</button></th>
              </tr>
            <td colspan='2' style='position:relative;'>

            </td>";

            $m= count($thick[$i]);
            for($k=0;$k<$m;$k++){
              echo "<tr><td style='padding-left:10px;'><input type='text' class='upd' id='upd".$a[$k][0]."' value='".$a[$k][2]."'></td>
                      <td id='del".$a[$k][0]."' class='del' style='padding:0 0 3px 3px;width:30px;text-shadow:1px 1px 3px rebeccapurple;'>x</td>    
                    </tr>";
            }
              echo "</table></div>";
            $i++;
          }
            echo "</div>";
        }
      ?>

    </div>
  <div id="calareaB" style="width:98%;margin:5px 0 0 15px;display:none;padding-left:15px;">
      <?php
        $i=0;
        echo "<div class='row' style='border:1px solid black;border-radius:3px;padding:2px;height:800px;'>";

        foreach ($thickb as $a) {
            if($i===0 || $i===6){
            }
            $zai=$a[0][1];
            echo "<div id='nav$zai' class='col-sm-2 nav' style='margin-bottom:30px;height:790px;overflow-y:scroll;position:relative;'>
            <div id='fx$zai' class='fx'>
              <p id='p$zai' style='position:relative;margin-bottom:0;' onclick='syou(this)'>".$zai."</p>
              <div id='plate".$zai."' class='madd open' style='width:100%;z-index:1;text-align:center;display:none;position:absolute:top:0;'>
              ".$zai."の板厚を追加します
                  <div>
                    <input type='text' id='matba".$a[$i][4]."' style='width:50px;color:#000;'>
                    <input type='text' id='matb".$a[$i][4]."' style='width:50px;color:#000;'>
                    <button type='button' id='bb".$a[$i][4]."' class='btn-xs adb' style='padding:0;width:50px;'>追加</button><span class='winclose' style='float:right;padding:0 5px 0 0;margin-top:10px;'>x</span>
                    <button type='button' id='bcpy".$a[$i][4]."' class='bcopy btn btn-xs' style='padding:2px 5px;margin:2px 0 2px 0;width:100%;'>コピー</button>
                  </div>
              </div>
            </div>
          
            <table id='tbb".$i."' style='width:-webkit-fill-available;box-shadow:0 0 5px #000;margin-bottom:10px;' class='col-sm-2'>
              <tr style='text-align:right;'>
                <th colspan='2' id='y".$zai."' class='trm' onclick='show_p(this)'>".$zai."</th>
                <th class='dlm'><button class='btn btn-xs' style='padding:0;width:50px;'>削除</button></th>
              </tr>";

            $m= count($thickb[$i]);
            for($k=0;$k<$m;$k++){
              echo "<tr>
                      <td><input type='text' class='upd' id='updb".$a[$k][0]."' value='".$a[$k][2]."' style='width:40px;text-align:right;'></td>
                      <td><input type='text' class='upd' id='uphb".$a[$k][0]."' value='".$a[$k][3]."' style='width:70px;text-align:right;'></td>
                      <td id='delb".$a[$k][0]."' class='del' style='padding:0 0 3px 3px;width:30px;text-shadow:1px 1px 3px rebeccapurple;'>x</td>    
                    </tr>";
            }
            echo "</table></div>";


            $i++;
          }
          echo "</div>";
      ?>  
  </div><!--calB-->

  <div id="calareaC" style="width:98%;margin:5px 0 0 15px;display:none;padding-left:15px;">
      <?php
        $i=0;
        echo "<div class='row' style='border:1px solid black;border-radius:3px;padding:2px;height:800px;'>";

        foreach ($thickh as $a) {
            if($i===0 || $i===6){
            }
            $zai=$a[0][1];
            echo "<div id='nav$zai' class='col-sm-3 nav' style='margin-bottom:30px;height:790px;overflow-y:scroll;position:relative;'>
            <div id='fx$zai' class='fx'>
              <p id='p$zai' style='position:relative;margin-bottom:0;' onclick='syou(this)'>".$zai."</p>
              <div id='plate".$zai."' class='madd open' style='width:100%;z-index:1;text-align:center;display:none;position:absolute:top:0;'>
              ".$zai."の板厚を追加します
                  <div>
                    <input type='text' id='mah".$a[$i][7]."' style='width:50px;color:#000;'>
                    <button type='button' id='bh".$a[$i][7]."' class='btn-xs adb' style='padding:0;width:50px;'>追加</button><span class='winclose' style='float:right;padding:0 5px 0 0;margin-top:10px;'>x</span>
                    <button type='button' id='hcpy".$a[$i][7]."' class='bcopy btn btn-xs' style='padding:2px 5px;margin:2px 0 2px 0;width:100%;'>コピー</button>
                  </div>
              </div>
            </div>
          
            <table id='tbh".$i."' style='width:-webkit-fill-available;box-shadow:0 0 5px #000;margin-bottom:10px;' class='col-sm-2'>
              <tr style='text-align:right;'>
                <th colspan='5' id='y".$zai."' class='trm' onclick='show_p(this)'>".$zai."</th>
                <th class='dlm'><button class='btn btn-xs' style='padding:0;width:50px;'>削除</button></th>
              </tr>";

            $m= count($thickh[$i]);
            for($k=0;$k<$m;$k++){
              echo "<tr>
                <td><input type='text' class='upd' id='upah".$a[$k][0]."' value='".$a[$k][2]."' style='width:40px;text-align:right;'></td>
                <td><input type='text' class='upd' id='upbh".$a[$k][0]."' value='".$a[$k][3]."' style='width:40px;text-align:right;'></td>
                <td><input type='text' class='upd' id='upth".$a[$k][0]."' value='".$a[$k][4]."' style='width:40px;text-align:right;'></td>
                <td><input type='text' class='upd' id='uptt".$a[$k][0]."' value='".$a[$k][5]."' style='width:40px;text-align:right;'></td>
                <td><input type='text' class='upd' id='uprh".$a[$k][0]."' value='".$a[$k][6]."' style='width:40px;text-align:right;'></td>
                <td id='delh".$a[$k][0]."' class='del' style='padding:0 0 3px 3px;width:30px;text-shadow:1px 1px 3px rebeccapurple;'>x</td>    
                    </tr>";
            }
            echo "</table></div>";
            $i++;
          }
          echo "</div>";
      ?>  
  </div><!--calC-->
</div><!--mainWrap-->
</div><!--inner-->
</div><!--wrap-->
<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript" src="../js/thick.js"></script>
<?php
if(isset($_GET['f'])){
  echo "<script>sel('f');</script>";
}elseif(isset($_GET['h'])){
  echo "<script>sel('h');</script>";
}else{
  echo "<script>sel('n');</script>";
}
?>
</body>
</html>