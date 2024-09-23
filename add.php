<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Multiple Employees</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/add.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Add Multiple Employee Data</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Back to Home</a>

        <form action="addAction.php" method="post" name="add">
            <div id="employee-form-container">
                <!-- Initial employee form -->
                <div class="employee-form mb-4">
                    <h4>Employee 1</h4>
                    <div class="form-group">
                        <label for="name1">Name</label>
                        <input type="text" name="names[]" class="form-control" id="name1" required>
                    </div>
                    <div class="form-group">
                        <label for="age1">Age</label>
                        <input type="number" name="ages[]" class="form-control" id="age1" required>
                    </div>
                    <div class="form-group">
                        <label for="email1">Email</label>
                        <input type="email" name="emails[]" class="form-control" id="email1" required>
                    </div>
                    <div class="form-group">
                        <label for="position1">Position</label>
                        <input type="text" name="positions[]" class="form-control" id="position1" required>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" id="add-more" class="btn btn-secondary">Add Another Employee</button>
                <button type="submit" name="submit"  class="btn btn-primary">Submit All Employees</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let employeeCount = 1;
            const container = document.getElementById('employee-form-container');
            const addMoreButton = document.getElementById('add-more');

            addMoreButton.addEventListener('click', function() {
                employeeCount++;
                const newEmployeeForm = `
                    <div class="employee-form mb-4">
                        <h4>Employee ${employeeCount}</h4>
                        <div class="form-group">
                            <label for="name${employeeCount}">Name</label>
                            <input type="text" name="names[]" class="form-control" id="name${employeeCount}" required>
                        </div>
                        <div class="form-group">
                            <label for="age${employeeCount}">Age</label>
                            <input type="number" name="ages[]" class="form-control" id="age${employeeCount}" required>
                        </div>
                        <div class="form-group">
                            <label for="email${employeeCount}">Email</label>
                            <input type="email" name="emails[]" class="form-control" id="email${employeeCount}" required>
                        </div>
                        <div class="form-group">
                            <label for="position${employeeCount}">Position</label>
                            <input type="text" name="positions[]" class="form-control" id="position${employeeCount}" required>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', newEmployeeForm);
            });
        });
    </script>
</body>
</html>
