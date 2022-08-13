<?php
if (!isset($_COOKIE['user']) || $_COOKIE['user'] != 'admin') {
    header("Location: http://localhost/online_voting_php/index.php");
    exit;
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
    <a href="create-election.php">Create New Election</a>
    <br>
    <a href="create-party.php">Add New Party</a>
    <br>
</body>
</html>