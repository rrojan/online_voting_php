<?php
$isLoggedIn = false;
if (isset($_COOKIE['isLoggedIn'])) {
    $isLoggedIn = $_COOKIE['isLoggedIn'];
    $currentUser = $_COOKIE['user'];
}
if (!$isLoggedIn) {
    die('You are not autorized to view this page');
}

function handlePost() {
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $conn = mysqli_connect($server, $username, $password);

    $name = $_POST['name'];

    $query = "INSERT INTO `online_voting`.`election` (`id`, `name`) VALUES (NULL, '$name');";
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
    <title>Create New Election</title>
</head>

<body>
    <form action="create-election.php" method="post">
        <input type="text" name="name" placeholder="Election Name">
        <button type="submit">Submit</button>
    </form>

    <?php
    if (isset($_POST['name'])) {
        $isCreated = handlePost();
        if ($isCreated) {
            echo '<h3>Successfully created new election: ' . $_POST['name'];
        } else {
            echo 'Error: Please check your details';
        }
    }
    ?>
</body>

</html>