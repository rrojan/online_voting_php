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
    $logoUrl = $_POST['logo'];

    $query = "INSERT INTO `online_voting`.`party` (`id`, `name`, `logo_url`) VALUES (NULL, '$name', '$logoUrl');";
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
    <title>Create Party</title>
</head>

<body>
    <form action="create-party.php" method="post">
        <input type="text" name="name" placeholder="Party Name">
        <input type="text" min=8 max=32 name="logo" placeholder="Logo URL">
        <button type="submit">Submit</button>
    </form>

    <?php
    if (isset($_POST['name'])) {
        $isCreated = handlePost();
        if ($isCreated) {
            echo '<h3>Successfully created new party: ' . $_POST['name'];
        } else {
            echo 'Error: Please check details';
        }
    }
    ?>
</body>

</html>