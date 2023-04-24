<?php
    $this->load->database('t');
    $this->db->select('j_name');
    $name=$this->db->get('trust')->row('j_name');
    
    $this->load->library('session');
    if(empty($_SESSION['name'])){
      header('Location:/'); 
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/mobile.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
	<title>linkageSmart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
	<style>
		/* 共通スタイル */
		body {
			margin: 0;
			padding: 0;
			font-family: Arial, sans-serif;
			font-size: 16px;
			line-height: 1.5;
			background-color: #f5f5f5;
		}

		.container {
			max-width: 1200px;
			margin: 0 auto;
			padding: 0 20px;
		}

		.btn {
			display: inline-block;
			padding: 12px 24px;
			border-radius: 4px;
			color: #fff;
			background-color: #4CAF50;
			text-decoration: none;
			font-weight: bold;
			text-align: center;
			transition: all 0.3s;
			margin-bottom: 10px;
		}

		.btn:hover {
			background-color: #3e8e41;
			cursor: pointer;
		}
        .button-group {
            display: flex;
            flex-direction: column;
        }

        .h-100{
            height:calc(90vh / 3)!important;
        }
		.btn{
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		.calc{
			margin-bottom:10px;
		}
		/* モバイル端末用スタイル */
		@media (max-width: 767px) {
			body {
				font-size: 16px;
			}

			.container {
				padding: 0 10px;
			}

			.btn {
				padding: 10px 20px;
			}
		}
	</style>
</head>
<body>

	<div class="container">
		<h1 style="padding-top:30px;">linkageSmart</h1>
		<header style="margin-bottom:30px;">
			<i class="fa-sharp fa-solid fa-store"><span><?=$name?></span></i>
		</header>
		<div class="calc" style="position:fixed;right:8px;z-index:2;">
			<input id="calc_area" class="form-control" style="font-size:18px;text-align:right;padding-right:5px;" value="0">
		</div>
		<div class="d-flex flex-wrap justify-content-center btn-group" style="margin-top:100px;">
				<?php foreach($items->result() as $item): ?>
					<button id="<?=$item->z_ID?>" class="btn btn-primary btn-sm cal" style="width:110px;" data-price="<?=$item->tanka?>" value="<?=$item->z_mat?>"><?=$item->z_mat?><br><?=$item->kata?></button>
				<?php endforeach;?>
			
		</div>
		<div id="history-list"></div>

	</div>

</body>
</html>
