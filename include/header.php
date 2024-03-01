<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Bean & Brew</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        <a class="nav-link" href="about.php">About</a>
        <a class="nav-link" href="#">Baked Goods</a>
        <a class="nav-link" href="#">Pre-book Lessons</a>
        <a class="nav-link" href="#">Baked Goods</a>
        
        <button class="btn btn-outline-dark pt-1" onclick="myFunction()">dark mode</button>
      </div>
    </div>
    
  </div>

  <style>
    .dark-mode {
    background-color: #252729;
    color: white;
  }
  </style>

  <?php 
  
  if(isset($_COOKIE['name'])) 
  {
    ?>
    
    <div class="dropdown me-5">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      <?php echo ucfirst($_COOKIE['name']);?>
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
        <li><a class="dropdown-item" href="cart.php">Cart</a></li>
      </ul>
    </div>
    
    <?php
    }
    else
    {
    ?>
      <div class="dropdown me-5">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Account
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="register.php">Register</a></li>
        <li><a class="dropdown-item" href="login.php">Login</a></li>
        <li><a class="dropdown-item" href="cart.php">Cart</a></li>
      </ul>
    </div>
  <?php
  }
  ?>
</nav>

<!-- Java Script dark mode -->
<script>
function myFunction() {
   let element = document.body;
   element.classList.toggle("dark-mode");
}
</script>





