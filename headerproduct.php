<header class="header">
	<div class="header_body">
	<a href="index.php" class="logo">punch perfect</a>
	<nav class="navbar">
	<a href="addproducts.php">Add Products</a>
	<a href="viewproducts.php">edit Products</a>
		<a href="login.php">log out</a>
	<a href="shop.php">view shop</a>
	</nav>
	<?php
	$select_product=mysqli_query($con,"select * from `cart`")or die('query died');
	$row_count=mysqli_num_rows($select_product);
	?>
	<!-- shopping cart icon -->
	<a href="usercart.php"class="cart"><i"><i class="fa-solid fa-cart-shopping"></i><span<sup><?php
	echo $row_count;?></sup></sup></span></a>
	
	<!-- <div id="menu-btn" class="fas fa-bars"></div> -->
	
	<!-- <div id="menu-btn" class="fas fa-bars"></div> -->
	</div>
	</header>