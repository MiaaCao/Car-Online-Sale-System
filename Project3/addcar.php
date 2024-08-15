<?php
session_start();
include 'connection.php';  // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $companyName = $conn->real_escape_string($_POST['companyName']);
    $carModel = $conn->real_escape_string($_POST['carModel']);
    $carYear = $conn->real_escape_string($_POST['carYear']);
    $price = $conn->real_escape_string($_POST['price']);
    $location = $conn->real_escape_string($_POST['location']);
    $bodyType = $conn->real_escape_string($_POST['body_type']);

    if (isset($_SESSION['SellerID'])) {
        $sellerID = $_SESSION['SellerID'];

        $sql = "INSERT INTO cars (sellerID, companyName, carModel, carYear, price, location, bodyType)
                VALUES ('$sellerID', '$companyName', '$carModel', '$carYear', '$price', '$location', '$bodyType')";

        if ($conn->query($sql) === TRUE) {
            // Output success message
            echo "<script>alert('Car details saved successfully.');</script>";
        } else {
            // Output error message
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "SellerID not found in session.";
    }

    $conn->close();  // Close the database connection
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
    <style>
        body {
            background-image: url('./Images/background.webp');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .AddCar_form {
            margin: 25px auto;
            padding: 22px;
            background-color: white;
            border-radius: 3px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-bottom: 10px;
            display: block;
        }

        .AddCar_form_button {
            display: flex;
            justify-content: space-between;
        }

        .AddCar_form__button {
            flex: 1;
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <a href="manage.php" class="backLink">
        <div class="backContainer" style="color: white; font-size:large;">
            <svg class="backIcon" style="margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"></path>
            </svg><strong>Back</strong>
        </div>
    </a>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="AddCar_form">
                    <h2 class="AddCar_form__heading text-center mb-4"><strong>Add Your Car</strong></h2>
                    <p class="AddCar_form_content" style="text-align: justify;">Please fill out the form below with the required details to sell your car.</p>
                    <form class="AddCar_form__form" id="AddCarForm" onsubmit="return addCarValidateForm()" action="addcar.php" method="POST">
                        <div class="mb-3">
                            <label class="AddCar_form__label" for="companyName">Company Name:</label>
                            <input class="AddCar_form_input form-control" type="text" id="companyName" name="companyName">
                            <span class="error-message" id="companyNameError"></span>
                        </div>
                        <div class="mb-3">
                            <label class="AddCar_form__label" for="carModel">Car Model:</label>
                            <input class="AddCar_form_input form-control" type="text" id="carModel" name="carModel">
                            <span class="error-message" id="carModelError"></span>
                        </div>
                        <div class="mb-3">
                            <label class="AddCar_form_label" for="carYear">Car Year:</label>
                            <input class="AddCar_form_input form-control" type="text" id="carYear" name="carYear">
                            <span class="error-message" id="carYearError"></span>
                        </div>
                        <div class="mb-3">
                            <label class="AddCar_form_label" for="price">Price:</label>
                            <input class="AddCar_form_input form-control" type="text" id="price" name="price">
                            <span class="error-message" id="priceError"></span>
                        </div>
                        <div class="mb-3">
                            <label class="AddCar_form_label" for="location">Location:</label>
                            <input class="AddCar_form_input form-control" type="text" id="location" name="location">
                            <span class="error-message" id="locationError"></span>
                        </div>
                        <div class="mb-3">
                            <label class="AddCar_form_label" for="body_type">Body Type:</label>
                            <input class="AddCar_form_input form-control" type="text" id="body_type" name="body_type">
                            <span class="error-message" id="body_typeError"></span>
                        </div>
                        <div class="AddCar_form_button">
                            <button class="AddCar_form__button btn btn-primary w-50" type="button" onclick="goBack()">GO BACK</button>
                            <button class="AddCar_form__button btn btn-primary w-50" type="submit">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addCarValidateForm() {
            document.querySelectorAll('.error-message').forEach(span => span.textContent = '');

            var isValid = true;
            var companyName = document.getElementById("companyName").value;
            var carModel = document.getElementById("carModel").value;
            var carYear = document.getElementById("carYear").value;
            var price = document.getElementById("price").value;
            var location = document.getElementById("location").value;
            var bodyType = document.getElementById("body_type").value;

            var nameRegex = /^[A-Za-z\s]+$/;
            var alphanumericRegex = /^[A-Za-z0-9\s]+$/;
            var yearRegex = /^\d{4}$/;
            var numericalRegex = /^\d+$/;

            if (!nameRegex.test(companyName)) {
                document.getElementById("companyNameError").textContent = "Please enter a valid company name.";
                isValid = false;
            }

            if (!alphanumericRegex.test(carModel)) {
                document.getElementById("carModelError").textContent = "Please enter a valid car model name.";
                isValid = false;
            }

            if (!yearRegex.test(carYear)) {
                document.getElementById("carYearError").textContent = "Please enter a valid year.";
                isValid = false;
            }

            if (!numericalRegex.test(price)) {
                document.getElementById("priceError").textContent = "Please enter a valid price.";
                isValid = false;
            }

            if (!nameRegex.test(location)) {
                document.getElementById("locationError").textContent = "Please enter a valid location.";
                isValid = false;
            }

            if (!nameRegex.test(bodyType)) {
                document.getElementById("body_typeError").textContent = "Please enter a valid body type.";
                isValid = false;
            }

            return isValid;
        }

        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
