<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/editAction.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <h2 class="text-center mb-4">Edit Employee Data</h2>

    <?php
    // Include the database connection file
    require_once("dbConnection.php");

    if (isset($_POST['update'])) {
        // Escape special characters in a string for use in an SQL statement
        $id = mysqli_real_escape_string($mysqli, $_POST['id']);
        $name = mysqli_real_escape_string($mysqli, $_POST['name']);
        $age = mysqli_real_escape_string($mysqli, $_POST['age']);
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);    
        $position = mysqli_real_escape_string($mysqli, $_POST['position']);    

        // Check for empty fields
        echo '<div class="mt-4">';
        if (empty($name) || empty($age) || empty($email) || empty($position)) {
            echo '<div class="alert alert-danger" role="alert">';
            if (empty($name)) {
                echo "Name field is empty.<br/>";
            }
            if (empty($age)) {
                echo "Age field is empty.<br/>";
            }
            if (empty($email)) {
                echo "Email field is empty.<br/>";
            }
            if (empty($position)) {
                echo "Position field is empty.<br/>";
            }
            echo '</div>';
            echo "<a href='javascript:self.history.back();' class='btn btn-secondary mt-3'>Go Back</a>";
        } else {
            // Update the database table
            $result = mysqli_query($mysqli, "UPDATE users SET `name` = '$name', `age` = '$age', `email` = '$email', `position` = '$position' WHERE `id` = $id");

            // Display success or error message
            if ($result) {
                echo '<div class="alert alert-success" role="alert">';
                echo "Data updated successfully!";
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">';
                echo "Failed to update data.";
                echo '</div>';
            }
            echo "<a href='index.php' class='btn btn-primary mt-3'>View Result</a>";
        }
        echo '</div>';
    }
    ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
