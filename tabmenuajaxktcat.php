<table id="ajaxktcat"><tr><th>カテゴリ一覧</th></tr>
                      <tr><td><input type="button" class="btn btn-primary btn-sm fil" style="height:22px;padding:0;" name="99" value="全て"></td></tr>
                        <?php foreach($res[7]->result() as $v){
                          echo '<tr><td><input type="button" class="btn btn-primary btn-sm fil" style="height:22px;padding:0;" name="'.$v->g_cat.'" value="'.$v->g_cat_name.'">
                                <button id="kdel'.$v->id.'" type="button" class="btn btn-danger btn-sm kdel" style="display:none;width:40px;height:22px;padding:0;" value="x" onclick="c_del(this.id)"><span class="material-symbols-outlined">delete_sweep</span></button></td>
                                </td></tr>';
                          }
                        ?>
                        <tr><td style="text-align:center;font-weight:100;">操作</td></tr>
                        <tr><td><input type="button" id="np" class="btn btn-primary btn-sm" value="新規追加" style="height:22px;padding:0;" onclick="opn_pop()"></td></tr>
                        <tr><td style="text-align:center;"><div id="new">新規追加<br>
                            <label>表記<input type="text" id="kos" class="form-control" placeholder="略称"></label><br>
                            <label>工程<input type="text" id="koutei" class="form-control" placeholder="工事名"></label><br>
                            <label>カテゴリ<select id="kt_cat" class="form-control" style="width:188px;" onchange="ch_kt(this.id,this.value)">
                              <?php foreach($res[7]->result() as $v){
                                echo '<option value="'.$v->g_cat.'">'.$v->g_cat_name.'</option>';
                              }?>
                            </select>
                            </label>
                                <br>
                                <input type="button" class="btn btn-primary btn-sm" value="追加" onclick="new_go()">
                                </div>
                        </td></tr>
                        <tr><td><input type="button" id="ktp" class="btn btn-primary btn-sm" value="一括変更" style="height:22px;padding:0;" onclick="opkt_pop()"></td></tr>
                        <tr><td style="text-align:center;"><div id="kt_pop">一括変更します<br>
                                <select id="iksel" class="form-control">
                                <?php foreach($res[7]->result() as $v){
                                  echo '<option value="'.$v->g_cat.'">'.$v->g_cat_name.'</option>';
                                  }?>
                                </select>
                                <br>
                                <input type="button" class="btn btn-primary btn-sm" value="変更" onclick="ct_cat()">
                                </div>
                        </td></tr>
                        <tr><td><input type="button" id="kaddCat" class="btn btn-parimary btn-sm" style="height:22px;padding:0;" value="カテゴリ追加" onclick="op_kadcat()"></td></tr>
                        <tr><td style="text-align:center;">
                            <div id="k_menu" style="display:none;background-color:#f4f4ff;padding:2px;width:200px;">カテゴリ追加<br>
                              <input type="text" id="kadcat" class="form-control" placeholder="カテゴリ名"><br>
                              <input type="button" class="btn btn-primary btn-sm" style="width:95%;" value="追加" onclick="kcatadd()">
                            </div>
                        </td></tr>
                        <tr><td><input type="button" id="kd_btn" class="btn btn-danger btn-sm" value="カテゴリ削除" style="height:22px;padding:0;" onclick="kop_del()"></td></tr>
                        <tr><td style="text-align:center;font-weight:100;">検索</td></tr>
                        <tr><td><input type="text" class="form-control sc" style="width:200px;" placeholder="工程" onchange="search(this.value)"></td></tr>
                      </table>
