<?php
	$con = new mysqli("localhost", "root", "", "boxing_db") or die("connection failed");

?>
	<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta name="X-UA-Compatible" content="IE-edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">

					<title>Shop</title>
						   <!--css file-->
					 <!--font awsome link-->
						   <link rel="stylesheet" href="styleproduct.css">
					 <!--font awsome link-->
						   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
						   integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
						   crossorigin="anonymous" referrerpolicy="no-referrer" />
				</head>
				<body>
    <header class="header">
	<div class="header_body">
	<a href="index.php" class="logo">punch perfect</a>
	<nav class="navbar">
	<a href="Products.php">Add Products</a>
	<a href="viewproducts.php">edit Products</a>
	<a href="cart.php">view shop</a>
	</nav>
	<!-- shopping cart icon -->
	<a href=""class="cart"><i"><i class="fa-solid fa-cart-shopping"></i><span<sub>4</sup></sup></span></a>
	<!-- <div id="menu-btn" class="fas fa-bars"></div> -->
	</div>
	</header>
    <div class="container">
        <section class="products">
            <h1 class="heading">Let's Shop</h1>
            <div class="product_container">
                <div class="edit_form">
                    <img src="image.php/goldgloves.jpg" alt="White/Gold Gloves">
                    <h3>White/Gold</h3>
                    <div class="price">Price: $60</div>
                    <input type="submit" class="submit_btn cart_btn" value="Add to Cart">
					
                </div>
				 <div class="edit_form">
                    <img src="image.php/goldgloves.jpg" alt="White/Gold Gloves">
                    <h3>White/Gold</h3>
                    <div class="price">Price: $60</div>
                    <input type="submit" class="submit_btn cart_btn" value="Add to Cart">
					
                </div>
				 <div class="edit_form">
                    <img src="image.php/goldgloves.jpg" alt="White/Gold Gloves">
                    <h3>White/Gold</h3>
                    <div class="price">Price: $60</div>
                    <input type="submit" class="submit_btn cart_btn" value="Add to Cart">
					
                </div>
            </div>
			
        </section>
    </div>
</body>
</html>
