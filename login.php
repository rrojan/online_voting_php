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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding-top: 10px; padding-bottom: 10px; padding-left: 12vw; padding-right: 12vw;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" style="font-size: 2em; margin-right: 120px;">OVS Nepal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="vote.php">Current Elections</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Quick Vote
                        </a>
                        
                            <!-- <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sliders-h fa-fw"></i> Account</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog fa-fw"></i> Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-fw"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar -->
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