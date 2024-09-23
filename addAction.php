<?php
// Start session
session_start();

// Include the database connection file
require_once("dbConnection.php");

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Retrieve data from the form
    $names = isset($_POST['names']) ? $_POST['names'] : [];
    $ages = isset($_POST['ages']) ? $_POST['ages'] : [];
    $emails = isset($_POST['emails']) ? $_POST['emails'] : [];
    $positions = isset($_POST['positions']) ? $_POST['positions'] : [];

    // Ensure that the arrays have the same length
    $count = count($names);
    if (count($ages) === $count && count($emails) === $count && count($positions) === $count) {
        $success = true;

        // Loop through each employee data and insert into the database
        for ($i = 0; $i < $count; $i++) {
            $name = mysqli_real_escape_string($mysqli, $names[$i]);
            $age = (int)$ages[$i];
            $email = mysqli_real_escape_string($mysqli, $emails[$i]);
            $position = mysqli_real_escape_string($mysqli, $positions[$i]);

            $query = "INSERT INTO users (name, age, email, position) VALUES ('$name', '$age', '$email', '$position')";
            if (!mysqli_query($mysqli, $query)) {
                $success = false;
                break; // Stop on first failure
            }
        }

        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['message'] = "Input data is inconsistent.";
        $_SESSION['message_type'] = "danger";
        header("Location: index.php");
        exit();
    }
}
?>
