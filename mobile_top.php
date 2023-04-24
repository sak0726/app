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
		/* モバイル端末用スタイル */
		@media (max-width: 767px) {
			body {
				font-size: 14px;
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

        <div class="container"style="position:fixed">
			<h1 style="padding-top:30px;">linkageSmart</h1>
			<header>
			<i class="fa-sharp fa-solid fa-store"><span><?=$name?></span></i>
			</header>
				<div>
					<div class="col-sm-12 col-md-4 mb-3" style="margin-top:120px;">
						<div class="d-flex flex-column justify-content-center">
							<button class="btn btn-primary btn-lg btn-block align-items-center btn-lg h-100">販売</button>
						</div>
					</div>

					<div class="col-sm-12 col-md-4 mb-3" style="margin-top:30px;">
						<div class="d-flex flex-column h-50 justify-content-center">
							<button class="btn btn-primary btn-lg btn-block align-items-center btn-lg">履歴・編集</button>
						</div>
					</div>

					<div class="col-sm-12 col-md-4 mb-3">
						<div class="d-flex flex-column h-50 justify-content-center">
							<button class="btn btn-primary btn-lg btn-block align-items-center btn-lg">単価設定</button>
						</div>
					</div>

				</div>
        </div>

    </div>
</body>
</html>
