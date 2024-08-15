<?php
  session_start();
  function check_login() {
    return isset($_SESSION['username']);
  }
  $username = '';
  if (check_login()) {
    $username = 'Hello ' . htmlspecialchars($_SESSION['username']);
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
  /* Style the navigation bar */
.navigation_bar {
  background-color: #5A5A66;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  position: relative;
}

/* Logo styles */
.logo {
  height: 50px;
  position: absolute;
  left: 20px;
}

/* Center nav container */
.center_nav {
  flex: 1;
  display: flex;
  justify-content: center;
}

/* Right nav container */
.right_nav {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

/* Navigation list styles */
.navigation_list {
  list-style: none;
  display: flex;
  align-items: center;
  padding: 0;
}

/* Navigation items */
.navigation_item {
  color: white;
  text-decoration: none;
  padding: 10px 20px;
  display: block;
}

.navigation_item:hover {
  background-color: #3C3C47;
  border-radius: 4px;
}

/* Username display */
.username {
  margin-right: 20px;
  color: white;
}

/* Logout form styles */
.logout-form {
  display: inline-block;
  margin: 0;
}

.logout-button {
  background-color: transparent;
  color: white;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 4px;
}

.logout-button:hover {
  background-color: #2B2B32;
}

/* Hamburger button styles */
.hamburger {
  background: unset;
  border: unset;
  cursor: pointer;
  display: none;
  position: absolute;
  top: 10px;
  right: 20px;
}

.hamburger svg {
  stroke: white;
}

/* Responsive styles */
@media (max-width: 768px) {
  .hamburger {
    display: block;
  }

  .navigation_list {
    display: none;
    flex-direction: column;
    align-items: center;
    width: 100%;
  }

  .navigation_list.active {
    display: flex;
  }

  .navigation_bar {
    flex-direction: column;
    align-items: center;
  }

  .navigation_bar.open .navigation_list {
    display: flex;
  }

  .logo {
    position: static;
    margin-bottom: 10px;
  }
}

</style>
<body>
  <header>
    <div class="navigation_bar" id="navbar">
      <img class="logo" src="./Images/logo.png" alt="Logo">
      <div class="center_nav">
        <ul class="navigation_list center_list"> 
          <li><a class="navigation_item" href="home.php"><strong>Home</strong></a></li>
          <li><a class="navigation_item" href="search.php"><strong>Search</strong></a></li>
          <?php if (check_login()): ?>
            <li><a class="navigation_item" href="manage.php"><strong>Manage</strong></a></li>
          <?php endif; ?>
          <li><a class="navigation_item" href="feedback.php"><strong>Feedback</strong></a></li>
        </ul>
      </div>
      <div class="right_nav">
        <ul class="navigation_list right_list">
          <?php if (check_login()): ?>
            <span class="navigation_item username"><?php echo htmlspecialchars($username); ?></span>
            <form method="post" action="logout.php" class="navigation_item logout-form">
              <button class="logout-button" type="submit">Logout</button>
            </form>
          <?php else: ?>
            <li><a class="navigation_item" href="signup.php"><strong>Signup</strong></a></li>
            <li><a class="navigation_item" href="login.php"><strong>Login</strong></a></li>
          <?php endif; ?>
        </ul>
      </div>
      <button class="hamburger" id="hamburger_toggle">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <path d="M4 6l16 0" />
          <path d="M4 12l16 0" />
          <path d="M4 18l16 0" />
        </svg>
      </button>
    </div>
  </header>

  <script>
    const hamToggle = document.querySelector("#hamburger_toggle");
    const navbar = document.querySelector("#navbar");
    hamToggle.addEventListener("click", function() {
      navbar.classList.toggle("open");
    });
  </script>
</body>
</html>
