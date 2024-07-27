<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rare Root Registry</title>
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
        .logo {
            width: 100px; /* Decreased width */
            height: auto; /* Automatically adjust height */
        }
        .container {
            text-align: center;
            margin-left: 400px;
            width: 800px;
        }
        .btn-green {
            background-color: rgba(0, 128, 0, 0.5);
            border-color: green;
            margin-left: 165px;
        }
        .btn-green:hover {
            background-color: darkgreen;
            border-color: darkgreen;
            align-items: center;
        }
        .row select {
            width: 400px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0,0.1);
            margin-bottom: 20px;
        }
        .card-body {
            align-items: center;
            text-align: center;
            width: 800px;
        }
        .green-box {
            background-color: rgba(0, 128, 0, 0.5);
            text-align: center;
            width: 350px;
            height: 50px;
            line-height: 40px;
            margin-bottom: 10px;
            margin-right: 340px;
            border: 1px solid black;
            border-radius: 10px;
            display: inline-block;
        }
        .card-link {
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Insert your logo here -->
        <img src="11zon_cropped.png" alt="Logo" class="logo">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h4>RARE_ROOT_REGISTRY</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="common_name" id="common_name">
                                        <option value="" selected>Select Your Plant Name</option>
                                        <?php
                                        // Define the plant names
                                        $plantNames = ["East Himalayan Yew", "Red Sanders", "Asiatic Wild Dogwood", "Kutki", "Indian Sandalwood", "Ativisha", "Sarpgandha", "Agarwood", "Costus", "Himalayan Orchi", "Blue Lotus", "Himalayan Trillium", "Ladder Brake", "Indian Barberry", "Dhasingre", "Glory Lily", "Kumbil", "Date-plum", "Yellow Himalayan Fritillary", "Indian Gentian", "Liquorice", "Baheda", "Malabar Nut", "Whipcord Cobra Lily", "Himalayan Stachyurus", "Green Turmeric", "Indian Bay Leaf", "Son-Ghanta", "Maderaspatensis", "Ceylon Cherry"];
                                        foreach($plantNames as $plant) {
                                            // Check if the current plant name matches the one selected by the user
                                            if (isset($_GET['search']) && $_GET['common_name'] === $plant) {
                                                echo "<option value=\"$plant\" selected>$plant</option>";
                                            } else {
                                                echo "<option value=\"$plant\">$plant</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="submit" class="btn btn-green" name="search">
                                </div>
                            </div>
                        </form>
                        <div class="row mt-3">
                            <?php 
                            $con = mysqli_connect("localhost:3309", "root", "", "rare_root_registry");
                            if(isset($_GET['search'])) {
                                $common_name = $_GET['common_name'];
                                $query = "SELECT * FROM medicinal_plants WHERE Common_name LIKE '%$common_name%'";
                                $result = mysqli_query($con, $query);
                                if(mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $plant_id = $row['PLANT_ID'];
                                        ?>
                                        <div class="col-md-12">
                                            <div class="green-box">
                                                <a href="medicinal.php?common_name=<?= urlencode($common_name) ?>" class="card-link">PLANT INFORMATION</a>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="green-box">
                                                <a href="habitat.php?common_name=<?= urlencode($common_name) ?>" class="card-link">HABITATS</a>
                                            </div>
                                        </div>
                                        <!-- Similar blocks for other links -->
                                        <div class="col-md-12">
                                            <div class="green-box">
                                                <a href="threats.php?common_name=<?= urlencode($common_name) ?>" class="card-link">THREATS</a>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="green-box">
                                                <a href="traditional_use.php?common_name=<?= urlencode($common_name) ?>" class="card-link">TRADITIONAL USES</a>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="green-box">
                                                <a href="phyto.php?common_name=<?= urlencode($common_name) ?>" class="card-link">PHYTOCHEMICAL INFORMATION</a>
                                            </div>
                                        </div>
                                        
                                        <?php
                                    }
                                } else {
                                    echo "No plants found with the provided criteria.";
                                }
                                mysqli_close($con);
                            }
                            ?>
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
