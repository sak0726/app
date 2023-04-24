<?php
require_once 'vendorex/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as Writer;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;
$reader = new Reader();

    $filename='excel/サーバーメンテナンス見積書ID'.$_GET['svid'].'.xlsx';
    if(file_exists ($filename)){
        $spreadsheet = $reader->load('excel/サーバーメンテナンス見積書ID'.$_GET['svid'].'.xlsx');
    }else{
        $spreadsheet = $reader->load('excel/サーバーメンテナンス見積書.xlsx');
    }
$sheet = $spreadsheet->getActiveSheet();

?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/ex.css">
    <title>エクセル</title>
</head>
<body>
<div id="wrap">
<div id="inner">
<div id="sideWrap">
    <input type="hidden" id="svid" value="<?php echo($_GET['svid']);?>">
    <div style="position:relative;">    
        <h3 style="text-align:left;margin-bottom:10px;">見積書作成</h3>
        <div class='sideMenu'>
            <a href="/heiwass"><button type="button" class="btn btn-xs">TOP</button></a>
            <a href="mitsumori"><button type="button" class="btn btn-xs">見積作成</button></a>
            <a href="history"><button type="button" class="btn btn-xs">履歴</button></a>
            <a href="customer"><button type="button" class="btn btn-xs">顧客</button></a>
            <a><button type="button" id="opm" class="btn btn-xs">設定</button></a>
                <div id="subMenu">
                    <ul>
                        <li><a href="thick">板厚</a></li>
                        <li><a href="material">材料設定</a></li>
                        <li><a href="customer">顧客</a></li>
                        <li><a href="jisya">自社</a></li>
                    </ul>
                </div>
            <button class="btn btn-xs" onClick="history.back()" style="width:100%;">戻る</button>
        </div>
    </div>
</div>
    <form method="post" action="">
    <div id="exm">
        <?php
            echo '<table id="extable">
            <tr><td><button id="clear" class="btn btn-xs" name="clear">クリア</button><td colspan="11" style="text-align:right";>金額 ￥'.number_format($sheet -> getCell('F47')->getCalculatedValue()).'</td></tr>
            <tr>
            <th>No.</th>
            <th>品名</th>
            <th>単価</th>
            <th>数量</th>
            <th>金額</th>
            <th></th>
            <th>No.</th>
            <th>品名</th>
            <th>単価</th>
            <th>数量</th>
            <th>金額</th>
            </tr>';
            for ($i=9; $i<=46;$i++){
            echo '<tr>
            <td>'.$sheet -> getCell('A'.$i)->getValue().'</td>
            <td>'.$sheet -> getCell('B'.$i)->getValue().'</td>
            <td><input type="text" style="width:100px;text-align:right;" id="tdc'.$i.'" value="'.number_format($sheet -> getCell('C'.$i)->getValue()).'" readonly></td>
            <td><input type="text" style="width:80px;text-align:right;" id="tdd'.$i.'" name="B'.$i.'" value="'.number_format($sheet -> getCell('D'.$i)->getValue()).'" onChange="calu(this . id)"></td>
            <td><input type="text" style="width:100px;text-align:right;" id="tde'.$i.'" value="'.number_format($sheet -> getCell('E'.$i)->getCalculatedValue()).'" readonly></td>
            <td>　</td>
            <td>'.$sheet -> getCell('F'.$i)->getValue().'</td>
            <td>'.$sheet -> getCell('G'.$i)->getValue().'</td>
            <td><input type="text" style="width:100px;text-align:right;" id="tdh'.$i.'" value="'.number_format($sheet -> getCell('H'.$i)->getValue()).'" readonly></td>
            <td><input type="text" style="width:80px;text-align:right;" id="tdi'.$i.'" name="I'.$i.'" value="'.number_format($sheet -> getCell('I'.$i)->getValue()).'" onChange="calu2(this . id)"></td>
            <td><input type="text" style="width:100px;text-align:right;" id="tdj'.$i.'" value="'.number_format($sheet -> getCell('J'.$i)->getCalculatedValue()).'" readonly></td>

            </tr>';
            }
            echo '<tr><td style="border:none";><button type="button" id="enter" class="btn btn-xs">更新</button></td></tr></table>';
        ?>
    </div>
    </form>
<script type="text/javascript" src="../../js/menu.js"></script>
<script type="text/javascript" src="../../js/cal.js"></script>
</div>
</div>
</body>
</html>