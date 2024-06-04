<?php

	class connect_db{
	private $host="localhost";
	private $username="root";
	private $password="";
	private $db="boxing_db";

	function connect(){
	$connection=mysqli_connect($this->host,$$this->username,$$this->password,$$this->db);
	return $$connection;
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
	$database=new connect_db();
	$query="select * from usersignin";
	$data=$database->read($query);
	echo("<pre>");
	print_r($data);
	echo("</pre>");

	?>