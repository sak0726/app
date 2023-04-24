<?php
    $this->load->helper('cookie');
    $cookie=get_cookie('name',true);
    if(empty($cookie)){
      //header('Location:/heiwass'); 
    };
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script type="text/javascript" src="../js/jquery.js"></script>
<!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/tabmenu.css">
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <title>顧客登録</title>
</head>
<body style="width:700px;margin:10px;">
<div class="wrap">
<div id="inner">

<div id="mainWraps">
<div id="c_form" style="margin-top:10px;overflow:hidden;scrollbar-gutter: stable;">
<?php if(isset($list)):
    foreach($list->result() as $c):?>
<form action="custupdate" method="post">      
        <input type="hidden" id="cid" name="cid" value="<?php echo $c->c_id;?>">
        <dt class="row">  
                <label for="uname" class="col col-sm-8">顧客名<span style="font-size:10px;color:red;">※必須</span></label><label for="c_sy" class="col" style="">記号<span style="font-size:10px;color:red;">※必須</span><span style="margin-left:25px;"><label for="uname-kana" class="col form-label" style="margin-bottom:0;">法人/個人</label></span></label>
                <input type="text" class="col col-sm-8 form-control" style="width:440px;margin:0 10px;" name="c_name" id="uname" value="<?php echo $c->c_name;?>" required="required">
                <input type="text" class="col col-sm-1 form-control" style="width:80px;margin-left:2px;" name="c_sy" id="c_sy" value="<?php echo $c->c_sy;?>" required="required">
                <select name="c_type" class="col form-select" name="c_type" style="width:80px;margin-left:12px;margin-right:10px;">
                    <?php if($c->c_type==0):?>
                      <option value="0" selected>法人</option>
                      <option value="1">個人</option>
                    <?php else:?>
                    <option value="0">法人</option>
                    <option value="1" selected>個人</option>
                    <?php endif; ?>
                  </select>
        </dt>
        <input type="hidden" name="key" value="1">

            <dt class=" row"><label for="zip" class="col-sm-12">郵便番号(数字7桁)</label>
                <input id="zip" class="col-sm-2 form-control" style="width:90px;margin:0 10px;" type="number" name="postCode" placeholder="1234567" value="<?=$c->c_zip?>" onKeyUp="AjaxZip3.zip2addr(this,'','address','address');">
            </dt>
                        
            <dt class=" row"><label for="add" class="col-sm-12">住所</label>
              <textarea id="add" name="address" class="form-control" style="width:300px;margin:0 10px;" rows="2"><?php echo $c->c_add; ?></textarea>
            </dt>

            <dt class="row"><label for="tel" class="col">電話番号</label><label for="fax" class="col">FAX</label></dt>
              <dt class="row">
                <input type="tel" id="tel" name="tel" placeholder="0123456789" class="col form-control" style="margin:0 10px;width:200px;" value="<?=substr($c->c_tel,0,4)."-".substr($c->c_tel,4,2)."-".substr($c->c_tel,6,4); ?>">
                <input type="tel" id="fax" name="fax" placeholder="0123456789" class="col form-control" style="margin-right:10px;width:200px;" value="<?=substr($c->c_fax,0,4)."-".substr($c->c_fax,4,2)."-".substr($c->c_tel,6,4); ?>">
              </dt>
            
          <dt class="row"><label for="mail"class="col-sm-12">メール</label>
              <input type="mail(info@s-resnance.co.jp)" id="mail" name="mail" class="form-control" style="width:97%;margin-left:10px;" value="<?=$c->c_mail?>" autocomplete="off">
          </dt>
          <dt class="row"><label for="c_mes" class="col-sm-12">備考</label>
              <textarea id="c_mes" name="c_mes" class="form-control" style="width:400px;margin-left:10px;margin-bottom:20px;" rows="2"><?php echo $c->c_bikou; ?></textarea>
            </dt>
            
            <dt id="add_sime" class=" row" style="position:relative;margin-top:3px;font-size:0.8rem;">
              <label for="sime" class="col-sm-2"><span style="margin-left:7px;"><button type="button" class="btn btn-sm btn-primary add_sime" style="height:20px;padding:0 10px;" value="+" data="sime">締日</button></span></label>
              <label for="kai_m" class="col-sm-2"><span style="margin-left:0px;"><button type="button" class="btn btn-sm btn-primary add_sime" style="height:20px;padding:0 10px;" value="回収月" data="kai_m">回収月</button></span></label>
              <label for="kai_d" class="col-sm-2"><span style="margin-left:-6px;"><button type="button" class="btn btn-sm btn-primary add_sime" style="height:20px;padding:0 10px;" value="+" data="kai_d">回収日</button></span></label>
              <label for="kai_cat" class="col-sm-2"><span style="margin-left:-14px;"><button type="button" class="btn btn-sm btn-primary add_sime" style="height:20px;padding:0 10px;" value="+" data="kai_cat">金種類</button></span></label>
              <label for="urizan" class="col-sm-2"><span style="margin-left:2px;">初期売掛残</label>
              <div id="add_panel" style="position:absolute;text-align:center;">
                <label id="al" for="add_label">追加</label><input id="add_label" class="form-control" autocomplete="off">
                <input id="c_jk_add" type="button" class="btn-primary btn-sm" style="margin:5px 0;height:22px;padding:0 5px;" value="追加">
                      <div id="del_cat">削除<br></div>
              </div>
            </dt>

            <dt class="row">
                <select id="sime" name="sime" class="col-sm-2 form-select" style="margin-left:10px;width:100px;">
                <?php foreach($cat->result() as $k):?>
                  <?php 
                  echo $c->c_sime;
                    if($k->catg=='sime'){
                      if($c->c_sime==$k->joken){
                      echo '<option  value="'.$k->joken.'" name="sime" selected>'.$k->joken.'</option>';
                      }else{
                      echo '<option value="'.$k->joken.'" name="sime">'.$k->joken.'</option>';
                      }
                    }
                    ?>
                  <?php endforeach;?>
                </select>
                <select id="kai_m" name="kai_m" class="col-sm-2 form-select" style="margin-left:10px;width:100px;">
                <?php foreach($cat->result() as $k):?>
                  <?php 
                    if($k->catg=='kai_m'){
                      if($c->kai_m==$k->joken){
                      echo '<option  value="'.$k->joken.'" name="" selected>'.$k->joken.'</option>';
                      }else{
                      echo '<option value="'.$k->joken.'" name="">'.$k->joken.'</option>';
                      }
                    }
                    ?>
                  <?php endforeach;?>                
                </select>
                <select id="kai_d" name="kai_d" class="col-sm-2 form-select" style="margin-left:10px;width:100px;">
                <?php foreach($cat->result() as $k):?>
                  <?php 
                    if($k->catg=='kai_d'){
                      if($c->kai_d==$k->joken){
                      echo '<option  value="'.$k->joken.'" name="" selected>'.$k->joken.'</option>';
                      }else{
                      echo '<option value="'.$k->joken.'" name="">'.$k->joken.'</option>';
                      }
                    }
                    ?>
                  <?php endforeach;?>
               </select>
                <select id="kai_cat" name="kai_cat" class="col-sm-2 form-select" style="margin-left:10px;width:100px;">
                <?php foreach($cat->result() as $k):?>
                  <?php 
                    if($k->catg=='kai_cat'){
                      if($c->kai_cat==$k->joken){
                      echo '<option  value="'.$k->joken.'" name="" selected>'.$k->joken.'</option>';
                      }else{
                      echo '<option value="'.$k->joken.'" name="">'.$k->joken.'</option>';
                      }
                    }
                    ?>
                  <?php endforeach;?>                
                </select>
                <input id="urizan" name="urizan" class="col-sm-10 form-control" style="width:150px;margin-left:10px;text-align:right;" value=<?= number_format($c->c_zan); ?>>
              </dt>
        
        <div style="text-align:center;margin:10px 0;">
          <input type="submit" style="width:80%;" class="btn btn-primary btn-sm cust_update" id="update" value="更新" onclick="">
          <input type="button" style="width:80%;" class="btn btn-danger btn-sm cust_update" id="del" value="削除" onclick="cust_update(2)"><br>
          <input type="button" style="width:80%;margin-top:10px;" class="btn btn-primary btn-sm" id="close" value="閉じる" onclick="cbox_close()">
        </div>
        </form>
<?php  endforeach;?>
<?php else:?>
  <div id="c_form" style="margin-top:10px;font-weight:0;font-size:12px;scrollbar-gutter: stable;">
    <form action="update" method="post">   
      <input type="hidden" name="cid" value="" />
      
      <dt class="row">  
                <label for="uname" class="col col-sm-8" style="margin-right:36px;">顧客名<span style="font-size:10px;color:red;">※必須</span></label><label for="uname-kana" class="col form-label" style="margin-bottom:0;">法人/個人</label></span></label>
                <input type="text" class="col col-sm-8 form-control" style="width:440px;margin:0 10px;" name="name" id="uname" value="" required="required">
                <select name="c_type" class="col form-select" style="width:80px;margin-left:12px;margin-right:10px;">
                      <option value="0" selected>法人</option>
                      <option value="1">個人</option>
                  </select>
        </dt>

            <dt class=" row"><label for="zip" class="col-sm-12">郵便番号(数字7桁)</label>
                <input id="zip" class="col-sm-2 form-control" style="width:90px;margin:0 10px;" type="number" name="postCode" placeholder="1234567" value="" onKeyUp="AjaxZip3.zip2addr(this,'','address','address');">
            </dt>
                        
            <dt class=" row"><label for="add" class="col-sm-12">住所</label>
              <textarea id="add" name="address" class="form-control" style="width:300px;margin:0 10px;" rows="2"></textarea>
            </dt>

            <dt class="row"><label for="tel" class="col">電話番号</label><label for="fax" class="col">FAX</label></dt>
              <dt class="row">
                <input type="tel" id="tel" name="tel" placeholder="0123456789" class="col form-control" style="margin:0 10px;width:200px;" value=".">
                <input type="tel" id="fax" name="fax" placeholder="0123456789" class="col form-control" style="margin-right:10px;width:200px;" value="">
              </dt>
            
          <dt class="row"><label for="mail"class="col-sm-12">メール</label>
              <input type="mail" id="mail" name="mail" class="form-control" style="width:97%;margin-left:10px;" value="" autocomplete="off">
          </dt>
          <dt class="row"><label for="c_mes" class="col-sm-12">備考</label>
              <textarea id="c_mes" name="c_mes" class="form-control" style="width:400px;margin-left:10px;margin-bottom:20px;" rows="2"></textarea>
            </dt>

        </div>

                  
        <dt id="add_sime" class=" row" style="position:relative;margin-top:3px;">
        <label for="sime" class="col-sm-2"><span style="margin-left:7px;">
              <span style="margin-left:0px;"><button type="button" class="btn btn-sm btn-primary add_sime" style="height:20px;padding:0 10px;" value="+" data="sime">締日</button></span></label>
              <label for="kai_m" class="col-sm-2"><span style="margin-left:2px;"><button type="button" class="btn btn-sm btn-primary add_sime" style="height:20px;padding:0 10px;" value="回収月" data="kai_m">回収月</button></span></label>
              <label for="kai_d" class="col-sm-2"><span style="margin-left:-2px;"><button type="button" class="btn btn-sm btn-primary add_sime" style="height:20px;padding:0 10px;" value="+" data="kai_d">回収日</button></span></label>
              <label for="kai_cat" class="col-sm-2"><span style="margin-left:-6px;"><button type="button" class="btn btn-sm btn-primary add_sime" style="height:20px;padding:0 10px;" value="+" data="kai_cat">金種類</button></span></label>
              <label for="urizan" class="col-sm-2"><span style="margin-left:2px;">初期売掛残</label>
              <div id="add_panel" style="position:absolute;text-align:center;">
                <label id="al" for="add_label">追加</label><input id="add_label" class="form-control" autocomplete="off">
                <input id="c_jk_add" type="button" class="btn-primary btn-sm" style="margin:5px 0;height:22px;padding:0 5px;" value="追加">
                      <div id="del_cat">削除<br></div>
              </div>
            </dt>

            <dt class="row">
            <select id="sime" name="sime" class="col-sm-2 form-select" style="margin-left:10px;width:100px;">
                <?php foreach($cat->result() as $k):?>
                  <?php 
                  echo $c->c_sime;
                    if($k->catg=='sime'){
                      if($c->c_sime==$k->joken){
                      echo '<option  value="'.$k->joken.'" name="sime" selected>'.$k->joken.'</option>';
                      }else{
                      echo '<option value="'.$k->joken.'" name="sime">'.$k->joken.'</option>';
                      }
                    }
                    ?>
                  <?php endforeach;?>
                </select>
                <select id="kai_m" name="kai_m" class="col-sm-2 form-select" style="margin-left:10px;width:100px;">
                <?php foreach($cat->result() as $k):?>
                  <?php 
                    if($k->catg=='kai_m'){
                      if($c->kai_m==$k->joken){
                      echo '<option  value="'.$k->joken.'" name="" selected>'.$k->joken.'</option>';
                      }else{
                      echo '<option value="'.$k->joken.'" name="">'.$k->joken.'</option>';
                      }
                    }
                    ?>
                  <?php endforeach;?>                
                </select>
                <select id="kai_d" name="kai_d" class="col-sm-2 form-select" style="margin-left:10px;width:100px;">
                <?php foreach($cat->result() as $k):?>
                  <?php 
                    if($k->catg=='kai_d'){
                      if($c->kai_d==$k->joken){
                      echo '<option  value="'.$k->joken.'" name="" selected>'.$k->joken.'</option>';
                      }else{
                      echo '<option value="'.$k->joken.'" name="">'.$k->joken.'</option>';
                      }
                    }
                    ?>
                  <?php endforeach;?>
               </select>
                <select id="kai_cat" name="kai_cat" class="col-sm-2 form-select" style="margin-left:10px;width:100px;">
                <?php foreach($cat->result() as $k):?>
                  <?php 
                    if($k->catg=='kai_cat'){
                      if($c->kai_cat==$k->joken){
                      echo '<option  value="'.$k->joken.'" name="" selected>'.$k->joken.'</option>';
                      }else{
                      echo '<option value="'.$k->joken.'" name="">'.$k->joken.'</option>';
                      }
                    }
                    ?>
                  <?php endforeach;?>                
                </select>
                <input id="urizan" class="col-sm-10 form-control" style="width:150px;margin-left:10px;text-align:right;" value="">
              </dt>
            <div style="text-align:center;margin-top:10px;"><input id="touroku" type="submit" style="height:22px;padding:0;width:223px;" class="btn btn-primary btn-sm" value="登録"></div>
        </form>
    </div>
    <?php endif;?>
</div>
</div>
</div>
  <script type="text/javascript" src="../js/menu.js"></script>
  <script type="text/javascript" src="../js/list.js"></script>
 <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>