<?php

	$this->load->database('t');
	$this->load->library('session');
	$t=$_SESSION['user_id'];
		$m_rows=29;//1ページの表示行数

		$this->db->select('kt_gai')->distinct('kt_gai')->from('tmp_kt'.$t);
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
			$this->db->join('tbmeisai',$tb.'.ktid= tbmeisai.m_id');
			$this->db->join('gaityu',$tb.'.kt_gai=gaityu.g_name');
			$this->db->where($tb.".kt_gai",$v->kt_gai);
			$this->db->order_by($tb.'.id');
			$fstdata=$this->db->get($tb);
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
$header="<p style='width:30%;text-align:center;margin:10px auto;font-size:24px;font-weight:0;'>発注書</p>";
$footer="<div style='border-bottom:1px solid #000;font-size:12px;margin-top:20px;font-weight:0;'>備考:</div>";
$mpdf->SetHTMLHeader($header);
$mpdf->setTitle("発注書");
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
$me="<span><div style='text-align:right;font-weight:0;'><p style='margin:60px 0 23px 0;font-weight:0;'>".$jisya->j_name."</p><p style='font-weight:0;margin:0px;'>〒".$yb." ".$jisya->j_add."</p>
<p style='margin:0px;font-weight:0;'>TEL:".$tel."/FAX:".$tel."</p></div></div></span>";
$ts="<div id='pdf'><table class='pm' style='margin-top:5px;font-size:15px;'><tr><th style='width:30px;'>#</th><th>発注No</th><th colspan='4'>図番</th><th colspan='4'>品名</th><th style='width:60px;!important'>数量</th><th style='width:80px;!important'>単価</th><th style='width:80px;!important'>金額</th></tr>";
//ここまで共通
for($k=0;$k<$fcnt;$k++){
	foreach($garr[$k]->result() as $g){
		$head="<div style='position:relative;border-bottom:1px solid #000;padding:0 0 0 10px;font-size:15px;font-weight:0;'>".$g->g_seisyou."　御中</div>";
		$head=$head."<div style='position:absolute;top:55px;right:60px;font-size:15px;font-weight:0;'>発注日:".date('Y/m/d',strtotime($qarr[$k]->row('kt_hatyu')))."</div>";
		$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:120px;padding:0 0 0 10px;'>"." 合計金額 : ￥".number_format($arr[$k])."</div>";
		$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:150px;padding:0 0 0 10px;'>"." 希望納期 : ".date('Y/m/d',strtotime($qarr[$k]->row('kt_nouki')))."</div>";
		$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:180px;padding:0 0 0 10px;'>"." 件　　名 : 部品製作</div>";
		
		$l=1;
		$st='';
		foreach($qarr[$k]->result() as $v){
		$st=$st.'<tr><td style="padding:0.25em;">'.$l.'</td><td style="padding:0.25em;text-align:center;">'.$v->k_keyNum.'</td><td colspan="4" style="text-align:left;">'.$v->zuban.'</td><td colspan="4" style="text-align:left;padding-left:3px;">'.$v->hinmei.'</td><td>'.number_format($v->kt_quan).'</td><td>'.number_format($v->kt_tanka).'</td><td>'.number_format($v->kt_total).'</td></tr>';
		$l++;
		}
	
		$cnt=$m_rows-$rarr[$k];//表示可能行数からデータ数を引いて空欄で埋める

		for ($i=0;$i<$cnt;$i++){
			$st=$st."<tr><td style='padding:0.25em;'>-</td><td></td>
			<td colspan='4'></td>
			<td colspan='4'></td>
			<td></td>
			<td></td>
			<td></td></tr>";
		}

		$page=1;
		$te="<tr><td colspan='11' style='border-left:0.5px solid rgb(47, 47, 47);'>小　　　計</td><td colspan='2' style='padding:0 10px 0 0;'> ￥".number_format($arr[$k])."</td></tr></table>
		<table style='border:none;margin-top:0px;font-size:12px;'><tr style='border:none;text-align:left;margin-top:1px;font-weight:0;font-size:12px;'><td colspan='11' style='border:none;text-align:left;'>※本書に消費税は含まれておりません。</td><td style='text-align:right;border:none;'>".$page."/".$pages."ページ</td></tr></table>";
		$p=$head.$me.$ts.$st.$te.$footer;
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