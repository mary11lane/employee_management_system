<?php

error_reporting(0);

include_once("connection.php");

$connection = connection();
$email_address = $_POST['email_address'];
$password = $_POST['password'];

if (isset($_POST['submit'])) {
    $query = $connection->prepare("SELECT * FROM users WHERE email_address = ?");
    $query->bind_param("s", $email_address);
    $query->execute();
    $result = $query->get_result();

    if (mysqli_num_rows($result) > 0) {
        $warning = true;
        $query->close();
    } else {
        $sql = $connection->prepare("INSERT INTO users(email_address, password) VALUES (?, ?)");
        $email_address = $_POST['email_address'];
        $password = $_POST['password'];
        $sql->bind_param("ss", $email_address, $password);
        $sql->execute();
        $sql->close();
        echo header("Location: login.php");
    }
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
    <section class="form-user">
        <h2>Register</h1>

            <form method="post">
                <label>Email:</label>
                <input type="email" name="email_address" value="<?php echo $email_address ?>">
                <label>Password</label>
                <input type="password" name="password" value="<?php echo $password ?>">
                <button type="submit" name="submit" value="Register">Register</button>
            </form>
            <div class="<?php echo ($warning) ? '' : 'hidden' ?>">User already exists</div>
            <div>Already have an account?<a href="login.php" class="button-link"> Login</a></div>
    </section>
</body>

</html>