<?php
  $this->load->database('zai');

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
        <h3 style="text-align:left;margin-bottom:10px;">材料管理メイン</h3>
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
<form action="m_update" method="post">
  <div id="calarea" style="margin:45px 0 0;position:relative;">
    <table style="width:100%;">
      <tr>
        <th>材質グループ<a id="mt_syu">▶</a></th>
        <th>材質</th>
        <th>形状<a id="mt_kata">▶</a></th>
        <th>比重</th>
        <th>キロ単価</th>
        <th>重量係数</th>
        <th>板厚グループ<a id="t_grp">▶</a></th>
        <th>備考</th>
      </tr>
      <tr>
        <td>
            <select id="zsyu" name="zsyu" style="border-radius:5px;border:none;margin-right:2px;box-shadow:1px 0 3px #000 inset;width:150px;" required>
              <option value="0">選択▼</option>
              <?php
                $this->db->select('mg_id,mg_name')->from('m_group');
                  $val=$this->db->get();?>
                <?php foreach($val->result() as $mg):?>
                  <option value='<?=$mg->mg_id?>'><?=$mg->mg_name?></option>
                <?php endforeach;?>
            </select>
          </td>
        <td><input type="text" id="mate" name="mat" required></td>
        <td><?php $query=$this->db->get("m_kata");?>
          <select id="kata" name="kata" style="border-radius:5px;border:none;margin-right:2px;box-shadow:1px 0 3px #000 inset;width:150px;" onchange="setGrav(this);" required>
          <option value="">選択▼</option>
          <?php foreach($query->result() as $kata):?>
            <option value="<?= $kata->kata?>"><?=$kata->kata?></option>
          <?php endforeach;?>
          </select>
        </td>
        <td><input type="text" id="grav" name="grav"></td>
        <td><input type="text" id="ktanka" name="ktanka"></td>
        <td><input type="text" id="kakex" name="kakex"></td>
        <td>
        <select id="atu" name="atu" style="border-radius:5px;border:none;margin-right:2px;box-shadow:1px 0 3px #000 inset;width:150px;" required>
              <option value="0">選択▼</option>
              <?php
                $this->db->select('tg_id,t_group_name')->from('t_group');
                $val=$this->db->get();
                foreach($val->result() as $rl):?>
                <option value='<?=$rl->t_group_name?>'><?=$rl->t_group_name?></option>
                <?php endforeach;?>
        </select>
        <td><input type="text" id="m_mes" name="mes"></td>
      </tr>
      <div style="position:absolute;top:-30px;left:15px;">
        <input type="button" id="new" class="btn btn-xs" value="新規">
        <input type="submit" class="btn btn-xs" value="登録">
        <input type="button" id="mt_del" class="btn btn-xs" value="削除">
      </div>
      <input type="hidden" id="zid" name="zid" value="0">      
    </table>
  </div>
</form>
<div style="position:relative;">
  <div id="mat_zsyu" style="position:absolute;top:-35px;left:50px;">
    <table style="width:300px;">
    <tr><th>グループ名</th><th>切断単価(㎤/円)</th><th></th></tr>  
      <tr>
        <td><input type="text" id="t_zsyu" style="margin-top:2px;width:100%;box-shadow:none;font-size:inherit;"></td>
        <td><input type="text" id="add_cp" style="margin-top:2px;width:100px;"></td>
        <td><button id="btn_add" class="btn btn-xs" style="width:50px;padding:0;">追加</button></td>
      </tr>
      <tr><td colspan="3"><hr style="border-color:#fff;"></td></tr>
        <?php
          $this->db->select('mg_id,mg_name,cut_price,mg_mes')->from('m_group')->order_by('mg_name');
          $val=$this->db->get();
          
          foreach($val->result() as $zs){
            echo "<tr class='rem'>
              <td style='position:relative;'><input id='zsyu_".$zs->mg_id."' type='text' value='".$zs->mg_name."'></td>
              <td><input id='cp".$zs->mg_id."' type='text' value='".$zs->cut_price."' style='width:100px;'></td>
              <td class='arr' style='width:50px;'>＋</td>
              </tr>
              
              <tr class='cond' style='display:none;'>
                <td colspan='2'>備考<input type='text' value='".$zs->mg_mes."' style='width:100%;'></td>
                <td><button class='z_up btn btn-xs' style='margin:5px 0 10px'>更新</button>
                    <input class='zy_id' type='hidden' value='".$zs->mg_id."'>
                    <button class='z_rem btn btn-xs' style='margin-bottom:10px'>削除</button>
                </td>
              </tr>";
                  
          }
          ?>   
    </table> 
  </div>

  <div id="mat_kata" style="position:absolute;top:-35px;left:300px;">
    <table style="width:300px;">
      <tr><th>形状</th><th>比重</th><th></th></tr>
       <tr>
         <td><input type="text" id="add_kata" style="margin-top:2px;box-shadow:none;font-size:inherit;"></td>
         <td><input type="text" id="add_grav" style="margin-top:2px;"></td>
         <td><button type="button" id="btn_kata" class="btn btn-xs" style="width:50px;padding:0;">追加</button></td>
      </tr>
      <tr><td colspan="3"><hr style="border-color:#fff;"></td></tr>
      <?php
        $query=$this->db->get('m_kata');
        foreach($query->result() as $kata){
            echo "<tr class='rem'>
              <td style='position:relative;'><input id='tx_kata".$kata->kata_id."' type='text' value='".$kata->kata."'></td>
              <td><input id='g".$kata->kata_id."' type='text' value='".$kata->kata_gravity."' style='width:100px;'></td>
              <td class='arr' style='width:50px;'>＋</td>
              </tr>
                
              <tr class='cond' style='display:none;'>
                <td colspan='2'>備考<input type='text' id='mes".$kata->kata_id."' value='".$kata->kata_mes."' style='width:100%;'></td>
                <td colspan='2'><button class='k_up btn btn-xs' style='margin:5px 0 10px'>更新</button>
                  <input class='kata_id' type='hidden' value='".$kata->kata_id."'>
                  <button class='k_rem btn btn-xs' style='margin-bottom:10px'>削除</button>
                </td>
              </tr>";
            }
            ?>
    </table>
  </div>
</div>

<div id="carea">
    <div class="search-area">
        <input type="text" id="search-text" style="border:none;border-radius:2px;background:#ffff;box-shadow:0 0 2px #000 inset;" placeholder="検索">
        <?php 
        $this->db->select('mg_id,mg_name')->from('m_group');
        $val=$this->db->get();
        foreach($val->result() as $v){
          echo '<button class="btn btn-xs" onclick="zfil(this)" value='.$v->mg_name.'>'.$v->mg_name.'</button>';
        }
        ?>
  </div>
<ul class="target-area">
  <div class="row" style="text-align:center;">
    <div class="col-sm-2 mg">種類</div>
    <div class="col-sm-2">材質</div><div class="col-sm-1">形状</div>
    <div class="col-sm-2">比重</div>
    <div class="col-sm-2">キロ単価</div>
    <div class="col-sm-1">係数</div>
    <div class="col-sm-2">板厚</div>
  </div>
  <hr>
      <?php
      if(isset($res)){
      $i=0;
        foreach($res->result() as $c){
          $i++;
          print "
          <div id=\"area$i\" style=\"position:relative;\"></div>
        <li>
            <div id='m_name$i' style='font-weight:bold;'><input type='hidden' id='m_id$i' name='m_id$i' value='".$c->m_id."'>
            <a><div id='mg$i' class=\"col-sm-2 mg\" style='font-weight:bold;'>".$c->mg_name."</div></a>
            <a class=\"col-sm-2\"><div style='text-align:center;'><input type='hidden' id='a$i' value='".$c->m_name."'>".$c->m_name."</div></a></div>
            <div class=\"col-sm-1\" style='font-weight:bold;text-align:center;'>".$c->m_kata."</div>"
            ."<div class=\"col-sm-2\" style='font-weight:bold;text-align:center;'>".$c->gravity."</div>
            <div class=\"col-sm-2\" style='font-weight:bold;text-align:center;'>".$c->m_weight_price." 円</div>
            <div class=\"col-sm-1\" style='font-weight:bold;text-align:center;'>".$c->m_margin."</div>
            <div class=\"col-sm-2\" style='font-weight:bold;text-align:center;'>".$c->tg_name."</div>

            <input type='hidden' id='zsyu$i' value='".$c->mg_id."'>
            <input type='hidden' id='kata$i' value='".$c->m_kata."'>
            <input type='hidden' id='gr$i' value='".$c->gravity."'>
            <input type='hidden' id='wp$i' value='".$c->m_weight_price."'>
            <input type='hidden' id='wm$i' value='".$c->m_margin."'>
            <input type='hidden' id='tg$i' value='".$c->tg_name."'>
            <div id=\"acd$i\" class=\"col-sm-1 sw\" style=\"text-align:right;font-size:20px;padding:0;\">".""
            ."</div>
                <div class=\"row\">
                    <div id=\"seg$i\" class=\"cont col-sm-8 col-sm-offset-1\" style=\"
                        display:none;
                        width:90%;
                        background:#e5e5e5;
                        padding:10px 10px 10px;
                        box-shadow:0 0 5px #000 ;
                        border-radius:5px;
                        font-weight:600;
                        font-size:16px;
                        color:black;
                        \">材質
                    </div>
                </div>              
              <script>
              $('#m_name$i').click(function(){
                let mg=$('#zsyu$i').val();
                var mid=document.getElementById('m_id$i').value;
                var grav=document.getElementById('gr$i').value;
                var name=document.getElementById('a$i').value;
                var kata=document.getElementById('kata$i').value;
                var price=document.getElementById('wp$i').value;
                var margin=document.getElementById('wm$i').value;
                $('#zsyu').val(mg);
                $('#kata').val(kata);
                $('#zid').val(mid);
                $('#grav').val(grav);
                $('#mate').val(name);
                $('#ktanka').val(price);
                $('#kakex').val(margin);
                $('#atu').val($('#tg$i').val());
              });
              
              </script>
          <hr>
        </li>";
        }
      }
      ?>
      </ul>
</div>

<div id="calarea">
  <table><tr><th style="position:relative;">板厚係数</th><th>数量値引係数</th></tr>
    <tr><td style="width:50%;position:relative;">
    <div style="position:absolute;top:0px;">
      
      <div style="margin:5px 0 5px 0;">
        <button type="button" id="tnew" class="btn btn-xs">新規</button>
        <button type="button" id="tenter" class="btn btn-xs" onClick="t_enter()">登録</button>
        <button type="button" id="tenter" class="btn btn-xs" onClick="t_del()">削除</button>
      </div>
      <table>
      <input type="hidden" class="key" id="key">
        <tr>
          <th colspan="2">板厚 ～ 板厚mm</th><th>掛率</th><th>備考</th>
        </tr>
        <tr>
          <td><input type="text" id="a"></td><td><input type="text" id="aa"></td>
          <td><input type="text" id="ex"></td><td><input type="text" id="tex_mes"></td>
        </tr>
      </table>
      <table id="tex" style="width:100%;">
          <tr>
            <th colspan="2">板厚 ～ 板厚mm</th><th>掛 率</th><th>備 考</th>
          </tr>          
          <?php if(isset($tex)):?>
          <?php foreach($tex->result() as $t):?>
          <tr>
            <td id="tex_a<?= $t->tex_id;?>"><a><?= $t->a;?></a></td><td><?=$t->aa;?></td><td><?=$t->ex;?></td><td><?=$t->tex_mes;?></td>
            <input type="hidden" class="tex_id" id="tex_id" value="<?=$t->tex_id;?>">
          </tr>
          <script>
            $(function(){
              $('#tex_a<?=$t->tex_id;?>').click(function(){
                $('#a').val(<?=$t->a;?>);
                $('#aa').val(<?=$t->aa;?>);
                $('#ex').val(<?=$t->ex;?>);
                $('#key').val(<?=$t->tex_id;?>);
                $('#tex_mes').val(<?=$t->tex_mes;?>);

              });
            });
          </script>
          <?php endforeach;?>
          <?php endif;?>
        </table>
      </div style="position:none;">
      </td>

    <td style="width:50%;padding:0 5px;position:relative;">
    <div style="position:initial;">
      <div style="margin:5px 0 5px 0;">
        <button type="button" id="knew" class="btn btn-xs">新規</button>
        <button type="button" id="kenter" class="btn btn-xs">登録</button>
        <button type="button" id="kdel" class="btn btn-xs" >削除</button>
      </div>

      <table>
      <input type="hidden" class="ke_id" id="ke_id" value="">
        <tr><th>数量</th><th>率</th><th>備考</th></tr>
        <tr><td><input type="text" id="kkazu"></td>
        <td><input type="text" id="k_ex"></td>
        <td><input type="text" id="k_mex"></td></tr>

      </table>
      <div id="kez">
        <table id="kex" style="width:100%;">
      
        <tr><th>数量</th><th>率</th><th>備考</th></tr>
          <?php if(isset($kex)):?>
          <?php foreach($kex ->result() as $t):?>
        <tr>
          <td id="kex_<?=$t->ke_id;?>"><a><?= $t->kazu;?></a></td><td><?=$t->ex;?></td><td><?=$t->ke_mes;?></td>
        </tr>
          <script>
            $(function(){
              $('#kex_<?=$t->ke_id;?>').click(function(){
                $('#kkazu').val(<?=$t->kazu;?>);
                $('#k_ex').val(<?=$t->ex;?>);
                $('#ke_id').val(<?=$t->ke_id;?>);
              });
            });
          </script>
          <?php endforeach;?>
          <?php endif;?>
        </table>
        </div>

    </td>
  </tr>
  </table>
          </div><!--mainWrap-->
</div><!--inner-->
</div><!--wrap-->
<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript" src="../js/material.js"></script>

</body>
</html>