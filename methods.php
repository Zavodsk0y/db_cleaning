<?php

function getUserById($mysqli, string $login): array
{
    $query = "SELECT id FROM `users` WHERE login = '$login'";
    $res = mysqli_query($mysqli, $query);
    return mysqli_fetch_assoc($res);
}

function getAllRequestsForUser($mysqli, int $userId): bool|mysqli_result
{
    $requestsQuery = "SELECT r.* FROM `requests` r 
                      JOIN `user_requests` ur ON r.id = ur.request_id 
                      WHERE ur.user_id = $userId";
    return mysqli_query($mysqli, $requestsQuery);
}

function getUserRoles($mysqli, int $userId): array {
    $roles = [];
    $roleQuery = "SELECT r.name FROM `roles` r 
                  JOIN `user_roles` ur ON r.id = ur.role_id 
                  WHERE ur.user_id = $userId";
    $roleResult = mysqli_query($mysqli, $roleQuery);
    while ($row = mysqli_fetch_assoc($roleResult)) {
        $roles[] = $row['name'];
    }
    return $roles;
}


