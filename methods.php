<?php

function getUserById($mysqli, $login) {
    $query = "SELECT id FROM `users` WHERE login = '$login'";
    $res = mysqli_query($mysqli, $query);
    return mysqli_fetch_assoc($res);
}

function getAllRequestsForUser($mysqli, $userId) {
    $requestsQuery = "SELECT r.* FROM `requests` r 
                      JOIN `user_requests` ur ON r.id = ur.request_id 
                      WHERE ur.user_id = $userId";
    return mysqli_query($mysqli, $requestsQuery);
}
?>
