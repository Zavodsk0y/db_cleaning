<?php
require_once 'init.php';
require_once 'methods.php';

$user = getUserById($mysqli, $login);
$id = $user['id'];

$requestsResult = getAllRequestsForUser($mysqli, $id);

ob_start();
echo "<h1>Добро пожаловать, $login</h1>";
if (mysqli_num_rows($requestsResult) > 0) {
    echo "<h2>Мои заявки</h2><ul>";
    while ($row = mysqli_fetch_assoc($requestsResult)) {
        echo "<li>{$row['product_description']} - {$row['service_type']} - {$row['order_date']} - {$row['price']} - {$row['status']}</li>";
    }
    echo "</ul>";
} else {
    echo "<p>У вас пока нет заявок.</p>";
}
echo "<a href='logout.php'>Выйти из аккаунта</a> <br>";
echo "<a href='add_request.php'>Создать заявку</a>";
$content = ob_get_clean();
include 'layout.php';
?>
