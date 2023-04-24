<?php
// 商品情報を含んだレシートのHTMLコードを生成
require_once __DIR__.'/../../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
	'orientation'=>'P',
	'format'=> [80, 150],
    'margin_left' => 5, //左のマージンを5mmに変更
    'margin_right' => 5, //右のマージンを5mmに変更
    'margin_top' => 0,
    'margin_bottom' => 0,
	'fontdata' => [
	    'ipa' => [
		    'R' => 'ipam.ttf'
		]
	]
]);
// 文書のプロパティを設定します
// 現在の日時を取得

$timestamp = date('YmdHis');
$mpdf->SetHeader('Timestamp: ' . $timestamp);

$mpdf->SetTitle('レシート');
$mpdf->SetAuthor('Your Name');
$mpdf->SetCreator('Your Application');
$mpdf->SetSubject('Receipt');


// フォントを設定します
$mpdf->SetDefaultFont('IPAexGothic');
$mpdf->WriteHTML('<style>h1{text-align:center;} table{margin-left:auto;margin-right:0;} .r{text-align:right;} .b{margin-bottom:0px;margin-top:0;} .s{font-size:11px;}</style>');
// テキストを追加します
$tableData = [
    ['消費税率', '対象額', '消費税額'],
    ['8%', '0円', '0円'],
    ['10%', '5,500円', '550円'],
];

$html = '<table class="r" style="text-align:right;margin-top:10x;font-size:11px;" border="0" cellspacing="0" cellpadding="2"><tr><td colspan="3" style="border-bottom:1px solid;">消費税</td></tr>';
foreach ($tableData as $row) {
    $html .= '<tr>';
    foreach ($row as $cell) {
        $html .= '<td>' . $cell . '</td>';
    }
    $html .= '</tr>';
}
$html .= '<tr><td colspan="2" style="border-top:1px solid;">消費税合計</td><td style="border-top:1px solid;">550円</td><tr></table>';
$date = date('Y/m/d H:i:s');
$mpdf->WriteHTML('<h1>領収書</h1>');
$mpdf->WriteHTML('<p>日付：'.$date.'</p>');
$mpdf->WriteHTML('<p class="r b">フレッシュマーケット</p>');
$mpdf->WriteHTML('<p class="r b s">長野県茅野市玉川4523-1</p>');
$mpdf->WriteHTML('<p class="r b s">TEL:0266-55-5905</p>');
$mpdf->WriteHTML('<p class="r b s">登録番号:T000000000000</p>');
$mpdf->WriteHTML('<table border="0" style="width:100%;margin-top:10px;"><tr><th colspan="4" style="text-align:center;border-bottom:1px solid;">明細</th></tr><tr><th>商品名</th><th>数量</th><th>単価</th><th>合計</th></tr><tr><td>商品A</td><td class="r">2</td><td class="r">1,000円</td><td class="r">2,000円</td></tr><tr><td>商品B</td><td class="r">3</td><td class="r">500円</td><td class="r">1,500円</td></tr><tr><td>商品C</td><td class="r">1</td><td class="r">2,000円</td><td class="r">2,000円</td></tr></table>');
$mpdf->WriteHTML('<p class="r">小計：5,500円</p>');
$mpdf->WriteHTML($html);
$mpdf->WriteHTML('<p class="r">合計：6,050円</p>');

// PDFファイルを出力します
$dname="領収書.pdf";

$mpdf->Output($dname,"I");
return;
exit();
//$mpdf->Output('receipt.pdf', 'D');
