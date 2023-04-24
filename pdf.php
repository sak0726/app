<?php
		$this->load->database('t');
		$m_rows=18;

        $id=$_GET['id'];
        $this->db->select('*')->from('tbmeisai')->where('m_key=',$id);
        $query=$this->db->get();
        $val=$query->num_rows();
		$tp=0;
		$tp2=0;
		$tp3=0;
		$qarr=array();
		$rarr=array();
		$arr=array();
		$pages=ceil($val / $m_rows);

			
			for($i=0;$i<$pages;$i++){
			$this->db->select('*')->from('tbmeisai')->where('m_key=',$id)->order_by('num asc')->limit($m_rows,$i*$m_rows);
			$query=$this->db->get();
			$t_val=$query->num_rows();
				array_push($qarr,$query);
				array_push($rarr,$t_val);
			$s_rows=$val - $m_rows;
			foreach($query->result() as $q){
				$tp=$tp + $q->t_price;
			}
			array_push($arr,$tp);
			$tp=0;
		
	}

require_once __DIR__.'/../../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
	'orientation'=>'L',
	'margin_header'=>5,
	'margin_top'=>15,
	'margin_bottom'=>10,
	'margin_footer'=>0,
	'format'=>'A4',
	'fontdata' => [
	    'ipa' => [
		    'R' => 'ipam.ttf'
		]
	]
]);
$header="<p style='width:30%;text-align:center;margin:0 auto;font-size:18px;'>お見積書</p>";
$footer="<div style='border-bottom:1px solid #000;font-size:15px;'>備考:".$main->kenmei."</div>";
$mpdf->SetHTMLHeader($header);
$mpdf->setTitle("見積書");
$stylesheet = file_get_contents('css/style.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->SetWatermarkText('');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;
$head="<div style='position:relative;border-bottom:1px solid #000;padding:0 0 0 10px;font-size:15px;'>".$main->cust."　御中</div>";
$head=$head."<div style='position:absolute;top:55px;right:60px;font-size:15px;'>見積番号:".$main->k_od_no."</div>";
//$head=$head."<div style='position:absolute;top:85px;left:68px;'>見積番号:".$main->o_number."</div>";
$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:50%;position:absolute;top:100px;padding:0 0 0 10px;'>"." 合計金額 : ￥".number_format($kei->t_price)."</div>";
$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:50%;position:absolute;top:130px;padding:0 0 0 10px;'>"." 予定納期 : 受注後２～３週間程度</div>";

$yb=$jisya->j_zip;
$yb=substr($yb,0,3)."-".substr($yb,3);
$tel=$jisya->j_tel;
$fax=$jisya->j_fax;
//$tel="(".substr($tel,0,4).")".substr($tel,4,2)."-".substr($tel,6,4);
//$fax="(".substr($fax,0,4).")".substr($fax,4,2)."-".substr($fax,6,4);

	$me="<span><div style='text-align:right;'><p style='margin-bottom:5px;'>".$jisya->j_name."</p>〒".$yb." ".$jisya->j_add."<br>
	TEL:".$tel."/FAX:".$fax."</div></div></span>";

	$ts="<div id='pdf'><table class='pm' style='margin-top:2px;font-size:15px;'><tr><th style='width:30px;'>#</th><th>種類</th><th colspan='3' style='width:600px!important;'>図番</th><th colspan='2'>品名</th><th>数量</th><th>単価</th><th>金額</th><th>備考</th></tr>";
$a='';
$l=1;
for($k=0;$k<$pages;$k++){
	$page=$k+1;
	
	$cnt=$m_rows - $rarr[$k];
	foreach($qarr[$k]->result() as $b){
		$aa=$b->atsu;
		$bb=$b->haba;
		$cc=$b->take;
		if ($bb==''){
			$bb='　x';
		}else{
			$bb="x　".$bb;
			$cc="x　".$cc;
		}
		$zai=$b->om_material;
		$matType=$b->mat_type;
		if ($matType<4){
		$a=$a."<tr><td style='border-right:1px solid #000;'>".$l."</td><td style='border-right:1px solid #000;'>".$zai."</td>
		<td style='width:100px;'>
			<table><tr>
			<td rowspan='2' class='hed' style='width:80px';>
			".$aa."
			</td>
			<td class='p'>
			".substr(strval($b->sap),1).$b->vap."
			</td>
			</tr>
			<tr>
			<td class='p'>
			".substr(strval($b->sam),1).$b->vam."
			</td>
			</tr></table>	
		</td>
		<td style='width:100px;'>
			<table><tr>
			<td rowspan='2'>
			".$bb."
			</td>
			<td class='p'>
			".substr(strval($b->sbp),1).$b->vbp."
			</td>
			</tr>
			<tr>
			<td class='p'>
			".substr(strval($b->sbm),1).$b->vbm."
			</td>
			</tr></table>
		</td>
		<td style='border-right:1px solid #000;width:100px;'>
			<table><tr>
			<td rowspan='2'>
			".$cc."
			</td>
			<td class='p'>
			".substr(strval($b->scp),1).$b->vcp."
			</td>
			</tr>
			<tr>
			<td class='p'>
			".substr(strval($b->scm),1).$b->vcm."
			</td>
			</tr></table>
		</td>
		<td style='border-right:1px solid #000;'>".$b->f.$b->graind."</td>
		<td style='border-right:1px solid #000;'>".$b->men."</td>
		<td style='border-right:1px solid #000;'>".$b->kazu."</td><td style='border-right:1px solid #000;'>".number_format($b->price)."</td><td style='border-right:1px solid #000;'>".number_format($b->t_price)."</td>
		<td style='width:200px;'>".$b->om_mes."</td></tr>";
		
	}elseif($matType==5){
		$a=$a."<tr><td style='border-right:1px solid #000;'>".$l."</td><td style='border-right:1px solid #000;'>".$zai."</td>
		<td colspan='3' style='border-right:1px solid #000;'>".$b->atsu."</td>
		<td colspan='2' style='border-right:1px solid #000;'>".$b->haba."</td>
		<td style='border-right:1px solid #000;'>".$b->kazu."</td><td style='border-right:1px solid #000;'>".number_format($b->price)."</td><td style='border-right:1px solid #000;'>".number_format($b->t_price)."</td>
		<td style='width:200px;'>".$b->om_mes."</td></tr>";
	}elseif($matType==4){
		$a=$a."<tr><td style='border-right:1px solid #000;'>".$l."</td><td style='border-right:1px solid #000;'>".$zai."</td>
		<td colspan='3' style='border-right:1px solid #000;'>".$b->atsu." x ".$b->haba." x ".$b->take."  (T".$b->t." t".$b->t2." r".$b->r.")</td>
		<td style='border-right:1px solid #000;'>".$b->f.$b->graind."</td>
		<td style='border-right:1px solid #000;'>".$b->men."</td>
		<td style='border-right:1px solid #000;'>".$b->kazu."</td><td style='border-right:1px solid #000;'>".number_format($b->price)."</td><td style='border-right:1px solid #000;'>".number_format($b->t_price)."</td>
		<td style='width:200px;'>".$b->om_mes."</td></tr>";
	}

	$l++;

}


	for ($i=0;$i<$cnt;$i++){
		$a=$a."<tr><td style='border-right:1px solid #000;padding:.32em 0;'>".$l."</td><td style='border-right:1px solid #000;box-shadow:0 1px 10px #000;'></td><td colspan='3' style='border-right:1px solid #000;width:600px!important;'>-</td><td colspan='2' style='border-right:1px solid #000;'></td><td style='border-right:1px solid #000;'>
		</td><td style='border-right:1px solid #000;'></td>
		<td style='border-right:1px solid #000;'></td><td style='border-right:1px solid #000;'></td></tr>";
		$l++;
	}
	$te="<tr><td colspan='9' style='border-right:1px solid #000;'>小　　　計</td><td colspan='2' style='padding:0 10px 0 0;'> ￥".number_format($arr[$k])."</td></tr></table><div style='text-align:right;margin-top:1px;'>".$page."/".$pages."</div>";
	$p=$head.$me.$ts.$a.$te.$footer;
	$mpdf->WriteHTML($p);
	$p='';
	$a='';
}
$dname=$main->cust."-見積No.".$main->k_od_no."pdf";
$mpdf->Output($dname,"I");
return;
exit();
?>