<?php
require_once 'dbconnect.php';
$content = '';

if (!$_COOKIE['login']) header('Location: login.php');
else {
    $login = $_COOKIE['login'];
    $query = "SELECT id FROM `users` WHERE login = '$login'";
    $res = mysqli_query($mysqli, $query);
    $user = mysqli_fetch_assoc($res);
    $id = $user['id'];

    $roleQuery = "SELECT r.name FROM `roles` r 
              JOIN `user_roles` ur ON r.id = ur.role_id 
              WHERE ur.user_id = $id";
    $roleResult = mysqli_query($mysqli, $roleQuery);

    $roles = [];
    while ($row = mysqli_fetch_assoc($roleResult)) {
        $roles[] = $row['name'];
    }

    if (!in_array('Администратор', $roles)) header('Location: index.php');
}

$requestsQuery = "SELECT * FROM requests";

$requestsResult = mysqli_query($mysqli, $requestsQuery);

if (isset($_POST['change_status'])) {
    $requestId = $_POST['request_id'];
    $newStatus = $_POST['new_status'];

    $updateQuery = "UPDATE `requests` SET status = '$newStatus' WHERE id = $requestId";
    mysqli_query($mysqli, $updateQuery);
}

if (isset($_POST['delete_request'])) {
    $requestId = $_POST['request_id'];

    $deleteQuery = "DELETE FROM `requests` WHERE id = $requestId";
    mysqli_query($mysqli, $deleteQuery);
}

if ($requestsResult && mysqli_num_rows($requestsResult) > 0) {
    ob_start();
    ?>
    <h1>Управление заявками</h1>
    <table border="1">
        <tr>
            <th>ФИО</th>
            <th>Описание изделия</th>
            <th>Тип услуги</th>
            <th>Дата приема заказа</th>
            <th>Цена</th>
            <th>Статус заказа</th>
            <th>Изменить статус</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($requestsResult)) {
            ?>
            <tr>
                <td><?= $row['fio'] ?></td>
                <td><?= $row['product_description'] ?></td>
                <td><?= $row['service_type'] ?></td>
                <td><?= $row['order_date'] ?></td>
                <td><?= $row['price'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <form method="post" action="requests.php">
                        <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                        <select name="new_status">
                            <option value="В ожидании">В ожидании</option>
                            <option value="Выполняется">Выполняется</option>
                            <option value="Готов">Готов</option>
                        </select>
                        <input type="submit" name="change_status" value="Изменить">
                        <input type="submit" name="delete_request" value="Удалить">
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a href="logout.php">Выйти из аккаунта</a>
    <?php
    $content = ob_get_clean();
} else {
    $content = "<p>У вас пока нет заявок</p>"; }
$title = 'Управление заявками';
require_once 'layout.php';
?>

