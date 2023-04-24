<div style="display:flex;margin-left:41%;margin-bottom:10px;">
            <input type="button" class="btn btn-primary btn-sm" value="未請求">
            <input type="button" class="btn btn-primary btn-sm" value="未回収">
            <input type="button" class="btn btn-primary btn-sm" value="完了">

            </div>
<?php
    $cnt=count($data[1]);
    echo '<div>個人売上管理</div>';
    $day="2022/10/31";

    //echo date('Y-m-d', strtotime('last day of previous month'.$day));
    foreach($data[0]->result() as $s){
        echo '<div class="container" style="position:relative;background:#f3fff3;border:1px solid #000080;border-radius:5px;margin-bottom:10px;padding:5px 20px;">
           
                    <div class="row style="" align-items-start"><table><tr><th rowspan="2">状態</th><th rowspan="2">客先</th><th rowspan="2">完了日</th><th rowspan="2">管理番号</th><th rowspan="2">現場</th><th colspan="3">工事名</th></tr><tr><th>金額</th><th>回収</th><th>残金</th><th></th></tr>';
                for($i=0;$i<$cnt;$i++){
                    if(strpos($s->c_sime,$data[1][$i]['sime'])===false){
                    }else{
                        if($data[1][$i]['total']>0){//0円は非表示
                            foreach($data[5][$i]->result() as $j){
                                echo '<tr style="background: #fff;margin-bottom: 5px;border:1px solid;">
                                        <td rowspan="2"><span style="padding:0 5px;">'.$j->k_bunrui.'</span></td>
                                        <td rowspan="2">'.$j->cust.'</td>
                                        <td rowspan="2">'.date('Y/m/d',strtotime($j->nouhin_D)).'</td>
                                        <td rowspan="2" style="text-align:left;"><a href="">'.$j->k_Kid.'</a></td>
                                        <td rowspan="2">'.$j->k_tiki.'</td>
                                        <td colspan="3" style="text-align:left;">'.$j->kenmei.'</td><td><input type="button" class="btn btn-primary btn-sm" value="請求" onclick="sk('.$j->k_Kid.')"></td></tr>
                                        <tr style="background: #fff;margin-bottom: 5px;border:1px solid;">';
                                        
                                        if($j->k_bunrui!='完了'){
                                            echo '<td style="text-align:right;">'.number_format($j->total*1.1).'</td>
                                                <td style="text-align:right;">0</td>
                                                <td style="text-align:right;">'.number_format($j->total*1.1).'</td>';
                                        }else{
                                            echo '<td style="text-align:right;">'.number_format($j->total).'</td>
                                                <td style="text-align:right;">'.number_format($j->total).'</td>
                                                <td style="text-align:right;">0</td>';
                                        }
                                        echo '<td><input type="button" class="btn btn-primary btn-sm" value="回収"></td></tr>';

                            }
                        }
                    }
                }
        echo '</table>
        </div>';

        echo '<div class="kaisyu" style="width:500px;position:absolute;top:10px;left:20%;text-align:left;display:none;padding:20px;">
        <div style="display:flex;position:relative;">
            <label for="cust">顧客</label><input id="cust" class="form-control" style="width:330px;" value="小林 丈人" autocomplete=off>
            <label for="kaisyu_D" style="margin-left:20px;">回収日</label><input id="kaisyu_D" class="form-control tab dp" style="width:100px;" value="2020/5/31" onchange="genDate(this.value,this.id)" autocomplete=off>
            <div class="message" style="display:none;position:absolute;top:200px;left:130px;background:#c5dae794;padding:40px;border-radius:15px;z-index:-1;">保存しました。</div>
        </div><hr>';

        $cat=['現金','振込','相殺','その他','手数料'];
        $cat_count=count($cat);

        for($ci=0;$ci<$cat_count;$ci++){
            echo '<div style="display:flex;"><label for="kaisyu_cat'.$ci.'" style="width:150px;text-align:center;">'.$cat[$ci].'</label>
                <input id="kaisyu_cat'.$ci.'" style="width:150px;text-align:right;" data="" class="form-control tab gaku" placeholder="金額" value="0" onchange="cul(this.value)" autocomplete=off></div>';
        }
                echo '<hr><div style="display:flex;"><label for="total'.$ci.'" style="width:100px;text-align:right;">合計</label><input id="total'.$ci.'" class="form-control tab" style="width:200px;text-align:right;" value="0" autocomplete=off>
            <input id="kaisyu_save'.$ci.'" type="button" class="btn btn-primary btn-sm save" style="margin-left:60px;" value="保存">
            <input id="ryou" data='.$ci.' name='.$ci.' type="button" class="btn btn-primary btn-sm" value="領収書"></div>
        </div> 
        </div>';
        
    }
