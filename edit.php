<?php
// Include the database connection file
require_once("dbConnection.php");

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the id parameter to avoid SQL injection
    $id = mysqli_real_escape_string($mysqli, $_GET['id']);

    // Prepare and execute the query to fetch the user data
    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE id = '$id'");

    // Check if a row is returned
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the result data
        $resultData = mysqli_fetch_assoc($result);
        $name = $resultData['name'];
        $age = $resultData['age'];
        $email = $resultData['email'];
        $position = $resultData['position'];
    } else {
        // If no data found, redirect to an error page or home
        header("Location: index.php");
        exit();
    }
} else {
    // Redirect to home if no 'id' is set
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/edit.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Edit Employee Data</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Back to Home</a>

        <form name="edit" method="post" action="editAction.php">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" class="form-control" id="age" value="<?php echo htmlspecialchars($age); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" name="position" class="form-control" id="position" value="<?php echo htmlspecialchars($position); ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="js/edit.js"></script>
</body>
</html>
