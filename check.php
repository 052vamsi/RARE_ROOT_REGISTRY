<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conservation Status</title>
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
        .container {
            margin: 20px auto;
            padding: 20px;
            width: 50%;
            background-color: rgba(255, 255, 255, 0.8);;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
            margin-bottom: 10px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .plant-info {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Conservation Status</h2>
        <form method="post">
        <select name="status" id="status">
    <option value="" selected disabled>Select your conservation status</option>
    <option value="Extinct">Extinct</option>
    <option value="Extinct in the wild">Extinct in the wild</option>
    <option value="Critically endangered">Critically endangered</option>
    <option value="Endangered">Endangered</option>
    <option value="Vulnerable">Vulnerable</option>
    <option value="Near threatened">Near threatened</option>
    <option value="Least concern">Least concern</option>
    <option value="Data deficient">Data deficient</option>
    <option value="Not evaluated">Not evaluated</option>
</select>


            <button type="submit" name="submit">Submit</button>
        </form>

        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the 'status' parameter is set
            if (isset($_POST["status"])) {
                // Get the selected status
                $status = $_POST["status"];

                // Connect to your database (replace 'hostname', 'username', 'password', and 'database' with your actual credentials)
                $conn = new mysqli("localhost:3309", "root", "", "rare_root_registry");

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Prepare and execute the stored procedure based on the selected status
                $sql = "CALL GetPlantsByConservationStatus(?)"; // Call the stored procedure
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $status);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<div class='plant-info'>";
                    echo "<h3>Plants with Conservation Status: $status</h3>";
                    echo "<ul>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>" . $row["COMMON_NAME"] . "</li>"; // Adjust column name as per your table
                    }
                    echo "</ul>";
                    echo "</div>";
                } else {
                    echo "<p>No plants found with conservation status: $status</p>";
                }

                // Close the database connection
                $conn->close();
            } else {
                echo "Status not provided";
            }
        }
        ?>
    </div>
</body>
</html>
