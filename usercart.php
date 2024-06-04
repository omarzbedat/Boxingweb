<?php 
session_start(); // Start the session

if (!isset($_SESSION['username'])) {
    exit();
}

$con = new mysqli("localhost", "root", "", "boxing_db") or die("connection failed");

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $name = $_GET['name'];

    // Fetching the quantity of the product from the products table
    $p1quantity_query = mysqli_query($con, "SELECT quantity FROM `products` WHERE name='$name'");
    $p1quantity_data = mysqli_fetch_assoc($p1quantity_query);
    $p1quantity = $p1quantity_data['quantity'];

    // Increasing the quantity of the product in the products table
    mysqli_query($con, "UPDATE `products` SET quantity=$p1quantity+1 WHERE name='$name'");

    // Removing the item from the cart
    mysqli_query($con, "DELETE FROM `cart` WHERE id=$remove_id AND username='{$_SESSION['username']}'");
    
    header('location:usercart.php');
}

if (isset($_GET['delete_all'])) {
    mysqli_query($con, "DELETE FROM `cart` WHERE username='{$_SESSION['username']}'");
    header('location:viewproductsuser.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- CSS file -->
    <link rel="stylesheet" href="styleproduct.css">
    <!-- Font awesome link -->
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
            <a href="login.php">log out</a>
        <a href="viewproductsuser.php">view shop</a>

    </nav>
    <?php
    $select_product=mysqli_query($con,"select * from `cart`")or die('query died');
    $row_count=mysqli_num_rows($select_product);
    ?>
    <!-- shopping cart icon -->
    <a href="usercart.php"class="cart"><i class="fa-solid fa-cart-shopping"></i><span<sup></sup></sup></span></a>
    </div>
    </header>
    <div class="container">
        <section class="shopping_cart">
            <h1 class="heading">|Yours|</h1>
            <table>
                <?php
$select_cart_product = mysqli_query($con, "SELECT * FROM `cart` WHERE username='{$_SESSION['username']}'");
                    $num = 1;
                    $grand_total=0;
                    if(mysqli_num_rows($select_cart_product) > 0) {
                        echo "<thead>
                                <th>SI</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </thead>";
                        while($fetch_cart_products = mysqli_fetch_assoc($select_cart_product)) {
                ?>
                <tr>
                    <td><?php echo $num ?></td>
                    <td><?php echo $fetch_cart_products['name'] ?></td>
                    <td><img src="image.php/<?php echo $fetch_cart_products['image'] ?>" alt="Product Image"></td>
                    <td>$<?php echo $fetch_cart_products['price'] ?></td>
                    <td><?php echo $fetch_cart_products['quantity'] ?></td>
                    <td>$<?php echo $subtotal=number_format($fetch_cart_products['price']*$fetch_cart_products['quantity'] )?></td>
                    <td>
                       <a href="usercart.php?remove=<?php echo $fetch_cart_products['id']?>&name=<?php echo $fetch_cart_products['name']?>" onclick="return confirm('Are you sure you want to remove?')">
                            <i class="fas fa-trash"></i> Remove
                        </a>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $fetch_cart_products['id'] ?>" name="update_quantity_id">
                            <div class="quantity_box">
                            </div>
                        </form>
                    </td>
                </tr>
                <?php
                $grand_total=$grand_total+($fetch_cart_products['price']*$fetch_cart_products['quantity']);
                            $num++;
                        }
                    } else {
                        echo "<tr><td colspan='7'>Cart is empty</td></tr>"; // Display message when cart is empty
                    }
                ?>
            </table>
           <div class="table_bottom">
    <a href="viewproductsuser.php" class="bottom_btn">Resume Shopping</a>
    <h3 class="bottom_btn">Grand Total:<span>$<?php echo $grand_total ?></span></h3>
    <a href="usercart.php?delete_all=<?php ?>" onclick="return confirm('Are you sure you want to proceed with checkout?')" class="bottom_btn">Checkout</a>
</div>

            
        </section>
    </div>
</body>
</html>
