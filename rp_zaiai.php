<?php
	$this->load->database('t');
		$m_rows=20;//1ページの表示行数

		$qarr=array();//発注データ
		$rarr=array();//行数
		$zarr=array();//材料屋
		$parr=array();//ページ

		$tp=0;
		$cnt=count($store);

		for($i=0;$i<$cnt;$i++){
			$this->db->select('g_symb,g_name,g_seisyou');
			$this->db->where('g_name',$store[$i]);
			$zai=$this->db->get('gaityu');
				array_push($zarr,$zai);
		}
		$cnt=count($zarr);

		//材料屋ごとのデータ
			
			$this->db->where('z_ck',1);
			$this->db->order_by('id');
			$fstdata=$this->db->get('tbz');
			$zcnt=$fstdata->num_rows();

			$pages=ceil($zcnt / $m_rows);


			
					
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
$mpdf->setTitle("材料見積依頼書");
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
$l=0;
$k=0;
$page=0;
$gk=0;

	for($i=0;$i<$cnt;$i++){
		foreach($zarr[$i]->result() as $g){
			$st='';
			$page++;

			$head="<div style='position:relative;border-bottom:1px solid #000;padding:0 0 0 10px;font-size:15px;font-weight:0;'>".$g->g_seisyou."　御中</div>";
			$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:90px;padding:0 0 0 10px;'>"." 日　　付 : ".date('Y/m/d')."</div>";
			$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:115px;padding:0 0 0 10px;'>"." 件　　名 : 見積依頼</div>";
			
			foreach($fstdata->result() as $v){
				$k++;
				$l++;
				$st=$st.'<tr>
				<td style="padding:0.25em; border-top:3px solid #000;text-align:center;">'.$k.'</td>
				<td style="padding:0.25em; border-top:3px solid #000;text-align:center;">'.$v->z_keyNum.'</td>
				<td colspan="2" style="text-align:center;padding:2px 0px 2px 2px;font-size:18px;">'.$v->material.'</td>
				<td style="border-right:none;text-align:left;padding:2px 0px 2px 5px;font-size:18px;">'.$v->a.'</td>
				<td style="border-left:none;border-right:none;text-align:center;">x</td>
				<td style="border-right:none;border-left:none;text-align:left;padding:2px 0px 2px 5px;font-size:18px;">'.$v->b.'</td>
				<td style="border-left:none;border-right:none;text-align:center;">x</td>
				<td style="border-left:none;text-align:left;padding:2px 0px 2px 5px;font-size:18px;">'.$v->c.'</td>
				<td>'.number_format($v->z_quan).'</td>
				<td>'.number_format($v->z_tanka).'</td>
				<td>'.number_format($v->z_total).'</td>
				<td colspan="2"></td>
				</tr>';
				$pg=$m_rows*$page;//表示件数の倍数を取得
				if($k===$pg){//表示件数と一致したら改ページ
					$dp="<div style='position:absolute;top:55px;right:60px;font-size:15px;font-weight:0;'>".$page."/".$pages."</div>";
					
					$te="</table>
					<table style='border:none;margin-top:0px;font-size:12px;'>
					<tr style='border:none;text-align:left;margin-top:1px;font-weight:0;font-size:12px;'>
					<td colspan='11' style='border:none;text-align:left;'></td>
					<td style='text-align:right;border:none;'>".$page."/".$pages."ページ</td>
					</tr></table>
						";
					$p=$head.$dp.$me.$ts.$st.$te;
					$mpdf->WriteHTML($p);
					$mpdf->AddPage();//改ページ
					$st='';
					$page++;
					$l=0;

				}

			}
			if($m_rows-$l>0){//空欄埋め　手書き追加にも対応
				for($m=0;$m<$m_rows-$l;$m++){
					$st=$st."
					<tr><td style='padding:0.25em;'>-</td>
					<td></td><td colspan='2'></td>
					<td colspan='5'></td>
					<td></td><td></td><td></td><td colspan='2'></td>
					</tr>";
				}
			}
			$dp="<div style='position:absolute;top:55px;right:60px;font-size:15px;font-weight:0;'>".$page."/".$pages."</div>";
			$te="</table>
				<table style='border:none;margin-top:0px;font-size:12px;'>
				<tr style='border:none;text-align:left;margin-top:1px;font-weight:0;font-size:12px;'>
				<td colspan='11' style='border:none;text-align:left;'></td>
				<td style='text-align:right;border:none;'>".$page."/".$pages."ページ</td>
				</tr></table>";

			$p=$head.$dp.$me.$ts.$st.$te;
			$mpdf->WriteHTML($p);
			$page=0;
			$l=0;
			$k=0;
			//客先ごとデータ出力完了
			if($i<$cnt-1){
				$mpdf->AddPage();//最後の客先以外改ページ
			}

		}
	}

	

$dname="材料見積依頼書.pdf";
$mpdf->Output($dname,"I");
return;
exit();
?>