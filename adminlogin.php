<?php
session_start();
$con = new mysqli("localhost", "root", "", "boxing_db"); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; 
    $password = $_POST['password'];
    
    // Check if the username and password match the allowed credentials
    if (($username == "omar" && ($password == "123" )) || ($username == "bashar" && ( $password == "1234"))) {
        $_SESSION['username'] = $username;
        header("Location: addproducts.php"); // Redirect to admin.php
        exit();
    } else {
        echo '<div style="color: red; font-weight: bold; font-size:20px;">Invalid username or password. Please try again.</div>';
    }
}
$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>admin login Form</title>
    <style>
       body {
            font-family: Tahoma;
            background-image: url('https://wallpapercave.com/wp/wp2406553.png'); /* Add background image */
            background-size: 130%; /* Cover the entire background */
            background-position: center; /* Center the background */
            //background-color: #e9ebee; /* Fallback background color */
        }
        #bar {
            height: 100px;
            background-color: rgb(59, 89, 152);
            color: #d9dfeb;
            padding: 4px;
        }
        #signup_button {
            color:white;
            background-color: #42672a;
            width: 70px;
            text-align: center;
            padding: 4px;
            border-radius: 4px;
            float: right;
        }
        #bar2 {
            color: #d9dfeb;
			 background-color: var(--color1);

            width: 800px;
            height: 400px;
            margin: auto;
            margin-top: 50px;
            padding: 10px;
            padding-top: 50px;
            text-align: center;
            font-weight: bold;
        }
        #text {
            background-color: white;
            width: 300px;
            height: 40px;
            border-radius: 4px;
            border: solid 1px #aaa;
        }
        .button {
            width: 300px;
            height: 40px;
            border-radius: 4px;
            border: none;
			background-color: black;
            color: white;
            text-decoration: none;
            display: inline-block;
            line-height: 40px;
            text-align: center;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #3b5998;
        }
        #button {
            width: 300px;
            height: 40px;
            border-radius: 4px;
            border: none;
            background-color: rgb(59, 89, 152);
            color: white;
        }
        #login-text {
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
     <link rel="stylesheet" href="styleproduct.css">
</head>
<body>
<header class="header">
    <div class="header_body">
        <a href="index.php" class="logo">punch perfect</a>
        <nav class="navbar">
            <a href="login.php">login as user</a>
			            <a href="signup.php">signup as user</a>

        </nav>
    </div>
</header>
</head>
<body>
   
    <div id="bar2">
        <div id="login-text">login as an admin </div>
        <form method="post" action="">
            <input type="text" name="username" id="text" placeholder="admin Username"><br><br>
            <input type="password" name="password" id="text" placeholder="Password"><br><br> 
            <input type="submit" class="button" value="Login to admin page"><br><br><br>
        </form>
    </div>
</body>
</html>