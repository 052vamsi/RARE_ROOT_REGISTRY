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
.card-header {
            background-color: rgba(144, 238, 144, 0.5); /* Green header background */
            color: black; /* White header text color */
            border-radius: 10px 10px 0 0; /* Rounded top corners */
            padding: 10px 0; /* Top and bottom padding */
    
        }
.card {
            border: 1px  solid #ced4da; /* Border color */
            border-radius: 10px;
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1); /* Shadow effect */
            margin-right: 100px;
            background-color: rgba(43, 41, 41, 0.8); /* White background with 80% opacity */
        }
        .card-body {
            padding: 20px; /* Add padding to the card body */
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h4>THREATS</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <?php 
                                    $con = mysqli_connect("localhost:3309", "root", "", "rare_root_registry");

                                    if(isset($_GET['common_name'])) {
                                        $common_name = $_GET['common_name'];

                                        // Prepare and execute the stored procedure
                                        $query = "CALL GetThreatsByCommonName('$common_name')";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0) {
                                            foreach($query_run as $row) {
                                ?>
                                                <div class="form-group mb-3">
                                                    <label for="">THREATS</label>
                                                    <input type="text" value="<?= $row['Threats']; ?>" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">CULTIVATION_GUIDELINES</label>
                                                    <input type="text" value="<?= $row['Cultivation_guidelines']; ?>" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">CONSERVATION-STATUS</label>
                                                    <input type="text" value="<?= $row['Conservation_status']; ?>" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">LAST UPDATED ON</label>
                                                    <input type="text" value="<?= $row['Last_updated']; ?>" class="form-control">
                                                </div>
                                <?php
                                            }
                                        } else {
                                            echo "No Record Found";
                                        }
                                    }
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
