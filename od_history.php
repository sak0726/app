<?php
  $mp=20;
  $pages=ceil($cnt / $mp); 
  if(isset($_GET['st'])){
    $st=$_GET['st'];
    $ed=$_GET['end'];
  }else{
    $st=date('Y-m-d');
    $ed=date('Y-m-d');
  }

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
    <title>見積履歴</title>
</head>
<body>
<div id="wrap">
<div id="inner">
  <div id="sideWrap">
<div style="position:relative;">    
    <h3 style="text-align:left;margin-bottom:10px;">履歴一覧</h3>
    <div class="sideMenu">
        <a href="menu"><button type="button" class="btn btn-xs cos-sm-2">TOP</button></a>
        <a href="mitsumori"><button type="button" class="btn btn-xs cos-sm-2">見積作成</button></a>
        <a href="history"><button type="button" class="btn btn-xs cos-sm-2">履歴</button></a>
        <a href="customer"><button type="button" class="btn btn-xs cos-sm-2">顧客</button></a>
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
        <button class="btn btn-xs cos-sm-2" onClick="history.back()" style="width:100%;">戻る</button>
        <button class="btn btn-xs cos-sm-2" id="out" style="width:100%;">ログアウト</button>

    </div>
</div>
</div>

<div id="mainWrap">
  <div style="text-align:left;"><button type="button" id="allop" class="btn btn-xs" style="margin:0px 10px 0;">open</button>
    <span>
      <input type="date" id="std" style="margin:10px 0 10px;border:none;border-radius:2px;background:#ffff;box-shadow:0 0 2px #000 inset;" value="<?=$st?>">
      <input type="date" id="end" style="margin:10px 0 10px;border:none;border-radius:2px;background:#ffff;box-shadow:0 0 2px #000 inset;" value="<?=$ed?>">
      <button type="button" id="srchdate" class="btn btn-xs" style="margin:0px 10px 0;">検索</button>
      <input type="text" id="search-text" style="margin:10px 0 10px;border:none;border-radius:2px;background:#ffff;box-shadow:0 0 2px #000 inset;" placeholder="検索">
      <button type="button" id="bt-clear" class="btn btn-xs" style="margin:0px 10px 0;">クリア</button>
  </span>
  </div>

<div id="calarea" style="text-align:center;">
<?php
echo "<div style='text-align:left;'>";

if(isset($_GET['st'])){
  $lnk=1;
  $st=$_GET['st'];
  $ed=$_GET['end'];
}else{
  $lnk=0;
}

if(!isset($_GET['id'])){
  if (!isset($_GET['page']) ||$_GET['page']==1){
    $pre= "<　";
    if ($pages<2){
      $nex=">";
    }else{
      if($lnk!=1){
        $nex="<a href='history?page=2'>".">"."</a>　";
      }else{
        $nex="<a href='history?page=2"."&st=".$st."&end=".$ed."'>".">"."</a>　";
      }
    }
    echo $pre;
    for($i=1;$i<=$pages;$i++){
      if ($i==1){
        echo $i."　";
      }else{
        if($lnk!=1){
          echo "<a href='history?page=".$i."'>".$i."</a>　";
        }else{
          echo "<a href='history?page=".$i."&st=".$st."&end=".$ed."'>".$i."</a>　";
        }
    }
    }
    echo $nex;
  }else{

    $pp=$_GET['page']-1;
    $np=$_GET['page']+1;
    if($lnk!=1){
    $pre="<a href='history?page=".$pp."'><</a>　";
    $nex="<a href='history?page=".$np."'>></a>　";
    }else{
      $pre="<a href='history?page=".$pp."&st=".$st."&end=".$ed."'><</a>　";
      $nex="<a href='history?page=".$np."&st=".$st."&end=".$ed."'>></a>　";
    }
    echo $pre;
    for($i=1;$i<=$pages;$i++){
      if($i==$pages){
        echo $i."　";
      }else{
        if($lnk!=1){
          echo "<a href='history?page=".$i."'>".$i."</a>　";
        }else{
          echo "<a href='history?page=".$i."&st=".$st."&end=".$ed."'>".$i."</a>　";
        }
      }
    }
    if ($_GET['page']!=$pages){
    echo $nex;
    }else{
      echo ">";
    }

  }
}else{
  $pcid=$_GET['id'];
  if (!isset($_GET['page']) ||$_GET['page']==1){
    $pre= "<　";
    if ($pages<2){
      $nex=">";
    }else{
      if($lnk!=1){
        $nex="<a href='history?id=".$pcid."&page=2'>".">"."</a>　";
      }else{
        $nex="<a href='history?id=".$pcid."&page=2"."&st=".$st."&end=".$ed."'>"."</a>　";
      }
    }
    echo $pre;

    for($i=1;$i<=$pages;$i++){
      if ($i==1){
        echo $i."　";
      }else{
        if($lnk!=1){
          echo "<a href='history?id=".$pcid."&page=".$i."'>".$i."</a>　";
        }else{
          echo "<a href='history?id=".$pcid."&page=".$i."&st=".$st."&end=".$ed."'>".$i."</a>　";
        }
      }
    }
    echo $nex;
  }else{
    $pp=$_GET['page']-1;
    $np=$_GET['page']+1;
    if($lnk!=1){
      $pre="<a href='history?id=".$pcid."&page=".$pp."'><</a>　";
      $nex="<a href='history?id=".$pcid."&page=".$np."'>></a>　";
    }else{
      $pre="<a href='history?id=".$pcid."&page=".$pp."&st=".$st."&end=".$ed."'><</a>　";
      $nex="<a href='history?id=".$pcid."&page=".$np."&st=".$st."&end=".$ed."'>></a>　";
      }
    echo $pre;

    for($i=1;$i<=$pages;$i++){
      if($i==$pages){
        echo $i."　";
      }else{
        if($lnk!=1){
          echo "<a href='history?id=".$pcid."&page=".$i."'>".$i."</a>　";
        }else{
          echo "<a href='history?id=".$pcid."&page=".$i."&st=".$st."&end=".$ed."'>".$i."</a>　";
        }
      }
    }

    if ($_GET['page']!=$pages){
    echo $nex;
    }else{
      echo ">";
    }


  }
}
echo "</div>";
?>
    <div class="row">       
      <div class="col-sm-2">作成日</div>
      <div class="col-sm-3">顧客名</div>
      <div class="col-sm-2">管理番号</div>
      <div class="col-sm-2">件数</div>
      <div class="col-sm-2">金額</div>
    </div>
      <?php
      if(isset($res)){
      $i=0;
        foreach($res->result() as $c){
          $i++;
          $this->load->database('zai');
          $onum=$c->o_number;
          $this->db->select('*')->from('oderhis_meisai')->where('om_kanri_num=',$onum);
          $query=$this->db->get();
          $val=$query->row();
          print "
      <div class='targetArea'>
          <div class='list' style='padding:-10px;'>
            <hr style='margin:0px 0 0 0px;border:0;height:12px;box-shadow:0 12px 12px -12px rgba(0,0,0,0.5) inset;'>
            <div class='sublist'>
              <div id=\"area$i\" style=\"position:relative;\"></div>
              <div class='ar$i'>
                <div class=\"col-sm-2\">".$c->created."</div>
              </div>";
              if(isset($_GET['st']) && isset($_GET['end'])){
                $st=$_GET['st'];
                $ed=$_GET['end'];
                echo "<div class=\"col-sm-3\"><a href='history?id=".$c->cust_id."&st=".$st."&end=".$ed."'>".$c->o_c_name."</a></div>";
              }else{
                echo "<div class=\"col-sm-3\"><a href='history?id=".$c->cust_id."'>".$c->o_c_name."</a></div>";
              };
              echo "<div class=\"col-sm-2\"><a href='mitsumori?id=".$c->o_id."'>".$c->o_number."</a></div>
              <div class='ar$i'>
                <div class=\"col-sm-2\">".$c->od_count."</div>
                <div class=\"col-sm-2\">".number_format($c->od_price)."</div>
                <div id=\"acd$i\" class=\"col-sm-1 sw\" style=\"text-align:right;font-size:20px;\">"."＋"."</div>
              </div>
              <script>
              $('.ar$i').click(function(){
                  var id = document.getElementById('acd$i');
                  id.innerHTML == '＋' ? id.innerHTML = '－' : id.innerHTML='＋';
                  $('#seg$i').slideToggle('fast');
                  
                      
              });
              </script>
            </div>
          <div class=\"row\">
            <div id=\"seg$i\" class=\"cont col-sm-11 col-sm-offset-1\" style='box-shadow:0 0 5px #000 inset;margin-bottom:5px;background:#fff;'>
              <table style='width:100%'><tr style='float:rigth;'>受注日 : ".$c->irai_day."</tr><tr><th style='width:10%;'>#</th><th colspan='3' style='width:50%;'>品名</th><th>数量</th><th>単価</th><th>金額</th></tr>";
              foreach($query->result() as $p){
                if($p->mat_type<4){
                print "<tr class='list' style='border-bottom:1px solid #e5e5e5;'>
                <td style='width:140px;'>".$p->om_material."</td>
                <td style='width:120px;'>
                <table>
                  <tr><td rowspan='2' style='margin:0;padding:0 1px;'>".$p->atsu."</td>
                  <td class='m_kousa' style='font-weight:none;font-size:9px;margin:0;padding:0;'>".substr($p->sap,1).$p->vap."</td></tr>
                  <tr><td class='m_kousa' style='font-weight:none;font-size:9px;'>".substr($p->sam,1).$p->vam."</td></tr></table>               
                </td>
                <td style='width:120px;'>
                <table>";
                if($p->mat_type>1){
                  echo "<tr>
                  <td rowspan='2' style='margin:0;padding:0 1px;'>x　".$p->take."</td>
                  <td class='m_kousa' style='font-weight:none;font-size:9px;margin:0;padding:0;'>".substr($p->scp,1).$p->vcp."</td></tr>
                  <tr><td class='m_kousa'style='font-weight:none;font-size:9px;'>".substr($p->scm,1).$p->vcm."</td></tr>";
                }else{
                  echo "<tr>
                  <td rowspan='2' style='margin:0;padding:0 1px;'>x　".$p->haba."</td>
                  <td class='m_kousa' style='font-weight:none;font-size:9px;margin:0;padding:0;'>".substr($p->sbp,1).$p->vbp."</td></tr>
                  <tr><td class='m_kousa'style='font-weight:none;font-size:9px;'>".substr($p->sbm,1).$p->vbm."</td></tr>";
                }
                echo "</table>
                </td>
                <td style='width:120px;'>
                <table>";
                if($p->mat_type>1){
                  echo "";
                }else{
                  echo "<tr>
                  <td rowspan='2' style='margin:0;padding:0 1px;'>x　".$p->take."</td>
                  <td class='m_kousa' style='font-weight:none;font-size:9px;margin:0;padding:0;'>".substr($p->scp,1).$p->vcp."</td></tr>
                  <tr><td class='m_kousa'style='font-weight:none;font-size:9px;'>".substr($p->scm,1).$p->vcm."</td></tr>";
                }
                echo "</table>
                </td>";
              }elseif($p->mat_type==4){
                print "<tr class='list' style='border-bottom:1px solid #e5e5e5;'>
                <td style='width:140px;'>".$p->om_material."</td>
                <td colspan='2' style='text-align:left;'>".$p->atsu."　x　".$p->haba."　x　".$p->take."</td>
                <td style='width:100px;text-align:left;'>(T".$p->t." - t".$p->t2." - r".$p->r.")</td>";
              }elseif($p->mat_type==5){
                print "<tr class='list' style='border-bottom:1px solid #e5e5e5;'>
                <td style='width:140px;'>".$p->om_material."</td>
                <td colspan='3' style='text-align:left;width:450px;'>".$p->atsu."　/　".$p->haba."</td>";
              }

              echo "<td>".$p->kazu."</td><td>".number_format($p->price)."</td><td>".number_format($p->t_price)."</td></tr>";

            }
              print"
              </table>
            </div>
          </div>              
          </div></div>
          
          
          ";
        }
      }
      ?>
  
  </div><!--mainWrap-->
</div><!--inner-->
</div><!--wrap-->
<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript" src="../js/list.js"></script>

</body>
</html>