<?php
include "connection.php";  // Database connection file
include "navbar.php"; 

if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Fetch sellers details from the database
    $sql = "SELECT * FROM seller WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login
        $row = $result->fetch_assoc(); // Fetch the row from the result set

        $_SESSION['username'] = $username;
        $_SESSION['SellerID'] = $row['sellerID']; // Assign SellerID from database to session variable
       
        echo "<script>window.location.href='home.php';</script>";
        exit(); 
    } else {
        // Invalid login
        echo "<script>alert('Invalid username or password.'); window.history.back();</script>";
        exit(); 
    }
    $conn->close(); // Close database connection
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
    .Login_form__button:hover {
        background-color: lightblue;
    }
    .error-message {
        color: red;
        font-size: 12px;
        margin-bottom: 10px;
        display: block;
    }
    .Login_form {
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
            <div class="Login_form">
                <h2 class="Login_form__heading text-center mb-4"><strong>Login</strong></h2>
                <form class="Login_form__form" id="loginForm" action="login.php" method="POST">
                    <div class="mb-3">
                        <label class="Login_form__label" for="username">Username:</label>
                        <input class="Login_form__input form-control" type="text" id="username" name="username">
                        <span class="error-message" id="usernameError"></span>
                    </div>
                    <div class="mb-3">
                        <label class="Login_form__label" for="password">Password:</label>
                        <input class="Login_form__input form-control" type="password" id="password" name="password">
                        <span class="error-message" id="passwordError"></span>
                    </div>
                    <button class="Login_form__button btn btn-primary w-100" type="submit">LOGIN</button>
                </form>
                <div class="loginLink mt-3 text-center">
                    <p class="messageContent">Don't have an account. <a href="signup.php">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="validate.js"></script>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var usernameError = document.getElementById('usernameError');
        var passwordError = document.getElementById('passwordError');
        var isValid = true;

        if (!username) {
            usernameError.textContent = 'Username is required';
            isValid = false;
        } else {
            usernameError.textContent = '';
        }

        if (!password) {
            passwordError.textContent = 'Password is required';
            isValid = false;
        } else {
            passwordError.textContent = '';
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    // Function to change background color to yellow when input is selected
    function highlightInput(inputId) {
        document.getElementById(inputId).style.backgroundColor = "yellow";
    }

      // Function to revert background color to white when input is unselected
      function unhighlightInput(inputId) {
        document.getElementById(inputId).style.backgroundColor = "white";
      }

      document.getElementById("username").addEventListener("focus", function() {
        highlightInput("username");
      });
      document.getElementById("username").addEventListener("blur", function() {
        unhighlightInput("username");
      });

      document.getElementById("password").addEventListener("focus", function() {
        highlightInput("password");
      });
      document.getElementById("password").addEventListener("blur", function() {
        unhighlightInput("password");
      });
</script>
</body>
</html>
