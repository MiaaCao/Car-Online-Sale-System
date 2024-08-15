<?php
include "navbar.php";
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $conn->real_escape_string($_POST['date']);
    $details = $conn->real_escape_string($_POST['details']);
    $carID = $conn->real_escape_string($_POST['carID']);

    $sql = "INSERT INTO feedback (carID, `date`, `details`)
            VALUES ('$carID', '$date', '$details')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Feedback details saved successfully.');
                window.location.href = 'feedback.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
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
    body {
        background-image: url('./Images/background.webp');
        background-size: cover;
        background-repeat: no-repeat;
    }

    .error-message {
        color: red;
        font-size: 12px;
        margin-bottom: 10px;
        display: block;
    }

    .Feedback_form {
        margin: 25px auto;
        padding: 22px;
        background-color: white;
        border-radius: 3px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }
</style>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="Feedback_form">
                    <h2 class="Feedback_form__heading text-center mb-4"><strong>Feedback</strong></h2>
                    <form class="Feedback_form__form" id="feedbackForm" action="feedback.php" onsubmit="return feedbackValidateForm()" method="POST">
                        <div class="mb-3">
                            <label class="Feedback_form__label" for="cars">Cars:</label>
                            <select class="Feedback_form__input form-control" id="cars" name="carID">
                                <option value="">Select Car Model</option>
                                <?php
                                include 'connection.php';
                                $sql = "SELECT carID, carModel FROM cars";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $carID = $row["carID"];
                                        $carModel = $row["carModel"];
                                        echo '<option value="' . $carID . '">' . $carModel . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No car models found</option>';
                                }

                                $conn->close();
                                ?>
                            </select>
                            <span class="error-message" id="carsError"></span>
                        </div>
                        <div class="mb-3">
                            <label class="Feedback_form__label" for="date">Date:</label>
                            <input class="Feedback_form__input form-control" type="date" id="date" name="date">
                            <span class="error-message" id="dateError"></span>
                        </div>
                        <div class="mb-3">
                            <label class="Feedback_form__label" for="details">Details:</label>
                            <textarea class="Feedback_form__input form-control" type="text" id="details" name="details"></textarea>
                            <span class="error-message" id="detailsError"></span>
                        </div>
                        <button class="Feedback_form__button btn btn-primary w-100" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="validate.js"></script>
<script>
    function feedbackValidateForm() {
        document.querySelectorAll('.error-message').forEach(span => span.textContent = '');

        var isValid = true;
        var cars = document.getElementById("cars").value;
        var date = document.getElementById("date").value;
        var details = document.getElementById("details").value;

        if(!cars){
            document.getElementById("carsError").textContent = "Please select a car model.";
            isValid = false;
        }

        if (!date) {
            document.getElementById("dateError").textContent = "Please select a date.";
            isValid = false;
        }

        if (!details) {
            document.getElementById("detailsError").textContent = "Details is required.";
            isValid = false;
        }

        return isValid;
    }
</script>
</html>
