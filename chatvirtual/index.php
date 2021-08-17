<?php require_once("chat_library.php") ?>

<?php
	
	if(!isset($_SESSION['username'])){

		header("location:chat_login.php");
		exit;

	}

	$call = (new submit);

	$_SESSION['count'] = count($call->chat_data());

?>


<!DOCTYPE html>
<html>
<head>
	<title><?php echo $call->search_data($_SESSION['username'])->fullname?></title>
	<link rel="stylesheet" href="css/style.css?<?php echo time()?>">
	<link rel="shortcut icon" href="<?php echo $call->search_data($_SESSION['username'])->profile?>">
</head>
<body style="background:#006344;text-align: center;">
<body>
		<div class="box-chat" style="text-align: left;margin-top: 100px">

		<div class="heading box-shadow" style="text-align: left;">
			
		Singularity Messenger

		<span style="float: right;margin-top: -3px;margin-right: 0px;">

		<a style="font-size: 15px;color:#800300;text-decoration: none;font-weight:400" href="chat_logout.php">[ Logout ]</a>
		</span>
		</div>
		</span>
		<div class="chat"></div>
		<form class="form" method="POST" onsubmit="return send_data()">
			<input type="text" class="box-shadow1" placeholder="Write Message ...">
			<button>
				<img src="chat_send.png" class="box-shadow1">
			</button>
		</form>

	</div>


<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/script.js?<?php echo time()?>"></script>
<script type="text/javascript">
	
	$(document).ready(function(){

		$(".chat").load("chat_preview.php",function(){
	
			$('.chat').scrollTop($('.chat')[0].scrollHeight);

		});

		web_socket();

	});

	function web_socket(){

		$.ajax({

			type : "POST", 
			url : "chat_preview.php",
			success : function(html){

				if(html.indexOf("<load/>") !== -1){

					$(".chat").html(html);

					$('.chat').scrollTop($('.chat')[0].scrollHeight);

				}

				setTimeout(function(){

					web_socket();

				},600);

			}

		});

	}


	function send_data(){

		$.ajax({

			type : "POST",
			url  : "chat_submit.php",
			data : {
				text_data : $(".form input").val()
			},
			beforeSend : function(){

				$(".form input").prop("disabled", true);

			},
			success : function(){

				$(".form input").prop("disabled", false);

				$(".form input").val("");


			}

		});

		return false;

	}

</script>
</body>
</html>