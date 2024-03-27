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
}

$requestsQuery = "SELECT r.* FROM `requests` r 
                      JOIN `user_requests` ur ON r.id = ur.request_id 
                      WHERE ur.user_id = $id";
    $requestsResult = mysqli_query($mysqli, $requestsQuery);

    if ($requestsResult && mysqli_num_rows($requestsResult) > 0) {
        ob_start();
?>
        <h1>Добро пожаловать, <?= $_COOKIE['login'] ?></h1>
        <h2>Мои заявки</h2>
        <ul>
        <?php while ($row = mysqli_fetch_assoc($requestsResult)) : ?>
            <h3>Заявка от <?= $row['fio'] ?></h3>
            <li>Описание изделия: <?= $row['product_description'] ?></li>
        <li>Тип услуги: <?= $row['service_type'] ?></li>
        <li>Дата приема заказа: <?= $row['order_date'] ?></li>
        <li>Цена: <?= $row['price'] ?></li>
        <li>Статус заказа: <?= $row['status'] ?></li>
        <?php endwhile; ?>
        </ul>
        <a href="logout.php">Выйти из аккаунта</a>
<?php
        $content = ob_get_clean();
    } else {
        $content = "<h1>Добро пожаловать, $login </h1>
        <p>У вас пока нет заявок</p>
        <a href='add_request.php'>Создать заявку</a>
        <a href='requests.php'>Управление заявками (администратор)</a>
        <a href='logout.php'>Выйти из аккаунта</a>";
    }
$title = 'Главная';
require_once 'layout.php';
?>



