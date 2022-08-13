<?php

if (isset($_COOKIE['user']) and $_COOKIE['user'] == 'admin') {
    header("Location: http://localhost/online_voting_php/admin.php");
    exit;
}

$sent = false;
if (isset($_POST['name'])) {
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $conn = mysqli_connect($server, $username, $password);

    $name = $_POST['name'];
    $symbol = $_POST['symbol'];
    $email = $_POST['email'];
    $faculty = $_POST['faculty'];
    $letter = $_POST['letter'];
    $insertSQL = "INSERT INTO `trip`.`trip` (`id`, `name`, `symbol`, `email`, `faculty`, `letter_of_consent`, `created_at`, `updated_at`) VALUES (NULL, '$name', '$symbol', '$email', '$faculty', '$letter', current_timestamp(), NULL);";

    if (!$conn) {
        die('LOLLLL!' . mysqli_connect_error());
    }
    if ($conn->query($insertSQL) == true) {
        $sent = true;
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if ($sent == true) {
        echo '<h1>Thanks!</h1>';
    }
    ?>
    <form action="index.php" method="post">
        <input type="text" name="name" placeholder="Hari Bahadur"><br>
        <input type="text" name="symbol" placeholder="XX-XX-XXXX-XXXX"><br>
        <input type="email" name="email" placeholder="hari_bahadur@gmail.com"><br>
        <input type="text" name="faculty" placeholder="Engineering"><br>
        <textarea name="letter" id="letter" cols="30" rows="10" placeholder="Letter of Consent"></textarea><br>
        <button class="btn" type="submit">Submit</button><br>
    </form>
</body>

</html>