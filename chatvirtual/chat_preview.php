<?php require_once("chat_library.php") ?>

<?php 
	
	$call = (new submit);

	if(count($call->chat_data()) !== $_SESSION['count']) {

		$_SESSION['count'] = count($call->chat_data());

		echo "<load/>";

	}

	foreach($call->chat_data() as $key => $value){

	$fullname = $call->search_data($value->users)->fullname;
	$profiles = $call->search_data($value->users)->profile;

	if($value->users == $_SESSION['username']){ ?>

	<div class="me">
		<div class="p1">
			<p style="margin-top: 0px;"><?php echo $value->chats?><p>
			<p class="p2"><?php echo date("H:i",$value->times)?></p>
		</div>
	</div>
	
	<?php }else{ ?>

	<div class="you">
		<img class="box-shadow" src="<?php echo $profiles?>">
		<div class="p1">
			<p class="name"><?php echo $fullname?></p>
			<p><?php echo $value->chats?><p>
			<p class="p2"><?php echo date("H:i",$value->times)?></p>
		</div>
	</div>

	<?php } ?>

<?php } ?>