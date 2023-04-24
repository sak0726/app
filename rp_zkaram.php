<?php
	$this->load->database('t');
		$m_rows=20;//1ページの表示行数			


require_once __DIR__.'/../../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
	'orientation'=>'L',
	'margin_header'=>5,
	'margin_top'=>15,
	'margin_bottom'=>10,
	'margin-left'=>5,
	'margin-right'=>5,
	'margin_footer'=>0,
	'format'=>'A4',
	'fontdata' => [
	    'ipa' => [
		    'R' => 'ipam.ttf'
		]
	]
]);

$header="<p style='width:100%;text-align:center;font-size:24px;'>見積依頼書</p>";
$footer="<div style='border-bottom:1px solid #000;font-size:12px;margin-top:20px;font-weight:0;'>備考:</div>";
$mpdf->SetHTMLHeader($header);
$mpdf->setTitle("見積依頼書");
$stylesheet = file_get_contents('css/style.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->SetWatermarkText('');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;
$tel=$jisya->j_tel;
$fax=$jisya->j_fax;
$tel="(".substr($tel,0,4).")".substr($tel,4,2)."-".substr($tel,6,4);
$me="<span><div style='text-align:right;font-weight:0;'><p style='margin:20px 0 10px 0;font-weight:0;'>".$jisya->j_name."</p><p style='font-weight:0;margin:0px;'>〒".$jisya->j_zip." ".$jisya->j_add."</p>
<p style='margin:0px;font-weight:0;'>TEL:".$tel."/FAX:".$tel."</p></div></div></span>";
$ts="<div id='pdf'>
	<table class='pm' style='margin-top:5px;font-size:15px;'>
	<tr>
	<th style='width:40px;'>No.</th>
	<th style='width:80px;'>管理番号</th>
	<th colspan='2'>材質</th>
	<th colspan='5'>寸法</th>
	<th style='width:60px;!important'>数量</th>
	<th style='width:80px;!important'>単価</th>
	<th style='width:80px;!important'>金額</th>
	<th colspan='2' style='width:80px;!important'>備考</th>
	</tr>";


			

			$head="<div style='position:relative;border-bottom:1px solid #000;padding:20px 0 0 10px;font-size:15px;font-weight:0;'></div>";
			$head=$head."<div style='font-size:15px;font-weight:800;position:absolute;top:55px;left:400px;padding:0 0 0 10px;'>御中</div>";
			$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:90px;padding:0 0 0 10px;'>"." 日　　付 : </div>";
			$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:115px;padding:0 0 0 10px;'>"." 件　　名 : 見積依頼</div>";
			$k=0;
			$st='';
			for($i=0;$i<20;$i++){
				$k++;
				$st=$st.'<tr>
				<td style="padding:0.25em; border-top:3px solid #000;text-align:center;">'.$k.'</td>
				<td style="padding:0.25em; border-top:3px solid #000;text-align:center;"></td>
				<td colspan="2" style="text-align:center;padding:2px 0px 2px 2px;font-size:18px;"></td>
				<td style="border-right:none;text-align:left;padding:2px 0px 2px 5px;font-size:18px;"></td>
				<td style="border-left:none;border-right:none;text-align:center;">x</td>
				<td style="border-right:none;border-left:none;text-align:left;padding:2px 0px 2px 5px;font-size:18px;"></td>
				<td style="border-left:none;border-right:none;text-align:center;">x</td>
				<td style="border-left:none;text-align:left;padding:2px 0px 2px 5px;font-size:18px;"></td>
				<td></td>
				<td></td>
				<td></td>
				<td colspan="2"></td>
				</tr>';
			}
			$te="</table>
				<table style='border:none;margin-top:0px;font-size:12px;'>
				<tr style='border:none;text-align:left;margin-top:1px;font-weight:0;font-size:12px;'>
				<td colspan='11' style='border:none;text-align:left;'></td>
				<td style='text-align:right;border:none;'></td>
				</tr></table>";

			$p=$head.$me.$ts.$st.$te;
			$mpdf->WriteHTML($p);

	

$dname="材料見積依頼書.pdf";
$mpdf->Output($dname,"I");
return;
exit();
?>