
                      <table>
                        <tr>
                          <th></th><th style="width:80px;">表記</th><th>工程</th><th>カテゴリ</th><th>初期担当</th><th></th>
                        </tr>
                            <?php foreach($res[2]->result() as $k):?>
                              <tr id="kt<?=$k->kt_id?>" class="ck_k kt<?=$k->k_cat?>">
                                <td><input id="<?=$k->kt_id?>" type="checkbox" class="ck_kt"></td>
                                <td><input type="text" class="form-control" value="<?=$k->k_sinbol?>"></td>
                                <td><input type="text" class="form-control" value="<?=$k->k_name?>"></td>
                                <td><select id="sel_kt<?=$k->kt_id?>" class="form-select kt_cat" onchange="ch_kt(this.id,this.value)">
                                    <?php 
                                    foreach($res[7]->result() as $kt){
                                      if($k->k_cat==$kt->g_cat){
                                        echo '<option value="'.$kt->g_cat.'" selected>'.$kt->g_cat_name.'</option>';
                                      }else{
                                        echo '<option value="'.$kt->g_cat.'">'.$kt->g_cat_name.'</option>';  
                                      }
                                    }
                                    ?>
                                    </select>
                                </td>
                                <td>
                                <input id="set_gai<?=$k->kt_id?>" type="text" class="form-control d_list" list="gai_data<?=$k->kt_id?>" style="width:150px;" value="<?=$k->g_name?>" onchange="set_kt(this.id,this.value)">
                                <datalist id="gai_data<?=$k->kt_id?>">
                                  <?php foreach($res[0]->result() as $sg):?>                                   
                                        <option value="<?=$sg->g_name?>" label="<?=$sg->g_symb?>"></option>
                                  <?php endforeach;?>
                                  </datalist>
                                </td>
                                <td><button type="button" id="kt_del<?=$k->kt_id?>" class="btn btn-danger btn-sm delt" style="width:auto;height:24px;padding:0;" value="x" onclick="del_kt(this.id)"><span class="material-symbols-outlined">delete_sweep</span></button></td>
                              </tr>
                            <?php endforeach;?>
                      </table>

              