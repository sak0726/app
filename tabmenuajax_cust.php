<div class='row' style="text-align:center;border-bottom:1px solid #000080;margin:auto;margin-top:10px;">
<script>
  $(document).ready(function(){
    $(".if75").colorbox({iframe:true, width:"710px", height:"500px"});
    $(".if78").colorbox({iframe:true, width:"750px", height:"800px"});
    $(".cf85").colorbox({iframe:true, width:"750px", height:"590px"});
});
</script>
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
                    <div class='row' id='ar$i' style='height:28px;overflow:hidden;'>
                      <div class='col-sm-1'>".$c->c_sy."</div><div class='col-sm-4'>".$c->c_name."</div>
                      <div class='col-sm-6'>".$zip.$c->c_add."</div>
                      <div id='acd$i' class='col-sm-1 ksw' style='text-align:left;font-size:20px;cursor:pointer;'>＋</div>
                    </div>

                    <div class='row justify-content-center cms'>
                        <div id=\"seg$i\" class=\"cont col-sm-8 col-sm-offset-1\" style='box-shadow:0 0 5px #000,0 0 5px lavender inset;margin-bottom:5px;'>
                            会社名 : <a class='cf85 cboxElement' href=customer?id=".$id." id='cm$id'>".$c->c_name."</a>  記号 : ".$c->c_sy."
                            <span style='float:right'><input type='button' style='font-size:12px;height:22px;padding:0 5px;' class='btn btn-primary btn-sm' id='meisai".$id."' name=".$c->c_sy." value='注文一覧' onclick='get_order(this.name)'></span>
                            <hr>
                            部　署 : $c->c_busyo<br><hr>
                            担　当 : $c->c_tan";
                            if(!empty($c->c_tan)){
                              echo "　様";
                            }
                            echo "<br>
                            <hr>
                            メール : <a href='mailto:$c->c_mail?subject='件名'>$c->c_mail</a><br><hr>
                            電　話 : ".substr($c->c_tel,0,4)."-".substr($c->c_tel,4,2)."-".substr($c->c_tel,6,4)." FAX : ".substr($c->c_fax,0,4)."-".substr($c->c_fax,4,2)."-".substr($c->c_fax,6,4)."<br><hr>住　所 :".$zip.$c->c_add."<br>";
                            if($c->c_hide==0){
                              echo "<label for='cvis".$c->c_id."'>表示</label><input id='cvis".$c->c_id."' type='radio' checked name='ch".$i."' class='btn btn-primary btn-sm' value='0' onclick='cbld(this.id,this.value)'>
                                  <label for='cdev".$c->c_id."'>非表示</label><input id='cdev".$c->c_id."' type='radio' name='ch".$i."' class='btn btn-primary btn-sm' value='1' onclick='cbld(this.id,this.value)'>";
                            }else{
                              echo "<label for='cvis".$c->c_id."'>表示</label><input id='cvis".$c->c_id."' type='radio' name='ch".$i."' class='btn btn-primary btn-sm' value='0' onclick='cbld(this.id,this.value)'>
                                  <label for='cdev".$c->c_id."'>非表示</label><input id='cdev".$c->c_id."' type='radio' checked name='ch".$i."' class='btn btn-primary btn-sm' value='1' onclick='cbld(this.id,this.value)'>";
                            }

                        echo "</div>
                    </div>
                  </div>";
                }
            }
            ?>
