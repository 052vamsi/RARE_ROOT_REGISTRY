<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rare root registry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
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


        .card {
            border: 1px  solid #ced4da; /* Border color */
            border-radius: 10px;
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1); /* Shadow effect */
            margin-right: 100px;
            background-color: rgba(43, 41, 41, 0.8); /* White background with 80% opacity */
        }

        .card-header {
            background-color: rgba(144, 238, 144, 0.5); /* Green header background */
            color: black; /* White header text color */
            border-radius: 10px 10px 0 0; /* Rounded top corners */
            padding: 10px 0; /* Top and bottom padding */
    
        }

        .card-body {
            padding: 20px; /* Add padding to the card body */
            background-color: rgba(255, 255, 255, 0.8);
        }
        .card-body input[type="text"] {
    color: black; /* Set the font color to black for all input fields */
}
.card-body label {
    color: black; /* Set the font color to black for all labels */
}

        .form-group label {
            color: black; /* Dark grey label text color */
        }

        .form-control {
            border: 1px solid gray; /* Input border color */
            border-radius: 5px; /* Input border radius */
        }

        .btn {
            background-color: #28a745; /* Green button background */
            border: none; /* Remove button border */
        }

        .btn:hover {
            background-color: #218838; /* Darker green on hover */
            cursor: pointer; /* Show pointer cursor on hover */
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h4>MEDICINAL PLANTS</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <?php
                                    // Establish a database connection
                                    $con = mysqli_connect("localhost:3309", "root", "", "rare_root_registry");

                                    if ($con === false) {
                                        die("ERROR: Could not connect. " . mysqli_connect_error());
                                    }

                                    // Check if the common name is provided via GET request
                                    if(isset($_GET['common_name'])) {
                                        $commonName = $_GET['common_name'];

                                        // Prepare the stored procedure call
                                        $query = "CALL GetMedicinalPlantDetailsByCommonName('$commonName')";

                                        // Execute the stored procedure
                                        if (mysqli_multi_query($con, $query)) {
                                            // Process the result set returned by the stored procedure
                                            if ($result = mysqli_store_result($con)) {
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        // Output the retrieved data
                                                        echo '<div class="form-group mb-1">';
                                                        echo '<label for="">Scientific Name</label>';
                                                        echo '<input type="text" value="' . $row['SCIENTIFIC_NAME'] . '" class="form-control">';
                                                        echo '</div>';
                                                        echo '<div class="form-group mb-3">';
                                                        echo '<label for="">Common Name</label>';
                                                        echo '<input type="text" value="' . $row['COMMON_NAME'] . '" class="form-control">';
                                                        echo '</div>';
                                                        echo '<div class="form-group mb-3">';
                                                        echo '<label for="">Family</label>';
                                                        echo '<input type="text" value="' . $row['FAMILY'] . '" class="form-control">';
                                                        echo '</div>';
                                                        echo '<div class="form-group mb-3">';
                                                        echo '<label for="">Population</label>';
                                                        echo '<input type="text" value="' . $row['POPULATION'] . '" class="form-control">';
                                                        echo '</div>';
                                                        echo '<div class="form-group mb-3">';
                                                        echo '<label for="">Phylum</label>';
                                                        echo '<input type="text" value="' . $row['PHYLUM'] . '" class="form-control">';
                                                        echo '</div>';
                                                        echo '<div class="form-group mb-3">';
                                                        echo '<label for="">Class</label>';
                                                        echo '<input type="text" value="' . $row['CLASS'] . '" class="form-control">';
                                                        echo '</div>';
                                                        echo '<div class="form-group mb-3">';
                                                        echo '<label for="">Genus</label>';
                                                        echo '<input type="text" value="' . $row['GENUS'] . '" class="form-control">';
                                                        echo '</div>';
                                                    }
                                                } else {
                                                    echo "No plants found with the provided common name.";
                                                }
                                                // Free result set
                                                mysqli_free_result($result);
                                            }
                                        } else {
                                            echo "Error executing the stored procedure: " . mysqli_error($con);
                                        }
                                    }

                                    // Close the database connection
                                    mysqli_close($con);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
