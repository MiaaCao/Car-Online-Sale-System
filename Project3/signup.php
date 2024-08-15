<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Online Sale System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="navbar.php">
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

    /* Sign Up form */
    .Signup_form{
      margin: 25px auto; /* Sets the top and bottom margin to 25 pixels and left and right margins to auto */
      padding: 22px; /* Sets the padding to 22 pixels */
      background-color: white;
      border-radius: 3px; /* Sets the border radius to 3 pixels, giving rounded corners */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); /* creates a light gray, slightly blurred shadow effect that is horizontally centered, 2 pixels below the element, and with a blur radius of 4 pixels */
    }
  </style>

  <body>
  <?php include "navbar.php"; ?>

    <div class="container mt-5" >
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="Signup_form">
            <h2 class="Signup_form__heading text-center mb-4"><strong>Sign Up</strong></h2>
            <form class="Signup_form__form" id="signupForm" onsubmit="return validateForm()" action="signup.php" method="POST">
            <div class="mb-3">
                <label class="Signup_form__label" for="firstName">First Name:</label>
                <input class="Signup_form__input form-control" type="text" id="firstName" name="firstName">
                <span class="error-message" id="firstNameError"></span>
            </div>
            <div class="mb-3">
                <label class="Signup_form__label" for="lastName">Last Name:</label>
                <input class="Signup_form__input form-control" type="text" id="lastName" name="lastName">
                <span class="error-message" id="lastNameError"></span>
            </div>
            <div class="mb-3">
                <label class="Signup_form__label" for="address">Address:</label>
                <input class="Signup_form__input form-control" type="text" id="address" name="address">
                <span class="error-message" id="addressError"></span>
            </div> 
            <div class="mb-3">
                <label class="Signup_form__label" for="phoneNumber">Phone Number:</label>
                <input class="Signup_form__input form-control" type="text" id="phoneNumber" name="phoneNumber">
                <span class="error-message" id="phoneNumberError"></span>
            </div> 
            <div class="mb-3">
                <label class="Signup_form__label" for="email">Email:</label>
                <input class="Signup_form__input form-control" type="text" id="email" name="email">
                <span class="error-message" id="emailError"></span>
            </div>  
            <div class="mb-3">
                <label class="Signup_form__label" for="username">Username:</label>
                <input class="Signup_form__input form-control" type="text" id="username" name="username">
                <span class="error-message" id="usernameError"></span>
              </div>
              <div class="mb-3">
                <label class="Signup_form__label" for="password">Password:</label>
                <input class="Signup_form__input form-control" type="password" id="password" name="password">
                <span class="error-message" id="passwordError"></span>
              </div>
              <button class="Signup_form__button btn btn-primary w-100" type="submit">SIGN UP</button>
            </form>
            <div class="signupLink mt-3 text-center">
              <p class="messageContent">Already have an account. <a href="login.php">Login</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="validate.js"></script>

    <script>
      function validateEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) return false;
        if (!email.endsWith('.com')) return false;
        var atIndex = email.indexOf('@');
        if (email.indexOf('@', atIndex + 1) !== -1) return false;
        return true;
      }

      function validateForm() {
        document.querySelectorAll('.error-message').forEach(span => span.textContent = '');

        var isValid = true;

        var firstName = document.getElementById("firstName").value.trim();
        var lastName = document.getElementById("lastName").value.trim();
        var address = document.getElementById("address").value.trim();
        var phoneNumber = document.getElementById("phoneNumber").value.trim();
        var email = document.getElementById("email").value.trim();
        var username = document.getElementById("username").value.trim();
        var password = document.getElementById("password").value.trim();

        var nameRegex = /^[a-zA-Z ]+$/;
        var phoneNumberRegex = /^(\+?64|0)[2-9]\d{7,9}$/;
        var usernameRegex = /^[a-zA-Z0-9]{6,}$/;
        var passwordRegex = /^[a-zA-Z0-9]{6,}$/;

        if (!nameRegex.test(firstName)) {
          document.getElementById("firstNameError").textContent = "Please enter a valid first name.";
          isValid = false;
        }

        if (!nameRegex.test(lastName)) {
          document.getElementById("lastNameError").textContent = "Please enter a valid last name.";
          isValid = false;
        }

        if (address === "") {
          document.getElementById("addressError").textContent = "Please enter your address.";
          isValid = false;
        }

        if (!phoneNumberRegex.test(phoneNumber)) {
          document.getElementById("phoneNumberError").textContent = "Please enter a valid New Zealand phone number.";
          isValid = false;
        }

        if (!validateEmail(email)) {
          document.getElementById("emailError").textContent = "Please enter a valid email address ending with .com.";
          isValid = false;
        }

        if (!usernameRegex.test(username)) {
          document.getElementById("usernameError").textContent = "Username must consist of at least 6 alphanumeric characters.";
          isValid = false;
        }

        if (!passwordRegex.test(password)) {
          document.getElementById("passwordError").textContent = "Password must consist of at least 6 alphanumeric characters.";
          isValid = false;
        }

        return isValid;
      }

      // Function to change background color to yellow when input is selected
      function highlightInput(inputId) {
        document.getElementById(inputId).style.backgroundColor = "yellow";
      }

      // Function to revert background color to white when input is unselected
      function unhighlightInput(inputId) {
        document.getElementById(inputId).style.backgroundColor = "white";
      }

      // Add event listeners to input elements to trigger the highlight and unhighlight functions
      document.getElementById("firstName").addEventListener("focus", function() {
        highlightInput("firstName");
      });
      document.getElementById("firstName").addEventListener("blur", function() {
        unhighlightInput("firstName");
      });

      document.getElementById("lastName").addEventListener("focus", function() {
        highlightInput("lastName");
      });
      document.getElementById("lastName").addEventListener("blur", function() {
        unhighlightInput("lastName");
      });

      document.getElementById("address").addEventListener("focus", function() {
        highlightInput("address");
      });

      document.getElementById("address").addEventListener("blur", function() {
        unhighlightInput("address");
      });

      document.getElementById("phoneNumber").addEventListener("focus", function() {
        highlightInput("phoneNumber");
      });
      document.getElementById("phoneNumber").addEventListener("blur", function() {
        unhighlightInput("phoneNumber");
      });

      document.getElementById("email").addEventListener("focus", function() {
        highlightInput("email");
      });
      document.getElementById("email").addEventListener("blur", function() {
        unhighlightInput("email");
      });

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

    <?php
    include "connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $firstName = $conn->real_escape_string($_POST['firstName']);
      $lastName = $conn->real_escape_string($_POST['lastName']);
      $address = $conn->real_escape_string($_POST['address']);
      $phoneNumber = $conn->real_escape_string($_POST['phoneNumber']);
      $email = $conn->real_escape_string($_POST['email']);
      $username = $conn->real_escape_string($_POST['username']);
      $password =$conn->real_escape_string($_POST['password']); 
      
      $checkEmail = "SELECT * FROM seller WHERE email = '$email'";
      $result = $conn->query($checkEmail);

      if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists. Please use a different email.');
        window.history.back(); </script>";
      } else {
        $sql = "INSERT INTO seller (firstName, lastName, address, phoneNumber, email, username, password)
                VALUES ('$firstName', '$lastName', '$address', '$phoneNumber', '$email', '$username', '$password')";

        if ($conn->query($sql) === TRUE) {
          echo "<script>alert('Account created successfully!'); window.location.href='login.php';</script>";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
      $conn->close();
    }
    ?>
  </body>
</html>
