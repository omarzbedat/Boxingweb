<?php
session_start();
$con = new mysqli("localhost", "root", "", "boxing_db"); 
if ($con->connect_error) { 
    die("Connection failed: " . $con->connect_error); 
}
$usersignin2 = "CREATE TABLE IF NOT EXISTS usersignin2 (
            user_id INT(9) AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(20) NOT NULL,
            email VARCHAR(35) NOT NULL,
            password VARCHAR(255) NOT NULL,
			url_address VARCHAR(50) NOT NULL
)";
if ($con->query($usersignin2) === TRUE) {
      // echo "sucsses creating table: " ;

} else {
    echo "Error creating table: " . $con->error;
}
$result = $con->query("SELECT * FROM usersignin2");
if ($result) {
    while ($array = $result->fetch_assoc()) {
        echo "<br>";
       
    }
} else {
    echo "Error fetching data: " . $con->error;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; 
    $password = $_POST['password'];
    $sql = "SELECT * FROM usersignin2 WHERE username='$username' AND password='$password'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: Homepage.php"); 
        exit();
    } else {
        echo "Invalid username or password. Please try again.";
    }
}
$con->close();
?>
	<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Form</title>
    <style>
        body {
            font-family: tahoma;
            background-color: #e9ebee;
        }
        #bar {
            height: 100px;
            background-color: rgb(59, 89, 152);
            color: #d9dfeb;
            padding: 4px;
        }
        #signup_button {
			color:white;
				background-color: #42672a; /* Corrected color */
				width: 70px;
				text-align: center;
				padding: 4px;
				border-radius: 4px; /* Corrected property */
				float: right;
        }
        #bar2 {
            background-color: white;
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
            border-radius: 4px; /* Corrected property */
            border: solid 1px #aaa;
        }
		.button {
				width: 300px;
				height: 40px;
				border-radius: 4px;
				border: none;
				background-color: rgb(59, 89, 152);
				color: white;
				text-decoration: none;
				display: inline-block;
				line-height: 40px;
				text-align: center;
				margin-top: 10px; /* Added margin-top */
				transition: background-color 0.3s ease;
			}
			.button:hover {
				background-color: #3b5998; /* Darker color on hover */
			}
        #button {
            width: 300px;
            height: 40px;
            border-radius: 4px; /* Corrected property */
            border: none;
            background-color: rgb(59, 89, 152);
            color: white;
        }
    </style>
</head>
<body>
    <div id="bar">
        <div style="font-size: 40px;">punchperfect</div>
        <a href="signup.php" id="signup_button">Signup</a>
    </div>
    <div id="bar2">
       Log in to punchperfect<br><br>
        <form method="post" action="">
            <input type="text" name="username" id="text" placeholder="Username"><br><br>
            <input type="password" name="password" id="text" placeholder="Password"><br><br> 
            <input type="submit" id="button" value="Login">
        </form>
		<a href="adminlogin.php" class="button">adminlogin</a>
    </div>
</body>
</html>


