<?php
    $this->load->library('session');
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <title>自社登録</title>
</head>
<body style="width:460px;">
<div class="wrap" style="">
<div id="inner">
<div id="">
<form action="jupdate" method="post">
            <div id="c_form" style="position:relative;">
              <div class="update_mes" style="left:128px;">
                <?php if ($list[2]==="update"){
                        echo '<input type="hidden" id="up" value="1">';
                       }else{
                        echo '<input type="hidden" id="up" value="0">';
                       }
                ?>
                更新完了
              </div>
                <div>       
                  <input type="hidden" name="reply_post_id" value="" />
                    <?php if(isset($list[0])):?>
                    <?php foreach($list[0]->result() as $val):?>
                        <dl>
                          <dt><label for="uname" style="width:150px;" >自社名<span style="font-size:10px;color:red;">※必須</span></label>
                            <div class="form-inline"><input type="text" class="form-control" style="width:400px;" name="name" id="uname" value="<?php echo $val->j_name;?>" required></div></dt>
                          <dt><label for="uname-kana" style="width:150px;">よみ</label>
                            <input type="text" class="form-control" name="yomi" id="uname-kana" style="width:400px;" value="<?php echo $val->j_yomi;?>">
                          </dt>
                          <dt style="position:relative;"><label style="width:150px;" >郵便番号(数字7ケタ)</label>
                            <input type="number" class="form-control" name="postCode" style="width:100px;" placeholder="1234567" value="<?php echo $val->j_zip;?>" onKeyUp="AjaxZip3.zip2addr(this,'','city','address');">
                            <div style="box-shadow: 0 0 5px inset #9b9cb5;position:absolute;border:1px solid #b7b7b7;width:100px;height:100px;left:300px;top:10px;padding:32px;background-image:url('../../koumu/img/s_kenchiku.jpg');background-size:99%;background-repeat:no-repeat;background-position: right 51% bottom 42%;">
                            <div style="position:absolute;top: 70px;left: -127px;width: 123px;"><input type="file" class="form-control"></div>
                          </div>
                          </dt>
                          <dt><label style="width:150px;" >都道府県</label>
                            <select name="city" class="form-control" id="kenmei" style="width:100px;" value="<?php echo $val->j_city;?>">
                              <?php
                                $kenmei = array('-','北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
                                '茨城県','栃木県','群馬県', '埼玉県','千葉県', '東京都', '神奈川県','新潟県',' 富山県',
                                '石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県',
                                '京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県',
                                '山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県',
                                '大分県','宮崎県','鹿児島県','沖縄県');
                                for ($i=0; $i < count($kenmei); $i++) {
                                  $attr = $kenmei [$i] == $val->j_city? ' selected' : '';
                                  echo "<option value=".$kenmei[$i].$attr.">".$kenmei[$i]."</option>";
                              }
                              ?>
                          </select>
                          </dt>

                          <dt><label style="width:150px;" >以降の住所</label>
                            <textarea name="address" class="form-control" style="border-radius:2px;width:400px;" rows="3"><?php echo $val->j_add;?></textarea>
                          </dt>

                            <dt style="display:flex;">
                              <label for="tel" class="col-sm-6" style="width:150px;padding:0;" >電話番号</label><label for="fax" class="col-sm-6" style="width:150px;margin-left:44px;" >ファックス番号</label>
                            </dt>
                            <dt style="display:flex;">
                              <input type="tel" class="form-control" name="tel" placeholder="0123456789" style="width:200px;padding:3px;" value="<?php echo $val->j_tel;?>">
                              <input type="tel" class="form-control" name="fax" placeholder="0123456789" style="width:200px;padding:3px;" value="<?php echo $val->j_fax;?>">
                            </dt>

                          <dt><label>口座</label></dt>
                          <dt><input name="kouza" class="form-control" type="text" style="width:400px;font-size:12px;margin-top:0;padding:3px;" value="<?=$val->j_kouza?>"></dt>
                          <dt><input name="kouza2" class="form-control" type="text" style="width:400px;font-size:12px;margin-top:0;padding:3px;" value="<?=$val->j_kouza2?>"></dt>

                          <dt style="margin-top:20px;"><label>登録番号</label></dt>
                          <dt><input name="touroku" class="form-control" type="text" style="width:200px;" value="<?=$val->j_tourokuNum?>"></dt>
                          <div style="display:flex;margin-top:20px;">
                            <label class="col-sm-2">旧消費税</label><label class="col-sm-2" style="margin:0 40px;">新消費税</label><label class="col-sm-2">変更日</label>
                            </div>
                            <div style="display:flex;">
                            <input class="form-control" style="width:50px;" value="8">%<input class="form-control" style="width:50px;margin-left:41px;" value="10">%<input class="form-control" style="margin-left:37px;width:100px;" value="2019/10/01">
                          </div>
                          <div style="display:flex;margin-top:0px;">
                            <label class="col-sm-2">旧軽減税率</label><label class="col-sm-2" style="margin:0 24px 0 24px;">新軽減税率</label><label class="col-sm-2">変更日</label>
                            </div>
                            <div style="display:flex;">
                            <input class="form-control" style="width:50px;" value="">%<input class="form-control" style="width:50px;margin-left:41px;" value="8">%<input class="form-control" style="margin-left:37px;width:100px;" value="2019/10/01">
                          </div>
                         <div style="margin-top:10px;text-align:center;">
                          <input type="button" id="j_upd" class="btn btn-primary btn-sm" value="更新">
                          </div>
                          <div style="margin-top:10px;text-align:center;">
                            <input type="button" id="p_user" class="btn btn-primary btn-sm" value="アカウント">
                          </div>


                      </div>
                      <?php endforeach;?>
                      <?php else:?>
                      <dl>
                          <dt><label for="uname">自社</label><span class="required">※必須</span>
                          <dt><input type="text" class="form-control" style="width:300px;" name="name" id="uname" value="" required></dt>
                          </dt>
                          <dt><label for="uname-kana">よみ</label></dt>
                          <dt><input type="text" class="form-control" name="yomi" style="width:500px;" id="uname-kana"></dt>
                          <dt><label>郵便番号(数字7ケタ)</label></dt>
                          <dt><input type="number" class="form-control" name="postCode" placeholder="1234567" value="" onKeyUp="AjaxZip3.zip2addr(this,'','city','address');">
                          </dt>
                          <dt><label>都道府県</label></dt>
                          <dt><select name="city" class="form-control" id="kenmei" style="border-radius:5px;" value="">
                              <?php
                                $kenmei = array('-','北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
                                '茨城県','栃木県','群馬県', '埼玉県','千葉県', '東京都', '神奈川県','新潟県',' 富山県',
                                '石川県','福井県','山梨県','長野県','岐阜県','静岡県','愛知県','三重県','滋賀県',
                                '京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県',
                                '山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県',
                                '大分県','宮崎県','鹿児島県','沖縄県');
                                foreach($kenmei as $kenmei) {
                                  print('<option value="' . $kenmei . '">' . $kenmei . '</option>');
                                  }
                              ?>
                          </select></dt>
                          <dt><label>以降の住所</label></dt>
                            <textarea name="address" class="form-control" style="border-radius:5px;width:90%;" rows="4"></textarea>
                          <dt class="row">
                            <dt><label for="tel">電話番号</label><label for="fax">ファックス番号</label></dt>
                                </dt>
                          <dt class="row">
                            <dt><input type="tel" class="col form-control" name="tel" placeholder="0123456789" style="width:200px;" value=""></dt>
                            <dt><input type="tel" class="col form-control" name="fax" placeholder="0123456789" style="width:200px;" value=""></dt>
                          </dt>
                          <dt><label>備考</label></dt>
                          <dd>
                          <dt><textarea name="mes" class="form-control" style="border-radius:5px;width:90%;" rows="2"></textarea></dt>
                          </dd>
                          <dd>
                          <dt><label>口座番号</label></dt>
                          <dt><input name="kouza" class="form-control" type="text" style="width:100px;" value=""></dt>
                          <dt><input name="kouza2" class="form-control" type="text" style="width:100px;" value=""></dt>
                          </dd>
                          <dd>
                          <dt><label>登録番号</label></dt>
                          <dt><input name="touroku" class="form-control" type="text" style="width:100px;" value=""></dt>
                          </dd>
                          <dt>消費税</dt>
                          <dt>前回消費税</dt><dt>現在消費税</dt><dt>変更日</dt>
                      </div>
                      <div style="margin-top:10px;text-align:center;">
                        <input type="button" id="j_upd" class="btn btn-primary btn-sm" value="登録">
                      </div>
                      <div style="margin-top:10px;text-align:center;">
                            <input type="button" id="p_user" class="btn btn-primary btn-sm" value="アカウント">
                      </div>
                      <?php endif;?>
                  </div>
            </div>                   
          </form>
  </div>
  </div>
  <div id="user" class="wrap" style="position:relative;">
              <div class="update_mes" style="top:66px;left:133px;">
                更新完了
              </div>
              <div class="form-inline" style="padding:10px;">
                      <div style="display:flex;">
                      <label for="u_name">ユーザー名</label><label for="u_kengen" style="position:absolute;left:230px;">権限</label>
                      </div>
                      <div style="display:flex;">
                      <?php foreach($list[1]->result() as $v):?>
                          <?php if($v->id==$_SESSION['user_id']):?>
                          <input id="u_name" type="text" class="form-control" value="<?=$v->name?>" autocomplete="off">
                          <?php $cat=array([0,"管理者"],[1,'使用者']);?>
                          <select id="u_kengen" class="form-control" disabled>
                          <?php for($i=0;$i<2;$i++){
                                if($v->auth==$cat[$i][0]){
                                  echo '<option value="'.$cat[$i][0].'" selected>'.$cat[$i][1].'</option>';
                                }else{
                                  echo '<option value="'.$cat[$i][0].'">'.$cat[$i][1].'</option>';
                                }
                              }
                          ?>
                            </select>                      
                          </div>
                     
                      <label for="u_pass">パスワード</label><span class="material-symbols-outlined sh">visibility</span>
                      <div style="display:flex;height:28px;">
                        <input type="hidden" name="u_id" value="<?=$_SESSION['user_id']?>">
                        <input id="u_pass" type="password" name="password" class="form-control" style="width:50%;" value="<?=$_SESSION['pass']?>" autocomplete="off">
                        <input type="button" id="user_upd" name="<?=$_SESSION['user_id']?>" class="btn btn-primary btn-sm" value="更新">
                      </div>
                        <?php endif;?>
                  <?php endforeach;?>
                <div class="qes">
                  対象ユーザーの権限を変更します。<br>
                  管理者は全てのコンテンツにアクセス・編集が可能ですが、
                  使用者には一部アクセスが制限されます。<br>
                  ※この権限編集項目は使用者には表示されていません。
                </div>
              </div>
              <?php if($_SESSION['auth']==0):?>
              <div class="form-inline" style="font-weight:100;padding:10px;">
              使用者一覧
                <div style="display:flex;">
                  <label for="n_name">ユーザー名</label><span class="material-symbols-outlined uhp">help</span><label for="n_kengen" style="position:absolute;left:230px;">権限<span class="material-symbols-outlined hp">help</span></label>
                </div>
            
                  <?php foreach($list[1]->result() as $v):?>
                    <?php if($v->id!=$_SESSION['user_id']):?>
                    <div style="display:flex;">
                    <input class="form-control" value="<?=$v->name?>" disabled>
                    <select name="<?=$v->id?>" class="form-control n_kengen">
                      <?php for($i=0;$i<2;$i++){
                        if($v->auth==$cat[$i][0]){
                          echo '<option value="'.$cat[$i][0].'" selected>'.$cat[$i][1].'</option>';
                        }else{
                          echo '<option value="'.$cat[$i][0].'">'.$cat[$i][1].'</option>';
                        }
                      }
                      ?>
                  </select>
                  </div>
                  <?php endif;?>
                  <?php endforeach;?>
                  <div id="uhp">
                    権限のみ変更する事が出来ます。<br>※新規ユーザー追加は開発へお問い合わせ下さい。
                  </div>
                  
              </div>
              <?php endif;?>

  </div>
</div>
  <script type="text/javascript" src="../js/menu.js"></script>
  <script type="text/javascript" src="../js/own.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="../js/jquery.autoKana.js"></script>
  <script>
  $(document).ready(function(){
    $.fn.autoKana('#uname', '#uname-kana', {katakana:false});
  });
  </script> 
</body>
</html>