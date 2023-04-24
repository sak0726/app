<?php
    $this->load->database('t');


?>

<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="../js/jquery.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/tabmenu.css">
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
  <title>外注登録</title>
</head>
<body style="width:700px;font-weight:100;">
<div class="wrap">
  <?php if(isset($list)):?>
      <?php foreach($list->result() as $val):?>
        <?php $tel=$val->g_tel;
              $fax=$val->g_fax;
        ?>
          <form action="g_update" method="post">
          <input id="catg" type="hidden" name="catg" value="<?=$val->g_cat?>">
            <input id="g_id" name="g_id" type="hidden" value="<?php echo $val->ID?>">
            <div id="c_form" style="width:700px;overflow:hidden;">   
              <input type="hidden" name="reply_post_id" value="" />
                <dl>
                    <div style="margin-top:10px;font-weight:normal;">外注登録</div><hr style="margin-bottom:10px;">
                    <dt class="row">  
                        <label for="uname" class="col col-sm-9">会社名<span style="font-size:10px;color:red;">※必須</span></label><label for="g_symb" class="col" style="">記号<span style="font-size:10px;color:red;">※必須</span></label>
                        <input type="text" class="col col-sm-9 form-control" style="width:500px;margin:0 10px;" name="name" id="uname" value="<?php echo $val->g_seisyou;?>" required="required" autocomplete="off">
                        <input type="text" class="col col-sm-1 form-control" style="width:100px;margin-left:12px;" name="g_symb" id="g_symb" value="<?php echo $val->g_symb;?>" required="required" autocomplete="off">
                    </dt>

                    <dt class="row">
                      <label class="col-sm-2" for="yobina" style="margin-right:27px;">社内呼称<span style="font-size:10px;color:red;">※必須</span></label>
                      <label class="col-sm-2" style="width:150px;" for="tantou">担当</label>
                      <label class="col" for="busyo">部署</label>
                    </dt>
                    <dt class="row">
                      <input type="text" class="form-control" style="margin:0 10px;width:128px;" name="yobina" id="yobina" placeholder="" value="<?php echo $val->g_name;?>" autocomplete="off">
                      <input type="text" id="tantou" class="form-control" style="margin-right:10px;width:128px;" name="tantou" value="<?php echo $val->g_tantou;?>" autocomplete="off">
                      <input type="text" id="busyo" class="form-control" style="width:213px;margin:0 10px;" name="busyo" placeholder="" value="<?php echo $val->g_busyo;?>" autocomplete="off">
                    </dt>
                    <dt class="row">
                    <dt class="row"><label class="col" for="tel" >電話番号</label><label class="col" for="fax">ファックス番号</label></dt>
                      <dt class="row">
                        <input type="tel" id="tel" class="col form-control" name="tel" placeholder="0123456789" style="margin:0 10px;" value="<?php echo substr($tel,0,4)."-".substr($tel,4,2)."-".substr($tel,6,4);?>" autocomplete="off">
                        <input type="tel" id="fax" class="col form-control" name="fax" placeholder="0123456789" style="margin-right:10px;" value="<?php echo substr($fax,0,4)."-".substr($fax,4,2)."-".substr($fax,6,4);?>" autocomplete="off">
                      </dt>
                      <dt class="row"><label class="col-sm-12" for="mail">メール</label>
                        <input type="mail" id="mail" class="col-sm-2 form-control" style="width:400px;margin:0 10px;" name="mail" placeholder="" value="<?php echo $val->g_mail;?>" autocomplete="off">
                      </dt>
                    <dt class="row"><label class="col-sm-12" for="post">郵便番号(数字7ケタ)</label>
                      <input type="number" id="post" class="col-sm-2 form-control" style="width:200px;margin:0 10px;" name="postCode" placeholder="1234567" value="<?php echo $val->g_yubin;?>" onChange="AjaxZip3.zip2addr(this,'','address','address');" autocomplete="off">
                    </dt>

                    <dt class="row"><label class="col-sm-12" for="add">住所</label>
                      <textarea name="address" id="add" class="col-sm-2 form-control" style="width:400px;margin:0 10px;" rows="2"><?=$val->g_add;?></textarea>
                    </dt>
                    <dt class="row"><label class="col-sm-12" for="koza">口座</label>
                      <input type="text" id="koza" class="col-sm-2 form-control" style="width:400px;margin:0 10px;" name="koza" placeholder="" value="<?=$val->g_kouza;?>" autocomplete="off">
                    </dt>
                      
                    <dt class="row"><label class="col" for="kaizan">買掛残高</label></dt>
                    <dt class="row" style="margin-bottom:5px;">
                        <input type="text" id="kaizan" class="col-sm-1 form-control" style="margin:0px 10px;width:220px;" name="kaizan" value="<?=$val->g_kaizan;?>">
                    </dt>
                    
                    <dt class="row">
                        <label class="col" for="tori">取引条件</label>
                        <label class="col" for="harai">支払条件</label>
                        <label class="col" for="tesuryou">手数料</label>
                      </dt>
                      <dt class="row">
                        <select id="tori" class="col form-select" style="margin:0 10px;" name="tori">
                        <option value="-">-</option>
                        <?php foreach($jouken[0]->result() as $j){
                                if($val->g_joken===$j->id){
                                  echo '<option value="'.$j->id.'" selected>'.$j->joken.'</option>';
                                }else{
                                  echo '<option value="'.$j->id.'">'.$j->joken.'</option>';
                                }
                              }
                        ?>
                        </select>
                        <select id="harai" class="col form-select" name="harai">
                          <option value="-">-</option>  
                          <?php foreach($jouken[1]->result() as $j){
                                if($val->g_harai===$j->id){
                                  echo '<option value="'.$j->id.'" selected>'.$j->joken.'</option>';
                                }else{
                                  echo '<option value="'.$j->id.'">'.$j->joken.'</option>';
                                }
                              }
                        ?>
                        </select>
                        <select id="tesuryou" class="col form-select" name="te" style="margin:0 10px;">
                          <option value="-">-</option>
                          <?php foreach($jouken[2]->result() as $j){
                                if($val->g_tesuryo===$j->id){
                                  echo '<option value="'.$j->id.'" selected>'.$j->joken.'</option>';
                                }else{
                                  echo '<option value="'.$j->id.'">'.$j->joken.'</option>';
                                }
                              }
                        ?>
                        </select>
                      </dt>

                      
                      <dt class="row" style="margin-top:10px;"><label>ジャンル</label>
                        <div class="col-sm-1" style="text-align:right;">
                        <?php foreach($cat->result() as $ct){
                          echo '<label>'.$ct->g_cat_name.'</label><br>';
                        }?>
                      </div>
                      <div class="col-sm-1">
                          <?php
                            $v=$val->g_cat;
                            $j=0;
                            foreach($cat->result() as $ct){
                              $cn=$ct->g_cat;
                              for($i=0;$i<strlen($v);$i++){
                                if($cn==$v[$i]){$j=1;break;}
                                else{$j=0;}
                              }
                              if($j==1){
                                echo '<input type="checkbox" id="'.$ct->g_cat_colum.'" class="g_cat" style="margin-right:20px;" name="'.$ct->g_cat_colum.'" value="'.$ct->g_cat.'" checked>';
                              }else{
                                echo '<input type="checkbox" id="'.$ct->g_cat_colum.'" class="g_cat" style="margin-right:20px;" name="'.$ct->g_cat_colum.'" value="'.$ct->g_cat.'">';
                              }
                            }
                          ?>
                      </div>
                      
                      <div class="col-sm-2" style="text-align:right;">
                          <label>登録事業者</label><br><label>備考</label>
                      </div>
                      <div class="col-sm-8" style="display:flex;flex-wrap:wrap;height:22px;">
                      <?php if($val->tj_number!=""):?>
                        <input id="tj_check" type="checkbox" style="margin-left:5px;" checked>
                        <input id="tj_number" name="tj_number" class="form-control" style="width:300px;height:22px;margin-left:5px;" value="<?=$val->tj_number?>"><br>
                      <?php else:?>
                        <input id="tj_check" type="checkbox" style="margin-left:5px;">
                        <input id="tj_number" name="tj_number" class="form-control" style="width:300px;height:22px;margin-left:5px;" value="" disabled><br>
                      <?php endif;?>

                        <textarea id="bikou" name="mes" class="form-control" style="border-radius:5px;" rows="2" value="<?=$val->g_bikou;?>"></textarea>                     
                      </div>
                </dl>
                <div style="text-align:center;">
                  <input type="button" style="width:80%;" class="col btn-primary btn-sm" value="更新" onclick="submit()">
                  <input type="button" style="width:80%;" class="col btn-danger btn-sm" value="削除" onclick="del()">
                  <input type="button" style="width:80%;margin-top:10px;" class="btn btn-primary btn-sm" id="close" value="閉じる" onclick="g_cbox_close()">
                </div>

            </div>
          </form>
        <?php endforeach;?>

  <?php else:?>

      <form action="g_update" method="post">
      <input id="catg" type="hidden" name="catg" value="4">
      <input name="g_id" type="hidden" value="0">
      <div id="c_form" style="width:700px;overflow:hidden;"> 
      <input type="hidden" name="reply_post_id" value="" />
          <dl>
            <dt style="margin-top:10px;font-weight:100;">外注登録</dt><hr style="margin-bottom:10px;">
            <dt class="row">  
                <label for="uname" class="col col-sm-9">会社名<span style="font-size:10px;color:red;">※必須</span></label><label for="g_symb" class="col" style="">記号<span style="font-size:10px;color:red;">※必須</span></label>
                <input type="text" class="col col-sm-9 form-control" style="width:500px;margin-left:10px;" name="name" id="uname" value="" required="required" autocomplete="off">
                <input type="text" class="col col-sm-1 form-control" style="width:100px;margin-left:22px;" name="g_symb" id="g_symb" value="" required="required" autocomplete="off">
            </dt>
            
            <dt class="row">
              <label class="col col-sm-3" for="yobina" style="margin-right: 10px;">社内呼称<span style="font-size:10px;color:red;">※必須</span></label>
              <label class="col col-sm-3" style="" for="tantou">担当</label><label class="col-sm-3" for="busyo">部署</label>
            </dt>
            <dt class="row">
              <input type="text" class="col col-sm-3 form-control" style="margin:0 10px;width:169px" name="yobina" id="yobina" placeholder="" value="" autocomplete="off">
              <input type="text" id="tantou" class="col col-sm-3 form-control" style="width:169px" name="tantou" value="" autocomplete="off">
              <input type="text" id="busyo" class="col col-sm-3 form-control" style="width:169px;margin:0 10px;" name="busyo" placeholder="" value="" autocomplete="off">
            </dt>
            <dt class="row"><label class="col" for="tel" >電話番号</label><label class="col" for="fax">ファックス番号</label></dt>
              <dt class="row">
                <input type="tel" id="tel" class="col form-control" name="tel" placeholder="0123456789" style="margin:0 10px;" value="" autocomplete="off">
                <input type="tel" id="fax" class="col form-control" name="fax" placeholder="0123456789" style="margin-right:10px;" value="" autocomplete="off">
              </dt>
              <dt class="row"><label class="col-sm-12" for="mail">メール</label>
              <input type="mail" id="mail" class="col-sm-2 form-control" style="width:400px;margin:0 10px;" name="mail" placeholder="" value="" autocomplete="off">
            </dt>
            <dt class="row"><label class="col-sm-12" for="post">郵便番号(数字7ケタ)</label>
              <input type="number" id="post" class="col-sm-2 form-control" style="width:200px;margin:0 10px;" name="postCode" placeholder="1234567" value="" onKeyUp="AjaxZip3.zip2addr(this,'','address','address');" autocomplete="off">
            </dt>

            <dt class="row"><label class="col-sm-12" for="add">住所</label>
              <textarea name="address" id="add" class="col-sm-2 form-control" style="margin-left:10px;width:200px;" rows="2" autocomplete="off"></textarea>
            </dt>
            <dt class="row"><label class="col-sm-12" for="koza">口座</label>
              <input type="text" id="koza" class="col-sm-2 form-control" style="width:400px;margin:0 10px;" name="koza" placeholder="" value="" autocomplete="off">
            </dt>
            <dt class="row">
                <label class="col" for="kaizan">買掛残高</label>
            </dt>
            <dt class="row">
              <input type="text" id="kaizan" class="form-control" style="margin-left:10px;width:200px;" name="kaizan" value="">
            </dt>

              <dt class="row">
                <label class="col" for="tori">取引条件</label>
                <label class="col" for="harai">支払条件</label>
                <label class="col" for="tesuryou">手数料</label>
              </dt>
              <dt class="row">
                <select id="tori" class="col form-control" style="margin:0 10px;" name="tori">
                <option value="-">-</option>
                <?php foreach($jouken[0]->result() as $j){
                          echo '<option value="'.$j->id.'">'.$j->joken.'</option>';
                      }
                ?>
                </select>
                <select id="harai" class="col form-control" style="" name="harai">
                  <option value="-">-</option>  
                  <?php foreach($jouken[1]->result() as $j){
                          echo '<option value="'.$j->id.'">'.$j->joken.'</option>';
                      }
                ?>
                </select>
                <select id="tesuryou" class="col form-control" name="te" style="margin:0 10px;">
                  <option value="-">-</option>
                  <?php foreach($jouken[2]->result() as $j){
                          echo '<option value="'.$j->id.'">'.$j->joken.'</option>';
                      }
                ?>
                </select>
              </dt>
            
                <dt class="row" style="margin-top:10px;"><label>ジャンル</label>
                <div class="col-sm-1" style="text-align:right;">
                <?php foreach($cat->result() as $ct){
                  echo '<label>'.$ct->g_cat_name.'</label><br>';
                }
                ?>
                  </div>
                  <div class="col-sm-1">
                  <?php foreach($cat->result() as $ct){
                    echo '<input type="checkbox" class="g_cat" id="'.$ct->g_cat_colum.'" style="margin-right:20px;" name="'.$ct->g_cat_colum.'" value="'.$ct->g_cat.'">';
                  }?>
                  
                  </div>
                  <div class="col-sm-2" style="text-align:right;">
                          <label for="tj_check">登録事業者</label><br><label for="bikou">備考</label>
                  </div>
                  <div class="col-sm-8" style="display:flex;flex-wrap:wrap;height:22px;">
                      <input id="tj_check" type="checkbox" style="margin-left:5px;">
                      <input id="tj_number" class="form-control" style="width:300px;height:22px;margin-left:5px;" disabled><br>
                      <textarea id="bikou" name="mes" class="form-control" style="border-radius:5px;" rows="2"></textarea>                     
                  </div>
                </dt>                        
          </dl>
      <div style="text-align:center;">
          <input type="button" class="col btn-primary btn-sm" style="width:200px;" value="登録" onclick="jssubmit('g_update')">
      </div>
      </div>
      </form>
      <?php endif;?>
</div>
<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript" src="../js/list.js"></script>
<script type="text/javascript" src="../js/function.js"></script>
<script type="text/javascript" src="../js/jquery.autoKana.js"></script>

</body>
</html>