<?php

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
    <form action="cr.php" method="post">
        <input type="text" name="cit" placeholder="Citizenship number">
        <input type="password" min=8 max=32 name="password" placeholder="Password">
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