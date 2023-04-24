<?php
	$this->load->database('t');
		$m_rows=29;//1ページの表示行数

        $id=$_GET['id'];
        $this->db->select('*')->from('tbmeisai')->where('m_key=',$id);
        $query=$this->db->get();
        $val=$query->num_rows();

		$this->db->select('od_num');
		$this->db->distinct();
		$this->db->from('tbmeisai');
		$this->db->where('m_key',$id);
		$odcnt=$this->db->count_all_results('',false);
		$result=$this->db->get();
		$qarr=array();
		$rarr=array();
		$arr=array();
		
		$tp=0;
		$tp2=0;
		$tp3=0;

		$pages=ceil($odcnt);
			/*for($i=0;$i<$pages;$i++){//表示行数ずつデータ取得
			$this->db->select('*')->from('tbmeisai')->where('m_key=',$id)->order_by('num asc')->limit($m_rows,$i*$m_rows);
			$query=$this->db->get();
			$t_val=$query->num_rows();
				array_push($qarr,$query);//それぞれのデータ
				array_push($rarr,$t_val);//表示行数
			$s_rows=$val - $m_rows;*/
			foreach($result->result() as $v){
				$this->db->select('m_key,num,od_num,od_no,jutyubi,zuban,hinmei,quan,tanka,z_total,kb_nouki');
				$this->db->where('m_key',$id);
				$this->db->where('od_num',$v->od_num);
				$this->db->order_by('num');
				$rcnt=$this->db->count_all_results('tbmeisai',false);
				$query=$this->db->get();
				array_push($qarr,$query);
				array_push($rarr,$rcnt);
			}
			foreach($query->result() as $q){
				$tp=$tp + $q->z_total;//表示ページごとの合計金額
			}
			array_push($arr,$tp);
			$tp=0;
		
			

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
$mpdf->setTitle("納品書");
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
$ts="<div id='pdf'><table class='pm' style='margin-top:5px;font-size:15px;'><tr><th style='width:30px;'>#</th><th colspan='4'>図番</th><th colspan='4'>品名</th><th style='width:60px;!important'>数量</th><th style='width:80px;!important'>単価</th><th style='width:80px;!important'>金額</th></tr>";
$st='';
$l=1;
$gk=0;
for($k=0;$k<$odcnt;$k++){
	$page=$k+1;
	$row=$result->row($k);
		$head="<div style='position:relative;border-bottom:1px solid #000;padding:0 0 0 10px;font-size:15px;font-weight:0;'>".$main->cust."　御中</div>";
		$head=$head."<div style='position:absolute;top:55px;right:60px;font-size:15px;font-weight:0;'>管理番号:".$id."</div>";
		$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:120px;padding:0 0 0 10px;'>"." 合計金額 : ￥".number_format($kei->total)."</div>";
		$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:150px;padding:0 0 0 10px;'>"." 注文番号 : ".$result->row($k)->od_num."</div>";
		$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:180px;padding:0 0 0 10px;'>"." 件　　名 : ".$main->kenmei."</div>";

		foreach($qarr[$k]->result() as $v){
			$st=$st.'<tr><td style="padding:0.25em;">'.$l.'</td><td colspan="4" style="text-align:left;">'.$v->zuban.'</td><td colspan="4" style="text-align:left;padding-left:3px;">'.$v->hinmei.'</td><td>'.number_format($v->quan).'</td><td>'.number_format($v->tanka).'</td><td>'.number_format($v->z_total).'</td></tr>';
			$gk=$gk+$v->z_total;
			$l++;
		}

	$cnt=$m_rows-$rarr[$k];//表示可能行数からデータ数を引いて空欄で埋める
	for ($i=0;$i<$cnt;$i++){
		$st=$st."<tr><td style='padding:0.25em;'>-</td>
		<td colspan='4'></td>
		<td colspan='4'></td>
		<td></td>
		<td></td>
		<td></td></tr>";
		$l++;
	}
	$te="<tr><td colspan='10' style='border-left:0.5px solid rgb(47, 47, 47);'>小　　　計</td><td colspan='2' style='padding:0 10px 0 0;'> ￥".number_format($gk)."</td></tr></table>
	<table style='border:none;margin-top:0px;font-size:12px;'><tr style='border:none;text-align:left;margin-top:1px;font-weight:0;font-size:12px;'><td colspan='11' style='border:none;text-align:left;'>※本書に消費税は含まれておりません。</td><td style='text-align:right;border:none;'>".$page."/".$pages."ページ</td></tr></table>";
	$p=$head.$me.$ts.$st.$te.$footer;
	$mpdf->WriteHTML($p);
	$st='';
	$gk=0;
	$l=1;
	if($page<$pages){
		$mpdf->AddPage();
	}

}

$p="";
$st="";
$dname=$main->cust."-見積No.".$id.".pdf";
$mpdf->Output($dname,"I");
return;
exit();
?>