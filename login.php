<?php
$isLoggedIn = false;
if (isset($_COOKIE['isLoggedIn'])) {
    $isLoggedIn = true;
}

function loginUser($cit, $userId)
{
    setcookie('isLoggedIn', true);
    setcookie('user', $cit);
    setcookie('userId', $userId);
}

function handlePost()
{
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $conn = mysqli_connect($server, $username, $password);

    $cit = $_POST['cit'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `online_voting`.`user` WHERE cit = '$cit' AND password = '$password'";
    if (!$conn) {
        echo 'error connecting to db';
        die('Error connecting to database: ' . mysqli_connect_error());
    }
    if ($result = mysqli_query($conn, $query)) {
        if($num_rows = mysqli_num_rows($result) > 0){
            for ($i = 0; $i < $num_rows; $i++) {
                $row = mysqli_fetch_assoc($result);
                return $row['id'];
            }
        } else {
            echo 'Matching user not found';
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
        $userId = handlePost();
        if ($userId) {
            loginUser($_POST['cit'], $userId);
            // Redirect to index
            header("Location: http://localhost/online_voting_php/index.php");
            exit;
        } else {
            echo 'Incorrect username or password';
        }
    }
    ?>
</body>

</html>