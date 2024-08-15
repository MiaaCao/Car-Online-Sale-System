<?php
include "navbar.php";
include "connection.php";

$carModel = $carYear = $carPrice = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $carModel = isset($_GET['carModel']) ? $conn->real_escape_string($_GET['carModel']) : '';
    $carYear = isset($_GET['carYear']) ? $conn->real_escape_string($_GET['carYear']) : '';
    $carPrice = isset($_GET['carPrice']) ? $conn->real_escape_string($_GET['carPrice']) : '';
}

$sql = "SELECT * FROM cars WHERE 1=1";

if ($carModel != "") {
    $sql .= " AND carModel LIKE '%$carModel%'";
}

if ($carYear != "") {
    $sql .= " AND carYear LIKE '%$carYear%'";
}

if ($carPrice != "") {
    $sql .= " AND price LIKE '%$carPrice%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Online Sale System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <style>
        .carSearch_container {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto; 
        padding: 10px;
    }

    .searchForm {
        display: flex;
        flex-wrap: wrap; 
        justify-content: center; 
        gap: 10px; 
        padding: 10px;
            border: 1px solid lightgray;
            margin-top: 4px;
    }

    .modelText, .yearText, .priceText {
        width: calc(100% - 20px); 
        max-width: 300px; 
        height: 40px;
        padding: 0 10px;
        box-sizing: border-box;
    }

    .search_button {
        width: calc(100% - 20px); 
        max-width: 150px; 
        height: 45px;
    }

    /* Responsive table styles */
    .table-responsive {
        overflow-x: auto; 
    }

    @media (min-width: 768px) {
        .searchForm {
            flex-wrap: nowrap; 
        }
    }

    @media (min-width: 992px) {
        .searchForm {
            justify-content: flex-start; 
        }
    }
    </style>
</head>
<body>

    <div class="carSearch_container">
        <form class="searchForm" method="GET" action="search.php">
            <input class="modelText" type="text" id="carModel" name="carModel" placeholder="Enter car model" value="<?php echo $carModel; ?>">
            <input class="yearText" type="text" id="carYear" name="carYear" placeholder="Enter car year" value="<?php echo $carYear; ?>">
            <input class="priceText" type="text" id="carPrice" name="carPrice" placeholder="Enter car price" value="<?php echo $carPrice; ?>">
            <button class="search_button btn btn-primary" style="width: 150px; height: 45px; margin-left: 25px;" type="submit">SEARCH</button>
        </form>
        <p id="notification" class="notification"></p>
    </div>


    <div class="container mt-5"> 
    <div class="table-responsive">
        <h2 class="text-content" style="text-align: center;">Search Result:</h2>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Car ID</th>
                    <th>Seller ID</th>
                    <th>Car Model</th>
                    <th>Company Name</th>
                    <th>Car Year</th>
                    <th>Price</th>
                    <th>Location</th>
                    <th>Body Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['carID']}</td>
                                <td>{$row['sellerID']}</td>
                                <td>{$row['carModel']}</td>
                                <td>{$row['companyName']}</td>
                                <td>{$row['carYear']}</td>
                                <td>{$row['price']}</td>
                                <td>{$row['location']}</td>
                                <td>{$row['bodyType']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No results found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
