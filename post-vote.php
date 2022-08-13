<?php

function handlePost()
{
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $conn = mysqli_connect($server, $username, $password);
    $party = $_POST['party'];
    $election = $_POST['election'];
    $userId = $_POST['cit'];

    $queryPrevVote = "SELECT count(*) as total from `online_voting`.`votes` WHERE election_id='$election' AND user_id='$userId'";
    $userHasPrevVote = mysqli_query($conn, $queryPrevVote);
    $data=mysqli_fetch_assoc($userHasPrevVote);
    
    if (intval($data['total']) > 0) {
        return false;
    }

    $insertVote = "INSERT INTO `online_voting`.`votes` (`id`, `party_id`, `election_id`, `user_id`) VALUES (NULL, '$party', '$election', '$userId');";

    if (!$conn) {
        die('Error connecting to database: ' . mysqli_connect_error());
    }
    return $conn->query($insertVote) == true ? true : false;
}

if (isset($_POST['party'])) {
    $isVoted = handlePost();
    if ($isVoted) {
        echo 'Thank you for voting!';
    } else {
        echo 'You have already voted!';
    }
}