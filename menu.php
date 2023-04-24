<!DOCTYPE html>
<?php
    $this->load->database('t');
    $this->db->select('j_name');
    $name=$this->db->get('trust')->row('j_name');
    
    $this->load->library('session');
    if(empty($_SESSION['name'])){
      header('Location:/'); 
    }
?>

<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../cbox/colorbox.css">
    <title>LinkageSmart</title>
</head>
<body style="margin-top:200px;">
<style>
    .a{
        display:none;
    }
</style>

<div class="container row" style="position:relative;margin:auto;width:500px;border:1px solid #000080;box-shadow:1px 1px 3px #000080;">
<header>
		<h1 style="text-shadow:0 0 2px #3F51B5;">LinkageSmart</h1>
	</header>
    <div class="form-inline" style="text-align:center;">
        <div style="position:absolute;bottom:23px;right:0;color:#484242;font-size:0.8rem;text-shadow:0 0 1px #706f6f;">社 名 :
        <?=$name." "?><span style="font-size:12px;margin-left:25px;"></span>
        </div>
        <input type="button" id="jutyu" class="btn btn-primary btn-lg" style="" value="受注">
        <input type="button" id="kanr" class="if98 btn btn-primary btn-lg" style="" href="bunseki" value="売上分析">
        <input type="button" id="kanri" class="btn btn-primary btn-lg" style="" value="受注管理">  
        <input type="button" id="gaityu_kanri" class="btn btn-primary btn-lg a" style="" value="工事管理">
        <input type="button" id="seikyu" class="if98 btn btn-primary btn-lg" style="" value="請求">
        <input type="button" id="set" class="if98 btn btn-primary btn-lg" href="gait" style="" value="各種設定">
        <input type="button" id="zairyo_kanri" class="btn btn-primary btn-lg" style="" value="在庫管理">
        <input type="button" id="syukei" class="yayoi btn btn-primary btn-lg a" style="" value="エクスポート">
        <input type="button" id="jisya" class="if55 btn btn-primary btn-lg" href="jisya" value="自社">
        <input type="button" id="logout" class="btn btn-primary btn-lg" value="ログアウト">              
        
        <div id="exp" style="display:none;position:absolute;left:90px;top:250px;text-align:center;padding:10px;background:#d5e8ff;border-radius: 5px;box-shadow: 0 0 5px;">
        やよい会計エクスポート
            <div style="margin-top:20px;display:flex;margin-left:95px;">
                <label>税込</label><input type="radio" name="zei"><label style="margin-left:20px;">税抜</label><input type="radio" name="zei">
            </div>
            期間
            <div style="display:flex;width:300px;margin-bottom:10px;">
                <input class="form-control">～<input class="form-control">
            </div>
            <input type="button" class="btn btn-primary btn-sm" value="エクスポート">

            <div style="display:none;position:absolute;padding:30px;background:#001ce3cf;text-shadow:none;color:#fff;border-radius:10px;border:1px solid #000080;top:20px;left:112px;">完了</div>
        </div>
        <p style="font-family: 'Times New Roman', Times, serif;float:left;">Version 1.2.0</p>
    </div>

</div>
<script>
   $(document).ready(function(){
      $(".if98").colorbox({iframe:true, width:"1000px", height:"900px"});
   });
   $(document).ready(function(){
      $(".if55").colorbox({iframe:true, width:"550px", height:"820px"});
   });
</script>
    <script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="../js/menu.js"></script>
</body>
</html>