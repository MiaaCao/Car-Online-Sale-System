<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .banner img {
        width: 100%;
        height: auto;
        display: block;
    }

    .saleContainer {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap; /* Allow items to wrap on smaller screens */
        margin-top: 20px;
    }

    .car {
        text-align: center;
        margin: 10px;
        padding: 10px;
        border: 2px solid #ccc;
        width: 300px; 
        box-sizing: border-box;
    }

    .car img {
        width: 100%;
        height: 200px;
        object-fit: cover; 
    }

    .car h4, .car p {
        margin: 5px 0;
    }

    .contactDetail {
        text-align: center;
        margin-top: 20px;
    }
</style>

<body>
    <!-- Banner container -->
    <div class="banner">
        <img src="./Images/banner.jpg" alt="Banner Image">
    </div>

    <!-- Navigation bar -->
    <?php include "navbar.php";?>

    <div class="container">
        <div class="section">
            <h2 class="home_heading" style="margin-top: 20px;"><strong>The Best Sale</strong></h2>
            <div class="saleContainer">
                <div class="car">
                    <img src="./Images/Tesla Model 3.jpg" alt="Tesla Model 3">
                    <h4>Tesla Model 3</h4>
                    <p>Price: $59,900</p>
                </div>

                <div class="car">
                    <img src="./Images/BMW_2015.jpg" alt="BMW 1 Series">
                    <h4>BMW 1 Series</h4>
                    <p>Price: $36,800</p>
                </div>

                <div class="car">
                    <img src="./Images/2024 Toyota Corolla ZR Hybrid sedan.jpg" alt="Toyota Corolla ZR Hybrid">
                    <h4>Toyota Corolla ZR</h4>
                    <p>Price: $49,000</p>
                </div>
            </div>
        </div>

        <div class="section">
            <h2 class="home_heading"><strong>Contact Us</strong></h2>
            <p class="contact_number"><strong>Contact Number: </strong> 022-6345-8989</p>
            <p class="contact_email"><strong>Contact Email: </strong> online.car@gmail.com</p>
        </div>
    </div>
</body>

</html>
