<?php
class Signup
{
	private $error="";
 public function evaluate($data){
	 foreach($data as $key=> $value){
		 if(empty($value)){
		 $error.=$key."is empty<br>";
		 
	 }
	 }
	 if($this->error==""){
		 //no error
		 $this->create_user($data);
	 }else{
		 return $this->error;
	 }
}
 public function create_user($data){
	 
	 $id=$data['user_id'];
	 $name=$data['username'];
	 $email=$data['email'];
	 $password=$data['password'];
	 //create these
	 $url_address=strtolower ($name);
	 $id=create_userid();

	 $query="insert into usersignup
	(user_id, username, email,password,url_address)
	 values
	 ('$id', '$name', '$email', '$password','$url_address')";
	 return$query;
	
	// $DB=new Database();
	//$DB->save($query);
}
private function create_userid(){
	$leangth=rand(4,19);
	$number="";
	for($i=0;$i<$leangth;$i++){
		$new_rand=rand(0,9);
		$number=$number . $new_rand;
}
return $number;
}
}
