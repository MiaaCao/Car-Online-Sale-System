<?php
include "connection.php";  // Database connection file
include "navbar.php";  // Navigation bar file

// Check if the seller is logged in
if (isset($_SESSION['SellerID'])) {
    $sellerID = $_SESSION['SellerID'];

    // Fetch car details for the logged-in seller
    $sql = "SELECT * FROM cars WHERE SellerID = '$sellerID'";
    $result = $conn->query($sql);
} else {
    echo "You need to log in as a seller to view your cars.";
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Online Sale System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>

<style>
    

    @media (min-width: 768px) {
        .addcar_content {
            margin: 50px;
        }

        .addcarLink {
            margin-top: 30px; 
        }
    }

    @media (min-width: 992px) {
        .addcar_content {
            margin: 100px; 
        }
    }
</style>


<body>
    <!-- Content section for selling vehicles -->
    <div class="addcar_content">
        <!-- Heading for selling vehicles -->
        <h2 class="addcar_heading" style="text-align: center;">Sell Your Vehicle</h2>
        <!-- Text description for selling vehicles -->
        <p class="addcar_text" style="text-align: justify;">Looking to sell your car in New Zealand? We can help! 
            Our platform links you with eager car buyers, making selling your car easier 
            and boosting your chances of a successful sale.</p>
        <!-- Link to navigate to the AddCar page -->
        <a class="addcarLink" href="addcar.php">
            <button class="addcar_button btn btn-primary" type="button">ADD YOUR CAR</button>
        </a>       
    </div>
    
    <!-- Content section for displaying cars -->
    <div class="container mt-5">
    <div class="table-responsive">
        <h2 class="text-content" style="text-align: center;">List of Cars</h2>
        <table class="table table-bordered text-center">
            <thead>
                <tr class="tableBody">
                    <th>Car ID</th>
                    <th>Seller ID</th>
                    <th>Company Name</th>
                    <th>Car Model</th>
                    <th>Car Year</th>
                    <th>Price</th>
                    <th>Location</th>
                    <th>Body Type</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { 
                ?> 
                <tr>
                    <td><?php echo $row['carID']; ?></td>
                    <td><?php echo $row['sellerID']; ?></td>
                    <td><?php echo $row['companyName']; ?></td>
                    <td><?php echo $row['carModel']; ?></td>
                    <td><?php echo $row['carYear']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['bodyType']; ?></td>
                    <td><a href='deletecar.php?id=<?php echo $row["carID"]; ?>' class="btn btn-danger">Delete</a></td>   
                </tr>
                <?php 
                    } 
                } else {
                    echo "<tr><td colspan='9'>No cars found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
