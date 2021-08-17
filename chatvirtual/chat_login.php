<?php require_once("chat_library.php") ?>

<?php
	
	if(isset($_SESSION['username'])){

		header("location:index.php");
		exit;

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Singularity</title>
	<link rel="stylesheet" href="css/style.css?<?php echo time()?>">
	<link rel="shortcut icon" href="chat_logo.png">
</head>
<body>

	<div class="box-chat" style="margin:auto;display: block;margin-top: 100px;">

		<div class="heading box-shadow">Welcome to Singularity</div>

		<center style="margin-top:40px;"><img src="chat_logo.png"></center>
		<form class="form" method="POST" style="text-align: center;margin-top: 50px" action="chat_submit.php?type=login">

			<input type="text" class="box-shadow1" name="username" placeholder="Username ..." style="width: 90%;">
			<input type="password" class="box-shadow1" name="password" placeholder="Password ..." style="width: 90%;">
			<button style="background:#036e0e;width: 95%;color:#fff;border-radius: 20px;padding: 10px;float: none;" class="box-shadow">
				Login
			</button>
		</form>

	</di
	v>
</body>
</html>