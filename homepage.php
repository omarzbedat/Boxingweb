<!DOCTYPE html>
<html lang="en">
<head>
    <title>About Us</title>
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
            text-align: center;
            transition: background-color 0.3s ease; /* Smooth transition on hover */
        }
        #bar:hover {
            background-color: #3b5998; /* Darker color on hover */
            box-shadow: 0px 0px 10px rgba(1, 0, 1, 0.2); /* Add shadow on hover */
        }
        #logout_button {
            color: white;
            background-color: #42672a;
            width: 70px;
            text-align: center;
            padding: 4px;
            border-radius: 4px;
            float: right;
            margin-top: 20px;
            text-decoration: none; /* Added text-decoration */
        }
        #logout_button:hover {
            background-color: #3b5998; /* Darker color on hover */
            box-shadow: 0px 0px 10px rgba(1, 0, 1, 0.2); /* Add shadow on hover */
        }
        #bar2 {
            background-color: white;
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
            text-align: center;
        }
        #button {
            width: 250px;
            height: 60px;
            border-radius: 4px;
            border: none;
            background-color: black; /* Dark green color */
            color: white;
            font-size: 20px;
            display: inline-block; /* Added to make the button inline with the logout button */
            line-height: 60px; /* Center the text vertically */
            text-decoration: none; /* Remove default link underline */
            transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transition on hover */
        }
        #button:hover {
            background-color: #3b5998; /* Darker color on hover */
            box-shadow: 0px 0px 10px rgba(1, 0, 1,2); /* Add shadow on hover */
        }
        #end-text {
            font-size: 20px; /* Larger font size */
        }
        #omar-bashar-image {
            width:350px; /* Set the width of the image */
            height: auto; /* Auto-adjust the height to maintain aspect ratio */
            margin: 20px auto; /* Add margin and center the image horizontally */
            display: block; /* Ensure the image is displayed as a block element */
        }
    </style>
    <link rel="stylesheet" href="styleproduct.css">
</head>
<body>
<header class="header">
    <div class="header_body">
        <a href="index.php" class="logo">punch perfect</a>
        <nav class="navbar">
            <a href="login.php">logout</a>        
						<a href="adminlogin.php">admin login</a>
						  <a href="viewproductsuser.php">shop now</a>

        </nav>
    </div>
</header>
<div id="bar2">
 <div id="end-text"> <!-- Added div wrapper for end text -->
	        <img  id="omar-bashar-image" src="https://th.bing.com/th/id/OIP.FKs99qLSC82eWCNC4NEsZgAAAA?rs=1&pid=ImgDetMain" alt="Omar and Bashar Image"> <!-- Add your image here -->

    <p>PunchPerfect - Buy boxing gear globally.</p>
    <p>Our project is a website where you can buy everything related to boxing gear. We assure you that you will receive the best quality products and the best & quick service all in one single website.</p>
    <p>To preview our products, click the button below.</p>
  
        <a href="viewproductsuser.php" id="button">Preview our products</a>
</div>
</body>
</html>
