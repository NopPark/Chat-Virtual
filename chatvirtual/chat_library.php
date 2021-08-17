<?php

session_start();

date_default_timezone_set("Asia/Jakarta");
	
class submit{

	public $allow_extention = array("jpg", "jpeg", "png", "gif");

	public $object_data = null;

	public $file_name = null;

	public $file_path = null;

	public $file_ext = null;

	public $text_data = null;

	public function __construct(){

		$this->object_data = !empty($_FILES['image']['name']) ? $_FILES['image'] : null;

		$this->text_data = isset($_POST['text_data']) ? $_POST['text_data'] : null;

		if(!empty($this->object_data['name'])){

			if($this->allow_extention()){
				
				$this->file_name = time().".".$this->file_ext;

				$this->file_path = "image/".$this->file_name;

			}

		}

	}

	public function execution(){

		$response = false;

		foreach($this->user_data() as $key => $value){

			if($_SESSION['username'] == $value->username){

				$response = true;
				break;

			}else $response = false;

		}

		if($response == true){

			$save_data["image"] = $this->file_path;
			$save_data["chats"] = $this->text_data;
			$save_data["users"] = $_SESSION['username'];
			$save_data["times"] = time();

			$set_bundle[] = $save_data;

			$build = array_merge($this->chat_data(),$set_bundle);

			$opens_file = fopen("chat_data.json", "w+");
			$write_file = fwrite($opens_file, json_encode($build));
			$close_file = fclose($opens_file);

			return true;

		}

		return false;

	}

	public function allow_extention(){

		$get_extention = explode(".", $this->object_data['name']);
		$get_extention = $get_extention[count($get_extention) - 1];

		$response = false;

		for($i = 0; $i < count($this->allow_extention); $i++){

			if($get_extention == $this->allow_extention[$i]){

				$response = true;
				break;

			}else{

				$response = false;

			}

		}

		$this->file_ext = $get_extention;

		return ( $response == true ) ? true : false;

	}

	public function user_data(){

		$data = implode(null, file("chat_user.json"));

		return json_decode($data);

	}

	public function chat_data(){

		$data = implode(null, file("chat_data.json"));

		return json_decode($data);

	}

	public function search_data($data, $return = false){

		foreach($this->user_data() as $key => $value){

			if($value->username == $data){

				if($return == true) return true;

				return $value;

			}

		}

		if($return == true) return false;

	}

}

?>
