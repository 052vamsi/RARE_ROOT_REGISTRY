<?php
// Database connection
$con = mysqli_connect("localhost:3309", "root", "", "rare_root_registry");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Define a variable to track if the error message should be displayed
$errorMessage = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Insert user details into the database
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Redirect to the login page after successful signup
        header("Location: login.php");
        exit();
    } else {
        // Check if the error is due to duplicate entry for username
        if (mysqli_errno($con) == 1062) {
            // Set the error message
            $errorMessage = 'Username already exists. Please choose a different username.';
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <div class="container">
        <h2>User Signup</h2>
        <?php if (!empty($errorMessage)): ?>
            <!-- Display error message here -->
            <div class="error-message">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required><br>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required><br>

            <label for="designation">Designation</label>
            <input type="text" id="designation" name="designation" required><br>

            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" required><br>

            <input type="submit" value="Signup"><br><br>
        </form>
        <div class="goback-button">
            <form action="homepage.html">
                <input type="submit" value="Go Back">
            </form>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($con);
?>
