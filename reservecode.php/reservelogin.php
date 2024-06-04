<?php
session_start();
	 class Connect_db{
		private $host="localhost";
		private $username="root";
		private $password="";
		private $db="boxing_db";

		function connect(){
		$connection=mysqli_connect($this->host,$this->username,$this->password,$this->db);
		return $connection;
		}
		function read($query){
		$connection=$this->connect();
		$result=mysqli_query($connection,$query);
	if(!$result){
		return false;
	}else
	{
		$data=false;
		while($row=mysqli_fetch_assoc($result)){
			$data[]=$row;
		
	}
	return $data;
	}
	}
		function save($query){
			$connection=$this->connect();
			$result=mysqli_query($connection,$query);
		if(!$result){
			return false;
		}else{
			return true;
		}

		}
		}	
		
	class Login
	{
		private $error="";
	/*public function evaluate($data) {
    foreach ($data as $key => $value) {
        if (empty($value)) {
            $this->error .= $key . " is empty<br>";
        }
        if ($key == "user_id") {
            if (!is_numeric($value) || strlen($value) !== 9) {
                $this->error .= "Invalid user ID (must be exactly 9 digits)<br>";
            }
        }
    }

    if (empty($this->error)) {
        // No errors, proceed with user creation
        $this->create_user($data);
    } else {
        // Errors occurred, return error messages
        return $this->error;
    }
}*/
	/* public function evaluate($data){
		 		
		 $name=addslashes($data['username']);
		 $password=addslashes($data['password']);

		 $query="SELECT * FROM usersignin2 WHERE username='$name'limit 1"*/
		 
		 
		 
		/*(id,user_id, username, email,password,url_address)
		 values
		 ('$id','$user_id', '$name', '$email', '$password','$url_address')";*/
		 //echo $query;
       /* $DB = new Connect_db();
		$result=$DB->read($query);
		if($result){
			$row=$result[0];
			if($password==$row['password'])
			{
				$_SESSION['boxing_db_username']==$row['username'];
			}else
			{
							$error.="wrong password <br>";

			}
		}else
		{
			$error.="no such email was found<br>";
		}
			return $error;
	}
	}
	$username="";
	$password="";

			if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
				$Login2 = new Login();
			   $result = $Login2->evaluate($_POST);
			if($result!=""){
			echo"<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
				echo"<br>the foliwng error occourd<br><br>";
				echo $result;
				echo"</div>";
					}else{
						header("Location:Homepage.php");
						die;
					}
			$username=$_POST['username'];
			$password=$_POST['password'];

					}
?>