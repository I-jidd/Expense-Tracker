<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles/home_page.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />
    <title>Expense Trackers</title>
  </head>
  <body>
    <!-- navigation bar -->
    <nav class="navbar">
      <div class="logo"><img src="./styles/icons/logo.svg" alt="logo" /></div>
      <ul class="nav-buttons">
        <li><a href="#">Home</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Add Expense</a></li>
        <li><a href="#">Categories</a></li>
        <li><a href="login_page.php">Logout</a></li>
      </ul>
    </nav>
    <!-- fetching data from the database -->
    <?php
      session_start();

      if(!isset($_SESSION['username'])) {
        header("Location: login_page.html");
        exit();
      }
      $username = $_SESSION['username'];
    ?>
    <div class="container-details">
      <div class="background"></div>
      <h1>HI, <?php echo strtoupper($username)?>!</h1>
      <h2 class="date">Date: April 17, 2023</h2>
      <h2 class = "total">Total Expense this Month:  3045.00 php</h2>
    </div>

    <!-- table -->
    <table >
      <thead style="background-color: #47d0e6; color: white;">
        <tr>
          <th >Date</th>
          <th >Category</th>
          <th >Description</th>
          <th >Amount (PHP)</th>
          <th >Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td >2025-04-23</td>
          <td >Food</td>
          <td >Lunch at cafe</td>
          <td >150.00</td>
          <td >
            <button class="edit">Edit</button>
            <button class="delete">Delete</button>
          </td>
        </tr>
  </body>
</html>
