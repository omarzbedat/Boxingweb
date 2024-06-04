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
        $_SESSION['username'] = $username; // Storing username in session
        header("Location: Homepage.php");
        exit();
    } else {
        $display_message = "Invalid username or password. Please try again.";
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
            font-family: Tahoma;
            background-image: url('https://wallpapercave.com/wp/wp2406553.png'); /* Add background image */
            background-size: 110%; /* Cover the entire background */
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
            color: white;
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
            <a href="login.php" class="logo">punch perfect</a>
            <nav class="navbar">
                <a href="signup.php">sign in</a>
            </nav>
        </div>
    </header>
    </head>

    <body>
        <?php
        if (isset($display_message)) {
            echo "<div class='display_message'>
                <span>$display_message</span>
                <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
              </div>";
        }
        ?>
        <div id="bar2">
            <div id="login-text">Log in to punchperfect</div>
            <form method="post" action="">
                <input type="text" name="username" id="text" placeholder="Username"><br><br>
                <input type="password" name="password" id="text" placeholder="Password"><br><br>
                <input type="submit" class="button" value="Login">
            </form>
            <a href="adminlogin.php" class="button">adminlogin</a>
        </div>
    </body>

</html>
