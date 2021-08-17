<?php
	
	require_once("chat_library.php");

	if(isset($_GET['type'])){

		$call = new submit;

		if($call->search_data($_POST['username'], true)) {

			$data = $call->search_data($_POST['username']);

			if($data->password == $_POST['password']){

				$_SESSION['username'] = $_POST['username'];

				echo "

					<script>

						alert('Selamat Datang ".$data->fullname."');
						window.location='chat_login.php';

					</script>

				";

			} else echo "

					<script>

						alert('Password Salah');
						window.location='chat_login.php';

					</script>

				";

		}else echo "

					<script>

						alert('Username Tidak terdaftar');
						window.location='chat_login.php';

					</script>

				";


		exit;
	}

	if((new submit)->execution()){

		true;

	}
