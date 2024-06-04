				<?php
				$con = new mysqli("localhost", "root", "", "boxing_db1") or die("connection failed");
				?>
				<!DOCTYPE html>
							<html lang="en">
							<head>
								<meta charset="UTF-8">
								<meta name="X-UA-Compatible" content="IE-edge">
								<meta name="viewport" content="width=device-width, initial-scale=1.0">

								<title>edit products_boxing_admin</title>
								<!--css-->
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
			<a href="addProducts.php">Add Products</a>
			<a href="viewproducts.php">edit Products</a>
			<a href="login.php"> log out</a>
			<a href="shop.php"> view Shop</a>
			<?php
	$select_product=mysqli_query($con,"select * from `cart`")or die('query died');
	$row_count=mysqli_num_rows($select_product);
	?>
	
	<!-- <div id="menu-btn" class="fas fa-bars"></div> -->
			</nav>
			
			<!-- <div id="menu-btn" class="fas fa-bars"></div> -->
			</div>
			</header>						<!--container-->
								<div class="container">
				<section class="display_product">
						<?php
						$display_product=mysqli_query($con,"Select *from`products`");
						$num=1;
						if(mysqli_num_rows($display_product)>0){
								 echo"<table>
						<thead>
							<tr>
								<th>si no</th>
								<th>image</th>
								<th>name</th>
								<th>price</th>
								<th>quantity</th>
								<th>edit</th>
							</tr>
						</thead>
						<tbody>";
							while($row=mysqli_fetch_assoc($display_product)){	
							?>
							 <tr>
								<td><?php echo $num?></td>
								<td><img src="image.php/<?php echo $row['image']?>"
								alt=<?php echo $row['name']?>></td>
								<td><?php echo $row['name']?></td>
								<td><?php echo $row['price']?></td>
								<td><?php echo $row['quantity']?></td>


								<td>
									<a href="delete.php?delete=<?php echo $row['id']?>" 
									class="delet_product_btn" onclick="return confirm('are ypu sure you want to delete this product');">
									<i class="fas fa-trash"></i></a>
									<a href="ubdateproducts.php?edit=<?php echo $row['id']?>" 
									class="edit_product_btn"><i class="fas fa-edit"></i></a>
								</td>
							</tr>
							<?php
							$num++;
							}
						
						}else{
							echo"<div class='empty_text'>No product found </div>";
						}
						
						?>
						   
						</tbody>
					</table>
				</section>
			</div>

								
								</body>
							</html>