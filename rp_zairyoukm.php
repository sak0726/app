<?php
	$this->load->database('t');
	$this->load->library('session');
	$sid=$_SESSION['user_id'];
	$tb='tmp_zai'.$sid;
		$m_rows=19;//1ページの表示行数

		$qarr=array();//発注データ
		$rarr=array();//行数
		$zarr=array();//材料屋
		$tarr=array();//金額
		$parr=array();//ページ

		$tp=0;
		//材料屋情報取得
		$wa=array(
			'z_ck='=>1,
			'z_store !='=>'0',
			'z_store !='=>NULL
		);
		$this->db->select('z_store')->distinct('z_store')->from($tb)->where('z_store!=','在庫');
		$query=$this->db->get();

		$garr=array();
		foreach($query->result() as $g){
			$this->db->select('*');
			$this->db->where('g_name',$g->z_store);
			$zai=$this->db->get('gaityu',true);
				array_push($zarr,$zai);
		}
			$cnt=count($zarr);

		//材料屋ごとのデータ
		foreach($query->result() as $v){
			$this->db->where('z_store',$v->z_store);
			$this->db->order_by('id');
			$fstdata=$this->db->get($tb);
			$zcnt=$fstdata->num_rows();
				array_push($qarr,$fstdata);//発注データ
				array_push($rarr,$zcnt);//行数
			foreach($fstdata->result() as $t){
				$tp=$tp+$t->z_total;//合計金額
			}
				array_push($tarr,$tp);
			$pages=ceil($zcnt / $m_rows);
				array_push($parr,$pages);//ページ数

			//リセット
			$fstdata='';
			$tp=0;
			
		}
			
require_once __DIR__.'/../../vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
	'orientation'=>'L',
	'margin_header'=>5,
	'margin_top'=>15,
	'margin_bottom'=>5,
	'margin-left'=>0,
	'margin-right'=>0,
	'margin_footer'=>5,
	'format'=>'A4',
	'fontdata' => [
	    'ipa' => [
		    'R' => 'ipam.ttf'
		]
	]
]);

$header="<p style='width:100%;text-align:center;font-size:24px;font-weight:0;'>発注書</p>";
$footer="<div style='border-bottom:1px solid #000;font-size:12px;margin-top:20px;font-weight:0;'>備考:</div>";
$mpdf->SetHTMLHeader($header);
$mpdf->setTitle("発注書");
$stylesheet = file_get_contents('css/style.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
if(isset($_GET['ck'])){
	if($_GET['ck']==="1"){
		$mpdf->SetWatermarkText('特急');
	}else{
		$mpdf->SetWatermarkText('');
	}
}else{
	$mpdf->SetWatermarkText('');
}
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;
$tel=$jisya->j_tel;
$fax=$jisya->j_fax;
$tel="(".substr($tel,0,4).")".substr($tel,4,2)."-".substr($tel,6,4);
$me="<span><img style='margin-left:920px;margin-top:5px;' src='https://saksv.xbiz.jp/koumu/img/s_kenchiku.jpg' alt='logo' width='60px'>
<div style='text-align:right;font-weight:0;'><p style='margin:0px 0 10px 0;font-weight:0;'>".$jisya->j_name."</p><p style='font-weight:0;margin:0px;'>〒".substr($jisya->j_zip,0,3)."-".substr($jisya->j_zip,3). " ".$jisya->j_add."</p>
<p style='margin:0px;font-weight:0;'>TEL:".$tel."/FAX:".$tel."</p></div></div></span>";
$ts="<div id='pdf'>
	<table class='pm' style='position:relative;margin-top:5px;font-size:15px;'>
	<tr>
	<th style='width:40px;'>No.</th>
	<th style='width:80px;'>管理番号</th>
	<th colspan='2'>項目</th>
	<th colspan='4'>型番</th>
	<th style='width:60px;!important'>数量</th>
	<th style='width:60px;!important'>単位</th>
	<th style='width:80px;!important'>単価</th>
	<th style='width:80px;!important'>金額</th>
	<th colspan='2' style='width:80px;!important'>備考</th>
	</tr>";
$l=0;
$k=0;
$page=0;
$gk=0;
	for($i=0;$i<$cnt;$i++){
		foreach($zarr[$i]->result() as $g){//発注先ごと
			$page++;
			$st='';
			$k=0;
			$head="<div style='position:relative;border-bottom:1px solid #000;padding:0 0 0 10px;font-size:15px;font-weight:0;'>".$g->g_seisyou."　御中</div>";
			$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:100px;padding:0 0 0 10px;'>"." 発 注 日 : 2020/06/01 </div>";
			if($g->g_seisyou=="諏訪設備"){
				$head=$head."<div style='font-size:15px;font-weight:800;position:absolute;top:100px;left:300px;padding:0 0 0 10px;'>"." 希望工期 : ～2020/06/22</div>";
				$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:160px;padding:0 0 0 10px;'>"." 合計金額 : ￥".number_format($tarr[$i])."</div>";
	
			$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:130px;padding:0 0 0 10px;'>"." 納品場所 : (株)フェローテックセラミックス様 新社屋</div>";
			}
			else{
				$head=$head."<div style='font-size:15px;font-weight:800;position:absolute;top:100px;left:300px;padding:0 0 0 10px;'>"." 希望納期 : 2020/06/08</div>";
				$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:160px;padding:0 0 0 10px;'>"." 合計金額 : ￥".number_format($tarr[$i])."</div>";
	
				$head=$head."<div style='font-size:15px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:130px;padding:0 0 0 10px;'>"." 納品場所 : 弊社</div>";
			}
			foreach($qarr[$i]->result() as $v){//メインデータ
				$k++;
				$l++;
				$st=$st.'<tr>
				<td style="padding:0.25em; border-top:3px solid #000;text-align:center;">'.$k.'</td>
				<td style="padding:0.25em; border-top:3px solid #000;text-align:center;">'.$v->z_keyNum.'</td>
				<td colspan="2" style="text-align:center;padding:2px 0px 2px 2px;font-size:18px;">'.$v->material.'</td>
				<td style="border-right:none;text-align:left;padding:2px 0px 2px 5px;font-size:18px;">'.$v->a.'</td>
				<td style="border-right:none;border-left:none;text-align:left;padding:2px 0px 2px 5px;font-size:18px;">'.$v->b.'</td>
				<td style="border-left:none;border-right:none;text-align:center;"></td>
				<td style="border-left:none;text-align:left;padding:2px 0px 2px 5px;font-size:18px;">'.$v->c.'</td>
				<td>'.number_format($v->z_quan).'</td>
				<td></td>
				<td>'.number_format($v->z_tanka).'</td>
				<td>'.number_format($v->z_total).'</td>
				<td colspan="2" style="text-align:left;padding-left:2px;">'.$v->z_com.'</td>
				</tr>';
				$gk=$gk+$v->z_total;
				$pg=$m_rows*$page;//表示件数の倍数を取得
				if($k===$pg){//表示件数と一致したら改ページ
					$dp="<div style='position:absolute;top:55px;right:60px;font-size:15px;font-weight:0;'>".$page."/".$parr[$i]."</div>";
					
					$te="<tr>
					<td colspan='11' style='border-left:0.5px solid rgb(47, 47, 47);'>小　　　計</td>
					<td colspan='3' style='padding:0 10px 0 0;'> ￥".number_format($gk)."</td>
					</tr>	
					</table>
					<table style='border:none;margin-top:0px;font-size:12px;'>
					<tr style='border:none;text-align:left;margin-top:1px;font-weight:0;font-size:12px;'>
					<td colspan='11' style='border:none;text-align:left;'>※本書に消費税は含まれておりません。</td>
					<td style='text-align:right;border:none;'>".$page."/".$parr[$i]."ページ</td>
					</tr></table>
						";
					$p=$head.$dp.$me.$ts.$st.$te;
					$mpdf->WriteHTML($p);
					$mpdf->AddPage();//改ページ
					$st='';
					$page++;
					$l=0;
					$gk=0;

				}

			}

			if($m_rows-$l>0){//空欄埋め　手書き追加にも対応
				for($m=0;$m<$m_rows-$l;$m++){
					$st=$st."
					<tr><td style='padding:0.25em;'>-</td>
					<td></td><td colspan='2'></td>
					<td colspan='4'></td>
					<td></td><td></td><td></td><td></td><td colspan='2'></td>
					</tr>";
				}
			}
			$l=0;
			$dp="<div style='position:absolute;top:55px;right:60px;font-size:15px;font-weight:0;'>".$page."/".$parr[$i]."</div>";
			$te="<tr>
				<td colspan='11' style='border-left:0.5px solid rgb(47, 47, 47);'>小　　　計</td>
				<td colspan='3' style='padding:0 10px 0 0;'> ￥".number_format($gk)."</td>
				</tr>
				</table>
				<table style='border:none;margin-top:0px;font-size:12px;'>
				<tr style='border:none;text-align:left;margin-top:1px;font-weight:0;font-size:12px;'>
				<td colspan='11' style='border:none;text-align:left;'>※本書に消費税は含まれておりません。</td>
				<td style='text-align:right;border:none;'>".$page."/".$parr[$i]."ページ</td>
				</tr></table>";

			$p=$head.$dp.$me.$ts.$st.$te;
			$mpdf->WriteHTML($p);
			$page=0;
			$gk=0;
			//客先ごとデータ出力完了
			if($i<$cnt-1){
				$mpdf->AddPage();//最後の客先以外改ページ
			}

		}
	}

	

$dname="発注書.pdf";
$mpdf->Output($dname,"I");
return;
exit();
?>