<?php
	$this->load->database('t');
		$m_rows=29;//1ページの表示行数
		$id=$_GET['id'];
		//$cnt=$od_head->num_rows();
		$cust=$main->row('cust');

		$this->db->select('od_num,od_no,num,zuban,hinmei,quan');
		$this->db->where('m_key',$id);
		$q=$this->db->get('tbmeisai');

require_once __DIR__.'/../../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
	'orientation'=>'P',
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

$header="<p style='width:30%;text-align:center;margin:10px auto;font-size:24px;font-weight:0;'>現品票</p>";
$footer="<div style='border-bottom:1px solid #000;font-size:12px;margin-top:20px;font-weight:0;'>備考:</div>";
$mpdf->SetHTMLHeader($header);
$mpdf->setTitle("現品票");
$stylesheet = file_get_contents('css/style.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->SetWatermarkText('');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;
$yb=$jisya->j_zip;
$yb=substr($yb,0,3).substr($yb,3);
$tel=$jisya->j_tel;
$fax=$jisya->j_fax;
$tel="(".substr($tel,0,4).")".substr($tel,4,2)."-".substr($tel,6,4);
$me="<span><div style='text-align:right;font-weight:0;'><p style='margin:60px 0 23px 0;font-weight:0;'></p><p style='font-weight:0;margin:0px;'>".$jisya->j_name."</p>
</div></div></span>";
$ts="<div id='pdf' style='display:flex;text-align:center;'>";
$st='';

	$i=0;
	foreach($q->result() as $v){
		if($i==0){
			$st=$st.'<table style="margin:0;"><tr>';
		}
		$st=$st.'<td><table style="margin:0px;"><tr><th>客先</th><td colspan="3" style="text-align:center;font-size:12px;">'.$cust.'</td></tr>';
		if($v->od_num){
			$st=$st.'<tr><th style="font-size:9px;">オーダーNo.</th><td colspan="3" style="text-align:center;">'.$v->od_num.'</td></tr>';
		}else{
			$st=$st.'<tr><th style="font-size:9px;">オーダーNo.</th><td colspan="3" style="text-align:center;">-</td></tr>';
		}
		if($v->od_no){
			$st=$st.'<tr><th style="font-size:9px;">注文No.</th><td colspan="3" style="text-align:center;">'.$v->od_no.'</td></tr>';
		}else{
			$st=$st.'<tr><th style="font-size:9px;">注文No.</th><td colspan="3" style="text-align:center;">-</td></tr>';
		}
		$st=$st.'<tr><th>図番</th><td colspan="3" style="text-align:center;">'.$v->zuban.'</td></tr>
					<tr><th>品名</th><td colspan="3" style="text-align:center;">'.$v->hinmei.'</td></tr>
					<tr><th style="width:25%;">数量</th><td style="width:25%;">'.$v->quan.'</td><th>#</th><td style="text-align:center;padding:0;font-size:14px;">'.$id.'</td></tr>
					<tr><td colspan="4" style="text-align:center;">'.$me.'</p></td></tr>
					</table></td>';
				$i++;

			if($i==3){
				$st=$st.'</tr></table>';
				$i=0;
			}
				
	}
		if($i==0){

		}else if($i!=3){
			for($i;$i<4;$i++){
				$st=$st.'<td><table style="margin:0px;"><tr><th>客先</th><td colspan="3" style="text-align:center;font-size:12px;">-</td></tr>
				<tr><th style="font-size:9px;">オーダーNo.</th><td colspan="3" style="text-align:center;">-</td></tr>
				<tr><th style="font-size:9px;">注文No.</th><td colspan="3" style="text-align:center;">-</td></tr>
				<tr><th>図番</th><td colspan="3" style="text-align:center;">-</td></tr>
				<tr><th>品名</th><td colspan="3" style="text-align:center;">-</td></tr>
				<tr><th style="width:25%;">数量</th><td style="width:25%;"></td><th>#</th><td style="text-align:center;padding:0;font-size:14px;">-</td></tr>
				<tr><td colspan="4" style="text-align:center;">'.$me.'</p></td></tr>
				</table></td>';
				$i++;
			}
			$st=$st.'</tr></table>';

		}

	$te="</div>";
	$p=$head.$ts.$st.$te.$footer;
	$mpdf->WriteHTML($p);
	$st='';

$dname="現品票.".$id.".pdf";
$mpdf->Output($dname,"I");
return;
exit();
?>