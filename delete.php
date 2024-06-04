<?php
	$con = new mysqli("localhost", "root", "", "boxing_db") or die("connection failed");
if(isset($_GET['delete'])){
	$delete_id=$_GET['delete'];
	$delete_query=mysqli_query($con,"Delete from`products` where id=$delete_id")or 
	die("query  failed");
	if($delete_query){
				echo "product  deleted";

		header('location:viewproducts.php');
		
	}else{
		echo "product not deleted";
				header('location:viewproducts.php');

	}
}
?>