<?php
require '../database/config.php';
// require  'include/session.php';

session_start();
error_reporting(0);
// $_SESSION['success_message'] = 'login successful';
// $_SESSION['error_message'] = '';

$db = new Connection;

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "select * from users where username='$username'  AND password ='$password'";
    $result = $db->execute_query($sql);

    if ($db->get_num_rows($sql) > 0) {

        $row = mysqli_fetch_assoc($result); //fetch the entire row of the result if any.
        $_SESSION["username"] = $row["username"];
        header('Location:panel.php');
        // $_SESSION['error_message'] = '';
        // $_SESSION['success_message'] = " Login successful!";
    } else {

        echo "login failed";
        // $_SESSION['error_message'] = ' The email adress do not exist';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- links -->
    <link rel="stylesheet" href="../assets/css/admin.css">
    <title>Document</title>
</head>

<body>

    <div class="form-group">

        <h1>LOGIN</h1>
        <div class="form ">
            <form action="index.php" method="post">
                <input type="text" placeholder="username" name="username" required>
                <input type="password" placeholder="password" name="password" required>
                <button class="btn" name="login">login</button>
            </form>

        </div>
    </div>
</body>

</html>