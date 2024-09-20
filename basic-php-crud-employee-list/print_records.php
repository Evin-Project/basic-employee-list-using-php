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
            font-family: 'Times New Roman', serif;
            -webkit-print-color-adjust: exact;
            padding: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 24px;
            color: #000000;
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
        }

        th, td {
            border: 1px solid #000000; 
            padding: 10px;
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
            echo "<td>".$res['name']."</td>";
            echo "<td>".$res['age']."</td>";
            echo "<td>".$res['email']."</td>";    
            echo "<td>".$res['position']."</td>";    
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
