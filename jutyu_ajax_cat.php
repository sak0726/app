<tr><th>code</th><th>項目</th><th>詳細</th><th>単価</th><th>在庫数</th></tr>
<?php foreach($cat->result() as $c):?>
  <tr style="border-bottom: 1px solid;"><td><span class="material-symbols-outlined">arrow_right</span><?=$c->code?></td><td><?=$c->z_mat?></td><td><?=$c->kata?></td><td><?=number_format($c->tanka)?></td><td><?=number_format($c->zan)?></td></tr>
<?php endforeach;?>
