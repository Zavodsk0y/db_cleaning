<?php
require_once 'init.php';

if (!in_array('Администратор', $userRoles)) {
    header('Location: index.php');
    exit;
}

$requestsQuery = "SELECT * FROM requests";
$requestsResult = mysqli_query($mysqli, $requestsQuery);

if (isset($_POST['change_status'])) {
    $requestId = $_POST['request_id'];
    $newStatus = $_POST['new_status'];
    $updateQuery = "UPDATE `requests` SET status = '$newStatus' WHERE id = $requestId";
    mysqli_query($mysqli, $updateQuery);
    header('Location: requests.php');
}

if (isset($_POST['delete_request'])) {
    $requestId = $_POST['request_id'];
    $deleteQuery = "DELETE FROM `requests` WHERE id = $requestId";
    mysqli_query($mysqli, $deleteQuery);
    header('Location: requests.php');
}

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
    <?php while ($row = mysqli_fetch_assoc($requestsResult)) : ?>
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
    <?php endwhile; ?>
</table>
<a href="logout.php">Выйти из аккаунта</a>
<?php
$content = ob_get_clean();
require_once 'layout.php';
?>
