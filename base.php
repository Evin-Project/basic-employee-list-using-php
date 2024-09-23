<?php
// base.php
session_start();
require_once("dbConnection.php");

// Example user data (you can replace this with actual session data)
$currentUser = [
    'name' => 'John Doe', // Replace with session variable for the logged-in user
];

// Check if there is a message to display
if (isset($_SESSION['message'])) {
    $messageType = $_SESSION['message_type'] === "success" ? "alert-success" : "alert-danger";
    echo '<div class="alert ' . $messageType . '" role="alert">';
    echo $_SESSION['message'];
    echo '</div>';

    // Clear the message after displaying it
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? htmlspecialchars($title) : 'Employee Management'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/base.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Employee Management</a>
    </div>
</nav>

<div class="sidebar">
    <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="add.php"><i class="fas fa-user-plus"></i> Add Employee</a>
    <a href="index.php"><i class="fas fa-list"></i> Employee List</a>
    <a href="print_records.php" target="_blank"><i class="fas fa-file-alt"></i> Reports</a>
</div>

<div class="content">