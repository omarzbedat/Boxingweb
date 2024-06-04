<?php
	$con = new mysqli("localhost", "root", "", "boxing_db") or die("connection failed");
	if(isset($_POST['add_product'])){
		$product_name = $_POST['name'];
		$product_price = $_POST['price'];
		
		// Check if file upload is successful and 'image' key exists in $_FILES
		if(isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
			$product_image = $_FILES['image']['name'];
			$product_imagetemp = $_FILES['image']['tmp_name'];
			$product_image_folder = 'image.php/' . $product_image;

			$insert_query = mysqli_query($con, "INSERT INTO `products` (name, price, image) 
			VALUES ('$product_name','$product_price','$product_image')") or die("insert into products failed");
			
			if($insert_query){
				// Move uploaded file only if insertion was successful
				move_uploaded_file($product_imagetemp, $product_image_folder);
				$display_massage= "Product inserted successfully";
			} else {
				$display_massage=  "Problem inserting product";
			}
		} else {
			echo "File upload failed or no file selected";
		}
	}
	?>

					<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta name="X-UA-Compatible" content="IE-edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">

					<title>add_product_admin</title>
						   <!--css file-->
					<link rel="stylesheet" href="styleproduct.css">
					 <!--font awsome link-->
						   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
						   integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
						   crossorigin="anonymous" referrerpolicy="no-referrer" />
				</head>
				<body >
				<!--iclude heaer-->
					<?php include('headerproduct.php')?>
				<!--form section-->
				<div class="container">
    <?php 
    if(isset($display_massage)){
        echo "<div class='display_message'>
                <span>$display_massage</span>
                <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
              </div>";
    }
    ?>
				<section>
				<h3 class="heading">add product"</h3>
				<form action="" class="add_product" method="post" enctype="multipart/form-data">
				<input type="text"name="name" placeholder="enter product name"class="input_fields" required>
				<input type="number" name="price" min="0" placeholder="enter product price"class="input_fields" required>
				<input type="file"name="image" class="input_fields" required accept="image/png,image/jpg,image/jpeg">
				<input type="submit" name="add_product"class="submit_btn" value="add product" >
				</form>
				</section>
				</div>
				<!-- js file -->
				<script src="js/script.js"></script>
				</body>
				</html>
