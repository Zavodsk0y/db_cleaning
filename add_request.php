<?php
require_once 'init.php';
require_once 'methods.php';

$errors = [];

if (!empty($_POST) && $_POST['submit'] === 'Отправить заявку') {
    $fio = $_POST['fio'];
    $description = $_POST['productDescription'];
    $serviceType = $_POST['serviceType'];
    $date = $_POST['date'];
    $price = $_POST['price'];

    if (empty($fio) || empty($description) || empty($serviceType) || empty($date) || empty($price)) {
        $errors[] = 'Заполните все необходимые поля';
    } else {
        $query = "INSERT INTO `requests` (fio, product_description, service_type, order_date, price) VALUES ('$fio', '$description', '$serviceType', '$date', '$price')";
        $res = mysqli_query($mysqli, $query);
        $requestId = mysqli_insert_id($mysqli);

        $userRequestQuery = "INSERT INTO `user_requests` (user_id, request_id) VALUES ('$id', '$requestId')";
        mysqli_query($mysqli, $userRequestQuery);
    }
}

ob_start();
?>
<h1>Создание заявки</h1>
<?php if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<span style='color: red'>$error</span><br>";
    }
} ?>
<form method="post">
    <label>ФИО <input type="text" name="fio"></label><br>
    <label>Описание изделия <input type="text" name="productDescription"></label><br>
    <label>Вид услуги <select name="serviceType" id="serviceType" onchange="updatePrice()">
            <option value="Химчистка одежды и аксессуаров">Химчистка одежды и аксессуаров</option>
            <option value="Химчистка детской одежды">Химчистка детской одежды</option>
            <option value="Химчистка обуви с реставрацией">Химчистка обуви с реставрацией</option>
            <option value="Химчистка сумок с реставрацией">Химчистка сумок с реставрацией</option>
            <option value="Химчистка предметов интерьера">Химчистка предметов интерьера</option>
            <option value="Ручная чистка">Ручная чистка</option>
            <option value="Ремонт и реставрация">Ремонт и реставрация</option>
            <option value="Хранение меха и обуви">Хранение меха и обуви</option>
        </select></label><br>
    <label>Дата приема заказа <input type="datetime-local" name="date"></label><br>
    <label>Цена <input type="text" id="price" name="price" readonly></label><br>
    <input type="submit" name="submit" value="Отправить заявку">
</form>
<a href="index.php">На главную</a>
<?php
$content = ob_get_clean();
$title = 'Создание заявки';
require_once 'layout.php';
?>

<script>
    function updatePrice() {
        const serviceType = document.getElementById('serviceType');
        const price = document.getElementById('price');

        const prices = {
            'Химчистка одежды и аксессуаров': '109.49',
            'Химчистка детской одежды': '150.59',
            'Химчистка обуви с реставрацией': '169.99',
            'Химчистка сумок с реставрацией': '189.99',
            'Химчистка предметов интерьера': '229.99',
            'Ручная чистка': '209.99',
            'Ремонт и реставрация': '299.99',
            'Хранение меха и обуви': '149.99'
        };

        const selectedServiceType = serviceType.value;
        if (selectedServiceType in prices) {
            price.value = prices[selectedServiceType];
        } else {
            price.value = '';
        }
    }
</script>
