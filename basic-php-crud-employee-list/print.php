<?php
// Include the database connection file
require_once("dbConnection.php");

// Ensure the employee ID is provided and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the input

    // Fetch the specific employee's data
    $stmt = $mysqli->prepare("SELECT name, age, email, position FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $res = $result->fetch_assoc();

    // Close the prepared statement
    $stmt->close();

    if ($res) {
        // Continue with page rendering if employee data was found
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Print Employee Details</title>
            <!-- Bootstrap CSS -->
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <!-- Custom CSS -->
            <link href="css/print.css" rel="stylesheet"> <!-- Optional: Custom print styling -->
        </head>
        <body onload="window.print();"> <!-- Automatically opens the print dialog -->

        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Employee Details</h2>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($res['name']); ?></p>
                    <p><strong>Age:</strong> <?php echo htmlspecialchars($res['age']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($res['email']); ?></p>
                    <p><strong>Position:</strong> <?php echo htmlspecialchars($res['position']); ?></p>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        // If no data found, display an error message
        echo "<p class='text-danger text-center mt-5'>Employee not found.</p>";
    }
} else {
    // If the ID is not valid, display an error message
    echo "<p class='text-danger text-center mt-5'>Invalid employee ID.</p>";
}

// Close the database connection
$mysqli->close();
?>
