<?php
	$this->load->database('t');

        $cust=json_decode($_GET['cust']);
		$y=$_GET['y'];
		$m=sprintf('%02d',$_GET['m']);
		$sime=$_GET['sime'];
		$cnt=count($cust);

		$kanri=array();
		$tp=0;
		$tparr=array();
		$cusar=array();
		$val=array();
		$marr=array();
		$cntar=array();
		$data=array();
		$mcarr=array();
		$rows=0;
		for($i=0;$i<$cnt;$i++){
			$this->db->select('`c_name`,`c_zip`,`c_add`');
			$this->db->where('c_name',$cust[$i]);
			$store=$this->db->get('customer');//顧客別ページヘッダー用顧客情報
				foreach($store->result() as $s){
					$ca=array(
						'c_name'=>$s->c_name,
						'c_zip'=>$s->c_zip,
						'c_add'=>$s->c_add
					);
					array_push($cusar,$ca);
				}
			if($sime!="末"){
				$d=date($y."/".$m."/".$sime);
				$md=date('Y/m/d',strtotime($d.'-1 month'));
				$this->db->select('`tbkanri.k_Kid`,`tbkanri.jutyu_D`,`tbkanri.nouhin_D`,`tbkanri.k_odNum`,`tbkanri.total`,`customer.c_zip`,`customer.c_add`');
				$this->db->join('customer','tbkanri.cust=customer.c_name');
				$this->db->where('tbkanri.nouhin_D>',$md);
				$this->db->where('tbkanri.nouhin_D<=',$d);
				$this->db->where('cust',$cust[$i]);

			}else{		
					$this->db->select('`k_Kid`,`jutyu_D`,`nouhin_D`,`k_odNum`,`total`');
					$this->db->where('cust',$cust[$i]);
					$this->db->where('DATE_FORMAT(nouhin_D,"%Y%m")',$y.$m);
			}
					$this->db->order_by('nouhin_D');
					$qcnt=$this->db->count_all_results('tbkanri',false);
					array_push($cntar,$qcnt);
					$q=$this->db->get();//明細ヘッダー鏡
			
					foreach($q->result() as $k){
						$tp+=$k->total;
						$this->db->where('m_key',$k->k_Kid);
						$this->db->order_by('num');
						$mei=$this->db->get('tbmeisai');//明細データ
						$mcnt=$mei->num_rows();
						$rows+=$mcnt;
						array_push($marr,$mei);
						array_push($mcarr,$mcnt);
					}
					$val=[$cusar,$q,$cntar,$marr,$tp,$mcarr,$rows];
					array_push($data,$val);
					array_push($tparr,$tp);
					$tp=0;
					$cusar=array();
					$q=array();
					$cntar=array();
					$marr=array();
					$mcarr=array();
					$val=array();
					$rows=0;
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

//$header="<div style='text-align:center;margin:10px 0 0 0;font-size:24px;font-weight:0;'>御請求書<span style='color:red;padding-left:200px;'>a</span></div><p style='text-align:right;margin-top:0px;font-weight:0;'>発行日 ".$_GET['hd']."</p>";
$h1="<p style='position:absolute;top:0;left:350px;font-size:24px;font-weight:0;'>御請求書</p>";
$h2="<p style='position:absolute;top:0;left:650px;font-size:14px;font-weight:0;'>発行日 ".$_GET['hd']."</p>";
$footer="<div style='border-bottom:1px solid #000;font-size:12px;margin-top:20px;font-weight:0;'>備考:</div>";
$mpdf->SetHTMLHeader($h1.$h2);
$mpdf->setTitle("請求書");
$stylesheet = file_get_contents('css/style.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->SetWatermarkText('');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;

$yb=$jisya->j_zip;
$yb="〒".substr($yb,0,3)."-".substr($yb,3);
$tel=$jisya->j_tel;
$fax=$jisya->j_fax;
$tel="(".substr($tel,0,4).")".substr($tel,4,2)."-".substr($tel,6,4);
//$koza=explode(" ",$jisya->j_kouza);
$me="<span>
<div style='text-align:right;font-weight:0;margin-bottom:5px;'>
<p style='font-size:12px;margin:0px 0 0 0;font-weight:0;'>事業所番号:".$jisya->jigyosya_no."</p>
<p style='margin:30px 0 0 0;font-weight:0;'>".$jisya->j_name."</p>
<p style='font-size:12px;font-weight:0;margin:10px 0 0 0;'>".$yb." ".$jisya->j_add."</p>
<p style='font-size:12px;margin:0px;font-weight:0;'>TEL:".$tel."/FAX:".$tel."</p>
<p style='font-size:12px;margin:0px;font-weight:0;'>お振込先口座:".$jisya->j_kouza."</p>
<p style='font-size:12px;margin:0px;font-weight:0;'>".$jisya->j_kouza2."</p>
<p style='font-size:12px;margin:0px;font-weight:0;'>名義:".$jisya->j_kouza_meigi2."</p>
</div></div></span>";
$st='';
$te;
$l=0;
// $data[0:$cusar(array),1:$q(array),2:$cntar(array),3:$marr(array),4:$tp,5:$mcnt];
for($i=0;$i<$cnt;$i++){
	if($data[$i][0][0]['c_zip']===NULL){
		$cy="1234567";
	}else{
		$cy=$data[$i][0][0]['c_zip'];
	}
	$cy="〒".substr($cy,0,3)."-".substr($cy,3);
	$cadd=$data[$i][0][0]['c_add'];
	$kei=$data[$i][4];
	$zei=$kei*0.1;
	$zkei=$kei+$zei;
	$head="<div style='margin-bottom:10px;padding:0 0 0 10px;font-size:15px;font-weight:0;'>".$cy." ".$cadd."</div>";
	$head2="<div style='position:relative;border-bottom:1px solid #000;padding:0 0 0 10px;font-size:15px;font-weight:0;'>".$cust[$i]."　御中</div>";
	$head1="<div style='font-size:10px;font-weight:0;width:40%;position:absolute;top:110px;'>いつもお世話になりありがとうございます。<br>下記の通り御請求申し上げます。</div>";
	$head1=$head1."<div style='font-size:16px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:150px;padding:0 0 0 10px;'>"." 御請求額  : ￥".number_format($zkei)."</div>";
	$head_table="<div style='font-size:14px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:180px;padding:0px 0 0 10px;'>
	<table><tr><th style='width:60px;'></th><th style='width:120px;background:#d2d2d7;font-size:16px;'>10%対象</th><th style='width:120px;background:#d2d2d7;font-size:16px;'>8%対象</th><th style='width:120px;background:#d2d2d7;font-size:16px;'>合計</th><tr>
	<tr><td style='font-size:16px;'>売上</td><td style='text-align:right;font-size:16px;'>".number_format($kei)."</td><td style='text-align:right;font-size:16px;'>0</td><td style='text-align:right;font-size:16px;'>".number_format($kei)."</td></tr>
	<tr><td style='font-size:16px;'>消費税</td><td style='text-align:right;font-size:16px;'>".number_format($zei)."</td><td style='text-align:right;font-size:16px;'>0</td><td style='text-align:right;font-size:16px;'>".number_format($zei)."</td></tr>
	</table></div>";
	//$head1=$head1."<div style='font-size:14px;border-bottom:1px solid #000;font-weight:800;width:40%;position:absolute;top:210px;padding:2px 0 0 10px;'>"." 消費税10%: ".number_format($zei)." 消費税8%: <span style='padding-left:10px;'> 0</span></div>";
	$pgme="<div style='text-align:right;font-weight:0;'>".$jisya->j_name."</div>";
	$pg_m="<div style='position:absolute;top:242px;font-weight:0;margin:0 0 20px 0;'>請求書明細 ".$y."年".sprintf('%02d',$_GET['m'])."月分</div>";
	$k=0;//管理番号
	$pg=0;
	$pgkanri=count($data[$i][3])*2;
	$pg=$data[$i][6];
	$row_total=$pgkanri+$pg;
	if($row_total-37<0){$pages=1;}else{$pages=ceil(($row_total-37)/43)+1;}
	$page_head="<div style='position:absolute;top:85px;right:60px;font-weight:0;'>総ページ数 ".$pages." </div>";
	$mpdf->WriteHTML($head.$head2.$head1.$head_table.$page_head.$me.$pg_m);
	$adp=1;
	$l=0;
	foreach($data[$i][1]->result() as $v){
		$st=$st."<div id='pdf'><table style='margin-top:0px;border:none!important;'><tr><th style='font-size:12px;width:8%;'>注文No.</th><td style='font-size:12px;'>".$v->k_odNum."</td><th style='font-size:12px;width:10%;'>受注日</th><td style='font-size:12px;'>".date('Y/m/d',strtotime($v->jutyu_D))."</td><th style='font-size:12px;width:10%;'>納品日</th><td style='font-size:12px;'>".date('Y/m/d',strtotime($v->nouhin_D))."</td><th style='font-size:12px;'>計</th><td style='font-size:12px;'>".number_format($v->total)."</td><th style='font-size:12px;'>#</th><td style='font-size:12px;'>".$v->k_Kid."</td><tr></table>";
		$l++;
		$st=$st."<table class='pm' style='margin-top:0px;font-size:15px;'>
			<tr><th style='width:30px;font-size:12px;'>#</th><th colspan='4' style='font-size:12px;width:50px;'>図番</th><th colspan='4' style='font-size:12px;width:50px;'>品名</th><th style='font-size:12px;width:50px;'>数量</th><th style='font-size:12px;'>単価</th><th style='font-size:12px;'>金額</th></tr>";
		$l++;
		foreach($data[$i][3][$k]->result() as $m){
			$l++;
			$st=$st."<tr><td>".$m->num."</td><td colspan='4' style='text-align:left;'>".$m->zuban."</td><td colspan='4' style='text-align:left;'>".$m->hinmei."</td><td>".number_format($m->quan)."</td><td>".number_format($m->tanka)."</td><td>".number_format($m->z_total)."</td></tr>";
			
			if($adp==1){
				$kp=37;
			}else{
				$kp=43;
			}

			if($adp<$pages){
				if($l>=$kp){
					$te="</table><div style='text-align:right;font-weight:0;'>P.".$adp."/".$pages."</div></div>";
					$p=$st.$te;
					$mpdf->WriteHTML($p);
						$mpdf->AddPage();
						$l=0;
						if($m->num==$data[$i][5][$k]){
							$ts2="<div id='pdf'><table class='pm' style='margin-top:0px;font-size:15px;'>";
						}else{
							$ts2="<div id='pdf'><table class='pm' style='margin-top:0px;font-size:15px;'>
							<tr><th style='width:30px;font-size:12px;'>#</th><th colspan='4' style='font-size:12px;width:50px;'>図番</th><th colspan='4' style='font-size:12px;width:50px;'>品名</th><th style='font-size:12px;width:50px;'>数量</th><th style='font-size:12px;'>単価</th><th style='font-size:12px;'>金額</th></tr>";
							$l++;
						}
						$adp++;
						$pghead="<div style='font-weight:0;'>請求明細  ".$y."年".sprintf('%02d',$_GET['m'])."月分<div style='font-weight:0;border-bottom:1px solid #000;'>".$cust[$i]."　御中&nbsp;"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P.".$adp."/".$pages."</span></div></div>";
						$p=$pghead.$pgme.$ts2;
						$mpdf->WriteHTML($p);
						//$l=0;
						$st="";
						$pg++;
				}
			}
			
			
		}
		//$l=$l+2;
		//$l=0;
		$k++;
		$st=$st."</table></div>";
	}


	$te="</div><div style='text-align:right;font-weight:0;'>P.".$adp."/".$pages."</div><div id='pdf'>";
	$p=$st.$te;
	$mpdf->WriteHTML($p);
	//客先ごとデータ出力完了
	if($i<$cnt-1){
		$mpdf->AddPage();//最後の客先以外改ページ
	}
	$p="";
	$st="";
	$l=0;
	$te="";
	$adp=1;
	
};
$dname="請求書.pdf";
$mpdf->Output($dname,"I");
return;
exit();
?>