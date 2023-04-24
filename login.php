<!DOCTYPE html>
<?php
//echo phpinfo();
$this->load->database('t');

?>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="js/jquery.js"></script>
    <link rel="icon" href="fav.ico" id="favicon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" integrity="sha384-PmY9l28YgO4JwMKbTvgaS7XNZJ30MK9FAZjjzXtlqyZCqBY6X6bXIkM++IkyinN+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap-theme.min.css" integrity="sha384-jzngWsPS6op3fgRCDTESqrEJwRKck+CILhJVO5VvaAZCq8JYf8HsR/HPpBOOPZfR" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" integrity="sha384-vhJnz1OVIdLktyixHY4Uk3OHEwdQqPppqYR8+5mjsauETgLOcEynD9oPHhhz18Nw" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">

    <title>ログイン</title>
</head>
<body>
<form action="main/login" method="post">
    <div id="menu">
        <span class="form-control" style="border:none;">システムログイン</span>
        <div id="">
            <p><input type="text" id='name' name="name" class="form-control" placeholder='ユーザー名' value="sakamoto" required autocomplete="off"></p>
            <p><input type="password" id='password' name="pass" class="form-control" placeholder='パスワード' value="munemune555" required autocomplete="off"></p>
            <p><input type="button" id="login" class="btn-border" style="width:250px;height:40px;" value="Login"></p>
            <p id="errorMsg" style="color:#8c0c0c;display:none;">※ユーザー名・パスワードを入力して下さい</p>
            <?php
                if(isset($_GET['error'])){
                    echo '<p id="" style="color:#8c0c0c;display:block;">※ユーザー名とパスワードの組み合わせが間違っています。</p>';
                }
                ?>
        </div>
    </div>
</form>
    
<script type="text/javascript" src="js/menu.js"></script>
</body>
</html>