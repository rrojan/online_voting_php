<?php
$isLoggedIn = false;
if (isset($_COOKIE['isLoggedIn'])) {
    $isLoggedIn = true;
}

function loginUser($cit)
{
    setcookie('isLoggedIn', true);
    setcookie('user', $cit);
}

function handlePost()
{
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $conn = mysqli_connect($server, $username, $password);

    $cit = $_POST['cit'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `voting_system`.`user` WHERE cit = '$cit' AND password = '$password'";
    if (!$conn) {
        die('Error connecting to database: ' . mysqli_connect_error());
    }
    if ($result = mysqli_query($conn, $query)) {
        if(mysqli_num_rows($result) > 0){
            return true;
        } else {
            return false;
        }
    } else {
        die('Error connecting to database: ' . mysqli_connect_error());
    }
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
    <form action="login.php" method="post">
        <input type="text" name="cit" placeholder="Citizenship number">
        <input type="password" min=8 max=32 name="password" placeholder="Password">
        <button type="submit">Submit</button>
    </form>
    EOD;
    if ($isLoggedIn) {
        echo 'You are already logged in. Please log out before login.';
    } else {
        echo $form;
    }
    if (isset($_POST['cit'])) {
        $isSuccessfulLogin = handlePost();
        if ($isSuccessfulLogin) {
            loginUser($_POST['cit']);
            // Redirect to index
            header("Location: http://localhost/achiwin/index.php");
            exit;
        } else {
            echo 'Incorrect username or password';
        }
    }
    ?>
</body>

</html>