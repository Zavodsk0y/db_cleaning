<?php
require_once 'dbconnect.php';

if (!empty($_POST['submit']) && $_POST['submit'] === 'Войти в систему') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
    $result = mysqli_query($mysqli, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        setcookie('login', $user['login'], time() + 86400);
        header('Location: index.php');
        exit();
    } else {
        $error = "Неверный логин или пароль";
    }
}

ob_start();
?>
<h1>Вход в систему</h1>
<?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
<form action="login.php" method="post">
    <label>Логин <input type="text" name="login"></label><br>
    <label>Пароль <input type="password" name="password"></label><br>
    <input type="submit" name="submit" value="Войти в систему">
</form>
<a href="register.php">Нет аккаунта? Зарегистрируйтесь</a>
<?php
$content = ob_get_clean();
include 'layout.php';
?>
