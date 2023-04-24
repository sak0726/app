<!DOCTYPE html>
<?php
	$this->load->database('t');
    $this->load->library('session');
    
    if(empty($_SESSION['name'])){
        header("location:../");
    };
?>


<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bunseki.css">
    <link rel="stylesheet" href="../cbox/colorbox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-ja.js"></script>
    <title>売上分析</title>
</head>
<body style="width:800px;">
<style>
    .h{
        display:none;
    }
    </style>
    <div class="wrap" style="margin-top:20px;position:relative;padding:10px;">
        <h3>売上分析</h3>
        <div style="display:flex;margin:5px 0 15px 0;"><span style="font-weight:normal;padding-top:2px;">年</span>
            <select id="selyear" class="form-control" style="width:70px;">
            <?php foreach($list->result() as $y):?>
                <option value="<?=$y->nouhin?>"><?=$y->nouhin?></option>
                <?php endforeach;?>
            </select><span style="font-weight:normal;padding-top:2px;">月</span>
            <?php for($i=1;$i<13;$i++):?>
                <button class="btn btn-primary btn-sm" value="<?=$i?>"><?=$i?>月</button>
            <?php endfor;?>
        </div>
        <div style="display:flex;margin-bottom:5px;">
                <input id="cust" type="text" list="cust_list" class="form-control tab" style="width:200px" placeholder="顧客名">
                <datalist id="cust_list">
                    <?php foreach($cust->result() as $c){
                        echo '<option value='.$c->c_name.' label='.$c->c_sy.'></option>';
                    }
                    ?>
                </datalist>
                <input id="k_number" type="text" class="form-control tab" style="width:80px" placeholder="番号">
                <input id="sd" type="text" class="form-control dp tab" style="margin-left:20px;width:120px" onchange="genDate(this.value,this.id)" placeholder="開始日">
                <input id="ed" type="text" class="form-control dp tab" style="width:120px" onchange="genDate(this.value,this.id)" placeholder="終了日">
        </div>
        <input id="kanri" type="text" class="form-control tab h" style="margin-bottom:10px;width:80px" placeholder="管理番号" disabled>

        <input id="hid_m" type="hidden">
        <style>
            .btn{
                width:150px!important;
                margin-top:5px;
            }
            .panel{
                position:relative;
            }
            .container{
                z-index:3;
                background-color:#f3f4ff;
                text-align:center;
                height:181px;
                overflow:auto;
                padding:17px;
                border-radius:10px;
                box-shadow:0 0 4px;
            }
            .col-md-6{
                text-align:left;
                padding-left:5px;
            }
            table td{
                font-weight:100;
            }
            .bar-graph {
  display: flex;
  align-items: flex-end;
  height: 250px;
}

.bar-graph__bar {
  width: 50px;
  margin-right: 20px;
  background-color: #33adff;
  transition: height 0.5s ease-in-out;
}

.bar-graph__bar:hover {
  background-color: #26a6e4;
  cursor: pointer;
}

.bar-graph__label {
  font-size: 16px;
  font-weight: bold;
  margin-top: 10px;
}



        </style>
        <div>
        <p style="margin-top:10px;margin-bottom:2px;text-align:center;">株式会社グリーンフィールズ 2021年1月</p>
        <p style="margin-top:0px;margin-bottom:2px;text-align:center;">4,672,910 円</p>


        <p style="margin-top:10px;margin-bottom:2px;text-align:center;">野菜 : 3,689,610円</p>
        <div style="position:absolute;left:15%;width:80%;display:none;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                        <!-- 左側のカラムのコンテンツをここに記述する -->
                            <p style="text-align:center;">出店販売</p>
                            <table style="width:90%;">
                                <thead>
                                    <tr>
                                    <th>日付</th>
                                    <th>品名</th>
                                    <th>数量</th>
                                    <th>金額</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $month = 1; // 月は1月とする
                                    for ($day = 1; $day <= 31; $day++) { // 日付のループ
                                    $date = sprintf('%04d-%02d-%02d', 2021, $month, $day); // 日付のフォーマット
                                    $quantity = rand(1, 300); // ランダムな数量
                                    $price = $quantity * 150; // 金額の計算
                                    ?>
                                    <tr>
                                        <td><?= $date ?></td>
                                        <td>レタス</td>
                                        <td style="text-align:right;"><?= $quantity ?></td>
                                        <td style="text-align:right;"><?= number_format($price) ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6" style="margin-left:0px;">
                        <!-- 右側のカラムのコンテンツをここに記述する -->
                            <p style="text-align:center;">受注販売</p>
                            <table style="width:90%;border-left:1px solid #000;">
                                <thead>
                                    <tr>
                                    <th>日付</th>
                                    <th>品名</th>
                                    <th>数量</th>
                                    <th>金額</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $month = 1; // 月は1月とする
                                    for ($day = 1; $day <= 31; $day++) { // 日付のループ
                                    $date = sprintf('%04d-%02d-%02d', 2021, $month, $day); // 日付のフォーマット
                                    $quantity = rand(100, 2000); // ランダムな数量
                                    $price = $quantity * 150; // 金額の計算
                                    ?>
                                    <tr>
                                        <td style="padding-left:5px;"><?= $date ?></td>
                                        <td>レタス</td>
                                        <td style="text-align:right;"><?= number_format($quantity) ?></td>
                                        <td style="text-align:right;"><?= number_format($price) ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            <button class="btn btn-primary btn-sm">レタス<br>785,200</button>
            <button class="btn btn-primary btn-sm">とまと<br>325,000</button>
            <button class="btn btn-primary btn-sm">白菜<br>568,200</button>
            <button class="btn btn-primary btn-sm">キャベツ<br>172,100</button>
            <button class="btn btn-primary btn-sm">じゃがいも<br>655,200</button>
            <button class="btn btn-primary btn-sm">セロリ<br>498,200</button>
            <button class="btn btn-primary btn-sm">にんじん<br>125,600</button>

<div class="glaf-container">
  <div class="row">
    <div class="col-sm-12">
      <div id="bar-chart"></div>
    </div>
  </div>
</div>

<!-- CSS -->
<style>
  #bar-chart,#bar-chart2 {
    height: 300px;
    text-align:center;
    padding-top:10px;
  }
  .bar {
    display: inline-block;
    width: 50px;
    height: 200px;
    margin-right: 10px;
    background-color: #007bff;
    position: relative;
  }
  .bar span {
    display: block;
    text-align: center;
    font-size: 10px;
    color: black;
    position: absolute;
    bottom: -25px;
    left: 0;
    right: 0;
  }
</style>

<!-- JavaScript/jQuery/Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function() {
    // 品目と販売数量の定義
    var items = ["レタス", "トマト", "白菜", "キャベツ", "じゃがいも", "セロリ", "にんじん"];
    var quantities = [50, 70, 40, 80, 100, 60, 90];
    var totalSales = 0;

    // 合計金額の計算
    for (var i = 0; i < items.length; i++) {
      totalSales += quantities[i] * 150;
    }

    // 棒グラフの描画
    var maxQuantity = Math.max(...quantities);
    for (var i = 0; i < items.length; i++) {
      var height = (quantities[i] / maxQuantity) * 200;
      var bar = '<div class="bar" style="height:' + height + 'px;">';
      bar += '<span>' + items[i] + '</span>';
      bar += '</div>';
      $('#bar-chart').append(bar);
    }

    // 合計金額の表示
    var totalSalesText = '<p style="font-size: 18px;"><br>合計金額: 3,689,610円</p>';
  });
</script>


        <p style="margin-top:10px;margin-bottom:2px;text-align:center;">くだもの : 983,300円</p>
            <button class="btn btn-primary btn-sm">りんご<br>185,800</button>
            <button class="btn btn-primary btn-sm">みかん<br>305,900</button>
            <button class="btn btn-primary btn-sm">桃<br>256,000</button>
            <button class="btn btn-primary btn-sm">ぶどう<br>30,200</button>
            <button class="btn btn-primary btn-sm">キウイ<br>205,400</button>
        </div>
        <div class="glaf-container">
  <div class="row">
    <div class="col-sm-12">
      <div id="bar-chart2"></div>
    </div>
  </div>
</div>
        <script>
  $(document).ready(function() {
    // 品目と販売数量の定義
    var items = ["りんご", "みかん", "桃", "ぶどう", "キウイ"];
    var quantities = [50, 70, 40, 80, 100];
    var totalSales = 0;

    // 合計金額の計算
    for (var i = 0; i < items.length; i++) {
      totalSales += quantities[i] * 150;
    }

    // 棒グラフの描画
    var maxQuantity = Math.max(...quantities);
    for (var i = 0; i < items.length; i++) {
      var height = (quantities[i] / maxQuantity) * 200;
      var bar = '<div class="bar" style="height:' + height + 'px;">';
      bar += '<span>' + items[i] + '</span>';
      bar += '</div>';
      $('#bar-chart2').append(bar);
    }

    // 合計金額の表示
    var totalSalesText = '<p style="font-size: 18px;"><br>合計金額: 983,300円</p>';
  });
  
</script>
        <div id="bunseki_ajax" style="text-align:center;">

        
        </div>
    </div>

    <script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="../js/bunseki.js"></script>
    <script type="text/javascript" src="../js/seikyu.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
</body>
</html>