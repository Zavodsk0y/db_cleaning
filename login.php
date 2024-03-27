<?php
require_once 'dbconnect.php';

if (!empty($_POST['submit']) && $_POST['submit'] === 'Войти в систему') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
    $result = mysqli_query($mysqli, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        setcookie('login', $user['login']);
        header('Location: index.php');
        exit();
    } else {
        $error = "Неверный логин или пароль";
    }
}

$title = 'Вход в систему';
ob_start();
?>
<h1>Вход в систему</h1>
<?php if (isset($error)) : ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>
<form action="login.php" method="post">
    <label>Логин <input type="text" name="login"></label><br>
    <label>Пароль <input type="password" name="password"></label><br>
    <input type="submit" name="submit" value="Войти в систему">
</form>
<a href="register.php">Нет аккаунта? Зарегистрироваться</a>
<?php
$content = ob_get_clean();
require_once 'layout.php';
?>
