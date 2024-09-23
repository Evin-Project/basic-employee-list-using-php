<?php
// dashboard.php
session_start();
require_once("dbConnection.php");
require_once("base.php");

// Fetch the total number of employees
$result = mysqli_query($mysqli, "SELECT COUNT(*) AS total FROM users");
$totalEmployees = mysqli_fetch_assoc($result)['total'];
?>

<div class="content">
    <h2 class="mb-4">Dashboard</h2>
    <div class="card shadow-lg border-light">
        <div class="card-body text-center">
            <h5 class="card-title text-primary">Total Employees</h5>
            <p class="card-text" style="font-size: 3rem; font-weight: bold;"><?php echo htmlspecialchars($totalEmployees); ?></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
