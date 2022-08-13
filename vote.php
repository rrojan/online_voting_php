<?php
$server = 'localhost';
$username = 'root';
$password = '';
$conn = mysqli_connect($server, $username, $password);

// Get id for all elections not in published tbale
$queryAllElectionIDs = <<<SQL
SELECT id, name FROM `online_voting`.`election`
WHERE id NOT IN (
    SELECT id FROM `online_voting`.`published_elections`
)
SQL;

$queryAllParties = <<<SQL
SELECT * from `online_voting`.`party`
SQL;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote now!</title>
</head>

<body>
    <h1>Vote Now!</h1>

    <?php
    if (!isset($_GET['election'])) {
        echo '<div>';
        if ($result = mysqli_query($conn, $queryAllElectionIDs)) {
            $num_rows = mysqli_num_rows($result);
            for ($i = 0; $i < $num_rows; $i++) {
                $row = mysqli_fetch_assoc($result);
                $id = $row['id'];
                $name = $row['name'];
                echo '<a href="vote.php?election=' . $id . '">' . $name . '</a>';
                echo '<br>';
            }
        }
        echo '</div>';
        exit;
    }
    ?>
    <form action="post-vote.php" method="POST">
        <?php
        echo '<input type="text" style="display: none;" name="cit" value=' . $_COOKIE['userId'] . '>';
        echo '<input type="text" style="display: none;" name="election" value=' . $_GET['election'] . '>';
        ?>
        <div class="vote-options-container">
            <?php
            if ($result = mysqli_query($conn, $queryAllParties)) {
                $num_rows = mysqli_num_rows($result);
                for ($i = 0; $i < $num_rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $id = $row['id'];
                    $name = $row['name'];
                    $logoUrl = $row['logo_url'];
                    echo '<div class="party-image-container">';
                    echo '<input type="radio" name="party" value="' . $id . '" id=' . $id . '>';
                    echo '<label for=' . $id . '>' . $name . '</label>';
                    echo '<br>';
                    echo '<img src="' . $logoUrl . '" width=300 height=300 style="object-fit: cover;">';
                    echo '</div>';
                }
            }
            ?>
            <button type="submit">Submit Your Vote</button>
        </div>
    </form>
</body>

</html>