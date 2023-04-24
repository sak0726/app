<?php
    $cnt=count($data[1]);
    echo '<div>請求</div>';
    $day="2022/10/31";

    //echo date('Y-m-d', strtotime('last day of previous month'.$day));
    foreach($data[0]->result() as $s){
        echo '<div class="container" style="background:#f3fff3;border:1px solid #000080;border-radius:5px;margin-bottom:10px;padding:5px 20px;">
            <p><button class="btn btn-primary btn-sm ikkatsu" style="width:100px;" value="'.$s->c_sime.'">'.$s->c_sime.'締め</button></p>'.
            '<div class="row style="position:relative;" align-items-start">';
        for($i=0;$i<$cnt;$i++){
            if(strpos($s->c_sime,$data[1][$i]['sime'])===false){
            }else{
                if($data[1][$i]['total']>0){//0円は非表示
                    echo '<button class="btn btn-primary btn-sm kb col-3" style="background: #98b4f3;width:fix-content;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;" name="'.$s->c_sime.'" value="'.$data[1][$i]['cust'].'" data='.$data[1][$i]['total'].'>'.$data[1][$i]['cust']."<br>￥".number_format($data[1][$i]['total']).'</button>
                    <input type=hidden style="position:relative;" value='.$data[1][$i]["c_id"].'>
                    <div id="j'.$data[1][$i]['cust'].'" style="text-align:left;position:absolute;top:200px;z-index:3;padding:10px;background:#f3fff3;display:none;box-shadow: 0 0 18px;width:80%;">';
                        foreach($data[5][$i]->result() as $j){
                            echo '<p style="background: #fff;margin-bottom: 5px;"><input type="checkbox" checked>管理番号: '.$j->k_Kid.' 金額 '.number_format($j->total).' 件名: '.$j->kenmei.'</p>';
                        }
                    echo '</div>';
                }
            }
        }
        echo '</div></div>';
    }
    $kaisyu_count=count($data[3]);
    $zan_count=count($data[2]);
    echo '<div>領収書・入金管理</div><div style="margin-bottom:4px;"><input type="button" id="show" class="btn btn-primary btn-sm" value="履歴"></div>';
    foreach($data[0]->result() as $s){
        echo '<div class="container" style="background:#f3fff3;border:1px solid #000080;border-radius:5px;margin-bottom:10px;padding:5px 20px;">
            <p><span class="" style="width:100px;" value="'.$s->c_sime.'">'.$s->c_sime.'締め</span></p>'.
            '<div class="row align-items-start" style="position:relative;">';
        for($l=0;$l<$zan_count;$l++){
            if($s->c_sime==$data[2][$l]['c_sime']){
                $cat=['現金','振込','手形','電子手形','相殺','その他','手数料'];
                $cat_count=count($cat);
                echo '<button class="btn btn-primary btn-sm ryo col-3" style="width:fix-content;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;" name="'.$s->c_sime.'" data='.$data[2][$l]['c_id'].' value="'.$data[2][$l]['c_sime'].'">'.$data[2][$l]['c_name']."<br><span id='zan".$data[2][$l]['c_id']."'>￥".number_format($data[2][$l]['kuri']).'</span></button>';
                echo '<div class="kaisyu" style="width:500px;position:absolute;top:-300px;left:13%;text-align:left;display:none;">
                        <div style="display:flex;position:relative;"><label for="cust'.$data[2][$l]['c_id'].'">顧客</label><input id="cust'.$data[2][$l]['c_id'].'" class="form-control" style="width:400px;" value="'.$data[2][$l]['c_name'].'" autocomplete=off>
                            <div class="message" style="display:none;position:absolute;top:200px;left:130px;background:#c5dae794;padding:40px;border-radius:15px;z-index:-1;">保存しました。</div>
                        </div>
                        <div style="display:flex;"><label for="kaisyu_D'.$data[2][$l]['c_id'].'">回収日</label><input id="kaisyu_D'.$data[2][$l]['c_id'].'" class="form-control tab dp" style="width:100px;" onchange="genDate(this.value,this.id)" autocomplete=off>
                        <input type="button" id="hist'.$data[2][$l]['c_id'].'" name="'.$data[2][$l]['c_name'].'" class="btn btn-primary btn-sm" value="履歴" onclick="show_hist(this.id)">
                            <label style="margin-left:143px;">売掛残 </label><span id="urizan'.$data[2][$l]['c_id'].'">'.number_format($data[2][$l]['kuri']).'</span></div>';
                            for($i=0;$i<$kaisyu_count;$i++){
                                if($data[3][$i]['cust_id']==$data[2][$l]['c_id']){
                                    if($data[3][$i]['gaku']>0){
                                        $day=$data[3][$i]['day'];
                                        if($day!=""){
                                            echo '<div style="font-weight:normal;">最終回収<span style="margin-left:20px;">'.date('Y/m/d',strtotime($day)).' 金額 '.number_format($data[3][$i]['gaku']).'</span></span></div>';
                                        };
                                    }
                                };
                            };
                            echo '<div style="display:flex;">
                                <input type=button class="btn btn-primary btn-sm auto" data='.$data[2][$l]['c_id'].' value="自動"><input type=button class="btn btn-primary btn-sm manual" data='.$data[2][$l]['c_id'].' value="手動">
                            </div>
                            <hr>';
                        for($ci=0;$ci<$cat_count;$ci++){
                            echo '<div style="display:flex;"><label for="kaisyu_cat'.$data[2][$l]['c_id'].'" style="width:150px;text-align:center;">'.$cat[$ci].'</label>
                                <input id="kaisyu_cat'.$data[2][$l]['c_id'].$ci.'" style="width:150px;text-align:right;" data="'.$data[2][$l]['c_id'].'" class="form-control tab gaku" placeholder="金額" value="0" onchange="cul(this.value)" autocomplete=off></div>';
                        }
                echo '<hr><div style="display:flex;"><label for="total'.$data[2][$l]['c_id'].'" style="width:100px;text-align:right;">合計</label><input id="total'.$data[2][$l]['c_id'].'" class="form-control tab" style="width:200px;text-align:right;" value="0" autocomplete=off>
                            <input id="culc'.$data[2][$l]['c_id'].'" type="button" class="btn btn-primary btn-sm" style="margin-left:15px;" value="差額調整" onclick="sagaku(this.id)">            
                            <input id="kaisyu_save'.$data[2][$l]['c_id'].'" type="button" class="btn btn-primary btn-sm save" value="保存">
                            <input id="ryou" data='.$data[2][$l]['c_id'].' name='.$data[2][$l]['c_sime'].' type="button" class="btn btn-primary btn-sm" value="領収書"></div>
                        </div>';

                        
            }
        }
        echo '</div></div>';

    }


    echo '<div id="rireki" style="display:none;"><span id="suii_title">売掛金推移</span>
            <div style="display:flex;">
                <label style="width:80px;">顧客</label><input list="rireki_cust" id="cust_data" class="form-control" onchange="get_data(this.value)" autocomplete=off>
                <datalist id="rireki_cust">';
                $c_count=count($data[4]);
                    for($i=0;$i<$c_count;$i++){
                        echo '<option value="'.$data[4][$i]['c_name'].'" label="'.$data[4][$i]['c_sy'].'">"'.$data[4][$i]['c_id'].'"</option>';
                    }
            echo '</datalist>
            </div>
            <div id="table_ajax" style="padding:10px;">

            </div>
        </div>';
