<?php
	$this->load->database('t');
		$m_rows=26;//1ページの表示行数

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

			
			for($i=0;$i<$pages;$i++){//表示行数ずつデータ取得
			$this->db->select('*')->from('tbmeisai')->where('m_key=',$id)->order_by('num asc')->limit($m_rows,$i*$m_rows);
			$query=$this->db->get();
			$t_val=$query->num_rows();
				array_push($qarr,$query);//それぞれのデータ
				array_push($rarr,$t_val);//表示行数
			$s_rows=$val - $m_rows;
			foreach($query->result() as $q){
				$tp=$tp + $q->z_total;//表示ページごとの合計金額
			}
			array_push($arr,$tp);
			$tp=0;
		
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

$header="<p style='width:30%;text-align:center;margin:10px auto;font-size:24px;font-weight:0;'>納品書</p>";
$footer="<div style='border-bottom:1px solid #000;font-size:12px;margin-top:20px;font-weight:0;'>備考:</div>";
$mpdf->SetHTMLHeader($header);
$mpdf->setTitle("請求書");
$stylesheet = file_get_contents('css/style.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->SetWatermarkText('');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;
$head="<div style='font-size:14px;font-weight:0;position:absolute;top:15px;right:15px;'>発行日 ".date('Y/m/d',strtotime($main->sk_day))."</div>";
$head=$head."<div style='font-size:14px;font-weight:0;position:absolute;top:112px;right:60px;'></div>";

if($main->c_zip!="" || $main->c_zip!=NULL){
	$zip=substr($main->c_zip,0,3)."-".substr($main->c_zip,3);
	if($main->c_add!="" || $main->c_add!=NULL){
	$head.="<div style='margin-bottom:15px;font-size:15px;font-weight:0;'> 〒".$zip." ".$main->c_add."</div>";
	}
}else{
	$head.="<div style='margin-bottom:15px;font-size:15px;font-weight:0;'>　</div>";
};

if($main->c_type==0){
	$head.="<div style='position:relative;border-bottom:1px solid #000;padding:0 0 0 10px;font-size:16px;font-weight:0;'>".$main->cust."　御中</div>";
}else{
	$head.="<div style='position:relative;border-bottom:1px solid #000;padding:0 0 0 10px;font-size:16px;font-weight:0;'>".$main->cust."　様</div>";
};
$head=$head."<div style='position:absolute;top:90px;right:60px;font-size:14px;font-weight:0;'>管理番号:".$id."</div>";
$head=$head."<div style='font-size:14px;border-bottom:1px solid #000;font-weight:800;width:30%;position:absolute;top:120px;left:70px;padding:0 0 0 10px;'>"." 注文番号 : ".$main->k_odNum."</div>";
$head=$head."<div style='font-size:14px;border-bottom:1px solid #000;font-weight:800;width:60%;position:absolute;top:145px;left:70px;padding:0 0 0 10px;'>"." 件　　名 : ".$main->kenmei."</div>";
$head=$head."<div style='font-size:14px;border-bottom:1px solid #000;font-weight:800;width:60%;position:absolute;top:170px;left:70px;padding:0 0 0 10px;'>"." 工　　期 : ".date('Y/m/d',strtotime($main->jutyu_D))." から ".date('Y/m/d',strtotime($main->nouki))."</div>";
$head=$head."<div style='font-size:14px;border-bottom:1px solid #000;font-weight:800;width:60%;position:absolute;top:195px;left:70px;padding:0 0 0 10px;'>"." 完 了 日 : ".date('Y/m/d',strtotime($main->nouhin_D))."</div>";
$head=$head."<div style='font-size:18px;border-bottom:1px solid #000;font-weight:800;width:282px;position:absolute;top:225px;left:70px;padding:0 0 0 10px;'>"." 合計金額 : ￥".number_format($kei->total)."<span style='font-size:12px'></span></div>";
$head=$head."<div style='font-size:12px;font-weight:800;width:45%;position:absolute;top:250px;left:70px;padding:0 0 0 00px;'>"." 消費税はご請求時に計上させて頂きます。</div>";

$yb=$jisya->j_zip;
$yb=substr($yb,0,3)."-".substr($yb,3);
$tel=$jisya->j_tel;
$fax=$jisya->j_fax;
$tel="(".substr($tel,0,4).")".substr($tel,4,2)."-".substr($tel,6,4);
$me="<div style='text-align:right;font-weight:0;position:relative;'>
<img style='position:absolute;margin:30px 40px 0 0;' src='https://saksv.xbiz.jp/koumu/img/s_kenchiku.jpg' alt='logo' width='80px'>
<p style='margin:0px 50px 10px 0;font-size:16px;font-weight:0;'>".$jisya->j_name."</p>
<p style='font-weight:0;margin:0px;'>〒".$yb." ".$jisya->j_add."</p>
<p style='margin:0px;font-weight:0;'>TEL:".$tel."/FAX:".$tel."</p>
</div></div>";
$ts="<div id='pdf'><table class='pm' style='margin-top:5px;font-size:15px;'><tr><th style='width:30px;'>#</th><th colspan='8'>項目</th><th style='width:60px;!important'>数量</th><th>単位</th><th style='width:80px;!important'>単価</th><th style='width:80px;!important'>金額</th></tr>";
$st='';
$l=1;

for($k=0;$k<$pages;$k++){
	$page=$k+1;
	$stLen;
	$meisai_kei=0;
	$bekken=0;
		foreach($qarr[$k]->result() as $v){
			if($v->tanka==0){$tanka="-";}else{$tanka=number_format($v->tanka);}
			$meisai_kei+=$v->z_total;
			if($v->quan>0){
				$st=$st.'<tr><td style="padding:0.25em;">'.$l.'</td><td colspan="8" style="padding:0.25em;text-align:left;">'.$v->zuban.'&nbsp;'.$v->hinmei.'</td><td>'.number_format($v->quan).'</td><td style="text-align:center;">'.$v->tani.'</td><td>'.$tanka.'</td><td>'.number_format($v->z_total).'</td></tr>';
			}else{
				$st=$st.'<tr><td style="padding:0.25em;"></td><td colspan="10" style="padding:0.25em;text-align:right;">小計</td><td colspan="2">'.number_format($meisai_kei).'</td></tr>';
				$st=$st.'<tr><th style="padding:0.25em;"></th><th colspan="12" style="padding:0.25em;text-align:center;">'.$v->zuban.'&nbsp;'.$v->hinmei.'</th></tr>';
				$bekken=$bekken+3;
				$meisai_kei=0;
				$l=0;
			}
			$l++;
		}

		if($bekken>0){$st=$st.'<tr><td style="padding:0.25em;"></td><td colspan="10" style="padding:0.25em;text-align:right;">小計</td><td colspan="2">'.number_format($meisai_kei).'</td></tr>';}
		$cnt=$m_rows-$rarr[$k]-$bekken;//表示可能行数からデータ数を引いて空欄で埋める
	for ($i=0;$i<$cnt;$i++){
		$st=$st."<tr><td style='padding:0.25em;'>-</td>
		<td colspan='8'></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td></tr>";
		$l++;
	}
	$te="<tr><td colspan='11' style='border-left:0.5px solid rgb(47, 47, 47);'>小　　　計</td><td colspan='2' style='padding:0 10px 0 0;'> ￥".number_format($arr[$k])."</td></tr></table>
	<table style='border:none;margin-top:0px;font-size:12px;'><tr style='border:none;text-align:left;margin-top:1px;font-weight:0;font-size:12px;'><td colspan='11' style='border:none;text-align:left;'></td><td style='text-align:right;border:none;'>".$page."/".$pages."ページ</td></tr></table>";
	$p=$head.$me.$ts.$st.$te.$footer;
	$mpdf->WriteHTML($p);
	$st='';
}

$p="";
$st="";
$dname=$main->cust."-納品書No.".$id.".pdf";
$mpdf->Output($dname,"I");
return;
exit();
?>