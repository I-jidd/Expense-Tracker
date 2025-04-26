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
      
      // fetch all expenses for the logged-in user
      require_once './php/includes/connection.php';
      $username = $_SESSION['username'];

      $sql = "SELECT * FROM expenses WHERE expense_id = (SELECT id FROM users WHERE username = '$username')";
      $result = $conn->query($sql);
      
    ?>
    <div class="container-details">
      <div class="background"></div>
      <h1>HI, <?php echo strtoupper($username)?>!</h1>
      <h2 class="date">Date: <?php echo date('F j, Y'); ?></h2>
      <?php
        // Fetch total expenses for the current month
        $month = date('m'); // current month (e.g., 04)
        $year = date('Y');  // current year (e.g., 2025)

        $total_sql = "SELECT SUM(amount) AS total 
                      FROM expenses 
                      WHERE expense_id = (SELECT id FROM users WHERE username = '$username')
                      AND MONTH(date) = '$month' 
                      AND YEAR(date) = '$year'";

        $total_result = $conn->query($total_sql);
        $total_row = $total_result->fetch_assoc();
        $total_expense = $total_row['total'] ?? 0; // if null, fallback to 0
      ?>
      <h2 class="total">Total Expense this Month: <?php echo number_format($total_expense, 2); ?> PHP</h2>
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
        <?php 
          if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row['date'] . "</td>";
              echo "<td>" . $row['category'] . "</td>";
              echo "<td>" . $row['description'] . "</td>";
              echo "<td>" . $row['amount'] . "</td>";
              echo "<td>
                      <button class='edit'>Edit</button>
                      <button class='delete'>Delete</button>
                    </td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='5' style='text-align: center;'>No expenses found.</td></tr>";
          }
          $conn->close();
        ?>
  </body>
</html>
