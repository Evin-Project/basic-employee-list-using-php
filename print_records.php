<?php
// Include the database connection file
require_once("dbConnection.php");

// Fetch data in descending order (latest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Employee List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            -webkit-print-color-adjust: exact;
            padding: 20px;
            color: #333;
            background-color: #f8f9fa; /* Light background for printing */
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 28px;
            color: #1f5b9a; /* Corporate blue color */
        }

        .company-info {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #dee2e6; 
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #1f5b9a; 
            color: white;
            font-size: 16px;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2; /* Light gray for even rows */
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff; /* White for odd rows */
        }

        @page {
            size: auto;
            margin: 20mm;
        }

        thead {
            display: table-header-group;
        }

        .print-timestamp {
            text-align: right;
            font-size: 12px;
            margin-bottom: 10px;
        }

        /* Add some spacing for better readability */
        .container {
            margin: 0 auto;
            max-width: 800px; /* Limit width for better print layout */
            padding: 20px;
            background-color: white; /* White background for the content */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Employee List</h2>
    <div class="company-info">
        <p>Evin Corporation</p>
        <p>Adya, Lipa City, Philippines</p>
        <p>Email: evinlerrickmosca@gmail.com | Phone: 0998 299 0843</p>
    </div>

    <div class="print-timestamp">
        <?php echo "Printed on: " . date("Y-m-d H:i:s"); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($res = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".htmlspecialchars($res['name'])."</td>";
            echo "<td>".htmlspecialchars($res['age'])."</td>";
            echo "<td>".htmlspecialchars($res['email'])."</td>";    
            echo "<td>".htmlspecialchars($res['position'])."</td>";    
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script>
    window.print();
</script>

</body>
</html>
