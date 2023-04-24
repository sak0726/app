
              <table id="ajaxreload">
                <tr><th></th><th style="width:58px;">Code</th><th>項目</th><th>型番</th><th>カテゴリ</th><th style=""></th></tr>
                  <?php foreach($res[1]->result() as $z):?>
                      <tr id="z<?=$z->z_ID?>" class="ck_cat cat<?=$z->z_cat?>">
                      <td><input id="ck<?=$z->z_ID?>" type="checkbox" class="z_ck"></td>
                      <td><input type="text" class="form-control z_tc" value="<?=$z->code?>"></td>
                      <td><input type="text" class="form-control z_tm" value="<?=$z->z_mat?>"></td>   
                      <td><input type="text" class="form-control z_tg" value="<?=$z->kata?>"></td>
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
                        <td><input type="text" class="form-control z_zk" style="text-align:right;" value="<?=number_format($z->zan)?>"></td>
                        <td style="padding:0;">
                        <input type="button" id="zk<?=$z->z_ID?>" class="btn btn-primary btn-sm zaiko" style="width:40px;height:23px;padding:0;" value="在庫" onclick="zaiko(this.id)">
                        </td>
                        <td style="padding:0;">
                        <button type="button" id="del<?=$z->z_ID?>" class="btn btn-danger btn-sm" style="width:30px;height:23px;padding:0;" value="x" onclick="z_del(this.id)"><span class="material-symbols-outlined">delete_sweep</span></button>
                        </td>
                      </tr>
                    <?php endforeach;?>
              </table>
              