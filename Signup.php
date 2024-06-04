<?php
$con = new mysqli("localhost", "root","", "boxing_db"); 
if ($con->connect_error) { 
    die("Connection failed: " . $con->connect_error); 
}
$usersignin2 = "CREATE TABLE IF NOT EXISTS usersignin2 (
    user_id INT(9) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    email VARCHAR(35) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if ($con->query($usersignin2) === TRUE) {
   // echo "success creating table: ";
} else {
    echo "Error creating table: " . $con->error;
}

class Connect_db {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "boxing_db";

    function connect() {
        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        return $connection;
    }

    function read($query) {
        $connection = $this->connect();
        $result = mysqli_query($connection, $query);
        if (!$result) {
            return false;
        }  
        $data = []; 
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row; 
        }
        return $data;
    }

    function save($query) {
        $connection = $this->connect();
        $result = mysqli_query($connection, $query);
        if (!$result) {
            return false;
        } else {
            return true;
        }
    }
}

class Signup {
    private $error = "";

    public function create_user($data) {
        $user_id = $data['user_id'];
        $name = $data['username'];
        $email = $data['email'];
        $password = $data['password'];

        $DB = new Connect_db();

        // Check if user ID already exists in the database
        $existing_user_id = $DB->read("SELECT * FROM usersignin2 WHERE user_id = '$user_id'");
        if (!empty($existing_user_id)) {
            return "User ID already exists.<br>";
        }
        // Check if email already exists in the database
        $existing_email = $DB->read("SELECT * FROM usersignin2 WHERE email = '$email'");
        if (!empty($existing_email)) {
            return "Email already exists.<br>";
        }
        // Check if username already exists in the database
        $existing_user = $DB->read("SELECT * FROM usersignin2 WHERE username = '$name'");
        if (!empty($existing_user)) {
            return "Username already exists.<br>";
        }

        // Insert new user into the database
        $query = "INSERT INTO usersignin2 (user_id, username, email, password)
                  VALUES ('$user_id', '$name', '$email', '$password')";

        $result = $DB->save($query);

        if ($result) {
            // Insert username into cart table after successful signup
            $cart_query = "INSERT INTO cart (username) VALUES ('$name')";
            $cart_result = $DB->save($cart_query);
            
            if ($cart_result) {
                // Successfully inserted username into cart table
                return true;
            } else {
                // Failed to insert username into cart table
                return "Failed to insert username into cart table.<br>";
            }
        } else {
            // Failed to insert user into usersignin2 table
            return "Failed to create user.<br>";
        }
    }

    public function evaluate($data) {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $this->error .= $key . " is empty<br>";
            }
            if ($key == "user_id") {
                if (!is_numeric($value) || strlen($value) !== 9) {
                    $this->error .= "User ID must be a 9-digit number<br>";
                }
            }
        }

        if (empty($this->error)) {
            // No errors, proceed with user creation
            return $this->create_user($data);
        } else {
            // Errors occurred, return error messages
            return $this->error;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $signup2 = new Signup();
    $result = $signup2->evaluate($_POST);
    if ($result === true) {
        // Successful registration, redirect to login page
        header("Location: login.php");
        exit; // Ensure no more output after redirection
    } else {
        // Display error message on the registration form
        $display_massage = $result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup Form</title>
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
            height: 600px;
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
            <a href="login.php">login</a>
        </nav>
    </div>
</header>
<div id="bar2">
    <div id="login-text">Sign up to punchperfect</div>
    <?php 
    if(isset($display_massage)){
        echo "<div class='display_message'>
                <span>$display_massage</span>
                <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
              </div>";
    }
    ?>
    <form method="POST" action="">
        <input name="user_id" type="text" id="text" placeholder="User ID" required><br><br> 
        <input name="username" type="text" id="text" placeholder="Username" required ><br><br>
        <input name="email" type="email" id="text" placeholder="Email" required ><br><br> 
        <input name="password" type="password" id="text" placeholder="Password" required ><br><br> 
        <input type="submit" class="button" value="Signup"><br>
    </form>
    <a href="adminlogin.php" class="button">Admin Login</a>
</div>
</body>
</html>
