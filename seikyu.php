<!DOCTYPE html>
<?php
	$this->load->database('t');
    $this->load->library('session');
    
    if(empty($_SESSION['name'])){
        header("location:../");
    };

    $day="2022-03-20";
    $c_id=10;
?>

<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/seikyu.css">
    <link rel="stylesheet" href="../cbox/colorbox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-ja.js"></script>
    <title>発注管理</title>
</head>

<body style="width:800px;">
    <div class="wrap" style="margin-top:20px;position:relative;padding:10px;">
    <div style="display:flex;"><h3 style="margin-left:10px;padding-top:5px;margin-right:32px">締め期間</h3><span><select class="form-select" style="padding:1px 28px 0 0;"><option>法人</option><option>個人</option><option>買掛金</option></select><span></div>
        <div style="display:flex;margin:5px 0 15px 0;"><span style="font-weight:normal;padding-top:2px;">年</span>
            <select id="selyear" class="form-control" style="width:70px;">
            <?php foreach($list->result() as $y):?>
                <option value="<?=$y->nouhin?>"><?=$y->nouhin?></option>
                <?php endforeach;?>
            </select><span style="font-weight:normal;padding-top:2px;">月</span>
            <?php for($i=1;$i<13;$i++):?>
                <button class="btn btn-primary btn-sm" value="<?=$i?>"><?=$i?>月</button>
            <?php endfor;?>
            <span style="font-weight:normal;padding:2px 0 0 2px;">発行日</span>
            <input id="hd" type="text" class="form-control dp" style="width:120px;" autocomplete="off">
        </div>
        <input id="hid_m" type="hidden">
        <div id="seikyu_ajax" style="text-align:center;height:600px;">
        
        
        </div>
    </div>
    <script type="text/javascript" src="../js/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="../js/seikyu.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
</body>
</html>