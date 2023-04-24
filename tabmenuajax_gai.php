<script>
  $(document).ready(function(){
    $(".if75").colorbox({iframe:true, width:"710px", height:"500px"});
    $(".if78").colorbox({iframe:true, width:"750px", height:"800px"});
    $(".if85").colorbox({iframe:true, width:"750px", height:"800px"});
});
</script>

<input type="button" id="remote_button" value="" style="display:none;">  

<div class='row' style="display:flex;text-align:center;border-bottom:1px solid #000080;margin:auto;margin-top:10px;font-size:12px;">
  <div class="col-sm-1">記号</div><div class="col-sm-1">呼称</div><div class="col-sm-5">社名/住所</div><div class="col-sm-5">カテゴリ</div><div class="col-sm-1"></div>
</div>
  <?php
    $id="";
    if(!isset($gai[0])){
      header('Location:menu');
      exit();
    }else{
    $i=0;
    
      foreach($gai[0]->result() as $c){
        $i++;
        $id=$c->g_symb;
        $tel=substr($c->g_tel,0,4)."-".substr($c->g_tel,4,2)."-".substr($c->g_tel,6,4);
        $fax=substr($c->g_fax,0,4)."-".substr($c->g_fax,4,2)."-".substr($c->g_fax,6,4);

        print "
        <div id='gai_list' class='list' style='margin:0px 10px 0px;'>
          <div id=\"area$i\" class='fil' style=\"position:relative;\">
          <hr>
            <div id='ar$i' class='row'>
              <div class=\"col-sm-1\">".$id."</div>
              <div class=\"col-sm-1\">".$c->g_name."</div>
              <div class=\"col-sm-5\">".$c->g_seisyou."<br>".$c->g_add."</div>
              <div class=\"form-inline col-sm-4\">";
              foreach($gai[1]->result() as $g){

                if(strpos($c->g_cat,$g->g_cat)!==false){
                  echo '<label for='.$g->g_cat_name.'>'.$g->g_cat_name.'</label><input type=\'checkbox\' id='.$g->g_cat_name.$i.' class="kt_c" name='.$id.' data-cat="'.$c->g_cat.'" value="'.$g->g_cat.'" checked onclick=\'cat(this)\'>';
                }else{
                  echo '<label for='.$g->g_cat_name.'>'.$g->g_cat_name.'</label><input type=\'checkbox\' id='.$g->g_cat_name.$i.' class="kt_c" name='.$id.' data-cat="'.$c->g_cat.'" value="'.$g->g_cat.'" onclick=\'cat(this)\'>';
                }
              
            }
            echo "</div>
                <div id='gacd$i' class='sw col-sm-1 col-sm-offset-1' style='text-align:left;font-size:20px;' click='openSeg(this.id)'>＋</div>
            </div>

            <div class='row'>
                <div id='gseg$i' class='cont col-sm-8 col-sm-offset-1' style='box-shadow:0 0 5px #000,0 0 5px lavender inset;margin-bottom:5px;'>
                    会社名 : <a class='if78 cboxElement' href=gai?id=".$id." id='cm$id'>".$c->g_seisyou."</a><span style='font-size:12px;margin-bottom:5px;'></span>
                    <hr>
                    担　当 : $c->g_tantou";
                    if(!empty($c->g_tantou)){
                      echo "　様";
                    }
                    echo "<br>
                    <hr>
                    メール : $c->g_mail<br><hr>
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

