<?php
// index.php
require_once("base.php");

// Set the number of results per page
$perPageOptions = [5, 10, 20, 50];
$perPage = isset($_GET['per_page']) && in_array($_GET['per_page'], $perPageOptions) ? intval($_GET['per_page']) : 10; // Default to 10
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Current page
$start = ($page - 1) * $perPage; // Starting row for the query

// Check if a search query is provided
$searchQuery = isset($_GET['search']) ? mysqli_real_escape_string($mysqli, $_GET['search']) : '';

// Fetch data based on the search query with pagination
if ($searchQuery) {
    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE name LIKE '%$searchQuery%' OR age LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%' OR position LIKE '%$searchQuery%' ORDER BY id DESC LIMIT $start, $perPage");
} else {
    $result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC LIMIT $start, $perPage");
}

// Get the total number of records for pagination
$totalResult = mysqli_query($mysqli, "SELECT COUNT(*) as total FROM users" . ($searchQuery ? " WHERE name LIKE '%$searchQuery%' OR age LIKE '%$searchQuery%' OR email LIKE '%$searchQuery%' OR position LIKE '%$searchQuery%'" : ""));
$totalRows = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($totalRows / $perPage);
?>
<html>
<head>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
<div class="content">
    <h2 class="mb-4 text-primary">Employee List</h2>

    <!-- Results per page selection -->
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name, age, email, or position..." value="<?php echo htmlspecialchars($searchQuery); ?>">
            <select name="per_page" class="form-select" onchange="this.form.submit()">
                <?php foreach ($perPageOptions as $option): ?>
                    <option value="<?php echo $option; ?>" <?php if ($option == $perPage) echo 'selected'; ?>><?php echo $option; ?></option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Email</th>
                    <th scope="col">Position</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($res = mysqli_fetch_assoc($result)) {
                    echo "<tr data-id=\"{$res['id']}\" 
                                data-name=\"".htmlspecialchars($res['name'])."\" 
                                data-age=\"".htmlspecialchars($res['age'])."\" 
                                data-email=\"".htmlspecialchars($res['email'])."\" 
                                data-position=\"".htmlspecialchars($res['position'])."\">";
                    echo "<td>".htmlspecialchars($res['name'])."</td>";
                    echo "<td>".htmlspecialchars($res['age'])."</td>";
                    echo "<td>".htmlspecialchars($res['email'])."</td>";    
                    echo "<td>".htmlspecialchars($res['position'])."</td>";    
                    echo "<td>
                        <a href=\"edit.php?id={$res['id']}\" class=\"btn btn-warning btn-sm\" aria-label=\"Edit employee\">
                            <i class=\"fas fa-edit\"></i>
                        </a> 
                        <a href=\"delete.php?id={$res['id']}\" class=\"btn btn-danger btn-sm\" onClick=\"return confirm('Are you sure you want to delete?')\" aria-label=\"Delete employee\">
                            <i class=\"fas fa-trash\"></i>
                        </a>
                        <a href=\"print.php?id={$res['id']}\" class=\"btn btn-info btn-sm\" target=\"_blank\" aria-label=\"Print employee details\">
                            <i class=\"fas fa-print\"></i>
                        </a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>&per_page=<?php echo $perPage; ?>&search=<?php echo urlencode($searchQuery); ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div> <!-- End of content -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
