<?php
session_start();
$con = new mysqli("localhost", "root", "", "boxing_db") or die("connection failed");
$pquantity=0;
if(isset($_POST['add_to_cart'])){
    // Retrieve values from the form
	$pquantity++;
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $username = $_SESSION['username'];

    $product_quantity = $_POST['product_quantity']; 
	$update_quantity=$_POST['product_quantity'];
    $flag='false';
    if ($product_quantity == 0) {
        $display_message[] = "Out of stock";
    } else {
        // Decrease the quantity of the product by 1
		    $select_cart = mysqli_query($con,"SELECT * FROM `cart` WHERE name='$product_name'");
          $update_quantity = $product_quantity -$pquantity;        
			if($flag){
        $update_quantity_query = mysqli_query($con,"UPDATE `products` SET quantity='$update_quantity' WHERE name='$product_name'");
			}
        if (!$update_quantity_query) {
            $display_message[] = "Error updating product quantity";
        } else {
            // Check if the product is already in the cart
            $select_cart = mysqli_query($con,"SELECT * FROM `cart` WHERE name='$product_name'");
                // Insert into the cart table 
                $insert_product = mysqli_query($con, "INSERT INTO `cart` (name, price, image,quantity,username) 
                 VALUES ('$product_name', '$product_price', '$product_image','$pquantity','$username')"); 
                if (!$insert_product) {
                    $display_message[] = "Error adding product to cart";
                } else {
                    // Product added to cart, update the display message
                    $display_message[] = "Product added to cart";

                    // If successfully added to cart, decrease the quantity in products table
                    $update_product_quantity = mysqli_query($con,"UPDATE `products` SET quantity='$update_quantity' WHERE name='$product_name'");
                    if (!$update_product_quantity) {
                        $display_message[] = "Error updating product quantity in the products table";
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Shop</title>
    <!-- CSS -->
    <link rel="stylesheet" href="styleproduct.css">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
	integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
	crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
        body {
            font-family: Tahoma;
            background-image: url('https://wallpapercave.com/wp/wp2406553.png'); /* Add background image */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background */
            background-repeat: no-repeat; /* Prevent background from repeating */
        }
    </style>
<body>
    <header class="header">
        <div class="header_body">
            <a href="index.php" class="logo">punch perfect</a>
            <nav class="navbar">
                <a href="login.php">Log out</a>
                <a href="homepage.php">Home Page</a>
                <a href="usercart.php">View Cart</a>
            </nav>
            <?php
            $select_product = mysqli_query($con, "select * from `cart`") or die('query died');
            $row_count = mysqli_num_rows($select_product);
            ?>
            <!-- Shopping cart icon -->
            <a href="usercart.php" class="cart"><i class="fas fa-cart-shopping"></i><span><sup></sup></span></a>
        </div>
    </header>
    <div class="container">
        <?php 
        if(isset($display_message)){
            foreach($display_message as $message) {
                echo "<div class='display_message'>
                        <span>$message</span>
                        <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
                      </div>";
            }
        }
        ?>
        <section class="products">
            <h1 class="heading">|the way|</h1>
            <div class="product_container">
                <?php
                $select_products = mysqli_query($con, "SELECT * FROM `products` ORDER BY price ASC");
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_product = mysqli_fetch_assoc($select_products)){	
                ?>
                <form method="post" action="">
                    <div class="edit_form">
                        <img src="image.php/<?php echo $fetch_product['image']?>" alt="">
                        <h3><?php echo $fetch_product['name']?></h3>
                        <div class="price">Price: $<?php echo $fetch_product['price']?></div>
                        <div class="price">Quantity: <?php echo $fetch_product['quantity']?></div>

                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']?>">
                        <input type="hidden" name="product_quantity" value="<?php echo $fetch_product['quantity']?>">

                        <input type="submit" class="submit_btn cart_btn" value="Add to Cart" name="add_to_cart">
                    </div>
                </form>
                <?php
                    }
                } else {
                    echo "<div class='empty_text'>No products found</div>";
                }
                ?>
            </div>    
        </section>
    </div>
</body>
</html>
