<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/tabmenu.css">
    <link rel="stylesheet" href="../cbox/colorbox.css">
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <title>外注管理</title>
</head>
  <body style="width:900px;">
  <style>
    .a{
        display:none;
    }
    </style>
  <div class="wrap">
    <!-- タブを構成するブロック -->
    <div class="tab-list">
          <button class="tab-list-item is-btn-active">顧客</button>
          <button class="tab-list-item a">外注</button>
          <button class="tab-list-item">商品</button>
          <button class="tab-list-item a">工程</button>
    </div>

    <!-- コンテンツを構成するブロック -->
<div class="tab-contents-wrap">
    <div class="tab-contents is-contents-active">
      <div class="sub_table">

      <div class="container" style="margin:10px 5px;">
              <input type="button" id="allop" class="btn btn-primary btn-sm tb_top_menu tb_top_tag" value="展開">
              <input type="text" id="k_sc" class="form-control" style="display:inline;width:200px;" placeholder="検索" autocomplete="off">
              <input type="button" id="bt-clear" class="btn btn-primary btn-sm tb_top_menu" value="クリア">
              <input type="button" class="cf85 btn btn-primary btn-sm tb_top_menu" href="customer?new" value="新規">
              <input type="button" id="houjin" class="btn btn-primary btn-sm tb_top_menu ct" value="法人">
              <input type="button" id="kojin" class="btn btn-primary btn-sm tb_top_menu ct" value="個人">
        </div>

      <div id="tb_cust" class="targetArea">
          <div class='row' style="text-align:center;border-bottom:1px solid #000080;margin:auto;margin-top:10px;">
            <div class="col-sm-1">ID</div><div class="col-sm-4">社名</div><div class="col-sm-6">住所</div><div class="col-sm-1"></div>
          </div>
            <?php
              if(!isset($res)){
                header('Location:customer?new');
                exit();
              }else{
              $i=0;
                foreach($res[4]->result() as $c){
                  $i++;
                  $id=$c->c_id;
                  $search=['〒','-'];
                  $rep=['',''];
                  if(!empty($c->c_zip)){
                    $zp=str_replace($search,$rep,$c->c_zip);
                    $zip='〒'.substr($zp,0,3).'-'.substr($zp,3,7);
                  }else{
                    $zip='';
                  }
                  print "
                  <div class='list' style='margin:0px 10px 0px;border-bottom:1px solid #000080;'>
                    <div id='area$i' style='position:relative;text-align:center;'><input type='hidden' class='c_type' value=".$c->c_type."></div>
                    <div class='row c_tr' id='ar$i' style='height:28px;overflow:hidden;'>
                      <div class='col-sm-1'>".$c->c_sy."</div><div class='col-sm-4'>".$c->c_name."</div>
                      <div class='col-sm-6'>".$zip.$c->c_add."</div>
                      <div id='acd$i' class='col-sm-1 acd' style='text-align:left;font-size:20px;cursor:pointer;'>＋</div>
                    </div>

                    <div class='row justify-content-center'>
                        <div id=\"seg$i\" class=\"cont col-sm-8 col-sm-offset-1\" style='box-shadow:0 0 5px #000,0 0 5px lavender inset;margin-bottom:5px;'>
                            会社名 : <a class='cf85' href=customer?id=".$id." id='cm$id'>".$c->c_name."</a>  ID : ".$c->c_sy."
                            <span style='float:right'><input type='button' style='font-size:0.8rem;height:22px;padding:0 5px;' class='btn btn-primary btn-sm' id='meisai".$id."' value='注文一覧'></span>
                            <hr>
                            部　署 : $c->c_busyo<br><hr>
                            担　当 : $c->c_tan";
                            if(!empty($c->c_tan)){
                              echo "　様";
                            }
                            echo "<br>
                            <hr>
                            メール : <a href='mailto:$c->c_mail?subject='件名'>$c->c_mail</a><br><hr>
                            電　話 : ".substr($c->c_tel,0,4)."-".substr($c->c_tel,4,2)."-".substr($c->c_tel,6)." FAX : ".substr($c->c_tel,0,4)."-".substr($c->c_tel,4,2)."-".substr($c->c_tel,6)."<br><hr>住　所 : 〒".substr($c->c_zip,0,3)."-".substr($c->c_zip,3,6)." ".$c->c_add."<br><hr>
                        </div>
                    </div>
                  </div>";
                }
            }
            ?>
          </div><!--targetarea-->




      </div>
    </div>

      <div class="tab-contents">
        <div class="sub_table">
                    <div class="form-inline" style="margin:5px 0 5px 21px;">
                        <input type="button" id="gallop" class="btn btn-primary btn-sm tb_top_menu tb_top_tag" value="展開">
                        <input type="text" id="sechg" class="form-control" style="display:inline;width:200px;" placeholder="検索" onkeyUp="dis(this.value)">
                        <input type="button" id="g_bt-clear" class="btn btn-primary btn-sm tb_top_menu" value="クリア">
                        <input type="button" class="if78 btn btn-primary btn-sm tb_top_menu" href="gai?new" value="新規">
                    </div>
                        <div id="tb_gaityu" class="targetArea" style="">  
                        <div class='row' style="display:flex;text-align:center;border-bottom:1px solid #000080;margin:auto;margin-top:10px;font-size:12px;">
                          <div class="col-sm-1">ID</div><div class="col-sm-1">呼称</div><div class="col-sm-5">社名/住所</div><div class="col-sm-5">カテゴリ</div><div class="col-sm-1"></div>
                        </div> 
                          <?php
                            $id="";
                            if(!isset($res[0])){
                              header('Location:gaityu');
                              exit();
                            }else{
                            $i=0;
                            
                              foreach($res[0]->result() as $c){
                                $i++;
                                $id=$c->g_symb;
                                $tel=substr($c->g_tel,0,4)."-".substr($c->g_tel,4,2)."-".substr($c->g_tel,6,4);
                                $fax=substr($c->g_fax,0,4)."-".substr($c->g_fax,4,2)."-".substr($c->g_fax,6,4);

                                print "
                                <div class='list' style='margin:0px 10px 0px;'>
                                  <hr>
                                  <div id=\"area$i\" style=\"position:relative;\">
                                    <div id='ar$i' class='row'>
                                      <div class=\"col-sm-1\">".$id."</div>
                                      <div class=\"col-sm-1\">".$c->g_name."</div>
                                      <div class=\"col-sm-5\">".$c->g_seisyou."<br>".$c->g_add."</div>
                                      <div class='form-inline col-sm-4'>";
                                      $j=0;
                                      foreach($res[7]->result() as $ct){
                                        for($k=0;$k<strlen($c->g_cat);$k++){
                                          if($c->g_cat[$k]==$ct->g_cat){$j=1;break;}
                                          else{$j=0;}
                                        }
                                        if($j==1){
                                          echo "<label for='".$ct->g_cat_colum."'>".$ct->g_cat_name."</label><input type='checkbox' id='".$ct->g_cat_colum."' name='".$id."' value='".$ct->g_cat."' onclick='cat(this)' checked>";
                                        }else{
                                          echo "<label for='".$ct->g_cat_colum."'>".$ct->g_cat_name."</label><input type='checkbox' id='".$ct->g_cat_colum."' name='".$id."' value='".$ct->g_cat."' onclick='cat(this)'>";
                                        }
                                      }
                                          echo "</div>
                                        <div id='gacd$i' class='sw col-sm-1 col-sm-offset-1' style='text-align:left;font-size:20px;' click='openSeg(this.id)'>＋</div>
                                    </div>

                                    <div class='row'>
                                        <div id='gseg$i' class='cont col-sm-8 col-sm-offset-1' style='box-shadow:0 0 5px #000,0 0 5px lavender inset;margin-bottom:5px;'>
                                            会社名 : <a class='if78' href=gai?id=".$id." id='cm$id'>".$c->g_seisyou."</a><span style='font-size:12px;margin-bottom:5px;'></span>
                                            <hr>
                                            担　当 : $c->g_tantou";
                                            if(!empty($c->g_tantou)){
                                              echo "　様";
                                            }
                                            echo "<br>
                                            <hr>
                                            メール :<a href=''>$c->g_mail</a><br><hr>
                                            電　話 : ".$tel." FAX : ".$fax."<br><hr>住　所 : ".$c->g_add."<br><hr>
                                            <div class='form-inline'>";
                                            if($c->g_hid==0){
                                              echo "<label for='vis".$c->ID."'>表示</label><input id='vis".$c->ID."' type='radio' checked name='bl".$i."' class='btn btn-primary btn-sm' value='0' onclick='bld(this.id,this.value)'>
                                                  <label for='dev".$c->ID."'>非表示</label><input id='dev".$c->ID."' type='radio' name='bl".$i."' class='btn btn-primary btn-sm' value='1' onclick='bld(this.id,this.value)'>";
                                            }else{
                                              echo "<label for='vis".$c->ID."'>表示</label><input id='vis".$c->ID."' type='radio' name='bl".$i."' class='btn btn-primary btn-sm' value='0' onclick='bld(this.id,this.value)'>
                                                  <label for='dev".$c->ID."'>非表示</label><input id='dev".$c->ID."' type='radio' checked name='bl".$i."' class='btn btn-primary btn-sm' value='1' onclick='bld(this.id,this.value)'>";
                                            }
                                    echo "</div></div>
                                    </div>
                                  </div>
                                </div>";

   
                                }
                            } 

                          ?>
                        </div><!--tagetarea-->
        </div>
      </div>    


      <div class="tab-contents">
        <div class="sub_table" style="display:flex;">
            <div id="absmenu" style="padding:3px;position:absolute;z-index:1;">
                  <table id="ajaxcat"><tr id="cat"><th>カテゴリ一覧</th></tr>
                      <tr>
                        <td><input type="button" class="cat btn btn-primary btn-sm" style="height:22px;padding:0;" name="99" value="全て"></td>
                      </tr>
                      <tr>
                        <td><input type="button" class="cat btn btn-primary btn-sm" style="height:22px;padding:0;" name="0" value="未分類"></td>
                      </tr>
                    <?php foreach($res[3]->result() as $z):?>
                      <tr><td>
                        <input type="button" class="cat btn btn-primary btn-sm" style="height:22px;padding:0;" name="<?=$z->ID?>" value="<?=$z->z_ctg?>">
                        <button id="del<?=$z->ID?>" type="button" class="btn btn-danger btn-sm del" style="display:none;width:40px;height:22px;padding:0;" value="x" onclick="c_del(this.id)"><span class="material-symbols-outlined">delete_sweep</span></button></td>
                      </tr>
                    <?php endforeach;?>
                    <tr><th style="text-align:center;font-weigth:0;">操作</th></tr>
                    <tr><td><input type="button" id="addCat" class="btn btn-parimary btn-sm" style="height:22px;padding:0;" value="新規追加" onclick="op_adc()"></td></tr>
                    <tr><td style="text-align:-webkit-center;">
                      <div id="c_menu" style="border:1px solid #000080;background-color:#f4f4ff;padding:2px;">
                          <span>Code<input type="text" id="adbz_code" class="form-control" value="" autocomplete="off"></span>
                          <span>品名<input type="text" id="adbz_hm" class="form-control" autocomplete="off"><span>
                          <span>詳細<input type="text" id="adbz_kata" class="form-control" autocomplete="off"></span>
                          <span>カテゴリ<select id="adbz_cat" class="form-select" style="padding:1px;">
                          <?php foreach($res[3]->result() as $z):?>
                          <option value='<?=$z->ID?>'><?=$z->z_ctg?></option>
                        <?php endforeach;?>
                        </select>
                       </span><br>
                          <input type="button" class="btn btn-primary btn-sm" style="width:95%;" style="height:22px;padding:0;" value="追加" onclick="bzadd()">
                      </div>
                    </td></tr>
                    <tr><td><input type="button" id="pop" class="btn btn-parimary btn-sm" value="一括変更" style="height:22px;padding:0;" onclick="op_pop()"></td></tr>
                    <tr><td style="text-align:-webkit-center;">
                      <div id="p_menu" style="background-color:#f4f4ff;padding:2px;">一括変更します。<br>
                        <select id="ck_sel" class="form-select">
                        <?php foreach($res[3]->result() as $z):?>
                          <option value='<?=$z->ID?>'><?=$z->z_ctg?></option>
                        <?php endforeach;?>
                        </select><br>
                        <input type="button" id="ck" class="btn btn-primary btn-sm" style="width:95%;" value="OK" onclick="changecat()">
                      </div>
                    </td></tr>
                    <tr><td><input type="button" id="addCat" class="btn btn-parimary btn-sm" value="カテゴリ追加" style="height:22px;padding:0;" onclick="op_adcat()"></td></tr>
                    <tr><td style="text-align:-webkit-center;">
                      <div id="cat_menu" style="padding:2px;">カテゴリ追加<br>
                              <input type="text" id="adcat" class="form-control"><br>
                              <input type="button" class="btn btn-primary btn-sm" style="width:95%;height:22px;padding:0;" value="追加" onclick="catadd()">
                      </div>
                    </td></tr>
                    <tr><td><input type="button" id="opdel" class="btn btn-danger btn-sm" value="カテゴリ削除" style="height:22px;padding:0;" onclick="op_del()"></td></tr>
                    <tr><td style="text-align:center;font-weight:100;">検索</td></tr>
                    <tr><td><input id="z_sc" type="text" class="form-control" style="width:200px;" placeholder=""></td></tr>
                  </table>
            </div>
                      
              

            <div class="zairyou" style="position:relative;padding:0 0 0 217px;font-size:0.7rem;">
                          <div id="zaiko_pannel" style="display:none;z-index:23;position:absolute;padding:10px;top:68px;left:35%;width: 500px;background: #b9d4eb;text-align:center;box-shadow:0 0 4px;">
                            <div style="display:flex;"><span style="width:80px;">Code</span><input class="form-control" style="margin-left:-11px;width:100px;padding:0;font-size:12px;" value="1015"><span style="width:80px;">在庫数</span><input class="form-control" style="width:100px;padding:0;font-size:12px;" value="800"><input type="button" class="btn btn-primary btn-sm" style="height:23px;margin-left:86px;padding:0 8px;" value="発注"></div>
                            <div style="display:flex;"><span style="width:80px;">項目</span><input class="form-control" style="padding:0;font-size:12px;" value="みかん"></div>
                            <div style="display:flex;"><span style="width:80px;">詳細</span><input class="form-control" style="padding:0;font-size:12px;" value="蜜柑"></div>
                              <hr>
                              <label>入出庫<label><select class="form-select" style="padding: 0;width: 65px;margin-left: 402px;font-size: 12px;">
                                                        <option value="2020">2020</option></select>
                              <table style="width:100%;">
                                <tr><th>繰越</th><th>日付</th><th>取引先</th><th>入庫</th><th>出庫</th><th>合計</th></tr>
                                <?php foreach($res[6]->result() as $zk):?>
                                  <tr style="border-bottom:1px solid #000;"><td><?=number_format($zk->z_mae)?></td><td><?=date('Y/m/d',strtotime($zk->z_day))?></td><td><a href="jutyu?id=fs20-6"><?=$zk->z_saki?></a></td><td><?=number_format($zk->z_iri)?></td><td><?=number_format($zk->z_de)?></td><td><?=number_format($zk->z_kei)?></td><tr>
                                
                                <?php endforeach;?>
                                
                        </table>
                        </div>
              <table id="ajaxreload">
                <tr><th></th><th style="width:58px;">Code</th><th>項目</th><th>詳細</th><th style="width:70px;">カテゴリ</th><th>単価</th><th style="width:70px;">在庫</th><th style="width:15px;"></th><th style="width:15px;"></th></tr>
              <?php foreach($res[1]->result() as $z):?>
                  <tr id="z<?=$z->z_ID?>" class="ck_cat cat<?=$z->z_cat?>">
                    <td><input id="ck<?=$z->z_ID?>" type="checkbox" class="z_ck"></td>
                    <td><input id="code<?=$z->z_ID?>" type="text" class="form-control bz" value="<?=$z->code?>"></td>
                    <td style="position:relative;">
                      <div class="shiire" style="position:absolute;padding:10px;background:rgb(185, 212, 235);border:1px solid;display:none;z-index:1;">
                        <table style="width:250px;"><tr><th colspan="3"><?=$z->z_mat." ".$z->kata?></th></tr><tr><th style="width:50px;">#</th><th>仕入先</th><th>仕入値</th></tr><tr><td><input class="form-control" style="text-align:right;padding-right:5px;" value="1"></td><td><input class="form-control" value="朝日"></td><td><input class="form-control" style="text-align:right;padding-right:5px;" value="1,938"></td></tr>
                        <tr><td><input class="form-control" style="text-align:right;padding-right:5px;" value="2"></td><td><input class="form-control" value="ミスミ"></td><td><input class="form-control" style="text-align:right;padding-right:5px;" value="2,059"></td></tr><tr><td><input class="form-control" style="text-align:right;padding-right:5px;" value="3"></td><td><input class="form-control" value="大山"></td><td><input class="form-control" style="text-align:right;padding-right:5px;" value="2,239"></td></tr>
                        </table>
                      </div>
                      <input id="zmat<?=$z->z_ID?>" type="text" class="form-control bz" style="background:rgba(185, 212, 235,0.1);" value="<?=$z->z_mat?>"></td>   
                    <td><input id="kata<?=$z->z_ID?>" type="text" class="form-control bz" value="<?=$z->kata?>"></td>
                    <td><select id="sel<?=$z->z_ID?>" class="form-select" onchange="mat_up(this.id,this.value)">
                    <option value="-">-</option>

                      <?php foreach($res[3]->result() as $zc){
                        if($z->z_cat===$zc->ID){
                          echo '<option value="'.$zc->ID.'" selected>'.$zc->z_ctg.'</option>';
                        }else{
                          echo '<option value="'.$zc->ID.'">'.$zc->z_ctg.'</option>';
                        }
                      }?>
                    </select></td>
                    <td><input class="form-control" value="<?=$z->tanka?>" style="text-align:right"></td>
                    <td><input type="text" class="form-control z_zk" style="text-align:right;" value="<?=number_format($z->zan)?>"></td>
                    <td style="padding:0;">
                    <input type="button" id="zk<?=$z->z_ID?>" class="btn btn-primary btn-sm zaiko" style="width:40px;height:22px;padding:0;" value="在庫" onclick="zaiko(this.id)">
                    </td><td style="padding:0;">
                    <button type="button" id="del<?=$z->z_ID?>" class="btn btn-danger btn-sm" style="width:30px;height:22px;padding:0;" value="x" onclick="z_del(this.id)"><span class="material-symbols-outlined">delete_sweep</span></button>
                    </td>
                  </tr>
                <?php endforeach;?>
              </table>
            </div>
        </div>
      </div>


      <div class="tab-contents">
        <div class="sub_table" style="display:flex;">
                    <div id="kt_menu" style="position:absolute;">
                    <table id="ajaxktcat"><tr><th>カテゴリ一覧</th></tr>
                      <tr><td><input type="button" class="btn btn-primary btn-sm fil" style="height:22px;padding:0;" name="99" value="全て"></td></tr>

                        <?php foreach($res[7]->result() as $v){
                          
                          echo '<tr><td><input type="button" class="btn btn-primary btn-sm fil" style="height:22px;padding:0;" name="'.$v->g_cat.'" value="'.$v->g_cat_name.'">
                                <button id="kdel'.$v->id.'" type="button" class="btn btn-danger btn-sm kdel" style="display:none;width:40px;height:22px;padding:0;" value="x" onclick="c_del(this.id)"><span class="material-symbols-outlined">delete_sweep</span></button></td>
                                </td></tr>';
                        }
                        ?>
                        <tr><td style="text-align:center;font-weight:100;">操作</td></tr>
                        <tr><td><input type="button" id="np" class="btn btn-primary btn-sm" value="新規追加" style="height:22px;padding:0;" onclick="opn_pop()"></td></tr>
                        <tr><td style="text-align:center;"><div id="new">新規追加<br>
                            <label>表記<input type="text" id="kos" class="form-control" placeholder="略称"></label><br>
                            <label>工程<input type="text" id="koutei" class="form-control" placeholder="工事名"></label><br>
                            <label>カテゴリ<select id="kt_cat" class="form-control" style="width:188px;" onchange="ch_kt(this.id,this.value)">
                              <?php foreach($res[7]->result() as $v){
                                echo '<option value="'.$v->g_cat.'">'.$v->g_cat_name.'</option>';
                              }?>
                            </select>
                            </label>
                                <br>
                                <input type="button" class="btn btn-primary btn-sm" value="追加" onclick="new_go()">
                                </div>
                        </td></tr>
                        <tr><td><input type="button" id="ktp" class="btn btn-primary btn-sm" value="一括変更" style="height:22px;padding:0;" onclick="opkt_pop()"></td></tr>
                        <tr><td style="text-align:center;"><div id="kt_pop">一括変更します<br>
                                <select id="iksel" class="form-control">
                                <?php foreach($res[7]->result() as $v){
                                  echo '<option value="'.$v->g_cat.'">'.$v->g_cat_name.'</option>';
                                  }?>
                                </select>
                                <br>
                                <input type="button" class="btn btn-primary btn-sm" value="変更" onclick="ct_cat()">
                                </div>
                        </td></tr>
                        <tr><td><input type="button" id="kaddCat" class="btn btn-parimary btn-sm" style="height:22px;padding:0;" value="カテゴリ追加" onclick="op_kadcat()"></td></tr>
                        <tr><td style="text-align:center;">
                            <div id="k_menu" style="display:none;background-color:#f4f4ff;padding:2px;width:200px;">カテゴリ追加<br>
                              <input type="text" id="kadcat" class="form-control" placeholder="カテゴリ名"><br>
                              <input type="button" class="btn btn-primary btn-sm" style="width:95%;" value="追加" onclick="kcatadd()">
                            </div>
                        </td></tr>
                        <tr><td><input type="button" id="kd_btn" class="btn btn-danger btn-sm" value="カテゴリ削除" style="height:22px;padding:0;" onclick="kop_del()"></td></tr>
                        <tr><td style="text-align:center;font-weight:100;">検索</td></tr>
                        <tr><td><input type="text" class="form-control sc" style="width:200px;" placeholder="工程" onchange="search(this.value)"></td></tr>
                      </table>
                    </div>
                    <div id="kt_ajax" style="padding-left:220px;">
                      <table id="ktajaxreload">
                        <tr>
                          <th></th><th style="width:80px;">表記</th><th>工程</th><th>カテゴリ</th><th>初期担当</th><th></th>
                        </tr>
                            <?php foreach($res[2]->result() as $k):?>
                              <tr id="tr<?=$k->kt_id?>" class="ck_k kt<?=$k->k_cat?>">
                                <td><input id="<?=$k->kt_id?>" type="checkbox" class="ck_kt"></td>
                                <td><input type="text" class="form-control" value="<?=$k->k_sinbol?>"></td>
                                <td><input type="text" class="form-control skt" value="<?=$k->k_name?>"></td>
                                <td><select id="sel_kt<?=$k->kt_id?>" class="form-select kt_cat" style="height:24px;">
                                  <option value="-">-</option>
                                    <?php 
                                      foreach($res[7]->result() as $id){
                                        if($k->k_cat==$id->g_cat){
                                          echo '<option value="'.$id->g_cat.'" selected>'.$id->g_cat_name.'</option>';
                                        }else{
                                          echo '<option value="'.$id->g_cat.'">'.$id->g_cat_name.'</option>';  
                                        }
                                      }
                                    ?>
                                    </select>
                                </td>

                                <td>
                                <input id="set_gai<?=$k->kt_id?>" type="text" class="form-control d_list kt_tan" list="gai_data<?=$k->kt_id?>" style="width:150px;" value="<?=$k->g_name?>" onchange="set_kt(this.id,this.value)">
                                <datalist id="gai_data<?=$k->kt_id?>">
                                  <?php foreach($res[0]->result() as $sg):?>                                   
                                        <option value="<?=$sg->g_name?>" label="<?=$sg->g_symb?>"></option>
                                  <?php endforeach;?>
                                </datalist>
                                </td>

                                <td><button type="button" id="kt_del<?=$k->kt_id?>" class="btn btn-danger btn-sm delt" style="width:auto;height:23px;padding:0;" onclick="del_kt(this.id)"><span class="material-symbols-outlined">delete_sweep</span></button></td>
                              </tr>
                            <?php endforeach;?>
                      </table>
                    </div>
        </div>
      </div>
</div>      

      <script src="../js/jquery.autoKana.js"></script>
          <script>
          $(document).ready(function(){
            $.fn.autoKana('#uname', '#uname-kana', {katakana:false});
          });
          </script> 
      <script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
      <script type="text/javascript" src="../js/menu.js"></script>
      <script type="text/javascript" src="../js/tabmenu.js"></script>

  </body>

</html>