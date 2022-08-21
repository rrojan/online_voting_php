<?php
if (!isset($_COOKIE['user']) || $_COOKIE['user'] != 'admin') {
    header("Location: http://localhost/online_voting/index.php");
    exit;
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
    <title>Admin Portal</title>
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
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            $server = 'localhost';
                            $username = 'root';
                            $password = '';
                            $conn = mysqli_connect($server, $username, $password);

                            $query = <<<SQL
                                SELECT id, name FROM `online_voting`.`election`
                                WHERE id NOT IN (
                                    SELECT id FROM `online_voting`.`published_elections`
                                )
                                SQL;
                            if ($result = mysqli_query($conn, $query)) {
                                $num_rows = mysqli_num_rows($result);
                                for ($i = 0; $i < $num_rows; $i++) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo '<li><a class="dropdown-item" href="vote.php?election=' . $row['id'] . '">' . $row['name'] . '</a></li>';
                                }
                            }
                            ?>

                            <!-- <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                        </ul>
                    </li>
                </ul>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <!-- navbar -->
    <div class="container mt-5">
        <?php
        $server = 'localhost';
        $username = 'root';
        $password = '';
        $conn = mysqli_connect($server, $username, $password);
        $totalVotes =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as total FROM `online_voting`.`votes`"));
        $totalPolls =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as total FROM `online_voting`.`election`"));
        $totalUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as total FROM `online_voting`.`user`"));
        $totalParties = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as total FROM `online_voting`.`party`"));
        $table = <<<EOD
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Total Votes</th>
                <th scope="col">Running Elections</th>
                <th scope="col">Total Users Signed Up</th>
                <th scope="col">Total Parties</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"> </th>
                    <td>
        EOD .
            $totalVotes['total'] . <<<EOD
                    </td>
                    <td>
                    EOD .
            $totalPolls['total'] . <<<EOD
                    </td>
                    <td>
                    EOD .
            $totalUsers['total'] . <<<EOD
        </td>
        <td>
        EOD .
            $totalParties['total'] . <<<EOD
            </td>
                </tr>
            </tbody>
        </table>
        EOD;
        echo $table;
        ?>
    </div>
    <div class="container my-5 d-flex flex-row justify-content-start">
        <a href="create-election.php" class="btn btn-success px-3 py-2 me-4">Create New Poll</a>
        <a href="create-party.php" class="btn btn-primary px-3 py-2">Add New Party</a>
        <br>

    </div>
</body>

</html>