<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
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
    <div class="container my-5">
        <?php
        $server = 'localhost';
        $username = 'root';
        $password = '';
        $conn = mysqli_connect($server, $username, $password);
        $result = $conn->query("SELECT name from `online_voting`.`election` WHERE id = " . $_GET['election']);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<h1>' . $row['name'] . '</h1>';
            }
        }
        $totalVotes =  mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as total FROM `online_voting`.`votes` WHERE election_id = " . $_GET['election']));
        echo '<h2 class="alert alert-primary my-5">Total Votes: ' . $totalVotes['total'] . '</h2>';
        echo '<hr class="container">';
        $result = $conn->query("SELECT id from `online_voting`.`party`");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $partyName = $conn->query("SELECT name from `online_voting`.`party` WHERE id = " . $row['id']);
                if ($partyName->num_rows > 0) {
                    while ($row2 = $partyName->fetch_assoc()) {
                        $pvQ = "SELECT count(*) as total FROM `online_voting`.`votes` WHERE election_id = " . $_GET['election'] .' AND party_id = '.$row['id'];
                        $partyVotes =  mysqli_fetch_assoc(mysqli_query($conn, $pvQ))['total'];
                        $perc = (intval($partyVotes) * 100) / intval($totalVotes['total']);
                        echo $row2['name'] . '  [ '.$perc.'% ]';

                        $progressBar = <<<EOD
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: $perc%" aria-valuenow="$perc" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        EOD;
                        echo $progressBar;
                    }
                }
            }
        }
        ?>
    </div>

</body>

</html>