<?php
$isLoggedIn = false;
if (isset($_COOKIE['isLoggedIn'])) {
    $isLoggedIn = true;
}

function handlePost()
{
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $conn = mysqli_connect($server, $username, $password);

    $cit = $_POST['cit'];
    $password = $_POST['password'];

    $query = "INSERT INTO `trip`.`user` (`id`, `cit`, `password`) VALUES (NULL, '$cit', '$password');";

    if (!$conn) {
        die('Error connecting to database: ' . mysqli_connect_error());
    }
    return $conn->query($query) == true ? true : false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $form = <<<EOD
    <form action="signup.php" method="post">
        <input type="text" name="cit" placeholder="Citizenship number">
        <input type="password" min=8 max=32 name="password" placeholder="Password">
        <button type="submit">Submit</button>
    </form>
    EOD;
    if ($isLoggedIn) {
        echo 'You are already logged in. Please log out before signup.';
    } else {
        echo $form;
    }
    if (isset($_POST['cit'])) {
        $isSuccessfulSignup = handlePost();
        if ($isSuccessfulSignup == true) {
            echo '<h1>User created successfully, you may now log in <a href="login.php">here</a></h1>';
        }
    }
    ?>
</body>

</html>