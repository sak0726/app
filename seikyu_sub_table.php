<?php
    echo '<table><tr><th></th><th>日付</th><th>繰越</th><th>金額</th><th>消費税</th><th>合計</th><th>回収</th><th>繰越</th></tr>';
    $i=0;
        foreach($hist[0]->result() as $v){
            echo '<tr><td class="td_del"><input id="'.$v->id.'" type="button" class="btn btn-danger btn-sm del" style="padding:1px 10px;" data="'.$v->uri_cust.'" name="'.$v->uri_day.'" value="x"></td><td style="text-align:center;">'.date('Y/m/d',strtotime($v->uri_day)).'</td><td>'.number_format($v->mae_kuri).'</td>
                <td>'.number_format($v->uri_kingaku).'</td><td>'.number_format($v->uri_zei).'</td>
                <td class="uriage" style="position:relative;">'.number_format($v->uri_total).'';
                foreach($hist[1][$i]->result() as $u){
                    if($v->uri_day===$u->uri_day && $v->uri_cust===$u->uri_cust){
                     echo '<div class="uriage_sub" style="position:absolute;text-align:center;font-weight:normal;"><div style="font-weight:bold;">売掛履歴</div><p style="text-align:left;">'.date('Y/m/d',strtotime($u->uri_day)).'</p>
                     <table><tr><th></th><th style="width:120px;">売上</th><th style="width:120px;">消費税</th><th style="width:120px;">合計</th></tr>
                     <tr><td style="width:30px;"><input type="button" class="btn btn-danger btn-sm del" style="padding:1px 10px;" id="del'.$u->id.'" name="uri" value="x"></td>
                     <td>'.number_format($u->uri_kingaku).'</td><td>'.number_format($u->uri_zei).'</td><td>'.number_format($u->uri_total).'</td>
                     </table>';
                    }
                 }                
                echo '</td>
                <td class="kaisyu_ichiran" style="position:relative;">'.number_format($v->uri_kaisyu).'';
                foreach($hist[2][$i]->result() as $k){
                    if($v->uri_day===$k->uri_day){
                        echo '<div class="kaisyu_sub" style="position:absolute;text-align:center;font-weight:normal;"><div style="font-weight:bold;">回収履歴</div><p style="text-align:left;">'.date('Y/m/d',strtotime($k->uri_day)).'</p>
                        <table><tr><th></th><th>現金</th><th>振込</th><th>手形</th><th>電債</th><th>相殺</th><th>その他</th><th>手数料</th><th>合計</th></tr>
                        <tr><td style="width:30px;"><input type="button" class="btn btn-danger btn-sm del" style="padding:1px 10px;" id="del'.$k->id.'" name="kai" value="x"></td><td>'.number_format($k->uri_genkin).'</td><td>'.number_format($k->uri_bank).'<td>'.number_format($k->uri_tegata).'</td><td>'.number_format($k->uri_densai).'</td><td>'.number_format($k->uri_sousai).'</td><td>'.number_format($k->uri_commision).'</td><td>'.number_format($k->uri_etc).'</td><td>'.number_format($k->uri_total).'</td>
                        </table>';
                    }
    
            }                
            echo '</div>
                </td>
                <td>'.number_format($v->kuri).'</td></tr>';
            $i++;
        };
    echo '</table>';
    
