<table class="table b_table">
<tr>
    <th>管理番号</th>
    <th>納期日</th>
    <th>枚数</th>
    <th>売上</th>
    <th>社内売上</th>
    <th>社外売上</th>
    <th>材料費</th>
    <th>外注費</th>
</tr>
<?php
    $t=0;$tm=0;$tn=0;$tg=0;$tz=0;$tk=0;
        foreach($kanri->result() as $k){
            $tm+=$k->z_mai;
            $t+=$k->total;
            $tn+=$k->nai;
            $tg+=$k->gai;
            $tz+=$k->zai;
            $tk+=$k->kt;
        };
?>
        <tr>
            <td style="text-align:center;">合計</td>
            <td style="text-align:center;">/</td>
            <td style="text-align:center;"><?=number_format($tm)?> 枚</td>
            <td><?=number_format($t)?></td>
            <td><?=number_format($tn)?></td>
            <td><?=number_format($tg)?></td>
            <td><?=number_format($tz)?></td>
            <td><?=number_format($tk)?></td>
        </tr></tabale>
        <table class="table b_table"><tr>
<?php
        foreach($kanri->result() as $k):?>

        <tr>
            <td style="text-align:center;"><?=$k->k_Kid?></td>
            <td style="text-align:left;"><?=$k->nouki?></td>
            <td style="text-align:center;"><?=number_format($k->z_mai)?> 枚</td>
            <td><?=number_format($k->total)?></td>
            <td><?=number_format($k->nai)?></td>
            <td><?=number_format($k->gai)?></td>
            <td><?=number_format($k->zai)?></td>
            <td><?=number_format($k->kt)?></td>
        </tr>

        <?php endforeach;?>
        </table>





