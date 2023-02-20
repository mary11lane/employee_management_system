<?php

// error_reporting(0);

include_once("connection.php");

$connection = connection();

$id = $_GET['ID'];
$sql = "SELECT * FROM employees_list WHERE id = '$id'";
$employees = $connection->query($sql);
$row = $employees->fetch_assoc();
$employees->close();

if (isset($_POST['submit'])) {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $sql = $connection->prepare("UPDATE employees_list SET last_name = ?, first_name = ?, position = ?, department = ? WHERE id = ?");
    $sql->bind_param("ssssi", $last_name, $first_name, $position, $department, $id);
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

        <h2>Edit Employee Information</h2>

        <form method="post">

            <label>Last Name</label>
            <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>">

            <label>First Name</label>
            <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>">

            <label>Position</label>
            <select name="position" value="<?php echo $row['position']; ?>">
                <option <?php echo ($row['position'] === "Staff") ? 'selected' : ''; ?>>Staff</option>
                <option <?php echo ($row['position'] === "Supervisor") ? 'selected' : ''; ?>>Supervisor</option>
                <option <?php echo ($row['position'] === "Manager") ? 'selected' : ''; ?>>Manager</option>
            </select>

            <label>Department</label>
            <select name="department" value="<?php echo $row['department']; ?>">
                <option <?php echo ($row['department'] === "HR") ? 'selected' : ''; ?>>HR</option>
                <option <?php echo ($row['department'] === "Operations") ? 'selected' : ''; ?>>Operations</option>
                <option <?php echo ($row['department'] === "Sales") ? 'selected' : ''; ?>>Sales</option>
                <option <?php echo ($row['department'] === "IT") ? 'selected' : ''; ?>>IT</option>
            </select>

            <button type="submit" name="submit" value="Submit">Update</button>
            <button><a href="index.php">Cancel</a></button>

        </form>

    </section>

</body>

</html>