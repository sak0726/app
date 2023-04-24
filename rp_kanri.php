<?php
	$this->load->database('t');
		$m_rows=12;//1ページの表示行数

        $id=$_GET['id'];
        $this->db->select('*')->from('tbmeisai')->where('m_key=',$id);
        $query=$this->db->get();
        $val=$query->num_rows();
		$qarr=array();
		$rarr=array();
		$zarr=array();
		$pages=ceil($count / $m_rows);

			
			//foreach($main->result() as $k){//図面ごと工程取得
				$this->db->select('*');
				$this->db->from('tbkt');
				$this->db->where('k_keyNum',$id);
				$this->db->order_by('kt_num');
				$kq=$this->db->get();
				//$t_val=$query->num_rows();
				//array_push($qarr,$query);//それぞれのデータ
				//array_push($rarr,$t_val);//表示行数
			//}

			//foreach($main->result() as $k){//図面ごと材料取得
				$this->db->select('*');
				$this->db->from('tbz');
				$this->db->where('z_keyNum',$id);
				$this->db->order_by('id');
				$zq=$this->db->get();
				//array_push($zarr,$zq);	
			//}
			
			$this->db->select("*");
			$this->db->where('k_Kid',$id);
			$kanri=$this->db->get('tbkanri');
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

$header="<span style='position:relative;width:100%;text-align:left;font-size:24px;font-weight:bold;'>工程管理表</span>";
$footer="<div style='border-bottom:1px solid #000;font-size:12px;margin-top:20px;font-weight:0;'>備考:</div>";
$mpdf->SetHTMLHeader($header);
$mpdf->setTitle("工程管理表");
$stylesheet = file_get_contents('css/style.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->SetWatermarkText('');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;

$head1="<div style='position:relative;border-bottom:1px solid #000;padding:0 0 0 10px;font-size:24px;font-weight:bold;width:100%;'>".$kanri->row('k_Kid')."</div>";
$head3="<div style='position:absolute;top:55px;right:60px;font-size:24px;font-weight:bold;'>発送:　".$kanri->row('hassou')."</div>";

$me="<div style='top:10px;right:23px;text-align:right;font-weight:0;'>".$jisya->j_name."</div>";
$ts="<div id='pdf'><table class='pm' style='margin-top:10px;font-size:15px;'>
<tr><th style='width:30px;'>#</th><th colspan='3' style='width:400px;'>図番/品名</th><th style='width:60px;!important'>数量</th><th colspan='7' style='width:350px;'>工程</th></tr>";
$st='';
$l=1;
$k=0;
	$page=0;
		foreach($main->result() as $v){
			$st=$st.'<tr><td rowspan="2" style="padding:0.25em; border-top:3px solid #000;">'.$v->num.'</td><td colspan="3" rowspan="2" style="border-top:3px solid #000;text-align:left;padding:2px 0px 2px 2px;font-size:18px;">'.$v->zuban.'<br>'.$v->hinmei.'</td>';

			$st=$st.'<td rowspan="2" style="padding-right:5px;font-size:18px;">'.number_format($v->quan).'</td>';
			$ktc=0;
			foreach($kq->result() as $kt){
				if($kt->ktid===$v->m_id){
					$ktc++;
					if($kt->kt==="-" || $kt->kt===""){
						$st=$st.'<td style="text-align:center;width:80px;">'.$kt->kt_gai.'</td>';
					}else{
						$st=$st.'<td style="text-align:center;width:80px;">'.$kt->kt.'</td>';
					}
				}		
			}
			for($i=0;$i<7-$ktc;$i++){
				$st=$st."<td style='width:80px;'></td>";
			}
			$st=$st.'</tr><tr><td colspan="7" style="text-align:right;">';
			foreach($zq->result() as $z){
				if($z->zid===$v->m_id){
					if(is_numeric($z->a)){
						$st=$st.$z->a." x ".$z->b." x ".$z->c." ".$z->z_quan."個  ";
					}else{
						$st=$st.$z->a." x ".$z->b." ".$z->z_quan."個  ";
					}
				$st=$st.$z->material;
				}				
			}
			$st=$st."</td></tr>";
			$k++;
			
			if($k===$m_rows){
				$page++;
				$te="</table>
				<table style='border:none;margin-top:0px;'><tr style='border:none;text-align:left;margin-top:1px;'><td style='text-align:right;border:none;font-weight:bold;font-size:18px;'>".$page."/".$pages."ページ</td></tr></table>";
				
				$head2="<div style='position:absolute;top:55px;left:450px;font-size:24px;font-weight:bold;'>".number_format($count)."枚 (".$page."/".$pages."ページ)</div>";
				$p=$head1.$head2.$head3.$me.$ts.$st.$te;
				$mpdf->WriteHTML($p);
				$k=0;
				$head="";				
				$st="";
			}
		}
	if($pages>1){
		$head2="<div style='position:absolute;top:55px;left:450px;font-size:24px;font-weight:bold;'>".number_format($count)."枚 (".$pages."/".$pages."ページ)</div>";
		$te="</table>
		<table style='border:none;margin-top:0px;'><tr style='border:none;text-align:left;margin-top:1px;'><td style='text-align:right;border:none;font-weight:bold;font-size:18px;'>".$pages."/".$pages."ページ</td></tr></table></div>";
		$p=$head1.$head2.$head3.$me.$ts.$st.$te.$footer;
		$mpdf->WriteHTML($p);
	}else{
		$te="</table>
		<table style='border:none;margin-top:0px;'><tr style='border:none;text-align:left;margin-top:1px;'><td style='text-align:right;border:none;font-weight:bold;font-size:18px;'>".$pages."/".$pages."ページ</td></tr></table>";
		$head2="<div style='position:absolute;top:55px;left:450px;font-size:24px;font-weight:bold;'>".number_format($count)."枚 (".$pages."/".$pages."ページ)</div>";
		$p=$head1.$head2.$head3.$me.$ts.$st.$te;
		$mpdf->WriteHTML($p);
	}
	

$dname="管理表No.".$id.".pdf";
$mpdf->Output($dname,"I");
return;
exit();
?>