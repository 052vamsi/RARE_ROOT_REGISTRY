

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(leaf6.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-container {
    background-color: rgba(43, 41, 41, 0.8); /* Transparent background color */
    padding: 20px; /* Increased padding for better spacing */
    border-radius: 10px;
    width: 400px;
    text-align: center; /* Align content to center */
    box-shadow: 0 0 500px rgba(244, 246, 247, 0.3);
}
.login-container p {
    color: #fff; /* Change the text color to white */
}


.login-container h2 {
    margin-bottom: 20px; /* Added margin to separate header from inputs */
    color: bisque;
}
.login-container a {
    color: burlywood; /* Change the color of the signup link to green */
    text-decoration: none; /* Remove the underline from the link */
}

input[type="text"],
input[type="password"],
input[type="submit"] {
    width: calc(100% - 22px); /* Set width to 100% minus the padding and border */
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
    background-color: rgba(255, 255, 255, 0.8); /* Transparent input background color */
    box-sizing: border-box; /* Include padding and border in the element's total width */
}

input[type="submit"] {
    background-color: rgba(76, 175, 80, 0.8); /* Transparent green color */
    color: white;
    cursor: pointer;
}


    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login" name="login">
        </form>
        <div class="goback-button">
            <form action="homepage.html">
                <input type="submit" value="Go Back">
            </form>
        </div>
        <p>Haven't signed up yet? <a href="Signup.php">Sign up</a></p>
        <p></p>
        <?php
        $conn= mysqli_connect("localhost:3309","root","","rare_root_registry");
        if(isset($_POST['login'])){
            $username = $_POST["username"];
            $password = $_POST["password"];
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            header("Location: aboutrrr.html");
            exit();
        } else {
            echo "Invalid username or password";
        }
    }
    ?>
  
</body>
</html>
