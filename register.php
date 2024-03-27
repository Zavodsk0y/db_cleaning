<?php
require_once 'dbconnect.php';
$content = '';
$errors = [];

if (!empty($_POST) && $_POST['submit'] === 'Зарегистрироваться') {
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $repeat = $_POST['repeat'];

    if (empty($_POST['login']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['repeat'])) {
        $errors[] = 'Заполните все необходимые поля';
    } else if ($_POST['password'] !== $_POST['repeat']) $errors[] = 'Введенные пароли не совпадают';
    else {
        $query = "INSERT INTO `users` (email, login, password) VALUES ('$email','$login', '$password')";
        $res = mysqli_query($mysqli, $query);
        $id = mysqli_insert_id($mysqli);

        $query = "INSERT INTO `user_roles` (user_id, role_id) VALUES ($id, 1)";
        $res = mysqli_query($mysqli, $query);

        setcookie('login', $login);
        header('Location: index.php');
        exit(); // Выход из скрипта после перенаправления

        if (!$res) die (mysqli_error($mysqli));
    }

}
ob_start();
?>
<h1>Регистрация</h1>
<?php if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<span style='color: red'>$error</span>";
    }
} ?>
<form method="post">
    <label>Email <input type="email" name="email"></label><br>
    <label>Логин <input type="text" name="login"></label><br>
    <label>Пароль <input type="password" name="password"></label><br>
    <label>Повтор пароля <input type="password" name="repeat"></label><br>
    <input type="submit" name="submit" value="Зарегистрироваться">
</form>
<a href="login.php">Уже есть аккаунт? Войти в систему</a>
<?php
$content = ob_get_clean();
$title = 'Регистрация';
require_once 'layout.php';
?>
