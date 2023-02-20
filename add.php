<?php
error_reporting(0);

include_once("connection.php");

$connection = connection();

if (isset($_POST['submit'])) {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $sql = $connection->prepare("INSERT INTO employees_list(last_name, first_name, position, department) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss", $last_name, $first_name, $position, $department);
    $sql->execute();
    $sql->close();

    echo header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <title>Employee Management System</title>
</head>

<body>
    <section class="form-employee-info">

        <h2>Add Employee</h2>

        <form method="post">
            <label>Last Name</label>
            <input type="text" name="last_name">

            <label>First Name</label>
            <input type="text" name="first_name">

            <label>Position</label>
            <select name="position">
                <option value="" selected="selected" hidden="hidden">Choose one</option>
                <option>Staff</option>
                <option>Supervisor</option>
                <option>Manager</option>
            </select>

            <label>Department</label>
            <select name="department">
                <option value="" selected="selected" hidden="hidden">Choose one</option>
                <option>HR</option>
                <option>Operations</option>
                <option>Sales</option>
                <option>IT</option>
            </select>

            <button type="submit" name="submit" value="Submit">Add</button>
            <button><a href="index.php">Cancel</a></button>
        </form>

    </section>

</body>

</html>