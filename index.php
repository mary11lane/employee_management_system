<?php

// error_reporting(0);

session_start();

if (!$_SESSION['valid']) {
    echo header("Location: login.php");
}

include_once("connection.php");

$connection = connection();

if (isset($_POST['delete'])) {
    $id = $_POST['ID'];
    $sql = "DELETE FROM employees_list WHERE id = '$id'";
    $connection->query($sql);
}

$sql = "SELECT * FROM employees_list ORDER BY last_name";
$employees = $connection->query($sql);
$row = $employees->fetch_assoc();
$connection->close();

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
    <h1>Employee Management System</h1>
    <a href="logout.php" class="logout">Logout</a>
    <a href="add.php" class="add">+ Add New</a>
    <?php if (!$row) {
        echo "<p class='nodata'>no data available</p>";
    } ?>

    <table class="<?php echo (!$row) ? 'hidden' : ''; ?>">
        <thead>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Position</th>
                <th>Department</th>
                <th colspan="2">Actions</td>
            </tr>
        </thead>

        <tbody>
            <?php do { ?>
                <tr>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><button><a href="edit.php?ID=<?php echo $row['id']; ?> ">Edit</a></button></td>
                    <td>
                        <form method="post" onSubmit="if(!confirm('Are you sure you want to delete?')){return false;}">
                            <button type="submit" name="delete" class="delete">Delete</a>
                                <input type="text" name="ID" value="<?php echo $row['id']; ?>" hidden>
                        </form>
                    </td>
                </tr>
            <?php } while ($row = $employees->fetch_assoc()) ?>
        </tbody>
    </table>

</body>

</html>