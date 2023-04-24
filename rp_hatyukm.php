<?php

	$this->load->database('t');
	$this->load->library('session');
	$t=$_SESSION['user_id'];
		$m_rows=20;//1ページの表示行数

		$this->db->select('kt_gai')->distinct('kt_gai')->from('tbkt')->where('id',144775);
        $query=$this->db->get();
		//外注情報取得
		$garr=array();
		foreach($query->result() as $g){
			$this->db->select('*');
			$this->db->where('g_name',$g->kt_gai);
			$gai=$this->db->get('gaityu');
				array_push($garr,$gai);
		}
        $fcnt=$query->num_rows();
		$tp=0;
		$tp2=0;
		$tp3=0;
		$qarr=array();
		$rarr=array();
		$arr=array();
		$parr=array();
		$gcnt=0;
		//外注ごとに発注データおよび件数を取得
		$tb='tmp_kt'.strval($t);
		foreach($query->result() as $v){
			$this->db->select('*');
			$this->db->where("kt_gai",$v->kt_gai);
			$this->db->order_by('id');
			$fstdata=$this->db->get('tbkt');
			$gcnt=$fstdata->num_rows();
				array_push($qarr,$fstdata);
				array_push($rarr,$gcnt);
			foreach($fstdata->result() as $t){
				$tp=$tp+$t->kt_total;
			}
				array_push($arr,$tp);
			$fstdata="";
			$tp=0;
			$pages=ceil($gcnt / $m_rows);
				array_push($parr,$pages);
		}


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
//共通
$header="<p style='width:30%;text-align:center;margin:10px auto;font-size:24px;font-weight:0;'>工事発注書</p>";
$footer="<div style='border-bottom:1px solid #000;font-size:12px;margin-top:20px;font-weight:0;'>備考: お支払いは従来通り</div>";
$mpdf->SetHTMLHeader($header);
$mpdf->setTitle("工事発注書");
$stylesheet = file_get_contents('css/style.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->SetWatermarkText('');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;
$yb=$jisya->j_zip;
$yb=substr($yb,0,3)."-".substr($yb,3);
$tel=$jisya->j_tel;
$fax=$jisya->j_fax;
$tel="(".substr($tel,0,4).")".substr($tel,4,2)."-".substr($tel,6,4);
$me="<span>
		<div style='text-align:right;font-weight:0;'>
			<img style='position:absolute;margin:0px 20px 0 0;' src='https://saksv.xbiz.jp/koumu/img/s_kenchiku.jpg' alt='logo' width='80px'>
			<p style='margin:10px 0 5px 0;font-weight:0;'>".$jisya->j_name."</p>
			<p style='font-weight:0;margin:0px;'>〒".$yb." ".$jisya->j_add."</p>
			<p style='margin:0px;font-weight:0;'>TEL:".$tel."/FAX:".$tel."</p>
		</div>
	</span>";
$ts="<div id='pdf'><table class='pm' style='margin-top:5px;font-size:15px;'><tr><th style='width:30px;'>#</th><th>発注No</th><th colspan='7'>項目</th><th style='width:60px;!important'>数量</th><th>単位</th><th style='width:80px;!important'>単価</th><th style='width:80px;!important'>金額</th></tr>";
//ここまで共通
for($k=0;$k<$fcnt;$k++){
	foreach($garr[$k]->result() as $g){
		$head="<div style='font-weight:0;margin:0 0 5px 10px;'>〒".substr($g->g_yubin,0,3)."-".substr($g->g_yubin,3)." ".$g->g_add."</div>
				<div style='position:relative;border-bottom:1px solid #000;padding:0 0 0 10px;font-size:15px;font-weight:0;'>".$g->g_seisyou."　御中</div>";
		$head=$head."<div style='position:absolute;top:79px;right:60px;font-size:15px;font-weight:0;'>発注日:".date('Y/m/d',strtotime($qarr[$k]->row('kt_hatyu')))."</div>";
		$hd="<div style='font-weight:0;font-size:15px;border-bottom:1px solid #000;width:80%;margin-top:10px;padding:0 0 0 10px;'>"." 工 事 名 : ".$qarr[$k]->row('kt_doc')."</div>";
		$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:150px;padding:0 0 0 10px;'>"." 合計金額 : ￥".number_format($arr[$k]).".- (税抜)</div>";
		$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:180px;padding:0 0 0 10px;'>"." 希望納期 : ".date('Y/m/d',strtotime($qarr[$k]->row('kt_nouki')))."</div>";
		$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:210px;padding:0 0 0 10px;'>"." 件　　名 : ".$qarr[$k]->row('koutei')."</div>";
		
		$l=1;
		$st='';
		foreach($qarr[$k]->result() as $v){
		$st=$st.'<tr><td style="padding:0.25em;">'.$l.'</td><td style="padding:0.25em;text-align:center;">'.$v->k_keyNum.'</td><td colspan="7" style="text-align:left;">'.$v->kt_doc.'</td><td>'.number_format($v->kt_quan).'</td><td style="text-align:center;">'.$v->kt_tani.'</td><td>'.number_format($v->kt_tanka).'</td><td>'.number_format($v->kt_total).'</td></tr>
				<tr><th colspan="13">摘要</th></tr>
				<tr><td colspan="13" style="text-align:left;">'.nl2br($v->kt_sub).'</td></tr>';
		$l++;
		}


		$page=1;
		$te="<tr><td colspan='11' style='border-left:0.5px solid rgb(47, 47, 47);'>小　　　計</td><td colspan='2' style='padding:0 10px 0 0;'> ￥".number_format($arr[$k])."</td></tr></table>
		<table style='border:none;margin-top:0px;font-size:12px;'><tr style='border:none;text-align:left;margin-top:1px;font-weight:0;font-size:12px;'><td colspan='11' style='border:none;text-align:left;'>※本書に消費税は含まれておりません。</td><td style='text-align:right;border:none;'>".$page."/".$pages."ページ</td></tr></table>";
		$p=$head.$hd.$me.$ts.$st.$te.$footer;
		$mpdf->WriteHTML($p);

		if($k<$fcnt-1){//最後の行のみ改行しない
			$mpdf->AddPage();
		}
	}
}


$dname="-発注書No.pdf";
$mpdf->Output($dname,"I");
return;
exit();
?>