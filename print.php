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
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                body {
                    font-family: Arial, sans-serif;
                    -webkit-print-color-adjust: exact;
                    padding: 20px;
                    background-color: #f8f9fa; /* Light background for printing */
                }

                h2 {
                    text-align: center;
                    margin-bottom: 20px;
                    color: white; /* Corporate blue color */
                }

                .container {
                    margin: 0 auto;
                    max-width: 600px; /* Limit width for better print layout */
                    padding: 20px;
                    background-color: white; /* White background for the content */
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                .card {
                    border: none;
                }

                .card-header {
                    background-color: #1f5b9a; /* Corporate blue */
                    color: white;
                }

                .card-body {
                    font-size: 18px;
                    color: #333;
                }

                .strong {
                    font-weight: bold;
                }
            </style>
        </head>
        <body onload="window.print();"> <!-- Automatically opens the print dialog -->

        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Employee Details</h2>
                </div>
                <div class="card-body">
                    <p><span class="strong">Name:</span> <?php echo htmlspecialchars($res['name']); ?></p>
                    <p><span class="strong">Age:</span> <?php echo htmlspecialchars($res['age']); ?></p>
                    <p><span class="strong">Email:</span> <?php echo htmlspecialchars($res['email']); ?></p>
                    <p><span class="strong">Position:</span> <?php echo htmlspecialchars($res['position']); ?></p>
                </div>
            </div>
        </div>

        </body>
        </html>
        <?php
    } else {
        // If no data found, display an error message
        echo "<div class='text-danger text-center mt-5'><p>Employee not found.</p></div>";
    }
} else {
    // If the ID is not valid, display an error message
    echo "<div class='text-danger text-center mt-5'><p>Invalid employee ID.</p></div>";
}

// Close the database connection
$mysqli->close();
?>
