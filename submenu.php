<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap-theme.min.css" integrity="sha384-jzngWsPS6op3fgRCDTESqrEJwRKck+CILhJVO5VvaAZCq8JYf8HsR/HPpBOOPZfR" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" integrity="sha384-vhJnz1OVIdLktyixHY4Uk3OHEwdQqPppqYR8+5mjsauETgLOcEynD9oPHhhz18Nw" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">

    <title>各種設定</title>
</head>
<body>
<div id="wrap">
<div id="inner">
<div id="sideWrap">
<div style="position:relative;">    
    <h3 style="text-align:left;margin-bottom:10px;">各種設定</h3>
    <div class="sideMenu">
        <a href="menu"><button type="button" class="btn btn-xs cos-sm-2">TOP</button></a>
        <a href="mitsumori"><button type="button" class="btn btn-xs cos-sm-2">見積作成</button></a>
        <a href="history"><button type="button" class="btn btn-xs cos-sm-2">履歴</button></a>
        <a href="customer"><button type="button" class="btn btn-xs cos-sm-2">顧客</button></a>
        <a><button type="button" id="opm" class="btn btn-xs">設定</button></a>
                <div id="subMenu">
                    <ul>
                        <li><a href="thick">板厚</a></li>
                        <li><a href="frice_p">加工賃</a></li>
                        <li><a href="material">材料設定</a></li>
                        <li><a href="customer">顧客</a></li>
                        <li><a href="jisya">自社</a></li>
                    </ul>
                </div>
        <button class="btn btn-xs cos-sm-2" onClick="history.back()" style="width:100%;">戻る</button>
        <button class="btn btn-xs cos-sm-2" id="out" style="width:100%;">ログアウト</button>

    </div>

</div>
</div>

<div id="mainWrap" style="border:none;">
<div id="menu">
    <p><button type="button" id="cust" class="btn-border" style="margin-top:100px;">顧客登録</button></p>
    <p><button type="button" id="mat" class="btn-border" style="margin-top:100px;">材質登録</button></p>
    <p><button type="button" id="my" class="btn-border" style="margin-top:100px;">自社</button></p>
</div>
</div>
</div>
</div>
    <script type="text/javascript" src="../js/menu.js"></script>
</body>
</html>