<?php
// Include the database connection file
require_once("dbConnection.php");

// Define how many results you want per page
$results_per_page = 10;

// Find out the number of results stored in database
$result = mysqli_query($mysqli, "SELECT * FROM users");
$number_of_results = mysqli_num_rows($result);

// Determine number of pages available
$number_of_pages = ceil($number_of_results / $results_per_page);

// Determine which page number visitor is currently on
if (!isset($_GET['page']) || $_GET['page'] < 1) {
    $current_page = 1;
} else {
    $current_page = (int)$_GET['page'];
}

// Determine the SQL LIMIT starting number for the results on the current page
$this_page_first_result = ($current_page - 1) * $results_per_page;

// Fetch the selected results from the database
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC LIMIT " . $this_page_first_result . ',' . $results_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/index.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<div class="container">
    <h2>Employee List</h2>
    
    <div class="d-flex justify-content-between mb-3">
        <a href="add.php" class="btn btn-primary">Add New Employee</a>
        <a href="print_records.php" class="btn btn-info" target="_blank">Print All Records</a>
    </div>

    <!-- Search Bar -->
    <div class="mb-3">
        <input type="text" id="search-input" class="form-control" placeholder="Search for names, emails, or positions..." onkeyup="searchTable()">
    </div>

    <table class="table table-bordered table-striped" id="employee-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Position</th>
                <th class="action-column">Action</th>
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
            echo "<td class='action-column'>
                <a href=\"edit.php?id=$res[id]\" class=\"btn btn-warning btn-sm\">
                    <i class=\"fas fa-edit icon\"></i>
                </a> 
                <a href=\"delete.php?id=$res[id]\" class=\"btn btn-danger btn-sm\" onClick=\"return confirm('Are you sure you want to delete?')\">
                    <i class=\"fas fa-trash icon\"></i>
                </a>
                <a href=\"print.php?id=$res[id]\" class=\"btn btn-info btn-sm\" target=\"_blank\">
                    <i class=\"fas fa-print icon\"></i>
                </a>
                </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- Pagination Controls -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($current_page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $current_page - 1; ?>">Previous</a>
                </li>
            <?php endif; ?>

            <?php for ($page = 1; $page <= $number_of_pages; $page++): ?>
                <li class="page-item <?php if ($page == $current_page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($current_page < $number_of_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Search functionality -->
<script>
    function searchTable() {
        const input = document.getElementById('search-input').value.toLowerCase();
        const table = document.getElementById('employee-table');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            for (let j = 0; j < cells.length - 1; j++) { // Exclude the last cell (Action)
                if (cells[j].textContent.toLowerCase().includes(input)) {
                    found = true;
                    break;
                }
            }

            rows[i].style.display = found ? '' : 'none';
        }
    }
</script>

</body>
</html>
