<style>
.kaimei td{
    background:#fff;
}

</style>
<?php
    $cnt=count($data[1]);
    echo '<div>工事</div>';
    $day="2022/10/31";

    //echo date('Y-m-d', strtotime('last day of previous month'.$day));
        echo '<div class="container" style="background:#f3fff3;border:1px solid #000080;border-radius:5px;margin-bottom:10px;padding:5px 20px;">
            <div class="row style="position:relative;" align-items-start">';
        for($i=0;$i<$cnt;$i++){
                if($data[1][$i]['total']>0){//0円は非表示
                    echo '<button class="btn btn-primary btn-sm kb col-3" style="background: #98b4f3;width:fix-content;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;" name="" value="'.$data[1][$i]['cust'].'" data='.$data[1][$i]['total'].'>'.$data[1][$i]['cust']."<br>￥".number_format($data[1][$i]['total']).'</button>
                    <input type=hidden style="position:relative;" value='.$data[1][$i]["c_id"].'>';
                    if($data[1][$i]['cust']=="金原"){

                   
                    echo '<div id="" style="text-align:left;position:absolute;top:55px;left:85px;z-index:3;padding:15px;background:#f3fff3;display:block;box-shadow: 0 0 18px;width:80%;">';
                    echo '<table class="kaimei" style="width:100%;"><tr><th colspan="4">金原　2020年6月仕入 : 706,150円</th></tr><tr><th>管理番号</th><th>完了日</th><th>工事名</th><th>金額</th><tr>';
                foreach($data[5][$i]->result() as $v){
                        echo '<tr style="border-bottom:1px solid;"><td><a href="">'.$v->k_keyNum.'</a></td><td>'.date('Y/m/d',strtotime($v->kt_nouhin)).'</td><td>'.$v->kt_doc.'</td><td style="text-align:right;padding:0 8px;">'.number_format($v->kt_total).'</td></tr>';
                       
                    }
                    echo '</table><div style="display:flex;margin-left:260px;margin-top:10px;"><input type="button" class="btn btn-primary btn-sm" value="支払"><input type="button" class="btn btn-primary btn-sm" value="履歴"></div>
                    
                    <div style="text-align:left;position:absolute;top:55px;left:85px;z-index:3;padding:15px;background:#f3fff3;display:block;box-shadow: 0 0 18px;width:50%;">
                        <div style="display:flex;"><label style="width:75px;">仕入額</label><input class="form-control" value="706,150"></div>
                        <div style="display:flex;"><label style="width:75px;">税額</label><input class="form-control" value="70,615"></div>
                        <div style="display:flex;"><label style="width:75px;">仕入額</label><input class="form-control" value="776,765"></div>';
                        $cat=['現金','振込','手形','電子手形','相殺','その他','手数料',' 計'];
                        $cat_count=count($cat);
                        for($ci=0;$ci<$cat_count;$ci++){
                            echo '<div style="display:flex;"><label for="kaisyu_cat" style="width:150px;text-align:center;">'.$cat[$ci].'</label>
                                <input id="kaisyu_cat'.$ci.'" style="width:150px;text-align:right;" data="" class="form-control tab gaku" placeholder="金額" value="0" onchange="cul(this.value)" autocomplete=off></div>';
                        }

                        echo '<hr><div style="display:flex;"><input class="btn btn-primary btn-sm" value="支払"></div>
                    </div>
                    </div>';
                    
               
                    } 
                
                
            }
        
        
    }
echo '</div></div>';


echo '部材<div class="container" style="background:#f3fff3;border:1px solid #000080;border-radius:5px;margin-bottom:10px;padding:5px 20px;">
<div class="row style="position:relative;" align-items-start">';
$cnt=count($data[6]);

for($i=0;$i<$cnt;$i++){
    if($data[6][$i]['total']>0){//0円は非表示
        echo '<button class="btn btn-primary btn-sm kb col-3" style="background: #98b4f3;width:fix-content;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;" name="" value="'.$data[6][$i]['cust'].'" data='.$data[6][$i]['total'].'>'.$data[6][$i]['cust']."<br>￥".number_format($data[6][$i]['total']).'</button>
        <input type=hidden style="position:relative;" value='.$data[6][$i]["c_id"].'>
        <div id="j'.$data[6][$i]['cust'].'" style="text-align:left;position:absolute;top:200px;z-index:3;padding:10px;background:#f3fff3;display:none;box-shadow: 0 0 18px;width:80%;">';
            foreach($data[7][$i]->result() as $j){
                echo '<p style="background: #fff;margin-bottom: 5px;"><input type="checkbox" checked>管理番号: '.$j->k_Kid.' 金額 '.number_format($j->total).' 件名: '.$j->kenmei.'</p>';
            }
        echo '</div>';
    
}


}
echo '</div></div>';
