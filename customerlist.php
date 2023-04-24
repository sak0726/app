<!DOCTYPE html>
<?php
        $this->load->database('t');
?>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../cbox/colorbox.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>受注登録</title>

</head>
<body>
<div id="wrap">
    <div id="inner">
      <div id="sideWrap">
        <div style="position:relative;">    
            <div class="sideMenu">
              <p style="margin-bottom:10px;">顧客リスト</p>
              <a href="menu"><button type="button" class="btn btn-primary btn-sm cos-sm-2">TOP</button></a>
              <a href="jutyu"><button type="button" class="btn btn-primary btn-sm cos-sm-2">注文登録</button></a>
              <a href="kanri"><button type="button" class="btn btn-primary btn-sm cos-sm-2">受注一覧</button></a>
              <a href="customer"><button type="button" class="btn btn-primary btn-sm cos-sm-2">顧客</button></a>
              <a href="gai"><button type="button" class="btn btn-primary btn-sm cos-sm-2">外注</button></a>
              <a><button type="button" id="opm" class="btn btn-primary btn-sm">設定</button></a>
                <div id="subMenu">
                    <ul>
                        <li><a href="customer">顧客</a></li>
                        <li><a class="if85" href="jisya">自社</a></li>
                    </ul>
                </div>
              <button class="btn btn-primary btn-sm cos-sm-2" onClick="history.back()" style="width:100%;">戻る</button>
              <button class="btn btn-primary btn-sm cos-sm-2" id="out" style="width:100%;">ログアウト</button>
            </div>
        </div>
      </div>
      <div id="mainWrap">
        <div class="container" style="margin:10px 5px;">
              <input type="botton" id="allop" class="btn btn-primary btn-sm" value="open">
              <input type="botton" id="bt-clear" class="btn btn-primary btn-sm" value="クリア">
              <a href="customer?new" class="if85"><input type="button" class="btn btn-primary btn-sm" value="新規"></a>
              <input type="text" id="search-text" class="form-control" style="display:inline;width:200px;" placeholder="検索">
        </div>

          <div class="targetArea">
          <div class='row' style="text-align:center;border-bottom:1px solid #000;width:95%;margin:auto;margin-top:10px;">
            <div class="col-sm-1">記号</div><div class="col-sm-4">社名</div><div class="col-sm-6">住所</div><div class="col-sm-1"></div>
          </div>
            <?php
              if(!isset($res)){
                header('Location:customer?new');
                exit();
              }else{
              $i=0;
                foreach($res->result() as $c){
                  $i++;
                  $id=$c->c_id;
                  print "
                  <div class='list' style='margin:0px 10px 0px;'>
                    <div id=\"area$i\" style=\"position:relative;\"></div>
                    <div class='row' id='ar$i' style='height:25px;'>
                      <div class=\"col-sm-1\">".$c->c_sy."</div><div class='col-sm-4'>".$c->c_name."</div>"
                      ."<div class=\"col-sm-6\">〒".substr($c->c_zip,0,3)."-".substr($c->c_zip,3,6)." ".$c->c_add."</div>
                      <div id=\"acd$i\" class=\"sw col-sm-1 sw\" style=\"text-align:left;font-size:20px;\">"."＋"
                      ."</div>
                    </div>
                    <hr style='border:0;height:1px;box-shadow:0 12px 12px -12px rgba(0,0,0,0.5) inset;'>

                    <div class='row justify-content-center'>
                        <div id=\"seg$i\" class=\"cont col-sm-8 col-sm-offset-1\" style='box-shadow:0 0 5px #000,0 0 5px lavender inset;margin-bottom:5px;'>
                            会社名 : <a class='if85' href=customer?id=".$id." id='cm$id'>".$c->c_name."</a>  記号 : ".$c->c_sy."<span style='font-size:12px;margin-bottom:5px;'>"." ".$c->c_busyo."</span>
                            <span style='float:right'><input type='button' style='margin-top:-5px;font-size:12px;' class='btn btn-primary btn-sm' id='meisai".$id."' value='注文一覧'></span>
                            <hr>
                            担　当 : ".$c->c_tan;
                            if(!empty($c->c_tan)){
                              echo "　様";
                            }
                            echo "<br>
                            <hr>
                            電　話 : ".$c->c_tel." FAX : ".$c->c_fax."<br><hr>住　所 :〒".substr($c->c_zip,0,3)."-".substr($c->c_zip,3,6).$c->c_add."<br><hr>
                        </div>
                    </div>
                    </div>
                  <script>
                  $('#ar$i').click(function(){
                      var id = document.getElementById('acd$i');
                      id.innerHTML == '＋' ? id.innerHTML = '－' : id.innerHTML='＋';
                      $('#seg$i').slideToggle('fast');
                      //$(this).next('.cont').slideToggle();
                      //$('.sw').not($(this)).next('.cont').slideUp('fast');
                  
                  });
                  $('#meisai$id').click(function(){
                    location.href='history?id=$id';
                  });
                  
                  </script>
                  ";
                }
            }
            ?>
          </div><!--targetarea-->

      </div><!--mainWap-->
    </div><!--inner-->
</div><!--wrap-->

  <script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
  <script type="text/javascript" src="../js/menu.js"></script>
  <script type="text/javascript" src="../js/list.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function(){
        $(".if85").colorbox({iframe:true, width:"850px", height:"600px"});
    });
  </script>
</body>
</html>