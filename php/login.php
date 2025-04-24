<?php
    session_start();
    require_once './includes/connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $conn-> real_escape_string($_POST['username']);
        $password = $_POST['password'];
        // $password = md5($password); // Encrypt the password

        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($password == $row['password']) { // Compare the password directly for simplicity
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $row['id'];
                
                header("Location: ../home_page.php");
                exit();
            }
            else {
                echo "Incorrect password.";
                // echo "<script type='text/javascript'>alert('Incorrect password');</script>";
            }
        } else{
            echo "<script type='text/javascript'>alert('Username not found');</script>";
        }
    }