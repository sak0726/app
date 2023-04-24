            <table id="t_main" class="mhead" style="font-size:0.9em;">
                    <tr><th style="width:1%;"></th><th style="width:1%;"></th><th style="width:2%;"></th><th style="width:3%;">#</th><th style="width:5%;">Code</th><th>項目</th><th style="width:20%;">型番/型式</th><th style="width:5%;">区分</th><th style="width:5%;">数量</th><th style="width:7%;">単価</th><th style="width:10%;">金額</th><th style="width:5%;">備考</th><th style="width:2%;"></th><th style="width:2%;"></th></tr>
               

                <?php foreach($hist[1]->result_array() as $val):
                    $kazu=$val['quan'];
                    $tanka=$val['tanka'];
                    if($kazu!=null){
                        $kazu=number_format($kazu);
                    }
                    if($tanka!=null){
                        $tanka=number_format($tanka);
                    }
                ?>

                <tr id="tr<?= $val['m_id']?>" style="border-bottom: 1px solid rgb(204, 201, 201);" name="<?=$val['num']?>">
                <td><button type="button" id="mmu<?=$val['m_id']?>" class="btn btn-sm btn-center" style="padding:0px;height:23px;" onclick="m_moveUp(this)"><span class="material-symbols-outlined">north</span></button></td>
                <td><button type="button" id="mmd<?=$val['m_id']+1?>" class="btn btn-sm btn-center" style="padding:0px;height:23px;" onclick="m_moveDown(this)"><span class="material-symbols-outlined">south</span></button></td>
                <td><button id="ad<?= $val['m_id']?>" type="button" class="btn btn-primary btn-sm tk" style="text-align:center;height:23px;padding:0;"><span class="material-symbols-outlined">arrow_right</span></button></td>
                    <td>
                        <?php if($val['ck']==1):?>
                            <input id="n<?=$val['m_id']?>" type="number" class="form-control syanai" value=<?=$val['num']?> name="num" autocomplete="off">
                        <?php else:?>
                            <input id="n<?=$val['m_id']?>" type="number" class="form-control" value=<?=$val['num']?> name="num" autocomplete="off">
                        <?php endif;?>
                        
                    </td>
                    <td><input id="c<?=$val['m_id']?>" type="number" class="form-control cat" value="" name="num" autocomplete="off"></td>
                    <td><input id="z<?=$val['m_id']?>" type="text" class="form-control zuban rp tab" style="text-align:left;" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="<?=$val['zuban']?>" autocomplete="off"></td>
                    <td><input id="h<?=$val['m_id']?>" type="text" class="form-control hinmei rp tab" style="text-align:left;" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="<?=$val['hinmei']?>" autocomplete="off"></td>
                    <td><input id="w<?=$val['m_id']?>" type="datelist" list="kubun" class="form-control" style="text-align:center;" name="<?=$val['num']?>" value="<?=$val['m_kubun']?>" onchange="zinst(this.name,this.id,this.value)" autocomplete="off">
                        <datalist id="kubun">
                            <option value="物品"></option>
                            <option value="工事"></option>
                            <option value="経費"></option>
                        </datalist>
                    </td>                    <td><input id="q<?=$val['m_id']?>" type="text" class="form-control tab" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="<?=$kazu?>" autocomplete="off"></td>
                    <td><input id="t<?=$val['m_id']?>" type="text" class="form-control tab" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="<?=$tanka?>" autocomplete="off"></td>
                    <td><input id="g<?=$val['m_id']?>" type="text" class="form-control tab" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="<?=number_format($val['z_total'])?>" autocomplete="off"></td>
                    <td><input id="c<?=$val['m_id']?>" type="text" class="form-control com" name="<?=$val['num']?>" onchange="zinst(this.name,this.id,this.value)" value="" autocomplete="off"></td>
                    <td><button id="b<?=$val['m_id'];?>" type="button" class="btn btn-danger btn-sm" style="text-align:center;height:23px;padding:1px;" onclick="kb_delete(this)"><span class="material-symbols-outlined">delete_sweep</span></button></td>
                    <td><button type="button" id="r<?=$val['m_id']?>" class="btn btn-primary btn-sm graf" style="text-align:center;height:23px;padding:0;"><span class="material-symbols-outlined">donut_large</span></button></td>
                    <input id="tanz<?=$val['m_id']?>" type="hidden" value="<?=number_format($val['zai'])?>">
                    <input id="tank<?=$val['m_id']?>" type="hidden" value="<?=number_format($val['kt'])?>">
                </tr>
                <?php endforeach;?>
            </table>
