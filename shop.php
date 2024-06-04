<?php
    $con = new mysqli("localhost", "root", "", "boxing_db") or die("connection failed");
    if(isset($_POST['add_to_cart'])){
        // Retrieve values from the form
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
       // $product_quantity =$_POST['product_quantity']; 
        
        $select_cart=mysqli_query($con,"select * from `cart` where name='$product_name'");
        if(mysqli_num_rows($select_cart)>0){
            $display_massage[]="product already added to cart";
        }else{
            // Insert into the cart table 
            $insert_product= mysqli_query($con, "INSERT INTO `cart` (name, price, image, quantity) 
             VALUES ('$product_name', '$product_price', '$product_image')"); 
            $display_massage[]="product added to cart";
        }
    }

    // Retrieve products ordered by price from low to high
    $select_products=mysqli_query($con,"SELECT * FROM `products` ORDER BY price ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Shop</title>
    <!-- CSS -->
    <link rel="stylesheet" href="styleproduct.css">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <a href="addproducts.php">Add Products</a>
                <a href="viewproducts.php">Edit Products</a>
                <a href="login.php">Logout</a>
                <a href="shop.php">View Shop</a>
            </nav>
            <?php
            $select_product=mysqli_query($con,"select * from `cart`")or die('query died');
            $row_count=mysqli_num_rows($select_product);
            ?>
            <!-- shopping cart icon -->
            <!-- <div id="menu-btn" class="fas fa-bars"></div> -->
        </div>
    </header>
    <div class="container">
        <?php 
        if(isset($display_massage)){
            foreach($display_massage as $display_message) {
                echo "<div class='display_message'>
                        <span>$display_message</span>
                        <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
                      </div>";
            }
        }
        ?>
        <section class="products">
            <h1 class="heading">|the way|</h1>
            <div class="product_container">
                <?php
                if(mysqli_num_rows($select_products)>0){
                    while($fetch_product=mysqli_fetch_assoc($select_products)){
                ?>
                <form method="post" action="">
                    <div class="edit_form">
                        <img src="image.php/<?php echo $fetch_product['image']?>" alt="">
                        <h3><?php echo $fetch_product['name']?></h3>
                        <div class="price">Price: $<?php echo $fetch_product['price']?></div>
						                        <div class="price">quantity:<?php echo $fetch_product['quantity']?></div>

                        
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']?>">
						<input type="hidden" name="product_quantity" value="<?php echo $fetch_product['quantity']?>">

                        
                    </div>
                </form>
                <?php
                    }
                }else{
                    echo"<div class='empty_text'>No product found</div>";
                }
                ?>
            </div>    
        </section>
    </div>
</body>
</html>
