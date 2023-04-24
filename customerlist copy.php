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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../cbox/colorbox.css">
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <title>顧客一覧</title>
</head>
<body>
<div id="wrap">
<div id="inner">
        <div id="sideWrap">
          <div style="position:relative;">    
            <h3 style="text-align:left;margin-bottom:10px;">顧客リスト</h3>
              <div class="sideMenu">
                <a href="menu"><button type="button" class="btn btn-xs cos-sm-2">TOP</button></a>
                <a href="m_mitsu"><button type="button" class="btn btn-xs cos-sm-2">注文登録</button></a>
                <a href="history"><button type="button" class="btn btn-xs cos-sm-2">履歴</button></a>
                <a href="customer"><button type="button" class="btn btn-xs cos-sm-2">顧客</button></a>
                <a href="gai"><button type="button" class="btn btn-xs cos-sm-2">外注</button></a>
                <a><button type="button" id="opm" class="btn btn-xs">設定</button></a>
                  <div id="subMenu">
                      <ul>
                          <li><a class="iframe" href="thick">板厚</a></li>
                          <li><a href="frice_p">加工賃</a></li>
                          <li><a href="material">材料設定</a></li>
                          <li><a href="customer">顧客</a></li>
                          <li><a class="if85" href="jisya">自社</a></li>
                      </ul>
                  </div>
                <button class="btn btn-xs cos-sm-2" onClick="history.back()" style="width:100%;">戻る</button>
                <button class="btn btn-xs cos-sm-2" id="out" style="width:100%;">ログアウト</button>
              </div>
          </div>
        </div>
    
    
        <div id="mainWrap">
          <form action="update" method="post">

            <div class="container">
              <div class="row">
                <div class="col-sm-2"><button type="button" id="allop" class="btn btn-primary">open</button></div>
                <div class="col-sm-2"><button type="button" id="bt-clear" class="btn btn-primary">クリア</button></div>
                <div class="col-sm-2"><a href="customer?new" class="if85"><input type="button" class="btn btn-primary" value="新規"></a></div>
                <div class="col-sm-3"><input type="text" id="search-text" class="form-control" placeholder="検索"></div>

              </div>
            </div>

            <div id="calarea">
              <div class="targetArea">   
              
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
                      <hr style='border:0;height:1px;box-shadow:0 12px 12px -12px rgba(0,0,0,0.5) inset;'>

                        <div id=\"area$i\" style=\"position:relative;\"></div>
                        <div class='row' id='ar$i'>
                          <div class=\"col-sm-4\">".$c->c_name."  : ".$c->c_sy."</div>"
                          ."<div class=\"col-sm-6\">〒".substr($c->c_zip,0,3)."-".substr($c->c_zip,3,6)." ".$c->c_add."</div>
                          <div id=\"acd$i\" class=\"sw col-sm-1 col-sm-offset-1 sw\" style=\"text-align:left;font-size:20px;\">"."＋"
                          ."</div>
                        </div>
                      
                        <div class='row justify-content-center'>
                            <div id=\"seg$i\" class=\"cont col-sm-8 col-sm-offset-1\" style='box-shadow:0 0 5px #000,0 0 5px lavender inset;margin-bottom:5px;'>
                                会社名 : <a class='if85' href=customer?id=".$id." id='cm$id'>".$c->c_name."</a>  記号 : ".$c->c_sy."<span style='font-size:12px;margin-bottom:5px;'>"." ".$c->c_busyo."</span>
                                <span style='float:right'><buton type='button' style='margin-top:-5px;' class='btn btn-outline-info btn-sm' id='meisai".$id."'>注文一覧</button></span>
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

            </div><!--clarea-->
                
        </div><!--mainWap-->
  </div>
  </div><!--wrap-->

  <script type="text/javascript" src="../js/jquery.colorbox-ja.js"></script>
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