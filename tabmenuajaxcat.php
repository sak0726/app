<table id="ajaxcat"><tr id="cat"><th>カテゴリ一覧</th></tr>
    <tr>
      <td><input type="button" class="cat btn btn-primary btn-sm" style="height:22px;padding:0;" name="99" value="全て"></td>
    </tr>
    <tr>
      <td><input type="button" class="cat btn btn-primary btn-sm" style="height:22px;padding:0;" name="0" value="未分類"></td>
    </tr>
    <?php foreach($res[3]->result() as $z):?>
        <tr>
          <td><input type="button" class="cat btn btn-primary btn-sm" style="height:22px;padding:0;" name="<?=$z->ID?>" value="<?=$z->z_ctg?>">
          <buttn id="del<?=$z->ID?>" type="button" class="btn btn-danger btn-sm del" style="display:none;width:40px;height:22px;padding:0;" value="x" onclick="c_del(this.id)"><span class="material-symbols-outlined">delete_sweep</span></button></td>
        </tr>
      <?php endforeach;?>
      <tr><th style="text-align:center;font-weigth:0;">操作</th></tr>
      <tr><td><input type="button" id="addCat" class="btn btn-parimary btn-sm" style="height:22px;padding:0;" value="新規追加" onclick="op_adc()"></td></tr>
                    <tr><td style="text-align:-webkit-center;">
                      <div id="c_menu" style="border:1px solid #000080;background-color:#f4f4ff;padding:2px;">
                          <span>Code<input type="text" id="adbz_code" class="form-control" value="" autocomplete="off"></span>
                          <span>品名<input type="text" id="adbz_hm" class="form-control" autocomplete="off"><span>
                          <span>型番<input type="text" id="adbz_kata" class="form-control" autocomplete="off"></span>
                          <span>カテゴリ<select id="adbz_cat" class="form-select" style="padding:1px;">
                          <?php foreach($res[3]->result() as $z):?>
                          <option value='<?=$z->ID?>'><?=$z->z_ctg?></option>
                        <?php endforeach;?>
                        </select>
                       </span><br>
                          <input type="button" class="btn btn-primary btn-sm" style="width:95%;" style="height:22px;padding:0;" value="追加" onclick="bzadd()">
                      </div>
                    </td></tr>

      <tr><td><input type="button" id="pop" class="btn btn-parimary btn-sm" value="一括変更" onclick="op_pop()"></td></tr>
      <tr><td style="text-align:-webkit-center;">
      <div id="p_menu" style="background-color:#f4f4ff;padding:2px;">一括変更します。<br>
      <select id="ck_sel" class="form-select">
        <?php foreach($res[3]->result() as $z):?>
          <option value='<?=$z->ID?>'><?=$z->z_ctg?></option>
        <?php endforeach;?>
        </select><br>
        <input type="button" id="ck" class="btn btn-primary btn-sm" style="width:95%;height:22px;padding:0;" value="OK" onclick="changecat()">
        </div>
      </td></tr>
      <tr><td><input type="button" id="addCat" class="btn btn-parimary btn-sm" style="height:22px;padding:0;" value="カテゴリ追加" onclick="op_adcat()"></td></tr>
      <tr><td><div id="cat_menu" style="padding:2px;">カテゴリ追加<br>
              <input type="text" id="adcat" class="form-control"><br>
              <input type="button" class="btn btn-primary btn-sm" style="height:22px;padding:0;" value="追加" onclick="catadd()"></div>
        </td></tr>
        <tr><td><input type="button" id="opdel" class="btn btn-danger btn-sm" style="height:22px;padding:0;" value="カテゴリ削除" onclick="op_del()"></td></tr>
</table>
