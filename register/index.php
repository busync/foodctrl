<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../autoload.php';

use App\Controllers\UserController;
use App\Database\Database;

$database = new Database();
$pdo = $database->getConnection();

$sessionToken = $_SESSION['sessionToken'] ?? null;

$userController = new UserController($pdo, $sessionToken);
$isAuth = $userController->isAuth();

if ($isAuth) {
    header("Location: ../dashboard");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../static/css/auth/index.css">
</head>
<body>
    <div class="form">
        <form action="login.php" method="POST">
            <h2>Вход в систему</h2>

            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" id="username" name="username" minlength="4" maxlength="255" required
                    placeholder="Введите имя пользователя">
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" minlength="6" maxlength="255" required
                    placeholder="Введите пароль">
            </div>

            <div class="form-group">
                <label for="atoken">AToken</label>
                <input type="text" id="atoken" name="atoken" minlength="10" maxlength="255" required
                    placeholder="Введите токен доступа">
            </div>

            <button type="submit">Войти</button>
        </form>
    </div>
</body>
</html>