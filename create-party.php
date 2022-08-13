<?php
$isLoggedIn = false;
if (isset($_COOKIE['isLoggedIn'])) {
    $isLoggedIn = $_COOKIE['isLoggedIn'];
    $currentUser = $_COOKIE['user'];
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
    <form action="create-party.php" method="post">
        <input type="text" name="name" placeholder="Citizenship number">
        <input type="text" min=8 max=32 name="logo" placeholder="Logo URL">
        <button type="submit">Submit</button>
    </form>

    <?php
    $form = <<<EOD
    
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