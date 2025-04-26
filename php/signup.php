<?php
    require_once './includes/connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $conn-> real_escape_string($_POST['username']);
        $password = $conn-> real_escape_string($_POST['password']);

        $sql = "INSERT INTO users (username, password)
                VALUES ('$username', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }