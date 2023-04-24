
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script type="text/javascript" src="../js/jquery.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../cbox/colorbox.css">
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <title>外注管理</title>
</head>
  <body style="width:850px;">
    <div class="wrap">
            <div class="form-inline" style="margin:5px 0 5px 21px;">
                <input type="button" id="allop" class="btn btn-primary btn-sm" value="展開">
                <input type="text" id="sechg" class="form-control" style="display:inline;width:200px;" placeholder="検索" onkeyUp="dis(this.value)">
                <input type="button" id="bt-clear" class="btn btn-primary btn-sm" value="クリア" disabled>
                <input type="button" class="if78 btn btn-primary btn-sm" href="gai?new" value="新規">
            </div>

                <div class="targetArea" style="">   
                
                  <?php
                    $id="";
                    if(!isset($res)){
                      header('Location:gaityu');
                      exit();
                    }else{
                    $i=0;
                    
                      foreach($res->result() as $c){
                        $i++;
                        $id=$c->g_symb;
                        $tel=substr($c->g_tel,0,4)."-".substr($c->g_tel,4,2)."-".substr($c->g_tel,6,4);
                        $fax=substr($c->g_fax,0,4)."-".substr($c->g_fax,4,2)."-".substr($c->g_fax,6,4);

                        print "
                        <div class='list' style='margin:0px 10px 0px;'>
                          <hr>
                          <div id=\"area$i\" style=\"position:relative;\">
                            <div id='ar$i' class='row'>
                              <div class=\"col-sm-2\">".$c->g_name."</div>
                              <div class=\"col-sm-5\">".$c->g_add."</div>
                              <div class='form-inline col-sm-3'>";
                                if($c->g_cat==='0'){
                                  echo "<label for='kakou'>加工</label><input type='checkbox' id='kakou' name='".$id."' value='0' checked onclick='cat(this)'>
                                        <label for='syori'>処理</label><input type='checkbox' id='syori' name='".$id."' value='1' onclick='cat(this)'>
                                        <label for='zai'>材料</label><input type='checkbox' id='zai' name='".$id."' value='2' onclick='cat(this)'>";
                                }elseif($c->g_cat==='10'){
                                  echo "<label for='kakou'>加工</label><input type='checkbox' id='kakou' name='".$id."' value='0' checked onclick='cat(this)'>
                                        <label for='syori'>処理</label><input type='checkbox' id='syori' name='".$id."' value='1' checked onclick='cat(this)'>
                                        <label for='zai'>材料</label><input type='checkbox' id='zai' name='".$id."' value='2' onclick='cat(this)'>";
                                }elseif($c->g_cat==='1'){
                                  echo "<label for='kakou'>加工</label><input type='checkbox' id='kakou' name='".$id."' value='0' onclick='cat(this)'>
                                        <label for='syori'>処理</label><input type='checkbox' id='syori' name='".$id."' value='1' checked onclick='cat(this)'>
                                        <label for='zai'>材料</label><input type='checkbox' id='zai' name='".$id."' value='2' onclick='cat(this)'>";
                                }elseif($c->g_cat==='3'){
                                  echo "<label for='kakou'>加工</label><input type='checkbox' id='kakou' name='".$id."' value='0' onclick='cat(this)'>
                                        <label for='syori'>処理</label><input type='checkbox' id='syori' name='".$id."' value='1'  onclick='cat(this)'>
                                        <label for='zai'>材料</label><input type='checkbox' id='zai' name='".$id."' value='2' checked onclick='cat(this)'>";
                                }else{
                                  echo "<label for='kakou'>加工</label><input type='checkbox' id='kakou' name='".$id."' value='0' checked onclick='cat(this)'>
                                        <label for='syori'>処理</label><input type='checkbox' id='syori' name='".$id."' value='1' checked  onclick='cat(this)'>
                                        <label for='zai'>材料</label><input type='checkbox' id='zai' name='".$id."' value='2' checked onclick='cat(this)'>";
                                }
                                  echo "</div>
                                <div id=\"acd$i\" class='sw col-sm-1 col-sm-offset-1 sw\" style=\"text-align:left;font-size:20px;' click='openSeg(this.id)'>"."＋"."</div>
                            </div>

                            <div class=\"row\">
                                <div id=\"seg$i\" class=\"cont col-sm-8 col-sm-offset-1\" style='box-shadow:0 0 5px #000,0 0 5px lavender inset;margin-bottom:5px;'>
                                    会社名 : <a class='if78' href=gai?id=".$id." id='cm$id'>".$c->g_seisyou."</a><span style='font-size:12px;margin-bottom:5px;'></span>
                                    <hr>
                                    担　当 : ".$c->g_tantou;
                                    if(!empty($c->g_tantou)){
                                      echo "　様";
                                    }
                                    echo "<br>
                                    <hr>
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
                        </div>

                          <script>
                            $('#acd$i').click(function(){
                                var id = document.getElementById('acd$i');
                                id.innerHTML == '＋' ? id.innerHTML = '－' : id.innerHTML='＋';
                                $('#seg$i').slideToggle('fast');                            
                            });
        
                            $('#meisai$id').click(function(){
                              location.href='history?id=$id';
                            });
                            
                          </script>";}
                    } 

                  ?>
                </div><!--tagetarea-->
    </div><!--wrap-->

      <script>
        $(document).ready(function(){
            $(".if75").colorbox({iframe:true, width:"710px", height:"500px"});
            $(".if78").colorbox({iframe:true, width:"750px", height:"800px"});
        });
      </script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="../js/menu.js"></script>
        <script type="text/javascript" src="../js/list.js"></script>

  </body>

</html>